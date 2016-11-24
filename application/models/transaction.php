<?php

define("TRANS_ITEM", "trans_item", true);
define("TRANSACTIONS", "transactions", true);

Class Transaction extends CI_Model
{

    public function __contruct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function getAll()
    {
        $this->db->select('T.*', FALSE);
        $this->db->select('U.name AS user');
        $this->db->select('L.name AS location');
        $this->db->from(TRANSACTIONS.' AS T');
        $this->db->join('users AS U', 'T.users_id = U.id');
        $this->db->join('locations AS L', 'L.id = T.location_id');
        $this->db->order_by('transaction_date', 'DESC');
        $query = $this->db->get();

        //$query = $this->db->get('transactions');
        return $query->result();
    }

    public function get($id)
    {
        if($id != null)
        {
              $this->db->select('T.*', FALSE);
              $this->db->select('I.*');
              $this->db->select('IT.name AS type');
              $this->db->from(TRANS_ITEM.' AS T');
              $this->db->join('items AS I', 'T.items_id = I.id');
              $this->db->join('item_type AS IT', 'IT.id = I.item_type_id');
              $this->db->where('transactions_id =', $id);
              $query = $this->db->get();
              //print_r($this->db->last_query());
              return $query->result();
        }
    }

    public function create($session_id)
    {
        $this->load->helper('url');

        $transaction_id = uniqid();
        $user_id = $session_id;
        $date = $this->input->post('date');
        $location = $this->input->post('location');
        $items = $this->input->post('item_id');
        //$quantities = $this->input->post($item->id.'_quantity');

        $date_array = getdate();
        $hours = $date_array['hours'];
        $minutes = $date_array['minutes'];
        $seconds = $date_array['seconds'];

        $date = $date . " " . $hours . ":" . $minutes . ":" . $seconds;

        $data = array(
            'id' => $transaction_id,
            'users_id' => $user_id,
            'location_id' => $location,
            'transaction_date' => $date,
            'transaction_type' => 1
        );

        $this->db->insert(TRANSACTIONS, $data);

        foreach ($items as $item) {
            $transaction = array(
                'transactions_id' => $transaction_id,
                'items_id' => $item,
                'location_id' => $location,
                'quantity' => 1
            );

            $this->db->insert(TRANS_ITEM, $transaction);

            //Po potrebi mjenjati status artikla
            // if($location == 1)
            // {
            //     $this->db->set('item_status_id', 1);
            // }
            // else {
            //     $this->db->set('item_status_id', 2);
            // }

            // $this->db->where('id', $item);
            // $this->db->update('items');
        }

    }
}
?>
