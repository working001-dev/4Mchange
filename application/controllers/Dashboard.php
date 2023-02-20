<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
 
	public function __construct() {
        parent::__construct(); 
		$this->load->model('Dashboard_model', "dashboard");
		$this->load->helper('sys_helper');
    }
	public function index()
	{
		if( !is_null($this->input->post('content')) ){
			switch($this->input->post('content')){
				case "body" :
					$this->load->view('Dashboard/dashboard_view');	
					break;
				case "script" :
					$this->load->view('Dashboard/dashboard_script');
					break;
                case "style" :
					$this->load->view('Dashboard/dashboard_style');
					break;                    
			}
		}
	}
	public function gettingYearChart(){
		header('Content-Type: application/json');  
		echo json_encode($this->dashboard->gettingyearly_chart()); exit; 
	} 
	public function gettingMonthChart(){
		header('Content-Type: application/json');  
		echo json_encode($this->dashboard->gettingmonthly_chart()); exit; 
	} 	
	public function gettingCaseTypeChart(){
		header('Content-Type: application/json');  
		echo json_encode($this->dashboard->gettingcase_type_chart()); exit; 
	}
	public function gettingStatusSummary(){
		header('Content-Type: application/json');  
		echo json_encode($this->dashboard->gettingstatus_detail()); exit; 
	} 	 
}
