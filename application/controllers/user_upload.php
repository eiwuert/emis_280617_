<?php 
class User_upload extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    function ca_login($user_id = -1,$ca_id = -1){
        $data['user_id'] = $user_id;
        $data['ca_id'] = $ca_id;
        $this->load->view('collaboration_agreements/do_upload',$data);
    }
    function auto_upload_file($user_id = -1, $ca_id = -1 ){
        $upload_config = array('upload_path' => dirname($_SERVER["SCRIPT_FILENAME"]).'/documents/upload_back' , 'allowed_types' => 'jpg|jpeg|gif|png|pdf|docx|doc|xlsx|xls' );
        $this->load->library('upload', $upload_config);
        if (!$this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());
            return false;
        }else{
            $upload_data = $this->upload->data();
            $data_image = array('docs_name'=>$upload_data['file_name'],'docs_type'=>$upload_data['file_ext'] );
            if($this->Collaboration_agreement->auto_upload_file($data_image, $ca_id)){
                $this->load->view('collaboration_agreements/upload_success');
            }else{
                $data['user_id'] = $user_id;
             $data['ca_id'] = $ca_id;
             $this->load->view('collaboration_agreements/do_upload',$data);
            }
            return true;
        }
    }
    function mc_login($user_id = -1,$mc_id = -1){
        $data['user_id'] = $user_id;
        $data['mc_id'] = $mc_id;
        $this->load->view('master_contract/auto_upload',$data);
    }
    function auto_upload_mc($user_id = -1, $ca_id = -1 ){
        $upload_config = array('upload_path' => dirname($_SERVER["SCRIPT_FILENAME"]).'/documents/upload_back' , 'allowed_types' => 'jpg|jpeg|gif|png|pdf|docx|doc|xlsx|xls' );
        $this->load->library('upload', $upload_config);
        if (!$this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());
            return false;
        }else{
            $upload_data = $this->upload->data();
            $data_image = array('docs_name'=>$upload_data['file_name'],'docs_type'=>$upload_data['file_ext'] );
            if($this->Master_contract->auto_upload_file($data_image, $ca_id)){
                $this->load->view('master_contract/upload_success');
            }else{
                $data['user_id'] = $user_id;
             $data['ca_id'] = $ca_id;
             $this->load->view('master_contract/auto_upload',$data);
            }
            return true;
        }
    }
    function pa_consultant_login($user_id = -1,$pa_id = -1){
        $data['user_id'] = $user_id;
        $data['pa_id'] = $pa_id;
        $this->load->view('pa_consultant/do_upload',$data);
    }
    function auto_upload_pa_consultant($user_id = -1, $ca_id = -1 ){
        $upload_config = array('upload_path' => dirname($_SERVER["SCRIPT_FILENAME"]).'/documents/upload_back' , 'allowed_types' => 'jpg|jpeg|gif|png|pdf|docx|doc|xlsx|xls' );
        $this->load->library('upload', $upload_config);
        if (!$this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());
            return false;
        }else{
            $upload_data = $this->upload->data();
            $data_image = array('docs_name'=>$upload_data['file_name'],'docs_type'=>$upload_data['file_ext'] );
            if($this->Pa_consultant->auto_upload_file($data_image, $ca_id)){
                $this->load->view('pa_consultant/upload_success');
            }else{
                $data['user_id'] = $user_id;
             $data['ca_id'] = $ca_id;
             $this->load->view('pa_consultant/do_upload',$data);
            }
            return true;
        }
    }
    function loa_login($user_id = -1,$pa_id = -1){
        $data['user_id'] = $user_id;
        $data['pa_id'] = $pa_id;
        $this->load->view('pa_clients/do_upload',$data);
    }
    function upload_loa_back($user_id = -1, $pa_id = -1 ){
        $upload_config = array('upload_path' => dirname($_SERVER["SCRIPT_FILENAME"]).'/documents/upload_back' , 'allowed_types' => 'jpg|jpeg|gif|png|pdf|docx|doc|xlsx|xls' );
        $this->load->library('upload', $upload_config);
        if (!$this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());
            return false;
        }else{
            $upload_data = $this->upload->data();
            $data_image = array('docs_name'=>$upload_data['file_name'],'docs_type'=>$upload_data['file_ext'] );
            if($this->Pa_client->auto_upload_file($data_image, $pa_id)){
                $this->load->view('pa_consultant/upload_success');
            }else{
                $data['user_id'] = $user_id;
             $data['pa_id'] = $pa_id;
             $this->load->view('pa_consultant/do_upload',$data);
            }
            return true;
        }
    }
    function upload_partnership_search_docs($user_id = -1,$caes_id = -1){
        $data['user_id'] = $user_id;
        $data['caes_id'] = $caes_id;
        $this->load->view('partnership_search/do_upload',$data);
    }
    function upload_partnership_search_back($user_id = -1, $caes_id = -1 ){
        $upload_config = array('upload_path' => dirname($_SERVER["SCRIPT_FILENAME"]).'/documents/upload_back' , 'allowed_types' => 'jpg|jpeg|gif|png|pdf|docx|doc|xlsx|xls' );
        $this->load->library('upload', $upload_config);
            if (!$this->upload->do_upload())
            {
                $error = array('error' => $this->upload->display_errors());
                return false;
            }else{
                $upload_data = $this->upload->data();
                $data_image = array('docs_name'=>$upload_data['file_name'],'docs_type'=>$upload_data['file_ext'] );
                if($this->Partnership_search->upload_partnership_search_back($data_image, $caes_id)){
                    $this->load->view('partnership_search/upload_success');
                }else{
                 $data['user_id'] = $user_id;
                 $data['es_id'] = $caes_id;
                 $this->load->view('partnership_search/do_upload',$data);
            }
            return true;
        }
    }
    function upload_pa_ca_docs($user_id = -1,$pa_id = -1){
        $data['user_id'] = $user_id;
        $data['pa_id'] = $pa_id;
        $this->load->view('partnership_search/do_upload',$data);
    }
    function upload_collaborations_paroject_agreements_back($user_id = -1, $caes_id = -1 ){
        $upload_config = array('upload_path' => dirname($_SERVER["SCRIPT_FILENAME"]).'/documents/upload_back' , 'allowed_types' => 'jpg|jpeg|gif|png|pdf|docx|doc|xlsx|xls' );
        $this->load->library('upload', $upload_config);
            if (!$this->upload->do_upload())
            {
                $error = array('error' => $this->upload->display_errors());
                return false;
            }else{
                $upload_data = $this->upload->data();
                $data_image = array('docs_name'=>$upload_data['file_name'],'docs_type'=>$upload_data['file_ext'] );
                if($this->Collaborations_project_agreement->upload_collaborations_paroject_agreements_back($data_image, $caes_id)){
                    $this->load->view('pa_collaborations/upload_success');
                }else{
                 $data['user_id'] = $user_id;
                 $data['es_id'] = $caes_id;
                 $this->load->view('pa_collaborations/do_upload',$data);
            }
            return true;
        }
    }
    function upload_executive_search_docs($user_id = -1,$es_id = -1){
        $data['user_id'] = $user_id;
        $data['es_id'] = $es_id;
        $this->load->view('executive_search/do_upload',$data);
    }
    function upload_executive_search_back($user_id = -1, $es_id = -1 ){
        $upload_config = array('upload_path' => dirname($_SERVER["SCRIPT_FILENAME"]).'/documents/upload_back' , 'allowed_types' => 'jpg|jpeg|gif|png|pdf|docx|doc|xlsx|xls' );
        $this->load->library('upload', $upload_config);
            if (!$this->upload->do_upload())
            {
                $error = array('error' => $this->upload->display_errors());
                return false;
            }else{
                $upload_data = $this->upload->data();
                $data_image = array('docs_name'=>$upload_data['file_name'],'docs_type'=>$upload_data['file_ext'] );
                if($this->Executive_search->upload_executive_search_back($data_image, $es_id)){
                    $this->load->view('executive_search/upload_success');
                }else{
                    $data['user_id'] = $user_id;
                 $data['es_id'] = $es_id;
                 $this->load->view('executive_search/do_upload',$data);
            }
            return true;
        }
    }
}