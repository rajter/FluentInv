<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*Employees contoler
*/
class Transactions extends My_Controller {

    function __construct()
     {
       parent::__construct();
       $this->load->helper('url');
       $this->load->helper(array("form", "security", "date"));
       $this->load->model(array('item', 'transaction'));
     }

    public function index()
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];
        $data['query'] = $this->transaction->getAll();
        //echo var_dump($data);

        $headerscripts['header_scripts'] = array(
            '<script src="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css"></script> '
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>',
            '<script src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>',
            '<script src="'.base_url().'assets/appjs/tableinit.js"></script>',
            '<script src="'.base_url().'assets/appjs/transactions.js"></script>',
            '<script src="'.base_url().'assets/appjs/modals.js"></script>'
        );

        //echo var_dump($data);

        $this->load->view('templates/app_head_view', $headerscripts);
        $this->load->view('templates/app_menu_view', $data);
        $this->load->view('Transactions/transactions_view', $data);
        $this->load->view('templates/app_footer_view', $footerscripts);
    }

    public function newTransaction()
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];
        $data['query'] = $this->item->getAll();

        $headerscripts['header_scripts'] = array(
            '<script src="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css"></script> ',
            '<link rel="stylesheet" href="'.base_url().'assets/plugins/datepicker/datepicker3.css">',
            '<link rel="stylesheet" href="'.base_url().'assets/plugins/select2/select2.css">'
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>',
            '<script src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>',
            '<script src="'.base_url().'assets/plugins/datepicker/bootstrap-datepicker.js"></script>',
            '<script src="'.base_url().'assets/appjs/datepicker.js"></script>',
            '<script src="'.base_url().'assets/appjs/modals.js"></script>',
            '<script src="'.base_url().'assets/appjs/tableinit.js"></script>',
            '<script src="'.base_url().'assets/plugins/bootbox/bootbox.min.js"></script>'
            //'<script src="'.base_url().'assets/appjs/transaction.js"></script>',

        );

        $this->load->view('templates/app_head_view', $headerscripts);
        $this->load->view('templates/app_menu_view', $data);
        $this->load->view('Transactions/new_transaction_view', $data);
        $this->load->view('templates/app_footer_view', $footerscripts);
    }

    //ajax called function
    public function getTransactionInfo()
    {
        //$transactions = $this->input->get('transaction_id');
        $id = $this->input->get('transaction_id');
        $trans['data'] = $this->transaction->get($id);
        //var_dump($trans);

        echo json_encode($trans['data'], JSON_UNESCAPED_UNICODE);
    }

    // ajax called function
    public function addItem()
    {
        $items = $this->input->get('items');
        $data = array();
        foreach ($items as $id)
        {
            $item = $this->item->get($id);
            array_push($data, $item);
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function create()
    {
        /*$date = $this->input->post('date');
        $location = $this->input->post('location');
        $items = $this->input->post('item_id');
        echo json_encode([ $date, $location, $items ], JSON_UNESCAPED_UNICODE);*/

        $session_data = $this->session->userdata('logged_in');
        $user_id = $session_data['id'];
        $this->transaction->create($user_id);

        redirect('/transactions');
    }

    public function delete()
    {
    }

    public function edit()
    {
        $trans['first'] = $this->transaction->get('5803b283cb497');
        var_dump($trans);
    }

    public function update()
    {
    }
}
