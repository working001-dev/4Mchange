<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$this->load->model('User_model', "umd");
		$this->load->helper('sys_helper');
    }
	public function index()
	{
		 
		if(!is_null($this->session->user)){
			$data["content"] = "dashboard/dashboard_view";
			//$data["styles"]  = "project/home.css";
			$data["scripts"] = "dashboard/dashboard_script";
			$this->load->view('home/home_view', $data); 	
			return;
		} 

		if(!is_null($this->input->post('userName')) && !is_null($this->input->post('passWord'))){
			if( !empty($this->umd->getting_login_system())){
				$this->session->user = $this->input->post('userName');
				//$this->session->pass = $this->input->post('passWord');
				echo json_encode( array("status" => "200", "message" => "success!") );				
			}else echo json_encode( array("status" => "403", "message" => "not permission accress!") );

		}else{
			$this->load->view('login/login');	
		}
		
	}
}
