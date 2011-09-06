<?php
class Activity_logs extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('activity_log');
	}
	function index(){
		if($this->uri->segment(2)==null){
			redirect('activity_logs/index/act_date/asc/0');
		}
		$order_field=$this->uri->segment(3);
		$order=$this->uri->segment(4);
		$page=$this->uri->segment(5);
		switch($order){
			case 'asc':
				$order='desc';
				break;
			case 'desc':
				$order='asc';
				break;
			default:
				$order='asc';
		}
		$activity_log=new Activity_log();
		switch ($order_field){
			case 'user_id':
				$total_rows=$activity_log->order_by_related('user','username',$order)->count();
				$activity_log->order_by_related('user','username',$order)->get(10,$page);
				break;
			default:
				$total_rows=$activity_log->order_by($order_field,$order)->count();
				$activity_log->order_by($order_field,$order)->get(10,$page);					
		}
		$pagination=array(
			'total_rows'=>$total_rows,
			'uri_segment'=>5,
			'base_url'=>base_url() . 'index.php/activity_logs/index/' . $order_field . '/' . $this->uri->segment(4),
			'per_page'=>10);
		$this->pagination->initialize($pagination);
		$list=array();
		foreach($activity_log as $log){
		array_push($list,array($log->id,$log->act,$log->act_date,$log->user->username));
		}
		$data	=	array(
			'list'=>$list,
			'navigator'=>array(array(anchor('/','Home','class="button"'),anchor('front_page/logout','Logout','class="button"'))),
			'header'=>array(
				anchor('activity_logs/index/id/' . $order, 'ID'),
				anchor('activity_logs/index/act/' . $order, 'Description'),
				anchor('activity_logs/index/act_date/' . $order,'Date'),
				anchor('activity_logs/index/user_id/' . $order,'User Name')),
			);
		$this->load->view('activity_logs/index',$data);
	}
	function find_handler(){
		$params=$this->input->post();
		if(isset($params['submit'])){
			echo $params['search'];
			if($params['search']==''){
				redirect('activity_logs/index/act_date/asc');
			}
			redirect('activity_logs/search/' . $params['search'] . '/act_date/asc');
		}
		if(isset($params['resetsubmit'])){
			redirect('activity_logs/index/act_date/asc');
		}
	}
	function search(){
		if($this->uri->segment(2)==null){
			redirect('activity_logs/index/act_date/asc');
		}
		$search_parameter=$this->uri->segment(3);
		$order_field=$this->uri->segment(4);
		$order=$this->uri->segment(5);
		$page=$this->uri->segment(6);
		switch($order){
			case 'asc':
				$order='desc';
				break;
			case 'desc':
				$order='asc';
				break;
			default:
				$order='asc';
		}
		$activity_log=new Activity_log();
		switch ($order_field){
			case 'user_id':
				$total_rows=$activity_log->
					ilike('act_date',$search_parameter)->
					or_ilike('act',$search_parameter)->
					or_ilike_related('user','username',$search_parameter)->get()->
					result_count();
				$activity_log->
					ilike('act_date',$search_parameter)->
					or_ilike('act',$search_parameter)->
					or_ilike_related('user','username',$search_parameter)->
					order_by_related('user','username',$order)->get(10,$page);
				break;
			case 'act_date':
				$total_rows=$activity_log->
					ilike('act_date',$search_parameter)->
					or_ilike('act',$search_parameter)->
					or_ilike_related_user('username',$search_parameter)->get()->result_count();
				$activity_log->
					ilike('act_date',$search_parameter)->
					or_ilike('act',$search_parameter)->
					or_ilike_related_user('username',$search_parameter)->
					order_by('act_date',$order)->get(10,$page);
				break;
				
			default:
//				$activity_log->order_by($order_field,$order)->get();
				$total_rows=$activity_log->
					ilike('act_date',$search_parameter)->
					or_ilike('act',$search_parameter)->
					or_ilike_related('user','username',$search_parameter)->get()->
					result_count();
				$activity_log->
					ilike('act_date',$search_parameter)->
					or_ilike('act',$search_parameter)->
					or_ilike_related('user','username',$search_parameter)->
					order_by($order_field,$order)->get(10,$page);
				break;
				
		}
		$pagination=array(
			'total_rows'=>$total_rows,
			'base_url'=>base_url() . 'index.php/activity_logs/search/' . $search_parameter . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5),
			'uri_segment'=>6,
			'per_page'=>10);
		$this->pagination->initialize($pagination);
		$list=array();
		foreach($activity_log as $log){
		array_push($list,array($log->id,$log->act,$log->act_date,$log->user->username));
		}
		$data	=	array(
			'list'=>$list,
			'navigator'=>array(array(anchor('/','Home','class="button"'),anchor('front_page/logout','Logout','class="button"'))),
			'header'=>array(
				anchor('activity_logs/search/' . $search_parameter  . '/' . $order_field . '/' . $order, 'ID'),
				anchor('activity_logs/search/' . $search_parameter .  '/' . $order_field . '/' . $order, 'Description'),
				anchor('activity_logs/search/' . $search_parameter  . '/' . $order_field . '/' . $order, 'Date'),
				anchor('activity_logs/search/' . $search_parameter  . '/' . $order_field . '/' . $order, 'User Name')),
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