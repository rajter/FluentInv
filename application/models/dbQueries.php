<?php

Class DBQueries extends CI_Model
{
    public function __contruct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    //User types
    public function getUserTypes()
    {
        $query = $this->db->get('user_type');
        return $query->result();
    }

    //Item types
    public function getItemTypes()
    {
        $query = $this->db->get('item_type');
        return $query->result();
    }

    //Item status
    public function getItemStatus()
    {
        $query = $this->db->get('item_status');
        return $query->result();
    }

    //Transaction types
    public function getTransactionTypes()
    {
        $query = $this->db->get('transaction_type');
        return $query->result();
    }

    //All locations
    public function getLocations()
    {
        $query = $this->db->get('locations');
        return $query->result();
    }

    public function getLocationData($id)
    {
        $this->db->select('L.*, A.*');
        $this->db->from('locations AS L');
        $this->db->join('address AS A', 'L.address_id = A.id');
        $this->db->where('L.id', $id);
        $this->db->limit(1);

        return $this->db->get()->result()[0];
    }

    public function getCompanyInfo()
    {
        $query = $this->db->get('company');
        return $query->result();
    }

    //All clients
    public function getClients()
    {
        $query = $this->db->get('clients');
        return $query->result();
    }

    //All client types
    public function getClientTypes()
    {
        $query = $this->db->get('client_type');
        return $query->result();
    }

    //All contacts
    public function getContacts()
    {
        $query = $this->db->get('contacts');
        return $query->result();
    }

    // Vraca popis slika avatara
    public function getAvatarImages()
    {
        $avatars = array(
            'avatar.png',
            'avatar2.png',
            'avatar3.png',
            'avatar4.png',
            'avatar5.png'
        );

        return $avatars;
    }
}
