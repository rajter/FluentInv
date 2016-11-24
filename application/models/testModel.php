<?php

Class TestModel extends CI_Model
{
    public function __contruct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function getAll($trans_type_id)
    {
        $this->db->select('T.*', FALSE);
        $this->db->select('U.name AS user');
        $this->db->from('inventory_transactions'.' AS T');
        $this->db->join('users AS U', 'T.user_id = U.id');
        $this->db->order_by('date', 'DESC');
        $this->db->where('transaction_type_id', $trans_type_id);
        $query = $this->db->get();

        //$query = $this->db->get('transactions');
        return $query->result();
    }

    public function getTransWithHighestNumber($trans_type_id)
    {
        $this->db->select_max('id');
        $query = $this->db->get('inventory_transactions');

        $maxID = $query->first_row()->id;                       // uzimamo najveci id
        // $s = substr($maxID, 3, 8);                              // odstranimo nule
        // $n = (int)$s + 1;                                       // uvecamo za 1
        // $maxN = str_pad((string)$n, 7, "0", STR_PAD_LEFT);      // pretvaramo u string i dodajemo nule
        // $year = date('y');
        // $newID = $year."-".$maxN;


        return $maxID;
    }

    public function returnMaxQuantityWithItemData($trans_type_id, $trans_id)
    {
        $this->db->select_max('I.quantity');
        $this->db->from('item_transaction AS I');
        $this->db->join('inventory_transactions AS T', 'T.transaction_id = I.transaction_id');
        $this->db->where('I.transaction_id', $trans_id);

        $subQuery = $this->db->get_compiled_select();

        $this->db->select("*, ($subQuery) AS qnt", FALSE);
        $this->db->from('item_transaction');
        $this->db->where('transaction_id', $trans_id);
        $query = $this->db->get();

        echo $this->db->last_query();
        return $query->result();

        // SELECT *, (SELECT MAX(I.quantity)  FROM `item_transaction` AS `I` JOIN `inventory_transactions` AS `T` ON `T`.`transaction_id` = `I`.`transaction_id` WHERE `I`.`transaction_id` = '16-0000001')
        // FROM `item_transaction`
        // WHERE transaction_id = '16-0000001'
    }
}
?>
