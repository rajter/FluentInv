<?php

Class Item extends CI_Model
{

    public function __contruct()
    {
        // Call the CI_Model constructor
        parent::__construct();

    }

    //---------------------
    //  Vraca sve artikle
    //---------------------
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

    //------------------------------
    //  Vraca sve slobodne artikle
    //------------------------------
    public function getFree()
    {
        $this->db->select('I.*', FALSE);
        $this->db->select('T.name AS type');
        $this->db->select('S.status AS status');
        $this->db->from('items AS I');
        $this->db->join('item_type AS T', 'T.id = I.item_type_id');
        $this->db->join('item_status AS S', 'S.id = I.item_status_id');
        $this->db->where('I.item_status_id', 1);
        $query = $this->db->get();

        return $query->result();
    }

    //----------------------------
    //  Vraca odredjeni artikl
    //----------------------------
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
    //  Artikle koji nisu izdani
    //---------------------------------
    public function getAvailableFromCode($code)
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

    //----------------------------
    //  Vraca artikl prema kodu
    //----------------------------
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

    //----------------------------------
    //  Vraca sve transakcije za artikl
    //----------------------------------
    public function getTransactions($id, $limit=null)
    {
        if($id != null)
        {
            $this->db->select('IT.*', FALSE);
            $this->db->select('U.id AS UserId, U.Name AS User,U.surname AS UserSurname, U.email AS UserEmail, U.image AS UserImage', FALSE);
            $this->db->select('D.id AS DebtorId, D.Name AS Debtor,D.surname AS DebtorSurname, D.email AS DebtorEmail, D.image AS DebtorImage', FALSE);
            $this->db->from('item_transactions AS IT');
            $this->db->join('Users AS U', 'U.id = IT.user_id');
            $this->db->join('Users AS D', 'D.id = IT.debtor_id');
            $this->db->where('IT.item_id', $id);
            $this->db->where('IT.status', 1);
            $this->db->order_by('IT.date_taken DESC');
            if(!is_null($limit))
            {
                $this->db->limit($limit);
            }
            $query = $this->db->get();
            return $query->result();
        }
    }

    //-----------------
    //  Vraca duznike
    //-----------------
    public function getDebtors($id)
    {
        if($id != null)
        {
            $this->db->select("*");
            $this->db->from("items");
            $this->db->where("id", $id);
            $this->db->limit(1);
            $query = $this->db->get();
            $result = $query->result()[0];

            // return $result;

            if($result->item_status_id == 2)
            {
                $this->db->select('U.*');
                $this->db->select('IT.transaction_number AS TransNumber, IT.date_taken AS DateTaken, IT.deadline AS Deadline');
                $this->db->from('item_transactions as IT');
                $this->db->join('users AS U', 'IT.debtor_id = U.id');
                $this->db->where('IT.status = 0');
                $this->db->where('IT.item_id', $result->id);
                $this->db->limit(1);
                $query = $this->db->get();
                return $query->result()[0];
            }
            else {
                return NULL;
            }
        }
    }

    //-----------------------
    //  Kreira novi artikl
    //-----------------------
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

    //----------------------------------------------
    //  Provjera ako postoji artikl sa istim kodom
    //----------------------------------------------
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

    //----------------
    //  Brise artikl
    //----------------
    public function delete($id)
    {
        $this->db->select('COUNT(*) AS count');
        $this->db->from('item_transactions');
        $this->db->where('item_id', $id);
        $query = $this->db->get();

        $result = $query->result()[0];
        if($result->count > 0)
        {
            // Postavlja status artikla na otpisan
            $data = array(
                'item_status_id' => 3
            );

            $this->db->where('id', $id);
            $this->db->update('items', $data);

            // Vraca artikl ako je zauzet
            $this->load->model('transaction');
            $this->load->model('ModelHelper');
            $transaction = $this->ModelHelper->getTransactionFromItemID($id);
            if($transaction != null){ $this->transaction->returnItem($transaction->id);}

            return 'FALSE';
        }
        else {
            $this->db->where('id', $id);
            $this->db->delete('items');
            return 'TRUE';
        }
    }

    //----------------------------
    //  Uredjuje posojeci artikl
    //----------------------------
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

    //----------------------------------------------
    //  Mjenja status artikla iz otpisan u dostupan
    //----------------------------------------------
    public function changeStatus($id)
    {
        if($id != null)
        {
            $item = $this->get($id);

            if($item != null && $item->item_status_id == 3)
            {
                $data = array(
                    'item_status_id' => 1,
                );

                $this->db->where('id', $id);
                if($this->db->update('items', $data))
                    { return 'TRUE'; }
                else
                    { return 'FALSE'; }
            }
            else
            {
                return 'FALSE';
            }
        }
        else
        {
            return 'FALSE';
        }
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

    //-----------------------
    //  Vraca odredjeni tip
    //-----------------------
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

    //--------------------------------
    // Nadogradjuje novi tip artikala
    //--------------------------------
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
