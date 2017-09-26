<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FailKerja extends CI_Controller {

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
			$data["activeMenu"] = "FK";
			
			$query = $this->db->query("SELECT * FROM tbl_user WHERE UserGroup = 2;");
			$data["SOList"] = $query->result();
			
			$query = $this->db->query("SELECT * FROM tbl_jenisfail;");
			$data["JenisFailList"] = $query->result();
			
			$this->load->view('header', $data); 
			$this->load->view('failkerja/tambah.php', $data);
			$this->load->view('footer');			
		}
	}
	
	public function logout(){
		$this->session->set_userdata("LoggedUser", null);
		redirect(base_url()."login");
	}
	
	public function tambah(){
		$NoFail = $this->input->post("NoFail");
		$KeraniID = $this->input->post("KeraniID");
		$JenisFailID = $this->input->post("JenisFailID");
		$Keterangan = $this->input->post("Keterangan");
		$TarikhPermohonanArr = explode("/",$this->input->post("TarikhPermohonan"));
		$TarikhPermohonan = $TarikhPermohonanArr[2]."/".$TarikhPermohonanArr[1]."/".$TarikhPermohonanArr[0];
		$TarikhBukaFailArr = explode("/",$this->input->post("TarikhBukaFail"));
		$TarikhBukaFail = $TarikhBukaFailArr[2]."/".$TarikhBukaFailArr[1]."/".$TarikhBukaFailArr[0];
		$SOID = $this->input->post("SOID");
		
		$data = array(
		   "NoFail" => $NoFail,
		   "KeraniID" => $KeraniID,
		   "JenisFailID" => $JenisFailID,
		   "Keterangan" => $Keterangan,
		   "TarikhPermohonan" => $TarikhPermohonan,
		   "TarikhBukaFail" => $TarikhBukaFail,
		   "SOID" => $SOID
		);

		$this->db->insert("tbl_fail", $data);
		
		redirect(base_url());
	}
	
	public function senarai(){
		if($this->session->userdata("LoggedUser") == null){
			redirect(base_url()."login");
		}else{
			$data["activeMenu"] = "FK";
			
			$query = $this->db->query("SELECT *,tbl_fail.ID AS FailID FROM tbl_fail 
			INNER JOIN tbl_user ON tbl_fail.KeraniID = tbl_user.ID 
			INNER JOIN tbl_jenisfail ON tbl_fail.JenisFailID = tbl_jenisfail.ID;");
			$data["FailList"] = $query->result();			
			
			$this->load->view('header', $data); 
			$this->load->view('failkerja/senarai.php', $data);
			$this->load->view('footer');			
		}
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
