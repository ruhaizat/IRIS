<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

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
			$data["activeMenu"] = "L";
			
			$query = $this->db->query("SET lc_time_names = 'ms_MY';");
			$query = $this->db->query("SELECT SUBSTRING(TarikhPermohonan, 1, 4) AS Year, SUBSTRING(TarikhPermohonan, 6, 2) AS Month, CONCAT(MONTHNAME(STR_TO_DATE(SUBSTRING(TarikhPermohonan, 6, 2), '%m')),' ',SUBSTRING(TarikhPermohonan, 1, 4)) AS MonthYearStr FROM tbl_fail GROUP BY CONCAT(SUBSTRING(TarikhPermohonan, 6, 2),'-',SUBSTRING(TarikhPermohonan, 1, 4)) ORDER BY SUBSTRING(TarikhPermohonan, 1, 4),SUBSTRING(TarikhPermohonan, 6, 2) ASC;");
			$data["BulanTahun"] = $query->result();
			
			$query = $this->db->query("SELECT * FROM tbl_user WHERE UserGroup = 2;");
			$data["SOList"] = $query->result();
			
			$this->load->view('header', $data); 
			$this->load->view('laporan/jana.php', $data);
			$this->load->view('footer');			
		}
	}
	
	public function papar(){
		$Bulan = $this->input->post("Bulan");
		
		$BulanArr = explode("_",$Bulan);
		$Year = $BulanArr[0];
		$Month = $BulanArr[1];
		
		$MonthYearStr = "";
		
		if($Month == "01"){
			$MonthYearStr = "Januari ".$Year;
		}elseif($Month == "02"){
			$MonthYearStr = "Februari ".$Year;
		}elseif($Month == "03"){
			$MonthYearStr = "Mac ".$Year;
		}elseif($Month == "04"){
			$MonthYearStr = "April ".$Year;
		}elseif($Month == "05"){
			$MonthYearStr = "Mei ".$Year;
		}elseif($Month == "06"){
			$MonthYearStr = "Jun ".$Year;
		}elseif($Month == "07"){
			$MonthYearStr = "Julai ".$Year;
		}elseif($Month == "08"){
			$MonthYearStr = "Ogos ".$Year;
		}elseif($Month == "09"){
			$MonthYearStr = "September ".$Year;
		}elseif($Month == "10"){
			$MonthYearStr = "Oktober ".$Year;
		}elseif($Month == "11"){
			$MonthYearStr = "November ".$Year;
		}elseif($Month == "12"){
			$MonthYearStr = "Disember ".$Year;
		}
		
		$data["MonthYearStr"] = $MonthYearStr;
		
		$SOID = $this->input->post("SOID");
		
		$query = $this->db->query("SELECT FullName FROM tbl_user WHERE ID = $SOID;");
		$SOName = $query->row()->FullName;
		$data["SOName"] = $SOName;
		
		$Sasaran = $this->input->post("Sasaran");
		$SasaranFilter = "";
		
		if($Sasaran == "S"){
			$SasaranFilter = "";
			$data["SasaranFilter"] = "Semua";
		}elseif($Sasaran == "W"){
			$SasaranFilter = " AND tbl_fail.JumlahHari <= 14";
			$data["SasaranFilter"] = "Dalam tempoh 14 hari";
		}elseif($Sasaran == "M"){
			$SasaranFilter = " AND tbl_fail.JumlahHari > 14";
			$data["SasaranFilter"] = "Lebih dari 14 hari";
		}
		
		//ini_set('max_execution_time', 0);

		$query = $this->db->query("SET lc_time_names = 'ms_MY';");
		$query = $this->db->query("SELECT *, 
			tbl_fail.ID AS FailID, 
			uk.FullName AS KeraniName, 
			us.FullName AS SOName 
			FROM tbl_fail 
			INNER JOIN tbl_user AS uk ON tbl_fail.KeraniID = uk.ID 
			INNER JOIN tbl_user AS us ON tbl_fail.SOID = us.ID 
			INNER JOIN tbl_jenisfail ON tbl_fail.JenisFailID = tbl_jenisfail.ID 
			WHERE tbl_fail.SOID = ".$SOID." 
			AND SUBSTRING(tbl_fail.TarikhPermohonan, 1, 4) = '".$Year."' 
			AND SUBSTRING(tbl_fail.TarikhPermohonan, 6, 2) = '".$Month."' ".$SasaranFilter.";");				
			
		$data["FailList"] = $query->result();
		
		$html = $this->load->view('laporan/papar.php', $data, true);
		
		$this->load->library('M_pdf');
		
		$kmpdf = new mPDF("c", "A4-L", 0, "", 0, 0, 0, 0, 0, 0);

		$kmpdf->WriteHTML($html);

		//download it D save F.
		ob_clean();
		$kmpdf->Output($MonthYearStr."_".$SOName."_".$data["SasaranFilter"].".pdf", "D");
	}
}
