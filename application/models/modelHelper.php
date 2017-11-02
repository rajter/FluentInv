<?php

/*
//  Razne funkionalnosti vezane uz aplikaciju
//  Loada se kroz autoload u config folderu
*/
Class ModelHelper extends CI_Model
{
    public function __contruct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    /**
    *  Vraca formatirani string najvece transakcije
    *  (ovisno o tipu) uvecanu za jedan
    *  Nema provjere ako vrijednost prelazi 9999999
    */
    public function returnMaxTransNumber($trans_type_id)
    {
        $this->db->select_max('transaction_number')->where('transaction_type_id', $trans_type_id);
        $query = $this->db->get('inventory_transactions');

        $maxID = $query->first_row()->transaction_number;       // uzimamo najveci id
        $s = substr($maxID, 3, 8);                              // odstranimo nule
        $n = (int)$s + 1;                                       // uvecamo za 1
        $maxN = str_pad((string)$n, 7, "0", STR_PAD_LEFT);      // pretvaramo u string i dodajemo nule
        $year = date('y');
        $newID = $year."-".$maxN;

        return $newID;
    }

    /*
    *   Vraca najveci broj kolicine artikla za transakciju
    */
    public function returnMaxQuantity($trans_type_id, $trans_id)
    {
        $this->db->select_max('I.quantity');
        $this->db->from('item_transaction AS I');
        $this->db->join('inventory_transactions AS T', 'T.id = I.inventory_transaction_id');
        $this->db->where('T.id', $trans_id);
        $query = $this->db->get();

        $lastQuery = $this->db->last_query();
        $r = $query->result();
        return $query->result();
    }

    //----------------------------------------
    //  Vraca transakciju po id-u transakcije
    //----------------------------------------
    public function getTransactionFromID($id)
    {
        $this->db->select('*');
        $this->db->from('item_transactions');
        $this->db->where('id', $id);
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result()[0];
        }
        else
        {
            return null;
        }
    }

    //----------------------------------------
    //  Vraca artikl transakcije po id-u transakcije
    //----------------------------------------
    public function getItemFromTransactionID($id)
    {
        $this->db->select('I.*');
        $this->db->from('items AS I');
        $this->db->join('item_transactions AS IT', 'I.id = IT.item_id');
        $this->db->where('IT.id', $id);
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result()[0];
        }
        else
        {
            return null;
        }
    }

    //----------------------------------------
    //  Vraca transakciju po id-u transakcije
    //----------------------------------------
    public function getTransactionFromItemID($id)
    {
        $this->db->select('*');
        $this->db->from('item_transactions');
        $this->db->where('item_id', $id);
        $this->db->where('status', 0);
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result()[0];
        }
        else
        {
            return null;
        }
    }
}
?>
