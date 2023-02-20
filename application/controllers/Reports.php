<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

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
		$this->load->model('Reports_model', "rep");
		$this->load->helper('sys_helper');
    }
	public function index()
	{
		 
 
	}
    public function daily()
	{
		if( !is_null($this->input->post('content')) ){
			switch($this->input->post('content')){
				case "body"   : $this->load->view('Reports/daily/daily_view'); break;
				case "script" : $this->load->view('Reports/daily/daily_script'); break;
				case "style" : $this->load->view('Reports/daily/daily_style'); break;
			}
		} 		 
 
	}
    public function weekly()
	{
		if( !is_null($this->input->post('content')) ){
			switch($this->input->post('content')){
				case "body"   : $this->load->view('Reports/weekly/weekly_view'); break;
				case "script" : $this->load->view('Reports/weekly/weekly_script'); break;
				case "style"  : $this->load->view('Reports/weekly/weekly_style'); break;
			}
		} 		 
 
	}
    public function monthly()
	{
		if( !is_null($this->input->post('content')) ){
			switch($this->input->post('content')){
				case "body"   : $this->load->view('Reports/monthly/monthly_view'); break;
				case "script" : $this->load->view('Reports/monthly/monthly_script'); break;
				case "style"  : $this->load->view('Reports/monthly/monthly_style'); break;
			}
		} 		 
 
	}  

	public function gettingDailyReport(){
		header('Content-Type: application/json'); 
		$d = $this->input->get("day");
		echo json_encode($this->rep->gettingdata_report($d)); exit; 
	}   
	public function gettingWeeklyReport(){
		header('Content-Type: application/json'); 
		$w = $this->input->get("mon");
		echo json_encode($this->rep->gettingdata_report($w)); 
		exit; 
	} 	  
	public function gettingMonthlyReport(){
		header('Content-Type: application/json'); 
		$m = $this->input->get("mon");
		echo json_encode($this->rep->gettingdata_report($m)); 
		exit; 
	} 
	public function exportdaily_report(){
		$m = $this->input->get("m");
		$p = $this->input->get("p");
		$data["data"] = $this->rep->gettingdata_report($m, $p);
		$data["filename"] = "4MChange_daily.xlsx";
		//var_dump($data); exit;
		$this->load->view('Reports/report_form', $data);
		exit; 
	}
	public function exportweekly_report(){
		$m = $this->input->get("m");
		$p = $this->input->get("p");
		$data["data"] = $this->rep->gettingdata_report($m, $p);
		$data["filename"] = "4MChange_weekly.xlsx";
		//var_dump($data); exit;
		$this->load->view('Reports/report_form', $data);
		exit; 
	}			
	public function exportmonthly_report(){
		$m = $this->input->get("m");
		$p = $this->input->get("p");
		$data["data"] = $this->rep->gettingdata_report($m, $p);
		$data["filename"] = "4MChange_monthly.xlsx";
		//var_dump($data); exit;
		$this->load->view('Reports/report_form', $data);
		exit; 
	}
}
