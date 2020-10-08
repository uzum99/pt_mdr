<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();			
		$this->load->library('Commonfunction','','fn');
		
    }
		 
	public function index()
	{
		if(!isset($this->session->userdata['codeUser']))
		{
			$this->load->view('page_login');
		}
		else
		{
			redirect('admin', 'refresh');
			
		}
	}
	
	public function logon()
	{
		
		$username=$this->input->post("username");
		$password=$this->input->post("password");
		//$this->load->model('Mlogin');
		
		//check login
		$this->load->database();
		$this->load->model('Mmain');
		$userdata=null;
		
		/*
		$options = [
			'cost' => 11,
			'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
		];
		
		$hashedPassword=password_hash("ptmdr", PASSWORD_BCRYPT, $options);
				echo $hashedPassword;
		
			if (password_verify("Kingofpirate9889MiO",$hashedPassword))
			{
				echo $hashedPassword;
			}
		*/
		$tb=" tb_user AS a 
			INNER JOIN tb_emp AS e ON a.code_user = e.code_user
			INNER JOIN tb_loc AS l ON e.id_loc = l.id_loc
			WHERE a.nm_user = ".$this->db->escape($username)."  AND e.show_emp = 1 ";
		$sel=" 
		e.nm_emp, 
		a.code_user, 
		a.ava_user, 
		a.nm_user,
		a.jd_user,
		a.id_acc,
		a.pwd_user,
		e.id_emp,
		e.nik_emp,
		e.id_loc,
		l.nm_loc,
		e.title_emp,
		e.about_emp,
		e.id_div,
		e.id_dept
		";
		$query=$this->Mmain->qRead($tb,$sel,"");
		$loginSuccess=0;
		if($query->num_rows() > 0)
		{		    
			foreach($query->row() as $col)
			{
				$userdata[]=$col;
			}
		   
			if (password_verify($password,$userdata[6]))
			{
				$loginSuccess=1;
			}
		}
		
		if($loginSuccess==1)
		{
			if(empty($userdata[3]))
				$userdata[3]="def.jpg";
			
			$frmtes=$this->fn->getFormGroup($userdata[5]);
			$frmList=null;
			$frmHead=null;
			foreach($frmtes->result() as $row)
			{					
				$frmList[]=$row;
			}
			
			$frmtes=$this->fn->getFormGroupHeader($userdata[5]);
			foreach($frmtes->result() as $row)
			{					
				$frmHead[]=$row;
			}
			
			$this->session->set_userdata(array(
				'name' => $userdata[0],
				'codeUser' => $userdata[1],
				'picUser' => $userdata[2],
				'username' => $userdata[3],
				'joinDate' => $userdata[4],
				'accUser' => $userdata[5],
				'idEmp' => $userdata[7],
				'nik' => $userdata[8],
				'loc' => $userdata[9],
				'locName' => $userdata[10],
				'title' => $userdata[11],
				'level' => $userdata[12],
				'id_div' => $userdata[13],
				'id_dept' => $userdata[14],
				'frmList' => $frmList,
				'frmHead' => $frmHead
				
				
				));
				
			$currentDateTime=date("Y-m-d h:i:s");
			//echo $currentDateTime;
			//change last login				
			// $this->Mmain->qUpdpart("tb_user",Array("code_user"),Array($userdata[1]),Array("isonline_user","lastlogin_user"),Array(1,$currentDateTime));
					
			$this->session->sess_expiration = '32140800'; //~ one year
			$this->session->sess_expire_on_close = 'false';
			
			//echo count($this->session->userdata('frmList'));
			//set form list
			//$this->fn->getFormGroup($userdata[2]);
					//echo  implode("<br>",$userdata);
					//echo  $userdata[5];
			redirect('admin', 'refresh');
		}
		else
		{
			
			//echo $userdata[6];
			$tes['errVar']=1;
			$this->load->view('page_login',$tes);
		}
	}
	
	
	
	public function logout()
	{
			session_destroy();
			redirect('main', 'refresh');
	}
}
