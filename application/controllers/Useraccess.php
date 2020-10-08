<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Useraccess extends CI_Controller 
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
	
	var $mainTable="tb_accfrm";
	var $mainPk="id_userfrm";
	var $viewLink="Useraccess";
	var $breadcrumbTitle="User access";
	var $viewPage="Admviewpage";
	var $addPage="Admaddpage";
	
	//query
	var $ordQuery=" ";
	var $tableQuery="tb_accfrm AS a 
						INNER JOIN tb_acc AS b ON a.id_acc = b.id_acc
						INNER JOIN tb_frm AS c ON a.code_frm = c.code_frm";
	var $fieldQuery=" a.id_userfrm as code,
						b.nm_acc as nm,
						c.desc_frm as formname,
						a.is_add as isadd,
						a.is_edt as isedt,
						a.is_del as isdel,
						a.is_spec1 as issp1,
						a.is_spec2 as issp2
						"; //leave blank to show all field
	var $primaryKey="code";
	var $updateKey="a.id_userfrm";
	
	//auto generate id
	var $defaultId="UF00001";
	var $prefix="UF";
	var $suffix="00001";	
	
	//view
	var $viewUseraccessTitle="User Access";
	var $viewUseraccessTableHeader=array("Access code","User","Form","Add Access","Edit Access","Delete Access","Special #1 Access","Special #2 Access");
	
	//save
	var $saveUseraccessTitle="Add New Access";
	var $saveUseraccessTableHeader=array("User","Form","Add Access","Edit Access","Delete Access","Special #1 Access","Special #2 Access");
	
	//update
	var $editUseraccessTitle="Update Access";
	
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
		if(isset($access))
		if($access->acc1<>1)
			$accessQuery="WHERE b.code_user ='".$this->session->userdata['codeUser']."'";
		
		
		//init view
		$output['formAccess']=$access;
		$output['pageTitle']=$this->viewUseraccessTitle;
		$output['breadcrumbTitle']=$this->breadcrumbTitle;
		$output['breadcrumbLink']=$this->viewLink;
		$output['saveLink']=$this->viewLink."/add";
		$output['deleteLink']=$this->viewLink."/delete";
		$output['primaryKey']=$this->primaryKey;
		$output['tableHeader']=$this->viewUseraccessTableHeader;
		
		//check render result
		$tesrender=$this->Mmain->qRead($this->tableQuery.$this->ordQuery,$this->fieldQuery,"");
		foreach($tesrender->result() as $row)
		{
			if($row->isadd==1)		
				$row->isadd="<span class='label label-success'>Granted</span>";			
			else				
				$row->isadd="<span class='label label-danger'>Denied</span>";
			
			if($row->isedt==1)		
				$row->isedt="<span class='label label-success'>Granted</span>";			
			else				
				$row->isedt="<span class='label label-danger'>Denied</span>";
			
			if($row->isdel==1)		
				$row->isdel="<span class='label label-success'>Granted</span>";			
			else				
				$row->isdel="<span class='label label-danger'>Denied</span>";
			
			if($row->issp1==1)		
				$row->issp1="<span class='label label-success'>Granted</span>";			
			else				
				$row->issp1="<span class='label label-danger'>Denied</span>";
			
			if($row->issp2==1)		
				$row->issp2="<span class='label label-success'>Granted</span>";			
			else				
				$row->issp2="<span class='label label-danger'>Denied</span>";
			
		
		}
		$output['render']=$tesrender;
		
	
		//render view
		$this->fn->getheader();
		$this->load->view($this->viewPage,$output);
		$this->fn->getfooter();
	}
	
	public function det($accid)
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
		if(isset($access))
		if($access->acc1<>1)
			$accessQuery="WHERE b.code_user ='".$this->session->userdata['codeUser']."'";
		
		
		//init view
		$output['formAccess']=$access;
		$output['pageTitle']=$this->viewUseraccessTitle;
		$output['breadcrumbTitle']=$this->breadcrumbTitle;
		$output['breadcrumbLink']=$this->viewLink;
		$output['saveLink']=$this->viewLink."/addaccess/".$accid;
		$output['editLink']=$this->viewLink."/add";
		$output['deleteLink']=$this->viewLink."/delete";
		$output['primaryKey']=$this->primaryKey;
		$output['tableHeader']=$this->viewUseraccessTableHeader;
		
		//check render result
		$tesrender=$this->Mmain->qRead($this->tableQuery.$this->ordQuery,$this->fieldQuery," a.id_acc='".$accid."'");
		foreach($tesrender->result() as $row)
		{
			if($row->isadd==1)		
				$row->isadd="<span class='label label-success'>Granted</span>";			
			else				
				$row->isadd="<span class='label label-danger'>Denied</span>";
			
			if($row->isedt==1)		
				$row->isedt="<span class='label label-success'>Granted</span>";			
			else				
				$row->isedt="<span class='label label-danger'>Denied</span>";
			
			if($row->isdel==1)		
				$row->isdel="<span class='label label-success'>Granted</span>";			
			else				
				$row->isdel="<span class='label label-danger'>Denied</span>";
			
			if($row->issp1==1)		
				$row->issp1="<span class='label label-success'>Granted</span>";			
			else				
				$row->issp1="<span class='label label-danger'>Denied</span>";
			
			if($row->issp2==1)		
				$row->issp2="<span class='label label-success'>Granted</span>";			
			else				
				$row->issp2="<span class='label label-danger'>Denied</span>";
			
		
		}
		$output['render']=$tesrender;
		
	
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
		$output['pageTitle']=$this->saveUseraccessTitle;
		$output['breadcrumbTitle']=$this->breadcrumbTitle;
		$output['breadcrumbLink']=$this->viewLink;
		$output['saveLink']=$this->viewLink."/save";
		$output['tableHeader']=$this->saveUseraccessTableHeader;
		$output['formLabel']=$this->saveUseraccessTableHeader;
		if(!empty($isEdit))
		{
			
			$output['pageTitle']=$this->saveUseraccessTitle;
			
		$output['saveLink']=$this->viewLink."/update";
			$pid=$isEdit;
			$this->fieldQuery=" 
						b.nm_acc as nm,
						c.desc_frm as formname,
						a.is_add as isadd,
						a.is_edt as isedt,
						a.is_del as isdel,
						a.is_spec1 as issp1,
						a.is_spec2 as issp2,
						a.id_userfrm as id
						";
			$render=$this->Mmain->qRead($this->tableQuery,$this->fieldQuery,$this->updateKey." = '".$pid."'");
			foreach($render->result() as $row)
			{
				foreach($row as $col)
				{
					$txtVal[]= $col;
				}
			}
			
			$cboemployee=$this->fn->createCbofromDb("tb_acc WHERE nm_acc='".$txtVal[0]."'","id_acc as id,nm_acc as nm","",$txtVal[0],"");
			$cboform=$this->fn->createCbofromDb("tb_frm where desc_frm='".$txtVal[1]."'","code_frm as id,desc_frm  as nm","",$txtVal[1],"");
			//$cboform=$this->fn->createMulCbofromDb("tb_frm where not code_frm in (select code_frm from tb_accfrm WHERE id_acc = '".$pid."')","code_frm as id,desc_frm as nm","","","cbofrm[]");
			
				$cboadd=$this->fn->createRadio(array(1,0),array("Grant","Deny"),2,$txtVal[2]);
				$cboedt=$this->fn->createRadio(array(1,0),array("Grant","Deny"),3,$txtVal[3]);
				$cbodel=$this->fn->createRadio(array(1,0),array("Grant","Deny"),4,$txtVal[4]);
				$cbosp1=$this->fn->createRadio(array(1,0),array("Grant","Deny"),5,$txtVal[5]);
				$cbosp2=$this->fn->createRadio(array(1,0),array("Grant","Deny"),6,$txtVal[6]);
			
			$cboform="<input type='hidden' name='txtid' value='".$txtVal[7]."'>".$cboform;
		}
		else
		{	
				for($i=0;$i<count($this->saveUseraccessTableHeader);$i++)
				{
					$txtVal[]="";
				}	
				
				//generate id
				$newId=$this->Mmain->autoId($this->mainTable,$this->mainPk,$this->prefix,$this->defaultId,$this->suffix);	
				$txtVal[0]=$newId;
				
				//$cbouser=$this->fn->createMulCbofromDb("tb_emp","code_user as id,nm_emp as nm","","","cbouser[]");
				//$cboform=$this->fn->createMulCbofromDb("tb_frm","code_frm as id,desc_frm as nm","","","cbofrm[]");
				$cboemployee=$this->fn->createMulCbofromDb("tb_acc","id_acc as id,nm_acc as nm","","","cbouser[]");
				$cboform=$this->fn->createMulCbofromDb("tb_frm","code_frm as id,desc_frm as nm","","","cbofrm[]");
				
				$cboadd=$this->fn->createRadio(array(1,0),array("Grant","Deny"),2,"Deny");
				$cboedt=$this->fn->createRadio(array(1,0),array("Grant","Deny"),3,"Deny");
				$cbodel=$this->fn->createRadio(array(1,0),array("Grant","Deny"),4,"Deny");
				$cbosp1=$this->fn->createRadio(array(1,0),array("Grant","Deny"),5,"Deny");
				$cbosp2=$this->fn->createRadio(array(1,0),array("Grant","Deny"),6,"Deny");
		}
		$output['formTxt']=array(
								$cboemployee,
								$cboform,
								$cboadd,
								$cboedt,
								$cbodel,
								$cbosp1,
								$cbosp2
								);
		
		
	
		//load view
		//render view
		$this->fn->getheader();
		$this->load->view($this->addPage,$output);
		$this->fn->getfooter();
	}	
	
	
	public function addaccess($pid)
	{
		//init modal
		$this->load->database();
		$this->load->model('Mmain');
		
		
		//init view
		$output['pageTitle']=$this->saveUseraccessTitle;
		$output['breadcrumbTitle']=$this->breadcrumbTitle;
		$output['breadcrumbLink']=$this->viewLink;
		$output['saveLink']=$this->viewLink."/save";
		$output['tableHeader']=$this->saveUseraccessTableHeader;
		$output['formLabel']=$this->saveUseraccessTableHeader;
		
			
		$output['pageTitle']=$this->saveUseraccessTitle;
		
		
		$cboemployee=$this->fn->createCbofromDb("tb_acc where id_acc = '".$pid."'","id_acc as id,nm_acc as nm","",$pid,"","cbouser[]");
		$cboform=$this->fn->createMulCbofromDb("tb_frm where not code_frm in (select code_frm from tb_accfrm WHERE id_acc = '".$pid."')","code_frm as id,desc_frm as nm","","","cbofrm[]");
		
			$cboadd=$this->fn->createRadio(array(1,0),array("Grant","Deny"),2,"Deny");
			$cboedt=$this->fn->createRadio(array(1,0),array("Grant","Deny"),3,"Deny");
			$cbodel=$this->fn->createRadio(array(1,0),array("Grant","Deny"),4,"Deny");
			$cbosp1=$this->fn->createRadio(array(1,0),array("Grant","Deny"),5,"Deny");
			$cbosp2=$this->fn->createRadio(array(1,0),array("Grant","Deny"),6,"Deny");
		
		$cboform.="<input type='hidden' name='backlink' value='/det/".$pid."'>";
	
		$output['formTxt']=array(
								$cboemployee,
								$cboform,
								"<br>".$cboadd,
								"<br>".$cboedt,
								"<br>".$cbodel,
								"<br>".$cbosp1,
								"<br>".$cbosp2
								);
		
		
	
		//load view
		//render view
		$this->fn->getheader();
		$this->load->view($this->addPage,$output);
		$this->fn->getfooter();
	}	
	
	public function save()
	{
		//redirect to form//retrieve values
		$savusrTemp=$this->input->post('cbouser');
		$savfrmTemp=$this->input->post('cbofrm');
		$savaccTemp=$this->input->post('txt');
		
		//echo implode("<br>",$savaccTemp);
		
		//echo $savaccTemp1."as";
		//echo implode("",$savusrTemp);
		//echo $savusrTemp;
		//save to database
		$this->load->database();
		$this->load->model('Mmain');
		
		
		for($i=0;$i<count($savusrTemp);$i++)
		{
			for($j=0;$j<count($savfrmTemp);$j++)
			{
			
			$newId=$this->Mmain->autoId("tb_accfrm","id_userfrm","UF","UF00001","00001");	
			$savAcc=array(
													$newId,
													$savusrTemp[$i],
													$savfrmTemp[$j],
													$savaccTemp[2],
													$savaccTemp[3],
													$savaccTemp[4],
													$savaccTemp[5],
													$savaccTemp[6],
											);
			$this->Mmain->qIns("tb_accfrm",$savAcc);
			//echo implode("<br>",$savAcc);
			}
			//echo "<br>";
		}
		
		$this->session->set_flashdata('successNotification', '1');
		//$this->Mmain->qIns($this->mainTable,$savValTemp);
	
		$backlink="";
		if($this->input->post('backlink')<>"")
			$backlink=$this->input->post('backlink');
		redirect($this->viewLink.$backlink,'refresh');		
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
		
		//redirect to form//retrieve values
		$savValTemp=$this->input->post('txtid');
		$savaccTemp=$this->input->post('txt');
		//echo $this->input->post('txtid');
		//echo implode("<br>",$savaccTemp);
		
		//echo $savaccTemp1."as";
		//echo implode("",$savusrTemp);
		//save to database
		$this->load->database();
		$this->load->model('Mmain');

	
			//$this->Mmain->qIns("tb_accfrm",$savAcc);
			
			
			$this->Mmain->qUpdPart(
									$this->mainTable,
									$this->mainPk,
									$savValTemp,
									Array(
											"is_add",
											"is_edt",
											"is_del",
											"is_spec1",
											"is_spec2"
											),
									Array(
											$savaccTemp[2],
											$savaccTemp[3],
											$savaccTemp[4],
											$savaccTemp[5],
											$savaccTemp[6]
											)
									);
							
			
		//echo "<br>".implode("<br>",$savaccTemp);			
		//echo "<br>";
		
		$this->session->set_flashdata('successNotification', '1');
		//$this->Mmain->qIns($this->mainTable,$savValTemp);
		redirect($this->viewLink."/det/".$savaccTemp[0],'refresh');	
		

	}
	

	
	
}

?>