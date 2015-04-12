<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Candidate extends CI_Controller {
    
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
    
	public function index() {
        $head_params = array(
            'title' => 'Job Seeker Portal | Grab Talent',
            'description' => "Grab Talent is the best online recruitment portal",
            'keywords' => 'jobs singapore, recruitment agency, GT, Grab Talent',
        );
        
        $template["head"] = $this->load->view('common/head', $head_params, true);
        $template["header"] = $this->load->view('common/header', null, true);
        $template["contents"] = $this->load->view('candidate/index', null, true);
        $this->load->view('common/layout', $template);
	}
    
    // Validate and store registration data in database
    public function register() {
    
        // Check validation for user input in SignUp form
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'trim|required|xss_clean');
        
        if ($this->form_validation->run() == FALSE) {
            $head_params = array(
                'title' => 'Candidate Registration | Grab Talent',
                'description' => "Grab Talent is the best online recruitment portal",
                'keywords' => 'jobs singapore, recruitment agency, GT, Grab Talent',
            );
            
            $template["head"] = $this->load->view('common/head', $head_params, true);
            $template["header"] = $this->load->view('common/header', null, true);
            $template["contents"] = $this->load->view('candidate/register', null, true);
            $this->load->view('common/layout', $template);
        } else {
            $this->session->set_userdata('emailaddress', $this->input->post('email'));
            $this->load->model('Grabtalent_signup_model');
            $code = Grabtalent_signup_model::generate_unique_code();
            $logindata = array(
                'unique_code' => $code,
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
                'type' => 'candidate'
            );
            $result = $this->login_database->registration_insert($logindata);
            if ($result == TRUE) {
                redirect( base_url('signup') );                
            } else {
                $this->session->set_flashdata('error_message', 'Username / Email Address already exist!');
                redirect( base_url('candidate/register') );
            }
        }
    }
        
    // Check for user login process
    public function candidate_login() {
                
        $this->form_validation->set_rules('emailaddress', 'Email Address', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
    
        if ($this->form_validation->run() == FALSE) {
            redirect( base_url('candidate/index') );
        } else {
            $data = array(
                'emailaddress' => $this->input->post('emailaddress'),
                'password' => $this->input->post('password')
            );                        
            $result = $this->login_database->candidatelogin($data);
            
            if($result == TRUE){                
                // Add user data in session
                $this->session->set_userdata('logged_in', $this->input->post('emailaddress'));
                redirect( base_url('candidate_dashboard') );
            } else {
                $this->session->set_flashdata('error_message', 'Invalid Username or Password');
                redirect( base_url('candidate') );
            }
        }
    }
    
    // Logout from admin page
    public function jobs() {
        $head_params = array(
            'title' => 'Employer Portal | Grab Talent',
            'description' => "Grab Talent is the best online recruitment portal",
            'keywords' => 'jobs singapore, recruitment agency, GT, Grab Talent',
        );
        $template["head"] = $this->load->view('common/candidate/head', $head_params, true);
        $template["header"] = $this->load->view('common/candidate/header', null, true);
        $template["contents"] = $this->load->view('candidate/jobs', null, true);
        $this->load->view('common/candidate/layout', $template);
    }
    
    public function job() {
        $jobnumber = $this->uri->segment(3);
        $job_detail = $this->login_database->read_job_information($jobnumber);
        $this->session->set_userdata('job_detail', $job_detail);

        $head_params = array(
            'title' => 'Employer Portal | Grab Talent',
            'description' => "Grab Talent is the best online recruitment portal",
            'keywords' => 'jobs singapore, recruitment agency, GT, Grab Talent',
        );
        
        $template["head"] = $this->load->view('common/candidate/head', $head_params, true);
        $template["header"] = $this->load->view('common/candidate/header', null, true);
        $template["contents"] = $this->load->view('candidate/job', null, true);
        $this->load->view('common/candidate/layout', $template);
    }
    
    public function registercandidate_application() {
        
        $this->load->model('grabtalent_application_model');
        $logindata = array(
            'job_id' => $this->input->post('jobId'),
            'email' => $this->session->userdata('logged_in'),
            //'firstname' => null,
            //'lastname' => null,
            //'phonenumber' => null,
            //'location' => null,
            //'visa_status' => null,
            //'salary' => null,
            //'resume_url' => null,
            'created_date' => null,
        );
        
        $ApplicationModels = $this->_saveApplication(
            $this->input->post('jobId'),
            $this->session->userdata('logged_in')
        );
                
        if($this->db->trans_status() == '1') {
            echo "accepted";
        } else {
            echo "failed";
        }

	}
    
    // Logout from admin page
    public function logout() {    
        // Removing session data
        $sess_array = array('username' => '');
        $this->session->unset_userdata('logged_in', $sess_array);
        $this->session->set_flashdata('success_message', 'Logout successful!');
        redirect( base_url('candidate') );
    }
    
    
    public function _do_upload($flname) {
        
		$config['upload_path'] = 'application/views/candidate/resume/';
		$config['allowed_types'] = 'doc|docx|pdf|rtf|txt';
		$config['max_size']	= '2048';
        $config['file_name'] = $flname;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload()) {
            $this->session->set_flashdata('error_message', $this->upload->display_errors());
		} else {
            $this->session->set_flashdata('success_message', $this->upload->data());
		}
	}
    
    // To save / register jobs into job table.
    private function _saveApplication($jobNumber, $CandEmail) {

        $ApplicationModels = array();

        $this->db->trans_start();

        // setup password
        $ApplicationModel = new grabtalent_application_model();
        $ApplicationModel->row['job_id']                         = $jobNumber;
        $ApplicationModel->row['email']                          = $CandEmail;
        //$ApplicationModel->row['min_month_salary']                   = $jobMinSal;
        //$ApplicationModel->row['max_month_salary']                   = $jobMaxSal;
        //$ApplicationModel->row['primary_work_location_country']      = $jobPriwrkctry;
        //$ApplicationModel->row['primary_work_location_city']         = $jobPriwrkcity;
        //$ApplicationModel->row['currency']                           = $jobCurrency;
        //$ApplicationModel->row['job_category']                       = $jobCategory;
        //$ApplicationModel->row['job_function']                       = $jobFunction;
        //$ApplicationModel->row['job_industry']                       = $jobIndustry;
        //$ApplicationModel->row['job_sub_industry']                   = $jobSubIndustry;
        //$ApplicationModel->row['job_description']                    = $jobDesc;
        //$ApplicationModel->row['post_date']                          = date('Y-m-d h:m:s');
        //$ApplicationModel->row['post_job']                           = $jobPosted;
        //$ApplicationModel->row['created_by']                         = $createdBy;
        $ApplicationModel->row['created_date']                       = date('Y-m-d h:m:s');
        //$ApplicationModel->row['view_count']                         = '0';
        //$ApplicationModel->row['text_search']                        = '';
        //$ApplicationModel->row['delete_flg']                         = '0';
        //$ApplicationModel->row['video_url']                          = $vidname;        
        $ApplicationModel->save();
        array_push($ApplicationModels, $ApplicationModel);

        $this->db->trans_complete();

        return $ApplicationModels;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */