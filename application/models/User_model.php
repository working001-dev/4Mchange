<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    date_default_timezone_set("Asia/Bangkok");
    class User_model extends CI_Model { 
        public $title;
        public $content;
        public $date;

        #region For First Login
        public function getting_login_system()
        {
            $_u = ($_POST['userName'] ?? ""); // please read the below note
            $_p = md5($_POST['passWord'] ?? "");

            $this->db->select("
            u.fullName, 
            u.userLoginId, 
            u.userLoginName, 
            u.firstName, 
            u.lastName, 
            u.fullName, 
            ifnull(u.email,'') email, 
            u.roleId, 
            r.roleName, 
            u.userImg, 
            u.userGender,
            u.roleGroupId,
            g.roleGroupName
            ");
            $this->db->from('tbuser_login u');
            $this->db->join('tbrole r', 'u.roleId = r.roleId');
            $this->db->join('tbrole_group g', 'u.roleGroupId = g.roleGroupId');  
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
            $this->db->order_by("g.groupMenuId", "asc");
            $query = $this->db->get(); 
            return $query->result();
        }

        public function getting_menu($_roleId)
        { 
            $this->db->distinct();
            $this->db->select("mr.roleMenuId, r.roleName, g.groupMenuId, g.groupMenuName, g.icon, m.menuId, m.menuName, m.menuLink, m.menuDescription, '1' isPer ");
            $this->db->from('tbrole_menu mr');
            $this->db->join('tbrole r', 'mr.roleId = r.roleId');
            $this->db->join('tbgroup_menu g', 'mr.groupMenuId = g.groupMenuId');
            $this->db->join('tbmenu m', 'mr.menuId = m.menuId');  
            $this->db->where('mr.roleId', $_roleId); 
            $this->db->where('mr.isActive', 1);
            $this->db->order_by("g.groupMenuId", "asc");
            $query = $this->db->get();

            return $query->result();
        }

        public function updating_LastDateTime($userId){
 
            $dateTime = date('Y-m-d H:i:s');
            $this->db->set('userLastDateTime', "'{$dateTime}'", FALSE); 
            $this->db->where('userLoginId', $userId); 
            $query = $this->db->update('tbuser_login');
            return $query; 
        }         
        #endregion

        #region For Manage User
        public function getting_user_list()
        { 

            $this->db->select("
            u.userLoginId,
            u.userLoginName,
            u.fullName,
            u.firstName,
            u.lastName,
            r.roleName,
            g.roleGroupName,
            u.userGender,
            u.userImg,
            u.email,
            u.isActive,
            u.roleGroupId,
            u.roleId
            ");
            $this->db->from('tbuser_login u');
            $this->db->join('tbrole r', 'u.roleId = r.roleId');
            $this->db->join('tbrole_group g', 'u.roleGroupId = g.roleGroupId');
            $query = $this->db->get(); 
            return $query->result();
        }
        public function updating_user_acitve($id, $status, $userId){
            $dateTime = date('Y-m-d H:i:s'); 
            $this->db->set('isActive', $status, FALSE);
            $this->db->set('updateDateTime', "'{$dateTime}'", FALSE);
            $this->db->set('updateBy', $userId, FALSE);
            $this->db->where('userLoginId', $id);
            $query = $this->db->update('tbuser_login');
            return $query; 
        }
 
        #endregion

        #region For Create User
        public function setting_user_login($data){ 
            $dup = $this->chacking_user_insys($data[0]["userLoginName"]);
            if(empty($dup)){
                return $this->db->insert_batch('tbuser_login', $data);
            }else return array(array("dup"=>"true")); 
        }  
        public function chacking_user_insys($user){ 
            $this->db->select("'1' res");
            $this->db->from('tbuser_login u');
            $this->db->limit(1);
            $this->db->where('u.userLoginName', $user); 
            $query = $this->db->get();
            //var_dump($this->db->last_query());  exit;
            return $query->result(); 
        }         
        #endregion 

        #region For Edit Profile
        public function updating_user_login($upd, $loginId){
            $this->db->where('userLoginId', $loginId);
            return $this->db->update('tbuser_login', $upd);
        } 
        #endregion

        #region For Change Password
        public function chacking_user_pass($user, $pass){
            $pass = md5($pass ?? "");  
            $this->db->select("'1' res");
            $this->db->from('tbuser_login u');
            $this->db->limit(1);
            $this->db->where('u.userLoginId', $user);
            $this->db->where('u.userLoginPass', $pass); 
            $query = $this->db->get();
            //var_dump($this->db->last_query());  exit;
            return $query->result(); 
        } 
        public function updating_new_pass($update){
            $old_pass = md5($update["old_pass"] ?? "");
            $new_pass = md5($update["new_pass"] ?? ""); 
            $userId = $update["userId"];  
            $dateTime = date('Y-m-d H:i:s'); 
 
            $this->db->set('userLoginPass', "'{$new_pass}'", FALSE); 
            $this->db->set('updateDateTime', "'{$dateTime}'", FALSE);
            $this->db->set('updateBy', $userId, FALSE);
            $this->db->where('userLoginId', $userId);
            $this->db->where('userLoginPass', $old_pass); 
            $query = $this->db->update('tbuser_login');
            return $query; 
        } 
        #endregion

        #region For page Permission Group
        public function getting_menu_master()
        { 
            $this->db->distinct();
            $this->db->select("r.groupMenuId, g.groupMenuName, g.icon, r.menuId, m.menuName, '0' isPer");
            $this->db->from('tbrole_menu r');
            $this->db->join('tbgroup_menu g', 'r.groupMenuId = g.groupMenuId'); 
            $this->db->join('tbmenu m', 'r.menuId = m.menuId'); 
            $this->db->where('m.isActive', 1);
            $query = $this->db->get();
            return $query->result();
        }        
        public function setting_role_menu($data){ 
            $query = $this->db->insert_batch('tbrole_menu', array($data)); 
            return $query; 
        }
        public function deleting_role_menu($data){ 
            return $this->db->delete('tbrole_menu', $data);
        }  
        #endregion

        #region for page Manage permission
        public function getting_role($id = 0, $ignoreActive = 0){
            $this->db->select('rog.roleId, rog.roleName, rog.description, rog.isActive');
            $this->db->from('tbrole rog');
            $this->db->where('rog.isDeleted', 0); 
             
            if( $id != 0 ){ $this->db->where('rog.roleId', $id); }
            if( $ignoreActive != 0 ){ $this->db->where('rog.isActive', 1);  }
            $query = $this->db->get();
            return $query->result();            
        }
        public function setting_role($data){
            $id = 0;
            $query = $this->db->insert_batch('tbrole', $data);
            if( $query == 1){ 
                $id = $this->db->insert_id(); 
            } 
            return $this->getting_role($id); 
        }
        public function updating_role_data($id, $userId, $value){
            $dateTime = date('Y-m-d H:i:s'); 
 
            $this->db->set('roleName', "'{$value["roleName"]}'", FALSE);
            $this->db->set('description', "'{$value["description"]}'", FALSE); 
            $this->db->set('updateDateTime', "'{$dateTime}'", FALSE);
            $this->db->set('updateBy', $userId, FALSE);
            $this->db->where('roleId', $id);
            $query = $this->db->update('tbrole');
            return $query; 
        }
        public function updating_role_acitve($id, $status, $userId){
            $dateTime = date('Y-m-d H:i:s'); 
            $this->db->set('isActive', $status, FALSE);
            $this->db->set('updateDateTime', "'{$dateTime}'", FALSE);
            $this->db->set('updateBy', $userId, FALSE);
            $this->db->where('roleId', $id);
            $query = $this->db->update('tbrole');
            return $query; 
        }
        public function updating_role_deleted($id, $userId){
            $dateTime = date('Y-m-d H:i:s'); 
            $this->db->set('isActive', 0, FALSE);
            $this->db->set('isDeleted', 1, FALSE);
            $this->db->set('updateDateTime', "'{$dateTime}'", FALSE);
            $this->db->set('updateBy', $userId, FALSE);
            $this->db->where('roleId', $id);
            $query = $this->db->update('tbrole');
            return $query; 
        }
        #endregion

        #region For page Manage group
        public function getting_role_group($id = 0, $ignoreActive = 0){ 
            $this->db->select('rog.roleGroupId, rog.roleGroupName, rog.description, rog.isActive');
            $this->db->from('tbrole_group rog');
            $this->db->where('rog.isDeleted', 0);    
            if( $id != 0 ){ $this->db->where('rog.roleGroupId', $id);  }
            if( $ignoreActive != 0 ){ $this->db->where('rog.isActive', 1);  }
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
            $this->db->set('updateDateTime', "'{$dateTime}'", FALSE);
            $this->db->set('updateBy', $userId, FALSE);
            $this->db->where('roleGroupId', $id);
            $query = $this->db->update('tbrole_group');
            return $query; 
        }
        public function updating_role_group_acitve($id, $status, $userId){
            $dateTime = date('Y-m-d H:i:s'); 
            $this->db->set('isActive', $status, FALSE);
            $this->db->set('updateDateTime', "'{$dateTime}'", FALSE);
            $this->db->set('updateBy', $userId, FALSE);
            $this->db->where('roleGroupId', $id);
            $query = $this->db->update('tbrole_group');
            return $query; 
        }
        public function updating_role_group_deleted($id, $userId){
            $dateTime = date('Y-m-d H:i:s'); 
            $this->db->set('isActive', 0, FALSE);
            $this->db->set('isDeleted', 1, FALSE);
            $this->db->set('updateDateTime', "'{$dateTime}'", FALSE);
            $this->db->set('updateBy', $userId, FALSE);
            $this->db->where('roleGroupId', $id);
            $query = $this->db->update('tbrole_group');
            return $query; 
        }
        #endregion
    }
?>