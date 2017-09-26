<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if($this->session->userdata("LoggedUser") == null){
			redirect(base_url()."login");
		}else{
			$data["activeMenu"] = "PU";
			
			$this->load->view('header', $data);
			$this->load->view('main');
			$this->load->view('footer');			
		}
	}
	
	public function logout(){
		$this->session->set_userdata("LoggedUser", null);
		redirect(base_url()."login");
	}
	
	public function ajax()
	{
		$obj = json_decode($this->input->post("datastr"));
		$mode = $obj->mode;
		
		switch($mode){
			case "SignIn":
				$this->load->library("bcrypt");
				$username = $obj->Username;
				$password = $obj->Password;
				$query = $this->db->query("SELECT * FROM tbl_user WHERE Username = '$username'");
				
				$userData = $query->row();
				
				if($query->num_rows() == 0){
					$accountResult = 1;
				}
				else{
					if($this->bcrypt->check_password($password, $userData->Password) == false) {
						$accountResult = 2;
					}else{
						$userfound = true;
						
						$session_data = array(
							"UserID" => $userData->ID,
							"FullName" => $userData->FullName,
							"EmailAddress" => $userData->EmailAddress,
							"Group" => $userData->UserGroup
						);
						$this->session->set_userdata("LoggedUser", $session_data);
						
						$accountResult = 0;
					}
				}
				
				if($accountResult == 0){
					echo "Account active";
				}elseif($accountResult == 1){
					echo "Account not found";
				}elseif($accountResult == 2){
					echo "Wrong password";
				}
			break;
		}
	}
}
