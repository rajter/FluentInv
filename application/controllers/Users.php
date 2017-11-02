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
        $viewData['query'] = $this->user->getAll();

        if(!$this->user->checkIfAdmin())
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

            $this->load_views($headerscripts, $footerscripts, $viewData, 'Users/users_view');
        }
    }

    //----------------------------
    //  Novi Korisnik
    //----------------------------
    public function newUser()
    {
        $headerscripts['header_scripts'] = array(
            ''
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/appjs/Users/users.js"></script>'
        );

        // Samo Admin moze mjenjat i kreirat nove usere
        if(!$this->user->checkIfAdmin())
        {
            redirect('/home');
        }
        else
        {
            $viewData['avatars'] = $this->dbQueries->getAvatarImages();
            $viewData['userTypes'] = $this->dbQueries->getUserTypes();
            $this->load_views($headerscripts, $footerscripts, $viewData, 'Users/newUser_view');
        }
    }

    //----------------------------
    //  Kreira novog korisnika
    //----------------------------
    public function create()
    {
        $headerscripts['header_scripts'] = array(
            ''
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/appjs/Users/users.js"></script>'
        );

        // Samo Admin moze mjenjat i kreirat nove usere
        if(!$this->user->checkIfAdmin())
        {
            redirect('/home');
        }
        else
        {
            $viewData['empty'] = '';

            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('avatar', 'Avatar', 'trim|required');
            $this->form_validation->set_rules('name', 'Ime', 'trim|required');
            $this->form_validation->set_rules('username', 'Ime', 'trim|required');
            $this->form_validation->set_rules('surname', 'Prezime', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('username', 'KorisnickoIme', 'trim|required');
            $this->form_validation->set_rules('password', 'Lozinka', 'trim|required');
            $this->form_validation->set_rules('user_type', 'Tip Korisnika', 'trim|required');

            if ($this->form_validation->run() === FALSE)
            {
                $viewData['avatars'] = $this->dbQueries->getAvatarImages();
                $viewData['userTypes'] = $this->dbQueries->getUserTypes();
                $this->load_views($headerscripts, $footerscripts, $viewData, 'Users/newUser_view');
            }
            else
            {
                $this->user->create(); //Kreira novog zaposlenika, informacije se dobivaju iz POST metode servera

                redirect('/users');
            }
        }

    }

    //----------------------------
    //  Uredjivanje korisnika
    //----------------------------
    public function edit($id = null)
    {
        // Samo Admin moze mjenjat i kreirat nove usere
        if(!$this->user->checkIfAdmin())
        {
            redirect('/home');
        }
        else
        {
            $headerscripts['header_scripts'] = array('');
            $footerscripts['footer_scripts'] = array(
                '<script src="'.base_url().'assets/appjs/Users/users.js"></script>'
            );

            $viewData['avatars'] = $this->dbQueries->getAvatarImages();
            $viewData['userTypes'] = $this->dbQueries->getUserTypes();
            $viewData['user'] = $this->user->get($id);
            $this->load_views($headerscripts, $footerscripts, $viewData, 'Users/edit_view');
        }
    }

    //-----------------------------------
    //  Spremanje promjena na korisniku
    //-----------------------------------
    public function update()
    {
        $headerscripts['header_scripts'] = array(
            ''
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/appjs/Users/users.js"></script>'
        );

        // Samo Admin moze mjenjat i kreirat nove usere
        if(!$this->user->checkIfAdmin())
        {
            redirect('/home');
        }
        else
        {
            $viewData['empty'] = '';

            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('avatar', 'Avatar', 'trim|required');
            $this->form_validation->set_rules('name', 'Ime', 'trim|required');
            $this->form_validation->set_rules('username', 'Ime', 'trim|required');
            $this->form_validation->set_rules('surname', 'Prezime', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('username', 'KorisnickoIme', 'trim|required');
            // $this->form_validation->set_rules('password', 'Lozinka', 'trim|required');
            $this->form_validation->set_rules('user_type', 'Tip Korisnika', 'trim|required');

            if ($this->form_validation->run() === FALSE)
            {
                $viewData['avatars'] = $this->dbQueries->getAvatarImages();
                $viewData['userTypes'] = $this->dbQueries->getUserTypes();
                $id = $this->input->post('id');
                $viewData['user'] = $this->user->get($id);
                $this->load_views($headerscripts, $footerscripts, $viewData, 'Users/edit_view');
            }
            else
            {
                //Uredjuje se postojeci korisnik, informacije se dobivaju iz POST metode servera
                $this->user->update();

                redirect('/users');
            }
        }
    }

    public function view($id)
    {
        $headerscripts['header_scripts'] = array();
        $footerscripts['footer_scripts'] = array();

        $viewData['user'] = $this->user->get($id);

        $this->load_views($headerscripts, $footerscripts, $viewData, 'Users/view');
    }

    //----------------------------
    //  Brise Korisnika
    //----------------------------
    public function delete()
    {
        // Samo Admin moze brisat i kreirat nove usere
        if(!$this->user->checkIfAdmin())
        {
            redirect('/home');
        }
        else
        {
            $this->user->delete();
            redirect('/users');
        }
    }

    //----------------------------
    //  Resetira password usera
    //----------------------------
    public function resetPassword()
    {
        // Samo Admin moze brisat i kreirat nove usere
        if(!$this->user->checkIfAdmin())
        {
            redirect('/home');
        }
        else
        {
            $userId = $this->input->post('user-id');
            $data['data'] = $this->user->resetPassword($userId);

            echo json_encode($data['data'], JSON_UNESCAPED_UNICODE);
        }
    }
}
