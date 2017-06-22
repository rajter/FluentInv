<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Knp\Snappy\Pdf;

class Deposits extends My_Controller {

    function __construct()
     {
       parent::__construct();
       $this->load->helper('url');
       $this->load->helper(array("form", "security", "date"));
       $this->load->model(array('item', 'receipt', 'deposit', 'dbQueries', 'modelHelper'));
     }

    //------------------------
    //  Prikazuje sve pologe
    //------------------------
    public function index()
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];
        $viewData['query'] = $this->deposit->getAll();
        $viewData['locations'] = $this->dbQueries->getLocations();
        $viewData['colors'] = array('blue', 'aqua', 'green', 'orange', 'red', 'yellow', 'black', 'purple');

        $headerscripts['header_scripts'] = array(
            '<script src="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css"></script> '
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/appjs/Deposits/deposits.js"></script>',
            '<script src="'.base_url().'assets/appjs/modals.js"></script>'
        );

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Deposits/deposits_view');
    }

    //---------------------------------------------
    //  Prikazuje sve pologe u odredjenoj lokaciji
    //---------------------------------------------
    public function viewForLocation($location_id=1)
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];
        $viewData['query'] = $this->deposit->getForLocation($location_id);
        $viewData['location'] = $this->dbQueries->getLocationData($location_id);

        $headerscripts['header_scripts'] = array(
            '<script src="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css"></script> '
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/appjs/Deposits/deposits.js"></script>',
            '<script src="'.base_url().'assets/appjs/modals.js"></script>'
        );

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Deposits/deposits_location_view');
    }

    //---------------
    //  Novi polog
    //---------------
    public function newDeposit()
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];
        $viewData['query'] = $this->item->getAll();
        // $viewData['locations'] = $this->dbQueries->getLocations();
        $viewData['location'] = $this->user->getLocation($session_data['id']);

        $headerscripts['header_scripts'] = array(
            '<link rel="stylesheet" href="'.base_url().'assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css">',
            '<link rel="stylesheet" href="'.base_url().'assets/plugins/datepicker/datepicker3.css">',
            '<link rel="stylesheet" href="'.base_url().'assets/plugins/select2/select2.css">',
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/plugins/datepicker/bootstrap-datepicker.js"></script>',
            '<script src="'.base_url().'assets/appjs/datepicker.js"></script>',
            '<script src="'.base_url().'assets/plugins/bootbox/bootbox.min.js"></script>',
            '<script src="'.base_url().'assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js"></script>',
            '<script src="'.base_url().'assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.hr-HR.js"></script>',
            '<script src="'.base_url().'assets/appjs/Deposits/deposits.js"></script>',
        );

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Deposits/new_deposit_view');
    }

    //-----------------------------
    //  Pregled odredjenog pologa
    //-----------------------------
    public function view($id = null)
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $headerscripts['header_scripts'] = array();
        $footerscripts['footer_scripts'] = array();

        $viewData['deposit'] = $this->deposit->get($id);

        $trans_id = (int)$viewData['deposit'][0]->trans_id;
        $trans_number = $viewData['deposit'][0]->transaction_number;

        $viewData['depositData'] = $this->deposit->getData($trans_id, $trans_number);
        $viewData['maxQuantity'] = $this->modelHelper->returnMaxQuantity(1, $trans_id);
        $viewData['company'] = $this->dbQueries->getCompanyInfo();

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Deposits/view');
    }

    //ajax called function
    //-------------------------------------------------------------
    //  Vraca formatiran view odredjenog pologa u pregledu pologa
    //-------------------------------------------------------------
    public function getDepositInfo()
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $headerscripts['header_scripts'] = array();
        $footerscripts['footer_scripts'] = array();

        $id = $this->input->get('transaction_number');
        $viewData['deposit'] = $this->deposit->get($id);

        $trans_id = (int)$viewData['deposit'][0]->trans_id;
        $trans_number = $viewData['deposit'][0]->transaction_number;

        $viewData['depositData'] = $this->deposit->getData($trans_id, $trans_number);
        $viewData['maxQuantity'] = $this->modelHelper->returnMaxQuantity(1, $trans_id);
        $viewData['company'] = $this->dbQueries->getCompanyInfo();

        $formatedReceipt = $this->return_transaction_preview($data, $viewData, 'Deposits/deposit_preview');
        echo $formatedReceipt;
    }

    // AJAX
    //----------------------------------------------------------
    //  Dodavanje artikala u tablicu za kreiranje novog pologa
    //----------------------------------------------------------
    public function addItem()
    {
        $items = explode(",", $this->input->post('items')); //posto ajax vraca string potrebno splitati string sa zarezom da dobijemo polje
        $data = array();
        foreach ($items as $id)
        {
            $item = $this->item->get($id);
            array_push($data, $item);
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    // AJAX
    //-------------------
    //  Brisanje pologa
    //-------------------
    public function delete()
    {
        $transaction_number = $this->input->post('transaction_number');
        $result = $this->deposit->delete($transaction_number);

        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    //---------------------
    //  Kreira novi polog
    //---------------------
    public function create()
    {
        $session_data = $this->session->userdata('logged_in');
        $user_id = $session_data['id'];
        $this->deposit->create($user_id);

        redirect('/Deposits');
    }


    //----------------------
    //  Uredjivanje pologa
    //----------------------
    public function edit($id = null)
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $viewData['deposit'] = $this->deposit->get($id);
        $trans_id = (int)$viewData['deposit'][0]->trans_id;
        $trans_number = $viewData['deposit'][0]->transaction_number;

        $viewData['location'] = $this->user->getLocation($session_data['id']);
        $viewData['clients'] = $this->dbQueries->getClients(1);
        $viewData['query'] = $this->item->getItemsQuantity($trans_id);

        $headerscripts['header_scripts'] = array(
            '<link rel="stylesheet" href="'.base_url().'assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css">',
            '<link rel="stylesheet" href="'.base_url().'assets/plugins/datepicker/datepicker3.css">',
            '<link rel="stylesheet" href="'.base_url().'assets/plugins/select2/select2.css">',
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/plugins/datepicker/bootstrap-datepicker.js"></script>',
            '<script src="'.base_url().'assets/appjs/datepicker.js"></script>',
            '<script src="'.base_url().'assets/plugins/bootbox/bootbox.min.js"></script>',
            '<script src="'.base_url().'assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js"></script>',
            '<script src="'.base_url().'assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.hr-HR.js"></script>',
            '<script src="'.base_url().'assets/appjs/Deposits/deposits.js"></script>',
            '<script src="'.base_url().'assets/appjs/Deposits/editDepositss.js"></script>'
        );

        $viewData['depositData'] = $this->deposit->getData($trans_id, $trans_number);
        $viewData['maxQuantity'] = $this->modelHelper->returnMaxQuantity(1, $trans_id);
        $viewData['company'] = $this->dbQueries->getCompanyInfo();

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Deposits/edit_view');
    }

    public function update()
    {
        // echo "<h1>UPDATE </h1>";
        $session_data = $this->session->userdata('logged_in');
        $user_id = $session_data['id'];
        $this->deposit->update($user_id);

        redirect('/Deposits');
    }

    //--------------------
    //  Printanje pologa
    //--------------------
    public function printDeposit($id = null)
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $headerscripts['header_scripts'] = array();
        $footerscripts['footer_scripts'] = array();

        // echo var_dump($data);

        //$depositData[] =
        $viewData['deposit'] = $this->deposit->get($id);

        $trans_id = (int)$viewData['deposit'][0]->trans_id;
        $trans_number = $viewData['deposit'][0]->transaction_number;

        $viewData['depositData'] = $this->deposit->getData($trans_id, $trans_number);
        $viewData['maxQuantity'] = $this->modelHelper->returnMaxQuantity(1, $trans_id);
        $viewData['company'] = $this->dbQueries->getCompanyInfo();
        // array_push($this->deposit->getReceiptData($id), $viewData['deposit']);

        $this->load_print_view($headerscripts, $footerscripts, $data, $viewData, 'Print/deposit_print_view');
    }

    //----------------------------------
    //  Generira pdf pologa za download
    //----------------------------------
    public function generatePDF($id = null)
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $headerscripts['header_scripts'] = array();
        $footerscripts['footer_scripts'] = array();

        $viewData['deposit'] = $this->deposit->get($id);

        $trans_id = (int)$viewData['deposit'][0]->trans_id;
        $trans_number = $viewData['deposit'][0]->transaction_number;

        $viewData['depositData'] = $this->deposit->getData($trans_id, $trans_number);
        $viewData['maxQuantity'] = $this->modelHelper->returnMaxQuantity(1, $trans_id);
        $viewData['company'] = $this->dbQueries->getCompanyInfo();

        $snappy = new Pdf('C:/wkhtmltopdf/bin/wkhtmltopdf');
        $PDF = $this->return_print_view($headerscripts, $footerscripts, $data, $viewData, 'Print/deposit_print_view');

        $filename = "Primka_".$id;
        header("Content-Type: application/pdf");
        header("Content-Disposition: attachment; filename=$filename.pdf");
        echo $snappy->getOutputFromHtml($PDF);
    }
}
