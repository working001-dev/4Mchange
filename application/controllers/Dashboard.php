<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
 
	public function __construct() {
        parent::__construct(); 
		$this->load->model('User_model', "umd");
		$this->load->helper('sys_helper');
    }
	public function index()
	{
		if( !is_null($this->input->post('content')) ){
			switch($this->input->post('content')){
				case "body" :
					$this->load->view('dashboard/dashboard_view');	
					break;
				case "script" :
					$this->load->view('dashboard/dashboard_script');
					break;
                case "style" :
					$this->load->view('dashboard/dashboard_style');
					break;                    
			}
		} 
	}

	public function add()
	{
		if( !is_null($this->input->post('content')) ){
			switch($this->input->post('content')){
				case "body" :
					$this->load->view('users/add/add_view');	
					break;
				case "script" :
					$this->load->view('users/add/add_script');
					break;
			}
		} 
	}

	public function infoMember()
	{
		echo json_encode($this->session->info);
	}
}
