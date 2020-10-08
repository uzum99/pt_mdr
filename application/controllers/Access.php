<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Access extends CI_Controller 
{
	public function __construct()
	 {
		parent::__construct();			
		$this->load->library('Commonfunction','','fn');
		
	 }
	/*	
		====================================================== Variable Declaration =========================================================
	*/
	
	var $mainTable="tb_acc";
	var $mainPk="id_acc";
	var $viewLink="Access";
	var $breadcrumbTitle="Access Right";
	var $viewPage="Admviewpage";
	var $addPage="Admaddpage";
	
	//query
	var $tableQuery="tb_acc";
	var $fieldQuery=""; //leave blank to show all field
	var $primaryKey="id_acc";
	var $updateKey="id_acc";
	
	//auto generate id
	var $defaultId="A01";
	var $prefix="A";
	var $suffix="01";	
	
	//view
	var $viewFormTitle="Access List";
	var $viewFormTableHeader=array("Acc Id","Name","Remark","Status");
	
	//save
	var $saveFormTitle="Tambah data";
	var $saveFormTableHeader=array("Acc Id","Name","Remark","Status");
	
	//update
	var $editFormTitle="Edit Access";
	
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
		{
			$accessQuery="WHERE b.code_user ='".$this->session->userdata['codeUser']."'";
		}	
		else
		{
		
			$output['customButton'] = Array(
											(object) Array(
													'buttonTitle' => 'Clone',
													'buttonDestination' => $this->viewLink.'/Clone',
													'buttonClass' => 'btnAccessClone',
													'buttonIcon' => 'fa fa-copy',
													'textColor' => 'text-green'
													)
											);
			
		}
			
		
		//init view
		$output['formAccess']=$access;
		
		
		
		$renderTemp=$this->Mmain->qRead($this->tableQuery,$this->fieldQuery,"");
		foreach($renderTemp->result() as $row)
		{
			if($row->stat_acc==0)
			{		
				$row->stat_acc="<span class='label label-danger'>Inactive</span>";	
			}				
			elseif($row->stat_acc==1)
			{
				$row->stat_acc="<span class='label label-success'>Active</span>";	
			}		
		}
		$output['render']=$renderTemp;
		//init view
		$output['pageTitle']=$this->viewFormTitle;
		$output['breadcrumbTitle']=$this->breadcrumbTitle;
		$output['breadcrumbLink']=$this->viewLink;
		$output['saveLink']=$this->viewLink."/add";
		$output['detLink']="Useraccess/det";
		$output['deleteLink']=$this->viewLink."/delete";
		$output['primaryKey']=$this->primaryKey;
		$output['tableHeader']=$this->viewFormTableHeader;
		
	
		//render view
		$this->fn->getheader();
		$this->load->view($this->viewPage,$output);
		$this->fn->getfooter();
	}

	public function clone($id)
	{
		$this::add($id,1);
	}
	
	public function add($isEdit="",$isClone=0)
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
		
		if(!empty($isEdit))
		{
			
			$output['pageTitle']=$this->editFormTitle;
			$output['saveLink']=$this->viewLink. ($isClone == 1 ? "/saveclone" : "/update");
			$pid=$isEdit;
			$this->fieldQuery=" id_acc,
								nm_acc,
								rem_acc,
								CASE 
									WHEN stat_acc=0 THEN 'Inactive' 
									WHEN stat_acc=1 THEN 'Active' 
								END
									as st";
			$render=$this->Mmain->qRead($this->tableQuery,$this->fieldQuery," ".$this->mainPk." = '".$pid."'");
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
					$txtVal[]="";
				}	
				
				//generate id
				$txtVal[0]=$this->Mmain->autoId($this->mainTable,$this->mainPk,$this->prefix,$this->defaultId,$this->suffix);	
				
		}
		$cbostat=$this->fn->createCbo(array(1),array("Active"),$txtVal[3]);
		
		$output['formTxt']=array(
								"<input type='text' class='form-control' id='txtid0' name=txt[] value='".$txtVal[0]."' readonly>",
								"<input type='text' class='form-control' id='txtid1' name=txt[] value='".$txtVal[1]."' required>",
								"<input type='text' class='form-control' id='txtid2' name=txt[] value='".$txtVal[2]."'>",
								$cbostat
								);
		
		
		
		//render view
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
		
		//redirect to form
		redirect($this->viewLink,'refresh');		
	}
	
	
	public function saveclone()
	{
		//retrieve values
		$savValTemp=$this->input->post('txt');
		
		//save to database
		$this->load->database();
		$this->load->model('Mmain');
		
		$getCurrentAccess = $this->Mmain->qRead(" tb_accfrm WHERE id_acc ='".$savValTemp[0]."' ","","");
		
		$savValTemp[0]=$this->Mmain->autoId($this->mainTable,$this->mainPk,$this->prefix,$this->defaultId,$this->suffix);	
		
		$this->Mmain->qIns($this->mainTable,$savValTemp);
		
		foreach($getCurrentAccess->result() as $row)
		{
		$id = $this->Mmain->autoId("tb_accfrm","id_userfrm","UF","UF00001","00001");	
		$this->Mmain->qIns("tb_accfrm",Array(
												$id,
												$savValTemp[0],
												$row->code_frm,
												$row->is_add,
												$row->is_edt,
												$row->is_del,
												$row->is_spec1,
												$row->is_spec2
											));
		}
	
		
		//redirect to form
		redirect($this->viewLink,'refresh');		
	}
	
	//delete record
	public function delete($valId)
	{		
		//save to database
		$this->load->database();
		$this->load->model('Mmain');
		$this->Mmain->qDel($this->mainTable,$this->primaryKey,$valId);
		$this->Mmain->qDel("tb_accfrm","id_acc",$valId);
		
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
		$this->Mmain->qUpd($this->mainTable,$this->primaryKey,$savValTemp[0],$savValTemp);
		
		//redirect to form
		redirect($this->viewLink,'refresh');		
	}
	
}

?>