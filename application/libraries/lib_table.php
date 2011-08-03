<?php
class Lib_table{
function set_head($heads){
	$list='';
	foreach($heads as $head){
		$list.='<th>' . $head . '</th>';
	}
	return '<thead><tr>' . $list . '</tr></thead>';
}
function set_body($bodies){
	$tr_array='';
		foreach($bodies as $tr){
			$td_array='';
			foreach($tr as $td){
				$td_array.='<td>' . $td . '</td>';
			}
			$tr_array.='<tr">' . $td_array . '</tr>';
		}
		return '<tbody>' . $tr_array . '</tbody>';
	}
	function set_table($table_id,$head,$body){
		return '<table id=' . $table_id . ' class="display">' . $this->set_head($head) . $this->set_body($body) . '</table>';
	}
}