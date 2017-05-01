<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper(array("form", "security", "date"));
        $this->load->model(array('homeModel','item', 'dbQueries', 'modelHelper', 'stock'));
    }


    public function index()
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

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
        $viewData['receiptCount'] = $this->homeModel->getTransactionCount(1);
        $viewData['issueCount'] = $this->homeModel->getTransactionCount(2);
        $viewData['transferNoteCount'] = $this->homeModel->getTransactionCount(3);
        $viewData['latestTransactions'] = $this->homeModel->getLatestTransactions(10);
        $viewData['users'] = $this->homeModel->getUsers(10);

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'home_view');
    }


    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('home', 'refresh');
    }

    public function getChartData()
    {
        $date_array = getdate();
        $year = $date_array['year'];
        $month = $date_array['mon'];
        $day = $date_array['mday'];
        $hours = $date_array['hours'];
        $minutes = $date_array['minutes'];
        $seconds = $date_array['seconds'];

        $date = $year."-".$month."-".$day. " " . $hours . ":" . $minutes . ":" . $seconds;

        for ($i = 1; $i < ($month+1); $i++) {
            $primke = $this->stock->getTransactionCount(1, '2017', $i);
            $izdatnice = $this->stock->getTransactionCount(2, '2017', $i);
            $medjuskladisnice = $this->stock->getTransactionCount(3, '2017', $i);

            $viewData['trans'.$i] = array();
            array_push($viewData['trans'.$i], $primke);
            array_push($viewData['trans'.$i], $izdatnice);
            array_push($viewData['trans'.$i], $medjuskladisnice);
        }

        // var_dump($viewData);
        echo json_encode($viewData, JSON_UNESCAPED_UNICODE);
    }

}

?>
