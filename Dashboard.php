<?php
class Dashboard extends CI_Controller{
	public function __construct(){
		parent::__construct();
		// $this->check_isvalidated();
		$this->load->model('user_model');
		
	}

	public function index(){
		$this->data['user'] = $this->user_model->getUser(); 
		$this->load->view('home/header'); 
		$this->load->view('home/admin_view', $this->data);
		$this->load->view('home/footer');
	}	
	
	// private function check_isvalidated(){
		// if (! $this->session->userdata('validated')) {
			// redirect('adminlogin');
		// }
	// }
	
	
	//delete user
	public function delete(){
	    if ($this->input->server('REQUEST_METHOD') == 'GET') {
			$userid = $this->input->get('userid');
			$delete = $this->user_model->deleteUser($userid);
			echo json_encode($delete);
	    }
	}
	//edit user and updates
	public function edit(){
		if ($this->input->server('REQUEST_METHOD') == 'GET') {
			$userid = $this->input->get('userid');
			$edit = $this->user_model->editUser($userid);
			echo json_encode($edit);
		}
		elseif ($this->input->server('REQUEST_METHOD') == 'POST') {
			$edituserid = $this->input->post('edituserid');
			$editfirstname = $this->input->post('editfirstname');
			$editlastname = $this->input->post('editlastname');
			$editusername = $this->input->post('editusername');
			$update = $this->user_model->updateUser($edituserid,$editfirstname,$editlastname,$editusername);
			echo json_encode($update);
		}
	}
}

?>