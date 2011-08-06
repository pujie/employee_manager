<?php
class Read_excel extends CI_Controller{
	var $lineseparator='\n';
	var $fieldseparator=',';
	var $csv_file;
	var $size;
	function __construct(){
		parent::__construct();
		$this->load->helper('file');
		$this->csv_file='C:\Users\Baltix\Documents\tes.csv';
	}
	function read_file(){
		if(!file_exists($this->csv_file)){
			echo 'File does not exist';
		}
		$this->size=filesize($this->csv_file);
		if(!$this->size){
			echo 'the file is empty';
		}
		else{
		
		
		
			$csvcontent	=	read_file($this->csv_file);
			echo $csvcontent . '<br><br>';
			$lines=explode(' \n',$csvcontent);
			foreach($lines as $line){
				echo $line . '<br>';
			};
			
			echo 'satu duda \\r tiga';
		}
	}
	function fileopen(){
		$file=fopen($this->csv_file,'r');
		$size=filesize($this->csv_file);
		$str	=	fread($file,$size);
		$lines	=	explode(' ',$str);
		foreach($lines as $line){
			echo $line . '<br>';
		}
		// $num=12300;
		
	}
}