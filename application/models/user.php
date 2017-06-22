<?php

Class User extends CI_Model
{
    function login($username, $password) {
        $this -> db -> select('id, username, password');
        $this -> db -> from('users');
        $this -> db -> where('username', $username);
        $this -> db -> where('password', MD5($password));
        $this -> db -> where("(user_type_id = 1 OR user_type_id = 2)");
        $this -> db -> limit(1);

        $query = $this -> db -> get();
        $result = $query->result();
        $q = $this->db->last_query();

        if($query -> num_rows() == 1)
        {
           $date_array = getdate();
           $year = $date_array['year'];
           $month = $date_array['mon'];
           $day = $date_array['mday'];
           $hours = $date_array['hours'];
           $minutes = $date_array['minutes'];
           $seconds = $date_array['seconds'];

           $date = $year."-".$month."-".$day. " " . $hours . ":" . $minutes . ":" . $seconds;

           $this->db->set('login_date', $date);
           $this->db->where('id', $query->result()[0]->id);
           $this->db->update('users');

           return $query->result();
        }
        else
        {
         return false;
        }
    }

    public function checkIfAdmin($id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $id);

        $query = $this->db->get();
        $result = $query->result()[0];

        if($result->user_type_id == 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //----------------------------------------
    //  Skladište za koje je korisnik zaduđen
    //----------------------------------------
    public function getLocation($user_id)
    {
        $this->db->select('L.*');
        $this->db->from('locations AS L');
        $this->db->join('users AS U', 'L.id = U.location_id');
        $this->db->where('U.id', $user_id);
        $this->db->limit(1);

        $query = $this->db->get();
        return $query->result()[0];
    }

    //----------------------------
    //  Vraca sve usere
    //----------------------------
    public function getAll()
    {
        $this->db->select('U.id, U.username, U.password, U.image, U.email, U.name, U.surname, U.role, U.user_type_id, U.login_date, L.name AS warehouse, UT.id AS UserTypeID, UT.name AS UserType');
        $this->db->from('users AS U');
        $this->db->join('locations AS L', 'L.id = U.location_id');
        $this->db->join('user_type AS UT', 'U.user_type_id = UT.id');

        $query = $this->db->get();
        return $query->result();
    }

    //----------------------------
    //  Vraca odredjenog usera
    //----------------------------
    public function get($id)
    {
        if($id != null)
        {
            $this->db->select('U.id, U.username, U.password, U.image, U.email, U.name, U.surname, U.role, U.user_type_id, U.login_date, L.name AS warehouse, UT.id AS UserTypeID, UT.name AS UserType');
            $this->db->from('users AS U');
            $this->db->join('locations AS L', 'L.id = U.location_id');
            $this->db->join('user_type AS UT', 'U.user_type_id = UT.id');
            $this->db->where('U.id', $id);
            $this->db->limit(1);

            $query = $this->db->get();
            return $query->result()[0];//result je uvijek array a zelimo samo prvi i jedini objekt
        }
    }

    //----------------------------
    //  Kreira novog usera
    //----------------------------
    public function create()
    {
        $this->load->helper('url');

        $data = array(
            'name' => $this->input->post('name'),
            'surname' => $this->input->post('surname'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
            'image' => 'avatar.png',
            'role' => 'Skladištar',
            'location_id' => $this->input->post('location'),
            'user_type_id' => $this->input->post('user_type'),
            'login_date' => null
        );

        return $this->db->insert('users', $data);
    }

    //----------------------------
    //  Azurira podatke usera
    //----------------------------
    public function update()
    {
        $this->load->helper('url');

        $data = array(
            'name' => $this->input->post('name'),
            'surname' => $this->input->post('surname'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
            'role' => 'Skladištar',
            'location_id' => $this->input->post('location'),
            'user_type_id' => $this->input->post('user_type')
        );

        $id = $this->input->post('id');

        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    //----------------------------
    //  Brise usera
    //----------------------------
    public function delete()
    {
        // $id = $this->input->post('id');
        // $this->db->delete('users', array('id' => $id));
    }

}
?>
