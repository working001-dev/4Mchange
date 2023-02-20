<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    date_default_timezone_set("Asia/Bangkok");
    class Dashboard_model extends CI_Model { 
        public $title;
        public $content;
        public $date;

        #region chart Data
        public function gettingyearly_chart(){ 
            $query = $this->db->query("
            select 
            date_format(d.createDateTime, '%m') * 1 mn,
            COUNT(1) total,
            SUM(IF(d.changeTypeId = 1, 1, 0)) method,
            SUM(IF(d.changeTypeId = 2, 1, 0)) material,
            SUM(IF(d.changeTypeId = 3, 1, 0)) machine,
            SUM(IF(d.changeTypeId = 4, 1, 0)) man
            from tbchangedetail d
            where DATE_FORMAT(d.createDateTime, '%Y') = DATE_FORMAT(SYSDATE(), '%Y')
            group by DATE_FORMAT(d.createDateTime, '%Y%m');
            ");
            return $query->result();           
        }
      
        public function gettingmonthly_chart(){
            $query = $this->db->query(" 
            select 
            date_format(d.createDateTime, '%d') * 1  days,
            COUNT(1) total,
            SUM(IF(d.changeTypeId = 1, 1, 0)) method,
            SUM(IF(d.changeTypeId = 2, 1, 0)) material,
            SUM(IF(d.changeTypeId = 3, 1, 0)) machine,
            SUM(IF(d.changeTypeId = 4, 1, 0)) man
            from tbchangedetail d
            where DATE_FORMAT(d.createDateTime, '%Y%m') = DATE_FORMAT(SYSDATE(), '%Y%m')
            group by DATE_FORMAT(d.createDateTime, '%Y%m%d');
            "); 
            return $query->result();            
        }

        public function gettingcase_type_chart(){
            $query = $this->db->query(" 
            select 
            SUM(IF(d.changeTypeId = 1, 1, 0)) method,
            SUM(IF(d.changeTypeId = 2, 1, 0)) material,
            SUM(IF(d.changeTypeId = 3, 1, 0)) machine,
            SUM(IF(d.changeTypeId = 4, 1, 0)) man
            from tbchangedetail d
            -- where DATE_FORMAT(d.createDateTime, '%Y%m') = DATE_FORMAT(SYSDATE(), '%Y%m')
            "); 
            return $query->result();            
        }   
        public function gettingstatus_detail(){
            $query = $this->db->query(" 
            select
            COUNT(1) total, 
            SUM( IF( s.statusName not in ('Approved', 'Rejected'), 1, 0 ) ) inprocess,
            SUM( IF( s.statusName = 'Approved', 1, 0 ) ) approve,
            SUM( IF( s.statusName = 'Rejected', 1, 0 ) ) reject
            from tbchangedetail d
            inner join tbStatus s on d.statusId = s.statusId
            "); 
            return $query->result();            
        }              
        #endregion        
    }
?>