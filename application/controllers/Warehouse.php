<?php
/**
 * Date: 15.7.2016.
 * Time: 18:49
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse extends My_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper(array("form", "security", "date"));
        $this->load->model(array('item', 'receipt', 'dbQueries', 'modelHelper'));
    }

    public function index()
    {

    }

    /*
    *   STANJE ZALIHA
    */
    public function stocks()
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];
        $viewData[] = null;
        // $viewData['query'] = $this->warehouse->getStocks();
        $viewData['locations'] = $this->dbQueries->getLocations();

        $headerscripts['header_scripts'] = array(
            '<script src="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css"></script>',
            '<link rel="stylesheet" href="'.base_url().'assets/plugins/datepicker/datepicker3.css">',
            '<link rel="stylesheet" href="'.base_url().'assets/plugins/select2/select2.css">',
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/plugins/datepicker/bootstrap-datepicker.js"></script>',
            '<script src="'.base_url().'assets/appjs/datepicker.js"></script>',
            '<script src="'.base_url().'assets/appjs/Receipts/stocks.js"></script>',
            '<script src="'.base_url().'assets/appjs/modals.js"></script>'
        );

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Warehouse/stocks_view');
    }

}
