<?php
require_once ("secure_area.php");
class Expense_management extends Secure_area 
{
	function index() {
		$data['controller_name'] = strtolower(get_class());
		$this->load->view('expense/expense_management/list',$data);
	}

	
	function form_expense() {
		$data['controller_name'] = strtolower(get_class());
		$this->load->view('expense/expense_management/form_expense',$data);
	}
}