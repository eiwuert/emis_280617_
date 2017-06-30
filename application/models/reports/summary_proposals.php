<?php

require_once("report.php");

class Summary_proposals extends Report {

    function __construct() {
        parent::__construct();
    }

    public function getDataColumns(){
        return array(
            array('data'  => lang('reports_proposal_code'), 'align' => 'left'),
            array('data'  => lang('reports_proposal_title'), 'align' => 'left'),
            array('data'  => lang('reports_project_responsible_person'), 'align' => 'left'),
            array('data'  => lang('reports_date_created'), 'align' => 'left'),
            array('data'  => lang('reports_company'), 'align' => 'left'),
            array('data'  => lang('reports_meeting_title'), 'align' => 'left'),
            array('data'  => lang('reports_status'), 'align' => 'left'),
            array('data'  => lang('reports_action'), 'align' => 'left'),
        );
    }

    public function getData() {
        $proposal_ids = $this->params['proposal_ids'];
        $project_manager_ids = $this->params['project_manager_ids'];
        $start_date = $this->params['start_date'];
        $end_date = $this->params['end_date'];
        $status = $this->params['status'];
        $approval = $this->params['approval'];
        $client_ids = $this->params['client_ids'];

        $this->db->select('proposals.id as pro_id,title as proposal_title,created_date,subject,full_name,pro_status, proposal_code, company_name, proposals.responsible_person_id as resp_person_id', FALSE);
        $this->db->from('proposals');
        $this->db->join('meetings','meetings.id=proposals.meeting_id');
        $this->db->join('people','people.person_id=proposals.client_id');
        if ($status != 'all') {
            $this->db->where($this->db->dbprefix('proposals') . '.pro_status',$status);
        }
        if ($approval != "all") {
            $this->db->where($this->db->dbprefix('proposals') . '.approved', $approval);
        }
        if ($proposal_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('proposals') . '.id', $proposal_ids);
        }
        if ($project_manager_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('proposals') . '.responsible_person_id', $project_manager_ids);
        }
        if ($client_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('proposals') . '.client_id', $client_ids);
        }
        $this->db->where($this->db->dbprefix('proposals') . '.deleted', 0);
        $this->db->where($this->db->dbprefix('proposals') . '.created_date >=',$start_date);
        $this->db->where($this->db->dbprefix('proposals') . '.created_date <=',$end_date);
        $this->db->order_by('proposals.id');
        return $this->db->get()->result_array();
    }

    function getTotalRows() {
        $proposal_ids = $this->params['proposal_ids'];
        $project_manager_ids = $this->params['project_manager_ids'];
        $start_date = $this->params['start_date'];
        $end_date = $this->params['end_date'];
        $status = $this->params['status'];
        $approval = $this->params['approval'];
        $client_ids = $this->params['client_ids'];

        $this->db->select('COUNT(DISTINCT('.$this->db->dbprefix("proposals").'.id)) as proposal_count',false);
        $this->db->from('proposals');
        $this->db->join('meetings', 'proposals.meeting_id = meetings.id');
        if ($status != 'all') {
            $this->db->where($this->db->dbprefix('proposals') . '.pro_status',$status);
        }
        if ($approval != "all") {
            $this->db->where($this->db->dbprefix('proposals') . '.approved', $approval);
        }
        if ($proposal_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('proposals') . '.id', $proposal_ids);
        }
        if ($project_manager_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('proposals') . '.responsible_person_id', $project_manager_ids);
        }
        if ($client_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('proposals') . '.client_id', $client_ids);
        }
        $this->db->where($this->db->dbprefix('proposals') . '.deleted', 0);
        $this->db->where($this->db->dbprefix('proposals') . '.created_date >=',$start_date);
        $this->db->where($this->db->dbprefix('proposals') . '.created_date <=',$end_date);
        $ret = $this->db->get()->row_array();
        return $ret['proposal_count'];
    }

    public function getSummaryData() {
        $proposal_ids = $this->params['proposal_ids'];
        $project_manager_ids = $this->params['project_manager_ids'];
        $start_date = $this->params['start_date'];
        $end_date = $this->params['end_date'];
        $status = $this->params['status'];
        $approval = $this->params['approval'];
        $client_ids = $this->params['client_ids'];

        $this->db->select('COUNT(DISTINCT('.$this->db->dbprefix("proposals").'.id)) as proposal_count', false);
        $this->db->from('proposals');
        $this->db->join('meetings', 'proposals.meeting_id = meetings.id');
        if ($status != 'all') {
            $this->db->where($this->db->dbprefix('proposals') . '.pro_status',$status);
        }
        if ($approval != "all") {
            $this->db->where($this->db->dbprefix('proposals') . '.approved', $approval);
        }
        if ($proposal_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('proposals') . '.id', $proposal_ids);
        }
        if ($project_manager_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('proposals') . '.responsible_person_id', $project_manager_ids);
        }
        if ($client_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('proposals') . '.client_id', $client_ids);
        }
        $this->db->where($this->db->dbprefix('proposals') . '.deleted', 0);
        $this->db->where($this->db->dbprefix('proposals') . '.created_date >=',$start_date);
        $this->db->where($this->db->dbprefix('proposals') . '.created_date <=',$end_date);
        return $this->db->get()->row_array();
    }

}

?>