<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Candidate extends CI_Controller {
    
    public function __construct() {
        parent::__construct();

        // Load form helper library
        $this->load->helper('form');
        
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
    
	public function index() {
        $session_items = array('user_data' => '', 'logged_in' => '');
        $this->session->unset_userdata($session_items);
        
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
        
        $passWd = $this->input->post('password');
        $confrmpassWd = $this->input->post('confirmpassword');
        
        if( $passWd != $confrmpassWd) {
            $this->session->set_flashdata('error_message', 'Passwords do not match, Please try again!');
            redirect( base_url('candidate/register') );
        } else {
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
                    'candidate_code' => $code,
                    'candidate_email' => $this->input->post('email'),
                    'candidate_password' => md5($this->input->post('password'))
                );
                $result = $this->login_database->registration_insert($logindata);
                if ($result == TRUE) {
                    $this->session->set_userdata('emailaddress', $this->input->post('email'));
                    redirect( base_url('signup') );                
                } else {
                    $this->session->set_flashdata('error_message', 'Username / Email Address already exist!');
                    redirect( base_url('candidate/register') );
                }
            }            
        }

    }
        
    // Check for user login process
    public function candidate_login() {
                
        $this->form_validation->set_rules('emailaddress', 'Email Address', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
    
        if ($this->form_validation->run() == FALSE) {
            echo "Please enter valid Username or Password";
        } else {
            $data = array(
                'emailaddress' => $this->input->post('emailaddress'),
                'password' => $this->input->post('password')
            );
            $result = $this->login_database->candidatelogin($data);
            
            if($result == TRUE){                
                // Add user data in session
                $this->session->set_userdata('logged_in', $this->input->post('emailaddress'));
                
                $sess_array = array(
                    'username' => $this->input->post('emailaddress')
                );                        
                $result = $this->login_database->read_user_information($sess_array, 'candidate');
                $this->session->set_userdata('user_data', $result);
                echo "success";
            } else {
                echo "Invalid Username or Password";
            }
        }
    }
    
    // List all open jobs on jobs page
    public function jobs() {
        if($this->session->userdata('logged_in') != null || $this->session->userdata('logged_in') != "") {
        
            $head_params = array(
                'title' => 'Employer Portal | Grab Talent',
                'description' => "Grab Talent is the best online recruitment portal",
                'keywords' => 'jobs singapore, recruitment agency, GT, Grab Talent',
            );
            $template["head"] = $this->load->view('common/candidate/head', $head_params, true);
            $template["header"] = $this->load->view('common/candidate/header', null, true);
            $template["contents"] = $this->load->view('candidate/jobs', null, true);
            $this->load->view('common/candidate/layout', $template);
        } else {
            redirect(base_url('candidate'));
        }
    }
    
    // Candidate profile page.
    public function profile() {
        if($this->session->userdata('logged_in') != null || $this->session->userdata('logged_in') != "") {
        
            $head_params = array(
                'title' => 'Employer Portal | Grab Talent',
                'description' => "Grab Talent is the best online recruitment portal",
                'keywords' => 'jobs singapore, recruitment agency, GT, Grab Talent',
            );
            $template["head"] = $this->load->view('common/candidate/head', $head_params, true);
            $template["header"] = $this->load->view('common/candidate/header', null, true);
            $template["contents"] = $this->load->view('candidate/profile', null, true);
            $this->load->view('common/candidate/layout', $template);
        } else {
            redirect(base_url('candidate'));
        }
    }
    
    // Candidate profile submit.
    public function profile_update() {
        
        if($this->session->userdata('logged_in') != null || $this->session->userdata('logged_in') != "") {
            
            $condition = "candidate_email =" . "'" . $this->input->post('profile-email') . "'";
            $this->db->select('*');
            $this->db->from('candidate_signup');
            $this->db->where($condition);            
            $query = $this->db->get();
            foreach ($query->result_array() as $row){
                $old_phone = $row['candidate_phonenumber'];
                $old_briefDesc = $row['brief_description'];
                $old_resumeUrl = $row['resume_url'];
            }
            if($_FILES["candid_resume"]["error"] == 0) {
                $postResumename=basename($_FILES["candid_resume"]["name"]);
                $fileSize=$_FILES["candid_resume"]["size"]/1024;
                $fileType=$_FILES["candid_resume"]["type"];
                
                if($fileType=="application/msword"){
                    if($fileSize<=2048000) {
                        $extension = explode(".", $postResumename);
                        $filename = $this->input->post('profile-email')."_Resume.".$extension[1];
                        
                        $data = array(
                           'candidate_phonenumber' => $this->input->post('inputPhonenumber'),
                           'brief_description' => $this->input->post('inputbriefDesc'),
                           'resume_url' => $filename
                        );
                        
                        $this->db->where('candidate_email', $this->input->post('profile-email'));
                        $this->db->update('candidate_signup', $data);
                        if($this->db->trans_status() == '1') {                            
                            if ( !$this->_do_upload($filename)) {
                                echo "Internal Server Error occured, please try again";
                    		} else {
                                echo "Your Resume file has been updated!";
                    		}
                        } else {
                            $this->session->set_flashdata('error_message', 'Something went wrong, try again later!');
                        }       
                    } else {
                        $this->session->set_flashdata('error_message', 'File size too big, Upload Failed');
                    }
                } else {
                    $this->session->set_flashdata('error_message', 'File type not accepted, Upload Failed');
                }                
            } else {
                $filename = $old_resumeUrl;
                $data = array(
                   'candidate_phonenumber' => $this->input->post('inputPhonenumber'),
                   'brief_description' => $this->input->post('inputbriefDesc'),
                   'resume_url' => $filename
                );
                
                $this->db->where('candidate_email', $this->input->post('profile-email'));
                $this->db->update('candidate_signup', $data);
                if($this->db->trans_status() == '1') {
                    $this->session->set_flashdata('success_message', 'Your profile information has been updated!');
                } else {
                    $this->session->set_flashdata('error_message', 'Something went wrong, try again later!');
                }
            }
            
            $this->session->unset_userdata('user_data');
            $sess_array = array(
                'username' => $this->input->post('profile-email')
            );
            $result = $this->login_database->read_user_information($sess_array, 'candidate');
            $this->session->set_userdata('user_data', $result);
            redirect( base_url('/candidate/profile') );
        } else {
            redirect(base_url('candidate'));
        }
    }
    
    public function _do_upload($flname) {
        
        $config['upload_path'] = 'public/candidate/resume';
		$config['allowed_types']    = 'doc|docx|pdf|txt|text';
		$config['max_size']	= '2048';
        $config['file_name'] = $flname;

		$this->load->library('upload', $config);
        
		if ( !$this->upload->do_upload()) {
            echo "error";
		} else {
            echo "success";
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
        
        $template["head"] = $this->load->view('common/candidate/head', $head_params, true);
        $template["header"] = $this->load->view('common/candidate/header', null, true);
        $template["contents"] = $this->load->view('candidate/job', null, true);
        $this->load->view('common/candidate/layout', $template);
    }
    
    public function registercandidate_application() {
        
        $this->load->model('grabtalent_application_model');
        
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
        redirect( base_url('candidate') );
    }
    
    // To save / register jobs into job table.
    private function _saveApplication($jobNumber, $CandEmail) {

        $ApplicationModels = array();

        $this->db->trans_start();

        // setup password
        $ApplicationModel = new grabtalent_application_model();
        $ApplicationModel->row['candidate_appln_job_id']         = $jobNumber;
        $ApplicationModel->row['candidate_email']                = $CandEmail;
        $ApplicationModel->row['candidate_applied_date']         = date('Y-m-d h:m:s');
        $ApplicationModel->save();
        array_push($ApplicationModels, $ApplicationModel);

        $this->db->trans_complete();

        return $ApplicationModels;
    }
    
    // Load Forgot Password Page
    public function forgotpassword() {
        
        $head_params = array(
            'title' => 'Candidate Forgot Password | Grab Talent',
            'description' => "Grab Talent is the best online recruitment portal",
            'keywords' => 'jobs singapore, recruitment agency, GT, Grab Talent',
        );
        $template["head"] = $this->load->view('common/head', $head_params, true);
        $template["header"] = $this->load->view('common/header', null, true);
        $template["contents"] = $this->load->view('candidate/forgotpassword', null, true);
        $this->load->view('common/layout', $template);
    }
    
    // Send forgot password link to recruiter.    
    public function sendforgotpwd() {
        $email_chk = $this->login_database->forgot_passwdemailchk($this->input->post("email"));        
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
    
    // Change password
    public function change_candidate_password() {
        
        $newpassword = md5($this->input->post('newpassword'));
        
        // To initially check if the email is registered in the system.
        $condition = "candidate_email =" . "'" . $this->input->post('candidate-email') . "'";
        $this->db->select('*');
        $this->db->from('candidate_login');
        $this->db->where($condition);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = array('candidate_password' => $newpassword);
            $this->db->where('candidate_email', $this->input->post('candidate-email'));
            $this->db->update('candidate_login', $data);
            if($this->db->trans_status() == '1') {
                echo "success";
            } else {
                echo "failure";            
            }
        } else {
            return false;
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */