<?php
class Iqa_model extends CI_Model {
    /*
    Inserts or updates a iqa
    */
    function save(&$iqa_data, $iqa_titles, $id = false)
    {
        $success = false;
        //Run these queries as a transaction, we want to make sure we do all or nothing
        $this->db->trans_start();

        if (!$id or !$this->exists($id)) {
            $success = $this->db->insert('evaluate_types', $iqa_data);
            $iqa_data['id'] = $id = $this->db->insert_id();
        } else {
            // Delete IQA titles
            $this->delete_iqa_titles($id, $iqa_titles['ids']);
            // Update IQA
            $success = $this->db
                ->where('id', $id)
                ->update('evaluate_types', $iqa_data);
        }

        if (count($iqa_titles)) {
            foreach ($iqa_titles['title_eng'] as $key => $iqa) {
                $titles = [
                    'eval_type_id' => $id,
                    'title_eng' => $iqa,
                    'title_kh' => $iqa_titles['title_kh'][$key]
                ];
                $this->save_iqa_title($titles, $iqa_titles['ids'][$key]);
            }
        }        

        $this->db->trans_complete();
        return $success;
    }

    function exists($id)
    {
        $this->db->from('evaluate_types');
        $this->db->where('evaluate_types.id', $id);
        $query = $this->db->get();

        return ($query->num_rows()==1);
    }

    function exists_title($id)
    {
        $this->db->from('evaluate_type_titles');
        $this->db->where('evaluate_type_titles.id', $id);
        $query = $this->db->get();

        return ($query->num_rows()==1);
    }

    function save_iqa_title($titles, $id = false)
    {
        $success = false;
        //Run these queries as a transaction, we want to make sure we do all or nothing
        $this->db->trans_start();

        if (!$id or !$this->exists_title($id)) {
            $success = $this->db->insert('evaluate_type_titles', $titles);
        } else {
            $success = $this->db
                ->where('id', $id)
                ->update('evaluate_type_titles', $titles);
        }

        $this->db->trans_complete();
        return $success;
    }

    function get_info($id)
    {
        $this->db->from('evaluate_types');
        $this->db->where('id',$id);
        $query = $this->db->get();

        if($query->num_rows() == 1) {
            return $query->row();
        } else {
            //Get empty base parent object, as $id is NOT an IQA
            $obj = new stdClass;
            //Get all the fields from evaluate_types table
            $fields = $this->db->list_fields('evaluate_types');
            foreach ($fields as $field) {
                $obj->$field = '';
            }

            return $obj;
        }
    }

    function get_titles($eval_type_id)
    {
        $this->db->from('evaluate_type_titles');
        $this->db->where('eval_type_id', $eval_type_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return [];
    }

    function delete_iqa_titles($eval_type_id, $ids)
    {
        $success = false;
        $this->db->trans_start();
        $success = $this->db->where('eval_type_id', $eval_type_id)
                ->where_not_in('id', $ids)
                ->delete('evaluate_type_titles');
        $this->db->trans_complete();
        return $success;
    }
/*+++++++++++++*/
// get all evalutaion by Employee
/*+++++++++++++*/
    function get_all($limit=10000, $offset=0, $col='name_eng', $order='desc')
    {
        $evaluate_types = $this->db->dbprefix('evaluate_types');
        $data = $this->db->query("SELECT * 
                        FROM " . $evaluate_types . " 
                        WHERE ".$evaluate_types.".is_status = 0 ORDER BY " . $col . " " . $order . " 
                        LIMIT  " . $offset . "," . $limit);
        return $data;
    }
    function count_all()
    {
        $this->db->from('evaluate_types');
        $this->db->where('is_status', 0);
        return $this->db->count_all_results();
    }

    function search_count_all($search, $limit=10000)
    {
        $this->db->from('evaluate_types');
        $this->db->where("(name_eng LIKE '%".$this->db->escape_like_str($search)."%') 
        AND is_status = 0");
        $this->db->limit($limit);
        $result = $this->db->get();
        return $result->num_rows();
    }

    function search($search, $limit=20, $offset=0, $column='name_eng', $orderby='desc')
    {
        $this->db->from('evaluate_types');
        $this->db->where("(name_eng LIKE '%".$this->db->escape_like_str($search)."%') 
            AND is_status = 0");
        $this->db->order_by($column, $orderby);
        $this->db->limit($limit);
        $this->db->offset($offset);
        return $this->db->get();
    }

    /*
    Get search suggestions to find IQA
    */
    function get_search_suggestions($search, $limit = 5)
    {
        $suggestions = array();

        $this->db->from('evaluate_types');
        $this->db->where("(name_eng LIKE '%".$this->db->escape_like_str($search)."%') AND is_status = 0");

        $this->db->limit($limit);
        $by_name = $this->db->get();
        $temp_suggestions = array();
        foreach($by_name->result() as $row) {
            $temp_suggestions[] = $row->name_eng;
        }

        sort($temp_suggestions);
        foreach($temp_suggestions as $temp_suggestion) {
            $suggestions[]=array('label'=> $temp_suggestion);
        }

        //only return $limit suggestions
        if(count($suggestions > $limit)) {
            $suggestions = array_slice($suggestions, 0, $limit);
        }

        return $suggestions;
    }

    /*
    Deletes a list of IQA
    */
    function delete_list($id)
    {
        $success = false;
        //Run these queries as a transaction, we want to make sure we do all or nothing
        $this->db->trans_start();
        $this->db->where_in('id', $id);
        $success = $this->db->update('evaluate_types', array('is_status' => 1));
        $this->db->trans_complete();
        return $success;
    }

    function get_iqa_titles($eval_type_id = false)
    {
        $this->db->from('evaluate_type_titles');
        if ($eval_type_id) {
            $this->db->where('eval_type_id', $eval_type_id);
        }
        $query = $this->db->get();

        return $query->num_rows() > 0 ? $query->result() : [];
    }

    function save_iqa_tool_title($titles, $id = false)
    {
        $success = false;
        //Run these queries as a transaction, we want to make sure we do all or nothing
        $this->db->trans_start();

        $success = $this->db->insert('iqa_result_evaluate_titles', $titles);

        $this->db->trans_complete();
        return $success;
    }

    function get_info_evaluate_to($id){
        return $this->db->where('iqa_result_id',$id)->get('iqa_evaluate_to');
    }
    // evaluate by emp
    function get_info_evaluate_by($id){
        return $this->db->where('iqa_result_id',$id)->get('iqa_evaluate_by');
    }
    // evaluate by room
    function get_info_evaluate_by_room($id){
        return $this->db->where('iqa_result_id',$id)->get('iqa_evaluate_by_room');
    }

    function save_iqa_tool(&$iqa_tool, $iqa_titles, $id = false, $evaluate_by)
    {
        $success = false;
        //Run these queries as a transaction, we want to make sure we do all or nothing
        $this->db->trans_start();
        $count_evaluate_by = count($evaluate_by);
        if (!$id or !$this->exists_iqa_tool($id)) {
            $success = $this->db->insert('iqa_results', $iqa_tool);
            $iqa_tool['id'] = $id = $this->db->insert_id();
            
            if(!empty($count_evaluate_by)){
                for ($i=0; $i < $count_evaluate_by; $i++) { 
                    $data2 = array('iqa_result_id' => $iqa_tool['id'],'evaluate_by_id' => $evaluate_by[$i] );
                    $this->db->insert('iqa_evaluate_by', $data2);
                }
            }
        } else {
            // Update IQA
            $success = $this->db
                ->where('id', $id)
                ->update('iqa_results', $iqa_tool);            
            $this->db->where('iqa_result_id',$id)->delete('iqa_evaluate_by');
            if(!empty($count_evaluate_by)){
                for ($i=0; $i < $count_evaluate_by; $i++) { 
                    $data2 = array('iqa_result_id' => $id,'evaluate_by_id' => $evaluate_by[$i] );
                    $this->db->insert('iqa_evaluate_by', $data2);
                }
            }
        }

        // Delete IQA titles
        $this->delete_iqa_tool_titles($id);

        if (count($iqa_titles)) {
            foreach ($iqa_titles['title_eng'] as $key => $iqa_title) {
                $titles = [
                    'iqa_result_id' => $id,
                    'title_eng_id' => $iqa_titles['ids'][$key],
                    'evaluate_score' => $iqa_titles['score'][$key]
                ];
                $this->save_iqa_tool_title($titles, $iqa_titles['ids'][$key]);
            }
        }

        $this->db->trans_complete();
        return $success;
    }

    function save_iqa_tool_by_room(&$iqa_tool, $iqa_titles, $id = false, $evaluate_by)
    {
        $success = false;
        //Run these queries as a transaction, we want to make sure we do all or nothing
        $this->db->trans_start();
        $count_evaluate_by = count($evaluate_by);
        if (!$id or !$this->exists_iqa_tool($id)) {
            $success = $this->db->insert('iqa_results', $iqa_tool);
            $iqa_tool['id'] = $id = $this->db->insert_id();

            if(!empty($count_evaluate_by)){
                for ($i=0; $i < $count_evaluate_by; $i++) { 
                    $data2 = array('iqa_result_id' => $iqa_tool['id'],'evaluate_by_id' => $evaluate_by[$i] );
                    $this->db->insert('iqa_evaluate_by_room', $data2);
                }
            }
        } else {
            // Update IQA
            $success = $this->db
                ->where('id', $id)
                ->update('iqa_results', $iqa_tool);            
            $this->db->where('iqa_result_id',$id)->delete('iqa_evaluate_by');
            if(!empty($count_evaluate_by)){
                for ($i=0; $i < $count_evaluate_by; $i++) { 
                    $data2 = array('iqa_result_id' => $id,'evaluate_by_id' => $evaluate_by[$i] );
                    $this->db->insert('iqa_evaluate_by_room', $data2);
                }
            }
        }

        // Delete IQA titles
        $this->delete_iqa_tool_titles($id);

        if (count($iqa_titles)) {
            foreach ($iqa_titles['title_eng'] as $key => $iqa_title) {
                $titles = [
                    'iqa_result_id' => $id,
                    'title_eng_id' => $iqa_titles['ids'][$key],
                    'evaluate_score' => $iqa_titles['score'][$key]
                ];
                $this->save_iqa_tool_title($titles, $iqa_titles['ids'][$key]);
            }
        }

        $this->db->trans_complete();
        return $success;
    }

    function delete_iqa_tool_titles($iqa_result_id)
    {
        $success = false;
        $this->db->trans_start();
        $success = $this->db->where('iqa_result_id', $iqa_result_id)
                ->delete('iqa_result_evaluate_titles');
        $this->db->trans_complete();
        return $success;
    }

    function exists_iqa_tool($id)
    {
        $this->db->from('iqa_results');
        $this->db->where('iqa_results.id', $id);
        $query = $this->db->get();

        return ($query->num_rows()==1);
    }

    function get_info_iqa_tool($id)
    {
        $this->db->from('iqa_results');
        $this->db->where('id', $id);
        $query = $this->db->get();

        if($query->num_rows() == 1) {
            return $query->row();
        } else {
            //Get empty base parent object, as $id is NOT an IQA
            $obj = new stdClass;
            //Get all the fields from iqa_results table
            $fields = $this->db->list_fields('iqa_results');
            foreach ($fields as $field) {
                $obj->$field = '';
            }

            return $obj;
        }
    }

    function get_iqa_result_titles($iqa_result_id = false)
    {
        $this->db->join('evaluate_type_titles','evaluate_type_titles.id = iqa_result_evaluate_titles.title_eng_id','left')->from('iqa_result_evaluate_titles');
        if ($iqa_result_id) {
            $this->db->where('iqa_result_id', $iqa_result_id);
        }
        $query = $this->db->get();

        return $query->num_rows() > 0 ? $query->result() : [];
    }

}