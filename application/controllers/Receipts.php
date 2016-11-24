<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Knp\Snappy\Pdf;

class Receipts extends My_Controller {

    function __construct()
     {
       parent::__construct();
       $this->load->helper('url');
       $this->load->helper(array("form", "security", "date"));
       $this->load->model(array('item', 'receipt', 'dbQueries', 'modelHelper'));
     }

     /*
     *  Prikazuje sve primke
     */
    public function index()
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];
        $viewData['query'] = $this->receipt->getAll();

        $headerscripts['header_scripts'] = array(
            '<script src="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css"></script> '
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/appjs/Receipts/receipts.js"></script>',
            '<script src="'.base_url().'assets/appjs/modals.js"></script>'
        );

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Receipts/receipt_view');
    }

    /*
    *   Nova primka
    */
    public function newReceipt()
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
            '<script src="'.base_url().'assets/appjs/Receipts/receipts.js"></script>',
        );

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Receipts/new_receipt_view');
    }

    /*
    *   Pregled odredjene primke
    */
    public function view($id = null)
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $headerscripts['header_scripts'] = array();
        $footerscripts['footer_scripts'] = array();

        $viewData['receipt'] = $this->receipt->get($id);

        $trans_id = (int)$viewData['receipt'][0]->trans_id;
        $trans_number = $viewData['receipt'][0]->transaction_number;

        $viewData['receiptData'] = $this->receipt->getData($trans_id, $trans_number);
        $viewData['maxQuantity'] = $this->modelHelper->returnMaxQuantity(1, $id);
        $viewData['company'] = $this->dbQueries->getCompanyInfo();

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Receipts/view');
    }

    //ajax called function
    /*
    *   Vraca podatke odredjene primke u pregledu primki
    */
    public function getReceiptInfo()
    {
        $trans_number = $this->input->get('transaction_number');
        $trans_id =  $this->receipt->get($trans_number)[0]->trans_id;   // vraca samo id transakcije prema transakcijskom broju
        $trans['data'] = $this->receipt->getData($trans_id, $trans_number);

        echo json_encode($trans['data'], JSON_UNESCAPED_UNICODE);
    }

    // ajax called function
    /*
    *   Dodavanje artikala u tablicu za kreiranje nove primke
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

    // ajax called function
    /*
    *   Brisanje primke
    */
    public function delete()
    {
        $transaction_number = $this->input->post('transaction_number');
        $result = $this->receipt->delete($transaction_number);

        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    /*
    *   Kreira novu primku
    */
    public function create()
    {
        $session_data = $this->session->userdata('logged_in');
        $user_id = $session_data['id'];
        $this->receipt->create($user_id);

        redirect('/Receipts');
    }


    public function edit($id = null)
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $headerscripts['header_scripts'] = array();
        $footerscripts['footer_scripts'] = array();

        // echo var_dump($data);

        //$receiptData[] =
        $viewData['receipt'] = $this->receipt->get($id);
        $viewData['receiptData'] = $this->receipt->getData($id);
        $viewData['maxQuantity'] = $this->modelHelper->returnMaxQuantity(1, $id);
        $viewData['company'] = $this->dbQueries->getCompanyInfo();
        // array_push($this->receipt->getReceiptData($id), $viewData['receipt']);

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Receipts/edit_view');
    }

    public function update()
    {
    }

    /*
    *   Printanje primke
    */
    public function printReceipt($id = null)
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $headerscripts['header_scripts'] = array();
        $footerscripts['footer_scripts'] = array();

        // echo var_dump($data);

        //$receiptData[] =
        $viewData['receipt'] = $this->receipt->get($id);

        $trans_id = (int)$viewData['receipt'][0]->trans_id;
        $trans_number = $viewData['receipt'][0]->transaction_number;

        $viewData['receiptData'] = $this->receipt->getData($trans_id, $trans_number);
        $viewData['maxQuantity'] = $this->modelHelper->returnMaxQuantity(1, $id);
        $viewData['company'] = $this->dbQueries->getCompanyInfo();
        // array_push($this->receipt->getReceiptData($id), $viewData['receipt']);

        $this->load_print_view($headerscripts, $footerscripts, $data, $viewData, 'Print/receipt_print_view');
    }

    /*
    *   Generira pdf primke za download
    */
    public function generatePDF($id = null)
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $headerscripts['header_scripts'] = array();
        $footerscripts['footer_scripts'] = array();

        $viewData['receipt'] = $this->receipt->get($id);

        $trans_id = (int)$viewData['receipt'][0]->trans_id;
        $trans_number = $viewData['receipt'][0]->transaction_number;

        $viewData['receiptData'] = $this->receipt->getData($trans_id, $trans_number);
        $viewData['maxQuantity'] = $this->modelHelper->returnMaxQuantity(1, $id);
        $viewData['company'] = $this->dbQueries->getCompanyInfo();

        $snappy = new Pdf('C:/wkhtmltopdf/bin/wkhtmltopdf');
        $PDF = $this->return_print_view($headerscripts, $footerscripts, $data, $viewData, 'Print/receipt_print_view');

        $filename = "Primka_".$id;
        header("Content-Type: application/pdf");
        header("Content-Disposition: attachment; filename=$filename.pdf");
        echo $snappy->getOutputFromHtml($PDF);
    }
}
