<?php

Class Employee extends CI_Model
{
    public $id;
    public $name;
    public $surname;
    public $role;

    public function __contruct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function getAll()
    {
        $query = $this->db->where('user_type_id', 2)
                        ->get('users');
        return $query->result();
    }

    public function get($id)
    {
      if($id != null)
      {
          $query = $this->db->where('id', $id)
                            ->where('user_type_id', 2)
                            ->limit(1)
                            ->get('users');
          return $query->result()[0];//result je uvijek array a zelimo samo prvi i jedini objekt
      }
    }

    public function create()
    {
        $this->load->helper('url');

        $data = array(
            'name' => $this->input->post('name'),
            'surname' => $this->input->post('surname'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
            'role' => $this->input->post('role'),
            'user_type_id' => 2,
            'login_date' => null
        );

        return $this->db->insert('users', $data);
    }

    public function update()
    {
        $this->load->helper('url');

        $data = array(
            'name' => $this->input->post('name'),
            'surname' => $this->input->post('surname'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
            'role' => $this->input->post('role'),
            'user_type_id' => 2,
            'login_date' => null
        );

        $id = $this->input->post('id');

        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->db->delete('users', array('id' => $id));
    }
}
?>
