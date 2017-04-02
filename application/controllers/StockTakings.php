<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Knp\Snappy\Pdf;

//----------------------
//  INVENTURE
//----------------------
class StockTakings extends My_Controller {

    function __construct()
     {
       parent::__construct();
       $this->load->helper('url');
       $this->load->helper(array("form", "security", "date"));
       $this->load->model(array('item', 'stock', 'stockTaking', 'dbQueries', 'modelHelper'));
     }

    //---------------------------
    //  Prikazuje sve inventure
    //---------------------------
    public function index()
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];
        $viewData['stock_takings'] = $this->stockTaking->getAll();

        $headerscripts['header_scripts'] = array(
            '<script src="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css"></script> '
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/appjs/StockTakings/stockTakings.js"></script>'
        );

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'StockTakings/stock_takings_view');
    }

    //----------------------
    //  Nova inventura
    //----------------------
    public function newStockTaking()
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];
        $viewData['items'] = $this->item->getAll();
        $viewData['locations'] = $this->dbQueries->getLocations();

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
            '<script src="'.base_url().'assets/appjs/StockTakings/stockTakings.js"></script>',
        );

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'StockTakings/new_stock_taking_view');
    }

    //----------------------------
    //  Kreiranje nove inventure
    //----------------------------
    public function create()
    {
        // echo "Kreirana nova inventura.";
        $session_data = $this->session->userdata('logged_in');
        $user_id = $session_data['id'];
        $this->stockTaking->create($user_id);

        redirect('/StockTakings');
    }

    public function edit($id=null)
    {
        $locked = $this->stockTaking->checkIfLocked($id);
        if(!$locked)
        {

            $session_data = $this->session->userdata('logged_in');
            $data['id'] = $session_data['id'];
            $data['username'] = $session_data['username'];
            $viewData['items'] = $this->item->getAll();
            $viewData['locations'] = $this->dbQueries->getLocations();
            $viewData['stock_taking'] = $this->stockTaking->get($id);
            $viewData['itemStocks'] = $this->stockTaking->getItemQuantities($viewData['stock_taking']->id);
            $viewData['itemCorrectionStocks'] = $this->stockTaking->getCorrectionQuantities($viewData['stock_taking']->id);

            $headerscripts['header_scripts'] = array(
                '<link rel="stylesheet" href="'.base_url().'assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css">',
                '<link rel="stylesheet" href="'.base_url().'assets/plugins/datepicker/datepicker3.css">',
                '<link rel="stylesheet" href="'.base_url().'assets/plugins/select2/select2.css">',
            );

            $footerscripts['footer_scripts'] = array(
                '<script src="'.base_url().'assets/plugins/bootbox/bootbox.min.js"></script>',
                '<script src="'.base_url().'assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js"></script>',
                '<script src="'.base_url().'assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.hr-HR.js"></script>',
                '<script src="'.base_url().'assets/appjs/StockTakings/stockTakings.js"></script>'
            );

            $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'StockTakings/edit_stock_taking_view');
        }
        else
        {
            redirect('/StockTakings');
        }
    }

    //----------------------------
    //  Zakljucavanje inventure
    //----------------------------
    public function lock($id = null)
    {
        $locked = $this->stockTaking->checkIfLocked($id);
        if(!$locked)
        {
            $session_data = $this->session->userdata('logged_in');
            $data['id'] = $session_data['id'];
            $data['username'] = $session_data['username'];
            $viewData['items'] = $this->item->getAll();
            $viewData['locations'] = $this->dbQueries->getLocations();
            $viewData['stock_taking'] = $this->stockTaking->get($id);
            $viewData['itemStocks'] = $this->stockTaking->getItemQuantities($viewData['stock_taking']->id);
            $viewData['itemCorrectionStocks'] = $this->stockTaking->getCorrectionQuantities($viewData['stock_taking']->id);

            $headerscripts['header_scripts'] = array(
                '<link rel="stylesheet" href="'.base_url().'assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css">',
                '<link rel="stylesheet" href="'.base_url().'assets/plugins/datepicker/datepicker3.css">',
                '<link rel="stylesheet" href="'.base_url().'assets/plugins/select2/select2.css">',
            );

            $footerscripts['footer_scripts'] = array(
                '<script src="'.base_url().'assets/plugins/bootbox/bootbox.min.js"></script>',
                '<script src="'.base_url().'assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js"></script>',
                '<script src="'.base_url().'assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.hr-HR.js"></script>',
                '<script src="'.base_url().'assets/appjs/StockTakings/stockTakings.js"></script>'
            );

            $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'StockTakings/lock_stock_taking_view');
        }
        else
        {
            redirect('/StockTakings');
        }

    }

    //---------------------------------------
    //  Zavrsava sa zakljucavanje inventure
    //---------------------------------------
    public function finishLock()
    {
        $session_data = $this->session->userdata('logged_in');
        $user_id = $session_data['id'];
        $this->stockTaking->lock($user_id);

        redirect('/StockTakings');
    }

    //----------------------
    //  Brise inventuru
    //----------------------
    public function delete()
    {
        $id = $this->input->post('id');
        $result = $this->stockTaking->delete($id);

        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    //-----------------------------
    //  Sprema promjene inventure
    //-----------------------------
    public function update()
    {
        $session_data = $this->session->userdata('logged_in');
        $user_id = $session_data['id'];
        $this->stockTaking->update($user_id);

        redirect('/StockTakings');
    }

    //-------------
    //  Printanje
    //-------------
    public function printStockTaking($id = null)
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];
        $viewData['company'] = $this->dbQueries->getCompanyInfo();
        $viewData['items'] = $this->item->getAll();
        $viewData['locations'] = $this->dbQueries->getLocations();
        $viewData['stock_taking'] = $this->stockTaking->get($id);
        $viewData['itemStocks'] = $this->stockTaking->getItemQuantities($viewData['stock_taking']->id);
        $viewData['itemCorrectionStocks'] = $this->stockTaking->getCorrectionQuantities($viewData['stock_taking']->id);

        $headerscripts['header_scripts'] = array(
            // '<link rel="stylesheet" href="'.base_url().'assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css">',
            // '<link rel="stylesheet" href="'.base_url().'assets/plugins/datepicker/datepicker3.css">',
            // '<link rel="stylesheet" href="'.base_url().'assets/plugins/select2/select2.css">',
        );

        $footerscripts['footer_scripts'] = array(
            // '<script src="'.base_url().'assets/plugins/bootbox/bootbox.min.js"></script>',
            // '<script src="'.base_url().'assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js"></script>',
            // '<script src="'.base_url().'assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.hr-HR.js"></script>',
            // '<script src="'.base_url().'assets/appjs/StockTakings/stockTakings.js"></script>'
        );

        $this->load_print_view($headerscripts, $footerscripts, $data, $viewData, 'Print/stockTaking_print_view');
    }

    //----------------------------
    //  Generira pdf za download
    //----------------------------
    // public function generatePDF($id = null)
    // {
    //     $session_data = $this->session->userdata('logged_in');
    //     $data['id'] = $session_data['id'];
    //     $data['username'] = $session_data['username'];
    //
    //     $headerscripts['header_scripts'] = array();
    //     $footerscripts['footer_scripts'] = array();
    //
    //     $viewData['receipt'] = $this->receipt->get($id);
    //
    //     $trans_id = (int)$viewData['receipt'][0]->trans_id;
    //     $trans_number = $viewData['receipt'][0]->transaction_number;
    //
    //     $viewData['receiptData'] = $this->receipt->getData($trans_id, $trans_number);
    //     $viewData['maxQuantity'] = $this->modelHelper->returnMaxQuantity(1, $trans_id);
    //     $viewData['company'] = $this->dbQueries->getCompanyInfo();
    //
    //     $snappy = new Pdf('C:/wkhtmltopdf/bin/wkhtmltopdf');
    //     $PDF = $this->return_print_view($headerscripts, $footerscripts, $data, $viewData, 'Print/receipt_print_view');
    //
    //     $filename = "Primka_".$id;
    //     header("Content-Type: application/pdf");
    //     header("Content-Disposition: attachment; filename=$filename.pdf");
    //     echo $snappy->getOutputFromHtml($PDF);
    // }
}
