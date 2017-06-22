<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*Users contoler
*/
class Users extends My_Controller {

    function __construct()
     {
       parent::__construct();
       $this->load->helper('url');
       $this->load->helper(array("form", "security"));
       $this->load->model(array('user', 'dbQueries'));
     }

    public function index()
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];
        $data['query'] = $this->user->getAll();

        if(!$this->user->checkIfAdmin($data['id']))
        {
            redirect('/home');
        }
        else
        {
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
            $this->load->view('Users/users_view', $data);
            $this->load->view('templates/app_footer_view', $footerscripts);
        }
    }

    public function newUser()
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];
        $viewdata['locations'] = $this->dbQueries->getLocations();
        $viewdata['userTypes'] = $this->dbQueries->getUserTypes();

        $headerscripts['header_scripts'] = array(
            ''
        );

        $footerscripts['footer_scripts'] = array(
            ''
        );

        // Samo Admin moze mjenjat i kreirat nove usere
        if(!$this->user->checkIfAdmin($data['id']))
        {
            redirect('/home');
        }
        else
        {
            $this->load->view('templates/app_head_view', $headerscripts);
            $this->load->view('templates/app_menu_view', $data);
            $this->load->view('Users/newUser_view', $viewdata);
            $this->load->view('templates/app_footer_view', $footerscripts);
        }
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

        // Samo Admin moze mjenjat i kreirat nove usere
        if(!$this->user->checkIfAdmin($data['id']))
        {
            redirect('/home');
        }
        else
        {
            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('username', 'Ime', 'required');
            $this->form_validation->set_rules('surname', 'Prezime', 'required');

            $data['newUser'] = $this->input->post('username');

            if ($this->form_validation->run() === FALSE)
            {
                $this->load->view('templates/app_head_view', $headerscripts);
                $this->load->view('templates/app_menu_view', $data);
                $this->load->view('Users/newUser_view');
                $this->load->view('templates/app_footer_view', $footerscripts);
            }
            else
            {
                $this->user->create(); //Kreira novog zaposlenika, informacije se dobivaju iz POST metode servera

                $this->load->view('templates/app_head_view', $headerscripts);
                $this->load->view('templates/app_menu_view', $data);
                $this->load->view('Users/created_view', $data);
                $this->load->view('templates/app_footer_view', $footerscripts);
            }
        }

    }

    public function edit($id = null)
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];
        $viewdata['locations'] = $this->dbQueries->getLocations();
        $viewdata['userTypes'] = $this->dbQueries->getUserTypes();

        // Samo Admin moze mjenjat i kreirat nove usere
        if(!$this->user->checkIfAdmin($data['id']))
        {
            redirect('/home');
        }
        else
        {
            $headerscripts['header_scripts'] = array(
                ''
            );

            $footerscripts['footer_scripts'] = array(
                ''
            );

            // $user = $this->user->get($id);
            $viewdata['user'] = $this->user->get($id);
            //var_dump($user);
            //echo $user->name;
            $this->load->view('templates/app_head_view', $headerscripts);
            $this->load->view('templates/app_menu_view', $data);
            $this->load->view('Users/edit_view', $viewdata);
            $this->load->view('templates/app_footer_view', $footerscripts);
        }
    }

    public function update()
    {
        $this->user->update();
        redirect('/users');
    }

    public function view($id)
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $headerscripts['header_scripts'] = array();
        $footerscripts['footer_scripts'] = array();

        $viewData['user'] = $this->user->get($id);

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Users/view');
    }

    public function delete()
    {
        $this->user->delete();
        redirect('/users');
    }
}
