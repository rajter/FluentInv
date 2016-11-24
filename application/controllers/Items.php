<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends My_Controller {

    function __construct()
     {
       parent::__construct();
       $this->load->helper(array('form', 'security', 'url'));
       $this->load->model(array('item', 'dbQueries'));
     }

    public function index()
    {
        $session_data = $this->session->userdata('logged_in');

        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $viewData['query'] = $this->item->getAll();

        $headerscripts['header_scripts'] = array();

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/appjs/Items/modals.js"></script>'
        );

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Items/items_view');
    }

    public function view($id = null)
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $headerscripts['header_scripts'] = array();
        $footerscripts['footer_scripts'] = array();

        $item = $this->item->get($id);

        $this->load_views($headerscripts, $footerscripts, $data, $item, 'Items/view');
    }

    public function newItem()
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $headerscripts['header_scripts'] = array(
            '<link rel="stylesheet" href="'.base_url().'assets/css/dropzone.css">'
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/appjs/barcode.js"></script>',
            '<script src="'.base_url().'assets/appjs/dropzone.js"></script>',
            '<script src="'.base_url().'assets/appjs/Items/newItem.js"></script>'
        );

        $types = $this->dbQueries->getItemTypes();
        $item_data = array("types" => $types);

        $this->load->view('templates/app_head_view', $headerscripts);
        $this->load->view('templates/app_menu_view', $data);
        $this->load->view('Items/new_Item_view', $item_data);
        $this->load->view('templates/app_footer_view', $footerscripts);
    }

    public function create()
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $headerscripts['header_scripts'] = array('');

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/appjs/tableinit.js"></script>',
            '<script src="'.base_url().'assets/appjs/modals.js"></script>'
        );

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Ime', 'required');
        $this->form_validation->set_rules('price', 'Cijena', 'required');
        $this->form_validation->set_rules('code', 'Kod', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $alertData = array(
                'id' => 'alertData',
                'data-alerttype' => 'error',
                'data-alert' => 'Greška kod kreiranja artikla!',
                'class' => 'hidden'
            );

            $viewData['alert'] = form_input($alertData);

            $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Items/new_item_view');
        }
        else
        {
            $this->item->create();
            $newItem = $this->input->post('name');
            $alertData = array(
                'id' => 'alertData',
                'data-alerttype' => 'success',
                'data-alert' => 'Uspješno kreiran artikl ' . $newItem,
                'class' => 'hidden'
            );

            $viewData['alert'] = form_input($alertData);

            $viewData['query'] = $this->item->getAll();

            $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Items/items_view');
        }
    }

    public function edit($id = null)
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $headerscripts['header_scripts'] = array(
            '<link rel="stylesheet" href="'.base_url().'assets/css/dropzone.css">'
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/appjs/Items/barcode.js"></script>',
            '<script src="'.base_url().'assets/appjs/dropzone.js"></script>',
            '<script src="'.base_url().'assets/appjs/Items/editItem.js"></script>'
        );

        $item = $this->item->get($id);
        $types = $this->dbQueries->getItemTypes();
        $viewData = array("item" => $item, "types" => $types );

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Items/edit_view');
    }

    public function update()
    {
        $this->item->update();
        redirect('/items');
    }

    public function upload()
    {
        if (!empty($_FILES)) {
           $tempFile = $_FILES['file']['tmp_name'];
           $fileName = preg_replace('/\s+/', '', $_FILES['file']['name']);  //$string = preg_replace('/\s+/','',$string); - removes tabs and spaces from string
           $targetPath = getcwd() . '/assets/dropzone/uploads/';
           $targetFile = $targetPath . $fileName ;
           move_uploaded_file($tempFile, $targetFile);
       }
    }

    public function checkCode()
    {
        $code = $this->input->get('code');
        $trans['data'] = $this->item->CheckCodeForDuplicate($code);

        echo json_encode($trans['data'], JSON_UNESCAPED_UNICODE);
    }

}
