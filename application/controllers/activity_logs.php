<?php
class Activity_logs extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('activity_log');
	}
	function index(){
		$activity_log=new Activity_log();
		$activity_log->get();
		$list=array();
		foreach($activity_log as $log){
		array_push($list,array($log->id,$log->act,$log->act_date,$log->user->username));
		}
		$data	=	array(
			'list'=>$list,
			'navigator'=>array(array(anchor('/','Home','class="button"'),anchor('front_page/logout','Logout','class="button"'))),
			);
		$this->load->view('activity_logs/index',$data);
	}
	function add(){
		$log=new Activity_log();
		$log->act='test';
		$log->user_id=1;
		$log->act_date='2011-08-15';
		$log->save();
	}
}