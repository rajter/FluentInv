<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends MY_Controller {

 function __construct()
 {
   parent::__construct();
 }

/**
 *Home site of the application
 */
 function index()
 {
    $session_data = $this->session->userdata('logged_in');
    $data['id'] = $session_data['id'];
    $data['username'] = $session_data['username'];

    $headerscripts['header_scripts'] = array(
            '<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>'
    );

    $footerscripts['footer_scripts'] = array(
        '<script src="'.base_url().'assets/appjs/charts.js"></script>'
    );

    $this->load->view('templates/app_head_view', $headerscripts);
    $this->load->view('templates/app_menu_view', $data);
    $this->load->view('home_view', $data);
    $this->load->view('templates/app_footer_view', $footerscripts);
 }

/**
 *
 */
function logout()
{
    $this->session->unset_userdata('logged_in');
    session_destroy();
    redirect('home', 'refresh');
}

}

?>
