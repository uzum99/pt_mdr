<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class Commonfunction
{
	
	/*	
		====================================================== Variable Declaration =========================================================
	*/	
	protected $CI;
	var $frm;
	
    // We'll use a constructor, as you can't directly call a function
    // from a property definition.
    public function __construct()
    {
        // Assign the CodeIgniter super-object
    
       $this->CI =& get_instance();
       $this->CI->load->helper('url');
       $this->CI->load->library('session');
       $this->CI->load->database();
		
    }
	
	
	public function addAlert($user,$rem,$link)
	{
		
		//save to database
		$this->CI->load->database();
		$this->CI->load->model('Mmain');
		
		//$this->CI->Mmain->qIns("tb_alert",Array(0,$user,$rem,$link,0));
	}
	
	public function stopAlert($id)
	{
	
		$this->CI->load->database();
		$this->CI->load->model('Mmain');
		//$this->CI->Mmain->qUpdpart("tb_alert","id_alert",$id,Array("stat_alert"),Array(1));
		
	}


	public function checkAccess($codeUser,$idFrm)
	{
		//check user access	
		//init modal
		$this->CI->load->database();
		$this->CI->load->model('Mmain');
		$isAll = $this->CI->Mmain->qRead(
										"tb_userfrm AS a INNER JOIN tb_frm AS b ON a.code_frm = b.code_frm 
										WHERE a.code_user ='".$codeUser."' AND b.id_frm='".$idFrm."'",
										"a.is_add as isadd,a.is_edt as isedt,a.is_del as isdel,a.is_spec1 as acc1,a.is_spec2 as acc2","");
	
		foreach($isAll ->result() as $row)
		{
			$access=$row;
		}
		return $access;
	}
	
	public function getheader()
	{	
	
			$this->CI->load->database();
			$this->CI->load->model('Mmain');
			//get website setting
			$output['setting']=$this->CI->Mmain->qRead(
											"tb_setting",
											"","");
		
	
			$isadmin="";
		$isAll = $this->CI->Mmain->qRead(
										"tb_accfrm AS a INNER JOIN tb_frm AS b ON a.code_frm = b.code_frm
										WHERE a.id_acc ='".$this->CI->session->userdata['accUser']."' AND a.code_frm='FR017' ",
										"a.is_add as isadd,a.is_edt as isedt,a.is_del as isdel,a.is_spec1 as acc1,a.is_spec2 as acc2","");
		
		
			$output['ses']=$this->CI->session->all_userdata();
			$output['frmList']=$this->CI->session->userdata('frmList');
			$output['frmHead']=$this->CI->session->userdata('frmHead');
			$this->CI->load->view('adm_header',$output);
		
		
	}
	
	public function getfooter()
	{	
	
		$output['setting']=$this->CI->Mmain->qRead(
											"tb_setting",
											"","");
		$this->CI->load->view('adm_footer',$output);		
	}
	
	public function getFormGroup($idacc)
	{
		//init modal
		$this->CI->load->database();
		$this->CI->load->model('Mmain');		
		$qemp=$this->CI->Mmain->qRead("	tb_frm AS a 
										INNER JOIN tb_frmgroup AS b ON a.id_frmgroup = b.id_frmgroup 
										INNER JOIN tb_accfrm AS c ON a.code_frm = c.code_frm
										WHERE c.id_acc='".$idacc."' ORDER BY b.nm_frmgroup,a.sort_order,a.desc_frm ",
										"a.code_frm as code,a.id_frm as id,a.desc_frm as descs,b.nm_frmgroup as groupnm,b.icon_frmgroup as ico,b.iconcolor_frmgroup as iclr,a.is_shortcut as iss",
										"");
										
		return $qemp;
	}
	
	
	public function getFormGroupHeader($idacc)
	{
		//init modal
		$this->CI->load->database();
		$this->CI->load->model('Mmain');												
										
		$qemp=$this->CI->Mmain->qRead("	tb_frm AS a 
										INNER JOIN tb_frmgroup AS b ON a.id_frmgroup = b.id_frmgroup 
										INNER JOIN tb_accfrm AS c ON a.code_frm = c.code_frm
										WHERE c.id_acc='".$idacc."' GROUP BY b.nm_frmgroup ORDER BY b.nm_frmgroup,a.sort_order,a.desc_frm ",
										"b.nm_frmgroup as groupnm,b.icon_frmgroup as ico,b.iconcolor_frmgroup as iclr",
										"");
		return $qemp;
	}
	
	public function createCbofromDbAll($cboTb,$cboSel,$cboWhere,$cboDef,$isdis="",$nmdef="txt[]")
	{
		//init modal
		$this->CI->load->database();
		$this->CI->load->model('Mmain');
		$qemp=$this->CI->Mmain->qRead($cboTb,$cboSel,$cboWhere);
		$cboemp="<select name=$nmdef class='form-control select2' multiple='multiple'   $isdis data-placeholder='Select data'>";
			$cboemp.="<option  value=''>All</option>";
		foreach($qemp->result() as $row)
		{
			$isdef="";
			if(is_array($cboDef))
			{
				foreach($cboDef as $dt)
			if($row->nm==$dt || $row->id==$dt)		
					$isdef="selected";
			}
			else
			if($row->nm==$cboDef || $row->id==$cboDef)	
				$isdef="selected";
			$cboemp.="<option value='".$row->id."' $isdef>".$row->nm."</option>";
		}
		$cboemp.="</select>";
		return $cboemp;
	}
	
	public function createCbofromDb($cboTb,$cboSel,$cboWhere,$cboDef,$isdis="",$nmdef="txt[]")
	{
		//init modal
		$this->CI->load->database();
		$this->CI->load->model('Mmain');
		$qemp=$this->CI->Mmain->qRead($cboTb,$cboSel,$cboWhere);
		$cboemp="<select name=$nmdef class='form-control ' $isdis>";
		foreach($qemp->result() as $row)
		{
			$isdef="";
			if($row->nm === $cboDef || $row->id === $cboDef)	
				$isdef="selected";
			$cboemp.="<option value='".$row->id."' $isdef>".$row->nm."</option>";
		}
		$cboemp.="</select>";
		return $cboemp;
	}
	
	public function createCbofromDbsingle($cboTb,$cboSel,$cboWhere,$cboDef,$isdis="",$nmdef="txt[]", $addclass="")
	{
		//init modal
		$this->CI->load->database();
		$this->CI->load->model('Mmain');
		$qemp=$this->CI->Mmain->qRead($cboTb,$cboSel,$cboWhere);
		$cboemp="<select name=$nmdef class='form-control $addclass' $isdis>";
		foreach($qemp->result() as $row)
		{
			$isdef="";
			if($row->nm === $cboDef)	
				$isdef="selected";
			$cboemp.="<option value='".$row->id."' $isdef>".$row->nm."</option>";
		}
		$cboemp.="</select>";
		return $cboemp;
	}
	
	public function createCbo($cboid,$cboval,$cboDef,$isdis="",$nmdef="txt[]",$cls="")
	{
		
			
		//init modal
		$cboemp="<select name=$nmdef class='form-control $cls' $isdis>";
		for($i=0;$i<count($cboid);$i++)
		{
			$isdef=( $cboid[$i] == $cboDef || $cboval[$i] == $cboDef ? "selected" : "");	
			$cboemp.="<option value='".$cboid[$i]."' $isdef >".$cboval[$i]."</option>";
		}
		$cboemp.="</select>";
		return $cboemp;
	}
	
	public function createCboAll($cboid,$cboval,$cboDef,$isdis="",$nmdef="txt[]")
	{
		//init modal
		$cboemp="<select name=$nmdef class='form-control select2' multiple='multiple' $isdis>";
			$cboemp.="<option value=''>All</option>";
		for($i=0;$i<count($cboid);$i++)
		{
			$isdef="";
			if(is_array($cboDef))
			{
				foreach($cboDef as $dt)
					if($cboval[$i] == $dt || $cboid[$i] == $dt)		
					$isdef="selected";
			}
			else
			if($cboval[$i] == $cboDef || $cboid[$i] == $cboDef)	
				$isdef="selected";
			$cboemp.="<option value='".$cboid[$i]."' $isdef >".$cboval[$i]."</option>";
		}
		$cboemp.="</select>";
		return $cboemp;
	}
	
	

	public function createMulCbofromDb($cboTb,$cboSel,$cboWhere,$cboDef,$nmdef="txt[]")
	{
			//init modal
			$this->CI->load->database();
			$this->CI->load->model('Mmain');
			$qemp=$this->CI->Mmain->qRead($cboTb,$cboSel,$cboWhere);
			$cboemp="<select multiple='multiple' name=$nmdef class='form-control' size=10>";
			foreach($qemp->result() as $row)
			{
				$isdef="";
				if(is_array($cboDef))
				{
					foreach($cboDef as $isi)
					{
						if($row->nm == $isi || $row->id == $isi)
						{
							$isdef="selected";
							break;
						}
					}
				}
				else
				if($row->nm == $cboDef || $row->id == $cboDef)
				{
					$isdef="selected";
				}
				$cboemp.="<option value='".$row->id."' $isdef  >".$row->nm."</option>";
			}
			$cboemp.="</select>";
		return $cboemp;
	}
	
	
	
	public function createCbofromDb2($cboTb,$cboSel,$cboWhere,$cboDef,$cboNm)
	{
			//init modal
			$this->CI->load->database();
			$this->CI->load->model('Mmain');
			$qemp=$this->CI->Mmain->qRead($cboTb,$cboSel,$cboWhere);
			$cboemp="<select name=$cboNm class='form-control select2' multiple='multiple' >";
			foreach($qemp->result() as $row)
			{
					$isdef="";
			if(is_array($cboDef))
			{
				foreach($cboDef as $dt)
					if($cboval[$i] == $dt || $cboid[$i] == $dt)		
					$isdef="selected";
			}
			else
				if($row->nm == $cboDef || $row->id == $cboDef)	
					$isdef="selected='selected'";
				
				$cboemp.="<option value='".$row->id."' $isdef  >".$row->nm."</option>";
			}
			$cboemp.="</select>";
		return $cboemp;
	}
		
	
	public function createRadio($cboid,$cboval,$count,$cboDef)
	{
			//init modal
			$cboemp=" 
                   ";
			for($i=0;$i<count($cboid);$i++)
			{
				$chk="";
				if($cboDef == $cboid[$i])
				$chk="checked"	;
				$cboemp.=" <label><input type='radio' name=txt[$count] class='flat-red' value='".$cboid[$i]."' $chk>&nbsp;$cboval[$i]</label>";
			}
			
			$cboemp.="";
		return $cboemp;
	}
	
	public function addViewCount($formName)
	{
			//init modal
			$this->CI->load->database();
			$this->CI->load->model('Mmain');
			$visitorIp=$_SERVER['REMOTE_ADDR'];
			$saveVal=Array(
							"",
							date("Y-m-d h:i:s"),
							$visitorIp,
							$formName
							);
			$this->CI->Mmain->qIns("tb_viewcount",$saveVal);
	}
	
	public function getVacationLeft($codeUser,$year="")
	{
		//init modal
		$this->CI->load->database();
		$this->CI->load->model('Mmain');
			
		if($year=="")
			$year=date("Y");
		
		
		
		//get permit count by permit category
		$yearListQuery=$this->CI->Mmain->qRead("		tb_lob a 
												
												 GROUP BY SUBSTR(a.date0_lob,1,4) 
												 ORDER BY SUBSTR(a.date0_lob,1,4) 
										",
										"		SUBSTR(a.date0_lob,1,4) as year,
												COUNT(a.id_lobtype) as tot
										","");
	
		
		$nowyear=$year;
		$kuota=12;
		
		$curUsage[0][0]=0;
		$lastUsage=0;
		$iy=0;
		$sisa=0;
		foreach($yearListQuery->result() as $y)
		{
			$year=$y->year;
			if($year<=$nowyear)
			{
			$lastyear=$year-1;
			
			
			//$this->viewFormTableHeader[2]=$lastyear;
				$this->tableQuery="
						tb_emp u 
					";
					
			//last year report
			$this->tableQuery.="
								LEFT OUTER JOIN
							 (
								SELECT 
									code_user, SUM(dur_lob) AS tot
								FROM            
									tb_lob b INNER JOIN tb_lobtype c ON b.id_lobtype =c.id_lobtype
								WHERE        
									(substr(date0_lob, 1, 4) = '".$lastyear."') AND c.type_lobtype=2 AND b.stat_lob = 1
								GROUP BY code_user) ly ON u.code_user = ly.code_user 
								";
			$this->fieldQuery="	 
						u.nm_emp, 
						u.title_emp,
						CASE WHEN ly.tot is null THEN 0 ELSE ly.tot END AS lastyear, 
						CASE WHEN b1.tot is null THEN 0 ELSE b1.tot END AS jan, 
						CASE WHEN b2.tot is null THEN 0 ELSE b2.tot END AS feb, 
						CASE WHEN b3.tot is null THEN 0 ELSE b3.tot END AS mar, 
						CASE WHEN b4.tot is null THEN 0 ELSE b4.tot END AS apr, 
						CASE WHEN b5.tot is null THEN 0 ELSE b5.tot END AS may, 
						CASE WHEN b6.tot is null THEN 0 ELSE b6.tot END AS jun,
						CASE WHEN b7.tot is null THEN 0 ELSE b7.tot END AS jul,
						CASE WHEN b8.tot is null THEN 0 ELSE b8.tot END AS aug,
						CASE WHEN b9.tot is null THEN 0 ELSE b9.tot END AS sep,
						CASE WHEN b10.tot is null THEN 0 ELSE b10.tot END AS okt,
						CASE WHEN b11.tot is null THEN 0 ELSE b11.tot END AS nov,
						CASE WHEN b12.tot is null THEN 0 ELSE b12.tot END AS des,
						0 AS tot,
						0 AS bal,
						u.code_user as id
						
						";
			
			//current year report
			for($i=1;$i<=12;$i++)
			{
				$curdate=$year."-".sprintf("%02d",$i);
				$this->tableQuery.="
									LEFT OUTER JOIN
								 (
									SELECT 
										code_user, SUM(dur_lob) AS tot
									FROM            
										tb_lob b INNER JOIN tb_lobtype c ON b.id_lobtype =c.id_lobtype
									WHERE        
										(substr(date0_lob, 1, 7) = '".$curdate."') AND c.type_lobtype=2 AND b.stat_lob = 1
									GROUP BY code_user) b".$i." ON u.code_user = b".$i.".code_user 
									";
			}
		
			$this->tableQuery.=" WHERE u.code_user='".$codeUser."' ";
			$renderTemp=$this->CI->Mmain->qRead($this->tableQuery,$this->fieldQuery,"");
			
			$i2=0;
			foreach($renderTemp->result() as $row)
			{	
				$row->tot=$row->jan+$row->feb+$row->mar+$row->apr+$row->may+$row->jun+$row->jul+$row->aug+$row->sep+$row->okt+$row->nov+$row->des;
				
				
				$janmar=$row->jan+$row->feb+$row->mar;
				$aprdes=$row->apr+$row->may+$row->jun+$row->jul+$row->aug+$row->sep+$row->okt+$row->nov+$row->des;
				
				$bal=0;
				if($iy>0)
					$bal=$curUsage[$iy-1][$i2];
			
				if($bal>$janmar)
				{
					$janmar=0;
					$sisa=$kuota-($janmar+$aprdes);
				}
				else
				{
					
					$sisa=$kuota-($janmar-$bal+$aprdes);
				}
				
				$curUsage[$iy][$i2]=$sisa;
				$row->lastyear=$bal;
				$row->bal=$sisa;
				
				
				//$row->nm_emp.=" ".$kurang;
				
				$i2++;
			}
			$iy++;
			}
		}
		
			return $sisa;
	}
	
	public function sendmail($nama,$email,$isi,$subject="Interested Customer")
	{

		require_once 'PHPMailer/src/Exception.php';
		require_once 'PHPMailer/src/PHPMailer.php';
		require_once 'PHPMailer/src/SMTP.php';
		
		
		
        $fromEmail = "no-reply@ptmdr.co.id";
		
        if($isi == "")
		{
        $isiEmail = 	"Dear " .$nama . " (".$email."),  <br><br>";
        $isiEmail .= 	"Thank you for contacting us, we will reply to your message shortly.  <br><br>";
        $isiEmail .= 	"Warm Regards,  <br>";
        $isiEmail .= 	"Mangli Djaya Raya Support Team  <br><br><br>";
        $isiEmail .= 	"<i>please do not reply to this email.</i>";
		}
		else
			$isiEmail = $isi;
		
        $mail = new PHPMailer();
		

        $mail->IsHTML(true);    // set email format to HTML
        $mail->IsSMTP();   // we are going to use SMTP
        $mail->SMTPAuth   = true; // enabled SMTP authentication
		$mail->SMTPDebug = false;
		
        $mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
		
		if (version_compare(PHP_VERSION, '5.6.0') >= 0) {
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true,
				),
			);
		}
		
        $mail->Host       = "mail.ptmdr.co.id";      // setting GMail as our SMTP server
        $mail->Port       = 465;                   // SMTP port to connect to GMail
        $mail->Username   = $fromEmail;  // alamat email kamu
        $mail->Password   = "MDRl0gins3cr3t";            // password GMail
        $mail->SetFrom('no-reply@ptmdr.co.id', 'no-reply');  //Siapa yg mengirim email
        $mail->Subject    = $subject;
        $mail->Body       = $isiEmail;
        $toEmail = $email; // siapa yg menerima email ini
        //$toEmail = "info@ptmdr.co.id"; // siapa yg menerima email ini
        $mail->AddAddress($toEmail);
       
        if(!$mail->Send()) {
            echo "Eror: ".$mail->ErrorInfo;
        } else {
            echo "Email berhasil dikirim";
        }   

	}


	public function sendmailback($nama,$email,$isi)
	{

		require_once 'PHPMailer/src/Exception.php';
		require_once 'PHPMailer/src/PHPMailer.php';
		require_once 'PHPMailer/src/SMTP.php';
		
		
		
        $fromEmail = "no-reply@ptmdr.co.id";
		
        
        $isiEmail = 	"Dear Administrator,  <br><br>";
        $isiEmail .= 	"There are new message from  " .$nama . " (".$email.") <br><br>";
        $isiEmail .= 	" ".$isi." <br><br>";
        $isiEmail .= 	"Warm Regards,  <br>";
        $isiEmail .= 	"Mangli Djaya Raya Support Team  <br><br><br>";
        $isiEmail .= 	"<i>please do not reply to this email.</i>";
		
        $mail = new PHPMailer();
		

        $mail->IsHTML(true);    // set email format to HTML
        $mail->IsSMTP();   // we are going to use SMTP
        $mail->SMTPAuth   = true; // enabled SMTP authentication
		$mail->SMTPDebug = false;
		
        $mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
		
		if (version_compare(PHP_VERSION, '5.6.0') >= 0) {
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true,
				),
			);
		}
		
        $mail->Host       = "mail.ptmdr.co.id";      // setting GMail as our SMTP server
        $mail->Port       = 465;                   // SMTP port to connect to GMail
        $mail->Username   = $fromEmail;  // alamat email kamu
        $mail->Password   = "MDRlogins3cr3t";            // password GMail
        $mail->SetFrom('no-reply@ptmdr.co.id', 'no-reply');  //Siapa yg mengirim email
        $mail->Subject    = "Interested Customer";
        $mail->Body       = $isiEmail;
        //$toEmail = "aldila@ptmdr.co.id"; // siapa yg menerima email ini
        $toEmail = "info@ptmdr.co.id"; // siapa yg menerima email ini
        $mail->AddAddress($toEmail);
       
        if(!$mail->Send()) {
            echo "Eror: ".$mail->ErrorInfo;
        } else {
            echo "Email berhasil dikirim";
        }   

	}

//check file extension
	public function checkExtension($filename,$folderName,$viewLink,$id="")
	{
		$retVal="";
		
		$ext=strtolower(substr($filename,strlen($filename)-3,3));
					
		if($ext=="pdf")
			$retVal="<a target='_blank' href='".base_url().$folderName.$filename."' >".$filename."</a>";
		else
		if($ext=="jpg" || $ext=="png" || $ext=="bmp" || $ext=="gif" || strtolower(substr($filename,strlen($filename)-4,4))=="jpeg")
		{
			//$retVal="<a data-toggle='tooltip' title='Open File ".$filename."' href='".base_url().$viewLink."/printPDF/".$id."/".$filename."' target='_blank'><img src='".base_url().$folderName.$filename."' width='200px'></a>";
			$retVal="<a data-toggle='tooltip' title='Open File ".$filename."' href='".base_url().$folderName.$filename."' target='_blank'><img src='".base_url().$folderName.$filename."' width='200px'></a>";
			
		}
		else
		if($ext=="mkv" || $ext=="mp4" || $ext=="flv" || $ext=="bmp" || $ext=="mov" )
			$retVal="<a target='_blank' href='".base_url().$folderName.$filename."' title='Putar ".$filename."' class='fa fa-film fa-2x' >&nbsp;</a>";
		else
		if($ext=="xls" || strtolower(substr($filename,strlen($filename)-4,4))=="xlsx"  )
			$retVal="<a target='_blank' href='".base_url().$folderName.$filename."' title='Buka ".$filename."'  >".$filename."</a>";
		else
			$retVal="<a target='_blank' href='".base_url().$folderName.$filename."' title='Buka ".$filename."' >".$filename."</a>";
		
		return $retVal;
	}
	
}

?>