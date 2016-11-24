<?php

define("ITEM_TRANS", "item_transaction", true);
define("TRANSACTIONS", "inventory_transactions", true);

Class Receipt extends CI_Model
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
        $this->db->select('C.name AS client');
        $this->db->select('L.name AS location');
        $this->db->from(TRANSACTIONS.' AS T');
        $this->db->join('users AS U', 'T.user_id = U.id');
        $this->db->join('clients AS C', 'T.client_id = C.id');
        $this->db->join('locations AS L', 'T.location_id = L.id');
        $this->db->order_by('transaction_number', 'DESC');
        $this->db->where('transaction_type_id', 1);
        $query = $this->db->get();

        return $query->result();
    }

    /*
    *   Return the receipt without the item data
    */
    public function get($id)
    {
        if($id != null)
        {
            $this->db->select('I.id AS trans_id, I.transaction_number, I.user_id, I.date, I.footnote');
            $this->db->select('L.name AS location');
            $this->db->select('C.*');
            $this->db->select('A.*');
            $this->db->from('inventory_transactions AS I');
            $this->db->join('locations AS L', 'L.id = I.location_id');
            $this->db->join('clients AS C', 'C.id = I.client_id');
            $this->db->join('address AS A', 'A.id = C.address_id');
            $this->db->where('I.transaction_number =', $id);
            $this->db->where('I.transaction_type_id =', 1);
            $query = $this->db->get();

            return $query->result();
        }
    }

    /*
    *   Return all the items from a specific receipt
    */
    public function getData($inventory_transactions_id, $transaction_number)
    {
        if($inventory_transactions_id != null AND $transaction_number != null)
        {
            $this->db->select('T.*', FALSE);
            $this->db->select('I.*');
            $this->db->select('IT.name AS type');
            $this->db->from('item_transaction AS T');
            $this->db->join('items AS I', 'T.item_id = I.id');
            $this->db->join('item_type AS IT', 'IT.id = I.item_type_id');
            $this->db->where('T.inventory_transaction_id =', $inventory_transactions_id);
            $this->db->where('T.transaction_number =', $transaction_number);
            $query = $this->db->get();

            return $query->result();
        }
    }

    public function create($session_id)
    {
        $this->load->helper('url');

        $transaction_number = $this->modelHelper->returnMaxTransID(1);
        $user_id = $session_id;
        $client_id = $this->input->post('client');
        $date = $this->input->post('date');
        $location = $this->input->post('location');
        $items = $this->input->post('item_id');         //  hidden input element
        $quantities = $this->input->post('item_qnt');   //  hidden input element
        $footnote = $this->input->post('footnote');

        $mapedQuantities = array_combine($items, $quantities);  // mapiramo id-eve artikala sa kolicinama

        $date_array = getdate();
        $hours = $date_array['hours'];
        $minutes = $date_array['minutes'];
        $seconds = $date_array['seconds'];

        $date = $date . " " . $hours . ":" . $minutes . ":" . $seconds;

        $data = array(
            'transaction_number' => $transaction_number,
            'transaction_type_id' => 1,
            'client_id' => $client_id,
            'location_id' => $location,
            'from_location_id' => $location,
            'user_id' => $user_id,
            'date' => $date,
            'footnote' => $footnote
        );

        $this->db->insert(TRANSACTIONS, $data);
        $trans_id = $this->receipt->get($transaction_number)[0]->trans_id;

        // Dodajemo artkikle
        foreach ($items as $item) {
            $transaction = array(
                'inventory_transaction_id' => $trans_id,
                'transaction_number' => $transaction_number,
                'item_id' => $item,
                'quantity' => $mapedQuantities[$item]
            );

            $this->db->insert(ITEM_TRANS, $transaction);

        }

    }

    public function delete($transaction_number)
    {
        $this->db->where('transaction_number', $transaction_number);
        $this->db->where('transaction_type_id', 1);
        return $this->db->delete('inventory_transactions');
    }
}
?>
