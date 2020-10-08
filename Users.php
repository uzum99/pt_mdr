<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('Commonfunction','','fn');
				
		if(!isset($this->session->userdata['name']))		
			redirect("login","refresh");
	}
	/*	
		====================================================== Variable Declaration =========================================================
	*/
	
	var $mainTable="tb_emp";
	var $mainPk="code_user";
	var $viewLink="Users";
	var $viewLink2="Users";
	var $breadcrumbTitle="Employees";
	var $breadcrumbTitle2="User Access";
	var $viewPage="Admviewpage";
	var $addPage="Admaddpage";
	var $detPage="Formdetpage";
	
	//query
	var $ordQuery=" ORDER BY loc, pinned desc, code ";
	var $tableQuery="
						tb_emp AS a INNER JOIN 
						tb_user AS b ON a.code_user = b.code_user  INNER JOIN 
						tb_acc AS f ON f.id_acc = b.id_acc  INNER JOIN 
						tb_loc AS c ON a.id_loc= c.id_loc  INNER JOIN 
						tb_div AS d ON a.id_div = d.id_div INNER JOIN 
						tb_st_emp AS s ON a.id_st_emp = s.id_st_emp INNER JOIN 
						tb_dept AS e ON a.id_dept = e.id_dept LEFT OUTER JOIN 
						tb_tt AS t ON t.id_tt = a.id_tt
						";
	var $fieldQuery="
						b.ava_user as ava, 
						a.nm_emp as name, 
						a.nik_emp as nik, 
						d.desc_div,
						e.nm_dept,
						a.title_emp as title,
						about_emp as lvl,
						a.pos_emp,
						a.site_emp,
						a.stw_emp,
						a.enw_emp,
						c.nm_loc as loc, 
						a.sex_emp as sex, 
						a.bp_emp,
						DATE_FORMAT(a.bd_emp,'%d %b, %Y') as bd,
						YEAR(CURDATE()) - YEAR(a.bd_emp) as age,
						a.phone_emp as phone, 
						a.ktp_emp, 
						a.kk_emp, 
						a.sn_emp, 
						a.address_emp, 
						a.marst_emp, 
						a.rel_emp, 
						a.eth_emp, 
						a.edu_emp, 
						a.maj_emp, 
						a.uni_emp, 
						a.blood_emp, 
						a.sim_emp, 
						a.passport_emp, 
						a.npwp_emp, 
						a.bpjs_emp, 
						a.kpj_emp, 
						a.email_emp as email, 
						a.emailwork_emp as emailwork, 
						a.bank_emp, 
						a.bankbranch_emp, 
						a.bankacc_emp, 
						a.ecn_emp, 
						a.father_emp, 
						a.mother_emp, 
						a.spouse_emp, 
						a.numchild_emp, 
						a.numsibling_emp, 
						a.workday_emp, 
						a.worktime_emp, 
						a.efin_emp,
						s.nm_st_emp,
						a.acno_emp,
						t.nm_tt,
						a.notes_emp,
						a.show_emp as pinned,
						f.nm_acc,
						a.code_user as code,
						a.id_div,
						a.id_loc,
						b.nm_user,
						a.nicknm_emp as nick,
						a.id_emp as id
						"; //leave blank to show all field
						
	var $primaryKey="code";
	var $detKey="nik";
	var $updateKey="a.code_user";
	
	//auto generate id
	var $defaultId="E00001";
	var $prefix="E";
	var $suffix="00001";	
	
	//view
	var $viewFormTitle="Employee List";
	var $viewFormTableHeader=array(
									"Photo",
									"Name",
									"NIK",
									"Division",
									"Department",
									"Job Level",
									"Job Grade",
									"Position",
									"Site",
									"Start Working",
									"Resign Date",
									"Workplace",
									"Sex",
									"Birthplace",
									"Birthdate",
									"Age",
									"Phone",
									"KTP",
									"KK",
									"Surat Nikah",
									"Permanent Address",
									"Marital Status",
									"Religion",
									"Ethnicity",
									"Education",
									"Major",
									"University",
									"Blood Type",
									"Driving License",
									"Passport",
									"Tax Number",
									"BPJS",
									"KJS",
									"E-Mail",
									"Work E-Mail",
									"Bank",
									"Bank Branch",
									"Bank Account",
									"Emergency Number",
									"Father's Name",
									"Mother's Name",
									"Spouse's Name",
									"Number of Child",
									"Number of Sibling",
									"Workday",
									"Worktime",
									"EFIN",
									"Status",
									"Ac No",
									"Time Table",
									"Active",
									"Pinned?",
									"Access"
									);
	
	//save
	var $saveFormTitle="Add New Employee";
	var $saveFormTableHeader=array(
									"Photo",
									"Name",
									"Nick Name",
									"Alt. Name",
									"Title",
									"NIK",
									"Division",
									"Department",
									"Job Level",
									"Job Grade",
									"Position",
									"Site",
									"Start Working",
									"Resign Date",
									"Workplace",
									"Sex",
									"Birthplace",
									"Birthdate",
									"Phone",
									"KTP",
									"KK",
									"Surat Nikah",
									"Permanent Address",
									"Marital Status",
									"Religion",
									"Ethnicity",
									"Education",
									"Major",
									"University",
									"Blood Type",
									"Driving License",
									"Passport",
									"Tax Number",
									"BPJS",
									"KJS",
									"E-Mail",
									"Work E-Mail",
									"Bank",
									"Bank Branch",
									"Bank Account",
									"Emergency Number",
									"Father's Name",
									"Mother's Name",
									"Spouse's Name",
									"Number of Child",
									"Number of Sibling",
									"Workday",
									"Worktime",
									"EFIN",
									"Status",
									"Ac No",
									"Time Table",
									"Notes",									
									"User ID",
									"Username",
									"Password",
									"Re-type Password",
									"Access Right"
									);
	
	//update
	var $editFormTitle="Edit User Data";
	
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
		$selfDept=$this->Mmain->qRead("tb_emp WHERE id_emp='".$this->session->userdata('idEmp')."'","id_div,id_loc","")->row();
		
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
			
			
		
		//init view
		$output['formAccess']=$access;
		
		$renderTemp=$this->Mmain->qRead($this->tableQuery.$this->ordQuery,$this->fieldQuery,"");
		foreach($renderTemp->result() as $row)
		{
			
			$row->ava="
				<a data-toggle='modal' data-target='#employee-detail' title='Show Detail' href='#' name='".$row->id."' class='employeeDetailBtn'>
				<img src='".base_url()."/assets/admin/img/avatar/thumb/".$row->ava."' height='auto' width='100px' class='center-block img-user-ava' data-toggle='tooltip' data-placement='right' title='".$row->nm_user."'>
				</a>
				";
			/*
			if($access->acc1==1)
			{
				$row->ava="
				<a data-toggle='modal' data-target='#employee-detail' title='Show Detail' href='#' name='".$row->id."' class='employeeDetailBtn'>
				<img src='".base_url()."/assets/admin/img/avatar/thumb/".$row->ava."' height='auto' width='100px' class='center-block' data-toggle='tooltip' data-placement='right' title='".$row->nm_user."'>
				</a>
				";
			
			}
			else
			{
				if($row->id_div==$selfDept->id_div || $row->id_loc==$selfDept->id_loc)
				{
					$row->ava="
					
					<a data-toggle='modal' data-target='#employee-detail' title='Show Detail' href='#' name='".$row->id."' class='employeeDetailBtn'>
					<img src='".base_url()."/assets/admin/img/avatar/thumb/".$row->ava."' height='auto' width='100px' class='center-block' data-toggle='tooltip' data-placement='right' title='".$row->nm_user."'>
						</a>";
			
				}
				else
				{	
					$row->ava="
					
					<a data-toggle='modal' data-target='#employee-detail' title='Show Detail' href='#' name='".$row->id."' class='employeeDetailBtn'>
					<img src='".base_url()."/assets/admin/img/avatar/thumb/logo.png' height='auto' width='100px' class='center-block' data-toggle='tooltip' data-placement='right' title='Cannot see picture'>	
					</a>";
				}
			}
			*/
			
			if($row->sex=='Male')
			{
				$row->sex="<span class='label label-primary'><i class='fa fa-mars'></i>&nbsp; Male</span>";	
			}	
			else
			{
				$row->sex="<span class='label label-success'><i class='fa fa-venus'></i>&nbsp; Female</span>";					
			}
			
			
			$row->name = $row->pinned == 0 ? "<strike class='text-red' title='Inactive'>".$row->name."</strike>" : $row->name;
			if($row->lvl <> 0)
				$row->lvl ="<img title='Level ".$row->lvl." ' src='".base_url()."assets/admin/img/badge".$row->lvl.".png' width=25px>";
			
			$row->pinned = $row->pinned == 0 ? "<a href='".site_url()."/Users/Pin/".$row->id."/1' class='' title='Activate Employee'>Activate</a>" : "<a href='".site_url()."/Users/Pin/".$row->id."/0' class='' title='Deactivate Employee'>Deactivate</a>";
			
		}
		$output['render']=$renderTemp;
		//init view
		$output['pageTitle']=$this->viewFormTitle;
		$output['breadcrumbTitle']=$this->breadcrumbTitle;
		$output['breadcrumbLink']=$this->viewLink;
		$output['saveLink']=$this->viewLink."/add";
		$output['deleteLink']=$this->viewLink."/delete";
		$output['primaryKey']=$this->primaryKey;
		$output['detKey']=$this->detKey;
		$output['tableHeader']=$this->viewFormTableHeader;
		$output['dtcustom']="datatableemp";
		
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
			$this->fieldQuery="
						a.id_emp as id,
						a.nm_emp as name, 
						a.nicknm_emp as nick,
						a.altnm_emp as altname,
						a.hon_emp as honorific,
						a.nik_emp as nik, 
						d.desc_div,
						e.nm_dept,
						about_emp as lvl,
						a.title_emp as title,
						a.pos_emp,
						a.site_emp,
						a.stw_emp,
						a.enw_emp,
						c.nm_loc as loc, 
						a.sex_emp as sex, 
						a.bp_emp,
						a.bd_emp as bd,
						a.phone_emp as phone, 
						a.ktp_emp, 
						a.kk_emp, 
						a.sn_emp, 
						a.address_emp, 
						a.marst_emp, 
						a.rel_emp, 
						a.eth_emp, 
						a.edu_emp, 
						a.maj_emp, 
						a.uni_emp, 
						a.blood_emp, 
						a.sim_emp, 
						a.passport_emp, 
						a.npwp_emp, 
						a.bpjs_emp, 
						a.kpj_emp, 
						a.email_emp as email, 
						a.emailwork_emp as emailwork, 
						a.bank_emp, 
						a.bankbranch_emp, 
						a.bankacc_emp, 
						a.ecn_emp, 
						a.father_emp, 
						a.mother_emp, 
						a.spouse_emp, 
						a.numchild_emp, 
						a.numsibling_emp, 
						a.workday_emp, 
						a.worktime_emp, 
						a.efin_emp,
						s.nm_st_emp,
						a.acno_emp,
						t.nm_tt,
						a.notes_emp,
						a.show_emp as pinned,	
						a.code_user as code,
						b.nm_user,
						0 as pwd,
						0 as retypePwd,
						f.nm_acc,
						b.ava_user as ava
						";
			$render=$this->Mmain->qRead($this->tableQuery,$this->fieldQuery," a.code_user = '".$isEdit."'");
			foreach($render->result() as $row)
			{
				foreach($row as $col)
				{
					$txtVal[]= $col;
				}
			}
			
				
				
				$imgTemp="<h5><i>Click browse to change image</i></h5>
							<img src='".base_url()."/assets/admin/img/avatar/thumb/".$txtVal[59]."' height='200px' width='auto' >
							<input type='hidden' name='txtimg' value='".$txtVal[59]."'>";
				//$codeTemp="<input type='hidden' name='txtuser' value='".$txtVal[26]."'>";
				$isRo="readonly";
				//$cboacc = "<input type='text' class='form-control' id='txtUserAcc' name=txtUser[] value='".$txtVal[58]."' readonly>";
		}
		else
		{	
				for($i=0;$i<count($this->saveFormTableHeader);$i++)
				{
					$txtVal[]="";//$this->saveFormTableHeader[$i];
				}	
				
				//generate id
				$txtVal[0]=$this->Mmain->autoId($this->mainTable,"id_emp",$this->prefix,$this->defaultId,$this->suffix);	
				$txtVal[51]=$this->Mmain->autoId("tb_user","code_user","USR","USR00001","00001");
				$txtVal[58]="";
	
		}
		
		$cboacc=$this->fn->createCbofromDb("tb_acc","id_acc as id,nm_acc as nm","",$txtVal[58],"","txtUser[]");
		$cboloc=$this->fn->createCbofromDb("tb_loc","id_loc as id,nm_loc as nm","",$txtVal[14]);
		$cbott=$this->fn->createCbofromDb("tb_tt","id_tt as id,nm_tt as nm","","",$txtVal[51]);
		$cbodiv=$this->fn->createCbofromDb("tb_div","id_div as id,desc_div as nm","",$txtVal[6]);
		$cbodept=$this->fn->createCbofromDb("tb_dept","id_dept as id,nm_dept as nm","",$txtVal[7]);
		$cbosex=$this->fn->createCbo(array(1,0),array("Male","Female"),$txtVal[15]);
		$cbopin=$this->fn->createCbo(array(1,0),array("Yes","No"),$txtVal[50]);
		$cbostat=$this->fn->createCbofromDb("tb_st_emp","id_st_emp as id,nm_st_emp as nm","",$txtVal[48]);
		$cboMaritalStatus=$this->fn->createCbo(array('Married','Single','Widow/Widower'),array('Married','Single','Widow/Widower'),$txtVal[23]);
		$cboReligion=$this->fn->createCbo(array('Islam','Katolik','Kristen','Hindu','Budha','Konghucu','-'),array('Islam','Katolik','Kristen','Hindu','Budha','Konghucu','-'),$txtVal[24]);
		$cboBlood=$this->fn->createCbo(array('A','B','O','AB','-'),array('A','B','O','AB','-'),$txtVal[29]);
		
		$cboLevel=$this->fn->createCbofromDb("tb_level","id_level as id,nm_level as nm","",$txtVal[8]);
		
		$output['formTxt']=array(
								$imgTemp.
								"<input type='file' class='form-control fileupload' id='txtid23' name=txtfl >".
								$codeTemp,
								"<input type='hidden' class='form-control' id='txtid0' name=txt[] value='".$txtVal[0]."' readonly>".
								"<input type='text' class='form-control' id='txtEmpName' name=txt[] value='".$txtVal[1]."' required>",
								"<input type='text' class='form-control' id='txtEmpNickName' name=txt[] value='".$txtVal[2]."' required>",
								"<input type='text' class='form-control' id='txtEmpAltName' name=txt[] value='".$txtVal[3]."' required>",
								"<input type='text' class='form-control' id='txtEmpHonoric' name=txt[] value='".$txtVal[4]."' required>",
								"<input type='text' class='form-control' id='txtEmpNik' name=txt[] value='".$txtVal[5]."' required>",
								$cbodiv,
								$cbodept,
								$cboLevel,
								"<input type='text' class='form-control' id='txtEmpTitle' name=txt[] value='".$txtVal[9]."' >",
								"<input type='text' class='form-control' id='txtEmpPosition' name=txt[] value='".$txtVal[10]."' >",
								"<input type='text' class='form-control' id='txtEmpSite' name=txt[] value='".$txtVal[11]."' >",
								"<input type='text' class='form-control dtp' data-date-format='yyyy-mm-dd' id='txtid13' name=txt[] value='".$txtVal[12]."' readonly>",
								"<input type='text' class='form-control ' id='txtid13' name=txt[] value='".$txtVal[13]."' readonly placeholder='-'>",
								$cboloc,
								$cbosex,
								"<input type='text' class='form-control' id='txtEmpBirthPlace' name=txt[] value='".$txtVal[16]."' >",
								"<input type='text' class='form-control dtp' data-date-format='yyyy-mm-dd' id='txtEmpBirthDate' name=txt[] value='".$txtVal[17]."' readonly>",
								"<input type='text' class='form-control' id='txtEmpPhone' name=txt[] value='".$txtVal[18]."' required>",
								"<input type='text' class='form-control' id='txtEmpKtp' name=txt[] value='".$txtVal[19]."' required>",
								"<input type='text' class='form-control' id='txtEmpKK' name=txt[] value='".$txtVal[20]."' required>",
								"<input type='text' class='form-control' id='txtEmpSuratNikah' name=txt[] value='".$txtVal[21]."' required>",
								"<textarea class='form-control' id='txtEmpAddress' name=txt[]>".$txtVal[22]."</textarea>",
								$cboMaritalStatus,
								$cboReligion,
								"<input type='text' class='form-control' id='txtEmpEthnicity' name=txt[] value='".$txtVal[25]."' >",
								"<input type='text' class='form-control' id='txtEmpEducation' name=txt[] value='".$txtVal[26]."' >",
								"<input type='text' class='form-control' id='txtEmpMajor' name=txt[] value='".$txtVal[27]."' >",
								"<input type='text' class='form-control' id='txtEmpUniversity' name=txt[] value='".$txtVal[28]."' >",
								$cboBlood,
								"<input type='text' class='form-control' id='txtEmpDrivingLicense' name=txt[] value='".$txtVal[30]."' >",
								"<input type='text' class='form-control' id='txtEmpPassport' name=txt[] value='".$txtVal[31]."' >",
								"<input type='text' class='form-control' id='txtEmpTaxNumber' name=txt[] value='".$txtVal[32]."' >",
								"<input type='text' class='form-control' id='txtEmpBpjs' name=txt[] value='".$txtVal[33]."' >",
								"<input type='text' class='form-control' id='txtEmpKjs' name=txt[] value='".$txtVal[34]."' >",
								"<input type='email' class='form-control' id='txtEmpEmail' name=txt[] value='".$txtVal[35]."' >",
								"<input type='email' class='form-control' id='txtEmpWorkEmail' name=txt[] value='".$txtVal[36]."' >",
								"<input type='text' class='form-control' id='txtEmpBank' name=txt[] value='".$txtVal[37]."' >",
								"<input type='text' class='form-control' id='txtEmpBankBranch' name=txt[] value='".$txtVal[38]."' >",
								"<input type='text' class='form-control' id='txtEmpBankAccount' name=txt[] value='".$txtVal[39]."' >",
								"<input type='text' class='form-control' id='txtEmpECN' name=txt[] value='".$txtVal[40]."' >",
								"<input type='text' class='form-control' id='txtEmpMother' name=txt[] value='".$txtVal[41]."' >",
								"<input type='text' class='form-control' id='txtEmpFather' name=txt[] value='".$txtVal[42]."' >",
								"<input type='text' class='form-control' id='txtEmpSpouse' name=txt[] value='".$txtVal[43]."' >",
								"<input type='text' class='form-control' id='txtEmpNumberofChild' name=txt[] value='".$txtVal[44]."' >",
								"<input type='text' class='form-control' id='txtEmpNumberofSibling' name=txt[] value='".$txtVal[45]."' >",
								"<input type='text' class='form-control' id='txtEmpWorkday' name=txt[] value='".$txtVal[46]."' >",
								"<input type='text' class='form-control' id='txtEmpWorkTime' name=txt[] value='".$txtVal[47]."' >",
								"<input type='text' class='form-control' id='txtEmpEfin' name=txt[] value='".$txtVal[48]."' >",
								$cbostat,
								"<input type='text' class='form-control' id='txtEmpAcno' name=txt[] value='".$txtVal[50]."' >",
								$cbott,
								"<textarea class='form-control' id='txtEmpNotes' name=txt[]>".$txtVal[52]."</textarea>".
								"<input type='hidden' class='form-control' id='txtEmpActive' name=txt[] value='".$txtVal[53]."' >",	
								"<input type='text' class='form-control' id='txtUserCode' name=txtUser[] value='".$txtVal[54]."' readonly>",	
								"<input type='text' class='form-control' id='txtUserName' name=txtUser[] value='".$txtVal[55]."' required >",	
								"<input type='password' class='form-control' id='txtUserPassword' name=txtUser[] value='".$txtVal[56]."' required $isRo>",
								"<input type='password' class='form-control' id='txtUserRetypePassword' name=dummy value='".$txtVal[57]."' required  data-match='#txtUserPassword' data-match-error='Re-typed password mismatch' $isRo>",
								$cboacc,
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
		$savValUserTemp=$this->input->post('txtUser');
		
		//save to database
		$this->load->database();
		$this->load->model('Mmain');
		$avauser="";
		if(!empty($_FILES['txtfl']['name']))
		{
			$flName=$_FILES['txtfl']['name'];
			$flTmp=$_FILES['txtfl']['tmp_name'];
			$fltype=$_FILES['txtfl']['type'];
			move_uploaded_file($flTmp,"assets/admin/img/avatar/thumb/".$flName);
			$avauser=$flName;
		}
		else
		{
			$avauser="def.jpg";
		}
		
		//echo $avauser;
		$options = [
			'cost' => 11
		];
		
		$savValUserTemp[2]=password_hash("$savValTemp[2]", PASSWORD_BCRYPT, $options);
		
		//echo implode("<br>",$savValTemp);
		
		$savValUserTemp[0]=$this->Mmain->autoId("tb_user","code_user","USR","USR00001","00001");	
		$savValUserTemp[] = $avauser;
		$savValUserTemp[] = date("Y-m-d");
		$savValUserTemp[] = 0;
		$savValUserTemp[] = 0;
		
							
		//echo "<br><br>";	
		
		$this->Mmain->qIns("tb_user",$savValUserTemp);
		
		$savValTemp[0]=$this->Mmain->autoId($this->mainTable,"id_emp",$this->prefix,$this->defaultId,$this->suffix);	
		$savValTemp[] = $savValUserTemp[0];
		
		//foreach($savValTemp as $i => $row) echo ($i+1)." ".$row."<br>";
		//foreach($savValUserTemp as $i => $row) echo ($i+1)." ".$row."<br>";
		//echo implode("<br>",$savValTemp)."<br>";
		//echo implode("<br>",$savValTemp);
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
		$this->Mmain->qDel("tb_user",$this->mainPk,$valId);
		
		$this->session->set_flashdata('successNotification', '3');
		//redirect to form
		redirect($this->viewLink,'refresh');		
	}
	
	//update record
	public function update()
	{
		//retrieve values
		$savValTemp=$this->input->post('txt');
		$savValUserTemp=$this->input->post('txtUser');
		
		//save to database
		$this->load->database();
		$this->load->model('Mmain');
		$avauser="";
		if(!empty($_FILES['txtfl']['name']))
		{
			$flName=$_FILES['txtfl']['name'];
			$flTmp=$_FILES['txtfl']['tmp_name'];
			$fltype=$_FILES['txtfl']['type'];
			move_uploaded_file($flTmp,"assets/admin/img/avatar/thumb/".$flName);
			$avauser=$flName;
		}
		else
		{
			$avauser=$this->input->post('txtimg');
		}
		
		
		
		
		$savValTemp[] = $savValUserTemp[0];
		
		
		//foreach($savValTemp as $i => $row) echo ($i+1)." ".$row."<br>";
		//foreach($savValUserTemp as $i => $row) echo ($i+1)." ".$row."<br>";
		
		$this->Mmain->qUpd("tb_emp","id_emp",$savValTemp[0],$savValTemp);
		
		
		$this->Mmain->qUpdpart("tb_user","code_user",$savValUserTemp[0],Array("ava_user","id_acc","nm_user"),Array($avauser,$savValUserTemp[3],$savValUserTemp[1]));
		
		$this->session->set_flashdata('successNotification', '2');
		//redirect to form
		redirect($this->viewLink,'refresh');		
	}
	
	
	//update record
	public function Pin($id,$stat)
	{
		//retrieve values
		
		
		//save to database
		$this->load->database();
		$this->load->model('Mmain');
		$this->Mmain->qUpdpart($this->mainTable,"id_emp",$id,Array("show_emp"),Array($stat));
		
		//redirect to form
		redirect($this->viewLink,'refresh');		
	}	
	
	public function edit($id)
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
			
			$output['pageTitle']=$this->editFormTitle;
			$output['saveLink']=$this->viewLink."/update";
			$pid=$isEdit;
			$this->fieldQuery="
						a.id_emp as id, 
						b.nm_user as username,
						a.nm_emp as name, 
						c.nm_loc as loc, 
						a.nik_emp as nik, 
						CASE WHEN a.sex_emp =1 THEN 'Male' ELSE 'Female' END AS 'sex', 
						a.address_emp as address, 
						a.email_emp as email, 
						a.phone_emp as phone, 
						a.title_emp as title, 
						a.about_emp as about, 
						a.bd_emp, 
						d.desc_div, 
						e.desc_dept, 
						a.facebook_emp, 
						a.linkedin_emp, 
						a.twitter_emp, 
						a.gplus_emp, 
						a.show_emp as pinned,
						CASE WHEN a.id_st_emp=0 THEN 'Inactive' ELSE 'Active' END AS st,
						b.ava_user as ava,
						a.code_user 
						";
			$render=$this->Mmain->qRead($this->tableQuery,$this->fieldQuery," a.code_user = '".$id."'");
			foreach($render->result() as $row)
			{
				foreach($row as $col)
				{
					$txtVal[]= $col;
				}
			}
			
				
				$cboloc=$this->fn->createCbofromDb("tb_loc","id_loc as id,nm_loc as nm","",$txtVal[6]);
				$cbodept=$this->fn->createCbofromDb("tb_dept","id_dept as id,desc_dept as nm","",$txtVal[16]);
				$cbodiv=$this->fn->createCbofromDb("tb_div","id_div as id,desc_div as nm","",$txtVal[15]);
				$cboacc=$this->fn->createCbofromDb("tb_acc","id_acc as id,nm_acc as nm","",$txtVal[4]);
				$cbosex=$this->fn->createCbo(array(1,0),array("Male","Female"),$txtVal[8]);
				$cbopin=$this->fn->createCbo(array(1,0),array("Yes","No"),$txtVal[6]);
				$cbostat=$this->fn->createCbo(array(1,0),array("Active","Inactive"),$txtVal[6]);
				$txtVal[2]="1";
				$txtVal[3]="1";				
				$imgTemp="<h5><i>Click browse to change image</i></h5>
							<img src='".base_url()."/assets/admin/img/avatar/thumb/".$txtVal[23]."' height='200px' width='auto' >
							<input type='hidden' name='txtimg' value='".$txtVal[23]."'>";
							$codeTemp="<input type='hidden' name='txtuser' value='".$txtVal[24]."'>";
		
		$output['formTxt']=array(
								$codeTemp."<input type='text' class='form-control' id='txtid0' name=txt[] value='".$txtVal[0]."' readonly>",
								"<input type='text' class='form-control' id='txtid1' name=txt[] value='".$txtVal[1]."' required>",
								
								"<input type='text' class='form-control' id='txtid4' name=txt[] value='".$txtVal[5]."' required>",
								$cboloc,
								"<input type='text' class='form-control' id='txtid6' name=txt[] value='".$txtVal[7]."' >",
								$cbosex,
								"<textarea class='form-control' id='txtid8' name=txt[]>".$txtVal[6]."</textarea>",
								"<input type='email' class='form-control' id='txtid9' name=txt[] value='".$txtVal[10]."' >",
								"<input type='text' class='form-control' id='txtid10' name=txt[] value='".$txtVal[11]."' >",
								"<input type='text' class='form-control' id='txtid10' name=txt[] value='".$txtVal[12]."' >",
								"<textarea class='form-control summernote' id='txtid11' name=txt[]>".$txtVal[13]."</textarea>",
								"<input type='text' class='form-control dtp' id='txtid13' name=txt[] value='".$txtVal[14]."' >",
								$cbodiv,
								$cbodept,
								"<input type='text' class='form-control' id='txtid17' name=txt[] value='".$txtVal[17]."' >",
								"<input type='text' class='form-control' id='txtid18' name=txt[] value='".$txtVal[18]."' >",
								"<input type='text' class='form-control' id='txtid19' name=txt[] value='".$txtVal[19]."' >",
								"<input type='text' class='form-control' id='txtid20' name=txt[] value='".$txtVal[20]."' >",
								$cbopin,
								$cbostat,
								$imgTemp."<input type='file' class='form-control fileupload' id='txtid23' name=txtfl >"
								);
		
		
		//load view
		$this->fn->getheader();
		$this->load->view($this->addPage,$output);
		$this->fn->getfooter();
	}	
	
	public function getEmployeeDetail($id)
	{
		
		//save to database
		$this->load->database();
		$this->load->model('Mmain');
		
		$row=$this->Mmain->qRead($this->tableQuery . " WHERE a.id_emp = '".$id."' ",$this->fieldQuery,"")->row();
		
		$returnValue ="
		<div class='card card-widget widget-user'>
						<!-- Add the bg color to the header using any of the bg-* classes -->
						<div class='widget-user-header bg-orange' >
						  <h3 class='widget-user-username'>".$row->name."</h3>
						  <h5 class='widget-user-desc'>" . $row->title . "</h5>
						  <h5 class='widget-user-desc'>" . $row->loc . "</h5>
						</div>
						<div class='widget-user-image'>
						
							<div class = 'img-circle elevation-2' style='background-image:url(".base_url()."/assets/admin/img/avatar/thumb/".$row->ava.");'>&nbsp;</div>
							
						</div>
						<div class='card-footer'>
						  <div class='row'>
							<div class='col-sm-4 border-right'>
							  <div class='description-block'>
								<h5 class='description-header'>NIK</h5>
								<span class='description-text'>" . $row->nik . "</span>
							  </div>
							  <!-- /.description-block -->
							</div>
							<!-- /.col -->
							<div class='col-sm-4 border-right'>
							  <div class='description-block'>
								<h5 class='description-header'>EMAIL</h5>
								<span class='description-text'>" . $row->email . "</span>
							  </div>
							  <!-- /.description-block -->
							</div>
							<!-- /.col -->
							<div class='col-sm-4'>
							  <div class='description-block'>
								<h5 class='description-header'>PHONE</h5>
								<span class='description-text'>" . $row->phone . "</span>
							  </div>
							  <!-- /.description-block -->
							</div>
							<!-- /.col -->
						  </div>
						  <!-- /.row -->
						</div>
					  </div>
					  
					 ";
					 
					 echo $returnValue;
	}
}

?>