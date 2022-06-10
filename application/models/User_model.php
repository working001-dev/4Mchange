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

            $this->db->select('u.fullName, u.userLoginId, u.userLoginName, u.firstName, u.lastName, u.fullName, u.email, u.roleId, r.roleName');
            $this->db->from('tbuser_login u');
            $this->db->join('tbrole r', 'u.roleId = r.roleId'); 
            $this->db->where('u.userLoginName', $_u);
            $this->db->where('u.userLoginPass', $_p);
            $this->db->where('u.isActive', 1);
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