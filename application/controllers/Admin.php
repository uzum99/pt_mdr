<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller 
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
	
	public function index()
	{
		//init modal
		$this->load->database();
		$this->load->model('Mmain');
		
		$this->fn->getheader();	
		$this->fn->getfooter();

	
		
	}
	
	public function show()
	{
		$year=($this->input->get("year")<>""?$this->input->get("year"):date("Y"));
		
		//load view
		if(isset($this->session->userdata['name']))
		{	
				
				$this->fn->getheader();
				$codeuser=$this->session->userdata['codeUser'];
				$output['year']=$year;
				$output['setting']=$this->Mmain->qRead(
                                                                            "tb_setting",
                                                                            "","");
								
							
				$by="";
				
				if($this->session->userdata('accUser')<>"A01")
				{
					//$by=" AND a.code_user='".$codeuser."'";
				}
				
				$output['lob']=$this->Mmain->qRead(
													"
														tb_lob AS a INNER JOIN 
														tb_emp AS b ON a.code_user = b.code_user INNER JOIN
														tb_lobtype AS c ON a.id_lobtype = c.id_lobtype 
														WHERE SUBSTR(a.date0_lob,1,4)='".$year."' 
														".$by."
														AND (a.stat_lob = 0 OR a.stat_lob = 2)
														ORDER BY a.date0_lob DESC LIMIT 10 
													",
													"
														a.id_lob as id,
														DATE_FORMAT(a.date0_lob,'%d %b, %Y') as fulldate,
														b.nm_emp as nm,
														c.desc_lobtype,
														a.reason_lob as reason,
														a.reqdate_lob as date,
														CASE 
															WHEN a.stat_lob =0 THEN 'Pending' 
															WHEN a.stat_lob =1 THEN 'Approved' 
															WHEN a.stat_lob =2 THEN 'Pending' 
															WHEN a.stat_lob =3 THEN 'Rejected' 
														END AS st,
														CASE 
															WHEN a.stat_lob =0 THEN 'btn-primary bg-aqua' 
															WHEN a.stat_lob =1 THEN 'btn-success' 
															WHEN a.stat_lob =2 THEN 'btn-primary bg-aqua' 
															WHEN a.stat_lob =3 THEN 'btn-danger' 
														END AS label
													",
													"");
													
													
				$output['currentLeaveRequest']=$this->Mmain->qRead(
													"
														tb_lob AS a INNER JOIN 
														tb_emp AS b ON a.code_user = b.code_user INNER JOIN
														tb_lobtype AS c ON a.id_lobtype = c.id_lobtype 
														WHERE  curdate() BETWEEN a.date0_lob AND a.date1_lob
														AND a.stat_lob = 1
														".$by."
														
													",
													"
														a.id_lob as id,
														DATE_FORMAT(a.date0_lob,'%d %b, %Y') as fulldate,
														b.nm_emp as nm,
														c.desc_lobtype,
														CASE 
															WHEN a.date0_lob = a.date1_lob THEN DATE_FORMAT(a.date0_lob,'%b, %D') 
															ELSE CONCAT(DATE_FORMAT(a.date0_lob,'%d %M'),' to ',DATE_FORMAT(a.date1_lob,'%d %M')) END AS leaveDate,
														a.reason_lob as reason,
														a.reqdate_lob as date,
														CASE 
															WHEN a.stat_lob =0 THEN 'Pending' 
															WHEN a.stat_lob =1 THEN 'Approved' 
															WHEN a.stat_lob =2 THEN 'Pending' 
															WHEN a.stat_lob =3 THEN 'Rejected' 
														END AS st,
														CASE 
															WHEN a.stat_lob =0 THEN 'btn-primary bg-aqua' 
															WHEN a.stat_lob =1 THEN 'btn-success' 
															WHEN a.stat_lob =2 THEN 'btn-primary bg-aqua' 
															WHEN a.stat_lob =3 THEN 'btn-danger' 
														END AS label
													",
													"");
													
				$permitCount=0;
				$sickCount=0;
				$lateCount=0;
				
				//get permit count by permit category
				$permitQuery=$this->Mmain->qRead("		tb_lob a 
														INNER JOIN tb_lobtype b ON a.id_lobtype=b.id_lobtype 
														WHERE SUBSTR(a.date0_lob,1,4)='".$year."' 
														AND a.stat_lob=1 GROUP BY a.id_lobtype 
												",
												"		b.desc_lobtype,
														SUM(a.dur_lob) as tot
												","");
			
				$output['permitQuery']=$permitQuery;
				
				//get permit count by permit category
				$yearListQuery=$this->Mmain->qRead("		tb_lob a 
														
														 GROUP BY SUBSTR(a.date0_lob,1,4) 
														 ORDER BY SUBSTR(a.date0_lob,1,4) DESC
												",
												"		SUBSTR(a.date0_lob,1,4) as year,
														COUNT(a.id_lobtype) as tot
												","");
			
				$output['yearList']=$yearListQuery;
				
				
				//get permit count by permit status
				$permitStatus=$this->Mmain->qRead("		tb_lob a 
														WHERE SUBSTR(a.date0_lob,1,4)='".$year."' 
														GROUP BY CASE 
																	WHEN a.stat_lob = 1 THEN 0
																	WHEN a.stat_lob = 3 THEN 1
																	WHEN a.stat_lob = 0 THEN 2
																	WHEN a.stat_lob = 2 THEN 2
																END
														ORDER BY CASE 
																	WHEN a.stat_lob = 1 THEN 0
																	WHEN a.stat_lob = 3 THEN 1
																	WHEN a.stat_lob = 0 THEN 2
																	WHEN a.stat_lob = 2 THEN 2
																END
												",
												"				CASE 
																	WHEN a.stat_lob = 1 THEN 'Approved'
																	WHEN a.stat_lob = 3 THEN 'Rejected'
																	WHEN a.stat_lob = 0 THEN 'Pending'
																	WHEN a.stat_lob = 2 THEN 'Pending'
																END AS stat_lob,
																CASE 
																	WHEN a.stat_lob = 1 THEN 'green'
																	WHEN a.stat_lob = 3 THEN 'red'
																	WHEN a.stat_lob = 0 THEN 'aqua'
																	WHEN a.stat_lob = 2 THEN 'aqua'
																END AS bg_lob,
																CASE 
																	WHEN a.stat_lob = 1 THEN 'fa-check'
																	WHEN a.stat_lob = 3 THEN 'fa-times'
																	WHEN a.stat_lob = 0 THEN 'fa-hourglass'
																	WHEN a.stat_lob = 2 THEN 'fa-hourglass'
																END AS icon_lob,
														COUNT(a.id_lobtype) as tot
												","");
				
			
				
				$statusLabelArr=Array(
								Array(
										"label"=>"Approved",
										"backgroundColor"=>"green",
										"icon"=>"fa-check"),
								Array(
										"label"=>"Rejected",
										"backgroundColor"=>"red",
										"icon"=>"fa-times"),
								Array(
										"label"=>"Pending",
										"backgroundColor"=>"aqua",
										"icon"=>"fa-hourglass")
								);
				
				$output['permitLabel']=$statusLabelArr;
				$output['permitStatus']=$permitStatus;
				
				$output['users']=$this->Mmain->qRead(
													"
																				
														tb_emp AS a 
														INNER JOIN tb_user AS b ON a.code_user = b.code_user 
														INNER JOIN tb_loc AS c ON a.id_loc= c.id_loc  
														INNER JOIN tb_div AS d ON a.id_div = d.id_div 
														INNER JOIN tb_dept AS e ON a.id_dept = e.id_dept
														WHERE a.code_user ='".$codeuser."'
													",
													"
																				
														b.ava_user as ava, 
														a.id_emp as id, 
														a.code_user as code, 
														a.nm_emp as name, 
														c.nm_loc as loc, 
														a.nik_emp as nik, 
														a.sex_emp as sex, 
														a.address_emp as address, 
														a.email_emp as email, 
														a.about_emp as about, 
														a.title_emp as title, 
														a.show_emp as pinne,
														d.desc_div as divs,
														e.desc_dept as dept,
														0 as facebook,
														0 as twitter,
														0 as linkedin,
														0 as gplus,
														a.phone_emp as phone
														
													","");
									
									
				$this->load->view('Dashboard',$output);		
				$this->fn->getfooter();
				
			
			
		}
		else
			redirect("login","refresh");
	}
	
	
	
	public function showDriver()
	{
		$year=($this->input->get("year")<>""?$this->input->get("year"):date("Y"));
		
		//load view
		if(isset($this->session->userdata['name']))
		{	
				
				$this->fn->getheader();
				$codeuser=$this->session->userdata['codeUser'];
				$output['year']=$year;
				$output['setting']=$this->Mmain->qRead(
														"tb_setting",
														"","");
								
							
				$by="";
				
				
				//get permit count by permit category
				//query
				$output['viewFormTableHeader']=array(
						"Period",
						"Request By",
						"Origin",
						"Destination",
						"Purpose",
						"Notes",
						);
				//check user access	
		$isAll = $this->Mmain->qRead(
										"tb_accfrm AS a INNER JOIN tb_frm AS b ON a.code_frm = b.code_frm 
										WHERE a.id_acc ='".$this->session->userdata['accUser']."' AND b.code_frm='FR034'",
										"a.is_add as isadd,a.is_edt as isedt,a.is_del as isdel,a.is_spec1 as acc1,a.is_spec2 as acc2","");
	
		foreach($isAll ->result() as $row)
		{
			$access=$row;
		}
		
		//$output['isall']=$access->isadd;
		$accessQuery= $access->acc1 <> 1 ? " WHERE  NOT status_trip = 3 AND a.driver_trip = '".$this->session->userdata('codeUser')."'" : " WHERE  (a.status_trip = 1 ) AND NOT f.code_user IS NULL";
		
		//init view
		$output['formAccess']=$access;
		
			$ordQuery=" ORDER BY id DESC";
			$tableQuery="
						tb_trip a
						INNER JOIN tb_emp e ON a.code_user = e.code_user
						INNER JOIN tb_user u ON u.code_user = a.driver_trip
						LEFT OUTER JOIN tb_emp f ON a.driver_trip = f.code_user
						LEFT OUTER JOIN tb_trans c ON a.id_trans = c.id_trans
						LEFT OUTER JOIN tb_transtype d ON c.id_transtype = d.id_transtype
					";
			$fieldQuery="	
						CONCAT( DATE_FORMAT(a.depdate_trip,'%d %b %y at %H:%i'),' - ',
						DATE_FORMAT(a.arrdate_trip,'%d %b %y at %H:%i') ) as eta,
						e.nm_emp,
						a.from_trip as frm,
						a.to_trip as tto,
						a.pur_trip as pur,
						a.rem_trip as rem,
						c.nm_trans,
						f.nm_emp as driver,
						a.status_trip as st,
						a.driver_trip,
						c.nopol_trans,
						a.dt_trip as dt,
						a.prio_trip as prio,
						DATEDIFF(a.depdate_trip,a.dt_trip) as df,
						a.imgdepkm_trip as imgdepkm,
						a.imgarrkm_trip as imgarrkm,
						a.id_trip as id,
						c.pic_trans as pic,
						c.img_trans as img,
						u.ava_user,
						CONCAT('H-',DATEDIFF(a.depdate_trip,a.dt_trip)) as diff,
						0 as isOwner
						
					"; //leave blank to show all field
					
					$renderTemp=$this->Mmain->qRead($tableQuery.$accessQuery.$ordQuery,$fieldQuery,"");
					foreach($renderTemp->result() as $row)
					{
						//concat nopol + trans type
						//$row->nm_trans = $row->nm_trans . " - " . $row->nopol_trans;
						
						if($row->st==0)
						{		
							if($access->acc1 == 1)
							{
								$row->st="<a href='".site_url()."Ongoingtrip/Approve/".$row->id."' title='Approve'><button class='btn btn-success btn-sm btn-block'><i class='fa fa-check'></i>&nbsp;Approve</button></a>";	
								$row->st.="&nbsp;<a href='".site_url()."Ongoingtrip/Reject/".$row->id."' title='Reject'><button class='btn btn-danger  btn-sm btn-block'><i class='fa fa-times'></i>&nbsp;Reject</button></a>";					
							}
							else
							{
								$row->st="<button class='btn btn-warning btn-block btn-sm '><i class='fa fa-hourglass'></i>&nbsp;Waiting for approval</button>";	
							}
						}				
						else
						if($row->st==1)
						{
							if($this->session->userdata("codeUser") == $row->driver_trip || $access->acc1 == 1)
							{
								
								
								$row->st="	<a data-toggle='modal' data-target='#confirm-start' href='#' name='".site_url()."Ongoingtrip/Start/".$row->id."' class='startBtn' title='Start Driving'>
											<button class='btn btn-primary btn-sm btn-block '>
												<i class='fa fa-dashboard fa-fw'></i>
												&nbsp;Start
											</button>
											</a>";	
							}
							else
							{
								
								$row->st="<button class='btn btn-primary btn-block btn-sm btn-block'><i class='fa fa-check'></i>&nbsp;Approved</button>";	
							}
						}				
						else
						if($row->st==2)
						{
							$row->st="<button class='btn btn-danger btn-block btn-sm btn-block'><i class='fa fa-times'></i>&nbsp;Rejected</button>";	
						}
						else
						if($row->st==3)
						{
							if($this->session->userdata("codeUser")== $row->driver_trip  || $access->acc1 == 1)
							{
								
									$row->st="<a data-toggle='modal' data-target='#confirm-finish' href='#' name='".site_url()."Ongoingtrip/Finish/".$row->id."' class='finishBtn' title='Finish'><button class='btn btn-success btn-sm btn-block'><i class='fa fa-flag'></i>&nbsp;Finish</button></a>";	
									
									$row->isOwner=1;
							}
							else
							{
								
							$row->st="<button class='btn btn-warning btn-block btn-sm btn-block'><i class='fa fa-map'></i>&nbsp;Ongoing</button>";	
							}
						}				
						else
						if($row->st==4)
						{
							$row->st="<button class='btn btn-success btn-block btn-sm btn-block'><i class='fa fa-check'></i>&nbsp;Completed</button>";	
						}	
						
						
						
						$prio="text-green";
						$fa="circle";
						switch($row->prio)
						{
							case "Emergency" : 	$prio = "text-black"; $fa="star fa-lg";
												break;
							case "Urgent" : 	$prio = "text-red"; $fa="circle";
												break;
							case "Needed" : 	$prio = "text-yellow"; $fa="circle";
												break;
						}
						
						$row->prio = "<i class='fa fa-".$fa." ".$prio."' title='".$row->prio."' ></i>";
						$row->diff = "<b class='text-".($row->df == 0 ? "red" : "green")."'>".$row->diff."</b>";
						
					}
					$output['render']=$renderTemp;
				/*
				if($this->session->userdata('codeUser')=='USR00006')
					
					$this->load->view('DashboardTrip',$output);		
				else
					*/
					$this->load->view('DashboardTrip',$output);		
				$this->fn->getfooter();
				
			
			
		}
		else
			redirect("login","refresh");
	}
	
	
	
	//============================================================= General Transaction ===========================================================
	public function getMonthlyRecap($year,$id="")
	{
		
		$year=($year=="0" ? date("Y"):$year);
		$id=($id=="0" || $id=="" ?"": " AND a.code_user = '".$id."' ");
		
		//init modal
		$this->load->database();		
		$this->load->model('Mmain');
	
		//echo $id;
		//echo $year;
		$dataTemp=$this->Mmain->qRead(	"
											tb_lob a
												INNER JOIN tb_lobtype b ON a.id_lobtype=b.id_lobtype 
												WHERE YEAR(date0_lob)='".$year."' ".$id."
												GROUP BY substr(date0_lob,1,7) 
												ORDER BY SUBSTR(date0_lob,6,2)
										",
										"
											CASE 
												WHEN MONTH(date0_lob) ='01' THEN 'Januari'
												WHEN MONTH(date0_lob) ='02' THEN 'Februari'
												WHEN MONTH(date0_lob) ='03' THEN 'Maret'
												WHEN MONTH(date0_lob) ='04' THEN 'April'
												WHEN MONTH(date0_lob) ='05' THEN 'Mei'
												WHEN MONTH(date0_lob) ='06' THEN 'Juni'
												WHEN MONTH(date0_lob) ='07' THEN 'Juli'
												WHEN MONTH(date0_lob) ='08' THEN 'Agustus'
												WHEN MONTH(date0_lob) ='09' THEN 'September'
												WHEN MONTH(date0_lob) ='10' THEN 'Oktober'
												WHEN MONTH(date0_lob) ='11' THEN 'November'
												WHEN MONTH(date0_lob) ='12' THEN 'Desember'
											END as bln,
											SUM(dur_lob) as tot
										","");
		$val="";
		$f1="";
		$dt=null;
		$tot=null;
		$bulan=Array(
					"Januari",
					"Februari",
					"Maret",
					"April",
					"Mei",
					"Juni",
					"Juli",
					"Agustus",
					"September",
					"Oktober",
					"November",
					"Desember"
					);
					
		$retVal1="";
		foreach($dataTemp->result() as $row)
		{
			$dt[]=$row->bln;
			$tot[]=$row->tot;
		}
		
		$j=0;
		for($i=0;$i<12;$i++)
		{
			$totbln=0;
			if(count($dt)>$j)
			{
				if($dt[$j]==$bulan[$i])
				{
					$totbln=$tot[$j];
					$j++;
					
				}
			}
			$retVal1.=$bulan[$i]."++".$totbln."||";
		}
		
		$retVal1=substr($retVal1,0,strlen($retVal1)-2);
		
		//echo $id;
		$lastyear=$year-1;
		$dataTemp=$this->Mmain->qRead(	"
											tb_lob a
												INNER JOIN tb_lobtype b ON a.id_lobtype=b.id_lobtype 
												WHERE YEAR(date0_lob)='".$lastyear."' ".$id."
												GROUP BY substr(date0_lob,1,7) 
												ORDER BY MONTH(date0_lob)
										",
										"
											CASE 
												WHEN MONTH(date0_lob) ='01' THEN 'Januari'
												WHEN MONTH(date0_lob) ='02' THEN 'Februari'
												WHEN MONTH(date0_lob) ='03' THEN 'Maret'
												WHEN MONTH(date0_lob) ='04' THEN 'April'
												WHEN MONTH(date0_lob) ='05' THEN 'Mei'
												WHEN MONTH(date0_lob) ='06' THEN 'Juni'
												WHEN MONTH(date0_lob) ='07' THEN 'Juli'
												WHEN MONTH(date0_lob) ='08' THEN 'Agustus'
												WHEN MONTH(date0_lob) ='09' THEN 'September'
												WHEN MONTH(date0_lob) ='10' THEN 'Oktober'
												WHEN MONTH(date0_lob) ='11' THEN 'November'
												WHEN MONTH(date0_lob) ='12' THEN 'Desember'
											END as bln,
											SUM(dur_lob) as tot
										","");
		$val="";
		$f1="";
		$tot="";
					
		$retVal2="";
		foreach($dataTemp->result() as $row)
		{
			$dt2[]=$row->bln;
			$tot2[]=$row->tot;
		}
		
		$j=0;
		for($i=0;$i<12;$i++)
		{
			$totbln2=0;
			if(count($dt2)>$j)
			{
				if($dt2[$j]==$bulan[$i])
				{
					$totbln2=$tot2[$j];
					$j++;
					
				}
			}
			$retVal2.=$bulan[$i]."++".$totbln2."||";
		}
		
		$retVal2=substr($retVal2,0,strlen($retVal2)-2);
		//echo implode("<br>",$dt);
		//echo $retVal2;
		$retVal=$retVal1."##".$retVal2;
		echo $retVal;
		
		/*
		$retVal2="";
		foreach($dataTemp->result() as $row)
		{
			$retVal2.=$row->bln."++".$row->tot."||";
		}
		$retVal2=substr($retVal2,0,strlen($retVal2)-2);
		
		*/
	}
	
	public function getMonthlyAttendanceRecap($year,$id="")
	{
		
		$year=($year=="0" ? date("Y"):$year);
		$id=($id=="0" || $id=="" ?"": " AND b.code_user = '".$id."' ");
		
		//init modal
		$this->load->database();		
		$this->load->model('Mmain');
	
		//echo $id;
		//echo $year;
		$dataTemp=$this->Mmain->qRead(	"
												tb_att a 
												INNER JOIN tb_emp b ON a.acno_emp = b.acno_emp 
												INNER JOIN tb_tt c ON c.id_tt = b.id_tt
												INNER JOIN tb_ttd d ON c.id_tt = d.id_tt AND d.day_ttd = date_format(a.dt_att,'%W')
												WHERE YEAR(a.dt_att)='".$year."' ".$id."
												GROUP BY substr(a.dt_att,1,7) 
												ORDER BY MONTH(a.dt_att)
										",
										"
											CASE 
												WHEN MONTH(a.dt_att) ='01' THEN 'Januari'
												WHEN MONTH(a.dt_att) ='02' THEN 'Februari'
												WHEN MONTH(a.dt_att) ='03' THEN 'Maret'
												WHEN MONTH(a.dt_att) ='04' THEN 'April'
												WHEN MONTH(a.dt_att) ='05' THEN 'Mei'
												WHEN MONTH(a.dt_att) ='06' THEN 'Juni'
												WHEN MONTH(a.dt_att) ='07' THEN 'Juli'
												WHEN MONTH(a.dt_att) ='08' THEN 'Agustus'
												WHEN MONTH(a.dt_att) ='09' THEN 'September'
												WHEN MONTH(a.dt_att) ='10' THEN 'Oktober'
												WHEN MONTH(a.dt_att) ='11' THEN 'November'
												WHEN MONTH(a.dt_att) ='12' THEN 'Desember'
											END as bln,
											SUM(CASE WHEN TIMESTAMPDIFF(MINUTE,d.tmin_ttd,a.tmin_att)<0 THEN 0 ELSE TIMESTAMPDIFF(MINUTE,d.tmin_ttd,a.tmin_att) END) as tot
										","");
		$val="";
		$f1="";
		$dt=null;
		$tot=null;
		$bulan=Array(
					"Januari",
					"Februari",
					"Maret",
					"April",
					"Mei",
					"Juni",
					"Juli",
					"Agustus",
					"September",
					"Oktober",
					"November",
					"Desember"
					);
					
		$retVal1="";
		foreach($dataTemp->result() as $row)
		{
			$dt[]=$row->bln;
			$tot[]=$row->tot;
		}
		
		$j=0;
		for($i=0;$i<12;$i++)
		{
			$totbln=0;
			if(count($dt)>$j)
			{
				if($dt[$j]==$bulan[$i])
				{
					$totbln=$tot[$j];
					$j++;
					
				}
			}
			$retVal1.=$bulan[$i]."++".$totbln."||";
		}
		
		$retVal1=substr($retVal1,0,strlen($retVal1)-2);
		
		//echo $id;
		$lastyear=$year-1;
		$dataTemp=$this->Mmain->qRead(	"
												tb_att a 
												INNER JOIN tb_emp b ON a.acno_emp = b.acno_emp 
												INNER JOIN tb_tt c ON c.id_tt = b.id_tt
												INNER JOIN tb_ttd d ON c.id_tt = d.id_tt AND d.day_ttd = date_format(a.dt_att,'%W')
												WHERE YEAR(a.dt_att)='".$lastyear."' ".$id."
												GROUP BY substr(a.dt_att,1,7) 
												ORDER BY MONTH(a.dt_att)
										",
										"
											CASE 
												WHEN MONTH(a.dt_att) ='01' THEN 'Januari'
												WHEN MONTH(a.dt_att) ='02' THEN 'Februari'
												WHEN MONTH(a.dt_att) ='03' THEN 'Maret'
												WHEN MONTH(a.dt_att) ='04' THEN 'April'
												WHEN MONTH(a.dt_att) ='05' THEN 'Mei'
												WHEN MONTH(a.dt_att) ='06' THEN 'Juni'
												WHEN MONTH(a.dt_att) ='07' THEN 'Juli'
												WHEN MONTH(a.dt_att) ='08' THEN 'Agustus'
												WHEN MONTH(a.dt_att) ='09' THEN 'September'
												WHEN MONTH(a.dt_att) ='10' THEN 'Oktober'
												WHEN MONTH(a.dt_att) ='11' THEN 'November'
												WHEN MONTH(a.dt_att) ='12' THEN 'Desember'
											END as bln,
											SUM(CASE WHEN TIMESTAMPDIFF(MINUTE,d.tmin_ttd,a.tmin_att)<0 THEN 0 ELSE TIMESTAMPDIFF(MINUTE,d.tmin_ttd,a.tmin_att) END) as tot
										","");
		$val="";
		$val="";
		$f1="";
		$tot="";
					
		$retVal2="";
		foreach($dataTemp->result() as $row)
		{
			$dt2[]=$row->bln;
			$tot2[]=$row->tot;
		}
		
		$j=0;
		for($i=0;$i<12;$i++)
		{
			$totbln2=0;
			if(count($dt2)>$j)
			{
				if($dt2[$j]==$bulan[$i])
				{
					$totbln2=$tot2[$j];
					$j++;
					
				}
			}
			$retVal2.=$bulan[$i]."++".$totbln2."||";
		}
		
		$retVal2=substr($retVal2,0,strlen($retVal2)-2);
		//echo implode("<br>",$dt);
		//echo $retVal2;
		$retVal=$retVal1."##".$retVal2;
		echo $retVal;
		
		/*
		$retVal2="";
		foreach($dataTemp->result() as $row)
		{
			$retVal2.=$row->bln."++".$row->tot."||";
		}
		$retVal2=substr($retVal2,0,strlen($retVal2)-2);
		
		*/
	}
		
	public function getCategoryRecap($year)
	{
		
		//init modal
		$this->load->database();		
		$this->load->model('Mmain');
		$dataTemp=$this->Mmain->qRead("tb_lobtype a INNER JOIN tb_lob b ON a.id_lobtype = b.id_lobtype 
		WHERE YEAR(b.date0_lob) = '".$year."' GROUP BY a.id_lobtype","a.desc_lobtype as nm,COUNT(a.id_lobtype) as tot","");
		$retVal="";
		foreach($dataTemp->result() as $row)
		{
			$retVal.=$row->nm."++".$row->tot."||";
		}
		$retVal=substr($retVal,0,strlen($retVal)-2);
				
		echo $retVal;
	}
}
