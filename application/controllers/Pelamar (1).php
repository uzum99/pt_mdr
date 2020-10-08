<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelamar extends CI_Controller 
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
	
	var $mainTable="tb_pelamar";
	var $mainPk="id_pelamar";
	var $viewLink="pelamar";
	// var $viewLink2="Users";
	//sub menu atau header
	var $breadcrumbTitle="Data Pelamar";
	//var $breadcrumbTitle2="User Access";
	// buat tampilan view data
	var $viewPage="Admviewpage";
	//buat view tambah data
	var $addPage="Admaddpage";
	//var $detPage="Formdetpage";
	
	//query
	var $ordQuery=" ORDER BY id_pelamar DESC ";
	var $tableQuery="
						tb_pelamar
						";
	var $fieldQuery="
						id_pelamar,
						nama_pelamar,
						tgllahir_pelamar,
						umur_pelamar,
						jk_pelamar,
						alamat_pelamar,
						agama_pelamar,
						nohp_pelamar,
						status_pelamar,
						pdkterakhir_pelamar,
						jurusan_pelamar,
						pt_pelamar,
						Foto_pelamar
						"; //leave blank to show all field
						
	var $primaryKey="id_pelamar";
	//var $detKey="nik";
	var $updateKey="id_pelamar";
	
	//auto generate id
	//sesuaikan panjangnya length di database
	var $defaultId="PLM0001";
	var $prefix="PLM";
	var $suffix="0001";	
	
	//view
	var $viewFormTitle="Data Pelamar";
	var $viewFormTableHeader=array(
									"Id Pelamar",
									"Nama Pelamar",
									"TglLahir Pelamar",
									"Umur Pelamar",
									"Jk Pelamar",
									"Alamat Pelamar",
									"Agama Pelamar",
									"No.hp Pelamar",
									"Status Pelamar",
									"PdkTerakhir Pelamar",
									"Jurusan Pelamar",
									"PT Pelamar",
									"Foto Pelamar"
									);
	
	//save
	var $saveFormTitle="Tambah Pelamar";
	var $saveFormTableHeader=array(
									"Id Pelamar",
									"Nama pelamar",
									"TglLahir pelamar",
									"Umur pelamar",
									"Jk pelamar",
									"Alamat pelamar",
									"Agama pelamar",
									"No.hp pelamar",
									"Status pelamar",
									"Pendidikan Terakhir pelamar",
									"Jurusan pelamar",
									"Perguruan Tinggi pelamar",
									"Foto pelamar"
									);
	
	//update
	var $editFormTitle="Ubah Data Pelamar";
	
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
		
		//$output['isall']=$access->isadd;
		$accessQuery="";
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
			
		//foto
		
		//init view
		$output['formAccess']=$access;
		
		$renderTemp=$this->Mmain->qRead($this->tableQuery.$this->ordQuery,$this->fieldQuery,"");
		foreach($renderTemp->result() as $row)
		{
			$row->Foto_pelamar="<img src='".base_url()."/assets/foto/".$row->Foto_pelamar."' height='auto' width='100px' >";
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
			//menambahkan foto
			
			$imgTemp="<h5><i>Click browse to change image</i></h5>
			<img src='".base_url()."/assets/foto/".$txtVal[12]."' height='200px' width='auto' >
			<input type='hidden' name='txtimg' value='".$txtVal[12]."'>";

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
		//combobox dinamis dan statis
		//$cboacc=$this->fn->createCbofromDb("tb_acc","id_acc as id,nm_acc as nm","",$txtVal[58],"","txtUser[]");
	$cboJK=$this->fn->createCbo(array('Laki-laki','Perempuan'),array('Laki-laki','Perempuan'),$txtVal[4]);
	$cboAgama=$this->fn->createCbo(array('Islam','Kristen','Katholik','Hindu','Budha','Kong Hu Chu'),array('Islam','Kristen','Katholik','Hindu','Budha','Kong Hu Chu'),$txtVal[6]);	
		
		$output['formTxt']=array(
								"<input type='text' class='form-control' id='txtIdPelamar' name=txt[] value='".$txtVal[0]."' required readonly placeholder='Max. 70 karakter' maxlength='70'>",
								"<input type='text' class='form-control' id='txtNamaPelamar' name=txt[] value='".$txtVal[1]."' required placeholder='Max. 70 karakter' maxlength='70'>",
								"<input type='text' class='form-control dtp' data-date-format='yyyy-mm-dd' autocomplete=off  readonly id='txtTglLahirPelamar' name=txt[] value='".$txtVal[2]."' required placeholder='Max. 70 karakter' maxlength='70'>",
								"<input type='text' class='form-control' id='txtUmurPelamar' name=txt[] value='".$txtVal[3]."' required placeholder='Max. 70 karakter' maxlength='70'>",
								$cboJK,
								"<input type='text' class='form-control' id='txtAlamatPelamar' name=txt[] value='".$txtVal[5]."' required placeholder='Max. 70 karakter' maxlength='70'>",
								$cboAgama,
								"<input type='text' class='form-control' id='txtNoHpPelamar' name=txt[] value='".$txtVal[7]."' required placeholder='Max. 70 karakter' maxlength='70'>",
								"<input type='text' class='form-control' id='txtStatusPelamar' name=txt[] value='".$txtVal[8]."' required placeholder='Max. 70 karakter' maxlength='70'>",
								"<input type='text' class='form-control' id='txtPdkPelamar' name=txt[] value='".$txtVal[9]."' required placeholder='Max. 70 karakter' maxlength='70'>",
								"<input type='text' class='form-control' id='txtJurusanPelamar' name=txt[] value='".$txtVal[10]."' required placeholder='Max. 70 karakter' maxlength='70'>",
								"<input type='text' class='form-control' id='txtPtPelamar' name=txt[] value='".$txtVal[11]."' required placeholder='Max. 70 karakter' maxlength='70'>",
								$imgTemp."<input type='file' class='form-control fileupload' id='txtid23' name=txtfl >"
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
		
		//save to database
		$this->load->database();
		$this->load->model('Mmain');
//menampilakan foto
		$avauser="";
		if(!empty($_FILES['txtfl']['name']))
		{
			$flName=$_FILES['txtfl']['name'];
			$flTmp=$_FILES['txtfl']['tmp_name'];
			$fltype=$_FILES['txtfl']['type'];
			move_uploaded_file($flTmp,"assets/foto/".$flName);
			$avauser=$flName;
		}
		else
		{
			$avauser="def.jpg";
		}
		$savValTemp[]=$avauser;

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
//update foto	
		 $avauser="";
		 if(!empty($_FILES['txtfl']['name']))
		 {
		 	$flName=$_FILES['txtfl']['name'];
		 	$flTmp=$_FILES['txtfl']['tmp_name'];
		 	$fltype=$_FILES['txtfl']['type'];
		 	move_uploaded_file($flTmp,"assets/foto/".$flName); 
		 	$avauser=$flName;
		 }
		 else
		 {
		 	$avauser=$this->input->post('txtimg');
		 }
		
		 $savValTemp[]=$avauser;
	
		$this->Mmain->qUpd($this->mainTable,$this->mainPk,$savValTemp[0],$savValTemp);
		
		$this->session->set_flashdata('successNotification', '2');
		//redirect to form
		redirect($this->viewLink,'refresh');		
	}
	
	
}

?>