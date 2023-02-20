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
	#region Get Page View
	public function add()
	{
		if( !is_null($this->input->post('content')) ){
			switch($this->input->post('content')){
				case "body" : $this->load->view('Users/Add/add_view'); break;
				case "script" : $this->load->view('Users/Add/add_script'); break;
				case "style" : $this->load->view('Users/Add/add_style'); break;
			}
		} 
	}
	public function manage()
	{
		if( !is_null($this->input->post('content')) ){
			switch($this->input->post('content')){
				case "body"   : $this->load->view('Users/Manage/manage_view'); break;
				case "script" : $this->load->view('Users/Manage/manage_script'); break;
				case "style" : $this->load->view('Users/Manage/manage_style'); break;
			}
		} 
	}
	public function permission()
	{
		if( !is_null($this->input->post('content')) ){
			switch($this->input->post('content')){
				case "body"   : $this->load->view('Users/Permission/permission_view'); break;
				case "script" : $this->load->view('Users/Permission/permission_script'); break;
				case "style" : $this->load->view('Users/Permission/permission_style'); break;
			}
		} 
	}
	public function permissiongroup()
	{
		if( !is_null($this->input->post('content')) ){
			switch($this->input->post('content')){
				case "body"   : $this->load->view('Users/Permissiongroup/permissiongroup_view'); break;
				case "script" : $this->load->view('Users/Permissiongroup/permissiongroup_script'); break;
				case "style" : $this->load->view('Users/Permissiongroup/permissiongroup_style'); break;
			}
		} 
	}
	public function group()
	{
		if( !is_null($this->input->post('content')) ){
			switch($this->input->post('content')){
				case "body"   : $this->load->view('Users/Group/group_view'); break;
				case "script" : $this->load->view('Users/Group/group_script'); break;
				case "style" : $this->load->view('Users/Group/group_style'); break;
			}
		} 
	}
	public function changepass()
	{
		if( !is_null($this->input->post('content')) ){
			switch($this->input->post('content')){
				case "body"   : $this->load->view('Users/Changepass/changepass_view'); break;
				case "script" : $this->load->view('Users/Changepass/changepass_script'); break;
				case "style" : $this->load->view('Users/Changepass/changepass_style'); break;
			}
		} 
	}
	public function edit()
	{
		if( !is_null($this->input->post('content')) ){
			switch($this->input->post('content')){
				case "body"   : $this->load->view('Users/Edit/edit_view'); break;
				case "script" : $this->load->view('Users/Edit/edit_script'); break;
				case "style" : $this->load->view('Users/Edit/edit_style'); break;
			}
		} 
	}
	#endregion
	

	public function infoMember()
	{
		echo json_encode($this->session->info);
	}

	#region For page Add user
	public function settingUserLogin(){
		echo json_encode($this->umd->setting_user_login( array( $this->input->post('ins')) ) );	
	} 
	#endregion

	#region For page Manage User

	public function gettingMemberList(){
		echo json_encode($this->umd->getting_user_list());
	}
	public function updatingUserActive(){
		$id = $this->input->post('loginId');
		$status = $this->input->post('active');
		$results = json_decode(json_encode($this->session->info["info"]), true); 
		echo json_encode( $this->umd->updating_user_acitve($id, $status, $results[0]["userLoginId"]) );
	}
	#endregion

	#region For page Edit Profile
	public function updatingUserLogin(){
		echo json_encode($this->umd->updating_user_login($this->input->post('upd'), $this->input->post('loginId') ) );	
	} 
	#endregion

	#region For page Change Password
	public function checkPassWord(){
		echo json_encode($this->umd->chacking_user_pass($this->input->post('us'), $this->input->post('ps')));	
	} 
	public function updatingNewPassword(){
		$update = $this->input->post('update');  
		echo json_encode( $this->umd->updating_new_pass($update) );
	}
	#endregion

	#region For page Manage Group Permission
	public function gettingMenu(){
		$rst = $this->umd->getting_menu($this->input->get('roleId'));
		if(!empty($rst) && $this->input->get('roleId') != 0){
			echo json_encode($rst);
		} else {
			echo json_encode($this->umd->getting_menu_master());
		} 
	}
	public function settingRoleMenu(){
		$parm = $this->input->post('ins');
		if($parm["roleMenuId"] != 0 ) $this->umd->deleting_role_menu(array("roleMenuId" => $parm["roleMenuId"]));

		return $this->umd->setting_role_menu(array("roleId" => $parm["roleId"], "groupMenuId" => $parm["groupMenuId"], "menuId" => $parm["menuId"]));
	}	
	public function deletingRoleMenu(){ 
		$parm = $this->input->post('ins');
		return $this->umd->deleting_role_menu(array("roleMenuId" => $parm["roleMenuId"]));
	}	
	#endregion
	
	#region For page Permission
	public function gettingRole(){
		$id = $this->input->get('id') ?? 0; 
		$ignoreAcive = (int)$this->input->get("ign") ?? 0;
		echo json_encode($this->umd->getting_role($id, (int)$ignoreAcive));
	}
	public function settingRole(){
		echo json_encode($this->umd->setting_role( array( $this->input->post('ins')) ) );	
	}
	public function updatingRoleActive(){
		$id = $this->input->post('id');
		$status = $this->input->post('active');
		$results = json_decode(json_encode($this->session->info["info"]), true); 
		echo json_encode( $this->umd->updating_role_acitve($id, $status, $results[0]["userLoginId"]) );
	}
	public function updatingRoleDeleted(){
		$id = $this->input->post('id'); 
		$results = json_decode(json_encode($this->session->info["info"]), true); 
		echo json_encode( $this->umd->updating_role_deleted($id, $results[0]["userLoginId"]) );
	}
	public function updatingRoleData(){
		$id = $this->input->post('id'); 
		$val = $this->input->post("values");
		$results = json_decode(json_encode($this->session->info["info"]), true); 
		echo json_encode( $this->umd->updating_role_data( $id, $results[0]["userLoginId"], $val) );
	}
	#endregion
	
	#region For page Permission Group
	public function gettingRoleGroup(){
		$id = $this->input->get('id') ?? 0; 
		$ignoreAcive = (int)$this->input->get("ign") ?? 0;
		echo json_encode($this->umd->getting_role_group($id, (int)$ignoreAcive));
	}
	public function settingRoleGroup(){
		echo json_encode($this->umd->setting_role_group( array( $this->input->post('ins')) ) );	
	}
	public function updatingRoleGroupActive(){
		$id = $this->input->post('id');
		$status = $this->input->post('active');
		$results = json_decode(json_encode($this->session->info["info"]), true); 
		echo json_encode( $this->umd->updating_role_group_acitve($id, $status, $results[0]["userLoginId"]) );
	}
	public function updatingRoleGroupDeleted(){
		$id = $this->input->post('id'); 
		$results = json_decode(json_encode($this->session->info["info"]), true); 
		echo json_encode( $this->umd->updating_role_group_deleted($id, $results[0]["userLoginId"]) );
	}
	public function updatingRoleGroupData(){
		$id = $this->input->post('id'); 
		$val = $this->input->post("values");
		$results = json_decode(json_encode($this->session->info["info"]), true); 
		echo json_encode( $this->umd->updating_role_group_data( $id, $results[0]["userLoginId"], $val) );
	}
	#endregion
}
