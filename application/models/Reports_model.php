<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    date_default_timezone_set("Asia/Bangkok");
    class Reports_model extends CI_Model { 
        public $title;
        public $content;
        public $date;

        #region Daily Report
        public function gettingdaily_report($day){
            $this->db->select("
            DATE_FORMAT(cd.createDateTime, '%Y-%m-%d') date,
            pd.productionName pd,
            cd.fourm_number,
            ln.lineName,
            ps.processName,
            '' rel_production,
            ct.changeTypeCode,
            cd.description,
            IF(cc.cuaseTypeId = 1, 1, 0 ) permanent,
            IF(cc.cuaseTypeId = 2, 1, 0 ) temporary,
            IF(cc.cuaseTypeId = 2, DATE_FORMAT(cd.createDateTime, '%Y-%m-%d'), '-' ) start,
            IF(cc.cuaseTypeId = 2, IF(st.statusName in ('Approved', 'Rejected'), DATE_FORMAT(cd.updateDateTime, '%Y-%m-%d'), '-' ), '-' ) duaDate,
            IF( st.statusName = 'Approved', 'Close', IF( st.statusName = 'Rejected', 'Reject', 'Open') ) status
            ");
            $this->db->from("tbchangedetail cd");
            $this->db->join("tbchangetype ct", "cd.changeTypeId = ct.changeTypeId");
            $this->db->join("tbproduction pd", "cd.productionId = pd.productionId", 'left');
            $this->db->join("tbline ln", "cd.lineId = ln.lineId", 'left');
            $this->db->join("tbprocess ps", "cd.processId = ps.processId", 'left');
            $this->db->join("tbchangecuase cc", "cd.changeCuaseId = cc.changeCuaseId", 'left');
            $this->db->join("tbstatus st", "cd.statusId = st.statusId", 'left'); 
            $this->db->where('cd.isActive', 1);
            $this->db->where("cd.createDateTime BETWEEN '{$day} 00:00:00' AND '{$day} 23:59:59'"); 
            $this->db->order_by("cd.createDateTime", "asc");
            $query = $this->db->get(); 
            return $query->result();            
        }
        #endregion
        #region Monthly Report
        public function gettingdata_report($mon, $pd = "All"){
            $this->db->select("
            DATE_FORMAT(cd.createDateTime, '%Y-%m-%d') date,
            pd.productionName pd,
            cd.fourm_number,
            ln.lineName,
            ps.processName,
            '' rel_production,
            ct.changeTypeCode,
            cd.description,
            IF(cc.cuaseTypeId = 1, 1, 0 ) permanent,
            IF(cc.cuaseTypeId = 2, 1, 0 ) temporary,
            IF(cc.cuaseTypeId = 2, DATE_FORMAT(cd.createDateTime, '%Y-%m-%d'), '-' ) start,
            IF(cc.cuaseTypeId = 2, IF(st.statusName in ('Approved', 'Rejected'), DATE_FORMAT(cd.updateDateTime, '%Y-%m-%d'), '-' ), '-' ) duaDate,
            IF( st.statusName = 'Approved', 'Close', IF( st.statusName = 'Rejected', 'Reject', 'Open') ) status
            ");
            $this->db->from("tbchangedetail cd");
            $this->db->join("tbchangetype ct", "cd.changeTypeId = ct.changeTypeId");
            $this->db->join("tbproduction pd", "cd.productionId = pd.productionId", 'left');
            $this->db->join("tbline ln", "cd.lineId = ln.lineId", 'left');
            $this->db->join("tbprocess ps", "cd.processId = ps.processId", 'left');
            $this->db->join("tbchangecuase cc", "cd.changeCuaseId = cc.changeCuaseId", 'left');
            $this->db->join("tbstatus st", "cd.statusId = st.statusId", 'left'); 
            $this->db->where('cd.isActive', 1);
            $this->db->where("cd.createDateTime BETWEEN {$mon}"); 
            $this->db->order_by("cd.createDateTime", "asc");
            if( $pd != "All"){
                $this->db->where("pd.productionName", $pd);
            }
            $query = $this->db->get(); 
            //var_dump($this->db->last_query());  exit;
            return $query->result();            
        }
        #endregion        
    }
?>