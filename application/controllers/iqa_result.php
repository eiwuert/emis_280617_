<?php
require_once ("secure_area.php");
class Iqa_result extends Secure_area 
{
    function __construct()
    {
        parent::__construct('iqa_result');
    }

	function index($offset = 0)
    {
        $search_frm = [
            'select_iqa' => '',
            'from_date' => '',
            'to_date' => ''
        ];
		$params = $this->session->userdata('iqa_result_search_data') ? $this->session->userdata('iqa_result_search_data') : array('offset' => 0, 'order_col' => 'id', 'order_dir' => 'desc', 'search' => FALSE, 'search_frm' => $search_frm);
        if ($offset != $params['offset']) {
            redirect('iqa_result/index/'.$params['offset']);
        }
        $this->check_action_permission('search');
        $config['base_url'] = site_url('iqa_result/sorting');
        $config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
        $data['controller_name'] = strtolower(get_class());
        $data['per_page'] = $config['per_page'];
        $data['search'] = $params['search'] ? $params['search'] : "";
        if ($data['search']) {
            $config['total_rows'] = $this->Iqa_results->search_count_all($data['search'], $params['search_frm']);
            $table_data = $this->Iqa_results->search($data['search'], $params['search_frm'], $data['per_page'], $params['offset'], $params['order_col'], $params['order_dir']);
        } else {
            $config['total_rows'] = $this->Iqa_results->count_all();
            $table_data = $this->Iqa_results->get_all($data['per_page'], $params['offset'], $params['order_col'], $params['order_dir']);
        }
        $iqa_types = $this->Iqa_model->get_all();
        $data['iqa_types'] = ['' => '-- Please Select --'];
        if ($iqa_types->num_rows() > 0) {
            foreach ($iqa_types->result() as $key => $iqa) {
                $data['iqa_types'][$iqa->id] = $iqa->name_eng;
            }
        }
        $data['total_rows'] = $config['total_rows'];
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['order_col'] = $params['order_col'];
        $data['order_dir'] = $params['order_dir'];
        $data['manage_table'] = get_iqa_result_manage_table($table_data, $this);

		$this->load->view('iqa/iqa_result/manage', $data);
	}

    function sorting()
    {
        $this->check_action_permission('search');
        $search = $this->input->post('search') ? $this->input->post('search') : "";
        $per_page = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
        $select_iqa = $this->input->post('select_iqa') ? $this->input->post('select_iqa') : '';
        $from_date = $this->input->post('from_date') ? date('Y-m-d', strtotime($this->input->post('from_date'))) : '';
        $to_date = $this->input->post('to_date') ? date('Y-m-d', strtotime($this->input->post('to_date'))) : '';
        $search_frm = [ 'select_iqa' => $select_iqa, 'from_date' => $from_date, 'to_date' => $to_date ];

        $offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
        $order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'id';
        $order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

        $iqa_result_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search, 'search_frm' => $search_frm);
        $this->session->set_userdata("iqa_result_search_data", $iqa_result_search_data);

        if ($search) {
            $config['total_rows'] = $this->Iqa_results->search_count_all($search, $search_frm);
            $table_data = $this->Iqa_results->search($search, $search_frm, $per_page, $offset, $order_col, $order_dir);
        } else {
            $config['total_rows'] = $this->Iqa_results->count_all();
            $table_data = $this->Iqa_results->get_all($per_page, $offset, $order_col, $order_dir);
        }
        $config['base_url'] = site_url('iqa_result/sorting');
        $config['per_page'] = $per_page; 
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['manage_table'] = get_iqa_result_manage_table_data_rows($table_data, $this);
        echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
    }

    function search()
    {
        $this->check_action_permission('search');
        $select_iqa = $this->input->post('select_iqa') ? $this->input->post('select_iqa') : '';
        $from_date = $this->input->post('from_date') ? date('Y-m-d', strtotime($this->input->post('from_date'))) : '';
        $to_date = $this->input->post('to_date') ? date('Y-m-d', strtotime($this->input->post('to_date'))) : '';
        $search_frm = [ 'select_iqa' => $select_iqa, 'from_date' => $from_date, 'to_date' => $to_date ];

        $search = $this->input->post('search');
        $offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
        $order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'id';
        $order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

        $iqa_result_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search, 'search_frm' => $search_frm);
        $this->session->set_userdata("iqa_result_search_data", $iqa_result_search_data);
        $per_page = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
        $search_data = $this->Iqa_results->search($search, $search_frm, $per_page, $offset, $order_col ,$order_dir);
        
        
        $config['base_url'] = site_url('iqa_result/search');
        $config['total_rows'] = $this->Iqa_results->search_count_all($search, $search_frm);
        $config['per_page'] = $per_page ;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['total_rows'] = $config['total_rows'];
        $data['manage_table'] = get_iqa_result_manage_table_data_rows($search_data, $this);
        echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
    }
    /*
    Gives search suggestions based on what is being searched for
    */
    // function suggest()
    // {
    //     //allow parallel searchs to improve performance.
    //     session_write_close();
    //     $suggestions = $this->Iqa_results->get_search_suggestions($this->input->get('term'),100);
    //     echo json_encode($suggestions);
    // }

	function display($evaluate_to, $evaluate_type_id, $iqa_id = -1)
    {
		$data['controller_name'] = strtolower(get_class());
        $data['count_column_evaluation'] = $this->Iqa_results->get_evaluation_by_id($evaluate_type_id)->num_rows();
        // body
        $data['iqa_detail_byuser'] = $this->Iqa_results->get_iqa_result_detail_byuser($evaluate_to, $evaluate_type_id);
        $data['iqa_detail_row'] = $this->Iqa_results->get_iqa_result_detail($evaluate_to, $evaluate_type_id);

        // $date_from = $this->convertDate_FY($data['iqa_detail_row']->row()->date_from);
        // $date_to = $this->convertDate_FY($data['iqa_detail_row']->row()->date_to);
        // $data['header_title'] = "លទ្ធផលពិន្ទុឱ្យដោយថ្នាក់កំពូល(ពីខែ " . $date_from . " ដល់ ខែ " . $date_to . ") " . $data['iqa_evaluate_type'];
        $data['header_title'] = "លទ្ធផលពិន្ទុឱ្យដោយថ្នាក់កំពូល";
        $this->load->view('iqa/iqa_result/display', $data);
	}
    function edit($evaluate_to, $evaluate_type_id, $iqa_id = -1)
    {
        $data['controller_name'] = strtolower(get_class());
        $data['iqa_result_info_edit'] = $this->Iqa_results->get_iqa_info_edit($evaluate_to, $evaluate_type_id);
        $this->load->view('iqa/iqa_result/edit', $data);
   
    }
    function delete($id){
        if($this->Iqa_results->delete($id)){
            redirect('iqa_result');
        }
    }
    function clear_state()
    {
        $this->session->unset_userdata('iqa_result_search_data');
        redirect('iqa_result');
    }

    function print_iqa(){
        $selection_iqa_result = $this->input->post('selection_iqa_result');
        if(empty($selection_iqa_result)){
            redirect('iqa_result');
        }
        $data['get_query'] = $this->Iqa_results->get_iqa_user_byid($selection_iqa_result);
        $this->load->view('iqa/iqa_result/print',$data);
    }
    
}