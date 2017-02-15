<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*Template contoler
*/
class ItemTypes extends My_Controller {

    function __construct()
     {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper(array("form", "security", "date"));
        $this->load->model(array('item'));
     }

    public function index()
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];
        $viewData['item_types'] = $this->item->getAllTypes();

        $headerscripts['header_scripts'] = array(
            '<script src="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css"></script> '
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/appjs/Items/modals.js"></script>'
        );

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Items/item_type_view');
    }

    //------------
    //  Novi Tip
    //------------
    public function newItemType()
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

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Items/new_item_type_view');
    }


    //------------
    //  Kreiranje novog tipa
    //------------
    public function createItemType()
    {
        $session_data = $this->session->userdata('logged_in');
        $user_id = $session_data['id'];
        $this->item->createItemType($user_id);

        redirect('/itemTypes');
    }

    //--------------------
    //  Uredjivanje tipa
    //--------------------
    public function editItemType($id=null)
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];
        $viewData['item_type'] = $this->item->getType($id);

        $headerscripts['header_scripts'] = array(
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/plugins/bootbox/bootbox.min.js"></script>'
        );

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Items/edit_item_type_view');
    }

    //------------
    //  Kreiranje novog tipa
    //------------
    public function updateItemType()
    {
        $session_data = $this->session->userdata('logged_in');
        $user_id = $session_data['id'];
        $this->item->updateItemType($user_id);

        redirect('/itemTypes');
    }

    //------------
    //  Brise TIP
    //------------
    public function delete()
    {
        $id = $this->input->post('id');
        $result = $this->item->deleteType($id);

        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }
}
