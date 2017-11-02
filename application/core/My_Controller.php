<?php
class MY_Controller extends CI_Controller {

    public function __construct()
    {
        // Execute CI_Controller Constructor
        parent::__construct();

        if($this->session->userdata('logged_in'))
        {
             $session_data = $this->session->userdata('logged_in');
        }
        else
        {
             //If no session, redirect to login page
             redirect('login', 'refresh');
        }
    }

    public function load_views($headerscripts, $footerscripts, $viewData, $viewName)
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];
        $data['userImage'] = $session_data['userImage'];

        array_push($headerscripts['header_scripts'],
            '<link rel="stylesheet" href="'.base_url().'assets/css/Alertify/alertify.css">',
            '<link rel="stylesheet" href="'.base_url().'assets/css/Alertify/bootstrap.css">');

        array_push($footerscripts['footer_scripts'],
            '<script src="'.base_url().'assets/js/alertify.js"></script>',
            '<script src="'.base_url().'assets/appjs/alert.js"></script>',
            '<script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>',
            '<script src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>',
            '<script src="'.base_url().'assets/appjs/tableinit.js"></script>');

        $this->load->view('templates/app_head_view', $headerscripts);
        $this->load->view('templates/app_menu_view', $data);
        $this->load->view($viewName, $viewData);
        $this->load->view('templates/app_footer_view', $footerscripts);
    }

    public function displayMessage()
    {
        echo "<h1>Display message!</h1>";
    }

    public function load_print_view($headerscripts, $footerscripts, $viewData, $viewName)
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];
        $data['userImage'] = $session_data['userImage'];

        array_push($footerscripts['footer_scripts'],
            '<script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>',
            '<script src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>',
            '<script src="'.base_url().'assets/appjs/tableinit.js"></script>');

        $this->load->view('Print/app_head_view', $headerscripts);
        $this->load->view($viewName, $viewData);
        $this->load->view('Print/app_footer_view', $footerscripts);
    }

    public function return_print_view($headerscripts, $footerscripts, $data, $viewData, $viewName)
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];
        $data['userImage'] = $session_data['userImage'];

        array_push($footerscripts['footer_scripts'],
            '<script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>',
            '<script src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>',
            '<script src="'.base_url().'assets/appjs/tableinit.js"></script>');

        $header = $this->load->view('Print/app_head_view', $headerscripts, true);
        $view = $this->load->view($viewName, $viewData, true);
        $footer = $this->load->view('Print/app_footer_view', $footerscripts, true);
        return $header.$view.$footer;
    }
}

?>
