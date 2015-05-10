<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recruiter extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Load form helper library
        $this->load->helper(array('form', 'url'));
                
        $this->load->helper('view_helper');
                
        // Load form validation library
        $this->load->library('form_validation');
        
        // Load session library
        $this->load->library('session');
        $this->load->helper('language');        
        $this->load->helper('url');
        
        $this->lang->load('common');
        
        // Load database
        $this->load->model('login_database');
        
        if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != "on") {
            $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
            redirect($url);
            exit;
        }
                
    }
    
    // Employer Portal login page with user-email and password.
	public function index() {
        $session_items = array('job_detail' => '', 'logged_in' => '');
        $this->session->unset_userdata($session_items);
        
        $head_params = array(
            'title' => 'Employer Portal | Grab Talent',
            'description' => "Grab Talent is the best online recruitment portal",
            'keywords' => 'jobs singapore, recruitment agency, GT, Grab Talent',
        );
        
        $template["head"] = $this->load->view('common/head', $head_params, true);
        $template["header"] = $this->load->view('common/header', null, true);
        $template["contents"] = $this->load->view('recruiter/index', null, true);
        $this->load->view('common/layout', $template);
	}
    
    // Recruiter profile page.
    public function profile() {
        if($this->session->userdata('logged_in') != null || $this->session->userdata('logged_in') != "") {
        
            $head_params = array(
                'title' => 'Employer Portal | Grab Talent',
                'description' => "Grab Talent is the best online recruitment portal",
                'keywords' => 'jobs singapore, recruitment agency, GT, Grab Talent',
            );
            $template["head"] = $this->load->view('common/recruiter/head', $head_params, true);
            $template["header"] = $this->load->view('common/recruiter/header', null, true);
            $template["contents"] = $this->load->view('recruiter/profile', null, true);
            $this->load->view('common/recruiter/layout', $template);
        } else {
            redirect(base_url('recruiter'));
        }
    }
    
    // Check for employer login process
    public function recruiter_login() {
        
        $this->form_validation->set_rules('emailaddress', 'Email Address', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
    
        if ($this->form_validation->run() == FALSE) {
            redirect( base_url('recruiter/index') );
        } else {
            $data = array(
                'username' => $this->input->post('emailaddress'),
                'password' => $this->input->post('password')
            );
            $result = $this->login_database->employerlogin($data);

            if($result == TRUE){                                
                // Add user data in session
                $this->session->set_userdata('logged_in', $this->input->post('emailaddress'));                                
                redirect( base_url('recruiter_dashboard') );
            } else {
                $this->session->set_flashdata('error_message', 'Invalid Email Address or Password');
                redirect( base_url('recruiter') );
            }
        }
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
        
        $template["head"] = $this->load->view('common/recruiter/head', $head_params, true);
        $template["header"] = $this->load->view('common/recruiter/header', null, true);
        $template["contents"] = $this->load->view('recruiter/job', null, true);
        $this->load->view('common/recruiter/layout', $template);
    }
    
    // Check for user login process
    public function job_create() {
        
        $head_params = array(
            'title' => 'Employer Portal | Grab Talent',
            'description' => "Grab Talent is the best online recruitment portal",
            'keywords' => 'jobs singapore, recruitment agency, GT, Grab Talent',
        );
        $template["head"] = $this->load->view('common/recruiter/head', $head_params, true);
        $template["header"] = $this->load->view('common/recruiter/header', null, true);
        $template["contents"] = $this->load->view('recruiter/job_create', null, true);
        $this->load->view('common/recruiter/layout', $template);
    }
    
    public function job_register() {
        //To retrieve email from session.
        $email = $this->session->userdata('logged_in');                                        
        
        // Create Job Description
        $jobDesc = "<h2><b>".$this->input->post('inputJobTitle')."</b></h2><br />";
        $jobDesc .= "<p><b>Industry / Sub-Industry:</b>".$this->input->post('inputJobIndustry')." / ".$this->input->post('inputJobSubIndustry')."</p>";
        $jobDesc .= "<p><b>Job Category/Function:</b>".$this->input->post('inputJobCategory')."/".$this->input->post('inputJobFunction')."</p>";
        $jobDesc .= "<p><b>Salary:</b>".$this->input->post('inputJobMinSalCurrCode')." ".$this->input->post('inputJobMinSalary')." - ".$this->input->post('inputJobMaxSalCurrCode')." ".$this->input->post('inputJobMaxSalary')."</p>";
        $jobDesc .= "<p><b>Location:</b>".$this->input->post('inputJobPriworklocctry').", ".$this->input->post('inputJobPriworkloccity')."</p>";
        $jobDesc .= "<p><b>About Our Client:</b><br /></p>";
        $jobDesc .= "<p><b>Description:</b><br />".$this->input->post('inputJobDescription')."</p>";
        $jobDesc .= "<p><b>Additional Information:</b><br><br>Working Hours: 9.00am – 6.00pm (Mon – Fri)<br><br><br><br><b>EA License No.:</b>10C2978</p>";
                
        // Check validation for user input in SignUp form
        $this->load->model('grabtalent_job_model');
        
        if(!file_exists($_FILES['userfile']['name']) || !is_uploaded_file($_FILES['userfile']['name'])) {
            $video_name = '';
        } else {
            $filename  = $_FILES['userfile']['name'];
            $fileext = explode(".", $filename);
            $video_name = preg_replace("/[[:space:]]+/", "_", htmlspecialchars( $this->input->post('inputJobTitle') ) ) . "_" . date('Ymdhms').".".$fileext[1];    
        }       
                
        $JobModels = $this->_saveJobs(
            $this->input->post('inputJobTitle'),
            $this->input->post('inputJobMinSalCurrCode'),
            $this->input->post('inputJobMinSalary'),
            $this->input->post('inputJobMaxSalCurrCode'),
            $this->input->post('inputJobMaxSalary'),
            $this->input->post('inputJobTags'),
            $this->input->post('inputJobPriworklocctry'),
            $this->input->post('inputJobPriworkloccity'),
            $this->input->post('inputJobCategory'),
            $this->input->post('inputJobFunction'),
            $this->input->post('inputJobIndustry'),
            $this->input->post('inputJobSubIndustry'),
            $jobDesc,
            $this->input->post('postjob'),
            $email,
            $video_name
        );
                
        if($this->db->trans_status() == '1') {
            $this->session->set_flashdata('success_message', 'Your Job was saved successfully!');
            $this->_do_upload($video_name);
        } else {
            $this->session->set_flashdata('error_message', 'Your Job was not saved, please try again!');
        }
        redirect( base_url('/recruiter/job_create') );
    }
    
    // Logout from admin page
    public function logout() {    
        // Removing session data
        redirect( base_url('recruiter') );
    }
    
    // To save / register jobs into job table.
    private function _saveJobs($jobTitle, $jobMinSalCode, $jobMinSal, $jobMaxSalCode, $jobMaxSal, $jobTags, $jobPriwrkctry, $jobPriwrkcity, $jobCategory, $jobFunction, $jobIndustry, $jobSubIndustry, $jobDesc, $jobPosted, $createdBy, $vidname) {

        $JobModels = array();

        $this->db->trans_start();

        // setup password
        $JobModel = new grabtalent_job_model();
        $JobModel->row['job_number']                         = 'JOB-'.mt_rand();
        $JobModel->row['job_title']                          = $jobTitle;
        $JobModel->row['min_salary_currency']                = $jobMinSalCode;
        $JobModel->row['min_month_salary']                   = $jobMinSal;
        $JobModel->row['max_salary_currency']                = $jobMaxSalCode;
        $JobModel->row['max_month_salary']                   = $jobMaxSal;
        $JobModel->row['primary_work_location_country']      = $jobPriwrkctry;
        $JobModel->row['primary_work_location_city']         = $jobPriwrkcity;
        $JobModel->row['job_tags']                           = $jobTags;
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
        $JobModel->row['video_url']                          = $vidname;        
        $JobModel->save();
        array_push($JobModels, $JobModel);

        $this->db->trans_complete();

        return $JobModels;
    }
    
    public function _do_upload($flname) {
        
        $config['upload_path'] = 'public/recruiter/';
		$config['allowed_types'] = 'mp4|mov';
		$config['max_size']	= '2048';
        $config['file_name'] = $flname;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload()) {
            $this->session->set_flashdata('error_message', $this->upload->display_errors());
		} else {
            $this->session->set_flashdata('success_message', 'All Data has been uploaded successfully!!');
		}
	}
    
    // Load Forgot Password Page
    public function forgotpassword() {
        
        $head_params = array(
            'title' => 'Recruiter Forgot Password | Grab Talent',
            'description' => "Grab Talent is the best online recruitment portal",
            'keywords' => 'jobs singapore, recruitment agency, GT, Grab Talent',
        );
        $template["head"] = $this->load->view('common/head', $head_params, true);
        $template["header"] = $this->load->view('common/header', null, true);
        $template["contents"] = $this->load->view('recruiter/forgotpassword', null, true);
        $this->load->view('common/layout', $template);
    }
    
    // Send forgot password link to recruiter.    
    public function sendforgotpwd() {
        $email_chk = $this->login_database->forgot_emppasswdemailchk($this->input->post("email"));        
        if($email_chk == TRUE) {
            $config = array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://ns3-999.999servers.com',
                'smtp_port' => 465,
                'smtp_user' => 'sunil.madana.kumar@ricemerchant.com', // change it to yours
                'smtp_pass' => 'Sunil2012Swathi', // change it to yours
                'mailtype' => 'html',
                'charset'=>'utf-8',
                'wordwrap' => TRUE            
            );
            $message = $this->load->view('common/forgotpass','',true);
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from('sunil.madana.kumar@ricemerchant.com','Grab Talent'); // change it to yours
            $this->email->to($this->input->post("email"));// change it to yours
            $this->email->subject('GrabTalent : Reset Password');
            $this->email->message($message);
            if($this->email->send()) {
                echo "success";
            } else {
                //show_error($this->email->print_debugger());
                echo "failure";
            }
        } else {
            echo "This email is not registered with us!";
        }
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */