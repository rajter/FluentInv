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

    public function getFreeItemCount()
    {
        $this->db->select('COUNT(*) AS Count');
        $this->db->from('items');
        $this->db->where('item_status_id', 1);

        $query = $this->db->get();
        $result = $query->result()[0]->Count;
        return $result;
    }

    public function getIssuedItemCount()
    {
        $this->db->select('COUNT(*) AS Count');
        $this->db->from('items');
        $this->db->where('item_status_id', 2);

        $query = $this->db->get();
        $result = $query->result()[0]->Count;
        return $result;
    }

    public function getCanceledItemCount()
    {
        $this->db->select('COUNT(*) AS Count');
        $this->db->from('items');
        $this->db->where('item_status_id', 3);

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
        $date_array = getdate();
        $year = $date_array['year'];
        $month = $date_array['mon'];
        $day = $date_array['mday'];
        $hours = $date_array['hours'];
        $minutes = $date_array['minutes'];
        $seconds = $date_array['seconds'];

        $date = $year . "-" . $month . "-". $day .  " " . $hours . ":" . $minutes . ":" . $seconds;

        $this->db->select('T.*', FALSE);
        $this->db->select('U.name AS user');
        $this->db->select('UD.name AS debtor');
        $this->db->select('I.name, I.description, I.price, I.code, I.image, I.item_type_id, I.item_status_id');
        $this->db->from('item_transactions AS T');
        $this->db->join('users AS U', 'T.user_id = U.id');
        $this->db->join('users AS UD', 'T.debtor_id = UD.id');
        $this->db->join('items AS I', 'T.item_id = I.id');
        $this->db->order_by('T.date_taken', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();

        return $query->result();
    }

    public function getUsers($limit = 10)
    {
        $this->db->select('U.id, U.name, U.surname, U.image, U.login_date');
        $this->db->from('users AS U');
        $this->db->limit($limit);

        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function getMonthlyTransactions()
    {
        $date_array = getdate();
        $year = $date_array['year'];
        $month = $date_array['mon'];
        $day = $date_array['mday'];
        $hours = $date_array['hours'];
        $minutes = $date_array['minutes'];
        $seconds = $date_array['seconds'];

        $date = $year."-".$month."-".$day. " " . $hours . ":" . $minutes . ":" . $seconds;

        for ($i = 1; $i < ($month+1); $i++) {

            $transactions = $this->itemsTakenByMonth('2017', $i);

            $transactionsByMonth['transaction'.$i] = array();
            array_push($transactionsByMonth['transaction'.$i], $transactions);
        }

        return $transactionsByMonth;
    }

    public function itemsTakenByMonth($year, $month)
    {
        $startOfMonth = $year."-".$month."-01 00:00:00";
        $endOfMonth = $year."-".($month+1)."-01 00:00:00";

        $this->db->select('COUNT(*) AS COUNT');
        $this->db->from('item_transactions');
        $this->db->where('date_taken >=', $startOfMonth);
        $this->db->where('date_taken <', $endOfMonth);
        $query = $this->db->get();

        $result = $query->result()[0];
        $monthlyData = new stdClass;
        $monthlyData->year = $year;
        $monthlyData->month = $month;
        $monthlyData->totalTransactions = $result->COUNT;

        return $monthlyData;
    }



}
?>
