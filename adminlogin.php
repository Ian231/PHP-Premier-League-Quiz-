<?php
class adminlogin extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('login_model');
	}
	
	public function index(){
		redirect('adminlogin/login');
	}
	
	public function login(){
		$this->load->library('form_validation');
		if ($this->session->userdata('logged_in')) {
			redirect('Dashboard');
		}
		
		$post = $this->input->post();
		if ($post) {
			$this->form_validation->set_rules('username' , 'Username', 'trim|required|min_length[3]|max_length[20|xss_clean');
			$this->form_validation->set_rules('password','Password', 'trim|required|min_length[3]|max_length[50]|callback_check_login');
			
			if ($this->form_validation->run() == TRUE) {
				$admindata = $this->login_model->get_admin_data(set_value('username'));
				if ($admindata) {
					$session_data = array(
						'adminID' => $admindata->adminID,
						'username' => $admindata->username,
						'logged_in' => 1				
					);
					$this->session->set_userdata($session_data);
					redirect('Dashboard/index');
				}else{
					$this->session->set_flashdata('error', 'Unable to login.'); 
					redirect('adminlogin/login');
				}
			}
			
		}
		$this->load->view('account/header');
		$this->load->view('account/login_view');
		$this->load->view('account/footer');
	}

	public function check_login(){
		$username = set_value('username');
		$password = set_value('password');
		
		if (!$username && !$password) {
			return FALSE;
		}
		
		$result = $this->login_model->login_user($username, $password);
		switch ($result) {
			case 'logged_in':
				  return TRUE;
				break;
			
			case 'incorrect_password':
				$this->form_validation->set_message('check_login', 'Incorrect password. Please try again');
				return FALSE;
				break;
		}
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect('adminlogin');
	}
}

?>