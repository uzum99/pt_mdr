<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maintenance extends CI_Controller 
{
	public function __construct()
	 {
		parent::__construct();			
		$this->load->library('Commonfunction','','fn');
		$this->load->library('FPDF','','fnpdf');
		
		if(!isset($this->session->userdata['name']))		
			redirect("login","refresh");
	 }
	/*	
		====================================================== Variable Declaration =========================================================
	*/
	
	var $mainTable="tb_mt";
	var $mainPk="id_mt";
	var $viewLink="Maintenance";
	var $breadcrumbTitle="Work Order";
	var $viewPage="Admviewpage";
	var $addPage="MaintenanceAddPage";
	
	//query
	var $ordQuery=" ORDER BY date DESC ";
	var $tableQuery="
					tb_mt AS a 
					INNER JOIN tb_emp AS b ON a.code_user = b.code_user
					INNER JOIN tb_loc AS c ON c.id_loc = a.id_loc
					INNER JOIN tb_ordertype e ON e.id_ordertype = a.id_ordertype
					INNER JOIN tb_emp AS d ON d.code_user = a.requestee_mt
					LEFT OUTER JOIN tb_emp AS f ON f.code_user = a.signuser_mt
					";
	var $fieldQuery="	a.id_mt,
						a.reqdate_mt as date,
						b.nm_emp as nm,
						d.nm_emp as requesteeName,
						c.nm_loc as loc,
						e.nm_ordertype as type,
						a.stat_mt as st,
						a.rem_mt as rem,
						DATE_FORMAT(a.reqdate_mt,'%d %b, %Y') as formattedDate,
						b.code_user as requestor,
						d.code_user as requestee,
						a.creator_mt as creator,
						a.id_mt as id,
						f.nm_emp as signuser,
						a.signdate_mt as signdate,
						a.sign_mt as sign
						
						";
	var $primaryKey="id";
	var $updateKey="a.id_mt";
	
	//auto generate id	
	
	//view
	var $viewFormTitle="Work Order";
	var $viewFormTableHeader=array("Order ID","Request Date","Ordered By","Requestee","Location","Order Type","Status","Description");
	
	//save
	var $saveFormTitle="New Work Order";
	var $saveFormTableHeader=array("Order ID","Request Date","Ordered By","Requestee","Location","Order Type","Status","Description");
	
	//update
	var $editFormTitle="Edit Work Order";
	
	/*	
		========================================================== General Function =========================================================
	*/
	
	public function index()
	{
		//init modal
		$this->load->database();
		$this->load->model('Mmain');
		
		$codeUser = $this->session->userdata('codeUser');
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
		$this->formAccess=$access;
		if($access->acc1<>1)
			$accessQuery="WHERE a.requestee_mt ='".$codeUser."' OR a.code_user ='".$codeUser."'";
			
			
		//init view
		$output['formAccess']=$access;
		
		$renderTemp=$this->Mmain->qRead($this->tableQuery.$accessQuery.$this->ordQuery,$this->fieldQuery,"");
		$modalList=null;
		foreach($renderTemp->result() as $row)
		{
			if($row->st=="Waiting Approval")
			{		
					
					if($row->creator <> $codeUser && ($row->requestee == $codeUser || $row->requestor == $codeUser))
					{
						$row->st="<a 
								class='btn-mt'
								data-id='".$row->id."'
								data-lnk='Approve'
								href='".site_url()."/Maintenance/Approve/".$row->id."' title='Approve'><button class='btn btn-success '><i class='fas fa-check'></i></button></a>";	
								
						$row->st.="<a 
								class='btn-mt'
								data-id='".$row->id."'
								data-lnk='Hold'
								href='".site_url()."/Maintenance/Hold/".$row->id."' title='Hold'><button class='btn btn-warning '><i class='fas fa-clock'></i></button></a>";						
					}
					else
					{
						$row->st="<button class='btn btn-warning ' title='Waiting for Approval'><i class='fas fa-user-edit'></i></button>";	
					}
				
			
			}				
			elseif($row->st=="Approved")
			{
				if($row->requestee == $codeUser)
				{
					$row->st="<a 
								class='btn-mt'
								data-id='".$row->id."'
								data-lnk='Finish'
								href='".site_url()."/Maintenance/Finish/".$row->id."' title='Finish Work'><button class='btn btn-primary'><i class='fas fa-flag'></i></button></a>";		

					$row->st.="<a 
							class='btn-mt'
							data-id='".$row->id."'
							data-lnk='Hold'
							href='".site_url()."/Maintenance/Hold/".$row->id."' title='Hold'><button class='btn btn-warning'><i class='fas fa-stopwatch'></i></button></a>";								
				}
				else
				{
						$row->st="<button class='btn btn-primary' title='Work in progress'><i class='fas fa-user-cog'></i></button>";	
				}
				
			}			
			elseif($row->st=="Hold")
			{
				if($row->requestee == $codeUser)
				{
					$row->st="<a 
								class='btn btn-danger btn-mt'
								data-id='".$row->id."'
								data-lnk='Approve'
								href='".site_url()."/Maintenance/Approve/".$row->id."'  title='Start Working'><i class='fa fa-redo'></i></a>";							
				}
				else
				{
						$row->st="<button class='btn btn-warning' title='Hold'><i class='fas fa-user-clock'></i></button>";	
				}
				
			}
			elseif($row->st=="Finished")
			{
				
				if($row->requestor == $codeUser)
				{
					$row->st="
								
								<a data-toggle='modal' data-target='#confirm-sign' title='Sign & Close Order' href='#' name='".$row->id."' class='signBtn btn btn-success btn-mt'>
								<i class='fas fa-check'></i>
								</a>
								";
					/*
					<a 
								class='btn btn-success btn-mt'
								data-id='".$row->id."'
								data-lnk='Close'
								href='".site_url()."/Maintenance/Close/".$row->id."'  title='Close Order'><i class='  fa fa-check'></i></a>";				
					*/
				}
				else
				{
					$row->st="<a href='#' title='Finished, please contact the requestor to close order.'><button class='btn btn-success'><i class=' fa fa-user-check'></button></a>";	
				}
			}
			elseif($row->st=="Closed")
			{
				
					$row->st="
					<a href='#' data-toggle='modal' data-target='#mtsign".$row->id."' title='Order Closed at ".$row->signdate." by ".$row->signuser."' >
					<button class='btn btn-default'><i class='fas fa-user-check'></i></button>
					</a>
					";
					
					$modalList[]="
					<div class='modal fade' id='mtsign".$row->id."' tabindex='-1' role='dialog' aria-labelledby='asd' aria-hidden='true'>
						<div class='modal-dialog'>
							<div class='modal-content'>
								<div class='modal-header'>
									Order Closed at ".$row->signdate." by ".$row->signuser."
								</div>
						
								<div class='modal-body'>
									<img src='".base_url()."assets/images/".$row->sign."' height='100px'>
								</div>
								
								<div class='modal-footer'>
									<button type='button' class='btn btn-success' data-dismiss='modal'>Close</button>
								</div>
							</div>
						</div>
					</div>
					";	
			}
			
			$row->id_mt = "<a target='_blank' href='".site_url()."Maintenance/add/".$row->id."' title='Show Detail'>".$row->id_mt."</a>";	
		}
		$output['render']=$renderTemp;
		
		if(is_Array($modalList)) $output['modalList'] = $modalList;
		//init view
		$output['pageTitle']=$this->viewFormTitle;
		$output['breadcrumbTitle']=$this->breadcrumbTitle;
		$output['breadcrumbLink']=$this->viewLink;
		
		$output['printLink']=$this->viewLink."/print";
		$output['isSign']=1;
		$output['saveLink']=$this->viewLink."/add";
		$output['deleteLink']=$this->viewLink."/delete";
		$output['primaryKey']=$this->primaryKey;
		$output['noedit']=1;
		$output['tableHeader']=$this->viewFormTableHeader;
		
		//render view
		$this->fn->getheader();
		$this->load->view($this->viewPage,$output);
		$this->fn->getfooter();
	}

	public function getApprover($id)
	{
		$retval=0;
		
		$this->load->database();
		$this->load->model('Mmain');
			//check user access	
		$isAll = $this->Mmain->qRead("tb_lobgroup WHERE appr1_lobgroup ='".$id."' OR appr2_lobgroup ='".$id."' ","","");
	
		foreach($isAll ->result() as $row)
		{
			$retval=1;
		}
		return $retval;
	}
	
	public function add($isEdit="")
	{
		//init modal
		$this->load->database();
		$this->load->model('Mmain');
		
		$isAll = $this->Mmain->qRead(
										"tb_accfrm AS a INNER JOIN tb_frm AS b ON a.code_frm = b.code_frm 
										WHERE a.id_acc ='".$this->session->userdata['accUser']."' AND b.id_frm='".$this->viewLink."'",
										"a.is_add as isadd,a.is_edt as isedt,a.is_del as isdel,a.is_spec1 as acc1,a.is_spec2 as acc2","")->row();
										
		
		//init view
		$output['isAdmin']=$isAll->isadd;
		$output['formAccess']=$isAll->isadd;
		$output['pageTitle']=$this->saveFormTitle;
		$output['breadcrumbTitle']=$this->breadcrumbTitle;
		$output['breadcrumbLink']=$this->viewLink;
		$output['saveLink']=$this->viewLink."/save";
		$output['tableHeader']=$this->saveFormTableHeader;
		$output['formLabel']=$this->saveFormTableHeader;
		$imgTemp="";
		$isDtp=" dtp";
		$isReadonly=null;
		$isSaved=0;
		$cboApplicant=null;
		$isFinished=0;
		if(!empty($isEdit))
		{
			
			$output['pageTitle']=$this->editFormTitle;
			$output['saveLink']=$this->viewLink."/update";
			$pid=$isEdit;
			
			
			$render=$this->Mmain->qRead($this->tableQuery,$this->fieldQuery," ".$this->updateKey." = '".$pid."'");
			foreach($render->result() as $row)
			{
				foreach($row as $col)
				{
					$txtVal[]= $col;
				}
			}
			
			
				$curDate=date("Y-m-d");
				$curEmployeeName = $this->session->userdata('name');
				$curEmployeeCode = $this->session->userdata('codeUser');
				$codeUser = $txtVal[6];
				$isDtp="";
				$isReadonly="readonly";
				
				$cbotype="<input type='text' name='txt[]' class='form-control' value='".$txtVal[5]."' readonly>";
				
				$cbostat="<input type='text' name='txt[]' class='form-control' value='".$txtVal[6]."' readonly>";
				$isSaved=1;
				
			$cboLoc = "<input type='text' name='txt[]' class='form-control' value='".$txtVal[4]."' readonly>";
				$cboRequestor="
								
								<input type='text' class='form-control' id='txtid0'  value='".$txtVal[2]."' readonly>
								<input type='hidden'  id='txtid0' name=txt[] value='".$codeUser."' readonly>";
								
				$isFinished = $txtVal[4] == "Finished" ? 1 : 0;
				$cboRequestee="
								
								<input type='text' class='form-control' id='txtid0'  value='".$txtVal[3]."' readonly>
								<input type='hidden'  id='txtid0' name=txt[] value='".$codeUser."' readonly>";
		}
		else
		{	
				for($i=0;$i<10;$i++)
				{
					$txtVal[]="";
				}	
				
				//generate id
				$newId=$this->Mmain->autoId($this->mainTable,$this->mainPk,"MT".date("ym"),"MT".date("ym")."001","001");	
				$txtVal[0]=$newId;
				
				$cboemp="";
				
				
				$txtVal[1]=date("Y-m-d");
				$txtVal[2]=$this->session->userdata('name');
				$curDate=date("Y-m-d");
				$curEmployeeName = $this->session->userdata('name');
				$curEmployeeCode = $this->session->userdata('codeUser');
				$codeUser = $this->session->userdata('codeUser');
				
				$cbotype=$this->fn->createCbofromDb("tb_ordertype","id_ordertype as id, nm_ordertype as nm","",$txtVal[3]);
				
				$cbostat=$this->fn->createCbo(array("Waiting Approval"),array("Waiting Approval"),$txtVal[4]);
				
		$cboLoc = $this->fn->createCbofromDb("tb_loc ","id_loc as id, nm_loc as nm","","");
				
				$cboRequestor=$isAll->acc2 == 1 ? $this->fn->createCbofromDb("tb_emp WHERE show_emp =1 ","code_user as id, nm_emp as nm","",$curEmployeeCode) : "
								
								<input type='text' class='form-control' id='txtid0'  value='".$txtVal[2]."' readonly>
								<input type='hidden'  id='txtid0' name=txt[] value='".$codeUser."' readonly>";
				
				
				$cboRequestee=$this->fn->createCbofromDb("tb_emp WHERE show_emp =1 AND about_emp <=4 ORDER BY nm_emp ","code_user as id, nm_emp as nm","",$txtVal[3]) ;
				
		}
		
		
		$output['formTxt']=array(
								"<input type='text' class='form-control' id='txtid0' name=txt[] value='".$txtVal[0]."' readonly>",
								"<input type='text' class='form-control $isDtp' data-date-format='yyyy-mm-dd' id='txtid2' name=txt[] value='".$txtVal[1]."' readonly >".
								"<input type='hidden' class='form-control dtp' data-date-format='yyyy-mm-dd' id='txtid2' name=txt[] >".
								"<input type='hidden' class='form-control dtp' data-date-format='yyyy-mm-dd' id='txtid2' name=txt[] >".
								"<input type='hidden' class='form-control dtp' data-date-format='yyyy-mm-dd' id='txtid2' name=txt[] >",
								$cboRequestor,
								$cboRequestee,
								$cboLoc,
								$cbotype,
								$cbostat,
								"<textarea name='txt[]' $isReadonly class='form-control' rows=5 placeholder='Additional Info' required>".$txtVal[7]."</textarea>"	
								);
		
		
	
													
		$this->tableQuery="
							tb_detmt a 
							LEFT OUTER JOIN tb_detitem b ON a.batch_item = b.batch_item
							LEFT OUTER JOIN tb_item c ON b.code_item = c.code_item
							LEFT OUTER JOIN tb_itemtype d ON c.id_itemtype = d.id_itemtype
							LEFT OUTER JOIN tb_man e ON c.id_man = e.id_man
							where a.id_mt = '".$txtVal[0]."' ORDER BY a.dt_detmt DESC
							";
		$this->fieldQuery="
							CASE WHEN b.batch_item IS NULL THEN a.batch_item ELSE CONCAT(d.desc_itemtype,' ',e.desc_man,' ',c.desc_item) END as nm,a.issue_detmt,a.sol_detmt,a.stat_detmt,a.batch_item as id,a.id_detmt as tid
							";
		
		
		$renderTemp=$this->Mmain->qRead($this->tableQuery,$this->fieldQuery,"");
	
		$output['itemRender']=$renderTemp;
		$output['itemDesc']="<textarea class='form-control' name='mtitem[]' rows=3></textarea>";
		$output['itemTableHeader']=Array("Description","Issues","Notes","Status");
		$output['itemDeleteLink']=$this->viewLink."/deleteitem";
		$output['itemResponse']="";
		$output['itemDateTime']=date("Y-m-d H:i:s");
		$output['itemStatus']="Open";
		
													
		
		// ACTIVITIES
		$this->tableQuery="
							tb_detact a 
							INNER JOIN tb_emp b ON a.code_user = b.code_user
							WHERE a.id_mt = '".$txtVal[0]."' ORDER BY a.dt_detact DESC
							";
		$this->fieldQuery="
							a.dt_detact,b.nm_emp,a.rem_detact,a.file_detact as doc,a.code_user as id,a.id_detact as tid
							";
		$renderTemp=$this->Mmain->qRead($this->tableQuery,$this->fieldQuery,"");
		foreach($renderTemp->result() as $i => $row)
		{
			$row->doc = $row->doc <> "" ? 
						"<a href='".base_url()."assets/maintenance/".$row->doc."' target='_blank'  class='btn btn-primary'>View Document</a>" : 
						"<button class='btn btn-default'>No Document</a>";
		}
		$output['actFormTitle']="Activities";
		$output['actRender']=$renderTemp;
		$output['actDeleteLink']=$this->viewLink."/deleteact";
		$output['actTableHeader']=Array("Date","P.I.C","Description","Related Document(s)");
		$output['actFormTxt']=Array(
									"<input type='hidden' name='mtact[]' value='0'>
									<input type='hidden' name='mtact[]' value='".$txtVal[0]."'>".
									"<input type='text' class='form-control dtp' data-date-format='yyyy-mm-dd' autocomplete='off' name='mtact[]' value='".$curDate."'readonly>",
									
									"<input type='text' class='form-control ' name='dummy' value='".$curEmployeeName."'readonly><input type='hidden' class='form-control ' name='mtact[]' value='".$curEmployeeCode."'readonly>",
									
									"<textarea class='form-control' name='mtact[]' rows=3 required></textarea>",
									
									
									"<input type='file' class='form-control fileupload' name='flact' >"
									);
						
		$output['mtID'] = $txtVal[0];
		$output['codeUser'] = $curEmployeeCode;
		$output['isSaved']=$isSaved;
		$output['isFinished']=$isFinished;
		
		//render view
		$this->fn->getheader();
		$this->load->view($this->addPage,$output);
		$this->fn->getfooter();
	}	
	
	public function save()
	{
		//retrieve values
		$savValTemp=$this->input->post('txt');

		
		//echo implode("<br>",$savValTemp);
		//save to database
		$this->load->database();
		$this->load->model('Mmain');
		$savValTemp[] = $this->session->userdata('codeUser');
		$savValTemp[] = "";
		$savValTemp[] = "";
		$savValTemp[] = "";
		$this->Mmain->qIns($this->mainTable,$savValTemp);
		
		$name = $this->Mmain->qRead("tb_emp WHERE code_user = '".$savValTemp[5]."' ","nm_emp","")->row()->nm_emp;
		
		$this->Mmain->qIns("tb_detact",Array(0,$savValTemp[0],$savValTemp[1].date(" H:i:s"),$savValTemp[5],"Open Ticket by ".$name,""));
		
		//echo $savValTemp[5];
		//add alert
		/*
		$apprList = $this->Mmain->qRead(
										"tb_detlobgroup AS a 
										INNER JOIN tb_lobgroup AS b ON a.id_lobgroup = b.id_lobgroup 
										INNER JOIN tb_emp AS c ON a.code_user = c.code_user 
										WHERE a.code_user='".$savValTemp[5]."'",
										"b.appr1_lobgroup as apr1,b.appr2_lobgroup as apr2,c.nm_emp as nm","");
		
		foreach($apprList ->result() as $row)
		{
			$this->fn->addAlert($row->apr1,"Pending LOB Request from ".$row->nm,"Vacation");
			$this->fn->addAlert($row->apr2,"Pending LOB Request from ".$row->nm,"Vacation");
			//echo "asd";
		}
		*/
		$this->session->set_flashdata('successNotification', '1');
		//redirect to form
		redirect($this->viewLink,'refresh');		
	}
	
	function saveSign()
	{
		
		//save to database
		$this->load->database();
		$this->load->model('Mmain');
		
		$saveParam=$this->input->post('txt');
		//$this->Mmain->qIns("tb_detmt",$saveParam);
		
		//untuk simpan ttd param nya diganti
		if($saveParam[1] <> "")
		{
			$splited = explode(',', substr( $saveParam[1] , 5 ) , 2);
			$saveParam[1]="sign_".date("YmdHis")."_".$saveParam[0].".png";
			$mime=$splited[0];
			$data=$splited[1];
			file_put_contents("assets/images/".$saveParam[1],base64_decode($data));
		}
		
		
		$this->Mmain->qUpdPart("tb_mt",
								"id_mt",
								$saveParam[0],
								Array(
								"stat_mt",
								"signuser_mt",
								"signdate_mt",
								"sign_mt",
								),
								Array(
									"Closed",
									$this->session->userdata('codeUser'),
									date("Y-m-d H:i:s"),
									$saveParam[1]
									)
									);
		
		
		echo implode(",",$saveParam);
	}
	
	function saveItem()
	{
		
		//save to database
		$this->load->database();
		$this->load->model('Mmain');
		
		$saveParam=$this->input->post('mtitem');
		$this->Mmain->qIns("tb_detmt",$saveParam);
		
		
		$this->Mmain->qIns("tb_detact",Array(0,$saveParam[0],date("Y-m-d H:i:s"),$this->session->userdata('codeUser'),"Issued ".$saveParam[1]));
		
		
		echo implode(",",$saveParam);
	}
	
	function saveAct()
	{
		
		$saveParam=$this->input->post('mtact');
		
		//save to database
		$this->load->database();
		$this->load->model('Mmain');
		
		$saveParam[2] .= date(" H:i:s");
		
		$img="";
		if(!empty($_FILES['flact']['name']))
		{
			$flName=$_FILES['flact']['name'];
			$flTmp=$_FILES['flact']['tmp_name'];
			$fltype=$_FILES['flact']['type'];
			move_uploaded_file($flTmp,"assets/maintenance/".$flName);
			$img=$flName;
		}
		
		$saveParam[] = $img;
		
		$this->Mmain->qIns("tb_detact",$saveParam);
		
		
		echo implode(",",$saveParam);
	}
	
	//delete record
	public function delete($valId)
	{		
		//save to database
		$this->load->database();
		$this->load->model('Mmain');
		$this->Mmain->qDel($this->mainTable,$this->mainPk,$valId);
		$this->Mmain->qDel("tb_detmt",$this->mainPk,$valId);
		$this->Mmain->qDel("tb_detact",$this->mainPk,$valId);
		
		$this->session->set_flashdata('successNotification', '3');
		//redirect to form
		redirect($this->viewLink,'refresh');		
	}
	
	//update record
	public function update()
	{
		//retrieve values
		$savValTemp=$this->input->post('txt');

		//echo implode("<br>",$savValTemp);
		//save to database
		$this->load->database();
		$this->load->model('Mmain');
		$this->Mmain->qUpd($this->mainTable,$this->mainPk,$savValTemp[0],$savValTemp);
		
		$this->session->set_flashdata('successNotification', '2');
		//redirect to form
		redirect($this->viewLink,'refresh');		
	}

	
	//update record
	public function Approve()
	{
		//retrieve values
		
		
		$id= $this->input->post('id');
		//save to database
		$this->load->database();
		$this->load->model('Mmain');
		$this->Mmain->qUpdpart($this->mainTable,$this->mainPk,$id,Array("stat_mt"),Array("Approved"));
		
		$this->Mmain->qIns("tb_detact",Array(0,$id,date("Y-m-d H:i:s"),$this->session->userdata('codeUser'),"Approved by  ".$this->session->userdata('name')));
		
		//redirect to form
		//redirect($this->viewLink,'refresh');		
		echo $id;			
	}	
	
	//update record
	public function Hold()
	{
		//retrieve values
		
		
		$id= $this->input->post('id');
		//save to database
		$this->load->database();
		$this->load->model('Mmain');
		$this->Mmain->qUpdpart($this->mainTable,$this->mainPk,$id,Array("stat_mt"),Array("Hold"));
		$this->Mmain->qIns("tb_detact",Array(0,$id,date("Y-m-d H:i:s"),$this->session->userdata('codeUser'),"Hold by  ".$this->session->userdata('name')));
		
		
		//redirect to form
		//redirect($this->viewLink,'refresh');		
		echo $id;		
	}
	
	//update record
	public function Finish()
	{
		//retrieve values
		
		$id= $this->input->post('id');
		//save to database
		$this->load->database();
		$this->load->model('Mmain');
		$this->Mmain->qUpdpart($this->mainTable,$this->mainPk,$id,Array("stat_mt"),Array("Finished"));
		$this->Mmain->qIns("tb_detact",Array(0,$id,date("Y-m-d H:i:s"),$this->session->userdata('codeUser'),"Finished by  ".$this->session->userdata('name')));
		
		//redirect to form
		//redirect($this->viewLink,'refresh');		
		echo $id;
	}
	
	public function getItemDetail()
	{
		
		$this->load->database();
		$this->load->model('Mmain');
		$itemBatch = $this->input->post('itemBatch');
		$itemData = $this->Mmain->qRead("
									tb_item a 
									INNER JOIN tb_detitem b ON a.code_item = b.code_item 
									INNER JOIN tb_itemtype c ON a.id_itemtype = c.id_itemtype
									INNER JOIN tb_man d ON a.id_man = d.id_man
									
									WHERE b.batch_item = '".$itemBatch."' ",
									"CONCAT(c.desc_itemtype,' ',d.desc_man,' ',a.desc_item) as nm,b.serial_item as sn,a.pic_item as pic","");
									
		if($itemData->num_rows() > 0)
		{
			$row = $itemData->row();
			echo $row->nm."~".$row->sn."~".$row->pic;
		}
		else
		{
			echo "0";
		}
	}
	
	public function deleteact($id)
	{
		
		$this->load->database();
		$this->load->model('Mmain');
		$tid = $this->Mmain->qRead("tb_detact WHERE id_detact='".$id."'","id_mt","")->row()->id_mt;
		$this->Mmain->qDel("tb_detact","id_detact",$id);
		
		redirect($this->viewLink."/add/".$tid,'refresh');	
	}
	public function deleteitem($id)
	{
		
		$this->load->database();
		$this->load->model('Mmain');
		$tid = $this->Mmain->qRead("tb_detmt WHERE id_detmt='".$id."'","id_mt","")->row()->id_mt;
		$this->Mmain->qDel("tb_detmt","id_detmt",$id);
		
		redirect($this->viewLink."/add/".$tid,'refresh');	
	}
	
	public function print($id)
	{
		
		
		//save to database
		$this->load->database();
		$this->load->model('Mmain');		
		
		$renderTemp=$this->Mmain->qRead($this->tableQuery." WHERE id_mt = '".$id."' ",$this->fieldQuery,"");
		if($renderTemp->num_rows()>0)
		{
			$row=$renderTemp->row();
			
			$pdf = $this->fnpdf;
			$pdf->AddPage("P","A4");
			//$pdf->Image(base_url()."assets/admin/img/mdr-logo.png",12,5,20);
			//$pdf->Image(base_url()."assets/images/approved.png",140,30,-200);
			$pdf->SetFont('Arial','B',30);
			$pdf->Cell(0,7,'PT Mangli Djaya Raya',0,1,'C');
			$pdf->SetFont('Arial','B',11);
			$pdf->Cell(0,9,'Jalan Mayjen D.i Pandjaitan No 99 Petung, Bangsalsari','B',1,'C');
			$pdf->Cell(0,2,"",0,1,'C');
			$pdf->SetFont('Arial','B',13);
			$pdf->Cell(0,6,'Maintenance Report',0,1,'C');
			
			$titleLength = 70;
			$contentLength = 130;
			$pdfLength = 45;
			
			$labelHeight=6;
			
			$headerFont= (Object) Array("size" => 8, "style" => "bi");
			$contentFont= (Object) Array("size" => 12, "style" => "");
			
			
			// ================================ Request Information ====================================
			$pdf->SetFont('Arial','B',13);
			$pdf->Cell($titleLength,8,'Request Information ',"B",0);
			
			$pdf->SetFont('Arial','I',11);
			$pdf->Cell($titleLength+50,8,$row->formattedDate,0,1,"R");
			
			$header = (Object) Array( 
										(Object) Array("text" => "Ticket No", "isEnter" => 0, "length" => 30 ),
										(Object) Array("text" => "Request Type", "isEnter" => 0, "length" => 60 ),
										(Object) Array("text" => "Ordered By", "isEnter" => 1, "length" => 75 )
									);
									
			$content = (Object) Array( 
										(Object) Array("text" => substr($row->id,2,7),"isEnter" => 0, "length" => 30 ),
										(Object) Array("text" => $row->type,"isEnter" => 0, "length" => 60 ),
										(Object) Array("text" => $row->nm,"isEnter" => 1, "length" => 75 )
									);
		
			foreach($header as $lbl)
			{
				
				$pdf->SetFont('Arial',$headerFont->style,$headerFont->size);
				$pdf->Cell($lbl->length,$labelHeight," ".$lbl->text." ",0,$lbl->isEnter);
			}
			
			foreach($content as $lbl)
			{
				$pdf->SetFont('Arial',$contentFont->style,$contentFont->size);
				$pdf->Cell($lbl->length,$labelHeight," ".$lbl->text." ",0,$lbl->isEnter);
			}
			
			$header = (Object) Array( 
										(Object) Array("text" => "Location", "isEnter" => 0, "length" => 30 ),
										(Object) Array("text" => "Status", "isEnter" => 0, "length" => 60 ),
										(Object) Array("text" => "Applicant", "isEnter" => 1, "length" => 75 )
									);
									
			$content = (Object) Array( 
										(Object) Array("text" => $row->loc,"isEnter" => 0, "length" => 30 ),
										(Object) Array("text" => $row->st,"isEnter" => 0, "length" => 60 ),
										(Object) Array("text" => $row->requestee,"isEnter" => 1, "length" => 75 )
									);
		
			foreach($header as $lbl)
			{
				
				$pdf->SetFont('Arial',$headerFont->style,$headerFont->size);
				$pdf->Cell($lbl->length,$labelHeight," ".$lbl->text." ",0,$lbl->isEnter);
			}
			
			foreach($content as $lbl)
			{
				$pdf->SetFont('Arial',$contentFont->style,$contentFont->size);
				$pdf->Cell($lbl->length,$labelHeight," ".$lbl->text." ",0,$lbl->isEnter);
			}
			
			// ==================== remark =======================
			$header = (Object) Array( 
										(Object) Array("text" => "Remark", "isEnter" => 1, "length" => 0 ),
									);
									
			$content = (Object) Array( 
										(Object) Array("text" => $row->rem,"isEnter" => 1, "length" => 0 )
									);
		
			foreach($header as $lbl)
			{
				
				$pdf->SetFont('Arial',$headerFont->style,$headerFont->size);
				$pdf->Cell($lbl->length,$labelHeight," ".$lbl->text." ",0,$lbl->isEnter);
			}
			
			foreach($content as $lbl)
			{
				$pdf->SetFont('Arial',$contentFont->style,$contentFont->size);
				$pdf->MultiCell($lbl->length,$labelHeight," ".$lbl->text." ",0,$lbl->isEnter);
			}
			
			$pdf->Cell(0,3,'',"B",1);
			
			$pdf->Ln();
			
			// ================================ Activities ====================================
			
			$contentFont= (Object) Array("size" => 10, "style" => "");
			
			$this->tableQuery="
								tb_detact a 
								INNER JOIN tb_emp b ON a.code_user = b.code_user
								WHERE a.id_mt = '".$row->id."' ORDER BY a.dt_detact 
								";
			$this->fieldQuery="
								0 as no,DATE_FORMAT(a.dt_detact,'%d %b, %Y - %H:%i') as date,b.nm_emp,a.rem_detact
								";
			
			
			$renderActivities=$this->Mmain->qRead($this->tableQuery,$this->fieldQuery,"");
			
			$pdf->SetFont('Arial','B',13);
			$pdf->Cell($titleLength,8,'Activities ',"B",1);
			
			$header = Array( 
										(Object) Array("text" => "No.", "isEnter" => 0, "length" => 15 ),
										(Object) Array("text" => "Date & Time", "isEnter" => 0, "length" => 40 ),
										(Object) Array("text" => "P.I.C", "isEnter" => 0, "length" => 45 ),
										(Object) Array("text" => "Description", "isEnter" => 1, "length" => 95 )
									);
									
			foreach($header as $lbl)
			{
				
				$pdf->SetFont('Arial',$headerFont->style,$headerFont->size);
				$pdf->Cell($lbl->length,$labelHeight," ".$lbl->text." ",0,$lbl->isEnter);
			}
			
			//echo var_dump($header);
			//echo print_r($header)."<br>";
			//echo $header[0]->length."<br>";
			foreach($renderActivities->result() as $i => $rowA)
			{
				$j=0;
				foreach($rowA as $colA)
				{
					$colA = $j==0 ? $i+1 : $colA;
					$pdf->SetFont('Arial',$contentFont->style,$contentFont->size);
					$pdf->Cell($header[$j]->length,$labelHeight," ".$colA." ",0,$header[$j]->isEnter);
					$j++;
				}
			}
			
			$pdf->setXY(160,45);
			$pdf->SetFont('Arial',$contentFont->style,$contentFont->size);
			$pdf->Cell(40,$labelHeight," signature","T R L",0,"C");
			
			$pdf->setXY(160,51);
			$pdf->Cell(40,25,"","B R L",0,"C");
									
			$pdf->Ln();
			
			$pdf->Output("I");
			
		}
		
		
		
	}
	
}

?>