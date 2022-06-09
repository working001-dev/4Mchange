<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class User_model extends CI_Model { 
        public $title;
        public $content;
        public $date;

        public function getting_login_system()
        {
            $_u = ($_POST['userName'] ?? ""); // please read the below note
            $_p = md5($_POST['passWord'] ?? "");

            $this->db->select('tbuser_login.fullName, tbuser_login.firstName, tbrole.roleName');
            $this->db->from('tbuser_login');
            $this->db->join('tbrole', 'tbuser_login.roleId = tbrole.roleId'); 
            $this->db->where('userLoginName', $_u);
            $this->db->where('userLoginPass', $_p);
            $query = $this->db->get();
            return $query->result();
        }

        public function insert_entry()
        {
                $this->title    = $_POST['title']; // please read the below note
                $this->content  = $_POST['content'];
                $this->date     = time();

                $this->db->insert('entries', $this);
        }

        public function update_entry()
        {
                $this->title    = $_POST['title'];
                $this->content  = $_POST['content'];
                $this->date     = time();

                $this->db->update('entries', $this, array('id' => $_POST['id']));
        } 
    }
?>