<?php

//----------------------
//  SKLADIŠTE
//----------------------
Class Warehouse extends CI_Model
{
    public function __contruct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    //----------------------
    //  Vraća sva skladišta
    //----------------------
    public function getAll()
    {
        $this->db->select('L.*, A.address, A.city, A.zipcode, A.state, A.country', FALSE);
        $this->db->from('locations AS L');
        $this->db->join('address AS A', 'L.address_id = A.id');
        $query = $this->db->get();

        return $query->result();
    }

    //----------------------
    //  Vraća skladište po id-u
    //----------------------
    public function get($id)
    {
      if($id != null)
      {
            $this->db->select('L.*, A.address, A.city, A.zipcode, A.state, A.country', FALSE);
            $this->db->from('locations AS L');
            $this->db->join('address AS A', 'L.address_id = A.id');
            $query = $this->db->where('L.id', $id)
                            ->limit(1)
                            ->get();
            return $query->result()[0];
      }
    }

    //----------------------
    //  Kreira novo skladište
    //----------------------
    public function create()
    {
        $addressData = array(
            'address' => $this->input->post('address'),
            'city' => $this->input->post('city'),
            'zipcode' => $this->input->post('zipcode'),
            'state' => $this->input->post('state'),
            'country' => $this->input->post('country')
        );

        $this->db->insert('address', $addressData);
        $id = $this->db->insert_id();

        $warehouseData = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'address_id' => $id
        );

        return $this->db->insert('locations', $warehouseData);
    }

    //----------------------
    //  Nadogradjuje podatke skladišta
    //----------------------
    public function update()
    {
        $address_id = $this->input->post('address_id');
        $addressData = array(
            'address' => $this->input->post('address'),
            'city' => $this->input->post('city'),
            'zipcode' => $this->input->post('zipcode'),
            'state' => $this->input->post('state'),
            'country' => $this->input->post('country')
        );

        $this->db->where('id', $address_id);
        $this->db->update('address', $addressData);

        $id = $this->input->post('id');
        $warehouseData = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description')
        );

        $this->db->where('id', $id);
        return $this->db->update('locations', $warehouseData);
    }

    //------------------------------------------------------------------
    // Brise Skladište ako niti jedna transakcija ne koristi skladište
    //------------------------------------------------------------------
    public function delete($id)
    {
        $this->db->select('COUNT(*) AS count');
        $this->db->from('inventory_transactions');
        $this->db->where('location_id', $id);
        $this->db->where('from_location_id', $id);
        $query = $this->db->get();

        $result = $query->result()[0];
        if($result->count > 0)
        {
            return 'FALSE';
        }
        else {
            $this->db->where('id', $id);
            $this->db->delete('locations');
            return 'TRUE';
        }
    }

}
?>
