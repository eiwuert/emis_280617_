<?php
class Fees_collections extends CI_Model{

	function get_all($limit=10000, $offset=0,$col='stu_master_id',$order='desc')
	{
		$exstra = "";
		if(!empty($limit) && !empty($offset)){
			$exstra .= " LIMIT {$offset},{$limit}";
		}
		if(!empty($col) && !empty($order)){
			$exstra .= " ORDER BY {$col} {$order}";
		}
		$query = $this->db->query("SELECT
								edu_stu_info.stu_info_id,
								edu_stu_info.stu_unique_id,
								edu_stu_info.stu_first_name,
								edu_stu_info.stu_middle_name,
								edu_stu_info.stu_last_name,
								edu_stu_info.stu_gender,
								edu_stu_info.students_grade,
								edu_stu_master.stu_master_id,
								edu_skill.skill_name,
								edu_skill.skill_major_code,
								edu_section.section_name,
								edu_batches.batch_name,
								edu_grade.grade_name,
								edu_levels.level_name,
								edu_courses.course_name,
								edu_courses.course_schedule_semester,
								edu_stu_academic.stu_acad_id,
								edu_stu_academic.stu_acad_schedule_id,
								edu_stu_academic.stu_acad_stu_room,
								edu_scholarships.scholarship_from
								FROM
								edu_stu_master
								LEFT JOIN edu_stu_info ON edu_stu_info.stu_info_id = edu_stu_master.stu_master_stu_info_id
								LEFT JOIN edu_stu_academic ON edu_stu_academic.stu_acad_stu_master_id = edu_stu_master.stu_master_id
								LEFT JOIN edu_skill ON edu_skill.skill_id = edu_stu_academic.stu_acad_skill_id
								LEFT JOIN edu_section ON edu_section.section_id = edu_stu_academic.stu_acad_section_id
								INNER JOIN edu_batches ON edu_batches.batch_id = edu_stu_academic.stu_acad_batch_id
								INNER JOIN edu_grade ON edu_grade.grade_id = edu_stu_academic.stu_acad_grade
								INNER JOIN edu_levels ON edu_levels.level_id = edu_stu_academic.stu_acad_level_id
								INNER JOIN edu_courses ON edu_courses.course_id = edu_stu_academic.stu_acad_course_detail_id
								LEFT JOIN edu_scholarships ON edu_scholarships.scho_id = edu_stu_academic.stu_acad_scholarship_id
                        WHERE edu_stu_master.is_status = 0 AND is_refer_out = 0 {$exstra}");
        return $query;
	}

	function count_all()
	{
		$query = $this->get_all();
		return $query->num_rows(); 
	}
	function get_all_scholarship($level_id,$major_id)
	{
		$query = $this->db
					->where_in('degree', $level_id)
					->where_in('major', $major_id)
		            ->where("is_status", 0)
		            ->get('scholarships');
		return $query->result();
	}
	function get_code_major_suggestions($search,$limit=25){

		$suggestions = array();

		$this->db->from('skill');
		$this->db->like('skill_major_code', $search);
		$this->db->where('is_status',0);
		$this->db->limit($limit);
		$by_name = $this->db->get();
		$temp_suggestions = array();
		foreach($by_name->result() as $row)
		{
			$temp_suggestions[] = array('label' => $row->skill_major_code,'label_id' => $row->skill_id);
		}
		
		// sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion['label'], 'label_id'=> $temp_suggestion['label_id']);		
		}
		
		//only return $limit suggestions
		if(count($suggestions > $limit))
		{
			$suggestions = array_slice($suggestions, 0,$limit);
		}
		return $suggestions;
	}

	function get_skill_by_id($get_id)
	{
		$query = $this->db
					->where('skill_id',$get_id)
		            ->where("is_status", 0)
		            ->get('skill');
		return $query;
	}

	function get_search_students($post, $search){
        $exstra = '';
        if(!empty($post['major_name'])){ $exstra.= " AND edu_stu_academic.stu_acad_skill_id = {$post['major_name']}"; }
        if(!empty($post['batch'])){ $exstra.= " AND edu_stu_academic.stu_acad_batch_id  = {$post['batch']}"; }
        if(!empty($post['year'])){ $exstra.= " AND edu_stu_academic.stu_acad_section_id = {$post['year']}"; }
        if(!empty($post['period'])){ $exstra.= " AND edu_stu_academic.stu_acad_grade  = {$post['period']}"; }
        if(!empty($post['degree'])){ $exstra.= " AND edu_stu_academic.stu_acad_level_id  = {$post['degree']}"; }
        if(!empty($post['scholarship'])){ $exstra.= " AND edu_stu_academic.stu_acad_scholarship_id  = {$post['scholarship']}"; }

        if($search !== null || $search != ''){ $exstra.= " AND {$search}"; }
        $query = $this->db->query("SELECT
									edu_stu_info.stu_info_id,
									edu_stu_info.stu_unique_id,
									edu_stu_info.stu_first_name,
									edu_stu_info.stu_middle_name,
									edu_stu_info.stu_last_name,
									edu_stu_info.stu_gender,
									edu_stu_info.students_grade,
									edu_stu_master.stu_master_id,
									edu_skill.skill_name,
									edu_skill.skill_major_code,
									edu_section.section_name,
									edu_batches.batch_name,
									edu_grade.grade_name,
									edu_levels.level_name,
									edu_courses.course_name,
									edu_courses.course_schedule_semester,
									edu_stu_academic.stu_acad_id,
									edu_stu_academic.stu_acad_schedule_id,
									edu_stu_academic.stu_acad_stu_room,
									edu_scholarships.scholarship_from
									FROM
									edu_stu_master
									LEFT JOIN edu_stu_info ON edu_stu_info.stu_info_id = edu_stu_master.stu_master_stu_info_id
									LEFT JOIN edu_stu_academic ON edu_stu_academic.stu_acad_stu_master_id = edu_stu_master.stu_master_id
									LEFT JOIN edu_skill ON edu_skill.skill_id = edu_stu_academic.stu_acad_skill_id
									LEFT JOIN edu_section ON edu_section.section_id = edu_stu_academic.stu_acad_section_id
									INNER JOIN edu_batches ON edu_batches.batch_id = edu_stu_academic.stu_acad_batch_id
									INNER JOIN edu_grade ON edu_grade.grade_id = edu_stu_academic.stu_acad_grade
									INNER JOIN edu_levels ON edu_levels.level_id = edu_stu_academic.stu_acad_level_id
									INNER JOIN edu_courses ON edu_courses.course_id = edu_stu_academic.stu_acad_course_detail_id
									LEFT JOIN edu_scholarships ON edu_scholarships.scho_id = edu_stu_academic.stu_acad_scholarship_id
                        WHERE edu_stu_master.is_status = 0 {$exstra}");
        return $query;
    }

    function get_suggest($ss_fee_collection,$search,$limit=25){

		$suggestions = array();

		// start
		$firstname = "(edu_stu_info.stu_first_name LIKE '%".$this->db->escape_like_str($search)."%')";
		$query_first_name = $this->get_search_students($ss_fee_collection,$firstname);
		$temp_suggestions = array();
		foreach($query_first_name->result() as $row)
		{
			$temp_suggestions[] = $row->stu_first_name;
		}		
		sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);		
		}
		// start
		$lastname = "(edu_stu_info.stu_last_name LIKE '%".$this->db->escape_like_str($search)."%')";
		$query_last_name = $this->get_search_students($ss_fee_collection,$lastname);
		$temp_suggestions = array();
		foreach($query_last_name->result() as $row)
		{
			$temp_suggestions[] = $row->stu_last_name;
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

    function get_all_info_stu_by_id($id){
		$query = $this->db->query("SELECT edu_stu_info.stu_info_id,
									edu_stu_info.stu_unique_id,
									edu_stu_info.stu_first_name,
									edu_stu_info.stu_first_name_kh,
									edu_stu_info.stu_middle_name,
									edu_stu_info.stu_last_name,
									edu_stu_info.stu_last_name_kh,
									edu_stu_info.stu_gender,
									edu_stu_info.stu_dob,
									edu_stu_info.students_grade,
									edu_stu_master.stu_master_id,
									edu_skill.skill_id,
									edu_skill.skill_name,
									edu_skill.skill_major_code,
									edu_section.section_id,
									edu_section.section_name,
									edu_batches.batch_name,
									edu_grade.grade_id,
									edu_grade.grade_name,
									edu_levels.level_id,
									edu_levels.level_name,
									edu_courses.course_name,
									edu_courses.course_schedule_semester,
									edu_stu_academic.stu_acad_id,
									edu_stu_academic.stu_acad_schedule_id,
									edu_stu_academic.stu_acad_stu_room,
									edu_nationality.nationality_name,
									edu_stu_info.stu_high_school,
									edu_stu_info.stu_exam_hschool,
									edu_stu_info.stu_certificate_id_hschool,
									edu_university.university_name,
									edu_room.room_name,
									edu_room.room_id,
									edu_scholarships.scholarship_from,
									edu_scholarships.scho_id,
									edu_stu_academic.stu_acad_scholarship_id
									FROM
									edu_stu_master
									LEFT JOIN edu_stu_info ON edu_stu_info.stu_info_id = edu_stu_master.stu_master_stu_info_id
									LEFT JOIN edu_stu_academic ON edu_stu_academic.stu_acad_stu_master_id = edu_stu_master.stu_master_id
									LEFT JOIN edu_skill ON edu_skill.skill_id = edu_stu_academic.stu_acad_skill_id
									LEFT JOIN edu_section ON edu_section.section_id = edu_stu_academic.stu_acad_section_id
									INNER JOIN edu_batches ON edu_batches.batch_id = edu_stu_academic.stu_acad_batch_id
									INNER JOIN edu_grade ON edu_grade.grade_id = edu_stu_academic.stu_acad_grade
									INNER JOIN edu_levels ON edu_levels.level_id = edu_stu_academic.stu_acad_level_id
									INNER JOIN edu_courses ON edu_courses.course_id = edu_stu_academic.stu_acad_course_detail_id
									INNER JOIN edu_nationality ON edu_nationality.nationality_id = edu_stu_info.stu_nationality_id
									INNER JOIN edu_university ON edu_university.university_id = edu_stu_academic.stu_acad_university_id
									INNER JOIN edu_room ON edu_room.room_id = edu_stu_academic.stu_acad_stu_room
									LEFT JOIN edu_scholarships ON edu_scholarships.scho_id = edu_stu_academic.stu_acad_scholarship_id
									WHERE edu_stu_master.is_status = 0 AND edu_stu_academic.stu_acad_id = {$id}");
		return $query;
	}
	function get_all_result_fee($id_stu){
			return $this->db->join('stu_info','stu_info.stu_info_id = score_pre_exams.student_id','left')
					->join('subjects','subjects.sub_id = score_pre_exams.subject_id','left')
					->where('stu_info_id',$id_stu)
					->order_by('id','ASC')
					->get('score_pre_exams');
	}
	function get_all_result_fee_byid($eid=''){
			return $this->db->join('stu_info','stu_info.stu_info_id = score_pre_exams.student_id','left')
					->join('subjects','subjects.sub_id = score_pre_exams.subject_id','left')
					->where('id',$eid)
					->get('score_pre_exams')->row();
	}
	function suggest_payment($level_id,$major_id, $scholarship_academic,$section){
		return $this->db->join('fees_category_scholarship','fees_category_scholarship.fees_scho_fee_id = fees_category.fees_category_id')
			->where('fees_degree',$level_id)
			->where('fees_major',$major_id)
			->where('fees_scho_id',$scholarship_academic)
			->where('fees_academic_year',$section)
			->get('fees_category');
	}
	function save_payments(&$data_payment, $fee_cate_id){
		$success=false;
		if ($fee_cate_id == 0)
		{			
			$this->db->insert("fees_payment_student", $data_payment);
			$success = $data_payment['pay_id'] = $this->db->insert_id();
		}else{
			$this->db->where('pay_id', $fee_cate_id);
			$success = $this->db->update('fees_payment_student',$data_payment);
		}
		return $success;
	}

	function get_list_payment_stus($id_stu){

		return $this->db->where('fees_payment_student.pay_stu_id',$id_stu)->where('fees_payment_student.is_status',0)->join('scholarships','scholarships.scho_id = fees_payment_student.pay_scholarship_id','left')->get('fees_payment_student');
	}

	function delete_payment_stu($pay_stu_id,$pay_id){
		$success=false;
		if(!empty($pay_stu_id)){
			$data = array('is_status' => 1);
			$success = $this->db->where('pay_stu_id',$pay_stu_id)->where('pay_id',$pay_id)->update('fees_payment_student',$data);
			return $success;
		}
	
	}

	function get_result_payment($pay_id=''){
		$q = $this->db->query("SELECT edu_stu_info.stu_first_name,
								edu_stu_info.stu_last_name,
								edu_stu_info.stu_middle_name,
								edu_stu_info.stu_unique_id,
								edu_stu_info.stu_gender,
								edu_stu_info.stu_dob,
								edu_fees_payment_student.pay_id,
								edu_fees_payment_student.pay_grand_total,
								edu_fees_payment_student.pay_scholarship_id,
								edu_fees_payment_student.pay_scholarship_percent,
								
								edu_fees_payment_student.pay_payment_method,
								edu_fees_payment_student.pay_currency,
								edu_fees_payment_student.pay_schedule,
								edu_fees_payment_student.pay_description,
								edu_fees_payment_student.pay_date,
								edu_fees_payment_student.pay_grand_total_word,

								edu_fees_payment_student.times_per_re_ex,
								edu_fees_payment_student.pay_other_fees,
								edu_fees_payment_student.pay_pre_enter_exam,
								edu_fees_payment_student.pay_final_exam,
								edu_fees_payment_student.pay_re_exam,
								edu_fees_payment_student.pay_thesis,
								edu_fees_payment_student.pay_certificate,

								edu_fees_payment_student.pay_other_ch,
								edu_fees_payment_student.pay_pre_ex_ch,
								edu_fees_payment_student.pay_final_ch,
								edu_fees_payment_student.pay_re_ex_ch,
								edu_fees_payment_student.pay_thesis_ch,
								edu_fees_payment_student.pay_certificate_ch,

								edu_fees_payment_student.pay_ex_rate,
								edu_fees_payment_student.pay_ex_baht,
								edu_fees_payment_student.pay_vat,
								edu_fees_payment_student.pay_penalty,
								edu_fees_payment_student.pay_thesis_group_fee,
								edu_fees_payment_student.pay_discount,
								edu_fees_payment_student.pay_debt,
								edu_fees_payment_student.pay_amount_fee,
								edu_fees_payment_student.pay_schedule_three,
								edu_fees_payment_student.pay_schedule_six,
								edu_fees_payment_student.pay_schedule_twelve,
								edu_fees_payment_student.pay_schedule_month,

								edu_skill.skill_name,
								edu_skill.skill_short_word,
								edu_batches.batch_name,
								edu_university.academic_year,
								edu_university.university_name_short_word,
								edu_university.university_name_kh,
								edu_university.university_dean_id,
								edu_university.created_at,
								edu_university.created_by,
								edu_courses.course_schedule_semester,
								edu_courses.course_schedule_year,
								edu_levels.level_id,
								edu_levels.level_name,
								edu_school_class.school_class_name,
								edu_scholarships.scholarship_from
								FROM
								edu_fees_payment_student
								LEFT JOIN edu_stu_info ON edu_stu_info.stu_info_id = edu_fees_payment_student.pay_stu_id
								LEFT JOIN edu_stu_master ON edu_stu_master.stu_master_stu_info_id = edu_stu_info.stu_info_id
								LEFT JOIN edu_university ON edu_stu_master.stu_master_university_id = edu_university.university_id
								LEFT JOIN edu_skill ON edu_stu_master.stu_master_skill_id = edu_skill.skill_id
								LEFT JOIN edu_batches ON edu_batches.batch_id = edu_stu_master.stu_master_batch_id
								LEFT JOIN edu_courses ON edu_stu_master.stu_master_course_id = edu_courses.course_id
								LEFT JOIN edu_levels ON edu_levels.level_id = edu_courses.level_id 
								LEFT JOIN edu_school_class ON edu_school_class.school_class_id = edu_stu_info.stu_master_stu_class
								LEFT JOIN edu_scholarships ON edu_scholarships.scho_id = edu_fees_payment_student.pay_scholarship_id WHERE edu_fees_payment_student.pay_id = {$pay_id}");
		if($q->num_rows() == 1){
			return $q->row();
		}
	}
}
