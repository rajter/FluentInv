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

}
?>
