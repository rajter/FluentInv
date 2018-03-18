<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*Employees controler
*/
class Transactions extends My_Controller {

    function __construct()
     {
       parent::__construct();
       $this->load->helper('url');
       $this->load->helper(array("form", "security", "date", "url"));
       $this->load->model(array('item', 'transaction', 'user', 'ModelHelper'));
     }

    public function index()
    {
        $viewData['items_due'] = $this->transaction->getAll(FALSE);
        $viewData['items_due_deadline'] = $this->transaction->getAll(TRUE);

        $headerscripts['header_scripts'] = array(
            '<script src="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css"></script>',
            '<link rel="stylesheet" href="'.base_url().'assets/plugins/datepicker/datepicker3.css">',
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>',
            '<script src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>',
            '<script src="'.base_url().'assets/plugins/datepicker/bootstrap-datepicker.js"></script>',
            '<script src="'.base_url().'assets/appjs/datepicker.js"></script>',
            '<script src="'.base_url().'assets/appjs/Transactions/transactions.js"></script>',
            '<script src="'.base_url().'assets/appjs/modals.js"></script>'
        );

        $this->load_views($headerscripts, $footerscripts, $viewData, 'Transactions/transactions_view');
    }

    public function view($id)
    {
        $viewData['transaction'] = $this->transaction->get($id);

        $headerscripts['header_scripts'] = array(
        );

        $footerscripts['footer_scripts'] = array(
        );

        $this->load_views($headerscripts, $footerscripts, $viewData, 'Transactions/view');
    }

    public function viewall()
    {
        $viewData['transactions'] = $this->transaction->getList();

        $headerscripts['header_scripts'] = array(
            '<script src="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css"></script>',
            '<link rel="stylesheet" href="'.base_url().'assets/plugins/datepicker/datepicker3.css">',
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>',
            '<script src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>',
            '<script src="'.base_url().'assets/plugins/datepicker/bootstrap-datepicker.js"></script>',
            '<script src="'.base_url().'assets/appjs/datepicker.js"></script>',
            '<script src="'.base_url().'assets/appjs/Transactions/transactions.js"></script>',
            '<script src="'.base_url().'assets/appjs/modals.js"></script>'
        );

        $this->load_views($headerscripts, $footerscripts, $viewData, 'Transactions/transactions_view_all');
    }

    //--------------------------------------
    //  Vraca view za unos nove transakcije
    //--------------------------------------
    public function newTransaction()
    {
        $viewData['items'] = $this->item->getFree();
        $viewData['users'] = $this->user->getAll();

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
            '<script src="'.base_url().'assets/plugins/bootbox/bootbox.min.js"></script>',
            '<script src="'.base_url().'assets/appjs/Transactions/transactions.js"></script>'
        );

        $this->load_views($headerscripts, $footerscripts, $viewData, 'Transactions/new_transaction_view');
    }

    //----------------------------
    //  Kreira novu transakciju
    //----------------------------
    public function create()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('item-taken', 'Artikl', 'required');

        if($this->form_validation->run() == FALSE)
        {
            //Field validation failed.
            $viewData['items'] = $this->item->getFree();
            $viewData['users'] = $this->user->getAll();

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
                '<script src="'.base_url().'assets/plugins/bootbox/bootbox.min.js"></script>',
                '<script src="'.base_url().'assets/appjs/Transactions/transactions.js"></script>'
            );

            $this->load_views($headerscripts, $footerscripts, $viewData, 'Transactions/new_transaction_view');
        }
        else // Validacije je prosla
        {
          $session_data = $this->session->userdata('logged_in');
          $user_id = $session_data['id'];
          $this->transaction->create($user_id);

          redirect('/transactions');
        }
    }

    //--------------------------------------
    //  Edit
    //--------------------------------------
    public function edit($id = null)
    {
        $viewData['items'] = $this->item->getFree();
        $viewData['users'] = $this->user->getAll();
        $viewData['transaction'] = $this->ModelHelper->getTransactionFromID($id);
        $viewData['item'] = $this->ModelHelper->getItemFromTransactionID($id);

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
            '<script src="'.base_url().'assets/plugins/bootbox/bootbox.min.js"></script>',
            '<script src="'.base_url().'assets/appjs/Transactions/transactions.js"></script>'
        );

        if($viewData['transaction']->status == 0)
        {
            $this->load_views($headerscripts, $footerscripts, $viewData, 'Transactions/edit_transaction_view');
        }
        else {
            redirect('/transactions/viewall');
        }
    }

    //------------------------
    //  Uredjuje transakciju
    //------------------------
    public function update()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('item-taken', 'Artikl', 'required');

        if($this->form_validation->run() == FALSE)
        {
            //Field validation failed.
            $viewData['items'] = $this->item->getFree();
            $viewData['users'] = $this->user->getAll();

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
                '<script src="'.base_url().'assets/plugins/bootbox/bootbox.min.js"></script>',
                '<script src="'.base_url().'assets/appjs/Transactions/transactions.js"></script>'
            );

            $this->load_views($headerscripts, $footerscripts, $viewData, 'Transactions/edit_transaction_view');
        }
        else // Validacije je prosla
        {
          $session_data = $this->session->userdata('logged_in');
          $user_id = $session_data['id'];
          $this->transaction->update($user_id);

          redirect('/transactions');
        }
    }

    public function returnItem($id)
    {
        if($id != null)
        {
            $this->transaction->returnItem($id);
            redirect('/transactions');
        }
    }

    public function postponeItem()
    {
        $this->transaction->postponeItem($id);
        redirect('/transactions');
    }

    //----------------------------------
    //  Vraca artikl citanjem RFID koda
    //----------------------------------
    public function returnItemFromCode()
    {
        $code = $this->input->post('code');
        $item['data'] = $this->transaction->returnItemFromCode($code);

        echo json_encode($item['data'], JSON_UNESCAPED_UNICODE);
    }

    public function getItemFromCode()
    {
        $code = $this->input->post('code');
        $item['data'] = $this->item->getAvailableFromCode($code);

        echo json_encode($item['data'], JSON_UNESCAPED_UNICODE);
    }

    public function delete()
    {
        $transId = $this->input->post('transaction-id');
        $data['data'] = $this->transaction->delete($transId);

        echo json_encode($data['data'], JSON_UNESCAPED_UNICODE);
    }
}
