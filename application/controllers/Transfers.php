<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Knp\Snappy\Pdf;

class Transfers extends My_Controller {

    function __construct()
     {
       parent::__construct();
       $this->load->helper('url');
       $this->load->helper(array("form", "security", "date"));
       $this->load->model(array('item', 'transfer', 'dbQueries', 'modelHelper'));
     }

     /*
     *  Prikazuje sve medjuskladisnice
     */
    public function index()
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];
        $viewData['query'] = $this->transfer->getAll();

        $headerscripts['header_scripts'] = array(
            '<script src="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css"></script> '
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/appjs/Transfers/transfers.js"></script>',
            '<script src="'.base_url().'assets/appjs/modals.js"></script>'
        );

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Transfers/transfer_view');
    }

    /*
    *   Nova medjuskladisnica
    */
    public function newTransfer()
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];
        $viewData['query'] = $this->item->getAll();
        $viewData['locations'] = $this->dbQueries->getLocations();
        $viewData['clients'] = $this->dbQueries->getClients(1);

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
            '<script src="'.base_url().'assets/appjs/Transfers/transfers.js"></script>',
        );

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Transfers/new_transfer_view');
    }

    /*
    *   Pregled odredjene medjuskladisnice
    */
    public function view($id = null)
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $headerscripts['header_scripts'] = array();
        $footerscripts['footer_scripts'] = array();

        $viewData['transfer'] = $this->transfer->get($id);

        $trans_id = (int)$viewData['transfer'][0]->trans_id;
        $trans_number = $viewData['transfer'][0]->transaction_number;

        $viewData['transferData'] = $this->transfer->getData($trans_id, $trans_number);
        $viewData['maxQuantity'] = $this->modelHelper->returnMaxQuantity(1, $trans_id);
        $viewData['company'] = $this->dbQueries->getCompanyInfo();

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Transfers/view');
    }

    //ajax called function
    /*
    *   Vraca formatiran view odredjene medjuskladisnice u pregledu medjuskladisnica
    */
    public function getTransferInfo()
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $headerscripts['header_scripts'] = array();
        $footerscripts['footer_scripts'] = array();

        $id = $this->input->get('transaction_number');
        $viewData['transfer'] = $this->transfer->get($id);

        $trans_id = (int)$viewData['transfer'][0]->trans_id;
        $trans_number = $viewData['transfer'][0]->transaction_number;

        $viewData['transferData'] = $this->transfer->getData($trans_id, $trans_number);
        $viewData['maxQuantity'] = $this->modelHelper->returnMaxQuantity(3, $trans_id);
        $viewData['company'] = $this->dbQueries->getCompanyInfo();

        $formatedtransfer = $this->return_transaction_preview($data, $viewData, 'Transfers/transfer_preview');
        echo $formatedtransfer;
    }

    // AJAX
    /*
    *   Dodavanje artikala u tablicu za kreiranje nove medjuskladisnice
    */
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
    /*
    *   Brisanje medjuskladisnice
    */
    public function delete()
    {
        $transaction_number = $this->input->post('transaction_number');
        $result = $this->transfer->delete($transaction_number);

        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    /*
    *   Kreira novu medjuskladisnicu
    */
    public function create()
    {
        $session_data = $this->session->userdata('logged_in');
        $user_id = $session_data['id'];
        $this->transfer->create($user_id);

        redirect('/Transfers');
    }


    public function edit($id = null)
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $viewData['transfer'] = $this->transfer->get($id);
        $trans_id = (int)$viewData['transfer'][0]->trans_id;
        $trans_number = $viewData['transfer'][0]->transaction_number;

        $viewData['locations'] = $this->dbQueries->getLocations();
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
            '<script src="'.base_url().'assets/appjs/Transfers/transfers.js"></script>',
            '<script src="'.base_url().'assets/appjs/Transfers/editTransfers.js"></script>'
        );

        $viewData['transferData'] = $this->transfer->getData($trans_id, $trans_number);
        $viewData['maxQuantity'] = $this->modelHelper->returnMaxQuantity(3, $trans_id);
        $viewData['company'] = $this->dbQueries->getCompanyInfo();

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Transfers/edit_view');
    }

    public function update()
    {
        // echo "<h1>UPDATE </h1>";
        $session_data = $this->session->userdata('logged_in');
        $user_id = $session_data['id'];
        $this->transfer->update($user_id);

        redirect('/Transfers');
    }

    /*
    *   Printanje medjuskladisnice
    */
    public function printTransfer($id = null)
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $headerscripts['header_scripts'] = array();
        $footerscripts['footer_scripts'] = array();

        // echo var_dump($data);

        //$transferData[] =
        $viewData['transfer'] = $this->transfer->get($id);

        $trans_id = (int)$viewData['transfer'][0]->trans_id;
        $trans_number = $viewData['transfer'][0]->transaction_number;

        $viewData['transferData'] = $this->transfer->getData($trans_id, $trans_number);
        $viewData['maxQuantity'] = $this->modelHelper->returnMaxQuantity(1, $trans_id);
        $viewData['company'] = $this->dbQueries->getCompanyInfo();
        // array_push($this->transfer->gettransferData($id), $viewData['transfer']);

        $this->load_print_view($headerscripts, $footerscripts, $data, $viewData, 'Print/transfer_print_view');
    }

    /*
    *   Generira pdf medjuskladisnice za download
    */
    public function generatePDF($id = null)
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $headerscripts['header_scripts'] = array();
        $footerscripts['footer_scripts'] = array();

        $viewData['transfer'] = $this->transfer->get($id);

        $trans_id = (int)$viewData['transfer'][0]->trans_id;
        $trans_number = $viewData['transfer'][0]->transaction_number;

        $viewData['transferData'] = $this->transfer->getData($trans_id, $trans_number);
        $viewData['maxQuantity'] = $this->modelHelper->returnMaxQuantity(1, $trans_id);
        $viewData['company'] = $this->dbQueries->getCompanyInfo();

        $snappy = new Pdf('C:/wkhtmltopdf/bin/wkhtmltopdf');
        $PDF = $this->return_print_view($headerscripts, $footerscripts, $data, $viewData, 'Print/transfer_print_view');

        $filename = "Medjuskladisnica_".$id;
        header("Content-Type: application/pdf");
        header("Content-Disposition: attachment; filename=$filename.pdf");
        echo $snappy->getOutputFromHtml($PDF);
    }
}
