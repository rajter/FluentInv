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
}
