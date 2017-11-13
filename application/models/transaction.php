<?php
Class Transaction extends CI_Model
{

    public function __contruct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function get($id)
    {
        // $statusQuery = "SELECT status FROM items JOIN item_status ON items.id = item_status.id WHERE items.id = 1";
        $this->db->select('T.*');
        $this->db->select('T.status AS TransactionStatus');
        $this->db->select('U.id AS userID, U.name AS user, U.image AS userImage');
        $this->db->select('UD.id AS debtorID, UD.name AS debtor, UD.image AS debtorImage');
        $this->db->select('I.id AS ItemId, I.name AS ItemName, I.description AS ItemDescription, I.price AS ItemPrice, I.code AS ItemCode, I.image AS ItemImage, I.item_type_id, I.item_status_id');
        $this->db->from('item_transactions AS T');
        $this->db->join('users AS U', 'T.user_id = U.id');
        $this->db->join('users AS UD', 'T.debtor_id = UD.id');
        $this->db->join('items AS I', 'T.item_id = I.id');
        $this->db->where('T.id', $id);
        $this->db->limit(1);
        $query = $this->db->get();

        return $query->result()[0];
    }

    //--------------------------------
    //  Vraca popis svih transakcija
    //--------------------------------
    public function getList()
    {
        $this->db->select('T.*', FALSE);
        $this->db->select('U.id AS userID, U.name AS user, U.image AS userImage');
        $this->db->select('UD.id AS debtorID, UD.name AS debtor, UD.image AS debtorImage');
        $this->db->select('I.name, I.description, I.price, I.code, I.image, I.item_type_id, I.item_status_id');
        $this->db->from('item_transactions AS T');
        $this->db->join('users AS U', 'T.user_id = U.id');
        $this->db->join('users AS UD', 'T.debtor_id = UD.id');
        $this->db->join('items AS I', 'T.item_id = I.id');        
        $this->db->order_by('T.date_taken', 'DESC');
        $query = $this->db->get();

        return $query->result();
    }

    //--------------------------------------------
    //  Vraca sve transakcije
    //  $overdue -> FALSE = nije premasio rok
    //              TRUE  = premaseni rok
    //--------------------------------------------
    public function getAll($overdue)
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
        $this->db->select('U.id AS userID, U.name AS user, U.image AS userImage');
        $this->db->select('UD.id as debtorID, UD.name AS debtor, UD.image AS debtorImage');
        $this->db->select('I.name, I.description, I.price, I.code, I.image, I.item_type_id, I.item_status_id');
        $this->db->from('item_transactions AS T');
        $this->db->join('users AS U', 'T.user_id = U.id');
        $this->db->join('users AS UD', 'T.debtor_id = UD.id');
        $this->db->join('items AS I', 'T.item_id = I.id');
        $this->db->where('T.status', 0);
        if($overdue == TRUE)
        {
            $this->db->where('T.deadline <', $date);
        }
        else
        {
            $this->db->where('T.deadline >', $date);
        }
        $this->db->order_by('T.date_taken', 'DESC');
        $query = $this->db->get();

        return $query->result();
    }

    //----------------------------
    //  Kreira transakciju
    //----------------------------
    public function create($session_id)
    {
        $this->load->helper('url');

        $transaction_id = uniqid();
        $user_id = $session_id;
        $debtor_id = $this->input->post('debtor');
        $date_taken = $this->input->post('date-taken');
        $deadline = $this->input->post('deadline');
        $item = $this->input->post('item-taken');
        $footnote = $this->input->post('footnote');

        $data = array(
            'transaction_number' => $transaction_id,
            'item_id' => $item,
            'date_taken' => $date_taken,
            'deadline' => $deadline,
            'user_id' => $user_id,
            'debtor_id' => $debtor_id,
            'footnote' => $footnote,
            'status' => 0
        );

        $this->db->insert('item_transactions', $data);

        //Artikl status stavljamo na 2[Zauzet]
        $itemData = array(
            'item_status_id' => 2
        );

        $this->db->where('id', $item);
        $this->db->update('items', $itemData);     // Ažuriramo podatke artikla
    }

    //----------------------------
    //  Uredjuje transakciju
    //----------------------------
    public function update($session_id)
    {
        $this->load->helper('url');

        //Artikl status stavljamo na 2[Slobodan]
        $previous_item = $this->input->post('previous-item');
        $previousItemData = array(
            'item_status_id' => 1
        );

        $this->db->where('id', $previous_item);
        $this->db->update('items', $previousItemData);

        //Kreiramo tranakciju
        $id = $this->input->post('transaction-id');
        $user_id = $session_id;
        $debtor_id = $this->input->post('debtor');
        $date_taken = $this->input->post('date-taken');
        $deadline = $this->input->post('deadline');
        $item = $this->input->post('item-taken');
        $footnote = $this->input->post('footnote');

        $data = array(
            'item_id' => $item,
            'date_taken' => $date_taken,
            'deadline' => $deadline,
            'user_id' => $user_id,
            'debtor_id' => $debtor_id,
            'footnote' => $footnote,
            'status' => 0
        );

        $this->db->where('id', $id);
        $this->db->update('item_transactions', $data);

        //Artikl status stavljamo na 2[Zauzet]
        $itemData = array(
            'item_status_id' => 2
        );

        $this->db->where('id', $item);
        $this->db->update('items', $itemData);
    }

    //----------------
    //  Vraca artikl
    //----------------
    public function returnItem($id)
    {
        $this->load->model('ModelHelper');
        $transaction = $this->ModelHelper->getTransactionFromID($id);

        $date_array = getdate();
        $year = $date_array['year'];
        $month = $date_array['mon'];
        $day = $date_array['mday'];
        $hours = $date_array['hours'];
        $minutes = $date_array['minutes'];
        $seconds = $date_array['seconds'];

        $return_date = $year . "-" . $month . "-". $day .  " " . $hours . ":" . $minutes . ":" . $seconds;


        $transData = array(
            'date_returned' => $return_date,
            'status' => 1
        );

        $this->db->where('id', $transaction->id);
        $this->db->update('item_transactions', $transData);     // Ažuriramo podatke transakcije

        //Artikl status stavljamo na 1[Slobodan] ako status nije 3[otpisan]
        $this->db->select('I.*', FALSE);
        $this->db->select('T.name AS type');
        $this->db->select('S.status AS status');
        $this->db->from('items AS I');
        $this->db->join('item_type AS T', 'T.id = I.item_type_id');
        $this->db->join('item_status AS S', 'S.id = I.item_status_id');
        $query = $this->db->where('I.id', $transaction->item_id)
                        ->limit(1)
                        ->get();
        $item = $query->result()[0];
        $itemStatus = $item->item_status_id;
        if($itemStatus != 3)
        {
            $itemStatus = 1;
        }

        $itemData = array(
            'item_status_id' => $itemStatus
        );

        $this->db->where('id', $transaction->item_id);
        $this->db->update('items', $itemData);     // Ažuriramo podatke artikla
    }

    //----------------
    //  Vraca artikl
    //----------------
    public function returnItemFromCode($code)
    {
        $this->db->select('T.*', FALSE);
        $this->db->select('U.name AS user');
        $this->db->select('UD.name AS debtor');
        $this->db->select('I.name, I.description, I.price, I.code, I.image, I.item_type_id, I.item_status_id');
        $this->db->from('item_transactions AS T');
        $this->db->join('users AS U', 'T.user_id = U.id');
        $this->db->join('users AS UD', 'T.debtor_id = UD.id');
        $this->db->join('items AS I', 'T.item_id = I.id');
        $this->db->where('T.status', 0);
        $this->db->where('I.code', $code);
        $this->db->limit(1);
        $query = $this->db->get();

        if(count($query->result())>0)
        {
            $transaction = $query->result()[0];

            $date_array = getdate();
            $year = $date_array['year'];
            $month = $date_array['mon'];
            $day = $date_array['mday'];
            $hours = $date_array['hours'];
            $minutes = $date_array['minutes'];
            $seconds = $date_array['seconds'];

            $return_date = $year . "-" . $month . "-". $day .  " " . $hours . ":" . $minutes . ":" . $seconds;

            $transData = array(
                'date_returned' => $return_date,
                'status' => 1
            );

            $this->db->where('id', $transaction->id);
            $this->db->update('item_transactions', $transData);     // Ažuriramo podatke transakcije

            //Artikl status stavljamo na 1[Slobodan]
            $itemData = array(
                'item_status_id' => 1
            );

            $this->db->where('id', $transaction->item_id);
            $this->db->update('items', $itemData);     // Ažuriramo podatke artikla

            return $transaction;
        }
        else
        {
            return NULL;
        }
    }

    //-----------------------------
    //  Produzuje izdatak artikla
    //-----------------------------
    public function postponeItem()
    {
        $this->load->model('ModelHelper');
        $id = $this->input->post("transaction-id");
        $transaction = $this->ModelHelper->getTransactionFromID($id);
        $deadline = $this->input->post('deadline');

        $transData = array(
            'deadline' => $deadline,
            'status' => 0
        );

        $this->db->where('id', $transaction->id);
        $this->db->update('item_transactions', $transData);     // Ažuriramo podatke transakcije
    }

    //-------------------
    //  Brise zaduzenje
    //-------------------
    public function delete($transId)
    {
        if($transId != null)
        {
            $this->load->model('ModelHelper');
            $transaction = $this->ModelHelper->getTransactionFromID($transId);

            //Artikl status stavljamo na 1[Slobodan]
            $itemData = array(
                'item_status_id' => 1
            );

            $this->db->where('id', $transaction->item_id);
            $this->db->update('items', $itemData);     // Ažuriramo podatke artikla

            //Brišemo transakciju
            $this->db->where('id', $transId);
            return $this->db->delete('item_transactions');
        }
        else
        {
            return NULL;
        }
    }
}
?>
