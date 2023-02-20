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
			$data["content"] = "Hme/home_view";
			$data["styles"]  = "Home/home_style.css";
			$data["scripts"] = "Home/home_script";
			$this->load->view('Home/home_views', $data); 	
			return;
		} 

		if(!is_null($this->input->post('userName')) && !is_null($this->input->post('passWord'))){
			$info = $this->umd->getting_login_system();
			if( !empty($info)){
				$this->session->user = $this->input->post('userName');
				$this->session->info = array
				(
					"info" => $info,
					"groupMenu" => $this->umd->getting_group_menu($info[0]->roleId),
					"menu" => $this->umd->getting_menu($info[0]->roleId)
				); 
				$this->umd->updating_LastDateTime($info[0]->userLoginId);
				echo json_encode( array("status" => "200", "message" => "success!", "info"=>$this->session->info) );				
			}else echo json_encode( array("status" => "403", "message" => "not permission accress!") );

		}else{
			$this->load->view('Login/login');	
		} 
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/', 'refresh');
	}

	public function infoMember()
	{
		echo json_encode($this->session->info);
	}
}
