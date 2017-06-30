<?php

function get_table_schedule($table_data,$contorller){

	$CI = & get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
    $headers = array(

        lang('common_no'),
        lang('schedule_time'),
        lang('schedule_day'),
        lang('common_action')
    );
    $table.='<thead><tr>';
    $count = 0;
    foreach ($headers as $header) {
        $count++;

        if ($count == 1) {
            $table.="<th class='leftmost'>$header</th>";
        } elseif ($count == count($headers)) {
            $table.="<th class='rightmost'>$header</th>";
        } else {
            $table.="<th>$header</th>";
        }
    }
    $table.="</tr></thead><tbody>";
    $i = 0;

    foreach($table_data as $key=>$value){
	$i++;    	
    $table.= "<tr>";
    $table.="<td>".$i."</td>";
    $table.="<td>".$value->time."</td>";
    $table.="<td>".$value->day."</td>";
    $table.="<td><div class='action-buttons'><a href='".site_url($controller_name)."/view/".$value->id."' class='update-room green' title='Update'><i class='ace-icon fa fa-pencil bigger-180'></i></a></div></td>";
    $table.="</tr>";

   	}

    $table.='</tbody></table>';
	

	return $table;

}
