<?php

require_once("report.php");

class Detailed_profit_and_loss extends Report {

    function __construct() {
        parent::__construct();
    }

    public function getDataColumns() {
        return array();
    }

    public function getData() {
        $data = array();
        $data['summary'] = array();
        $data['details'] = array();

        $project_ids = $this->params['project_ids'];
        $project_manager_ids = $this->params['project_manager_ids'];
        $client_ids = $this->params['client_ids'];
        $start_date = $this->params['start_date'];
        $end_date = $this->params['end_date'];

        $this->db->select('expences.id as expencesID, expences.date as issue_date, project_title, sum(unit_price) as sub_total, title as proposal_title');
        $this->db->from('expences');
        $this->db->join('projects', 'projects.id = expences.project_id', 'left');
        $this->db->join('proposals', 'proposals.id = projects.proposal_id', 'left');
        $this->db->join('expence_details', 'expence_details.expence_id = expences.id', 'left');
        $this->db->join('people', 'people.person_id = expence_details.claimed_by', 'left');
        if ($project_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('expences') . '.project_id', $project_ids);
        }
        if ($project_manager_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('proposals') . '.responsible_person_id', $project_manager_ids);
        }
        if ($client_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('proposals') . '.client_id', $client_ids);
        }
        $this->db->where($this->db->dbprefix('expences') . '.date >=', $start_date);
        $this->db->where($this->db->dbprefix('expences') . '.date <=', $end_date);
        $this->db->where('expences.deleted', 0);
        $this->db->group_by('expences.id');

        foreach ($this->db->get()->result_array() as $summary_row) {
            $data['summary'][$summary_row['expencesID']] = $summary_row;
        }

        $exp_ids = array();

        foreach ($data['summary'] as $row) {
            $exp_ids[] = $row['expencesID'];
        }

        $this->db->select('expences.id as expencesID, item_date, item as item_name, quantity as quantity_purchased, unit_price, claimed_by, full_name as employee_name');
        $this->db->from('expences');
        $this->db->join('projects', 'projects.id = expences.project_id', 'left');
        $this->db->join('proposals', 'proposals.id = projects.proposal_id', 'left');
        $this->db->join('expence_details', 'expence_details.expence_id = expences.id', 'left');
        $this->db->join('people', 'people.person_id = expence_details.claimed_by', 'left');
        if ($project_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('expences') . '.project_id', $project_ids);
        }
        if ($project_manager_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('proposals') . '.responsible_person_id', $project_manager_ids);
        }
        if ($client_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('proposals') . '.client_id', $client_ids);
        }
        $this->db->where($this->db->dbprefix('expences') . '.date >=', $start_date);
        $this->db->where($this->db->dbprefix('expences') . '.date <=', $end_date);
        $this->db->where('expences.deleted', 0);

        if (!empty($exp_ids)) {
            $this->db->where_in('expences.id', $exp_ids);
        } else {
            $this->db->where('1', '2', FALSE);
        }

        foreach ($this->db->get()->result_array() as $rows) {
            $data['details'][$rows['expencesID']][] = $rows;
        }

        return $data;
    }

    public function getTotalRows() {
        $project_ids = $this->params['project_ids'];
        $project_manager_ids = $this->params['project_manager_ids'];
        $client_ids = $this->params['client_ids'];
        $start_date = $this->params['start_date'];
        $end_date = $this->params['end_date'];

        $this->db->select('COUNT(DISTINCT(' . $this->db->dbprefix('expences') . '.id)) as expense_count, expences.id as expID, projects.id as projectsID, proposals.id as proposalsID', false);
        $this->db->from('expences');
        $this->db->join('projects', 'projects.id = expences.project_id', 'left');
        $this->db->join('proposals', 'proposals.id = projects.proposal_id', 'left');
        $this->db->join('expence_details', 'expence_details.expence_id = expences.id', 'left');
        if ($project_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('expences') . '.project_id', $project_ids);
        }
        if ($project_manager_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('proposals') . '.responsible_person_id', $project_manager_ids);
        }
        if ($client_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('proposals') . '.client_id', $client_ids);
        }
        $this->db->where($this->db->dbprefix('expences') . '.date >=', $start_date);
        $this->db->where($this->db->dbprefix('expences') . '.date <=', $end_date);
        $this->db->where('expences.deleted', 0);
        $ret = $this->db->get()->row_array();
        return $ret['expense_count'];
    }

    public function getSummaryData() {
        $project_ids = $this->params['project_ids'];
        $project_manager_ids = $this->params['project_manager_ids'];
        $client_ids = $this->params['client_ids'];
        $start_date = $this->params['start_date'];
        $end_date = $this->params['end_date'];

        $this->db->select('*, COUNT(DISTINCT(' . $this->db->dbprefix('expences') . '.id)) as expense_count, sum(unit_price) as sub_total, projects.id as projectsID, proposals.id as proposalsID', false);
        $this->db->from('expences');
        $this->db->join('projects', 'projects.id = expences.project_id', 'left');
        $this->db->join('proposals', 'proposals.id = projects.proposal_id', 'left');
        $this->db->join('expence_details', 'expence_details.expence_id = expences.id', 'left');
        if ($project_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('expences') . '.project_id', $project_ids);
        }
        if ($project_manager_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('proposals') . '.responsible_person_id', $project_manager_ids);
        }
        if ($client_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('proposals') . '.client_id', $client_ids);
        }
        $this->db->where($this->db->dbprefix('expences') . '.date >=', $start_date);
        $this->db->where($this->db->dbprefix('expences') . '.date <=', $end_date);
        $this->db->where('expences.deleted', 0);
        $this->db->group_by('expences.id');

        $return = array('expense_count' => 0, 'expense_total' => 0);

        foreach ($this->db->get()->result_array() as $row) {
            $return['expense_count'] += $row['expense_count'];
            $return['expense_total'] += $row['sub_total'];
        }
        return $return;
    }

}

?>