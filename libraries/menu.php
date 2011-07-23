<?php
class Menu{
	public $outputmenu = '';
	function __construct(){
		$obj = & get_instance();
		$obj->load->helper('url');
	}
	function create_menu($param){
		$menu = '<table>';
		$menu .= '<tbody>';
		$menu .= '<tr>';
		foreach($param as $prm){
			$menu .= $prm;
		}
		$menu .= '</tr>';
		$menu .= '</tbody>';
		$menu .= '</table>';
		$this->outputmenu=$menu;
	}
	function show_menu(){
		return $this->outputmenu;
	}
}
class MenuHeader{
	function header($menu_name,$param){
		$menu = '<td class="menuheader">' . $menu_name;
		$menu .= '<ul class="menudetail">';
		foreach($param as $prm){
			$menu .= '<li>' . $prm . '</li>';
		}
		$menu .= '</ul>';
		$menu .= '</td>';
		return $menu;
	}
}