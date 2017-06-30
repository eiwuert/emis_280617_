<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of register
 *
 * @author Borey
 */
class Sign_up extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('encrypt');
        $this->load->model('registers');
    }

    function index() {
        $this->load->view('register/register');
    }

    // use for register submit
    public function save() {
        if ($this->input->post('username')) {
            $this->user_model->add_user();
            $this->load->view('login/login');
        } else {
            $this->load->view('register/register');
        }
    }

    function do_register() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('first_name', 'first_name', 'required');
        $this->form_validation->set_rules('last_name', 'last_name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('username', 'User Name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
        $this->form_validation->set_rules('passconf', ' Password Confirmation ', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            redirect('sign_up');
        } else {
            $data = array(
                'email' => $this->input->post('email')
            );
            $password = array(
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
                'person_id' => ''
            );
            if($this->input->post('user_type')== 'consultant'){
                echo 'consultant';
            }
            
             $this->registers->add_user($data, $password);
           redirect('login');
           
        }
    }
    // this function use to set permission for registered users
    function set_permission($id,$type) {
        //corporat
        if($type==4){
            $data_permission = array(array('users', $id),
                                     array('customers',$id),
                                     array('course_schedule',$id));
            $data_permission_action = array(array('users', $id, 'add_update'),
                                            array('customers', $id, 'add_update'),
                                            array('customers', $id, 'delete'),
                                            array('customers', $id, 'search'),
                                            array('course_schedule', $id, 'add_update'),
                                            array('course_schedule', $id, 'delete'),
                                            array('course_schedule', $id, 'search'));
        
          //trainee  
        }else if($type==8){
            $data_permission = array(array('customers', $id));
            $data_permission_action = array(array('customers', $id, 'add_update'));
        
            
         //individual
        }else if($type==3){
            $data_permission = array(array('users', $id),
                                     array('course_schedule',$id));
            $data_permission_action = array(array('users', $id, 'add_update'),
                                            array('course_schedule', $id, 'add_update'),
                                            array('course_schedule', $id, 'delete'),
                                            array('course_schedule', $id, 'search'));
        }
       
       //loop to set permission
       for($i=0;$i<count($data_permission);$i++){
           $data['module_id']=$data_permission[$i][0];
           $data['person_id']=$data_permission[$i][1];
           $insert_query = $this->db->insert_string('permissions', $data);
           $insert_query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $insert_query);
           $this->db->query($insert_query);
       }
       //loop to set permission action 
       for($i=0;$i<count($data_permission_action);$i++){
           $data_action['module_id']=$data_permission_action[$i][0];
           $data_action['person_id']=$data_permission_action[$i][1];
           $data_action['action_id']=$data_permission_action[$i][2];
           $insert_query = $this->db->insert_string('permissions_actions', $data_action);
           $insert_query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $insert_query);
           $this->db->query($insert_query);
       }
    }
}
