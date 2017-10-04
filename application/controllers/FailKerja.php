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
			
			$query = $this->db->query("SELECT * FROM tbl_jeniskerja;");
			$data["JenisKerjaList"] = $query->result();
			
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
		$JenisKerja = $this->input->post("JenisKerja");
		
		$query = $this->db->query("SELECT FullName,EmailAddress FROM tbl_user WHERE ID = $SOID;");
		$SOName = $query->row()->FullName;
		$SOEmailAddress = $query->row()->EmailAddress;
		
		$query = $this->db->query("SELECT NamaJenisFail FROM tbl_jenisfail WHERE ID = $JenisFailID;");
		$NamaJenisFail = $query->row()->NamaJenisFail;
		
		$query = $this->db->query("SELECT FullName FROM tbl_user WHERE ID = $KeraniID;");
		$KeraniName = $query->row()->FullName;
		
		$data = array(
		   "NoFail" => $NoFail,
		   "KeraniID" => $KeraniID,
		   "JenisFailID" => $JenisFailID,
		   "Keterangan" => $Keterangan,
		   "TarikhPermohonan" => $TarikhPermohonan,
		   "TarikhBukaFail" => $TarikhBukaFail,
		   "SOID" => $SOID,
		   "JenisKerjaID" => $JenisKerja
		);

		$this->db->insert("tbl_fail", $data);
		
		$config = Array(
			'protocol' => $this->config->item('iris_mail_protocol'),
			'smtp_host' => $this->config->item('iris_mail_smtp_host'),
			'smtp_port' => $this->config->item('iris_mail_smtp_port'),
			'smtp_user' => $this->config->item('iris_mail_smtp_user'),
			'smtp_pass' => $this->config->item('iris_mail_smtp_pass'),
			'mailtype' => $this->config->item('iris_mail_mailtype'),
			'charset' => $this->config->item('iris_mail_charset'),
			'wordwrap' => $this->config->item('iris_mail_wordwrap')
		);
		
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from($this->config->item('iris_mail_from_email'), $this->config->item('iris_mail_from_name'));
		$this->email->to($SOEmailAddress);  
		$this->email->subject("Notifikasi Sistem IRIS");
		$this->email->message("Salam Sejahtera <b>$SOName</b>,<br/><br/>Dimaklumkan bahawa Tuan/Puan telah menerima satu permohonan daripada <b>$KeraniName</b>. Butiran permohonan adalah seperti berikut:<br/><br/>No. Fail: <b>$NoFail</b><br/>Jenis Fail: <b>$NamaJenisFail</b><br/>Keterangan: <b>$Keterangan</b><br/><br/>Sila login ke Sistem untuk Pengesahan Penerimaan.<br/><br/>Terima kasih<br/>IRIS Admin");
		//$this->email->message("Salam Sejahtera <b>$SOName</b>,<br/><br/>Fail seperti dibawah telah dihantar kepada anda:<br/><br/>No. Fail: <b>$NoFail</b><br/>Jenis Fail: <b>$NamaJenisFail</b><br/>Keterangan: <b>$Keterangan</b><br/>Kerani: <b>$KeraniName</b><br/><br/>Terima kasih<br/>IRIS Admin");
		$this->email->send();
		
		redirect(base_url()."FailKerja/senarai");
	}
	
	public function senarai(){
		if($this->session->userdata("LoggedUser") == null){
			redirect(base_url()."login");
		}else{
			$data["activeMenu"] = "FK";
			
			$LoggedUserGroup = $this->session->userdata("LoggedUser")["Group"];
			$LoggedUserID = $this->session->userdata("LoggedUser")["UserID"];
			
			if($LoggedUserGroup == 1){	
				$query = $this->db->query("SELECT *,tbl_fail.ID AS FailID,uk.FullName AS KeraniName,us.FullName AS SOName, jk.NamaJenisKerja AS JenisKerjaName FROM tbl_fail 
					INNER JOIN tbl_user AS uk ON tbl_fail.KeraniID = uk.ID 
					INNER JOIN tbl_user AS us ON tbl_fail.SOID = us.ID 
					LEFT JOIN tbl_jeniskerja AS jk ON tbl_fail.JenisKerjaID = jk.ID 
					INNER JOIN tbl_jenisfail ON tbl_fail.JenisFailID = tbl_jenisfail.ID;");			
			}elseif($LoggedUserGroup == 2){		
				$query = $this->db->query("SELECT *,tbl_fail.ID AS FailID,uk.FullName AS KeraniName,us.FullName AS SOName, jk.NamaJenisKerja AS JenisKerjaName FROM tbl_fail 
					INNER JOIN tbl_user AS uk ON tbl_fail.KeraniID = uk.ID 
					INNER JOIN tbl_user AS us ON tbl_fail.SOID = us.ID 
					LEFT JOIN tbl_jeniskerja AS jk ON tbl_fail.JenisKerjaID = jk.ID 
					INNER JOIN tbl_jenisfail ON tbl_fail.JenisFailID = tbl_jenisfail.ID 
					WHERE tbl_fail.SOID = ".$LoggedUserID.";");				
			}elseif($LoggedUserGroup == 3){		
				$query = $this->db->query("SELECT *,tbl_fail.ID AS FailID,uk.FullName AS KeraniName,us.FullName AS SOName, jk.NamaJenisKerja AS JenisKerjaName FROM tbl_fail 
					INNER JOIN tbl_user AS uk ON tbl_fail.KeraniID = uk.ID 
					INNER JOIN tbl_user AS us ON tbl_fail.SOID = us.ID 
					LEFT JOIN tbl_jeniskerja AS jk ON tbl_fail.JenisKerjaID = jk.ID 
					INNER JOIN tbl_jenisfail ON tbl_fail.JenisFailID = tbl_jenisfail.ID 
					WHERE tbl_fail.KeraniID = ".$LoggedUserID.";");	
			}
			
			$data["FailList"] = $query->result();			
			
			$this->load->view('header', $data); 
			$this->load->view('failkerja/senarai.php', $data);
			$this->load->view('footer');			
		}
	}
	
	public function kemaskini($ID){
		$data["activeMenu"] = "FK";
			
		$query = $this->db->query("SELECT * FROM tbl_user WHERE UserGroup = 2;");
		$data["SOList"] = $query->result();
		
		$query = $this->db->query("SELECT * FROM tbl_jenisfail;");
		$data["JenisFailList"] = $query->result();
			
		$query = $this->db->query("SELECT * FROM tbl_catatan;");
		$data["CatatanList"] = $query->result();
			
		$query = $this->db->query("SELECT * FROM tbl_jeniskerja;");
		$data["JenisKerjaList"] = $query->result();

		$this->db->select("*,tbl_fail.ID AS FID");
		$this->db->from("tbl_fail");
		$this->db->join("tbl_user", "tbl_fail.KeraniID = tbl_user.ID", "left");
		$this->db->join("tbl_jenisfail", "tbl_fail.JenisFailID = tbl_jenisfail.ID", "left");
		$this->db->join("tbl_catatan", "tbl_fail.Catatan = tbl_catatan.ID", "left");
		$this->db->where("tbl_fail.ID", $ID);
		$query = $this->db->get();
		
		$data["FailData"] = $query->row();
		
		$this->load->view('header', $data); 
		$this->load->view('failkerja/kemaskini.php', $data);
		$this->load->view('footer');
	}
	
	public function update($ID){
		$NoFail = $this->input->post("NoFail");
		$KeraniID = $this->input->post("KeraniID");
		$JenisFailID = $this->input->post("JenisFailID");
		$Keterangan = $this->input->post("Keterangan");
		$TarikhPermohonanArr = explode("/",$this->input->post("TarikhPermohonan"));
		$TarikhPermohonan = $TarikhPermohonanArr[2]."/".$TarikhPermohonanArr[1]."/".$TarikhPermohonanArr[0];
		$TarikhBukaFailArr = explode("/",$this->input->post("TarikhBukaFail"));
		$TarikhBukaFail = $TarikhBukaFailArr[2]."/".$TarikhBukaFailArr[1]."/".$TarikhBukaFailArr[0];
		$SOID = $this->input->post("SOID");
		$JenisKerja = $this->input->post("JenisKerja");
		
		if($this->input->post("TarikhTerima") != ""){
			$TarikhTerimaArr = explode("/",$this->input->post("TarikhTerima"));
			$TarikhTerima = $TarikhTerimaArr[2]."-".$TarikhTerimaArr[1]."-".$TarikhTerimaArr[0];			
		}else{
			$TarikhTerima = "";	
		}

		if($this->input->post("TarikhSiap") != ""){
			$TarikhSiapArr = explode("/",$this->input->post("TarikhSiap"));
			$TarikhSiap = $TarikhSiapArr[2]."-".$TarikhSiapArr[1]."-".$TarikhSiapArr[0];
		}else{
			$TarikhSiap = "";	
		}
		
		$Catatan = $this->input->post("Catatan");
		$CatatanSebab = $this->input->post("CatatanSebab");
		
		$JumlahHari = date_diff(date_create($TarikhTerima), date_create($TarikhSiap));
		
		if($JumlahHari->format('%a%') == 0){
			$JumlahHariStr = "";
		}else{
			$JumlahHariStr = $JumlahHari->format('%a%');
		}
		
		$data = array(
		   "NoFail" => $NoFail,
		   "KeraniID" => $KeraniID,
		   "JenisFailID" => $JenisFailID,
		   "Keterangan" => $Keterangan,
		   "TarikhPermohonan" => $TarikhPermohonan,
		   "TarikhBukaFail" => $TarikhBukaFail,
		   "SOID" => $SOID,
		   "JenisKerjaID" => $JenisKerja,
		   "TarikhTerima" => $TarikhTerima,
		   "TarikhSiap" => $TarikhSiap,
		   "JumlahHari" => $JumlahHariStr,
		   "Catatan" => $Catatan,
		   "CatatanSebab" => $CatatanSebab
		);

		$this->db->where("ID", $ID);
		$this->db->update("tbl_fail", $data);
		
		redirect(base_url()."FailKerja/senarai");
	}
}
