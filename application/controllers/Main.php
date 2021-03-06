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
			
			
			$LoggedUserGroup = $this->session->userdata("LoggedUser")["Group"];
			$LoggedUserID = $this->session->userdata("LoggedUser")["UserID"];
			
			$filterAll = "";
			$filter = "";
			$filterJFY = "";
			
			if($LoggedUserGroup == 2){
				$filterAll = " WHERE SOID = ".$LoggedUserID;
				$filter = " AND SOID = ".$LoggedUserID;
				//$filterJFY = " WHERE SOID = ".$LoggedUserID;			
			}elseif($LoggedUserGroup == 3){	
				$filterAll = " WHERE KeraniID = ".$LoggedUserID;
				$filter = " AND KeraniID = ".$LoggedUserID;
				//$filterJFY = " WHERE KeraniID = ".$LoggedUserID;	
			}
			
			$query = $this->db->query("SELECT COUNT(ID) AS val FROM tbl_fail $filterAll;");
			$data["JF"] = $query->row();
			
			$query = $this->db->query("SELECT COUNT(ID) AS val FROM tbl_fail WHERE JenisFailID = 1 $filter;");
			$data["LUPUS"] = $query->row();
			
			$query = $this->db->query("SELECT COUNT(ID) AS val FROM tbl_fail WHERE JenisFailID = 2 $filter;");
			$data["BANGUN"] = $query->row();
			
			$query = $this->db->query("SELECT COUNT(ID) AS val FROM tbl_fail WHERE JumlahHari > 14 $filter;");
			$data["EXCEED"] = $query->row();
			
			$query = $this->db->query("SELECT SUBSTRING(TarikhPermohonan, 6, 2) AS Month, SUBSTRING(TarikhPermohonan, 1, 4) AS Year, CONCAT(SUBSTRING(TarikhPermohonan, 6, 2),'-',SUBSTRING(TarikhPermohonan, 1, 4)) AS MonthYear, COUNT(ID) AS val, (SELECT COUNT(ID) AS val FROM tbl_fail WHERE JenisFailID = 1 AND CONCAT(SUBSTRING(TarikhPermohonan, 6, 2),'-',SUBSTRING(TarikhPermohonan, 1, 4)) = MonthYear AND JumlahHari <= 14 $filter) AS Lupus, (SELECT COUNT(ID) AS val FROM tbl_fail WHERE JenisFailID = 2 AND CONCAT(SUBSTRING(TarikhPermohonan, 6, 2),'-',SUBSTRING(TarikhPermohonan, 1, 4)) = MonthYear AND JumlahHari <= 14 $filter) AS Bangun FROM tbl_fail WHERE JumlahHari <= 14  $filter GROUP BY CONCAT(SUBSTRING(TarikhPermohonan, 6, 2),'-',SUBSTRING(TarikhPermohonan, 1, 4)) ORDER BY SUBSTRING(TarikhPermohonan, 1, 4),SUBSTRING(TarikhPermohonan, 6, 2) ASC;");
			$data["JFY"] = $query->result();
			
			
			$this->load->view('header', $data);
			$this->load->view('main', $data);
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
			case "DeleteFile":
				$ID = $obj->ID;
				$this->db->delete("tbl_fail", array("ID" => $ID));
			break;
			case "DeleteUser":
				$ID = $obj->ID;
				$this->db->delete("tbl_user", array("ID" => $ID));
			break;
			case "SemakNoFail":
				$NoFail = $obj->NoFail;
				$query = $this->db->query("SELECT * FROM tbl_fail WHERE NoFail = '$NoFail';");
				if($query->num_rows() > 0){
					echo "WUJUD";
				}else{
					echo "OK";
				}
			break;
		}
	}
}
