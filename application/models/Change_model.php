<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    date_default_timezone_set("Asia/Bangkok");
    class Change_model extends CI_Model { 
        public $title;
        public $content;
        public $date;

        #region For get info
        public function getting_line()
        {
            $_search = ($_GET['q'] ?? ""); // please read the below note 

            $this->db->select("l.lineId id, concat( '[', l.lineCode, '] ', l.lineName ) text");
            $this->db->from('tbline l');  
            $this->db->where('l.isActive', 1);
            $this->db->like('l.lineCode', $_search, 'both'); 
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
            $_type = ($_GET['t'] ?? 0);    
            $this->db->select("l.changeCuaseName id, l.changeCuaseName text");
            $this->db->from('tbchangecuase l');  
            $this->db->where('l.isActive', 1);
            $this->db->where('l.cuaseTypeId', $_type);
            $this->db->like('l.changeCuaseName', $_search, 'both'); 
            $query = $this->db->get();
            // var_dump($this->db->last_query());
            // exit;
            return $query->result();
        }

        public function getting_document_for_approve(){
            $this->db->select("g.documentGroupId gid, g.documentGroupName gname, g.documentGroupText gtext");
            $this->db->from('tbdocumentGroup g');  
            $this->db->join('tbdocumenttype t', 'g.documentTypeId = t.documentTypeId');
            $this->db->where('g.isActive', 1); 
            $this->db->where('t.documentTypeName', 'เอกสารแนบเพื่อการอนุมัติ'); 
            $query = $this->db->get();
            // var_dump($this->db->last_query());
            // exit;
            return $query->result();            
        }
        #endregion


        #region For insert new 4M Change
        public function setting_new_change($data){  
            //var_dump($data); exit;
            $seq = $this->gettingNextSequence();
            $data[0]["fourm_number"]  = $seq["new_fourm_number"];
            $data[0]["fourm_sequence"]  = $seq["new_sequence"];
            $this->db->insert_batch('tbChangeDetail', $data);
            $chageDetailId = $this->db->insert_id();
            $this->setting_new_approve($chageDetailId);
            return array( "changeDetailId" => $chageDetailId, "fourm_number" => $data[0]["fourm_number"] );
        } 

        public function setting_new_document($data){ 
  
            return $this->db->insert_batch('tbdocument', $data); 
        } 

        public function setting_new_inspection($data){ 
  
            return $this->db->insert_batch('tbchangeinspection', $data); 
        } 
        public function setting_new_qcinspection($data){ 
  
            return $this->db->insert_batch('tbqualityinspection', $data); 
        }         

        public function setting_new_approve($changeDetailId){
            $awaitingApproval = $this->gettingStatusId("tbapprove", "Awaiting Approval");
            $approveInitiated = $this->gettingStatusId("tbapprove", "Approval Initiated");
            $chageInfo = $this->gettingChageDetail($changeDetailId);
            $fourm_number = $chageInfo->fourm_number;
            $createDateTime = $chageInfo->createDateTime;
            $createBy = $chageInfo->createBy;
            $firstStep = $this->gettingApproveStep(1);
            $NextStep = $this->gettingApproveStep($firstStep->approveStepNext);
            $arrIns = array(
                array(
                    "approveSeq" => $firstStep->approveStepSeq,
                    "approveStepId" => 1,
                    "statusId" => $approveInitiated->statusId,
                    "approveDateTime" => "{$createDateTime}",
                    "approveBy" => $createBy,
                    "comment" => "Request 4M Number {$fourm_number}",
                    "approveName" => "Request",
                    "changeDetailId" => $changeDetailId
                ),
                array(
                    "approveSeq" => $NextStep->approveStepSeq,
                    "approveStepId" => $firstStep->approveStepNext,
                    "statusId" => $awaitingApproval->statusId, 
                    "approveDateTime" => null,
                    "approveBy" => null,
                    "comment" => null,
                    "approveName" => "Pending Approval",
                    "changeDetailId" => $changeDetailId
                )             
            );
            $this->db->insert_batch('tbapprove', $arrIns);
        }

        public function gettingStatusId($tb, $status){
            $this->db->select("statusId");
            $this->db->from('tbstatus');  
            $this->db->where('isActive', 1);  
            $this->db->where('statusTable', $tb);  
            $this->db->where('statusName', $status);  
            $this->db->limit(1);
            $query = $this->db->get();
            // var_dump($this->db->last_query());
            // exit;
            return $query->result()[0];               
        }

        public function gettingChageDetail($chageDetailId){
            $this->db->select("*");
            $this->db->from('tbchangedetail');  
            $this->db->where('isActive', 1);  
            $this->db->where('changeDetailId', $chageDetailId);   
            $this->db->limit(1);
            $query = $this->db->get();
            // var_dump($this->db->last_query());
            // exit;
            return $query->result()[0];               
        }  
        
        public function gettingApproveStep($step){
            $this->db->select("approveStepName, approveStepSeq, approveStepNext");
            $this->db->from('tbapprove_step');  
            $this->db->where('approveStepId', $step);   
            $this->db->limit(1);
            $query = $this->db->get();
            // var_dump($this->db->last_query());
            // exit;
            return $query->result()[0];               
        }  

        public function gettingNextSequence(){
            $dateRun = date('Ymd');
            $prefix = "4M{$dateRun}";
            $this->db->select("fourm_sequence");
            $this->db->from('tbchangedetail');  
            $this->db->like('fourm_number', $prefix, 'after');
            $this->db->order_by("fourm_number", "desc");
            $this->db->limit(1);
            $query = $this->db->get();
            // var_dump($this->db->last_query());
            // exit;
            $sequence = !empty($query->result()) ? $query->result()[0]->fourm_sequence + 1 : 1;
            $new_fourm_number = $prefix.str_pad($sequence,4,"0",STR_PAD_LEFT);
            return array( "new_sequence" => $sequence, "new_fourm_number" => $new_fourm_number );               
        }    
        
        public function gettingAwaitApprove($changeDetailId){
            $this->db->select("approveId, approveStepId, (approveSeq + 1) stepSeq");
            $this->db->from('tbapprove');  
            $this->db->where('changeDetailId', $changeDetailId); 
            $this->db->where('statusId', 6);   
            $this->db->limit(1);
            $query = $this->db->get();
            // var_dump($this->db->last_query());
            // exit;
            return $query->result()[0];       
        }
    
        public function gettingAwaitInspection($changeDetailId){
            $this->db->select("approveId, approveStepId, (approveSeq + 1) stepSeq");
            $this->db->from('tbapprove');  
            $this->db->where('changeDetailId', $changeDetailId); 
            $this->db->where('statusId', 11);   
            $this->db->limit(1);
            $query = $this->db->get();
            // var_dump($this->db->last_query());
            // exit;
            return $query->result()[0];       
        }        

        public function findCuaseId($typ, $txt ){
            $this->db->select("c.changeCuaseId");
            $this->db->from('tbchangecuase c');  
            $this->db->where('c.cuaseTypeId', $typ); 
            $this->db->where('c.changeCuaseName', $txt);   
            $this->db->limit(1);
            $query = $this->db->get();
            $row = $query->row_array();
            $rst = $query->result(); 
            if(!isset($row)) {
                $newCuase = array(array("changeCuaseName" => $txt, "cuaseTypeId" => $typ));
                $this->db->insert_batch('tbchangecuase', $newCuase);
                $changeCuaseId = $this->db->insert_id();
                return $changeCuaseId;
            }else{ return $rst[0]->changeCuaseId;}
        }
        public function findProduction($line){
            $this->db->select("l.productionId");
            $this->db->from('tbline l');   
            $this->db->where('l.lineId', $line);   
            $this->db->limit(1);
            $query = $this->db->get(); 
            $rst = $query->result();       
            return $rst[0]->productionId ?? null;     
        }
        #endregion
        
        #region For Manage case
        public function gettingCase($action, $group){
            $isAction = $this->checkingActionCase($action);
            $this->db->select("
            d.changeDetailId,
            d.fourm_number, 
            d.description, 
            (select concat( u.firstName, ' ', left(u.lastName, 1), '.' )  from tbuser_login u where u.userLoginId = d.createBy limit 1 ) requestBy,
            DATE_FORMAT(d.createDateTime, '%Y-%m-%d %H:%i:%s') requestDate,
            s.statusName,
            d.statusId
            ");
            $this->db->from('tbchangedetail d'); 
            $this->db->join('tbstatus s', 'd.statusId = s.statusId');
            $this->db->where('d.isActive', 1);  
            $this->db->where('s.statusTable', 'tbchangedetail');  
            // $this->db->where('s.statusName', 'Pending Approval');  
            if($action == 2){  
                $this->db->where('d.statusId', 2);                
            }else{
                $this->db->where('d.changeDetailGroupId', 0);     
            }
            $query1 = $this->db->get_compiled_select();

            $this->db->select("
            d.changeDetailId,
            d.fourm_number, 
            d.description, 
            (select concat( u.firstName, ' ', left(u.lastName, 1), '.' )  from tbuser_login u where u.userLoginId = d.createBy limit 1 ) requestBy,
            DATE_FORMAT(d.createDateTime, '%Y-%m-%d %H:%i:%s') requestDate,
            s.statusName,
            d.statusId
            ");
            $this->db->from('tbchangedetail d'); 
            $this->db->join('tbstatus s', 'd.statusId = s.statusId');
            $this->db->where('d.isActive', 1);  
            $this->db->where('s.statusTable', 'tbchangedetail');  
            // $this->db->where('s.statusName', 'Pending Approval'); 
            if($action != 99){
                $this->db->where('d.changeDetailGroupId', $group); 
                $this->db->where_in('d.statusId', $isAction);
                                
            }
            $this->db->where_not_in('d.statusId', array(3,4));
            $query2 = $this->db->get_compiled_select();


            $query = $this->db->query($query1 . ' UNION ' . $query2);
            // var_dump($this->db->last_query());
            // exit;
            return $query->result();               
        }
        public function gettingAllCase(){
            $this->db->select("
            d.changeDetailId,
            d.fourm_number, 
            d.description, 
            (select concat( u.firstName, ' ', left(u.lastName, 1), '.' )  from tbuser_login u where u.userLoginId = d.createBy limit 1 ) requestBy,
            DATE_FORMAT(d.createDateTime, '%Y-%m-%d %H:%i:%s') requestDate,
            s.statusName,
            d.statusId
            ");
            $this->db->from('tbchangedetail d'); 
            $this->db->join('tbstatus s', 'd.statusId = s.statusId');
            $this->db->where('d.isActive', 1);  
            $this->db->where('s.statusTable', 'tbchangedetail');    
            $query = $this->db->get();
            $this->db->order_by('d.statusId ASC');
            // var_dump($this->db->last_query());
            // exit;
            return $query->result();               
        }
        public function gettingApprove($changeDetailId){
            $this->db->select("
            d.changeDetailId,
            a.approveSeq,
            concat( a.approveSeq, ' - ', s.approveStepName ) step,
            a.approveName, 
            s.approveStepName,
            a.comment,
            ( select s.statusName from tbstatus s where s.statusId = a.statusId and s.statusTable =  'tbapprove' limit 1 ) action,
            DATE_FORMAT(a.approveDateTime, '%Y-%m-%d %H:%i:%s') approveDateTime, 
            concat( u.firstName, ' ', upper(left(u.lastName, 1)), '.' ) user,
            DATE_FORMAT(a.approveDateTime, '%Y-%m-%d') date,
            DATE_FORMAT(a.approveDateTime, '%H:%i:%s') time
            ");
            $this->db->from('tbchangedetail d'); 
            $this->db->join('tbapprove a', 'd.changeDetailId = a.changeDetailId');
            $this->db->join('tbapprove_step s', 'a.approveStepId = s.approveStepId');
            $this->db->join('tbuser_login u', 'a.approveBy = u.userLoginId', 'left');
            $this->db->where('d.changeDetailId', $changeDetailId);
            $this->db->where('d.isActive', 1);    
            $this->db->order_by('d.changeDetailId ASC, a.approveSeq ASC');
            $query = $this->db->get();
            // var_dump($this->db->last_query());
            // exit;
            return $query->result();               
        }

        public function gettingDetailInfo($changeDetailId){
            $this->db->select("
            d.fourm_number,
            ct.changeTypeName,
            ut.cuaseTypeName,
            cu.changeCuaseName,
            d.description changeDetail,
            pd.productionName,
            concat( ln.lineCode, ' - ', ln.lineName ) lineName,
            pt.partName,
            pt.partName partNumber,
            d.qualityJudgment,
            ps.processName,
            ( 
                select count(1) 
                from tbdocument cm 
                inner join tbdocumentgroup dg on cm.documentGroupId = dg.documentGroupId
                where cm.changeDetailId = 1 and dg.documentTypeId not in (4, 5)
            ) countAttachFile 
            ");
            $this->db->from('tbchangedetail d'); 
            $this->db->join('tbchangetype ct', 'd.changeTypeId = ct.changeTypeId');
            $this->db->join('tbchangecuase cu', 'd.changeCuaseId = cu.changeCuaseId');
            $this->db->join('tbcuasetype ut', 'cu.cuaseTypeId = ut.cuaseTypeId');
            $this->db->join('tbline ln', 'd.lineId = ln.lineId', 'left');
            $this->db->join('tbprocess ps', 'd.processId = ps.processId', 'left');
            $this->db->join('tbpart pt', 'd.partId = pt.partId', 'left');
            $this->db->join('tbproduction pd', 'ln.productionId = pd.productionId', 'left');
            $this->db->where('d.changeDetailId', $changeDetailId);
            $this->db->where('d.isActive', 1);  
            $query = $this->db->get();
            // var_dump($this->db->last_query());
            // exit;
            return $query->result();               
        } 

        public function gettingDocumentInfo($changeDetailId){
            $this->db->select("
            d.fileName, 
            g.documentGrouptext txt, 
            d.filePath, 
            d.changeDetailId, 
            d.fileExtension,
            g.documentGroupName
            ");
            $this->db->from('tbdocument d'); 
            $this->db->join('tbdocumentgroup g', 'd.documentGroupId = g.documentGroupId'); 
            $this->db->where('d.changeDetailId', $changeDetailId);
            
            $this->db->where('d.isActive', 1);  
            $query = $this->db->get();
            // var_dump($this->db->last_query());
            // exit;
            return $query->result();               
        } 

        public function gettingInpectionInfo($changeDetailId){
            $this->db->select("
            i.changeDetailId,
            i.inspectionLocation,
            i.inspectionControl,
            i.inspectionControlResult
            ");
            $this->db->from('tbchangeinspection i');  
            $this->db->where('i.changeDetailId', $changeDetailId);
            $this->db->where('i.isActive', 1);  
            $query = $this->db->get();
            // var_dump($this->db->last_query());
            // exit;
            return $query->result();               
        }
        public function gettingQcInpectionInfo($changeDetailId){
            $this->db->select("
            i.changeDetailId,
            i.inspectionLocation,
            i.inspectionControl,
            i.inspectionControlResult
            ");
            $this->db->from('tbqualityinspection i');  
            $this->db->where('i.changeDetailId', $changeDetailId);
            $this->db->where('i.isActive', 1);  
            $query = $this->db->get();
            // var_dump($this->db->last_query());
            // exit;
            return $query->result();               
        }

        public function checkingActionCase($action){
            $this->db->select("statusId");
            $this->db->from('tbuseraction_mapping');   
            $this->db->where('userActionId', $action);  
            $query = $this->db->get();
            $result = array();
            foreach($query->result() as $row)
            {
                array_push($result, $row->statusId); 
            }   
            return $result;
        }                                
        #endregion

        #region For Approve
        public function setting_approve_process($app){
            $dateTime = date('Y-m-d H:i:s');
            $Adjustment = $this->gettingStatusId("tbapprove", "Awaiting Inspection");
            $Approved = $this->gettingStatusId("tbapprove", "Approved");
            $changeDetailId = $app["changeDetailId"];
            $currentStatusId = $app["currentStatusId"];
            $currentStatusName = $app["currentStatusName"];
            $comment = $app["comment"];
            $userLogin = $app["userLogin"];
            $userActionId = $app["userActionId"];

            $nextChangeDetailStatus =$this->checkingNextChangeStatus($currentStatusName);
            $awaitingApproval = $this->gettingAwaitApprove($changeDetailId);
            
            $approveNextStep = $this->gettingApproveStep($awaitingApproval->approveStepId);
            // var_dump($changeDetailId, $nextChangeDetailStatus->statusId, $approveNextStep->approveStepId);  
            // exit; 
            $data = array(
                array(
                "approveSeq" => $awaitingApproval->stepSeq,
                "approveStepId" => $approveNextStep->approveStepNext,
                "statusId" => $Adjustment->statusId, 
                "approveDateTime" => null,
                "approveBy" => null,
                "comment" => null,
                "approveName" => "Pending Inspection",
                "changeDetailId" => $changeDetailId
            ));  
            $this->db->trans_begin();

            $this->db->query("update tbchangedetail set statusId = {$nextChangeDetailStatus}, updateDateTime = '{$dateTime}', updateBy = {$userLogin} where changeDetailId = {$changeDetailId}");
            $this->db->query("
            update tbapprove set 
            statusId = {$Approved->statusId}, 
            comment = '{$comment}', 
            approveName = 'Approved', 
            approveDateTime = SYSDATE(), 
            approveBy = {$userLogin} 
            where approveId = {$awaitingApproval->approveId}
            ");
            $this->db->insert_batch('tbapprove', $data);
            // $this->db->query('AND YET ANOTHER QUERY...');

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
            }
            else
            {
                $this->db->trans_commit();
            }
        } 
        
        public function setting_quality_judgment($q, $changeDetailId, $statusName){
            $dateTime = date('Y-m-d H:i:s');
            $data = array(); 
            $upd = array();
            $awaitingApproval = $this->gettingAwaitInspection($changeDetailId);
             
               
            $userLogin = $q["updateBy"]; 
            $qcJudgment = $q["qualityJudgment"];
            $comment = "Quality inspector result {$qcJudgment}";        
            switch( $statusName ){
                case "Approved" :
                    $Closed = $this->gettingStatusId("tbapprove", "Closed");
                    $Approved = $this->gettingStatusId("tbapprove", "Approved");
                    array_push($data,array(
                        "approveSeq" => $awaitingApproval->stepSeq,
                        "approveStepId" => 99,
                        "statusId" => $Closed->statusId, 
                        "approveDateTime" => $dateTime,
                        "approveBy" => $userLogin,
                        "comment" => "ให้มีการผลิตได้ตามปกติ",
                        "approveName" => "OK Continue",
                        "changeDetailId" => $changeDetailId
                    ));
                    $upd = array(
                        "statusId" => $Approved->statusId, 
                        "comment" => $comment, 
                        "approveName" => 'Inspected OK!', 
                        "approveDateTime" => $dateTime, 
                        "approveBy" => $userLogin 
                    );                    
                    break;
                case "Rejected":
                    $Closed = $this->gettingStatusId("tbapprove", "Closed");
                    $Approved = $this->gettingStatusId("tbapprove", "Approved");
                    array_push($data,array(
                        "approveSeq" => $awaitingApproval->stepSeq,
                        "approveStepId" => 100,
                        "statusId" => $Closed->statusId, 
                        "approveDateTime" => $dateTime,
                        "approveBy" => $userLogin,
                        "comment" => "ห้ามผลิต",
                        "approveName" => "NO Production",
                        "changeDetailId" => $changeDetailId
                    ));
                    $upd = array(
                        "statusId" => $Approved->statusId, 
                        "comment" => $comment, 
                        "approveName" => 'Inspected NG!', 
                        "approveDateTime" => $dateTime, 
                        "approveBy" => $userLogin 
                    );                    
                    break;
                case "Following":
                    $Follow = $this->gettingStatusId("tbapprove", "Following and Monitor");
                    $Approved = $this->gettingStatusId("tbapprove", "Approved");
                    array_push($data,array(
                        "approveSeq" => $awaitingApproval->stepSeq,
                        "approveStepId" => 101,
                        "statusId" => $Follow->statusId, 
                        "approveDateTime" => $dateTime,
                        "approveBy" => $userLogin,
                        "comment" => "ให้มีการผลิตได้ โดยมีเงื่อนไข",
                        "approveName" => "Closed",
                        "changeDetailId" => $changeDetailId
                    ));
                    $upd = array(
                        "statusId" => $Approved->statusId, 
                        "comment" => $comment, 
                        "approveName" => 'Inspected', 
                        "approveDateTime" => $dateTime, 
                        "approveBy" => $userLogin 
                    );                      
                    break;
                default: break;
            }
 
            $this->db->trans_begin();

            $this->db->where('changeDetailId', $changeDetailId);
            $this->db->update('tbchangedetail', $q);
             
            $this->db->where('changeDetailId', $changeDetailId);
            $this->db->where('approveId', $awaitingApproval->approveId);
            $this->db->update('tbapprove', $upd);

            $this->db->insert_batch('tbapprove', $data);
            // $this->db->query('AND YET ANOTHER QUERY...');

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
            }
            else
            {
                $this->db->trans_commit();
            }            

        }
        #endregion

        #region For Checking and Condition Process
        
        public function checkingNextChangeStatus($curr){
            $statusNext = 0;
            switch ($curr) {
                case "Pending Approval": $statusNext = ($this->gettingStatusId("tbchangedetail", "Pending QC review"))->statusId;  break;
                case "Pending QC review": $statusNext = ($this->gettingStatusId("tbchangedetail", "Approved"))->statusId; break;
                case "3": $statusNext = ($this->gettingStatusId("tbchangedetail", "Pending QC review"))->statusId; break; 
                default:
                  $statusNext = ($this->gettingStatusId("tbchangedetail", "Closed"))->statusId;
              }
            return $statusNext;
        }
        public function checkingTable($flg){
            $tbName = "";
            switch ($flg) {
                case "1": $tbName = "tbchangedetail"; break;
                case "2": $tbName = "tbapprove"; break; 
                default: $tbName = "tbchangedetail";
              }
            return $tbName;
        }

        #endregion

        #region For 4M Change Case
        public function findFourM($q){ 
            $this->db->distinct(); 
            $this->db->select("d.fourm_number id, d.fourm_number text");
            $this->db->from('tbchangedetail d');  
            $this->db->where('d.isActive', 1);
            $this->db->like('d.fourm_number', $q, 'both'); 
            $query = $this->db->get();
            return $query->result();            
        }
        public function findLine($q){  
            $this->db->distinct();
            $this->db->select("d.lineId id, concat( l.lineCode, ' - ', l.lineName ) text");
            $this->db->from('tbchangedetail d');
            $this->db->join('tbline l', 'd.lineId = l.lineId');  
            $this->db->where('d.isActive', 1);
            $this->db->like('l.lineCode', $q, 'both'); 
            $query = $this->db->get();
        
            return $query->result();            
        }
        public function findPd($q){  
            $this->db->distinct();
            $this->db->select("d.productionId id, l.productionName text");
            $this->db->from('tbchangedetail d');
            $this->db->join('tbProduction l', 'd.productionId = l.productionId');  
            $this->db->where('d.isActive', 1);
            $this->db->like('l.productionName', $q, 'both'); 
            $query = $this->db->get();
            return $query->result();            
        }  
        public function findCuase($q){  
            $this->db->distinct();
            $this->db->select("d.changeCuaseId id, l.changeCuaseName text");
            $this->db->from('tbchangedetail d');
            $this->db->join('tbchangecuase l', 'd.changeCuaseId = l.changeCuaseId');  
            $this->db->where('d.isActive', 1);
            $this->db->like('l.changeCuaseName', $q, 'both'); 
            $query = $this->db->get();
            return $query->result();            
        }
        public function findActor($q){  
            $this->db->distinct();
            $this->db->select("d.createBy id, concat( l.firstName, ' ', left(l.lastName, 1), '.' ) text");
            $this->db->from('tbchangedetail d');
            $this->db->join('tbuser_login l', 'd.createBy = l.userLoginId');  
            $this->db->where('d.isActive', 1);
            $this->db->like("concat( l.firstName, ' ', left(l.lastName, 1), '.' )", $q, 'both'); 
            $query = $this->db->get();
            return $query->result();            
        }  
        public function findGroup($q)
        { 
            $this->db->select("l.roleGroupId id, l.roleGroupName text");
            $this->db->from('tbrole_group l');  
            $this->db->where('l.isActive', 1); 
            $query = $this->db->get();
            return $query->result();
        } 
        public function findStatus($q)
        { 
            $this->db->select("l.statusId id, l.statusName text");
            $this->db->from('tbstatus l');  
            $this->db->where('l.isActive', 1);
            $this->db->where('l.statusTable', 'tbchangedetail');  
            $query = $this->db->get();
            return $query->result();
        }                      
        #endregion
        // public function update_entry()
        // {
        //         $this->title    = $_POST['title'];
        //         $this->content  = $_POST['content'];
        //         $this->date     = time();

        //         $this->db->update('entries', $this, array('id' => $_POST['id']));
        // } 
    }
?>