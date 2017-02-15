<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//----------------------
//  SKLADIŠTA
//----------------------
class Warehouses extends My_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper(array("form", "security", "date"));
        $this->load->model(array('item', 'receipt', 'issue', 'warehouse', 'stock', 'dbQueries', 'modelHelper'));
    }

    //----------------------
    //  INDEX - pregled svih skladišta
    //----------------------
    public function index()
    {
        $session_data = $this->session->userdata('logged_in');

        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $viewData['warehouses'] = $this->warehouse->getAll();

        $headerscripts['header_scripts'] = array();
        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/appjs/Warehouse/warehouse.js"></script>'
        );

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Warehouses/warehouses_view');

        // $locations = $this->warehouse->getAll();
        // echo var_dump($locations);
    }

    //----------------------
    //  Pregled pojedinog skladišta
    //----------------------
    public function view($id = null)
    {

    }

    //----------------------
    //  Novo skladište
    //----------------------
    public function newWarehouse()
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];
        $viewData['null'] = 'null';

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

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Warehouses/new_warehouse_view');
    }

    //----------------------
    //  Kreiranje novog skladišta
    //----------------------
    public function create()
    {
        $session_data = $this->session->userdata('logged_in');
        $user_id = $session_data['id'];
        $this->warehouse->create($user_id);

        redirect('/warehouses');
    }

    //----------------------
    //  Uređivanje skladišta
    //----------------------
    public function edit($id = null)
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];
        $viewData['warehouse'] = $this->warehouse->get($id);

        $headerscripts['header_scripts'] = array(
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/plugins/bootbox/bootbox.min.js"></script>'
        );

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Warehouses/edit_warehouse_view');
    }

    //----------------------
    //  Promjena podataka skladišta
    //----------------------
    public function update()
    {
        $session_data = $this->session->userdata('logged_in');
        $user_id = $session_data['id'];
        $this->warehouse->update($user_id);

        redirect('/warehouses');
    }

    //----------------------
    //  Brisanje skladišta
    //----------------------
    public function delete()
    {
        $id = $this->input->post('id');
        $result = $this->warehouse->delete($id);

        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }


}
