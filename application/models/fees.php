<?php
/**
* Fees Model
*/
class Fees extends CI_Model
{
    
    function get_all($limit=10000, $offset=0, $col='fees_collect_name', $order='desc')
    {
        $this->db->from('fees_category')
                ->join('levels', 'fees_category.fees_degree = levels.level_id')
                ->join('skill', 'fees_category.fees_major = skill.skill_id')
                ->join('section', 'fees_category.fees_academic_year = section.section_id')
                ->where('fees_category.is_status', 0)
                ->order_by($col, $order)
                ->limit($limit)
                ->offset($offset);
        return $this->db->get();
    }

    public function save($datas, $fee_id = false, $scholarship_id)
    {
        $count = count($scholarship_id);
        $success = FALSE;
        if (!$fee_id or !$this->exists($fee_id)) {
            $success = $this->db->insert('fees_category', $datas);
            $datas['fee_id'] = $this->db->insert_id();
            if($success == true){
               for ($i=0; $i < $count; $i++) { 
                   $data_scho_id = array('fees_scho_fee_id' => $datas['fee_id'],
                                        'fees_scho_id'=>$scholarship_id[$i]);
                   $this->db->insert('fees_category_scholarship', $data_scho_id);
               }
            }
        }else{
            $this->db->where('fees_category_id', $fee_id);
            $success = $this->db->update('fees_category', $datas);
            
            // delete scholarship
            $success = $this->db->where('fees_scho_fee_id',$fee_id)->delete('fees_category_scholarship');
            // update scolarship                
            for ($i=0; $i < $count; $i++) {                     
                $data_scho_id = array('fees_scho_fee_id' => $fee_id,
                                    'fees_scho_id'=>$scholarship_id[$i]);
                $this->db->insert('fees_category_scholarship', $data_scho_id);
            }
            
        }
        return $success;
    }

    private function exists($fee_id)
    {
        $this->db->from('fees_category');
        $this->db->where('fees_category_id', $fee_id);
        $query = $this->db->get();

        return ($query->num_rows()>0);
    }

    function get_info($fee_id)
    {
        $this->db->from('fees_category')
                ->join('levels', 'fees_category.fees_degree = levels.level_id')
                ->join('skill', 'fees_category.fees_major = skill.skill_id')
                ->join('section', 'fees_category.fees_academic_year = section.section_id');
        $this->db->where('fees_category_id',$fee_id);
        $query = $this->db->get();
        
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            //Get empty base parent object, as $fee_id is NOT an fees_category
            $fees_category_obj = new stdClass;
            
            //Get all the fields from fees_category table
            $fields = $this->db->list_fields('fees_category');
            
            //append those fields to base parent object, we we have a complete empty object
            foreach ($fields as $field) {
                $fees_category_obj->$field = '';
            }
            
            return $fees_category_obj;
        }
    }

    function get_scholarship_fee($fee_id){
        return $this->db->where('fees_scho_fee_id',$fee_id)->get('fees_category_scholarship')->result();
    }

    function count_all()
    {
        $this->db->from('fees_category');
        $this->db->where('is_status', 0);
        return $this->db->count_all_results();
    }

    function search_count_all($search, $limit=10000)
    {
        $fees_category = $this->db->dbprefix('fees_category');
        $this->db->from($fees_category);
        $this->db->where("(fees_collect_name LIKE '%".$this->db->escape_like_str($search)."%' OR 
        fees_collect_name_kh LIKE '%".$this->db->escape_like_str($search)."%') AND ".$fees_category.".is_status=0");
        $this->db->limit($limit);
        $result=$this->db->get();

        return $result->num_rows();
    }

    function search($search, $limit=20, $offset=0, $column='fees_collect_name', $orderby='asc')
    {
        $fees_category = $this->db->dbprefix('fees_category');
        $this->db->from($fees_category)
                ->join('levels', 'fees_category.fees_degree = levels.level_id')
                ->join('skill', 'fees_category.fees_major = skill.skill_id')
                ->join('section', 'fees_category.fees_academic_year = section.section_id')
                ->where("(fees_collect_name LIKE '%".$this->db->escape_like_str($search)."%' 
                    OR fees_collect_name_kh LIKE '%".$this->db->escape_like_str($search)."%') AND ".$fees_category.".is_status=0")
                ->order_by($column, $orderby)
                ->limit($limit)
                ->offset($offset);

        return $this->db->get();
    }

    function get_search_suggestions($search, $limit=25)
    {
        $suggestions = array();

        $this->db->from('fees_category');
        $this->db->like('fees_collect_name', $search);
        $this->db->where('is_status',0);
        $this->db->limit($limit);
        $by_name = $this->db->get();
        $temp_suggestions = array();
        foreach($by_name->result() as $row)
        {
            $temp_suggestions[] = $row->fees_collect_name;
        }

        sort($temp_suggestions);
        foreach($temp_suggestions as $temp_suggestion)
        {
            $suggestions[]=array('label'=> $temp_suggestion);
        }

        $this->db->select('fees_collect_name_kh');
        $this->db->from('fees_category');
        $this->db->where('is_status',0);
        $this->db->distinct();
        $this->db->like('fees_collect_name_kh', $search);
        $this->db->limit($limit);
        $by_name_kh = $this->db->get();

        $temp_suggestions = array();
        foreach($by_name_kh->result() as $row)
        {
            $temp_suggestions[] = $row->fees_collect_name_kh;
        }

        sort($temp_suggestions);
        foreach($temp_suggestions as $temp_suggestion)
        {
            $suggestions[]=array('label'=> $temp_suggestion);
        }

        //only return $limit suggestions
        if(count($suggestions > $limit))
        {
            $suggestions = array_slice($suggestions, 0,$limit);
        }

        return $suggestions;
    }

    /*
    Deletes a list of fees
    */
    function delete_list($ids)
    {
        $success = FALSE;
        $this->db->where_in('fees_category_id', $ids);
        $success = $this->db->update('fees_category', array('is_status' => 1));
        $success = $this->db->where_in('fees_scho_fee_id',$ids)->delete('fees_category_scholarship');
        return $success;
    }
}