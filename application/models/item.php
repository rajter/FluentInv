<?php

Class Item extends CI_Model
{

    public function __contruct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function getAll()
    {
        $this->db->select('I.*', FALSE);
        $this->db->select('T.name AS type');
        $this->db->select('S.status AS status');
        $this->db->from('items AS I');
        $this->db->join('item_type AS T', 'T.id = I.item_type_id');
        $this->db->join('item_status AS S', 'S.id = I.item_status_id');
        $query = $this->db->get();

        return $query->result();
    }

    public function get($id)
    {
      if($id != null)
      {
            $this->db->select('I.*', FALSE);
            $this->db->select('T.name AS type');
            $this->db->select('S.status AS status');
            $this->db->from('items AS I');
            $this->db->join('item_type AS T', 'T.id = I.item_type_id');
            $this->db->join('item_status AS S', 'S.id = I.item_status_id');
            $query = $this->db->where('I.id', $id)
                            ->limit(1)
                            ->get();
            return $query->result()[0];
      }
    }

    //---------------------------------
    //  Vraca artikle koji su dostupni
    //  oni artikli koji nisu izdani
    //---------------------------------
    public function getAvailable()
    {
        # code...
    }

    public function getFromCode($code)
    {
      if($code != null)
      {
            $this->db->select('I.*', FALSE);
            $this->db->select('T.name AS type');
            $this->db->select('S.status AS status');
            $this->db->from('items AS I');
            $this->db->join('item_type AS T', 'T.id = I.item_type_id');
            $this->db->join('item_status AS S', 'S.id = I.item_status_id');
            $query = $this->db->where('I.code', $code)
                            ->limit(1)
                            ->get();
            if(!empty($query->result()))
            {
                return $query->result()[0];
            }
            else
            {
                return NULL;
            }
      }
    }

    //
    //  Vraca sveukupno kolicinu artikla po svim lokacijama
    //
    public function getQuantitiesByLocation($id)
    {
        if($id != null)
        {
            $this->db->select('SUM(IF(INV.transaction_type_id = 1 OR INV.transaction_type_id = 3, IT.quantity, -IT.quantity)) AS SUM, IT.*, INV.*', FALSE);
            $this->db->select('L.*', FALSE);
            $this->db->from('item_transaction AS IT');
            $this->db->join('inventory_transactions INV', 'IT.inventory_transaction_id = INV.id');
            $this->db->join('locations L', 'L.id = INV.location_id');
            $this->db->where('IT.item_id', $id);
            $this->db->group_by('INV.location_id');
            $query = $this->db->get();
            return $query->result();
        }
    }

    //
    //  Vraca sve transakcije za artikl
    //
    public function getTransactions($id, $limit=null)
    {
        if($id != null)
        {
            $this->db->select('IT.*, INV.*', FALSE);
            $this->db->select('LIN.name AS Location_IN, LOUT.name AS Location_OUT');
            $this->db->select('TT.description AS TransactionType');
            $this->db->select('C.name AS ClientName');
            $this->db->from('item_transaction AS IT');
            $this->db->join('inventory_transactions INV', 'IT.inventory_transaction_id = INV.id');
            $this->db->join('locations LIN', 'INV.location_id = LIN.id');
            $this->db->join('locations LOUT', 'INV.from_location_id = LOUT.id');
            $this->db->join('transaction_type AS TT', 'TT.id = INV.transaction_type_id');
            $this->db->join('clients as C', 'INV.client_id = C.id');
            $this->db->where('IT.item_id', $id);
            $this->db->order_by('INV.date DESC');
            if(!is_null($limit))
            {
                $this->db->limit($limit);
            }
            $query = $this->db->get();
            return $query->result();
        }
    }

    public function getDebtors($id)
    {
        if($id != null)
        {

        }
    }

    /*
    *   Vraca artikle sa kolicinama za odredjenu transakciju
    *   artikli koji nisu u transakciji imat ce kolicinu 0
    */
    public function getItemsQuantity($trans_id)
    {
        $this->db->select("I.*");
        $this->db->select("T.name AS type");
        $this->db->select("IT.inventory_transaction_id, SUM(IF(IT.inventory_transaction_id = $trans_id, IT.quantity, 0)) AS quantity");
        $this->db->from("items AS I");
        $this->db->join("item_type AS T", "T.id = I.item_type_id");
        $this->db->join("item_transaction AS IT", " I.id = IT.item_id");
        $this->db->group_by("I.id");

        $query = $this->db->get();

        return $query->result();
    }

    public function create()
    {
        $this->load->helper('url');

        $data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'item_type_id' => $this->input->post('item_type_id'),
            'item_status_id' => 1,
            'code' => $this->input->post('code'),
            'price' => $this->input->post('price'),
            'image' => $this->input->post('image')
        );

        return $this->db->insert('items', $data);
    }

    public function checkCodeForDuplicate($code)
    {
        if($code != null)
        {
            $this->db->select('*', FALSE);
            $this->db->from('items');
            $query = $this->db->where('items.code', $code)->get();

            if($query->num_rows() > 0)
            {
                return $query->result()[0];
            }
            else {
                return null;
            }
        }
    }

    public function CheckIfDeletable($id)
    {

    }

    public function delete($id)
    {
        $this->db->select('COUNT(*) AS count');
        $this->db->from('item_transaction');
        $this->db->where('item_id', $id);
        $query = $this->db->get();

        $result = $query->result()[0];
        if($result->count > 0)
        {
            return 'FALSE';
        }
        else {
            $this->db->where('id', $id);
            $this->db->delete('items');
            return 'TRUE';
        }
    }

    public function update()
    {
        $this->load->helper('url');

        $data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'item_type_id' => $this->input->post('item_type_id'),
            'code' => $this->input->post('code'),
            'price' => $this->input->post('price'),
            'image' => preg_replace('/\s+/', '', $this->input->post('image'))    //$string = preg_replace('/\s+/','',$string); - removes tabs and spaces from string
        );

        $id = $this->input->post('id');

        $this->db->where('id', $id);
        return $this->db->update('items', $data);
    }

    //----------------------------
    //  Vraca sve tipove artikala
    //----------------------------
    public function getAllTypes()
    {
        $this->db->select('*', FALSE);
        $this->db->from('item_type');
        $query = $this->db->get();
        return $query->result();
    }

    //----------------------------
    //  Vraca odredjeni tip
    //----------------------------
    public function getType($id)
    {
        $this->db->select('*', FALSE);
        $this->db->from('item_type');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result()[0];
    }

    //---------------------------
    // Kreira novi tip artikala
    //---------------------------
    public function createItemType($user_id)
    {
        $data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
        );

        return $this->db->insert('item_type', $data);
    }

    //---------------------------
    // Nadogradjuje novi tip artikala
    //---------------------------
    public function updateItemType($user_id)
    {
        $id = $this->input->post('id');
        $data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
        );

        $this->db->where('id', $id);
        return $this->db->update('item_type', $data);
    }

    //----------------------------------------------------------
    // Brise Tip ako niti jedan artikl nema pridruzeni taj tip
    //----------------------------------------------------------
    public function deleteType($id)
    {
        $this->db->select('COUNT(*) AS count');
        $this->db->from('items');
        $this->db->where('item_type_id', $id);
        $query = $this->db->get();

        $result = $query->result()[0];
        if($result->count > 0)
        {
            return 'FALSE';
        }
        else {
            $this->db->where('id', $id);
            $this->db->delete('item_type');
            return 'TRUE';
        }
    }
}
