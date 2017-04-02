<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*Template contoler
*/
class Clients extends My_Controller {

    function __construct()
     {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper(array("form", "security", "date"));
        $this->load->model(array('client', 'dbQueries'));
     }

    public function index()
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];
        $viewData['clients'] = $this->client->getAll();

        $headerscripts['header_scripts'] = array(
            '<script src="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css"></script> '
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/appjs/Clients/clients.js"></script>'
        );

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Clients/clients_view');
    }

    //------------
    //  Novi Klijent
    //------------
    public function newClient()
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $viewData['clientTypes'] = $this->dbQueries->getClientTypes();

        $headerscripts['header_scripts'] = array(
            '<link rel="stylesheet" href="'.base_url().'assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css">',
            '<link rel="stylesheet" href="'.base_url().'assets/plugins/datepicker/datepicker3.css">',
            '<link rel="stylesheet" href="'.base_url().'assets/plugins/select2/select2.css">',
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/plugins/bootbox/bootbox.min.js"></script>',
            '<script src="'.base_url().'assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js"></script>',
            '<script src="'.base_url().'assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.hr-HR.js"></script>'
        );

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Clients/new_client_view');
    }


    //------------
    //  Kreiranje novog klijenta
    //------------
    public function create()
    {
        $session_data = $this->session->userdata('logged_in');
        $user_id = $session_data['id'];
        $this->client->create($user_id);

        redirect('/clients');
    }

    //--------------------
    //  Uredjivanje klijenta
    //--------------------
    public function edit($id=null)
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];
        $viewData['clientTypes'] = $this->dbQueries->getClientTypes();
        $viewData['client'] = $this->client->get($id);

        $headerscripts['header_scripts'] = array(
            '<link rel="stylesheet" href="'.base_url().'assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css">',
            '<link rel="stylesheet" href="'.base_url().'assets/plugins/datepicker/datepicker3.css">',
            '<link rel="stylesheet" href="'.base_url().'assets/plugins/select2/select2.css">',
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/plugins/bootbox/bootbox.min.js"></script>',
            '<script src="'.base_url().'assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js"></script>',
            '<script src="'.base_url().'assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.hr-HR.js"></script>'
        );

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Clients/edit_client_view');
    }

    //------------
    //  Uredjivanje klijenta
    //------------
    public function update()
    {
        $session_data = $this->session->userdata('logged_in');
        $user_id = $session_data['id'];
        $this->client->update($user_id);

        redirect('/clients');
    }

    //------------
    //  Brise klijenta
    //------------
    public function delete()
    {
        $id = $this->input->post('id');
        $result = $this->client->delete($id);

        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }
}
