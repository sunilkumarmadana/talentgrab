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
        
        $this->load->helper('cookie');
        $this->load->helper('language');
        $this->load->helper('url');
        
        $this->lang->load('common');
        
        // Load database
        $this->load->model('login_database');
        
        $curr_lang = $this->lang->lang();
        
        if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != "on") {
            $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
            redirect($url);
            exit;
        }
                
    }
    
    // Employer Portal login page with user-email and password.
	public function index() {
        $session_items = array('job_detail' => '', 'logged_in' => '', 'user_data' => '');
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
                echo "success; Please check your email for new password!";
            } else {
                //show_error($this->email->print_debugger());
                echo "failure; Email was not sent, please try again.";
            }
        } else {
            echo "This email is not registered with us!";
        }
    }
    
    // Change password
    public function change_candidate_password() {
        
        $newpassword = md5($this->input->post('newpassword')); 
        
        // To initially check if the email is registered in the system.
        $condition = "employer_email =" . "'" . $this->input->post('employer-email') . "'";
        $this->db->select('*');
        $this->db->from('employer_login');
        $this->db->where($condition);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = array('employer_password' => $newpassword);
            $this->db->where('employer_email', $this->input->post('employer-email'));
            $this->db->update('employer_login', $data);
            if($this->db->trans_status() == '1') {
                echo "success";
            } else {
                echo "failure";            
            }
        } else {
            return false;
        }
    }
        
    // Check for employer login process
    public function recruiter_login() {
        
        $data = array(
            'username' => $this->input->post('emailaddress'),
            'password' => $this->input->post('password')
        );
        $result = $this->login_database->employerlogin($data);
        
        if($result == TRUE){                                
            // Add user data in session
            $this->session->set_userdata('logged_in', $this->input->post('emailaddress'));                        
            $redirect_url = str_replace('http://','https://',base_url()).$this->lang->lang()."/recruiter_dashboard";
            echo "success,".$redirect_url;
        } else {
            echo "error,Invalid Username or Password";
        }
        
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
            redirect( secure_url($curr_lang.'/recruiter') );
        }
    }
    
    // Recruiter profile update.
    public function profile_update() {
        // 1. Updated Profile data        
        $recruiter_profupd = array(
            'employer_phone' => $this->input->post('inputPhonenumber'),
            'employer_fax' => $this->input->post('inputFaxnumber'),
            'employer_contact_firstname' => $this->input->post('inputEmpctntFirstName'),
            'employer_contact_lastname' => $this->input->post('inputEmpctntLastName'),
            'employer_description' => $this->input->post('inputbriefDesc')                                             
        );
        $this->db->where('employer_contact_email', $this->input->post('profile-email'));
        $this->db->update('employers', $recruiter_profupd);
        if($this->db->trans_status() == '1') {
            echo "success;Your Profile has been updated successfully!!";
        } else {
            echo "failure;Profile was not updated, please try again!";
        }
                        
        // 2. Refresh session data
        $sess_array = array('username' => $this->session->userdata('logged_in'));
        $empinfo = $this->login_database->read_user_information($sess_array,'employer');
        $this->session->set_userdata('user_data', $empinfo);
    }
    
    public function job() {
        $jobnumber = $this->uri->segment(4);
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
                
        // Check validation for user input in SignUp form
        $this->load->model('grabtalent_job_model');       
        $video_name = '';
        
        $JobModels = $this->_saveJobs(
            $this->input->post('inputJobTitle'),
            $this->input->post('inputJobMinSalCurrCode'),
            $this->input->post('inputJobMinSalary'),
            $this->input->post('inputJobMaxSalCurrCode'),
            $this->input->post('inputJobMaxSalary'),
            $this->input->post('inputJobMandatorySkl'),
            $this->input->post('inputJobDesiredSkl'),
            $this->input->post('inputJobPriworklocctry'),
            $this->input->post('inputJobPriworkloccity'),
            $this->input->post('inputJobCategory'),
            $this->input->post('inputJobFunction'),
            $this->input->post('inputJobIndustry'),
            $this->input->post('inputJobSubIndustry'),
            $this->input->post('inputJobDescription'),
            $this->input->post('inputJobBenefits'),
            $this->input->post('inputJobWorkingHours'),
            $this->input->post('postjob'),
            $email,
            $video_name
        );
                
        if($this->db->trans_status() == '1') {
            echo "success;Your Job was saved successfully!";            
            if( !is_uploaded_file($_FILES['userfile']['name']) ) {
                $video_name = '';
            } else {
                $filename  = $_FILES['userfile']['name'];
                $fileext = explode(".", $filename);
                $video_name = preg_replace("/[[:space:]]+/", "_", htmlspecialchars( $this->input->post('inputJobTitle') ) ) . "_" . date('Ymdhms').".".$fileext[1];    
            }
        } else {
            echo "error;Your Job was not saved, please try again!";
        }
    }
    
    // To save / register jobs into job table.
    private function _saveJobs($jobTitle, $jobMinSalCode, $jobMinSal, $jobMaxSalCode, $jobMaxSal, $mandtSkills, $desiredSkills, $jobPriwrkctry, $jobPriwrkcity, $jobCategory, $jobFunction, $jobIndustry, $jobSubIndustry, $jobDesc, $jobBenefits, $jobWorkinghrs, $jobPosted, $createdBy, $vidname) {

        $JobModels = array();

        $this->db->trans_start();                                

        // setup password
        $JobModel = new grabtalent_job_model();
        $JobModel->row['job_number']                         = 'JOB-'.date('ym').'-'.mt_rand(10000000, 99999999);
        $JobModel->row['job_title']                          = $jobTitle;
        $JobModel->row['job_minsalary_currency']             = $jobMinSalCode;
        $JobModel->row['job_minmonth_salary']                = $jobMinSal;
        $JobModel->row['job_maxsalary_currency']             = $jobMaxSalCode;
        $JobModel->row['job_maxmonth_salary']                = $jobMaxSal;
        $JobModel->row['job_primaryworklocation_country']    = $jobPriwrkctry;
        $JobModel->row['job_primaryworklocation_city']       = $jobPriwrkcity;
        $JobModel->row['job_mandatory_skills']               = $mandtSkills;
        $JobModel->row['job_desired_skills']                 = $desiredSkills;
        $JobModel->row['job_category']                       = $jobCategory;
        $JobModel->row['job_function']                       = $jobFunction;
        $JobModel->row['job_industry']                       = $jobIndustry;
        $JobModel->row['job_sub_industry']                   = $jobSubIndustry;
        $JobModel->row['job_description']                    = htmlEntities($jobDesc);
        $JobModel->row['job_benefits']                       = $jobBenefits;
        $JobModel->row['job_workinghours']                   = $jobWorkinghrs;
        $JobModel->row['job_postdate']                       = date('Y-m-d h:m:s');
        $JobModel->row['job_posted']                         = $jobPosted;
        $JobModel->row['job_created_by']                     = $createdBy;
        $JobModel->row['job_created_date']                   = date('Y-m-d h:m:s');
        $JobModel->row['job_view_count']                     = '0';
        $JobModel->row['job_active']                         = 'Yes';
        $JobModel->row['job_video_url']                      = $vidname;        
        $JobModel->save();
        array_push($JobModels, $JobModel);

        $this->db->trans_complete();

        return $JobModels;
    }
        
    // Logout from admin page
    public function logout() {    
        // Removing session data
        redirect( secure_url($curr_lang.'/recruiter') );
    }    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */