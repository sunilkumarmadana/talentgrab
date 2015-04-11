<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employer extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Load form helper library
        $this->load->helper('form');
        
        // Load form validation library
        $this->load->library('form_validation');
        
        // Load session library
        $this->load->library('session');
        
        // Load database
        $this->load->model('login_database');
        
    }
    
    // Employer Portal login page with user-email and password.
	public function index() {
        $head_params = array(
            'title' => 'Employer Portal | Grab Talent',
            'description' => "Grab Talent is the best online recruitment portal",
            'keywords' => 'jobs singapore, recruitment agency, GT, Grab Talent',
        );
        
        $template["head"] = $this->load->view('common/head', $head_params, true);
        $template["header"] = $this->load->view('common/header_login', null, true);
        $template["contents"] = $this->load->view('employer/index', null, true);
        $this->load->view('common/login/layout', $template);
	}
    
    // Check for employer login process
    public function employer_login() {
        
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
    
        if ($this->form_validation->run() == FALSE) {
            redirect( base_url('employer/index') );
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password')
            );
            $result = $this->login_database->employerlogin($data);
            if($result == TRUE){
                $sess_array = array('username' => $this->input->post('username'));
                // Add user data in session
                $this->session->set_userdata('logged_in', $sess_array);
                $result = $this->login_database->read_user_information($sess_array, 'employer');                                
                redirect( base_url('employer/home') );  
                
            } else {
                $this->session->set_flashdata('error_message', 'Invalid Username or Password');
                redirect( base_url('employer') );
            }
        }
    }
    
    // Employer Home Dashboard screen
    public function home() {
        $login_usr = $this->session->userdata('logged_in');
        $sess_array = array('username' => $login_usr['username']);
                
        // Add user data in session
        $jobs = $this->login_database->read_job_information($sess_array);
        $this->session->set_userdata('jobs', $jobs);
        
        $head_params = array(
            'title' => 'Employer Portal | Grab Talent',
            'description' => "Grab Talent is the best online recruitment portal",
            'keywords' => 'jobs singapore, recruitment agency, GT, Grab Talent',
        );
        $template["head"] = $this->load->view('common/login/head', $head_params, true);
        $template["header"] = $this->load->view('common/login/header', null, true);
        $template["contents"] = $this->load->view('employer/home', null, true);
        $this->load->view('common/login/layout', $template);        
    }
    
    // Check for user login process
    public function job_create() {
        $head_params = array(
            'title' => 'Employer Portal | Grab Talent',
            'description' => "Grab Talent is the best online recruitment portal",
            'keywords' => 'jobs singapore, recruitment agency, GT, Grab Talent',
        );
        $template["head"] = $this->load->view('common/login/head', $head_params, true);
        $template["header"] = $this->load->view('common/login/header', null, true);
        $template["contents"] = $this->load->view('employer/job_create', null, true);
        $this->load->view('common/login/layout', $template);
    }
    
    public function job_register() {
        //To retrieve email from session.
        $email = $this->session->userdata('logged_in');
                
        // Check validation for user input in SignUp form
        $this->load->model('grabtalent_job_model');        
        $JobModels = $this->_saveJobs(
            $this->input->post('inputJobTitle'),
            $this->input->post('inputJobMinSalary'),
            $this->input->post('inputJobMaxSalary'),
            $this->input->post('inputJobPriworklocctry'),
            $this->input->post('inputJobPriworkloccity'),
            $this->input->post('inputJobCurrency'),
            $this->input->post('inputJobCategory'),
            $this->input->post('inputJobFunction'),
            $this->input->post('inputJobIndustry'),
            $this->input->post('inputJobSubIndustry'),
            $this->input->post('inputJobDescription'),
            $this->input->post('postjob'),
            $email['username']
        );
        if($this->db->trans_status() == '1') {
            $this->session->set_flashdata('success_message', 'Your Job was saved successfully!');
        } else {
            $this->session->set_flashdata('error_message', 'Your Job was not saved, please try again!');            
        }
        redirect( base_url('employer/job_create') );
    }
    // Logout from admin page
    public function logout() {    
        // Removing session data
        $sess_array = array('username' => '');
        $this->session->unset_userdata('logged_in', $sess_array);
        $data['message_display'] = 'Successfully Logout';
        $this->session->sess_destroy();
        redirect( base_url('employer') );
    }
    
    private function _saveJobs($jobTitle, $jobMinSal, $jobMaxSal, $jobPriwrkctry, $jobPriwrkcity, $jobCurrency, $jobCategory, $jobFunction, $jobIndustry, $jobSubIndustry, $jobDesc, $jobPosted, $createdBy) {

        $JobModels = array();

        $this->db->trans_start();

        // setup password
        $JobModel = new grabtalent_job_model();
        $JobModel->row['job_number']                         = 'JOB-'.mt_rand();
        $JobModel->row['job_title']                          = $jobTitle;
        $JobModel->row['min_month_salary']                   = $jobMinSal;
        $JobModel->row['max_month_salary']                   = $jobMaxSal;
        $JobModel->row['primary_work_location_country']      = $jobPriwrkctry;
        $JobModel->row['primary_work_location_city']         = $jobPriwrkcity;
        $JobModel->row['currency']                           = $jobCurrency;
        $JobModel->row['job_category']                       = $jobCategory;
        $JobModel->row['job_function']                       = $jobFunction;
        $JobModel->row['job_industry']                       = $jobIndustry;
        $JobModel->row['job_sub_industry']                   = $jobSubIndustry;
        $JobModel->row['job_description']                    = $jobDesc;
        $JobModel->row['post_date']                          = date('Y-m-d h:m:s');
        $JobModel->row['post_job']                           = $jobPosted;
        $JobModel->row['created_by']                         = $createdBy;
        $JobModel->row['created_date']                       = date('Y-m-d h:m:s');
        $JobModel->row['view_count']                         = '0';
        $JobModel->row['text_search']                        = '';
        $JobModel->row['delete_flg']                         = '0';
        $JobModel->save();
        array_push($JobModels, $JobModel);

        $this->db->trans_complete();

        return $JobModels;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */