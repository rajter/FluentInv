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

    public function getCompanyInfo()
    {
        $query = $this->db->get('company');
        return $query->result();
    }

    //All clients based on their type
    public function getClients($type)
    {
        $query = $this->db->where('client_type_id', $type)->get('clients');
        return $query->result();
    }
}
