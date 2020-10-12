<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barangkeluar extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('Commonfunction','','fn');
				
		//if(!isset($this->session->userdata['name']))		
		//	redirect("login","refresh");
	}
	/*	
		====================================================== Variable Declaration =========================================================
	*/
	
	var $mainTable="barang_keluar";
	var $mainPk="id_barang_keluar";
	var $viewLink="Barangkeluar";
	// var $viewLink2="Users";
	//sub menu atau header
	var $breadcrumbTitle="Daftar Barang ATK Keluar";
	//var $breadcrumbTitle2="User Access";
	// buat tampilan view data
	var $viewPage="Admviewpage";
	//buat view tambah data
	var $addPage="Admaddpage";
	//var $detPage="Formdetpage";
	
	//query
	var $ordQuery=" ORDER BY id_barang_keluar DESC ";
	var $tableQuery=
						"barang_keluar AS a INNER JOIN tb_barang AS b ON a.id_barang_keluar = b.id_barang";
	var $fieldQuery="
						a.id_barang_keluar,
						a.tanggal_keluar,
						concat(b.id_barang, b.nama_barang),
					    a.jumlah_keluar,
						a.id_divisi,
						a.id_karyawan,
						a.ttd
						"; //leave blank to show all field
						
	var $primaryKey="id_barang_keluar";
	//var $detKey="nik";
	var $updateKey="a.id_barang_keluar";
	
	//auto generate id
	//sesuaikan panjangnya length di database
	var $defaultId="TBK0001";
	var $prefix="TBK";
	var $suffix="0001";	
	
	//view
	var $viewFormTitle="Daftar Barang ATK Keluar";
	var $viewFormTableHeader=array(
									"No Transaksi",
									"Tanggal Keluar",
									"Nama Barang",
									"Jumlah",
									"Divisi",
									"Nama Karyawan",
									"TTD"
									);
	
	//save
	var $saveFormTitle="Tambah Barang ATK Keluar";
	var $saveFormTableHeader=array(
									"No Transaksi",
									"Tanggal Keluar",
									"Nama Barang",
									"Jumlah",
									"Divisi",
									"Nama Karyawan",
									"TTD"
									);
	
	//update
	var $editFormTitle="Ubah Data Barang Keluar";
	
	
	/*	
		========================================================== General Function =========================================================
	*/
	
	public function index()
	{
		//init modal
		$this->load->database();
		$this->load->model('Mmain');
		
		//check user access	
		$isAll = $this->Mmain->qRead(
										"tb_accfrm AS a INNER JOIN tb_frm AS b ON a.code_frm = b.code_frm 
										WHERE a.id_acc ='".$this->session->userdata['accUser']."' AND b.id_frm='".$this->viewLink."'",
										"a.is_add as isadd,a.is_edt as isedt,a.is_del as isdel,a.is_spec1 as acc1,a.is_spec2 as acc2","");
		foreach($isAll ->result() as $row)
		{
			$access=$row;
		}

		//$selfDept=$this->Mmain->qRead("tb_emp WHERE id_emp='".$this->session->userdata('idEmp')."'","id_div,id_loc","")->row();
		//echo $access->isadd . " cari";
		//$output['isall']=$access->isadd;
		$accessQuery="";
		//$access=$isAll;
		/*
		if($access->acc2<>1)
		{
			
		$this->viewFormTableHeader=array(
									"Avatar",
									"Name",
									"Workplace",
									"NIK",
									"Division",
									"Departement",
									"Sex",
									"Phone",
									"Address",
									"E-Mail");
									$this->tableQuery.=" WHERE a.show_emp=1 ";
		}
		*/
			//$accessQuery="WHERE b.code_user ='".$this->session->userdata['codeUser']."'";
			
			
		
		//init view
		$output['formAccess']=$access;
		
		$renderTemp=$this->Mmain->qRead($this->tableQuery.$this->ordQuery,$this->fieldQuery,"");
		foreach($renderTemp->result() as $row)
		{

		}
		$output['render']=$renderTemp;
		//init view
		$output['pageTitle']=$this->viewFormTitle;
		$output['breadcrumbTitle']=$this->breadcrumbTitle;
		$output['breadcrumbLink']=$this->viewLink;
		$output['saveLink']=$this->viewLink."/add";
		$output['deleteLink']=$this->viewLink."/delete";
		$output['primaryKey']=$this->primaryKey;
		//$output['detKey']=$this->detKey;
		$output['tableHeader']=$this->viewFormTableHeader;
		//$output['dtcustom']="datatableemp";
		
		//render view
		$this->fn->getheader();
		$this->load->view($this->viewPage,$output);
		$this->fn->getfooter();
	}
	

	
	public function add($isEdit="")
	{
		//init modal
		$this->load->database();
		$this->load->model('Mmain');
		
		
		//init view
		$output['pageTitle']=$this->saveFormTitle;
		$output['breadcrumbTitle']=$this->breadcrumbTitle;
		$output['breadcrumbLink']=$this->viewLink;
		$output['saveLink']=$this->viewLink."/save";
		$output['tableHeader']=$this->saveFormTableHeader;
		$output['formLabel']=$this->saveFormTableHeader;
		
		$imgTemp="";
		$codeTemp="";
		$isRo="";
		if(!empty($isEdit))
		{
			
			$output['pageTitle']=$this->editFormTitle;
			$output['saveLink']=$this->viewLink."/update";
			$pid=$isEdit;
			
			$render=$this->Mmain->qRead($this->tableQuery,$this->fieldQuery,$this->mainPk."  = '".$isEdit."'");
			foreach($render->result() as $row)
			{
				foreach($row as $col)
				{
					$txtVal[]= $col;
				}
			}
			
		}
		else
		{	
				for($i=0;$i<count($this->saveFormTableHeader);$i++)
				{
					$txtVal[]="";//$this->saveFormTableHeader[$i];
				}	
				
				//generate id
				$txtVal[0]=$this->Mmain->autoId($this->mainTable,$this->mainPk,$this->prefix,$this->defaultId,$this->suffix);	
				
	
		}
		
		// $cboacc=$this->fn->createCbofromDb("tb_acc","id_acc as id,nm_acc as nm","",$txtVal[58],"","txtUser[]");
		//Combobox gabungan
		$cboID=$this->fn->createCbofromDb("tb_barang","id_barang as id, concat(id_barang ,' - ',nama_barang) as nm","",$txtVal[2],"","txt[]");
				    
		$output['formTxt']=array(
								"<input type='text' class='form-control' id='txtIdBarangKeluar' name=txt[] value='".$txtVal[0]."' required readonly placeholder='Max. karakter' maxlength='70'>",
								"<input type='text' class='form-control dtp' data-date-format='yyyy-mm-dd' autocomplete=off  readonly id='txtTanggalKeluar' name=txt[] value='".$txtVal[1]."' required placeholder='' maxlength='70'>",
								$cboID,
								"<input type='text' class='form-control' autocomplete=off id='txtJumlahBarang' name=txt[] value='".$txtVal[3]."' required placeholder=' ' maxlength='70'>",
								"<input type='text' class='form-control' autocomplete=off id='txtIdDivisi' name=txt[] value='".$txtVal[4]."' required placeholder='Ex: Staff,Gudang etc.' maxlength='20'>",
								"<input type='text' class='form-control' autocomplete=off id='txtIdKaryawan' name=txt[] value='".$txtVal[5]."' required placeholder='Ex: Nava cantik etc.' maxlength='20'>",
								"
								<input type='hidden' class='form-control' id='txtsignpad' name=txtTtd   required >
									<br>
									<canvas id='signature-pad' class='signature-pad' width=auto height=200 style='border:1px solid lightgrey'></canvas>"
								);
		
		
		//load view
		$this->fn->getheader();
		$this->load->view($this->addPage,$output);
		$this->fn->getfooter();
	}	
	
	public function save()
	{
		//retrieve values
		$savValTemp=$this->input->post('txt');
		$ttd=$this->input->post('txtTtd');
		
		//save to database
		$this->load->database();
		$this->load->model('Mmain');

		echo implode("<br>",$savValTemp); //show value
		//update stok keluar
		
		$stoklama = $this->Mmain->qRead("tb_barang WHERE id_barang = '".$savValTemp[2]."' ","stok_barang","")->row()->stok_barang;
		$stokbaru = $stoklama - $savValTemp[3];

		$this->Mmain->qUpdPart("tb_barang","id_barang",$savValTemp[2],Array("stok_barang"),Array($stokbaru));
		
		//menyimpan ttd sebagai gambar di local
		
		if($ttd[1] <> "")  
		{
			$splited = explode(',', substr( $ttd[1] , 5 ) , 2);
			$ttd[1]="sign_".date("YmdHis")."_".$ttd[0].".png";
			$mime=$splited[0];
			$data=$splited[1];
			file_put_contents("assets/images/".$ttd[1],base64_decode($data));
		}
		$savValTemp[] = $ttd[1]; 
		$this->Mmain->qIns($this->mainTable,$savValTemp);
		
		$this->session->set_flashdata('successNotification', '1');
		//redirect to form
		redirect($this->viewLink,'refresh');		
	}
	
	//delete record
	public function delete($valId)
	{		
		//save to database
		$this->load->database();
		$this->load->model('Mmain');
		$this->Mmain->qDel($this->mainTable,$this->mainPk,$valId);
		
		$this->session->set_flashdata('successNotification', '3');
		//redirect to form
		redirect($this->viewLink,'refresh');		
	}
	
	//update record
	public function update()
	{
		//retrieve values
		$savValTemp=$this->input->post('txt');
		
		//save to database
		$this->load->database();
		$this->load->model('Mmain');
		// $avauser="";
		// if(!empty($_FILES['txtfl']['name']))
		// {
		// 	$flName=$_FILES['txtfl']['name'];
		// 	$flTmp=$_FILES['txtfl']['tmp_name'];
		// 	$fltype=$_FILES['txtfl']['type'];
		// 	move_uploaded_file($flTmp,"assets/admin/img/avatar/thumb/".$flName);
		// 	$avauser=$flName;
		// }
		// else
		// {
		// 	$avauser=$this->input->post('txtimg');
		// }
		
		
		
		
		// $savValTemp[] = $savValUserTemp[0];
		
		
		// //foreach($savValTemp as $i => $row) echo ($i+1)." ".$row."<br>";
		// //foreach($savValUserTemp as $i => $row) echo ($i+1)." ".$row."<br>";
		
		$this->Mmain->qUpd($this->mainTable,$this->mainPk,$savValTemp[0],$savValTemp);
		
		$this->session->set_flashdata('successNotification', '2');
		//redirect to form
		redirect($this->viewLink,'refresh');		
	}
	
	
}

?>