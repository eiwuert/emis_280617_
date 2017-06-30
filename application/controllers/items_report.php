<?php
require_once ("secure_area.php");
class Items_report extends Secure_area 
{
	function index($offset=0){
		$data['controller_name']=strtolower(get_class());
		// $data['manage_table']=get_items_report_manage_table($table_data,$this,$current);		
		$data['selection_type'] = array('stock' => 'Stock', 'income' => 'Income', 'po' => 'PO');
		$this->load->view('items/items_report/manage',$data);
	}

	function search_report(){
		$data['controller_name']=strtolower(get_class());
		$dateFrom = $this->inputPost('date_from');
		$dateTo = $this->inputPost('date_to');		
		$submit = $this->inputPost('submit');	
		$selectionType = $this->inputPost('selection_type');
		$f_dateFrom = date_format(date_create($dateFrom),"Y-m-d");
		$f_dateTo = date_format(date_create($dateTo),"Y-m-d");

		$data['selection_type'] = array('stock' => 'Stock', 'income' => 'Income', 'po' => 'PO');

		$data['mainTitle']= $selectionType;		

		$data['dateFrom']= $dateFrom;
		$data['dateTo']= $dateTo;

		$list_data = '';
		if($selectionType == 'stock'){
			$get_stock = $this->Item_products->stock_report($f_dateFrom,$f_dateTo);	
			$list_data.= manageItemReport($get_stock, $this);
		}elseif($selectionType == 'income'){
			$get_income = $this->Item_products->income_report($f_dateFrom,$f_dateTo);
			$list_data.= manageItemReport_income($get_income, $this);	
		}elseif($selectionType == 'po'){
			$get_po = $this->Item_products->po_report($f_dateFrom,$f_dateTo);
			$list_data.= manageItemReport_po($get_po, $this);	
		}

		$data['manage_table']= $list_data;
		if($submit == 'Search'){	
			$this->load->view('items/items_report/manage',$data);
		}elseif($submit == 'Print'){		
			$this->load->view('items/items_report/manage_excel',$data);
		}
	}

	function clear_state()
	{
		redirect('items_report');
	}

}