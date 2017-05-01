<?php

Class HomeModel extends CI_Model
{
    public function __contruct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function getItemCount()
    {
        $this->db->select('COUNT(*) AS Count');
        $this->db->from('items');

        $query = $this->db->get();
        $result = $query->result()[0]->Count;
        return $result;
    }

    public function getTransactionCount($type)
    {
        $this->db->select('COUNT(*) AS Count');
        $this->db->from('inventory_transactions');
        $this->db->where('transaction_type_id', $type);

        $query = $this->db->get();
        $result = $query->result()[0]->Count;
        return $result;
    }

    public function getLatestTransactions($limit = 10)
    {
        $this->db->select('IT.id, IT.transaction_number, TT.description, IT.transaction_type_id, IT.date, L.name AS Location, C.name AS Client, U.name AS Name, U.surname AS Surname');
        $this->db->from('inventory_transactions AS IT');
        $this->db->join('transaction_type AS TT', 'IT.transaction_type_id = TT.id');
        $this->db->join('locations AS L', 'IT.location_id = L.id');
        $this->db->join('clients AS C', 'IT.client_id = C.id');
        $this->db->join('users AS U', 'IT.user_id = U.id');
        $this->db->order_by('IT.date', 'DESC');
        $this->db->limit($limit);

        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function getUsers($limit = 10)
    {
        $this->db->select('U.name, U.surname, U.image, U.login_date');
        $this->db->from('users AS U');
        $this->db->limit($limit);

        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

}
?>
