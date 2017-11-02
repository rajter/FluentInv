<?php

//----------------------------
//  Poduzece
//----------------------------
Class CompanyModel extends CI_Model
{
    public function __contruct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    //----------------------------
    //  Vraca podatke o poduzecu
    //----------------------------
    public function get()
    {
        $this->db->select('*');
        $this->db->from('company AS C');
        $query = $this->db->get();

        return $query->result()[0];
    }

    public function getContacts()
    {
        $this->db->select('C.*');
        $this->db->from('contacts AS C');
        $query = $this->db->get();

        return $query->result();
    }

    public function getUsers()
    {
        $this->db->select('U.*');
        $this->db->from('users AS U');
        $query = $this->db->get();

        return $query->result();
    }

    public function getItems()
    {
        $this->db->select('*');
        $this->db->from('items');
        $query = $this->db->get();

        return $query->result();
    }

    public function update()
    {
        $id = $this->input->post('id');
        $companyData = array(
            'name' => $this->input->post('name'),
            'tel' => $this->input->post('tel'),
            'fax' => $this->input->post('fax'),
            'email' => $this->input->post('email'),
            'address' => $this->input->post('address'),
            'city' => $this->input->post('city'),
            'zipcode' => $this->input->post('zipcode'),
            'state' => $this->input->post('state'),
        );

        $this->db->where('id', $id);
        return $this->db->update('company', $companyData);
    }

    public function updateContacts()
    {
        $id = $this->input->post('contact_id');
        $contactData = array(
            'name' => $this->input->post('name'),
            'surname' => $this->input->post('surname'),
            'tel' => $this->input->post('tel'),
            'mob' => $this->input->post('mob'),
            'email' => $this->input->post('email')
        );
        // echo var_dump($contactData);
        // echo var_dump($id);
        $this->db->where('id', $id);
        $this->db->update('contacts', $contactData);
    }

    public function addContact()
    {
        $id = $this->input->post('contact_id');

        $this->db->select('COUNT(*) AS count');
        $this->db->from('company_has_contacts');
        $this->db->where('contacts_id', $id);
        $query = $this->db->get();

        $result = $query->result()[0];
        if($result->count > 0)
        {
            return 'FALSE';
        }
        else {
            $companyHasContactData = array(
                'company_id' => 1,
                'contacts_id' => $id,
            );
            $this->db->insert('company_has_contacts', $companyHasContactData);
            return 'TRUE';
        }
    }

    public function addNewContact()
    {
        $contactData = array(
            'name' => $this->input->post('name'),
            'surname' => $this->input->post('surname'),
            'tel' => $this->input->post('tel'),
            'mob' => $this->input->post('mob'),
            'email' => $this->input->post('email')
        );
        $this->db->insert('contacts', $contactData);
    }

    public function removeContact()
    {
        $id = $this->input->post('contact_id');

        $this->db->where('id', $id);

        if($this->db->delete('contacts'))
        {
            return 'TRUE';
        }
        else {
            return 'FALSE';
        }
    }

    public function getContactInfo($id)
    {
        if(!is_null($id))
        {
            $this->db->select('*');
            $this->db->from('contacts');
            $this->db->where('id', $id);
            $query = $this->db->get();

            return $query->result()[0];
        }
    }
}
?>
