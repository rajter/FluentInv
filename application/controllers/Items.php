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
        $viewData['query'] = $this->item->getAll();

        $headerscripts['header_scripts'] = array();

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/appjs/Items/modals.js"></script>',
            '<script src="'.base_url().'assets/appjs/Items/deleteItem.js"></script>'
        );

        $this->load_views($headerscripts, $footerscripts, $viewData, 'Items/items_view');
    }

    //---------------------
    //  Vraca sve artikle
    //---------------------
    public function view($id = null)
    {
        $headerscripts['header_scripts'] = array();
        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/appjs/Items/viewItem.js"></script>'
        );

        $viewData['item'] = $this->item->get($id);

        // Vrati sve duznike za artikl
        $viewData['debtor'] = $this->item->getDebtors($id);
        $viewData['transactions'] = $this->item->getTransactions($id, 10);        

        $this->load_views($headerscripts, $footerscripts, $viewData, 'Items/view');
    }

    public function newItem()
    {
        $headerscripts['header_scripts'] = array(
            '<link rel="stylesheet" href="'.base_url().'assets/css/dropzone.css">'
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/appjs/barcode.js"></script>',
            '<script src="'.base_url().'assets/appjs/dropzone.js"></script>',
            '<script src="'.base_url().'assets/appjs/Items/newItem.js"></script>'
        );

        $types = $this->dbQueries->getItemTypes();
        $viewData['types'] = $types;

        $this->load_views($headerscripts, $footerscripts, $viewData, 'Items/new_item_view');
    }

    //----------------------------
    //  Kreira novi artikl
    //----------------------------
    public function create()
    {
        $headerscripts['header_scripts'] = array('<link rel="stylesheet" href="'.base_url().'assets/css/dropzone.css">');

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/appjs/barcode.js"></script>',
            '<script src="'.base_url().'assets/appjs/dropzone.js"></script>',
            '<script src="'.base_url().'assets/appjs/Items/newItem.js"></script>'
        );

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Ime', 'trim|required');
        $this->form_validation->set_rules('price', 'Cijena', 'required');
        $this->form_validation->set_rules('item_type_id', 'Tip', 'required');
        $this->form_validation->set_rules('code', 'Kod', 'trim|required');

        if ($this->form_validation->run() === FALSE)
        {
            $alertData = array(
                'id' => 'alertData',
                'data-alerttype' => 'error',
                'data-alert' => 'Greška kod kreiranja artikla!',
                'class' => 'hidden'
            );

            $viewData['alert'] = form_input($alertData);
            $types = $this->dbQueries->getItemTypes();
            $viewData['types'] = $types;

            $this->load_views($headerscripts, $footerscripts, $viewData, 'Items/new_item_view');
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

            redirect('/items');
        }
    }

    public function edit($id = null)
    {
        $headerscripts['header_scripts'] = array(
            '<link rel="stylesheet" href="'.base_url().'assets/css/dropzone.css">'
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/appjs/barcode.js"></script>',
            '<script src="'.base_url().'assets/appjs/dropzone.js"></script>',
            '<script src="'.base_url().'assets/appjs/Items/editItem.js"></script>'
        );

        $item = $this->item->get($id);
        $types = $this->dbQueries->getItemTypes();
        $viewData = array("item" => $item, "types" => $types );

        $this->load_views($headerscripts, $footerscripts, $viewData, 'Items/edit_view');
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

    public function getItemFromCode()
    {
        $code = $this->input->post('code');
        $item['data'] = $this->item->getFromCode($code);

        echo json_encode($item['data'], JSON_UNESCAPED_UNICODE);
    }

    public function checkCode()
    {
        $code = $this->input->get('code');
        $trans['data'] = $this->item->CheckCodeForDuplicate($code);

        echo json_encode($trans['data'], JSON_UNESCAPED_UNICODE);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $result = $this->item->delete($id);

        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function changeStatus()
    {
        $id = $this->input->post('id');
        $result = $this->item->changeStatus($id);

        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }


}
