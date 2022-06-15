<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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
		 
 
	}

	public function add()
	{
		if( !is_null($this->input->post('content')) ){
			switch($this->input->post('content')){
				case "body" : $this->load->view('users/add/add_view'); break;
				case "script" : $this->load->view('users/add/add_script'); break;
				case "script" : $this->load->view('users/add/add_style'); break;
			}
		} 
	}
	public function manage()
	{
		if( !is_null($this->input->post('content')) ){
			switch($this->input->post('content')){
				case "body"   : $this->load->view('users/manage/manage_view'); break;
				case "script" : $this->load->view('users/manage/manage_script'); break;
				case "script" : $this->load->view('users/manage/manage_style'); break;
			}
		} 
	}
	public function permission()
	{
		if( !is_null($this->input->post('content')) ){
			switch($this->input->post('content')){
				case "body"   : $this->load->view('users/permission/permission_view'); break;
				case "script" : $this->load->view('users/permission/permission_script'); break;
				case "script" : $this->load->view('users/permission/permission_style'); break;
			}
		} 
	}
	public function permissiongroup()
	{
		if( !is_null($this->input->post('content')) ){
			switch($this->input->post('content')){
				case "body"   : $this->load->view('users/permissiongroup/permissiongroup_view'); break;
				case "script" : $this->load->view('users/permissiongroup/permissiongroup_script'); break;
				case "script" : $this->load->view('users/permissiongroup/permissiongroup_style'); break;
			}
		} 
	}
	public function group()
	{
		if( !is_null($this->input->post('content')) ){
			switch($this->input->post('content')){
				case "body"   : $this->load->view('users/group/group_view'); break;
				case "script" : $this->load->view('users/group/group_script'); break;
				case "script" : $this->load->view('users/group/group_style'); break;
			}
		} 
	}
	public function changepass()
	{
		if( !is_null($this->input->post('content')) ){
			switch($this->input->post('content')){
				case "body"   : $this->load->view('users/changepass/changepass_view'); break;
				case "script" : $this->load->view('users/changepass/changepass_script'); break;
				case "script" : $this->load->view('users/changepass/changepass_style'); break;
			}
		} 
	}
	public function edit()
	{
		if( !is_null($this->input->post('content')) ){
			switch($this->input->post('content')){
				case "body"   : $this->load->view('users/edit/edit_view'); break;
				case "script" : $this->load->view('users/edit/edit_script'); break;
				case "script" : $this->load->view('users/edit/edit_style'); break;
			}
		} 
	}
	public function infoMember()
	{
		echo json_encode($this->session->info);
	}
}
