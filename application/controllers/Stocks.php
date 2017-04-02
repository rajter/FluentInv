<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stocks extends My_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper(array("form", "security", "date"));
        $this->load->model(array('item', 'receipt', 'issue', 'stock', 'dbQueries', 'modelHelper'));
    }

    public function index()
    {
        echo "Stocks";
    }

    /*
    *   STANJE ZALIHA
    */
    public function viewStocks($locationId = 1)
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];
        $viewData[] = null;
        $this->stock->getLastDateOfStockCounting($locationId);
        $viewData['itemStocks'] = $this->stock->getItemStocks($locationId);
        $viewData['itemStockCount'] = $this->stock->getLastStockTakingItemCount($locationId);
        $viewData['itemEntrance'] = $this->stock->getTotalItemCount(1, $locationId);
        $viewData['itemExits'] = $this->stock->getTotalItemCount(2, $locationId);
        $viewData['itemToLocationsTransfers'] = $this->stock->getTotalItemCount(3, $locationId);
        $viewData['itemFromLocationsTransfers'] = $this->stock->getTotalItemCount(3, $locationId, FALSE);
        $viewData['locations'] = $this->dbQueries->getLocations();

        $headerscripts['header_scripts'] = array(
            '<script src="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css"></script>',
            '<link rel="stylesheet" href="'.base_url().'assets/plugins/datepicker/datepicker3.css">',
            '<link rel="stylesheet" href="'.base_url().'assets/plugins/select2/select2.css">',
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/plugins/datepicker/bootstrap-datepicker.js"></script>',
            '<script src="'.base_url().'assets/appjs/datepicker.js"></script>',
            '<script src="'.base_url().'assets/appjs/Stocks/stocks.js"></script>',
            '<script src="'.base_url().'assets/appjs/modals.js"></script>'
        );

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Stocks/stocks_view');
    }

}
