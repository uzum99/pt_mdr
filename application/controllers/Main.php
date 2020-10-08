<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Commonfunction','','fn');
				
	}
	public function index()
	{
		
		//init modal
		$this->load->database();
		$this->load->model('Mmain');
		/*
		//get website setting
		$output['setting']=$this->Mmain->qRead(
										"tb_setting
										",
										"","");
										
										
		//get chart
		$output['charts']=$this->Mmain->qRead(
										"tb_chart as a ORDER BY rank
										",
										"
										
										a.id_chart as id,
										a.date_chart as date,
										a.rank_chart as rank,
										a.singer_chart as singer,
										a.title_chart as title,
										a.album_chart as album,
										a.last_chart as last,
										a.week_chart as week
										","");
										
														
										
		//get program
		$output['programs']=$this->Mmain->qRead(
										"
											tb_program AS a 
											INNER JOIN tb_emp as b ON a.id_emp = b.id_emp
											INNER JOIN tb_user as c ON b.code_user = c.code_user
										",
										"
											a.id_program as id,
											a.days_program as days,
											a.from_program as froms,
											a.to_program as tos,
											a.title_program as title,
											a.summary_program as summary,
											a.content_program as content,
											b.nm_emp as nm,
											a.pic_program as pic,
											c.ava_user as ava
										","");
										
		//get jember update
		$output['jupdate']=$this->Mmain->qRead(
										"
										tb_jupdate AS a INNER JOIN tb_emp AS b ON a.id_emp = b.id_emp WHERE a.stat_jupdate=1 
										",
										"
										
										a.id_jupdate as id,
										a.date_jupdate as date,
										b.nm_emp as nm,
										a.title_jupdate as tit,
										a.cont_jupdate as cont,
										a.stat_jupdate as st,
										a.ke_jupdate as ke
										","");
										
		$output['sponsor']=$this->Mmain->qRead(
										"tb_sponsor WHERE stat_sponsor =1",
										"","");
										
		$output['mitra']=$this->Mmain->qRead(
										"tb_mitra WHERE stat_mitra =1",
										"","");
										
										
		$output['iklan']=$this->Mmain->qRead(
										"tb_iklan WHERE stat_iklan =1",
										"","");
										
		$output['announcer']=$this->Mmain->qRead(
										"tb_announcer",
										"","");
		
		$output['events']=$this->Mmain->qRead(
										"tb_events AS a INNER JOIN tb_emp AS b ON a.code_user = b.code_user ORDER BY date DESC LIMIT 0,3 ",
										"a.id_events AS id,a.title_events AS title,a.date_events AS date,a.summary_events AS content,a.pic_events AS pic,b.nm_emp AS emp,a.stat_events AS stat","");
										
		//$this->fn->addViewCount("Website");
		//$this->load->view('header',$output);
		*/
		redirect("Admin","refresh");
	}
		
}
