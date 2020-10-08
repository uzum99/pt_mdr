<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller 
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
	
	var $mainTable="tb_frm";
	var $mainPk="code_frm";
	var $viewLink="form";
	var $viewLink2="form/det";
	var $breadcrumbTitle="Form";
	var $breadcrumbTitle2="User Access";
	var $viewPage="Admviewpage";
	var $addPage="Admaddpage";
	var $detPage="Formdetpage";
	
	//query
	var $ordQuery=" ORDER BY grp DESC, a.sort_order";
	var $tableQuery="tb_frm AS a INNER JOIN tb_frmgroup AS b ON a.id_frmgroup = b.id_frmgroup";
	var $fieldQuery=" a.code_frm as code,a.id_frm as id,a.desc_frm as nm,b.nm_frmgroup as grp, a.is_shortcut as sc, a.stat_frm as st, a.sort_order"; //leave blank to show all field
	var $primaryKey="code";
	var $updateKey="a.code_frm";
	
	//auto generate id
	var $defaultId="FR001";
	var $prefix="FR";
	var $suffix="001";	
	
	//view
	var $viewFormTitle="Form List";
	var $viewFormTableHeader=array("Form Id","File Name","Description","Form Group","Has Shortcut?","Status","Sort Order");
	
	//save
	var $saveFormTitle="Add New Form";
	var $saveFormTableHeader=array("Form Id","File Name","Description","Form Group","Has Shortcut?","Status","Sort Order");
	
	//update
	var $editFormTitle="Update Form Data";
	
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
		
		//$output['isall']=$access->isadd;
		$accessQuery="";
		if($access->acc1<>1)
			$accessQuery="WHERE b.code_user ='".$this->session->userdata['codeUser']."'";
			
			
		
		//init view
		$renderTemp=$this->Mmain->qRead($this->tableQuery.$this->ordQuery,$this->fieldQuery,"");
		foreach($renderTemp->result() as $row)
		{
			
			if($row->sc==0)
			{				
				if($access->acc1<>1)
				{
					$row->sc="<span class='label label-primary'>Tidak</span>";	
				}
				else
				{	
					$row->sc="<a href='".site_url()."Form/Setshortcut/".$row->code."/1' title='Tambah ke shortcut'><button class='btn btn-primary '>Tambah shortcut</button></a>";						
				}
			
			}				
			elseif($row->sc==1)
			{		
				if($access->acc1<>1)
				{
					$row->sc="<span class='label label-success' >Ya</span>";		
				}
				else
				{
					$row->sc="<a href='".site_url()."Form/Setshortcut/".$row->code."/0' title='Hapus dari shortcut'><button class='btn btn-warning '>Hapus Shortcut</button></a>";							
				}
			}	
			
			if($row->st==0)
			{				
				if($access->acc1<>1)
				{
					$row->st="<span class='label label-primary'>Nonaktif</span>";	
				}
				else
				{	
					$row->st="<a href='".site_url()."Form/Activate/".$row->code."/1' title='Aktifkan Sponsor'><button class='btn btn-primary '>Aktifkan</button></a>";						
				}
			
			}				
			elseif($row->st==1)
			{		
				if($access->acc1<>1)
				{
					$row->st="<span class='label label-success' >Aktif</span>";		
				}
				else
				{
					$row->st="<a href='".site_url()."Form/Activate/".$row->code."/0' title='Nonaktifkan Sponsor'><button class='btn btn-warning '>Nonaktifkan</button></a>";							
				}
			}	
			
			
					$row->sort_order="<span class='badge' >".	$row->sort_order."</span>";		
		}
		$output['render']=$renderTemp;
		
		
		//init view
		$output['formAccess']=$access;
		$output['pageTitle']=$this->viewFormTitle;
		$output['breadcrumbTitle']=$this->breadcrumbTitle;
		$output['breadcrumbLink']=$this->viewLink;
		$output['saveLink']=$this->viewLink."/add";
		$output['deleteLink']=$this->viewLink."/delete";
		$output['primaryKey']=$this->primaryKey;
		$output['tableHeader']=$this->viewFormTableHeader;
		
		//render view
		$this->fn->getheader();
		$this->load->view($this->viewPage,$output);
		$this->fn->getfooter();
	}
	
	
	public function det($frmid="")
	{
		//init modal
		$this->load->database();
		$this->load->model('Mmain');
		$output['render']=$this->Mmain->qRead(
		"tb_accfrm AS uf 
		INNER JOIN tb_user AS u on uf.id_acc = u.id_acc
		INNER JOIN tb_emp AS e on e.code_user = u.code_user 
		INNER JOIN tb_frm AS f on uf.code_frm = f.code_frm
		 ",
		"uf.id_userfrm as id,e.nm_emp as names,f.desc_frm as forms,uf.is_add as adds,uf.is_edt as upds,uf.is_del as dels,uf.is_spec1 as sp1,uf.is_spec2 as sp2",
		""
		);
		
		//init view
		$output['pageTitle']="User Access";
		$output['breadcrumbTitle']=$this->breadcrumbTitle;
		$output['breadcrumbLink']=$this->viewLink;
		$output['breadcrumbTitle2']=$this->breadcrumbTitle2;
		$output['breadcrumbLink2']=$this->viewLink2."/".$frmid;
		$output['saveLink']=$this->viewLink."/addaccess";
		$output['deleteLink']=$this->viewLink."/deleteaccess";
		$output['primaryKey']="";
		$output['tableHeader']=array("Per Id","User","Form","Add permission","Edit permission","Delete permission","SP1 permission","SP2 permission");
		
		
		//render view
		$this->fn->getheader();
		$this->load->view($this->detPage,$output);
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
		$output['tableHeader']=$this->viewFormTableHeader;
		$output['formLabel']=$this->viewFormTableHeader;
		if(!empty($isEdit))
		{
			
			$output['pageTitle']=$this->editFormTitle;
			$output['saveLink']=$this->viewLink."/update";
			$pid=$isEdit;
			$this->fieldQuery=" 
								a.code_frm as code,
								a.id_frm as id,
								a.desc_frm as nm,
								b.nm_frmgroup as grp, 
								CASE 
								WHEN a.is_shortcut = 1 THEN 'Yes' 
								ELSE 'No' 
								END as sc,
								CASE 
								WHEN a.stat_frm = 1 THEN 'Active' 
								ELSE 'Inactive' 
								END as st,
								a.sort_order
								"; //leave blank to show all field

			$render=$this->Mmain->qRead($this->tableQuery,$this->fieldQuery," ".$this->updateKey." = '".$pid."'");
			foreach($render->result() as $row)
			{
				foreach($row as $col)
				{
					$txtVal[]= $col;
				}
			}
			
			$cbogroup=$this->fn->createCbofromDb("tb_frmgroup","id_frmgroup as id,nm_frmgroup as nm","",$txtVal[3]);
			$cbostat=$this->fn->createCbo(array(1,0),array("Active","Inactive"),$txtVal[5]);
			$cboshortcut=$this->fn->createCbo(array(1,0),array("Yes","No"),$txtVal[4]);
		}
		else
		{	
				for($i=0;$i<count($this->saveFormTableHeader);$i++)
				{
					$txtVal[]="";
				}	
				
				//generate id
				$newId=$this->Mmain->autoId($this->mainTable,$this->mainPk,$this->prefix,$this->defaultId,$this->suffix);	
				$txtVal[0]=$newId;
				
				$cbogroup=$this->fn->createCbofromDb("tb_frmgroup","id_frmgroup as id,nm_frmgroup as nm","","");
				$cbostat=$this->fn->createCbo(array(1,0),array("Active","Inactive"),"");
				$cboshortcut=$this->fn->createCbo(array(0,1),array("No","Yes"),"");
		}
		$output['formTxt']=array(
								"<input type='text' class='form-control' id='txtid0' name=txt[] value='".$txtVal[0]."' readonly>",
								"<input type='text' class='form-control' id='txtid1' name=txt[] value='".$txtVal[1]."' required>",
								"<input type='text' class='form-control' id='txtid2' name=txt[] value='".$txtVal[2]."' required>",
								$cbogroup,
								$cboshortcut,
								$cbostat,
								"<input type='text' class='form-control' id='txtid2' name=txt[] value='".$txtVal[6]."' required>"
								
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
		$this->Mmain->qDel("tb_accfrm",$this->mainPk,$valId);
		
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
		//echo implode("<br>",$savValTemp);
		$this->Mmain->qUpd($this->mainTable,$this->mainPk,$savValTemp[0],$savValTemp);
		
		$this->session->set_flashdata('successNotification', '2');
		//redirect to form
		redirect($this->viewLink,'refresh');		
	}
	
	
	public function addaccess($isEdit="",$frmcode="")
	{
		//init modal
		$this->load->database();
		$this->load->model('Mmain');
		
		
		//init view
		$output['pageTitle']="Add Form Access";
		$output['breadcrumbTitle']=$this->breadcrumbTitle;
		$output['breadcrumbLink']=$this->viewLink;
		$output['saveLink']=$this->viewLink."/saveaccess";
		$output['tableHeader']=array("User","Form","Add permission","Edit permission","Delete permission","SP1 permission","SP2 permission");
		$output['formLabel']=array("User","Form","Add permission","Edit permission","Delete permission","SP1 permission","SP2 permission");
		if(!empty($isEdit))
		{
			
			$output['pageTitle']=$this->editFormTitle;
			$output['saveLink']=$this->viewLink."/Updateaccess";
			$pid=$isEdit;
			$render=$this->Mmain->qRead(
							"tb_accfrm AS uf 
							INNER JOIN tb_user AS u on uf.id_acc = u.id_acc
							INNER JOIN tb_emp AS e on e.code_user = u.code_user 
							INNER JOIN tb_frm AS f on uf.code_frm = f.code_frm
							WHERE uf.id_userfrm ='".$pid."' ",
							"uf.id_userfrm as id,
							e.nm_emp as names,
							f.desc_frm as forms,
							CASE WHEN uf.is_add = 1 THEN 'Grant' ELSE 'Deny' END as adds,
							CASE WHEN uf.is_edt = 1 THEN 'Grant' ELSE 'Deny' END  as upds,
							CASE WHEN uf.is_del = 1 THEN 'Grant' ELSE 'Deny' END  as dels,
							CASE WHEN uf.is_spec1 = 1 THEN 'Grant' ELSE 'Deny' END  as sp1,
							CASE WHEN uf.is_spec2 = 1 THEN 'Grant' ELSE 'Deny' END  as sp2,
							u.code_user as cuser,
							uf.code_frm as cfrm",
							""
			);

			foreach($render->result() as $row)
			{
				foreach($row as $col)
				{
					$txtVal[]= $col;
				}
			}
			
			//$cbogroup=$this->fn->createCbofromDb("tb_frmgroup","id_frmgroup as id,nm_frmgroup as nm","",$txtVal[2]);
		
				$cbouser="	<input type='hidden' class='form-control' name=txt[] value='".$txtVal[0]."'>
							<input type='text' class='form-control' id='txtid0' name=nama value='".$txtVal[1]."' readonly>
							<input type='hidden' class='form-control' name=txt[] value='".$txtVal[8]."'>
				";
				$cboform="<input type='text' class='form-control' id='txtid1' name=form value='".$txtVal[2]."' readonly>
							<input type='hidden' class='form-control' name=txt[] value='".$txtVal[9]."'>";
				$cbo1=$this->fn->createCbo(array(1,0),array("Grant","Deny"),$txtVal[3]);
				$cbo2=$this->fn->createCbo(array(1,0),array("Grant","Deny"),$txtVal[4]);
				$cbo3=$this->fn->createCbo(array(1,0),array("Grant","Deny"),$txtVal[5]);
				$cbo4=$this->fn->createCbo(array(1,0),array("Grant","Deny"),$txtVal[6]);
				$cbo5=$this->fn->createCbo(array(1,0),array("Grant","Deny"),$txtVal[7]);
		}
		else
		{	
				for($i=0;$i<count($this->saveFormTableHeader);$i++)
				{
					$txtVal[]="";
				}	
				
				//generate id
				$newId=$this->Mmain->autoId($this->mainTable,$this->mainPk,$this->prefix,$this->defaultId,$this->suffix);	
				$txtVal[0]=$newId;
				
				$cbouser=$this->fn->createMulCbofromDb("tb_acc ","id_acc as id,nm_acc as nm","","","cbouser[]");
				$cboform=$this->fn->createMulCbofromDb("tb_frm","code_frm as id,desc_frm as nm","","","cbofrm[]");
				$cbo1=$this->fn->createCbo(array(1,0),array("Grant","Deny"),"");
				$cbo2=$this->fn->createCbo(array(1,0),array("Grant","Deny"),"");
				$cbo3=$this->fn->createCbo(array(1,0),array("Grant","Deny"),"");
				$cbo4=$this->fn->createCbo(array(1,0),array("Grant","Deny"),"");
				$cbo5=$this->fn->createCbo(array(1,0),array("Grant","Deny"),"");
		}
		$output['formTxt']=array(
								$cbouser,
								$cboform,
								$cbo1,
								$cbo2,
								$cbo3,
								$cbo4,
								$cbo5
								);
		
		
		//load view
		$this->fn->getheader();
		$this->load->view($this->addPage,$output);
		$this->fn->getfooter();
	}	
	
	
	public function saveaccess()
	{
		//retrieve values
		$savusrTemp=$this->input->post('cbouser');
		$savfrmTemp=$this->input->post('cbofrm');
		$savaccTemp=$this->input->post('txt');
		
		//echo implode("",$savusrTemp);
		//save to database
		$this->load->database();
		$this->load->model('Mmain');
		
		
		for($i=0;$i<count($savusrTemp);$i++)
		{
			for($j=0;$j<count($savfrmTemp);$j++)
			{
			
			$newId=$this->Mmain->autoId("tb_accfrm","id_userfrm","UF","UF00001","00001");	
			$this->Mmain->qIns("tb_accfrm",array(
													$newId,
													$savusrTemp[$i],
													$savfrmTemp[$j],
													$savaccTemp[0],
													$savaccTemp[1],
													$savaccTemp[2],
													$savaccTemp[3],
													$savaccTemp[4],
			));
			
			}
		}
		$this->Mmain->qIns($this->mainTable,$savValTemp);
		
		//redirect to form
		redirect($this->viewLink,'refresh');	
		
	}
	
	
	//delete record
	public function deleteaccess($valId)
	{		
		//save to database
		$this->load->database();
		$this->load->model('Mmain');
		$this->Mmain->qDel("tb_userfrm","id_userfrm",$valId);
		
		//redirect to form
		redirect($this->viewLink,'refresh');		
	}

	
	//update record
	public function updateaccess()
	{
		//retrieve values
		$savValTemp=$this->input->post('txt');
		//save to database
		$this->load->database();
		$this->load->model('Mmain');
		$this->Mmain->qUpd("tb_userfrm","id_userfrm",$savValTemp[0],array($savValTemp[0],$savValTemp[1],$savValTemp[2],$savValTemp[3],$savValTemp[4],$savValTemp[5],$savValTemp[6],$savValTemp[7]));
		
		//redirect to form
		redirect($this->viewLink2."/$savValTemp[2]",'refresh');		
	}
	
	
	//activate
	public function Activate($id,$stat)
	{
		//retrieve values
		
		
		//save to database
		$this->load->database();
		$this->load->model('Mmain');
		$this->Mmain->qUpdpart($this->mainTable,$this->mainPk,$id,Array("stat_frm"),Array($stat));
		
		//redirect to form
		redirect($this->viewLink,'refresh');		
	}	
	
	//activate
	public function Setshortcut($id,$stat)
	{
		//retrieve values
		
		
		//save to database
		$this->load->database();
		$this->load->model('Mmain');
		$this->Mmain->qUpdpart($this->mainTable,$this->mainPk,$id,Array("is_shortcut"),Array($stat));
		
		//redirect to form
		redirect($this->viewLink,'refresh');		
	}	
	
}

?>