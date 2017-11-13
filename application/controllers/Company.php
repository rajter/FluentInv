<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//---------------------
//  Podaci o poduzecu
//---------------------
class Company extends My_Controller {

    function __construct()
     {
       parent::__construct();
       $this->load->helper('url');
       $this->load->helper(array("form", "security", "date"));
       $this->load->model(array('companyModel', 'dbQueries'));
     }

    public function index()
    {
        $viewData['company'] = $this->companyModel->get();
        $viewData['contacts'] = $this->companyModel->getContacts();
        $viewData['users'] = $this->companyModel->getUsers();
        $viewData['items'] = $this->companyModel->getItems();

        $headerscripts['header_scripts'] = array(
            '<script src="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css"></script> '
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/appjs/Company/company.js"></script>'
        );

        $this->load_views($headerscripts, $footerscripts, $viewData, 'Company/company_view');
    }

    public function edit()
    {
        $viewData['company'] = $this->companyModel->get();

        $headerscripts['header_scripts'] = array(
            '<script src="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css"></script> '
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/appjs/Company/company.js"></script>'
        );

        $this->load_views($headerscripts, $footerscripts, $viewData, 'Company/edit_company_view');
    }

    public function editContacts()
    {
        $viewData['company'] = $this->companyModel->get();
        $viewData['CompanyContacts'] = $this->companyModel->getContacts();
        $viewData['contacts'] = $this->dbQueries->getContacts();

        $headerscripts['header_scripts'] = array(
            '<script src="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css"></script> '
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/appjs/Company/company.js"></script>'
        );

        $this->load_views($headerscripts, $footerscripts, $viewData, 'Company/edit_companyContacts_view');
    }

    public function update()
    {
        $headerscripts['header_scripts'] = array(
            '<script src="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css"></script> '
        );

        $footerscripts['footer_scripts'] = array(
            '<script src="'.base_url().'assets/appjs/Company/company.js"></script>'
        );

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Ime', 'trim|required');
        $this->form_validation->set_rules('tel', 'Telefon', 'required');
        $this->form_validation->set_rules('fax', 'Fax', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('address', 'Adresa', 'required');
        $this->form_validation->set_rules('city', 'Gread', 'required');
        $this->form_validation->set_rules('zipcode', 'Posta', 'required');
        $this->form_validation->set_rules('state', 'Pokrajina', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $viewData['company'] = $this->companyModel->get();
            $this->load_views($headerscripts, $footerscripts, $viewData, 'Company/edit_company_view');
        }
        else
        {
            $this->companyModel->update();
            redirect('/company');
        }


    }

    public function getContactInfo()
    {
        $id = $this->input->post('contactId');
        $contact = $this->companyModel->getContactInfo($id);

        echo json_encode($contact, JSON_UNESCAPED_UNICODE);
    }

    public function updateContacts()
    {
        $this->companyModel->updateContacts();
        redirect('/company/editContacts');
    }

    public function addContact()
    {
        $result = $this->companyModel->addContact();

        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function addNewContact()
    {
        $result = $this->companyModel->addNewContact();

        redirect('/company/editContacts');
    }

    public function removeContact()
    {
        $result = $this->companyModel->removeContact();

        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }
}
