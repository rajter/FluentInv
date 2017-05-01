<?php

//----------------------
//  SKLADIŠTE
//----------------------
Class Client extends CI_Model
{
    public function __contruct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    //----------------------
    //  Vraća sve klijente
    //----------------------
    public function getAll()
    {
        $this->db->select('C.*, A.address, A.city, A.zipcode, A.state, A.country, CT.type', FALSE);
        $this->db->from('clients AS C');
        $this->db->join('address AS A', 'C.address_id = A.id');
        $this->db->join('client_type AS CT', 'C.client_type_id=CT.id');
        $query = $this->db->get();

        return $query->result();
    }

    //----------------------
    //  Vraća klijenta po id-u
    //----------------------
    public function get($id)
    {
      if($id != null)
      {
            $this->db->select('C.*, A.address, A.city, A.zipcode, A.state, A.country', FALSE);
            $this->db->from('clients AS C');
            $this->db->join('address AS A', 'C.address_id = A.id');
            $query = $this->db->where('C.id', $id)
                            ->limit(1)
                            ->get();
            return $query->result()[0];
      }
    }

    //----------------------
    //  Kreira novog klijenta
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

        $clientData = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'tel' => $this->input->post('tel'),
            'fax' => $this->input->post('fax'),
            'email' => $this->input->post('email'),
            'address_id' => $id,
            'client_type_id' => $this->input->post('clientType')
        );

        return $this->db->insert('clients', $clientData);
    }

    //--------------------------------
    //  Nadogradjuje podatke klijenta
    //--------------------------------
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
        $clientData = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'tel' => $this->input->post('tel'),
            'fax' => $this->input->post('fax'),
            'email' => $this->input->post('email'),
            'address_id' => $id,
            'client_type_id' => $this->input->post('clientType')
        );

        $this->db->where('id', $id);
        return $this->db->update('clients', $clientData);
    }

    //------------------------------------------------------------------
    // Brise Klijenta ako niti jedna transakcija ne koristi tog klijenta
    //------------------------------------------------------------------
    public function delete($id)
    {
        $this->db->select('COUNT(*) AS count');
        $this->db->from('inventory_transactions');
        $this->db->where('client_id', $id);
        $query = $this->db->get();

        $result = $query->result()[0];
        if($result->count > 0)
        {
            return 'FALSE';
        }
        else {
            // Brisemo sve kontakte jer bi javilo gresku Internal Server error
            // zbog foreign key constrainta
            $this->db->where('clients_id', $id);
            $this->db->delete('clients_has_contacts');
            //Brisemo klijenta
            $this->db->where('id', $id);
            $this->db->delete('clients');
            return 'TRUE';
        }
    }

}
?>
