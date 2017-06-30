<?php
class Schedule extends CI_Model{

	function get_all()
	{
		$data = $this->db->get('edu_course_schedule_times');
		return $data;		
	}

	function save($datapost, $id){
		$this->db->where('id',$id)->update('edu_course_schedule_times',$datapost);
	}

}