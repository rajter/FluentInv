<?php

if(!defined("ITEM_TRANS")) define("ITEM_TRANS", "item_transaction", true);
if(!defined("TRANSACTIONS")) define("TRANSACTIONS", "inventory_transactions", true);

Class StockTaking extends CI_Model
{
    public function __contruct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->model(array('item', 'stock', 'stockTaking', 'dbQueries', 'modelHelper'));
    }

    public function getAll()
    {
        $this->db->select('ST.*', FALSE);
        $this->db->select('L.name AS location');
        $this->db->select('S.name AS user');
        $this->db->from('stock_takings AS ST');
        $this->db->join('locations AS L', 'ST.locations_id = L.id');
        $this->db->join('users AS S', 'ST.users_id = S.id');
        $query = $this->db->get();

        return $query->result();
    }

    //--------------------------------------
    //  Vraća inventuru sa određenim id-em
    //--------------------------------------
    public function get($id)
    {
        if($id != null)
        {
            $this->db->select('ST.*', FALSE);
            $this->db->select('L.name AS location');
            $this->db->select('S.name AS user');
            $this->db->from('stock_takings AS ST');
            $this->db->join('locations AS L', 'ST.locations_id = L.id');
            $this->db->join('users AS S', 'ST.users_id = S.id');
            $this->db->where('ST.id =', $id);
            $query = $this->db->get();

            return $query->result()[0];
        }
    }

    //----------------------------------
    //  Vraća zadnju zavrsenu inventuru
    //----------------------------------
    public function getLatest($locationID)
    {
        $this->db->select('*');
        $this->db->from('stock_takings');
        $this->db->where('locations_id', $locationID);
        $this->db->where('status', 1); // where STATUS is locked
        $this->db->order_by('date', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        if(count($query->result()) > 0)
        {
            return $query->result()[0];            
        }
        else {
            return null;
        }
    }

    private function checkIfThereAreOpenStockTakings($locationID)
    {
        $this->db->select('*');
        $this->db->from('stock_takings');
        $this->db->where('locations_id', $locationID);
        $this->db->limit(1);
        $query = $this->db->get();

        $result = $query->result()[0];
        if($result->status == 0 && $result->status != NULL)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //-------------------------
    //  Kreira novu inventuru
    //-------------------------
    public function create($session_id)
    {
        $this->load->helper('url');

        $user_id = $session_id;
        $date = $this->input->post('date');
        $location = $this->input->post('location');
        $footnote = $this->input->post('footnote');
        $stock_taking_number = $this->input->post('stock_taking_number');

        if(!$this->checkIfThereAreOpenStockTakings($location)) // PROVJERA AKO POSTOJI OTVORENA INVENTURA ZA ODREDJENU LOKACIJU
        {
            $date_array = getdate();
            $hours = $date_array['hours'];
            $minutes = $date_array['minutes'];
            $seconds = $date_array['seconds'];

            $date = $date . " " . $hours . ":" . $minutes . ":" . $seconds;

            $stock_taking = array(
                'stock_taking_number' => $stock_taking_number,
                'date' => $date,
                'status' => 0,
                'locations_id' => $location,
                'users_id' => $user_id,
                'footnote' => $footnote
            );

            $inventura_transaction_number = $this->modelHelper->returnMaxTransNumber(6);
            $inventura = array(
                'transaction_number' => $inventura_transaction_number,
                'transaction_type_id' => 6,
                'client_id' => 1,
                'location_id' => $location,
                'from_location_id' => $location,
                'user_id' => $user_id,
                'date' => $date,
                'footnote' => $footnote
            );

            // $otpisnica_transaction_number = $this->modelHelper->returnMaxTransNumber(4);
            // $otpisnica = array(
            //     'transaction_number' => $otpisnica_transaction_number,
            //     'transaction_type_id' => 4,
            //     'client_id' => 1,
            //     'location_id' => $location,
            //     'from_location_id' => $location,
            //     'user_id' => $user_id,
            //     'date' => $date,
            //     'footnote' => $footnote
            // );

            $ispravak_transaction_number = $this->modelHelper->returnMaxTransNumber(5);
            $ispravak = array(
                'transaction_number' => $ispravak_transaction_number,
                'transaction_type_id' => 5,
                'client_id' => 1,
                'location_id' => $location,
                'from_location_id' => $location,
                'user_id' => $user_id,
                'date' => $date,
                'footnote' => $footnote
                );

            $zakljucak_transaction_number = $this->modelHelper->returnMaxTransNumber(7);
            $zakljucak = array(
                'transaction_number' => $zakljucak_transaction_number,
                'transaction_type_id' => 7,
                'client_id' => 1,
                'location_id' => $location,
                'from_location_id' => $location,
                'user_id' => $user_id,
                'date' => $date,
                'footnote' => $footnote
                );

                $this->db->insert('stock_takings', $stock_taking);
                $stock_taking_id = $this->db->insert_id();

                $this->db->insert(TRANSACTIONS, $inventura);
                $inventura_trans_id = $this->db->insert_id();
                // $inventura_trans_id = $this->receipt->get($inventura_transaction_number)[0]->trans_id;

                // $this->db->insert(TRANSACTIONS, $otpisnica);
                // $otpisnica_trans_id = $this->db->insert_id();
                // $inventura_trans_id = $this->receipt->get($otpisnica_transaction_number)[0]->trans_id;

                $this->db->insert(TRANSACTIONS, $ispravak);
                $ispravak_trans_id = $this->db->insert_id();
                // $inventura_trans_id = $this->receipt->get($ispravak_transaction_number)[0]->trans_id;

                $this->db->insert(TRANSACTIONS, $zakljucak);
                $zakljucak_trans_id = $this->db->insert_id();
                // $inventura_trans_id = $this->receipt->get($ispravak_transaction_number)[0]->trans_id;

                $this->db->insert('inventory_stock_takings', array( 'inventory_transactions_id' => $inventura_trans_id, 'stock_takings_id' => $stock_taking_id));
                // $this->db->insert('inventory_stock_takings', array( 'inventory_transactions_id' => $otpisnica_trans_id, 'stock_takings_id' => $stock_taking_id));
                $this->db->insert('inventory_stock_takings', array( 'inventory_transactions_id' => $ispravak_trans_id, 'stock_takings_id' => $stock_taking_id));
                $this->db->insert('inventory_stock_takings', array( 'inventory_transactions_id' => $zakljucak_trans_id, 'stock_takings_id' => $stock_taking_id));

                //-------------------------------------------
                //  Unose se artikli u inventurnu transakciju
                //-------------------------------------------
                $itemStocks = $this->stock->getItemStocks($location);

                // Dodajemo artkikle u inventurnu transakciju
                foreach ($itemStocks as $item) {
                    $transaction = array(
                    'inventory_transaction_id' => $inventura_trans_id,
                    'item_id' => $item->item_id,
                    'quantity' => $item->quantity
                    );

                    $this->db->insert(ITEM_TRANS, $transaction);
                }

                // Dodajemo artkikle u transakcijski ispravak
                foreach ($itemStocks as $item) {
                    $transaction = array(
                    'inventory_transaction_id' => $ispravak_trans_id,
                    'item_id' => $item->item_id,
                    'quantity' => $item->quantity
                    );

                    $this->db->insert(ITEM_TRANS, $transaction);
                }

        }   // END OF CHECK

    }

    //------------------------------------------
    //  Vraca artikle iz inventurne transakcije
    //------------------------------------------
    public function getItemQuantities($transID)
    {
        if($transID != null)
        {
            // Tražimo id od inventurne transakcije
            $this->db->select('IT.id');
            $this->db->from('inventory_stock_takings AS IST');
            $this->db->join('stock_takings AS ST','IST.stock_takings_id=ST.id');
            $this->db->join('inventory_transactions AS IT','IST.inventory_transactions_id = IT.id');
            $this->db->where('IST.stock_takings_id',$transID);
            $this->db->where('IT.transaction_type_id', 6);
            $query = $this->db->get();
            $id = $query->result()[0]->id;

            // Pokupimo sve artikle sa količinama
            $this->db->select('*');
            $this->db->from('item_transaction AS IT');
            $this->db->join('items AS I', 'IT.item_id = I.id');
            $this->db->where('IT.inventory_transaction_id =', $id);
            $query = $this->db->get();

            return $query->result();
        }
    }

    public function getCorrectionQuantities($transID)
    {
        if($transID != null)
        {
            // Tražimo id od inventurne transakcije
            $this->db->select('IT.id');
            $this->db->from('inventory_stock_takings AS IST');
            $this->db->join('stock_takings AS ST','IST.stock_takings_id=ST.id');
            $this->db->join('inventory_transactions AS IT','IST.inventory_transactions_id = IT.id');
            $this->db->where('IST.stock_takings_id',$transID);
            $this->db->where('IT.transaction_type_id', 5);
            $query = $this->db->get();
            $id = $query->result()[0]->id;

            // Pokupimo sve artikle sa količinama
            $this->db->select('*');
            $this->db->from('item_transaction AS IT');
            $this->db->join('items AS I', 'IT.item_id = I.id');
            $this->db->where('IT.inventory_transaction_id =', $id);
            $query = $this->db->get();

            return $query->result();
        }
    }

    //--------------------------------
    //  Provjerava i brise inventuru
    //--------------------------------
    public function delete($id)
    {
        $this->db->select('status');
        $this->db->from('stock_takings');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $result = $query->result()[0];

        // Provjerava ako je inventura zaključana
        // ako nije briše inventuru
        if($result->status != 0)
        {
            return 'FALSE';
        }
        else {
            $this->db->select('*');
            $this->db->from('inventory_stock_takings');
            $this->db->where('stock_takings_id', $id);
            $query = $this->db->get();
            $result = $query->result();

            foreach ($result as $invTrans) {
                $transId = $invTrans->inventory_transactions_id;
                $this->db->where('id', $transId);
                $this->db->delete(TRANSACTIONS);
            }

            $this->db->where('id', $id);
            $this->db->delete('stock_takings');
            return 'TRUE';
        }
    }

    public function update($user_id)
    {

        $items = $this->input->post('item_id');         //  hidden input element
        $quantities = $this->input->post('item_qnt');   //  hidden input element

        $mapedQuantities = array_combine($items, $quantities);  // mapiramo id-eve artikala sa kolicinama

        $stock_taking_id = $this->input->post('transaction_id');

        $this->db->select('IT.id');
        $this->db->from('inventory_stock_takings AS IST');
        $this->db->join('stock_takings AS ST','IST.stock_takings_id=ST.id');
        $this->db->join('inventory_transactions AS IT','IST.inventory_transactions_id = IT.id');
        $this->db->where('IST.stock_takings_id',$stock_taking_id);
        $this->db->where('IT.transaction_type_id', 5);
        $query = $this->db->get();
        $inv_trans_id = $query->result()[0]->id;

        // echo $inv_trans_id;

        $data = array(
            'user_id' => $user_id
        );

        $this->db->where('inventory_transaction_id', $inv_trans_id);
        $this->db->delete('item_transaction');      // Brišemo sve artikle iz primke

        $this->db->where('id', $inv_trans_id);
        $this->db->update(TRANSACTIONS, $data);     // Ažuriramo podatke primke

        // Dodajemo artkikle
        foreach ($items as $item) {
            $transaction = array(
                'inventory_transaction_id' => $inv_trans_id,
                'item_id' => $item,
                'quantity' => $mapedQuantities[$item]
            );

            $this->db->insert(ITEM_TRANS, $transaction);
        }
    }

    //------------------------------------------
    //  Provjerava ako je inventura zakljucana
    //------------------------------------------
    public function checkIfLocked($id)
    {
        $this->db->select('status');
        $this->db->from('stock_takings');
        $this->db->where('id', $id);
        $query = $this->db->get();
        (int)$result = $query->result()[0]->status;

        if($result == 0)
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    //-------------------------
    //  Zakljucava inventuru
    //-------------------------
    public function lock($user_id)
    {
        $date = $this->input->post('date');
        $location = $this->input->post('location');

        $items = $this->input->post('item_id');         //  hidden input element
        $quantities = $this->input->post('item_qnt');   //  hidden input element

        $mapedQuantities = array_combine($items, $quantities);  // mapiramo id-eve artikala sa kolicinama

        $stock_taking_id = $this->input->post('transaction_id');

        $this->db->select('IT.id');
        $this->db->from('inventory_stock_takings AS IST');
        $this->db->join('stock_takings AS ST','IST.stock_takings_id=ST.id');
        $this->db->join('inventory_transactions AS IT','IST.inventory_transactions_id = IT.id');
        $this->db->where('IST.stock_takings_id',$stock_taking_id);
        $this->db->where('IT.transaction_type_id', 7);
        $query = $this->db->get();
        $inv_trans_id = $query->result()[0]->id;

        $this->db->where('inventory_transaction_id', $inv_trans_id);
        $this->db->delete('item_transaction');      // Brišemo sve artikle iz zakljucka

        // Dodajemo artkikle u zakljucak
        foreach ($items as $item) {
            $transaction = array(
                'inventory_transaction_id' => $inv_trans_id,
                'item_id' => $item,
                'quantity' => $mapedQuantities[$item]
            );

            // echo var_dump($transaction);
            $this->db->insert(ITEM_TRANS, $transaction);
        }

        // echo var_dump($mapedQuantities);


        //Promjenit status inventure iz 0 u 1(zakljucano)

        // echo var_dump($stock_taking_id);
        $this->db->where('id', $stock_taking_id);
        $this->db->update('stock_takings', array('status' => 1));

    }



}
?>
