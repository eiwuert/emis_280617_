<?php

require_once("report.php");

class Detail_profit_loss extends Report {

    function __construct() {
        parent::__construct();
        
        $invoices = $this->db->dbprefix('invoices');
        $invoice_details = $this->db->dbprefix('invoice_details');
        $projects = $this->db->dbprefix('projects');
        $claims = $this->db->dbprefix('claims');
        $claim_details = $this->db->dbprefix('claim_details');
        $expense = $this->db->dbprefix('expences');
        $expense_details = $this->db->dbprefix('expence_details');
        //for invoices 
        $this->db->query("DROP TABLE IF EXISTS ".$this->db->dbprefix('invoice_temp'));
        $this->db->query('CREATE TEMPORARY TABLE '.$this->db->dbprefix('invoice_temp').' AS (SELECT
        '.$projects.'.id as project_id, '.$projects.'.deleted as deleted, '.$projects.'.proposal_id as proposal_id, '.$projects.'.project_title as project_title, '.$projects.'.start_date as start_date,'
        .$projects.'.end_date as end_date ,'.$invoices.'.created_date as inv_date,
        sum('.$invoice_details.'.amount+'.$invoice_details.'.amount_extra) as inv_amount FROM '.$projects.' INNER JOIN
        '.$invoices.' ON '.$invoices.'.project_id = '.$projects.'.id INNER JOIN '.$invoice_details.' ON '
        .$invoice_details.'.invoice_id = '.$invoices.'.id GROUP BY '.$projects.'.id)');
        //for claims
        $invoice_temp = $this->db->dbprefix('invoice_temp');
        $this->db->query("DROP TABLE IF EXISTS ".$this->db->dbprefix('claim_temp'));
        $this->db->query('CREATE TEMPORARY TABLE '.$this->db->dbprefix('claim_temp').' AS (SELECT
        '.$invoice_temp.'.*, '.$claims.'.claim_date as claim_date,
        sum('.$claim_details.'.quantity*'.$claim_details.'.unit_price) as claim_amount FROM '.$invoice_temp.' LEFT JOIN
        '.$claims.' ON '.$claims.'.project_id = '.$invoice_temp.'.project_id LEFT JOIN '.$claim_details.' ON '
        .$claim_details.'.claim_id = '.$claims.'.id GROUP BY '.$invoice_temp.'.project_id)');
        //for expense
        $claim_temp = $this->db->dbprefix('claim_temp');
        $this->db->query("DROP TABLE IF EXISTS ".$this->db->dbprefix('expense_temp'));
        $this->db->query('CREATE TEMPORARY TABLE '.$this->db->dbprefix('expense_temp').' AS (SELECT
        '.$claim_temp.'.*, '.$expense.'.date as expense_date, sum('.$expense_details.'.quantity*'.$expense_details.'.unit_price) as expense_amount FROM '.$claim_temp.' LEFT JOIN
        '.$expense.' ON '.$expense.'.project_id = '.$claim_temp.'.project_id LEFT JOIN '.$expense_details.' ON '
        .$expense_details.'.expence_id = '.$expense.'.id GROUP BY '.$claim_temp.'.project_id)');
        
    }
    
    public function getDataColumns() {
        $return = array();

        $return['summary'] = array();
        $return['summary'][] = array('data' => lang('reports_no'), 'align' => 'left');
        $return['summary'][] = array('data' => lang('reports_project_title'), 'align' => 'left');
        $return['summary'][] = array('data' => lang('reports_start_date'), 'align' => 'left');
        $return['summary'][] = array('data' => lang('reports_end_date'), 'align' => 'left');
        $return['summary'][] = array('data' => lang('reports_revenue'), 'align' => 'left');
        $return['summary'][] = array('data' => lang('reports_claim'), 'align' => 'left');
        $return['summary'][] = array('data' => lang('reports_expense'), 'align' => 'left');
        $return['summary'][] = array('data' => lang('reports_profit'), 'align' => 'left');

        $return['details'] = array();
        $return['details'][] = array('data' => lang('reports_no'), 'align' => 'left','width'=>10);
        $return['details'][] = array('data' => lang('reports_date'), 'align' => 'left','width'=>25);
        $return['details'][] = array('data' => lang('reports_description'), 'align' => 'left','width'=>40);
        $return['details'][] = array('data' => lang('reports_amount'), 'align' => 'left','width'=>25);

        return $return;
    }

    public function getData() {
        $data = array();
        $data['summary'] = array();
        $data['details'] = array();
		
		$invoices = $this->db->dbprefix('invoices');
        $invoice_details = $this->db->dbprefix('invoice_details');
        $projects = $this->db->dbprefix('projects');
        $claims = $this->db->dbprefix('claims');
        $claim_details = $this->db->dbprefix('claim_details');
        $expense = $this->db->dbprefix('expences');
        $expense_details = $this->db->dbprefix('expence_details');
		
        $project_ids = $this->params['project_ids'];
        $project_manager_ids = $this->params['project_manager_ids'];
        $client_ids = $this->params['client_ids'];
        $start_date = $this->params['start_date'];
        $end_date = $this->params['end_date'];

        $this->db->select('expense_temp.*');
        $this->db->from('expense_temp');
        $this->db->join('proposals', 'proposals.id = expense_temp.proposal_id', 'left');
        if ($project_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('expense_temp') . '.project_id', $project_ids);
        }
        if ($project_manager_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('proposals') . '.responsible_person_id', $project_manager_ids);
        }
        if ($client_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('proposals') . '.client_id', $client_ids);
        }
        $this->db->where($this->db->dbprefix('expense_temp') . '.start_date >=', $start_date);
        $this->db->where($this->db->dbprefix('expense_temp') . '.start_date <=', $end_date);
        $this->db->where('expense_temp.deleted', 0);
        $this->db->group_by('expense_temp.project_id');

        foreach ($this->db->get()->result_array() as $summary_row) {
            $data['summary'][$summary_row['project_id']] = $summary_row;
        }

        return $data;
    }
	
	public function get_revenue($project_id){
		$this->db->select($this->db->dbprefix('invoices').'.created_date as inv_date,
        sum('.$this->db->dbprefix('invoice_details').'.amount+'.$this->db->dbprefix('invoice_details').'.amount_extra) as inv_amount,
		'.$this->db->dbprefix('invoice_details').'.description as description',false);
		$this->db->from('invoices');
		$this->db->join('projects','projects.id=invoices.project_id');
		$this->db->join('invoice_details','invoice_details.invoice_id=invoices.id');
		$this->db->where('projects.id',$project_id);
		$this->db->group_by('invoice_details.id');
		return $this->db->get();
	}
	
	public function get_expenses($project_id){
		$expense = $this->db->dbprefix('expences');
        $expense_details = $this->db->dbprefix('expence_details');
		$this->db->select('expences.date as expense_date,
        sum('.$expense_details.'.unit_price*'.$expense_details.'.quantity) as expense_amount,
		'.$expense_details.'.item as item',false);
		$this->db->from('expences');
		$this->db->join('projects','projects.id=expences.project_id');
		$this->db->join('expence_details','expence_details.expence_id=expences.id');
		$this->db->where('projects.id',$project_id);
		$this->db->group_by('expence_details.id');
		return $this->db->get();
	}
	
	public function get_claims($project_id){
		$claim = $this->db->dbprefix('claims');
        $claim_details = $this->db->dbprefix('claim_details');
		$this->db->select('claims.claim_date as claim_date,
        sum('.$claim_details.'.unit_price*'.$claim_details.'.quantity) as claim_amount,
		'.$claim_details.'.item as item',false);
		$this->db->from('claims');
		$this->db->join('projects','projects.id=claims.project_id');
		$this->db->join('claim_details','claim_details.claim_id=claims.id');
		$this->db->where('projects.id',$project_id);
		$this->db->group_by('claim_details.id');
		return $this->db->get();
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

        $this->db->select('sum('. $this->db->dbprefix('expense_temp') . '.inv_amount) as inv_amount, 
		sum('. $this->db->dbprefix('expense_temp') . '.claim_amount) as claim_amount, 
		sum('. $this->db->dbprefix('expense_temp') . '.expense_amount) as expense_amount, 
		sum('. $this->db->dbprefix('expense_temp') . '.inv_amount)-(sum('. $this->db->dbprefix('expense_temp') . '.claim_amount)+sum('. $this->db->dbprefix('expense_temp') . '.expense_amount)) as profit', false);
        $this->db->from('expense_temp');
        $this->db->join('proposals', 'proposals.id = expense_temp.proposal_id', 'left');
        if ($project_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('expense_temp') . '.project_id', $project_ids);
        }
        if ($project_manager_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('proposals') . '.responsible_person_id', $project_manager_ids);
        }
        if ($client_ids != "all") {
            $this->db->or_where_in($this->db->dbprefix('proposals') . '.client_id', $client_ids);
        }
        $this->db->where($this->db->dbprefix('expense_temp') . '.start_date >=', $start_date);
        $this->db->where($this->db->dbprefix('expense_temp') . '.start_date <=', $end_date);
        $this->db->group_by('expense_temp.project_id');

        $return = array('inv_amount' => 0, 'claim_amount' => 0, 'expense_amount'=>0,'profit'=>0);

        foreach ($this->db->get()->result_array() as $row) {
            $return['inv_amount'] += $row['inv_amount'];
            $return['claim_amount'] += $row['claim_amount'];
            $return['expense_amount'] += $row['expense_amount'];
            $return['profit'] += $row['profit'];
        }
        return $return;
    }

}

?>