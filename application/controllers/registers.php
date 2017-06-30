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
class Registers extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Recruitment_model');
    }

    function index() {
        $this->load->view('register/register');

    } 

    function consultant() {
        $this->load->view('register/consultants');
    }

    function candidate_management(){
        $data["industries"]     = $this->Recruitment_model->getAllIndustries();
        $data["categories"]     = $this->Recruitment_model->getAllCategories();
        $data["job_levels"]     = $this->Recruitment_model->getAllJobLevels();
        $data["job_locations"]  = $this->Recruitment_model->getAllJobLocations();
        
        if($this->input->post()) {
            if($this->add_user_application()) {
                redirect('registers/recruitment_submit');
            }
        }

        $this->load->view('register/recruitment', $data);
    }


    private function add_user_application($application_id=-1, $docs_id=-1)
    {  
        // Form Validation
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('applyFor', 'Apply For', 'required'); 
        $this->form_validation->set_rules('applicantName', 'Applicant Name', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
        $this->form_validation->set_rules('telephone', 'Telephone', 'required');
        $this->form_validation->set_rules('year_of_experience','Year of experiences', 'required|alpha_numeric');
        if (empty($_FILES['upload_resume']['name']))
        {
            $this->form_validation->set_rules('upload_resume', 'Document', 'required');
        }
        
        if ($this->form_validation->run() != FALSE) {            
            // Experience
            $employer   = $this->input->post('employer') != FALSE ? $this->input->post('employer'):array();
            $role       = $this->input->post('role') != FALSE ? $this->input->post('role'):array();
            $start_date = $this->input->post('start_date') != FALSE ? $this->input->post('start_date'):array();
            $end_date   = $this->input->post('end_date') != FALSE ? $this->input->post('end_date'):array();

            $experience_datas = [];
            foreach($employer as $k => $value) {
                $experience_datas[] = array(
                    'experiences' => $value,
                    'employer' => $employer[$k],
                    'role' => $role[$k],
                    'start_date' => date('Y-m-d',strtotime($start_date[$k])),
                    'end_date' => date('Y-m-d', strtotime($end_date[$k] ))
                );
                
            }

            // Skills
            $skills = $this->input->post('skill');
            $proficiency_skill = $this->input->post('proficiency_skill') != FALSE ? $this->input->post('proficiency_skill'):array();

            $skill_datas = [];
            foreach($skills as $k => $v) {
                $skill_datas[] = array(
                    'skill' => $v,
                    'proficiency' => $proficiency_skill[$k]
                );
            }

            // Languages
            $languages = $this->input->post('languages');
            $proficiency_langs = $this->input->post('proficiency_lang') != FALSE ? $this->input->post('proficiency_lang'):array();
            $lang_datas = [];

            foreach($languages as $k => $v) {
                $lang_datas[] = array(
                    'langauge' => $v,
                    'proficiency' => $proficiency_langs[$k]
                );
            }

            $insert_data_experiences = array(
                'year_of_experience' => $this->input->post('year_of_experience'),
                'history' => serialize($experience_datas),
                'skill' => serialize($skill_datas),
                'language' => serialize($lang_datas)                
            );
            
            $qualifications = $this->input->post('qualification')!= FALSE ? $this->input->post('qualification'):array();
            $university = $this->input->post('institute_university')!= FALSE ? $this->input->post('institute_university'):array();
            $major = $this->input->post('field_of_study')!= FALSE ? $this->input->post('field_of_study'):array();
            $graduated_date = $this->input->post('graduated_date')!= FALSE ? $this->input->post('graduated_date'):array();

            $insert_data_educations = array();
            foreach ($qualifications as $key => $qualification) {
                $insert_data_educations[] = array(
                    'qualification' => $qualifications[$key] ,
                    'university' => $university[$key],
                    'major' => $major[$key],
                    'graduated_date' => $graduated_date[$key]
                );
            }
            
            $insert_data_application_forms = array(
                'apply_for' => $this->input->post('applyFor'),
                'applicant_name' => $this->input->post('applicantName'),
                'gender' => $this->input->post('gender'),
                'email' => $this->input->post('email'),
                'country_code' => $this->input->post('country_code'),
                'country_name' => $this->input->post('country'),
                'referral_person' => $this->input->post('country_code'),
                'phone' => $this->input->post('telephone'),
                'created_at' => date('Y-m-d'),
                'dob' => date('Y-m-d', strtotime($this->input->post('dob'))),
                'nationality_name' => $this->input->post('nationality')!='' ? $this->input->post('nationality') : NULL,
                'industry_id' => $this->input->post('industry') != "" ? $this->input->post('industry') : NULL,
                'category_id' => $this->input->post('category') != "" ? $this->input->post('category') : NULL,
                'job_level_id' => $this->input->post('job_level') != "" ? $this->input->post('job_level') : NULL,
                'job_type' => $this->input->post('job_type'),
                'prefer_job_location_id' => NULL,
            );

            $this->load->library('upload');
            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'pdf|doc|docx|gif|jpg|png';
            $this->upload->initialize($config); 

            if(!$this->upload->do_upload('upload_resume')) {
                return false;
            }

            $insert_data = $this->upload->data();

            $insert_data_documents = [
                'docs_name' => $insert_data['file_name'],
                'docs_type' => $insert_data['file_type'],
                'docs_size' => $insert_data['file_size']
            ];
            
            if ($this->Recruitment_model->add_user_application($insert_data_experiences,
                    $insert_data_educations,
                    $insert_data_application_forms,
                    $insert_data_documents
                )
            ) {
                return true;
            }
            return false;
        } else {
            return false;
        }
    }

    function collaborations() {
        $this->load->view('register/collaborations');
    }

    function client() {
        $this->load->view('register/customers');
    }

    function insert() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $checked = $this->input->post('account');
        if ((int) $checked == 1) {
            $collaboration = array(
                'company_name' => $this->input->post('company_name'),
                'company_registration_num' => $this->input->post('conpany_register_num'),
                'phone_number' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'registered_address' => $this->input->post('register_office_add'),
                'directors_name' => $this->input->post('full_name_directors'),
                'primary_collaborator' => $this->input->post('full_name_primary_collaborator'),
                'country' => $this->input->post('country'),
                'bank_number' => $this->input->post('bank_number'),
                'bank_code' => $this->input->post('bank_code'),
                'bank_name' => $this->input->post('bank_name'),
                'bank_address' => $this->input->post('bank_address'),
                'swift_code' => $this->input->post('swift_code'),
                'branch_code' => $this->input->post('branch_code')
            );
        } else {
            $collaboration = array(
                'company_name' => $this->input->post('company_name'),
                'company_registration_num' => $this->input->post('conpany_register_num'),
                'phone_number' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'registered_address' => $this->input->post('register_office_add'),
                'directors_name' => $this->input->post('full_name_directors'),
                'primary_collaborator' => $this->input->post('full_name_primary_collaborator'),
                'country' => $this->input->post('country'),
                'nationality' =>$this->input->post('nationality'),
                'bank_number' =>$this->input->post('bank_number'),
                'bank_code' =>$this->input->post('bank_code'),
                'bank_address' =>$this->input->post('bank_address'),
                'bank_name' =>$this->input->post('bank_name'),
                'branch_code' =>$this->input->post('branch_code'),
                'swift_code' =>$this->input->post('swift_code'),
            );
        }
        $consultants = array(
            'full_name' => $this->input->post('full_name'),
            'email' => $this->input->post('email'),
            'phone_number' => $this->input->post('mobile'),
            'res_number' => $this->input->post('res_tel'),
            'office_number' => $this->input->post('off_tel'),
            'address_1' => $this->input->post('address'),
            'country' => $this->input->post('country'),
            'nationality' => $this->input->post('nationality'),
            'bank_number' => $this->input->post('bank_number'),
            'bank_code' => $this->input->post('bank_code'),
            'branch_code' => $this->input->post('branch_code'),
            'swift_code' => $this->input->post('swift_code'),
            'dob' => $this->input->post('dob') ? date('Y-m-d', strtotime($this->input->post('dob'))) : NULL,
            'passport_expiry_date' => $this->input->post('pass_date') ? date('Y-m-d', strtotime($this->input->post('pass_date'))) : NULL,
            'passport' => $this->input->post('passport'),
            'education' => $this->input->post('education'),
            'work_experience' => $this->input->post('work_experience'),
            'video' => $this->input->post('video'),
            'contact_name' => $this->input->post('contact_name'),
            'contact_number' => $this->input->post('contact_number'),
            'relationship' => $this->input->post('relationship'),
            'languages' => $this->input->post('languages')
        );

        if ($this->input->post('user_type') == 'customers') {
            $customers = array(
                'company_name' => $this->input->post('company_name'),
                'designation' => $this->input->post('designation'),
                'office_number' => $this->input->post('tel_num'),
                'company_registration_num' => $this->input->post('company_reg'),
                'directors_name' => $this->input->post('company_director'),
                'person_contact' => $this->input->post('person_contact'),
                'email' => $this->input->post('email'),
                'phone_number' => $this->input->post('mobile'),
                'address_1' => $this->input->post('address')
            );
        }
        if ($this->input->post('user_type') == 'collaborations') {
            $account = array(
                'user_type_id' => 5
            );
        } elseif ($this->input->post('user_type') == 'consultant') {
            $account = array(
                'user_type_id' => 4,
                'lang_primary' => $this->input->post('primary')
            );
        } elseif ($this->input->post('user_type') == 'customers') {
            $account = array(
                'user_type_id' => 3
            );
        }
        if (!$this->input->post('user_type')) {
            redirect('register/');
        } elseif ($this->input->post('user_type') == 'collaborations') {
            if ((int) $checked == 1) {
                $this->form_validation->set_rules('company_name', 'Company Name', 'required');
                $this->form_validation->set_rules('conpany_register_num', 'Company Register Number', 'required');

                if ($this->form_validation->run()) {
                    redirect('registers/collaborations');
                } else {
                    $this->Register->save($collaboration, $account);
                   echo json_encode(array('success'=>TRUE, 'message' => 'Successfully saved'));
                }
            } else {

                    $insert = $this->Register->save($collaboration, $account);
                    if ($insert = 0) {
                        $data['error'] = lang('common_already_have_account');
                        $this->load->view('register/collaborations', $data);
                    } else {
                        $this->sendMail($collaboration['email'], $collaboration['primary_collaborator'], 'Collaboration', $collaboration['company_name']);
                    }
                
            }
        } elseif ($this->input->post('user_type') == 'consultant') {
            if($this->Register->save($consultants, $account)) {

                $this->load->library('upload');
                $config['upload_path']   = './uploads/';
                $config['allowed_types'] = 'pdf|doc|docx|gif|jpg|png';
                $this->upload->initialize($config); 

                if(!$this->upload->do_upload('document_consultant')) {
                    redirect('registers/consultant');
                }

                $insert_data = $this->upload->data();


                $insert_data_documents = [
                    'docs_name' => $insert_data['file_name'],
                    'docs_type' => $insert_data['file_type'],
                    'docs_size' => $insert_data['file_size']
                ];

                if ($this->Person->save_document($insert_data_documents, false)) {
                    $person_consultant['doc_id'] = $insert_data_documents['id'];
                    $this->Person->update_person_docid($person_consultant, $account['person_id']);
                }

                $this->sendMail($consultants['email'], $consultants['full_name'], 'Consultant');
                   
            } else {
                redirect('registers/consultant');
            }
        } elseif ($this->input->post('user_type') == 'customers') {
            $this->form_validation->set_rules('company_name', ' Company Name', 'trim|required|xss_clean');
            $this->form_validation->set_message('company_name', 'required', 'Enter your Name');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('mobile', 'Mobile ', 'required|regex_match[/^[0-9]+$/]|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                redirect('registers/client');
            } else {

                $insert = $this->Register->save($customers, $account);
                if ($insert = 0) {
                    $data['error'] = lang('common_already_have_account');
                    $this->load->view('registers/client', $data);
                } elseif ($insert == -1) {
                    $data['error'] = lang('can_not_create_new_account');
                    $this->load->view('registers/client', $data);
                } else {
                    
                    $this->sendMail($customers['email'], $customers['person_contact'], 'Client', $customers['company_name']);
                }
            }
        }
    }

    // this funcation use for confirm 
    function confirm() {
        $this->load->view('register/confirm');
    }

    // submitted recruitment form
    function recruitment_submit() {
        $this->load->view('register/recruitment_submit');
    }

    function sendMail($email, $name, $userType, $company = null) {
        $this->load->library('email');
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from('no-reply@asialeap.com');
        $this->email->to($this->config->item('manager_email'));
        $this->email->subject('New registration');
        $this->email->message('
            <html>
                <h3>Dear Asia Leap,</h3>
                <p>You have a new user registration on '.date('Y-m-d').'.</p>
                <p><b>Name:</b> '.$name.'</p>
                <p><b>Company:</b> '.$company.'</p>
                <p><b>User type:</b> '.$userType.'</p>
            </html>
        ');

        if( $this->email->send()){
        	redirect('registers/confirm');
        
		} else{
            show_error($this->email->print_debugger());
        }
    }

}