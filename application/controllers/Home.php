<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper(array("form", "security", "date"));
        $this->load->model(array('homeModel','item', 'dbQueries', 'modelHelper'));
    }


    public function index()
    {
        $headerscripts['header_scripts'] = array(
                '<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>',
                '<link rel="stylesheet" href="'.base_url().'assets/plugins/datepicker/datepicker3.css">',
                '<link rel="stylesheet" href="'.base_url().'assets/plugins/daterangepicker/datereangepicker-bs3.css">'
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/appjs/home.js"></script>',
            '<script src="'.base_url().'assets/plugins/daterangepicker/daterangepicker.js"></script>',
            '<script src="'.base_url().'assets/plugins/datepicker/bootstrap-datepicker.js"></script>'
        );

        $viewData['itemCount'] = $this->homeModel->getItemCount();
        $viewData['freeItemsCount'] = $this->homeModel->getFreeItemCount();
        $viewData['issuedItemCount'] = $this->homeModel->getIssuedItemCount();
        $viewData['canceledItemCount'] = $this->homeModel->getCanceledItemCount();
        $viewData['latestTransactions'] = $this->homeModel->getLatestTransactions(10);
        $viewData['users'] = $this->homeModel->getUsers(10);

        $this->load_views($headerscripts, $footerscripts, $viewData, 'home_view');
    }


    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('home', 'refresh');
    }

    public function getChartData()
    {
        // var_dump($viewData);

        $chartData = $this->homeModel->getMonthlyTransactions();
        echo json_encode($chartData, JSON_UNESCAPED_UNICODE);

        // echo json_encode($viewData, JSON_UNESCAPED_UNICODE);
    }

}

?>
