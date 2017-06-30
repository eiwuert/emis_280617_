<?php

require_once("report.php");

class Summary_claims extends Report {

    function __construct() {
        parent::__construct();
    }

    public function getDataColumns() {
        $return = array();

        $return['summary'] = array();
        $return['summary'][] = array('data' => lang('reports_project_name'), 'align' => 'left');
        $return['summary'][] = array('data' => lang('reports_date'), 'align' => 'left');
        $return['summary'][] = array('data' => lang('reports_project_manager'), 'align' => 'left');
        $return['summary'][] = array('data' => lang('reports_amount_currency'), 'align' => 'left');
        $return['summary'][] = array('data' => lang('reports_action'), 'align' => 'left');

        $return['details'] = array();
        $return['details'][] = array('data' => lang('reports_date'), 'align' => 'left');
        $return['details'][] = array('data' => lang('reports_item'), 'align' => 'left');
        $return['details'][] = array('data' => lang('reports_expense_type'), 'align' => 'left');
        $return['details'][] = array('data' => lang('reports_quantity'), 'align' => 'left');
        $return['details'][] = array('data' => lang('reports_unit_price'), 'align' => 'left');
        $return['details'][] = array('data' => lang('reports_rate'), 'align' => 'left');
        $return['details'][] = array('data' => lang('reports_subtotal_currency'), 'align' => 'left');
        $return['details'][] = array('data' => lang('reports_claimed_by'), 'align' => 'left');

        return $return;
    }

    public function getData(){
        $project_ids = $this->params['project_ids'];
        $project_manager_ids = $this->params['project_manager_ids'];
        $consultants = $this->params['consultants'];
        $start_date = $this->params['start_date'];
        $end_date = $this->params['end_date'];

        $data = array();
        $data['summary'] = array();
        $data['details'] = array();

        $this->db->select('claims.id as claim_id, claims.claim_date as claim_date, claims.purpose as claim_desc, projects.project_title as project_title, sum(quantity * unit_price * rate) as sub_total, type_price as currency, projects.person_incharge_id as project_manager_id');
        $this->db->from('claims');
        $this->db->join('projects', 'projects.id = claims.project_id', 'left');
        $this->db->join('claim_details', 'claim_details.claim_id = claims.id', 'left');
        $this->db->join('people', 'people.person_id = claim_details.claimed_by', 'left');
        if ($project_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('claims') . '.project_id', $project_ids);
        }
        if ($project_manager_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('projects') . '.person_incharge_id', $project_manager_ids);
        }
        if ($consultants != "all") {
            $this->db->or_where_in($this->db->dbprefix('claim_details') . '.claimed_by', $consultants);
        }
        $this->db->where($this->db->dbprefix('claims') . '.claim_date >=',$start_date);
        $this->db->where($this->db->dbprefix('claims') . '.claim_date <=',$end_date);
        $this->db->where('claims.deleted', 0);
        $this->db->group_by("claims.id");

        foreach ($this->db->get()->result_array() as $row) {
            $data['summary'][$row['claim_id']] = $row;
        }

        $claim_ids = array();

        foreach ($data['summary'] as $row) {
            $claim_ids[] = $row['claim_id'];
        }

        $this->db->select('claims.id as claim_id, claim_details.item_date as item_date, claim_details.item as item_name, quantity, unit_price, rate, (quantity * unit_price * rate) as sub_total, claimed_by, full_name as employee_name, expence_name, type_price as currency');
        $this->db->from('claims');
        $this->db->join('projects', 'projects.id = claims.project_id', 'left');
        $this->db->join('claim_details', 'claim_details.claim_id = claims.id', 'left');
        $this->db->join('expence_types', 'claim_details.expence_type_id=expence_types.id', 'left');
        $this->db->join('people', 'people.person_id = claim_details.claimed_by', 'left');
        if ($project_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('claims') . '.project_id', $project_ids);
        }
        if ($project_manager_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('projects') . '.person_incharge_id', $project_manager_ids);
        }
        if ($consultants != "all") {
            $this->db->or_where_in($this->db->dbprefix('claim_details') . '.claimed_by', $consultants);
        }

        if (!empty($claim_ids)) {
            $this->db->where_in('claim_details.claim_id', $claim_ids);
        } else {
            $this->db->where('1', '2', FALSE);
        }
        $this->db->where('claims.deleted', 0);

        foreach ($this->db->get()->result_array() as $drow) {
            $data['details'][$drow['claim_id']][] = $drow;
        }

        return $data;
    }

    public function getTotalRows() {
        $project_ids = $this->params['project_ids'];
        $project_manager_ids = $this->params['project_manager_ids'];
        $consultants = $this->params['consultants'];
        $start_date = $this->params['start_date'];
        $end_date = $this->params['end_date'];

        $this->db->select("COUNT(DISTINCT(".$this->db->dbprefix('claims').".id)) as claim_id");
        $this->db->from('claims');
        $this->db->join('projects', 'projects.id = claims.project_id', 'left');
        $this->db->join('claim_details', 'claim_details.claim_id = claims.id', 'left');
        $this->db->join('people', 'people.person_id = claim_details.claimed_by', 'left');
        if ($project_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('claims') . '.project_id', $project_ids);
        }
        if ($project_manager_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('projects') . '.person_incharge_id', $project_manager_ids);
        }
        if ($consultants != "all") {
            $this->db->or_where_in($this->db->dbprefix('claim_details') . '.claimed_by', $consultants);
        }
        $this->db->where($this->db->dbprefix('claims') . '.claim_date >=',$start_date);
        $this->db->where($this->db->dbprefix('claims') . '.claim_date <=',$end_date);
        $this->db->where('claims.deleted', 0);
        $this->db->group_by("claims.id");
        $ret = $this->db->get()->row_array();
        return $ret['claim_id'];
    }

    public function getSummaryData(){
        $project_ids = $this->params['project_ids'];
        $project_manager_ids = $this->params['project_manager_ids'];
        $consultants = $this->params['consultants'];
        $start_date = $this->params['start_date'];
        $end_date = $this->params['end_date'];

        $this->db->select("COUNT(DISTINCT(".$this->db->dbprefix('claims').".id)) as claim_count, sum(unit_price * quantity * rate) as sub_total");
        $this->db->from('claims');
        $this->db->join('projects', 'projects.id = claims.project_id', 'left');
        $this->db->join('claim_details', 'claim_details.claim_id = claims.id', 'left');
        $this->db->join('people', 'people.person_id = claim_details.claimed_by', 'left');
        if ($project_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('claims') . '.project_id', $project_ids);
        }
        if ($project_manager_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('projects') . '.person_incharge_id', $project_manager_ids);
        }
        if ($consultants != "all") {
            $this->db->or_where_in($this->db->dbprefix('claim_details') . '.claimed_by', $consultants);
        }
        $this->db->where($this->db->dbprefix('claims') . '.claim_date >=',$start_date);
        $this->db->where($this->db->dbprefix('claims') . '.claim_date <=',$end_date);
        $this->db->where('claims.deleted', 0);
        $this->db->group_by("claims.id");

        $return = array('claim_count' => 0, 'claim_total' => 0);
        
        foreach($this->db->get()->result_array() as $row)
        {
            $return['claim_count'] += $row['claim_count'];
            $return['claim_total'] += $row['sub_total'];
        }
        $return['claim_total'] = number_format((float)$return['claim_total'], 2, '.', '');
        return $return;
    }

}

?>