<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Changes extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct() {
        parent::__construct(); 
		$this->load->model('change_model', "chn");
		$this->load->helper('sys_helper');
    }
	public function index()
	{
		 
 
	}
	#region For getting page
	public function add()
	{
		if( !is_null($this->input->post('content')) ){
			switch($this->input->post('content')){
				case "body" : $this->load->view('Changes/Add/add_view'); break;
				case "script" : $this->load->view('Changes/Add/add_script'); break;
				case "style" : $this->load->view('Changes/Add/add_style'); break;
			}
		} 
	}
	public function manage()
	{
		if( !is_null($this->input->post('content')) ){
			switch($this->input->post('content')){
				case "body"   : $this->load->view('Changes/Manage/manage_view'); break;
				case "script" : $this->load->view('Changes/Manage/manage_script'); break;
				case "style"  : $this->load->view('Changes/Manage/manage_style'); break;
			}
		} 
	}

	public function case()
	{
		if( !is_null($this->input->post('content')) ){
			switch($this->input->post('content')){
				case "body"   : $this->load->view('Changes/Case/case_view'); break;
				case "script" : $this->load->view('Changes/Case/case_script'); break;
				case "style" : $this->load->view('Changes/Case/case_style'); break;
			}
		} 
	}
	#endregion

	#region For getting master
	public function getting_select_line()
	{
		echo json_encode($this->chn->getting_line());
	}
	public function getting_select_partnumber()
	{
		echo json_encode($this->chn->getting_partnumber());
	}
	public function getting_select_partname()
	{
		echo json_encode($this->chn->getting_partname());
	}
	public function getting_select_process()
	{
		echo json_encode($this->chn->getting_process());
	}
	public function getting_select_cuase(){ 
		header('Content-Type: application/json'); 
		echo json_encode($this->chn->getting_cuase());  
	}
	public function getting_master_for_approve(){ 
		header('Content-Type: application/json'); 
		echo json_encode($this->chn->getting_document_for_approve());  
	}
	#endregion

	#region For page Add new case
	public function settingNewChange(){
		echo json_encode($this->chn->setting_new_change( array( $this->input->post('ins')) ) );	
	} 
	public function settingNewChangeInspection(){
		//var_dump($this->input->post('ins')); exit;
		echo json_encode($this->chn->setting_new_inspection($this->input->post('ins') ));	
	} 
	public function settingNewQualityChangeInspection(){
		//var_dump($this->input->post('ins')); exit;
		echo json_encode($this->chn->setting_new_qcinspection($this->input->post('ins') ));	
	} 
	public function findChangeCuase(){
		$ctype = $this->input->get("ctype");
		$ctext = $this->input->get("ctext");
		echo json_encode($this->chn->findCuaseId($ctype, $ctext ));
	}
	public function findProductionLine(){
		$line = $this->input->get("line"); 
		echo json_encode($this->chn->findProduction($line));
	}
	public function gettingStatusId(){
		$statusName = $this->input->get("statusName"); 
		$tableFlg = $this->input->get("tFlg"); 
		$tableName = $this->chn->checkingTable($tableFlg);
		$statusId = $this->chn->gettingStatusId($tableName, $statusName); 
		echo json_encode($statusId->statusId);
	}
	#endregion


	#region For upload File
    public function create(){
		$fourNumber = $this->input->post("4MNumber");
		$filepath = "./uploads/" . $fourNumber . "/"; 
		if (!file_exists($filepath)) {
			mkdir($filepath, 0777);
		}		
		$this->load->library('upload');
        $config['upload_path'] = $filepath;  // โฟลเดอร์ ตำแหน่งเดียวกับ root ของโปรเจ็ค
        $config['allowed_types'] = 'gif|jpg|png|xlsx|xls|csv|pdf|docx|doc'; // ปรเเภทไฟล์ 
        $config['max_size'] = '0';  // ขนาดไฟล์ (kb)  0 คือไม่จำกัด ขึ้นกับกำหนดใน php.ini ปกติไม่เกิน 2MB
        $config['max_width'] = '1024';  // ความกว้างรูปไม่เกิน
        $config['max_height'] = '768'; // ความสูงรูปไม่เกิน
        
 
		$docInfo = json_decode( $this->input->post("document"));
		$docArray = array();
		foreach($docInfo as $v){
			$results = json_decode(json_encode($v), true);
			//var_dump($results); exit;
			$config['file_name'] = $results["documentName"];  // ชื่อไฟล์ ถ้าไม่กำหนดจะเป็นตามชื่อเดิม
			$this->upload->initialize($config);    // เรียกใช้การตั้งค่า  
			$this->upload->do_upload("fileGroup_{$results['documentGroupId']}"); // ทำการอัพโหลดไฟล์จาก input file ชื่อ service_image	
			array_push( $docArray, $results);	
		}

        $resultIns = $this->chn->setting_new_document( $docArray ); 
        $file_upload="";  // กำหนดชื่อไฟล์เป็นค่าว่าง 
        if(!$this->upload->display_errors()){ // ถ้าไม่มี error อัพไฟล์ได้ ให้เอาใช้ไฟล์ใส่ตัวแปร ไว้บันทึกลงฐานข้อมูล
            $file_upload=$this->upload->data('file_name');
			echo json_encode(array( "resultFile" => $file_upload . " success!", "result" => $resultIns) );
			exit;
        }else{
			echo json_encode($this->upload->data('file_name'));
			exit;
		}   
    } 
	#endregion

	#region For Manage case
	public function getting_case(){ 
		header('Content-Type: application/json'); 
		$groupId = $this->input->get("roleGroupId");
		$userActionId = $this->input->get("userActionId");
		$roleId = $this->input->get("roleId");
		echo json_encode($this->chn->gettingCase($userActionId,$groupId,$roleId));  
	}	
	public function getting_change_detail(){ 
		header('Content-Type: application/json'); 
		echo json_encode($this->chn->gettingDetailInfo($this->input->get("changeDetailId")));  
	}
	public function getting_approve(){ 
		header('Content-Type: application/json'); 
		echo json_encode($this->chn->gettingApprove($this->input->get("changeDetailId")));  
	}	
	public function getting_document(){ 
		header('Content-Type: application/json'); 
		echo json_encode($this->chn->gettingDocumentInfo($this->input->get("changeDetailId")));  
	}
	public function getting_inspection(){ 
		header('Content-Type: application/json'); 
		echo json_encode($this->chn->gettingInpectionInfo($this->input->get("changeDetailId")));  
	}
	public function getting_qualityinspection(){ 
		header('Content-Type: application/json'); 
		echo json_encode($this->chn->gettingQcInpectionInfo($this->input->get("changeDetailId")));  
	}	
	#endregion

	#region For Approve
	public function setting_actionApprove(){
		// $changeDetailId = $this->input->post("changeDetailId"); 
        // $currentStatus = $this->input->post("currentStatus");
        // $comment = $this->input->post("comment");
        // $userLogin = $this->input->post("userLoginId");
        // $userActionId = $this->input->post("userActionId");
		$approve = $this->input->post("approve");
		$action = $this->input->post("action");  
		if($action == "approve"){
			$this->chn->setting_approve_process($approve);			
		}else{
			$this->chn->setting_reject_process($approve);
		}
		echo json_encode("done");


	}
	public function setting_actionInspectApprove(){
		$qc = $this->input->post("qcJudgment"); 
		$cd = $this->input->post("changeDetailId"); 
		$st = $this->input->post("stName");
		echo json_encode($this->chn->setting_approve_inspect($qc, $cd, $st));	
		exit;	
	}	
	public function setting_qualityComfirmation(){
		$qc = $this->input->post("qcJudgment"); 
		$cd = $this->input->post("changeDetailId"); 
		$st = $this->input->post("stName");
		$this->chn->setting_quality_judgment($qc, $cd, $st);		
	}
	public function setting_followingComfirmation(){
		$qc = $this->input->post("qcJudgment"); 
		$cd = $this->input->post("changeDetailId"); 
		$st = $this->input->post("stName");
		$ct = $this->input->post("comment");
		$this->chn->setting_following_confirm($qc, $cd, $st, $ct);		
	}
	#endregion

	#region For Case Status
	public function getCase(){
		header('Content-Type: application/json');  
		echo json_encode($this->chn->gettingAllCase());  		
	}

	public function getting_detail_master(){
		header('Content-Type: application/json');
		$_t = $this->input->get("t");
		$_q = $this->input->get("q");
		switch($_t){
			case "l": echo json_encode($this->chn->findLine($_q)); exit; break;
			case "p": echo json_encode($this->chn->findPd($_q)); exit; break;
			case "f": echo json_encode($this->chn->findFourM($_q)); exit; break;
			case "r": echo json_encode($this->chn->findActor($_q)); exit; break;
			case "c": echo json_encode($this->chn->findCuase($_q)); exit; break;
			case "s": echo json_encode($this->chn->findStatus($_q)); exit; break;
			case "g": echo json_encode($this->chn->findGroup($_q)); exit; break;
			default : echo null; exit; break;
		}
	}
	public function getQueryCase(){
		header('Content-Type: application/json');
		$_w = $this->input->post("where");
		echo json_encode($this->chn->findCaseData($_w)); exit;
	}
	#endregion

}
