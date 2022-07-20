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

            $this->db->select("u.fullName, u.userLoginId, u.userLoginName, u.firstName, u.lastName, u.fullName, ifnull(u.email,'') email, u.roleId, r.roleName, u.userImg, u.userGender");
            $this->db->from('tbuser_login u');
            $this->db->join('tbrole r', 'u.roleId = r.roleId'); 
            $this->db->where('u.userLoginName', $_u);
            $this->db->where('u.userLoginPass', $_p);
            $this->db->where('u.isActive', 1);
            $query = $this->db->get();
            return $query->result();
        }

        public function getting_group_menu($_roleId)
        {
            $this->db->distinct();
            $this->db->select('mr.roleId, r.roleName, g.groupMenuId, g.groupMenuName, g.icon');
            $this->db->from('tbrole_menu mr');
            $this->db->join('tbrole r', 'mr.roleId = r.roleId');
            $this->db->join('tbgroup_menu g', 'mr.groupMenuId = g.groupMenuId'); 
            $this->db->where('mr.roleId', $_roleId); 
            $this->db->where('mr.isActive', 1);
            $query = $this->db->get();
            return $query->result();
        }

        public function getting_menu($_roleId)
        {
            $this->db->select('mr.roleMenuId, r.roleName, g.groupMenuId, g.groupMenuName, g.icon, m.menuId, m.menuName, m.menuLink, m.menuDescription');
            $this->db->from('tbrole_menu mr');
            $this->db->join('tbrole r', 'mr.roleId = r.roleId');
            $this->db->join('tbgroup_menu g', 'mr.groupMenuId = g.groupMenuId');
            $this->db->join('tbmenu m', 'mr.menuId = m.menuId');  
            $this->db->where('mr.roleId', $_roleId); 
            $this->db->where('mr.isActive', 1);
            $query = $this->db->get();
            return $query->result();
        }
        
        public function getting_role_group($id = 0){
            $this->db->select('rog.roleGroupId, rog.roleGroupName, rog.description, rog.isActive');
            $this->db->from('tbrole_group rog');
            $this->db->where('rog.isDeleted', 0);    
            if( $id != 0 ){
                $this->db->where('rog.roleGroupId', $id); 
            }
            $query = $this->db->get();
            return $query->result();            
        }
        public function setting_role_group($data){
            $id = 0;
            $query = $this->db->insert_batch('tbrole_group', $data);
            if( $query == 1){ 
                $id = $this->db->insert_id(); 
            } 
            return $this->getting_role_group($id); 
        }
        public function updating_role_group_data($id, $userId, $value){
            $dateTime = date('Y-m-d H:i:s'); 
 
            $this->db->set('roleGroupName', "'{$value["groupName"]}'", FALSE);
            $this->db->set('description', "'{$value["description"]}'", FALSE);
            $this->db->set('isActive', 0, FALSE); 
            $this->db->set('updateDate', "'{$dateTime}'", FALSE);
            $this->db->set('updateBy', $userId, FALSE);
            $this->db->where('roleGroupId', $id);
            $query = $this->db->update('tbrole_group');
            return $query; 
        }
        public function updating_role_group_acitve($id, $status, $userId){
            $dateTime = date('Y-m-d H:i:s'); 
            $this->db->set('isActive', $status, FALSE);
            $this->db->set('updateDate', "'{$dateTime}'", FALSE);
            $this->db->set('updateBy', $userId, FALSE);
            $this->db->where('roleGroupId', $id);
            $query = $this->db->update('tbrole_group');
            return $query; 
        }
        public function updating_role_group_deleted($id, $userId){
            $dateTime = date('Y-m-d H:i:s'); 
            $this->db->set('isActive', 0, FALSE);
            $this->db->set('isDeleted', 1, FALSE);
            $this->db->set('updateDate', "'{$dateTime}'", FALSE);
            $this->db->set('updateBy', $userId, FALSE);
            $this->db->where('roleGroupId', $id);
            $query = $this->db->update('tbrole_group');
            return $query; 
        }
        // public function update_entry()
        // {
        //         $this->title    = $_POST['title'];
        //         $this->content  = $_POST['content'];
        //         $this->date     = time();

        //         $this->db->update('entries', $this, array('id' => $_POST['id']));
        // } 
    }
?>