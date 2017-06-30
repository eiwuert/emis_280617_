<?php 

function get_pa_collaborations_tempalte_manage_table($templates, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
   	$headers = array('<input type="checkbox" id="select_all" />',
        lang('pa_collaboration_template_id'),
        lang('pa_collaboration_template_title'),
        lang('pa_collaboration_template_created'),
        // '&nbsp',
        lang('checklist_action'));
    
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
    
    $table.='</tr></thead><tbody>';
    $table.=get_pa_collaborations_tempalte_manage_table_data_rows($templates, $controller);
    $table.='</tbody></table>';
    return $table;
}
/*
  Gets the html data rows for the meeting.
 */

function get_pa_collaborations_tempalte_manage_table_data_rows($templates, $controller) {
     $CI = & get_instance();
    $table_data_rows = '';

    foreach ($templates->result() as $template) {
        $table_data_rows.= get_pa_collaborations_tempalte_data_row($template, $controller);
    }

    if ($templates->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='7'><span class='col-md-12 text-center text-warning' >" . lang('checklist_no_checklist_template_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_pa_collaborations_tempalte_data_row($template, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
 
 	$table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox'  id='template_$template->id' value='" . $template->id. "'/></td>";
    $table_data_row.='<td>' . $template->id . '</td>';
     $table_data_row.='<td >' . H($template->template_name) . '</td>';
    $table_data_row.='<td>' .date('d-m-Y', strtotime($template->created)). '</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';

    $table_data_row.=anchor($controller_name . "/preview/$template->id", '<i class="ace-icon fa fa-search-plus bigger-150"></i>', array('target'=>"_blank", 'class' => 'detail-checklist-template', 'title' => lang('checklist_detail')));
    if ($CI->Employee->has_module_action_permission($controller_name, 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id)) {
        $table_data_row.=anchor($controller_name . "/view/$template->id/2", '<i class="ace-icon fa fa-pencil bigger-150"></i>', array('class' => 'update-checklist-template green', 'title' => lang('checklist_update')));
    }
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}
// colllaborations project agreement list

function get_pa_collaborations_manage_table($templates, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
    $headers = array('<input type="checkbox" id="select_all" />',
        lang('pa_collaborations_No'),
        lang('pa_collaborations_agreements'),
        lang('pa_collaborations_party'),
        lang('pa_collaborations_Project_title'),
        lang('pa_collaborations_Project_client'),
        lang('pa_collaboration_other_partner'),
        // '&nbsp',
        lang('checklist_action'));
    
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
    
    $table.='</tr></thead><tbody>';
    $table.=get_pa_collaborations_manage_table_data_rows($templates, $controller);
    $table.='</tbody></table>';
    return $table;
}
/*
  Gets the html data rows for the meeting.
 */

function get_pa_collaborations_manage_table_data_rows($pa_collaborations, $controller) {
     $CI = & get_instance();
    $table_data_rows = '';

    foreach ($pa_collaborations->result() as $pa_collaboration) {
        $table_data_rows.= get_pa_collaborations_data_row($pa_collaboration, $controller);
    }

    if ($pa_collaborations->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='7'><span class='col-md-12 text-center text-warning' >" . lang('pa_collaborations_no_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_pa_collaborations_data_row($pa_collaboration, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
 
    $table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox'  id='template_$pa_collaboration->pa_id' value='" . $pa_collaboration->pa_id. "'/></td>";
    $table_data_row.='<td >' . H($pa_collaboration->pa_no) . '</td>';
    $table_data_row.='<td >' . H($pa_collaboration->ca_id) . '</td>';
    $table_data_row.='<td>' . H($pa_collaboration->ca_company) . '</td>';
    $table_data_row.='<td>' . H($pa_collaboration->project_title) . '</td>';
    $table_data_row.='<td>' . H($pa_collaboration->pro_company_name) . '</td>';
    $table_data_row.='<td>' . H($pa_collaboration->other_pro_partner) . '</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';
    if ($CI->Employee->has_module_action_permission($controller_name, 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id)) {
        $table_data_row.=anchor($controller_name . "/view/$pa_collaboration->pa_id/2", '<i class="ace-icon fa fa-pencil bigger-150"></i>', array('class' => 'update-checklist-template green', 'title' => lang('checklist_update')));
    }
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}

// consultant project agreement template manage table

function get_pa_consultant_template_manage_table($templates, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
    $headers = array( '<input type="checkbox" id="select_all" />',
        lang('pa_collaboration_template_id'),
        lang('pa_collaboration_template_title'),
        lang('pa_collaboration_template_created'),
        // '&nbsp',
        lang('checklist_action'));
    
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
    
    $table.='</tr></thead><tbody>';
    $table.=get_pa_consultant_template_manage_table_data_rows($templates, $controller);
    $table.='</tbody></table>';
    return $table;
}
/*
  Gets the html data rows for the template consultant project agreement
 */

function get_pa_consultant_template_manage_table_data_rows($consultant_templates, $controller) {
     $CI = & get_instance();
    $table_data_rows = '';

    foreach ($consultant_templates->result() as $consultant_template) {
        $table_data_rows.= get_pa_consultant_template_data_row($consultant_template, $controller);
    }

    if ($consultant_templates->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='7'><span class='col-md-12 text-center text-warning' >" . lang('pa_consultant_template_no_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_pa_consultant_template_data_row($consultant_template, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
 
    $table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox'  id='template_$consultant_template->id' value='".$consultant_template->id. "'/></td>";
    $table_data_row.='<td>' . $consultant_template->id . '</td>';
    $table_data_row.='<td >' . H($consultant_template->template_name) . '</td>';
    $table_data_row.='<td >' . date('d-m-Y',strtotime($consultant_template->created)) . '</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';

    $table_data_row.=anchor($controller_name . "/preview/$consultant_template->id ", '<i class="ace-icon fa fa-search-plus bigger-150"></i>', array('target'=>"_blank", 'class' => 'detail-checklist-template', 'title' => lang('checklist_detail')));
    if ($CI->Employee->has_module_action_permission($controller_name, 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id)) {
        $table_data_row.=anchor($controller_name . "/view/$consultant_template->id/2", '<i class="ace-icon fa fa-pencil bigger-150"></i>', array('class' => 'update-checklist-template green', 'title' => lang('checklist_update')));
    }
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}


// colllaborations project agreement list

function get_pa_consultants_manage_table($templates, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
    $headers = array( '<input type="checkbox" id="select_all" />',
        lang('pa_collaborations_No'),
        lang('pa_consultant_mc'),
        lang('pa_consultant_assonciative'),
        lang('pa_collaborations_Project_title'),
        lang('pa_collaborations_Project_client'),
        lang('pa_collaboration_other_partner'), 
        lang('checklist_action'));
    
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
    
    $table.='</tr></thead><tbody>';
    $table.=get_pa_consultants_manage_table_data_rows($templates, $controller);
    $table.='</tbody></table>';
    return $table;
}
/*
  Gets the html data rows for the meeting.
 */

function get_pa_consultants_manage_table_data_rows($pa_collaborations, $controller) {
     $CI = & get_instance();
    $table_data_rows = '';

    foreach ($pa_collaborations->result() as $pa_collaboration) {
        $table_data_rows.= get_pa_consultants_data_row($pa_collaboration, $controller);
    }

    if ($pa_collaborations->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='7'><span class='col-md-12 text-center text-warning' >" . lang('pa_consultant_no_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_pa_consultants_data_row($pa_consult, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
 
    $table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox'  id='template_$pa_consult->pa_id' value='".$pa_consult->pa_id. "'/></td>";
    $table_data_row.='<td >' .H($pa_consult->pa_no) . '</td>';
    $table_data_row.='<td >' .H($pa_consult->mc_id) . '</td>';
    $table_data_row.='<td>' .H($pa_consult->mc_name) . '</td>';
    $table_data_row.='<td>' .H($pa_consult->project_title) . '</td>';
    $table_data_row.='<td>' .H($pa_consult->pro_company_name) . '</td>';
    $table_data_row.='<td>' .H($pa_consult->global_partner) . '</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';
    if ($CI->Employee->has_module_action_permission($controller_name, 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id)) {
        $table_data_row.=anchor($controller_name . "/view/$pa_consult->pa_id/2", '<i class="ace-icon fa fa-pencil bigger-150"></i>', array('class' => 'update-checklist-template green', 'title' => lang('checklist_update')));
    }
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}

function get_pa_clients_tempalte_manage_table($templates, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
    $headers = array('<input type="checkbox" id="select_all" />',
        lang('pa_collaboration_template_id'),
        lang('pa_collaboration_template_title'),
        lang('pa_collaboration_template_created'),
        // '&nbsp',
        lang('checklist_action'));
    
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
    
    $table.='</tr></thead><tbody>';
    $table.=get_pa_clients_tempalte_manage_table_data_rows($templates, $controller);
    $table.='</tbody></table>';
    return $table;
}
/*
  Gets the html data rows for the meeting.
 */

function get_pa_clients_tempalte_manage_table_data_rows($templates, $controller) {
     $CI = & get_instance();
    $table_data_rows = '';

    foreach ($templates->result() as $template) {
        $table_data_rows.= get_pa_collaborations_tempalte_data_row($template, $controller);
    }

    if ($templates->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='7'><span class='col-md-12 text-center text-warning' >" . lang('checklist_no_checklist_template_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_pa_clients_tempalte_data_row($template, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
 
    $table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox'  id='template_$template->id' value='" . $template->id. "'/></td>";
    $table_data_row.='<td>' . $template->id . '</td>';
     $table_data_row.='<td >' . H($template->template_name) . '</td>';
    $table_data_row.='<td>' . H($template->created) . '</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';

    $table_data_row.=anchor($controller_name . "/view/$template->id/2", '<i class="ace-icon fa fa-pencil bigger-150"></i>', array('class' => 'update-checklist-template green', 'title' => lang('checklist_update')));
    $table_data_row.=anchor($controller_name . "/delete/$template->id", '<i class="ace-icon fa fa-remove bigger-150 remove-template"></i>', array('class' => 'delete-checklist-template', 'title' => lang('checklist_view')));
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}
// project clients list
function get_pa_clients_manage_table($templates, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
    $headers = array(
        lang('pa_id'),
        lang('pa_collaborations_No'),
        lang('project_clients_name'),
        lang('pa_collaborations_Project_title'),
        lang('pa_collaboration_template_created'),
        lang('checklist_action'));
    
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
    
    $table.='</tr></thead><tbody>';
    $table.=get_pa_clients_manage_table_data_rows($templates, $controller);
    $table.='</tbody></table>';
    return $table;
}
/*
  Gets the html data rows for the meeting.
 */

function get_pa_clients_manage_table_data_rows($templates, $controller) {
     $CI = & get_instance();
    $table_data_rows = '';

    foreach ($templates->result() as $template) {
        $table_data_rows.= get_pa_clients_data_row($template, $controller);
    }

    if ($templates->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='7'><span class='col-md-12 text-center text-warning' >" . lang('checklist_no_checklist_template_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_pa_clients_data_row($template, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    $table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox'  id='template_$template->pa_id' value='" . $template->pa_id. "'/></td>";
    $table_data_row.='<td>' . $template->pa_no . '</td>';
     $table_data_row.='<td >' . H($template->pro_company_name) . '</td>';
    $table_data_row.='<td>' . H($template->project_name) . '</td>';
    $table_data_row.='<td>' .date('d-m-Y', strtotime($template->create_at)). '</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';
    if ($CI->Employee->has_module_action_permission($controller_name, 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id)) {
        $table_data_row.=anchor($controller_name . "/view/$template->pa_id/2", '<i class="ace-icon fa fa-pencil bigger-150"></i>', array('class' => 'update-checklist-template green', 'title' => lang('checklist_update')));    $table_data_row.='</div>';
    }
    $table_data_row.='</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}

// project clients list
function get_es_template_manage_table($templates, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
    $headers = array(' <input type="checkbox" id="select_all" />',
        lang('es_template_id'),
        lang('es_template_name'),
        lang('es_template_created'),
        lang('es_action'),
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
    $table.='</tr></thead><tbody>';
    $table.=get_es_template_manage_table_data_rows($templates, $controller);
    $table.='</tbody></table>';
    return $table;
}
/*
  Gets the html data rows for the meeting.
 */

function get_es_template_manage_table_data_rows($templates, $controller) {
     $CI = & get_instance();
    $table_data_rows = '';

    foreach ($templates->result() as $template) {
        $table_data_rows.= get_es_template_data_row($template, $controller);
    }

    if ($templates->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='7'><span class='col-md-12 text-center text-warning' >" . lang('executive_search_template_template_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_es_template_data_row($template, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    $table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox'  id='template_$template->template_id' value='" . $template->template_id. "'/></td>";
    $table_data_row.='<td>' . $template->template_id . '</td>';
    $table_data_row.='<td >' . H($template->template_name) . '</td>';
    $table_data_row.='<td>' . date("d-m-Y", strtotime($template->created)) . '</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';
    $table_data_row.=anchor($controller_name . "/preview/$template->template_id ", '<i class="ace-icon fa fa-search-plus bigger-150"></i>', array('target'=>"_blank", 'title' => lang('es_preview')));
    if ($CI->Employee->has_module_action_permission($controller_name, 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id)) {
        $table_data_row.=anchor($controller_name . "/view/$template->template_id/2", '<i class="ace-icon fa fa-pencil bigger-150"></i>', array('class' => 'update-checklist-template green', 'title' => lang('checklist_update')));
    }
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}

function get_es_list_manage_table($templates, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
    $headers = array(' <input type="checkbox" id="select_all" />',
        lang('es_id'),
        lang('es_company_name'),
        lang('es_company_address'),
        lang('es_position'),
        lang('es_date'),
        lang('es_action'),
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
    
    $table.='</tr></thead><tbody>';
    $table.=get_es_list_manage_table_data_rows($templates, $controller);
    $table.='</tbody></table>';
    return $table;
}
/*
  Gets the html data rows for the meeting.
 */

function get_es_list_manage_table_data_rows($templates, $controller) {
     $CI = & get_instance();
    $table_data_rows = '';

    foreach ($templates->result() as $template) {
        $table_data_rows.= get_es_list_data_row($template, $controller);
    }

    if ($templates->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='7'><span class='col-md-12 text-center text-warning' >" . lang('executive_search_list_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_es_list_data_row($template, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    $table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox'  id='template_$template->id' value='" . $template->id. "'/></td>";
    $table_data_row.='<td>' . $template->es_code . '</td>';
    $table_data_row.='<td >' . H($template->company_name) . '</td>';
    $table_data_row.='<td>' . H($template->address_1) . '</td>';
    $table_data_row.='<td>' . H($template->position) . '</td>';
    $table_data_row.='<td>' . H(date('d-m-Y',strtotime($template->date))) . '</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';
    if ($CI->Employee->has_module_action_permission($controller_name, 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id)) {
        $table_data_row.=anchor($controller_name . "/view/$template->id/2", '<i class="ace-icon fa fa-pencil bigger-150"></i>', array('class' => 'update-checklist-template green', 'title' => lang('checklist_update')));
    }
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';
    return $table_data_row;
}

// Partnership search template list
function get_caes_tempate_manage_table($templates, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
    $headers = array(' <input type="checkbox" id="select_all" />',
        lang('caes_template_id'),
        lang('caes_template_name'),
        lang('caes_template_date'),
        lang('caes_action'),
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
    $table.='</tr></thead><tbody>';
    $table.=get_caes_tempate_manage_table_data_rows($templates, $controller);
    $table.='</tbody></table>';
    return $table;
}
/*
  Gets the html data rows for the caes template.
 */

function get_caes_tempate_manage_table_data_rows($templates, $controller) {
     $CI = & get_instance();
    $table_data_rows = '';

    foreach ($templates->result() as $template) {
        $table_data_rows.= get_caes_tempate_data_row($template, $controller);
    }

    if ($templates->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='7'><span class='col-md-12 text-center text-warning' >" . lang('partnership_search_template_template_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_caes_tempate_data_row($template, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    $table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox'  id='template_$template->template_id' value='" . $template->template_id. "'/></td>";
    $table_data_row.='<td>' . $template->template_id . '</td>';
    $table_data_row.='<td >' . H($template->template_name) . '</td>';
    $table_data_row.='<td>' . date('d-m-Y', strtotime($template->created)) . '</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';
    $table_data_row.=anchor($controller_name . "/preview/$template->template_id ", '<i class="ace-icon fa fa-search-plus bigger-150"></i>', array('target'=>"_blank", 'title' => lang('es_preview')));
    if ($CI->Employee->has_module_action_permission($controller_name, 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id)) {
        $table_data_row.=anchor($controller_name . "/view/$template->template_id/2", '<i class="ace-icon fa fa-pencil bigger-150"></i>', array('class' => 'update-checklist-template green', 'title' => lang('checklist_update')));
    }
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}

// CAES list
function get_partnership_search_list_manage_table($templates, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
    $headers = array(' <input type="checkbox" id="select_all" />',
        lang('caes_code'),
        lang('case_company_name'),
        lang('case_company_partner'),
        lang('case_company_reg'),
        lang('case_company_address'),
        lang('caes_action'),
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
    $table.='</tr></thead><tbody>';
    $table.=get_partnership_search_list_manage_table_data_rows($templates, $controller);
    $table.='</tbody></table>';
    return $table;
}
/*
  Gets the html data rows for the caes list.
 */

function get_partnership_search_list_manage_table_data_rows($templates, $controller) {
     $CI = & get_instance();
    $table_data_rows = '';

    foreach ($templates->result() as $template) {
        $table_data_rows.= get_partnership_search_list_data_row($template, $controller);
    }

    if ($templates->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='7'><span class='col-md-12 text-center text-warning' >" . lang('partnership_search_list_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_partnership_search_list_data_row($template, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    $table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox'  id='template_$template->caes_id' value='" . $template->caes_id. "'/></td>";
    $table_data_row.='<td>' . $template->caes_code . '</td>';
    $table_data_row.='<td >' . H($template->client_name) . '</td>';
    $table_data_row.='<td>' . H($template->colla_name) . '</td>';
    $table_data_row.='<td>' . H($template->company_reg) . '</td>';
    $table_data_row.='<td>' . H($template->address) . '</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';
    if ($CI->Employee->has_module_action_permission($controller_name, 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id)) {
        $table_data_row.=anchor($controller_name . "/view/$template->caes_id/2", '<i class="ace-icon fa fa-pencil bigger-150"></i>', array('class' => 'update-checklist-template green', 'title' => lang('checklist_update')));
    }
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>'; 
    return $table_data_row;
}


// candidate management list
function get_candidate_management_manage_table($templates, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
    $headers = array(lang('recruitment_applicant_name'),
        lang('recruitment_gender'),
        lang('recruitment_job_title'),
        lang('recruitment_apply_date'),
        lang('recruitment_industry'),
        lang('recruitment_category'),
        lang('recruitment_telephone'),
        lang('recruitment_resume'),
        lang('recruitment_action'),
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
    $table.='</tr></thead><tbody>';
    $table.=get_candidate_management_manage_table_data_rows($templates, $controller);
    $table.='</tbody></table>';
    return $table;
}
/*
  Gets the html data rows for the caes list.
 */

function get_candidate_management_manage_table_data_rows($templates, $controller) {
     $CI = & get_instance();
    $table_data_rows = '';

    foreach ($templates->result() as $template) {
        $table_data_rows.= get_candidate_management_data_row($template, $controller);
    }

    if ($templates->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='9'><span class='col-md-12 text-center text-warning' >" . lang('partnership_search_list_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_candidate_management_data_row($recruitment, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    $table_data_row = '<tr>';
    // $table_data_row.="<td><input type='checkbox'  id='template_$recruitment->app_id' value='" . $recruitment->app_id. "'/></td>";
    $table_data_row.='<td>' . H($recruitment->applicant_name) . '</td>';
    $table_data_row.='<td >' . H($recruitment->gender) . '</td>';
    $table_data_row.='<td>' . H($recruitment->apply_for) . '</td>';
    $table_data_row.='<td>' . H(date('d-m-Y', strtotime($recruitment->created_at))) . '</td>';
    $table_data_row.='<td>' . H($recruitment->industry) . '</td>';
    $table_data_row.='<td>' . H($recruitment->category) . '</td>';
    $table_data_row.='<td>' . H($recruitment->phone) . '</td>';
    $table_data_row.='<td>' . anchor(site_url() . "/uploads/$recruitment->docs_name",  H($recruitment->docs_name),array('target'=> '_blank')) .'</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';
    $table_data_row.=anchor($controller_name . "/view/$recruitment->app_id", '<i class="ace-icon fa fa-pencil bigger-150"></i>', array('class' => 'update-checklist-template green', 'title' => lang('checklist_update')));   
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>'; 
    return $table_data_row;
}