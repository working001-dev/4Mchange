<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Change_model extends CI_Model { 
        public $title;
        public $content;
        public $date;

        public function getting_line()
        {
            $_search = ($_GET['q'] ?? ""); // please read the below note 

            $this->db->select("l.lineId id, l.lineName text");
            $this->db->from('tbline l');  
            $this->db->where('l.isActive', 1);
            $this->db->like('l.lineName', $_search, 'both'); 
            $query = $this->db->get();
            return $query->result();
        }

        public function getting_partnumber()
        {
            $_search = ($_GET['q'] ?? ""); // please read the below note 

            $this->db->select("l.partId id, l.partName text");
            $this->db->from('tbpart l');  
            $this->db->where('l.isActive', 1);
            $this->db->like('l.partName', $_search, 'both'); 
            $query = $this->db->get();
            return $query->result();
        }

        public function getting_partname()
        {
            $_search = ($_GET['q'] ?? ""); // please read the below note 

            $this->db->select("l.partId id, l.partName text");
            $this->db->from('tbpart l');  
            $this->db->where('l.isActive', 1);
            $this->db->like('l.partName', $_search, 'both'); 
            $query = $this->db->get();
            return $query->result();
        }
        public function getting_process()
        {
            $_search = ($_GET['q'] ?? ""); // please read the below note 

            $this->db->select("l.processId id, l.processName text");
            $this->db->from('tbprocess l');  
            $this->db->where('l.isActive', 1);
            $this->db->like('l.processName', $_search, 'both'); 
            $query = $this->db->get();
            return $query->result();
        }
        public function getting_cuase()
        {
            $_search = ($_GET['q'] ?? ""); // please read the below note 
            $_type = ($_GET['t'] ?? "");    
            $this->db->select("l.changeCuaseId id, l.changeCuaseName text");
            $this->db->from('tbchangecuase l');  
            $this->db->where('l.isActive', 1);
            $this->db->where('l.cuaseId', $_type);
            $this->db->like('l.changeCuaseName', $_search, 'both'); 
            $query = $this->db->get();
            return $query->result();
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