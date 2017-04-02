<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Knp\Snappy\Pdf;

class Issues extends My_Controller {

    function __construct()
     {
       parent::__construct();
       $this->load->helper('url');
       $this->load->helper(array("form", "security", "date"));
       $this->load->model(array('item', 'issue', 'dbQueries', 'modelHelper'));
     }

     /*
     *  Prikazuje sve primke
     */
    public function index()
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];
        $viewData['query'] = $this->issue->getAll();

        $headerscripts['header_scripts'] = array(
            '<script src="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css"></script> '
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/appjs/Issues/issues.js"></script>',
            '<script src="'.base_url().'assets/appjs/modals.js"></script>'
        );

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Issues/issues_view');
    }

    /*
    *   Nova primka
    */
    public function newIssue()
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];
        $viewData['query'] = $this->item->getAll();
        $viewData['locations'] = $this->dbQueries->getLocations();
        $viewData['clients'] = $this->dbQueries->getClients(1);

        $headerscripts['header_scripts'] = array(
            '<link rel="stylesheet" href="'.base_url().'assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css">',
            '<link rel="stylesheet" href="'.base_url().'assets/plugins/datepicker/datepicker3.css">',
            '<link rel="stylesheet" href="'.base_url().'assets/plugins/select2/select2.css">',
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/plugins/datepicker/bootstrap-datepicker.js"></script>',
            '<script src="'.base_url().'assets/appjs/datepicker.js"></script>',
            '<script src="'.base_url().'assets/plugins/bootbox/bootbox.min.js"></script>',
            '<script src="'.base_url().'assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js"></script>',
            '<script src="'.base_url().'assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.hr-HR.js"></script>',
            '<script src="'.base_url().'assets/appjs/Issues/issues.js"></script>',
        );

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Issues/new_issue_view');
    }

    /*
    *   Pregled odredjene primke
    */
    public function view($id = null)
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $headerscripts['header_scripts'] = array();
        $footerscripts['footer_scripts'] = array();

        $viewData['issue'] = $this->issue->get($id);

        $trans_id = (int)$viewData['issue'][0]->trans_id;
        $trans_number = $viewData['issue'][0]->transaction_number;

        $viewData['issueData'] = $this->issue->getData($trans_id, $trans_number);
        $viewData['maxQuantity'] = $this->modelHelper->returnMaxQuantity(2, $trans_id);
        $viewData['company'] = $this->dbQueries->getCompanyInfo();

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Issues/view');
    }

    //ajax called function
    /*
    *   Vraca formatiran view odredjene primke u pregledu primki
    */
    public function getIssueInfo()
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $headerscripts['header_scripts'] = array();
        $footerscripts['footer_scripts'] = array();

        $id = $this->input->get('transaction_number');
        $viewData['issue'] = $this->issue->get($id);

        $trans_id = (int)$viewData['issue'][0]->trans_id;
        $trans_number = $viewData['issue'][0]->transaction_number;

        $viewData['issueData'] = $this->issue->getData($trans_id, $trans_number);
        $viewData['maxQuantity'] = $this->modelHelper->returnMaxQuantity(2, $trans_id);
        $viewData['company'] = $this->dbQueries->getCompanyInfo();

        $formatedIssue = $this->return_transaction_preview($data, $viewData, 'Issues/issue_preview');
        echo $formatedIssue;
    }

    // AJAX
    /*
    *   Dodavanje artikala u tablicu za kreiranje nove izdatnice
    */
    public function addItem()
    {
        $items = explode(",", $this->input->post('items')); //posto ajax vraca string potrebno splitati string sa zarezom da dobijemo polje
        $data = array();
        foreach ($items as $id)
        {
            $item = $this->item->get($id);
            array_push($data, $item);
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    // AJAX
    /*
    *   Brisanje izdatnice
    */
    public function delete()
    {
        $transaction_number = $this->input->post('transaction_number');
        $result = $this->issue->delete($transaction_number);

        $lastQuery = $this->db->last_query();
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    /*
    *   Kreira novu izdatnicu
    */
    public function create()
    {
        $session_data = $this->session->userdata('logged_in');
        $user_id = $session_data['id'];
        $this->issue->create($user_id);

        redirect('/Issues');
    }


    public function edit($id = null)
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $viewData['issue'] = $this->issue->get($id);
        $trans_id = (int)$viewData['issue'][0]->trans_id;
        $trans_number = $viewData['issue'][0]->transaction_number;

        $viewData['locations'] = $this->dbQueries->getLocations();
        $viewData['clients'] = $this->dbQueries->getClients(1);
        $viewData['query'] = $this->item->getItemsQuantity($trans_id);

        $headerscripts['header_scripts'] = array(
            '<link rel="stylesheet" href="'.base_url().'assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css">',
            '<link rel="stylesheet" href="'.base_url().'assets/plugins/datepicker/datepicker3.css">',
            '<link rel="stylesheet" href="'.base_url().'assets/plugins/select2/select2.css">',
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/plugins/datepicker/bootstrap-datepicker.js"></script>',
            '<script src="'.base_url().'assets/appjs/datepicker.js"></script>',
            '<script src="'.base_url().'assets/plugins/bootbox/bootbox.min.js"></script>',
            '<script src="'.base_url().'assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js"></script>',
            '<script src="'.base_url().'assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.hr-HR.js"></script>',
            '<script src="'.base_url().'assets/appjs/Issues/issues.js"></script>',
            '<script src="'.base_url().'assets/appjs/Issues/editIssues.js"></script>'
        );

        $viewData['issueData'] = $this->issue->getData($trans_id, $trans_number);
        $viewData['maxQuantity'] = $this->modelHelper->returnMaxQuantity(2, $trans_id);
        $viewData['company'] = $this->dbQueries->getCompanyInfo();

        $this->load_views($headerscripts, $footerscripts, $data, $viewData, 'Issues/edit_view');
    }

    public function update()
    {
        // echo "<h1>UPDATE </h1>";
        $session_data = $this->session->userdata('logged_in');
        $user_id = $session_data['id'];
        $this->issue->update($user_id);

        redirect('/Issues');
    }

    /*
    *   Printanje izdatnice
    */
    public function printIssue($id = null)
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $headerscripts['header_scripts'] = array();
        $footerscripts['footer_scripts'] = array();

        // echo var_dump($data);

        //$receiptData[] =
        $viewData['issue'] = $this->issue->get($id);

        $trans_id = (int)$viewData['issue'][0]->trans_id;
        $trans_number = $viewData['issue'][0]->transaction_number;

        $viewData['issueData'] = $this->issue->getData($trans_id, $trans_number);
        $viewData['maxQuantity'] = $this->modelHelper->returnMaxQuantity(1, $trans_id);
        $viewData['company'] = $this->dbQueries->getCompanyInfo();
        // array_push($this->issue->getReceiptData($id), $viewData['issue']);

        $this->load_print_view($headerscripts, $footerscripts, $data, $viewData, 'Print/issue_print_view');
    }

    /*
    *   Generira pdf izdatnice za download
    */
    public function generatePDF($id = null)
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $data['username'] = $session_data['username'];

        $headerscripts['header_scripts'] = array();
        $footerscripts['footer_scripts'] = array();

        $viewData['issue'] = $this->issue->get($id);

        $trans_id = (int)$viewData['issue'][0]->trans_id;
        $trans_number = $viewData['issue'][0]->transaction_number;

        $viewData['issueData'] = $this->issue->getData($trans_id, $trans_number);
        $viewData['maxQuantity'] = $this->modelHelper->returnMaxQuantity(1, $trans_id);
        $viewData['company'] = $this->dbQueries->getCompanyInfo();

        $snappy = new Pdf('C:/wkhtmltopdf/bin/wkhtmltopdf');
        $PDF = $this->return_print_view($headerscripts, $footerscripts, $data, $viewData, 'Print/issue_print_view');

        $filename = "Izdatnica_".$id;
        header("Content-Type: application/pdf");
        header("Content-Disposition: attachment; filename=$filename.pdf");
        echo $snappy->getOutputFromHtml($PDF);
    }
}
