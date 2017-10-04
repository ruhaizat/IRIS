<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {

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
			$data["activeMenu"] = "P";
			
			$query = $this->db->query("SELECT * FROM tbl_usergroup;");
			$data["JenisPenggunaList"] = $query->result();
			
			$this->load->view('header', $data); 
			$this->load->view('pengguna/tambah.php', $data);
			$this->load->view('footer');			
		}
	}
	
	public function logout(){
		$this->session->set_userdata("LoggedUser", null);
		redirect(base_url()."login");
	}
	
	public function tambah(){
		$this->load->library('bcrypt');
				
		$ID = $this->input->post("ID");
		$Password = $this->input->post("Password");
		$Nama = $this->input->post("Nama");
		$JenisPengguna = $this->input->post("JenisPengguna");
		$Jawatan = $this->input->post("Jawatan");
		$Unit = $this->input->post("Unit");
		
		$hash = $this->bcrypt->hash_password($Password);
		
		$data = array(
		   "Username" => $ID,
		   "Password" => $hash,
		   "FullName" => $Nama,
		   "EmailAddress" => $ID,
		   "UserGroup" => $JenisPengguna,
		   "Jawatan" => $Jawatan,
		   "Unit" => $Unit
		);

		$this->db->insert("tbl_user", $data);
		
		redirect(base_url()."Pengguna/senarai");
	}
	
	public function senarai(){
		if($this->session->userdata("LoggedUser") == null){
			redirect(base_url()."login");
		}else{
			$data["activeMenu"] = "P";
			
			$query = $this->db->query("SELECT *,tbl_user.ID AS UID FROM tbl_user 
				INNER JOIN tbl_usergroup ON tbl_user.UserGroup = tbl_usergroup.ID;");			
			
			$data["UserList"] = $query->result();			
			
			$this->load->view('header', $data); 
			$this->load->view('Pengguna/senarai.php', $data);
			$this->load->view('footer');			
		}
	}
	
	public function kemaskini($ID){
		$data["activeMenu"] = "P";
			
		$query = $this->db->query("SELECT * FROM tbl_usergroup;");			
		
		$data["UserGroupList"] = $query->result();

		$this->db->select("*,tbl_user.ID AS UID");
		$this->db->from("tbl_user");
		$this->db->join("tbl_usergroup", "tbl_user.UserGroup = tbl_usergroup.ID", "left");
		$this->db->where("tbl_user.ID", $ID);
		$query = $this->db->get();
		
		$data["PenggunaData"] = $query->row();
		
		$this->load->view('header', $data); 
		$this->load->view('pengguna/kemaskini.php', $data);
		$this->load->view('footer');
	}
	
	public function update($ID){
		$this->load->library('bcrypt');
				
		$Email = $this->input->post("ID");
		$Password = $this->input->post("Password");
		$Nama = $this->input->post("Nama");
		$JenisPengguna = $this->input->post("JenisPengguna");
		$Jawatan = $this->input->post("Jawatan");
		$Unit = $this->input->post("Unit");
		
		$hash = $this->bcrypt->hash_password($Password);
		
		$data = array(
		   "Username" => $Email,
		   "Password" => $hash,
		   "FullName" => $Nama,
		   "EmailAddress" => $Email,
		   "UserGroup" => $JenisPengguna,
		   "Jawatan" => $Jawatan,
		   "Unit" => $Unit
		);

		$this->db->where("ID", $ID);
		$this->db->update("tbl_user", $data);
		
		redirect(base_url()."Pengguna/senarai");
	}
}
