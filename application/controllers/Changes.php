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

	public function add()
	{
		if( !is_null($this->input->post('content')) ){
			switch($this->input->post('content')){
				case "body" : $this->load->view('changes/add/add_view'); break;
				case "script" : $this->load->view('changes/add/add_script'); break;
				case "style" : $this->load->view('changes/add/add_style'); break;
			}
		} 
	}
	public function manage()
	{
		if( !is_null($this->input->post('content')) ){
			switch($this->input->post('content')){
				case "body"   : $this->load->view('changes/manage/manage_view'); break;
				case "script" : $this->load->view('changes/manage/manage_script'); break;
				case "style"  : $this->load->view('changes/manage/manage_style'); break;
			}
		} 
	}

	public function edit()
	{
		if( !is_null($this->input->post('content')) ){
			switch($this->input->post('content')){
				case "body"   : $this->load->view('changes/edit/edit_view'); break;
				case "script" : $this->load->view('changes/edit/edit_script'); break;
				case "style" : $this->load->view('changes/edit/edit_style'); break;
			}
		} 
	}
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
	public function getting_select_cuase(){ echo json_encode($this->chn->getting_cuase()); }
}
