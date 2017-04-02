<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*Employees contoler
*/
class Administrators extends My_Controller {

    function __construct()
     {
       parent::__construct();
       $this->load->helper('url');
       $this->load->helper(array("form", "security"));
       $this->load->model('employee');
     }

    public function index()
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];
        $data['query'] = $this->employee->getAll();
        //echo var_dump($data);

        $headerscripts['header_scripts'] = array(
            '<script src="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css"></script> '
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>',
            '<script src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>',
            '<script src="'.base_url().'assets/appjs/tableinit.js"></script>',
            '<script src="'.base_url().'assets/appjs/modals.js"></script>'
        );

        $this->load->view('templates/app_head_view', $headerscripts);
        $this->load->view('templates/app_menu_view', $data);
        $this->load->view('Employees/employees_view', $data);
        $this->load->view('templates/app_footer_view', $footerscripts);
    }

    public function newEmployee()
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $headerscripts['header_scripts'] = array(
            ''
        );

        $footerscripts['footer_scripts'] = array(
            ''
        );

        $this->load->view('templates/app_head_view', $headerscripts);
        $this->load->view('templates/app_menu_view', $data);
        $this->load->view('Employees/newemployee_view');
        $this->load->view('templates/app_footer_view', $footerscripts);
    }

    public function create()
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $headerscripts['header_scripts'] = array(
            ''
        );

        $footerscripts['footer_scripts'] = array(
            ''
        );

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Ime', 'required');
        $this->form_validation->set_rules('surname', 'Prezime', 'required');

        $data['newEmployee'] = $this->input->post('username');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/app_head_view', $headerscripts);
            $this->load->view('templates/app_menu_view', $data);
            $this->load->view('Employees/newemployee_view');
            $this->load->view('templates/app_footer_view', $footerscripts);
        }
        else
        {
            $this->employee->create(); //Kreira novog zaposlenika, informacije se dobivaju iz POST metode servera

            $this->load->view('templates/app_head_view', $headerscripts);
            $this->load->view('templates/app_menu_view', $data);
            $this->load->view('Employees/created_view', $data);
            $this->load->view('templates/app_footer_view', $footerscripts);
        }

    }

    public function delete()
    {
        $this->employee->delete();
        redirect('/employees');
    }

    public function edit($id = null)
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $headerscripts['header_scripts'] = array(
            ''
        );

        $footerscripts['footer_scripts'] = array(
            ''
        );

        $employee = $this->employee->get($id);

        //var_dump($employee);
        //echo $employee->name;
        $this->load->view('templates/app_head_view', $headerscripts);
        $this->load->view('templates/app_menu_view', $data);
        $this->load->view('Employees/edit_view', $employee);
        $this->load->view('templates/app_footer_view', $footerscripts);
    }

    public function update()
    {
        $this->employee->update();
        redirect('/employees');
    }
}
