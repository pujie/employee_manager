<?php
class Lib_table{
	var $column_alignment;
	function set_head($heads){
		$list='';
		foreach($heads as $head){
			$list.='<th>' . $head . '</th>';
		}
		return '<thead class="thead-display"><tr>' . $list . '</tr></thead>';
	}
	function set_body($bodies){
		$tr_array='';
		$k=0;
			foreach($bodies as $tr){
				$td_array='';
				$c=0;
				foreach($tr as $td){
					if (!empty($this->column_alignment[$c])){
					$td_array.='<td align=' . $this->column_alignment[$c] . '>' . $td . '</td>';
					}
					else{
					$td_array.='<td>' . $td . '</td>';
					}
					$c++;
				}
				if ($k%2==0)
				{
					$tr_array.='<tr class="lib_table_body_even">' . $td_array . '</tr>';
				}else{
					$tr_array.='<tr class="lib_table_body_odd">' . $td_array . '</tr>';
				}
				$k++;
			}
		return '<tbody>' . $tr_array . '</tbody>';
	}
	function set_alignment($col,$alignment){
		$this->column_alignment[$col]=$alignment;
	}
	function set_table($table_id,$head,$body){
		return '<table id=' . $table_id . ' class="table-display">' . $this->set_head($head) . $this->set_body($body) . '</table>';
	}
}