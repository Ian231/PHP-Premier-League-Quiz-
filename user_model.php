<?php
class user_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
		
	public function getUser(){
	
		$this->db->select("userID, firstname, lastname, email, username, password, reg_time, activated, image");
		$this->db->from("users");
		$query = $this->db->get();
		
		$num_data_returned = $query->num_rows;
		if ($num_data_returned < 1) {
			echo "No data in database";
			exit();
		}
		return $query->result();
	}
	
	public function deleteUser($userid){
		$this->db->where('userID', $userid);
		$this->db->delete('users');
	}
	
	public function editUser($userid){
		$this->db->where('userID', $userid);
		$dbquery = $this->db->get('users');
		if ($dbquery->result()) {
			$result = $dbquery->result();
			foreach ($result as $res) {
				$edits[$res->userID] = array($res->firstname,
				                             $res->lastname,											 
											 $res->username,								
											 );
			}
			return $edits;
		}
	}
	
	public function updateUser($edituserid, $editfirstname, $editlastname, $editusername){
		$this->db->where('userID', $edituserid);
		$this->db->set('firstname', $editfirstname);
		$this->db->set('lastname', $editlastname);
		$this->db->set('username', $editusername);
		$this->db->update('users');
	}
}


?>