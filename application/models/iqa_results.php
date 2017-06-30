<?php
class Iqa_results extends CI_Model {
    function get_all($limit=10000, $offset=0, $col='id', $order='desc')
    {
        $iqa_results = $this->db->dbprefix('iqa_results');
        $people = $this->db->dbprefix('people');
        $employees = $this->db->dbprefix('employees');
        $evaluate_types = $this->db->dbprefix('evaluate_types');
        $data = $this->db->query("SELECT *,".$iqa_results.".id as iqa_result_id
                        FROM " . $iqa_results . "
                        LEFT JOIN ".$employees." ON ".$employees.".id = ".$iqa_results.".evaluate_to  
                        LEFT JOIN " . $people . " ON " . $people . ".person_id = " . $employees . ".person_id 
                        LEFT JOIN " . $evaluate_types . " ON " . $evaluate_types . ".id = " . $iqa_results . ".evaluate_type_id 
                        WHERE ".$iqa_results.".is_status = 0
                        GROUP BY `evaluate_type_id`, `evaluate_to` 
                        ORDER BY ". $iqa_results ."." . $col . " " . $order . " 
                        LIMIT  " . $offset . "," . $limit);
        return $data;
    }
    function count_all()
    {
        $this->db->from('iqa_results');
        $this->db->group_by(['evaluate_to', 'evaluate_type_id']);
        $this->db->where('is_status', 0);
        return $this->db->get()->num_rows();
    }












    function get_all_byRoom($limit=10000, $offset=0, $col='id', $order='desc',$byRoom)
    {
        $iqa_results = $this->db->dbprefix('iqa_results');
        $people = $this->db->dbprefix('people');
        $employees = $this->db->dbprefix('employees');
        $evaluate_types = $this->db->dbprefix('evaluate_types');
        $data = $this->db->query("SELECT *,".$iqa_results.".id as iqa_result_id
                        FROM " . $iqa_results . "
                        LEFT JOIN ".$employees." ON ".$employees.".id = ".$iqa_results.".evaluate_to  
                        LEFT JOIN " . $people . " ON " . $people . ".person_id = " . $employees . ".person_id 
                        LEFT JOIN " . $evaluate_types . " ON " . $evaluate_types . ".id = " . $iqa_results . ".evaluate_type_id 
                        WHERE ".$iqa_results.".is_status = 0 AND ".$iqa_results.".evaluate_for = ".$byRoom."
                        GROUP BY `evaluate_type_id`, `evaluate_to` 
                        ORDER BY ". $iqa_results ."." . $col . " " . $order . " 
                        LIMIT  " . $offset . "," . $limit);
        return $data;
    }
    function count_all_byRoom($byRoom)
    {
        $this->db->from('iqa_results');
        $this->db->group_by(['evaluate_to', 'evaluate_type_id']);
        $this->db->where('is_status', 0);
        $this->db->where('evaluate_for', $byRoom);
        return $this->db->get()->num_rows();
    }

    function search_count_all($search, $search_frm, $limit=10000)
    {
        $this->db->from('iqa_results');
        $this->db->join('people', 'iqa_results.evaluate_to = people.person_id');
        $this->db->where("(first_name LIKE '%".$this->db->escape_like_str($search)."%' 
            OR last_name LIKE '%".$this->db->escape_like_str($search)."%' 
            OR CONCAT(`last_name`,' ',`first_name`) LIKE '%".$this->db->escape_like_str($search)."%') 
            AND edu_iqa_results.is_status = 0 ");
        if ($search_frm['select_iqa'] != '') {
            $this->db->where('evaluate_type_id', $search_frm['select_iqa']);
        }
        if ($search_frm['from_date'] != '') {
            $this->db->where('date_from >=', $search_frm['from_date']);
        }
        if ($search_frm['to_date'] != '') {
            $this->db->where('date_from <=', $search_frm['to_date']);
        }
        $this->db->group_by(['evaluate_to', 'evaluate_type_id']);
        $this->db->limit($limit);
        $result = $this->db->get();
        return $result->num_rows();
    }
    function search($search, $search_frm, $limit=20, $offset=0, $column='id', $orderby='desc')
    {
        $this->db->from('iqa_results');
        $this->db->join('people', 'iqa_results.evaluate_to = people.person_id');
        $this->db->join('evaluate_types', 'iqa_results.evaluate_type_id = evaluate_types.id');
        $this->db->where("(first_name LIKE '%".$this->db->escape_like_str($search)."%' 
            OR last_name LIKE '%".$this->db->escape_like_str($search)."%' 
            OR CONCAT(`last_name`, ' ',`first_name`) LIKE '%".$this->db->escape_like_str($search)."%') 
            AND edu_iqa_results.is_status = 0 ");
        if ($search_frm['select_iqa'] != '') {
            $this->db->where('evaluate_type_id', $search_frm['select_iqa']);
        }
        if ($search_frm['from_date'] != '') {
            $this->db->where('date_from >=', $search_frm['from_date']);
        }
        if ($search_frm['to_date'] != '') {
            $this->db->where('date_from <=', $search_frm['to_date']);
        }
        $this->db->group_by(['evaluate_to', 'evaluate_type_id']);
        $this->db->order_by('iqa_results.'.$column, $orderby);
        $this->db->limit($limit);
        $this->db->offset($offset);
        return $this->db->get();
    }
    function search_count_all_byRoom($search, $search_frm, $limit=10000, $byRoom)
    {
        $this->db->from('iqa_results');
        $this->db->join('people', 'iqa_results.evaluate_to = people.person_id');
        $this->db->where("(first_name LIKE '%".$this->db->escape_like_str($search)."%' 
            OR last_name LIKE '%".$this->db->escape_like_str($search)."%' 
            OR CONCAT(`last_name`,' ',`first_name`) LIKE '%".$this->db->escape_like_str($search)."%') 
            AND edu_iqa_results.is_status = 0 AND edu_iqa_results.evaluate_for =".$byRoom);
        if ($search_frm['select_iqa'] != '') {
            $this->db->where('evaluate_type_id', $search_frm['select_iqa']);
        }
        if ($search_frm['from_date'] != '') {
            $this->db->where('date_from >=', $search_frm['from_date']);
        }
        if ($search_frm['to_date'] != '') {
            $this->db->where('date_from <=', $search_frm['to_date']);
        }
        $this->db->group_by(['evaluate_to', 'evaluate_type_id']);
        $this->db->limit($limit);
        $result = $this->db->get();
        return $result->num_rows();
    }
    function search_byRoom($search, $search_frm, $limit=20, $offset=0, $column='id', $orderby='desc', $byRoom)
    {
        $this->db->from('iqa_results');
        $this->db->join('people', 'iqa_results.evaluate_to = people.person_id');
        $this->db->join('evaluate_types', 'iqa_results.evaluate_type_id = evaluate_types.id');
        $this->db->where("(first_name LIKE '%".$this->db->escape_like_str($search)."%' 
            OR last_name LIKE '%".$this->db->escape_like_str($search)."%' 
            OR CONCAT(`last_name`, ' ',`first_name`) LIKE '%".$this->db->escape_like_str($search)."%') 
            AND edu_iqa_results.is_status = 0  AND edu_iqa_results.evaluate_for =".$byRoom);
        if ($search_frm['select_iqa'] != '') {
            $this->db->where('evaluate_type_id', $search_frm['select_iqa']);
        }
        if ($search_frm['from_date'] != '') {
            $this->db->where('date_from >=', $search_frm['from_date']);
        }
        if ($search_frm['to_date'] != '') {
            $this->db->where('date_from <=', $search_frm['to_date']);
        }
        $this->db->group_by(['evaluate_to', 'evaluate_type_id']);
        $this->db->order_by('iqa_results.'.$column, $orderby);
        $this->db->limit($limit);
        $this->db->offset($offset);
        return $this->db->get();
    }






    /*
    Get search suggestions to find IQA
    */
    // function get_search_suggestions($search, $limit = 5)
    // {
    //     $suggestions = array();

    //     $this->db->from('iqa_results');
    //     $this->db->join('people', 'iqa_results.evaluate_to = people.person_id');
    //     $this->db->where("(first_name LIKE '%".$this->db->escape_like_str($search)."%' 
    //         OR last_name LIKE '%".$this->db->escape_like_str($search)."%' 
    //         OR CONCAT(`last_name`, ' ',`first_name`) LIKE '%".$this->db->escape_like_str($search)."%') 
    //         AND is_status = 0 AND edu_iqa_results.evaluate_for = 2");
    //     $this->db->group_by(['evaluate_to', 'evaluate_type_id']);
    //     $this->db->limit($limit);
    //     $by_name = $this->db->get();
    //     $temp_suggestions = array();
    //     foreach($by_name->result() as $row) {
    //         $temp_suggestions[] = $row->last_name . ' ' . $row->first_name;
    //     }

    //     sort($temp_suggestions);
    //     foreach($temp_suggestions as $temp_suggestion) {
    //         $suggestions[]=array('label'=> $temp_suggestion);
    //     }

    //     //only return $limit suggestions
    //     if(count($suggestions > $limit)) {
    //         $suggestions = array_slice($suggestions, 0, $limit);
    //     }

    //     return $suggestions;
    // }

    function get_evaluation_by_id($evaluate_type_id){
        $query = $this->db->where('eval_type_id',$evaluate_type_id)->get('evaluate_type_titles');
        return $query;
    }
    function get_iqa_result_detail($evaluate_to, $evaluate_type_id)
    {
        $iqa_results = $this->db->dbprefix('iqa_results');
        $people = $this->db->dbprefix('people');
        $employee = $this->db->dbprefix('employees');
        $emp_master = $this->db->dbprefix('emp_master');
        $designation = $this->db->dbprefix('designation');
        $query = $this->db->select('iqa_results.id,
                                    iqa_results.date_from,
                                    iqa_results.date_to,
                                    CONCAT(people_to.last_name, " ", people_to.first_name) as name_pt', false)
                ->join($employee,$employee.".id =".$iqa_results.".evaluate_to")
                ->join($people . ' as people_to', "people_to.person_id = " . $employee . ".person_id")
                ->where($iqa_results . ".is_status", 0)
                ->where($iqa_results . ".evaluate_for", 2)
                ->where($iqa_results . ".evaluate_to", $evaluate_to)
                ->where($iqa_results . ".evaluate_type_id", $evaluate_type_id)
                ->get($iqa_results);
        return $query;
    }
    function get_iqa_result_detail_byuser($evaluate_to, $evaluate_type_id)
    {
        $iqa_results = $this->db->dbprefix('iqa_results');
        $people = $this->db->dbprefix('people');
        $emp_master = $this->db->dbprefix('emp_master');
        $employee = $this->db->dbprefix('employees');
        $designation = $this->db->dbprefix('designation');
        $query = $this->db->select('*, CONCAT(people_to.last_name, " ", people_to.first_name) as name_pt', false)
                ->join($employee,$employee.".id =".$iqa_results.".evaluate_to")
                ->join($people . ' as people_to', "people_to.person_id = " . $employee . ".person_id")
                ->where($iqa_results . ".is_status", 0)
                ->where($iqa_results . ".evaluate_for", 2)
                ->where($iqa_results . ".evaluate_to", $evaluate_to)
                ->where($iqa_results . ".evaluate_type_id", $evaluate_type_id)
                ->group_by('evaluate_to')
                ->get($iqa_results);
        return $query;
    }
    function get_info_accessor_byid($iqa_id){
        $q = $this->db->join('people','people.person_id = iqa_evaluate_by.evaluate_by_id')->where('iqa_evaluate_by.iqa_result_id',$iqa_id)->join('emp_master','emp_master.emp_master_user_id = people.person_id')
        ->join('designation','designation.designation_id = emp_master.emp_master_designation_id')->get('iqa_evaluate_by');
        return $q;
    }

    function evaluation_score($iqa_result_id)
    {
        $query = $this->db->where('iqa_result_id', $iqa_result_id)->get('iqa_result_evaluate_titles');
        return $query;
    }

    function iqa_evaluate_byuser($evaluate_to)
    {
        $query = $this->db->join('iqa_results','iqa_result_evaluate_titles.iqa_result_id = iqa_results.id')->where('evaluate_to', $evaluate_to)->group_by('iqa_result_id')->get('iqa_result_evaluate_titles');
        return $query;
    }

    function get_all_iqa_ids($evaluate_to, $evaluate_type_id)
    {
        $query = $this->db->select('id')
                ->where('evaluate_to', $evaluate_to)
                ->where('evaluate_type_id', $evaluate_type_id)
                ->get('iqa_results')->result();
        $ids = [];
        foreach ($query as $key => $row) {
            array_push($ids, $row->id);
        }
        return $ids;
    }

    // Get Total score of IQA by given ID
    function get_total_score($iqa_result_id)
    {
        $total_score = 0;
        $query = $this->db->select_sum('evaluate_score', 'total_score')
                    ->where('iqa_result_id', $iqa_result_id)
                    ->group_by('iqa_result_id')
                    ->get('iqa_result_evaluate_titles');
        if ($query->num_rows() > 0) {
            $total_score = $query->row()->total_score;
        }
        return $total_score;
    }

    // Get score and average of IQA of given IDs
    function get_score_average($iqa_result_ids)
    {
        $data = ['total_score' => 0, 'average' => 0];
        $query = $this->db->select('evaluate_score')
                    ->where_in('iqa_result_id', $iqa_result_ids)
                    ->get('iqa_result_evaluate_titles');
        $total_score = 0;
        foreach ($iqa_result_ids as $key => $iqa_result_id) {
            $total_score += $this->get_total_score($iqa_result_id);
        }
        if ($query->num_rows() > 0 && $total_score > 0) {
            $number = count($iqa_result_ids);
            $data['average'] = $total_score/$number;
        }
        $data['total_score'] = $total_score;
        return $data;
    }
    
    function get_iqa_info_edit($evaluate_to, $evaluate_type_id)
    {
        return $q = $this->db->query("SELECT edu_iqa_results.id as iqa_id,
                                        edu_iqa_results.evaluate_to,
                                        edu_iqa_results.evaluate_by,
                                        CONCAT(edu_people.first_name,' ',edu_people.last_name) as get_full_name,
                                        edu_iqa_results.evaluate_type_id,
                                        edu_iqa_results.evaluate_date,
                                        edu_iqa_results.date_from,
                                        edu_iqa_results.date_to,
                                        edu_people.person_id,
                                        edu_people.gender
                                        FROM
                                        edu_iqa_results
                                        LEFT JOIN edu_employees ON edu_employees.id = edu_iqa_results.evaluate_to
                                        LEFT JOIN edu_people ON edu_people.person_id = edu_employees.person_id
                                        where evaluate_to = {$evaluate_to} AND evaluate_type_id = {$evaluate_type_id}");
    }
    function get_info_evaluate_by($id){
        return $this->db->select('designation.designation_name, CONCAT(edu_people.first_name,'.', edu_people.last_name) AS username', FALSE)
        ->join('employees','employees.id = iqa_evaluate_by.evaluate_by_id','left')
        ->join('people','people.person_id = employees.person_id','left')
        ->join('emp_master','emp_master.emp_master_user_id = people.person_id','left')
        ->join('designation','designation.designation_id = emp_master.emp_master_designation_id','left')
        ->where('iqa_evaluate_by.iqa_result_id',$id)->get('iqa_evaluate_by');
    }
    
    function iqa_titles_rows($iqa_ids)
    {
        $query = $this->db->where_in('iqa_result_id', $iqa_ids)->get('iqa_result_evaluate_titles');
        return $query->num_rows();
    }

    function get_iqa_user_byid($selection_evaluate_to){
        $q=  $this->db->query("SELECT edu_iqa_results.id,
                                edu_iqa_results.evaluate_to,
                                edu_iqa_results.evaluate_type_id,
                                edu_iqa_results.evaluate_date,
                                edu_people.first_name as f_name,
                                edu_people.last_name as l_name,
                                edu_people.gender,
                                edu_people.person_id,
                                edu_emp_master.emp_master_user_id,
                                edu_designation.designation_name,
                                edu_iqa_results.date_from,
                                edu_iqa_results.date_to
                                FROM
                                edu_iqa_results
                                LEFT JOIN edu_people ON edu_people.person_id = edu_iqa_results.evaluate_to
                                LEFT JOIN edu_emp_master ON edu_emp_master.emp_master_user_id = edu_people.person_id
                                LEFT JOIN edu_designation ON edu_designation.designation_id = edu_emp_master.emp_master_designation_id
                                where edu_iqa_results.evaluate_to IN (".$selection_evaluate_to.") GROUP BY edu_iqa_results.evaluate_to, edu_iqa_results.evaluate_type_id");
  
        return $q;
    }

    function get_evaluate_score($iqa_result_id, $iqa_evaluate_type){
        $q = $this->db->query("SELECT edu_iqa_result_evaluate_titles.iqa_result_id,
                                edu_iqa_result_evaluate_titles.title_eng_id,
                                SUM(edu_iqa_result_evaluate_titles.evaluate_score) AS sum_total,
                                edu_evaluate_type_titles.title_kh
                                FROM
                                edu_iqa_result_evaluate_titles
                                INNER JOIN edu_iqa_results ON edu_iqa_results.id = edu_iqa_result_evaluate_titles.iqa_result_id
                                INNER JOIN edu_evaluate_type_titles ON edu_evaluate_type_titles.id = edu_iqa_result_evaluate_titles.title_eng_id
                                where evaluate_to = {$iqa_result_id} AND edu_iqa_results.evaluate_type_id = {$iqa_evaluate_type}
                                GROUP BY title_eng_id");
        return $q;
    }
    function get_main_evaluate_title($iqa_evaluate_type){
        return $this->db->where('id',$iqa_evaluate_type)->get('edu_evaluate_types');
    }    
    function delete($id){
        $success=false;
        $success = $this->db->where('id',$id)->delete('iqa_results');
        $success = $this->db->where('iqa_result_id',$id)->delete('iqa_result_evaluate_titles');
        return $success;
    }
}