<?php 
class login_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function login_user($username, $password){
		$sql = "SELECT adminID, password FROM admin WHERE username ='".$username."' LIMIT 1";
		$result = $this->db->query($sql);
		$row = $result->row();
		
		if ($result->num_rows() == 1) {
			if ($row->password === sha1($this->config->item('salt').$password)) {
				'return logged_in';
			}
			else{
				return 'incorrect_password';
			}
		}
		else{
			return 'username_not_found';
		}
	}
	public function get_admin_data($username){
		$sql = "SELECT * FROM admin WHERE username = '" .$username."' LIMIT 1"; 
		$result = $this->db->query($sql);
		if($result) {
			return $result->row();
		} else {
			return false;
		}
	}
}
?>