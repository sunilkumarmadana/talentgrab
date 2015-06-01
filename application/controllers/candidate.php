<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Candidate extends CI_Controller {
    
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
        
        $this->load->helper('download');
        
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
    
    // Candidate upload resume modal window
    public function candidate_resumeupload() {
        $this->load->view('candidate/candidate_resumeupload');
	}
    
    public function candidate_resumedownload () {
        $file_url = "./public/candidate/".$this->uri->segment(4);
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary"); 
        header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
        readfile($file_url);
    }
    
    //Candidate upload resume process
    public function candidate_resumeupdate(){
        
        $target_dir = "public/candidate/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "pdf"
        && $imageFileType != "txt" ) {
            echo "Sorry, only DOC, DOCX, PDF & TXT files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                
                // To initially check if the email is registered in the system.
                $result = $this->login_database->candidate_resumeupdatecheck($this->input->post('candidate-profile-email')); 
                if ($result > 0) {
                    $data = array('resume_url' => basename($_FILES["fileToUpload"]["name"]));
                    $this->db->where('candidate_email', $this->input->post('candidate-profile-email'));
                    $this->db->update('candidate_signup', $data);
                    if($this->db->trans_status() != '1') {
                        echo "Sorry, there was an error uploading your file.";
                    } else {
                        // 2. Refresh session data
                        $sess_array = array('username' => $this->session->userdata('logged_in'));
                        $candidateinfo = $this->login_database->read_user_information($sess_array,'candidate');
                        $this->session->set_userdata('user_data', $candidateinfo);
                    }
                } else {
                    return false;
                }
                
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    
    // Validate and store registration data in database
    public function register() {        
        $head_params = array(
            'title' => 'Candidate Registration | Grab Talent',
            'description' => "Grab Talent is the best online recruitment portal",
            'keywords' => 'jobs singapore, recruitment agency, GT, Grab Talent',
        );
        
        $template["head"] = $this->load->view('common/head', $head_params, true);
        $template["header"] = $this->load->view('common/header', null, true);
        $template["contents"] = $this->load->view('candidate/register', null, true);
        $this->load->view('common/layout', $template);
    }
    
    public function candidate_register(){
                
        $passWd = $this->input->post('password');
        $confrmpassWd = $this->input->post('confirmpassword');
        
        if( $passWd != $confrmpassWd) {
            echo "error; Your Passwords do not match, please try again";
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
                echo "success;". https_url('signup');                
            } else {
                $this->session->set_flashdata('error_message', '');
                echo "error; Username / Email Address already exist!, please try again";
            }         
        }
            
    }        
        
    // Check for user login process
    public function candidate_login() {
                
        $data = array(
            'emailaddress' => $this->input->post('emailaddress'),
            'password' => $this->input->post('password')
        );
        $result = $this->login_database->candidatelogin($data);
        
        if($result == TRUE){
            // To double-confirm if the candidate completed his signup process.
            $result = $this->login_database->candidate_resumeupdatecheck($this->input->post('emailaddress'));
            if($result > 0) {
                // Add user data in session
                $this->session->set_userdata('logged_in', $this->input->post('emailaddress'));
                
                $sess_array = array(
                    'username' => $this->input->post('emailaddress')
                );                        
                $result = $this->login_database->read_user_information($sess_array, 'candidate');
                $this->session->set_userdata('user_data', $result);
                echo "success;You will be redirected shortly";    
            } else {
                echo "error;You have not completed the sign-up process, please register again with us.";
                $condition = "candidate_email =" . "'" . $this->input->post('emailaddress') . "'";
            }
        } else {
            echo "error;Invalid Username or Password";
        }
    }
    
    // List all open jobs on jobs page
    public function jobs() {
        if($this->session->userdata('logged_in') != null || $this->session->userdata('logged_in') != "") {
        
            $head_params = array(
                'title' => 'Job Seeker Portal | Grab Talent',
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
                'title' => 'Job Seeker Portal | Grab Talent',
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
    
    // Recruiter profile update.
    public function profile_update() {        
        // 1. Updated Profile data
        $candidate_profupd = array(
            'candidate_firstname' => $this->input->post('inputCandFirstname'),
            'candidate_lastname' => $this->input->post('inputCandLastname'),
            'candidate_phonenumber' => $this->input->post('inputPhonenumber'),
            'brief_description' => $this->input->post('inputbriefDesc')                                             
        );
        $result = $this->login_database->profile_update($candidate_profupd,$this->input->post('profile-email'));
        if($result == TRUE) {
            echo "success;Your Profile has been updated successfully!!";
        } else {
            echo "failure;Profile was not updated, please try again!";
        }
        
        // 2. Refresh session data
        $sess_array = array('username' => $this->session->userdata('logged_in'));
        $candidateinfo = $this->login_database->read_user_information($sess_array,'candidate');
        $this->session->set_userdata('user_data', $candidateinfo);
    }
    
    public function job() {
        $jobnumber = $this->uri->segment(4);
        $job_detail = $this->login_database->read_job_information($jobnumber);
        $this->session->set_userdata('job_detail', $job_detail);

        $head_params = array(
            'title' => 'Job Seeker Portal | Grab Talent',
            'description' => "Grab Talent is the best online recruitment portal",
            'keywords' => 'jobs singapore, recruitment agency, GT, Grab Talent',
        );
        
        $template["head"] = $this->load->view('common/candidate/head', $head_params, true);
        $template["header"] = $this->load->view('common/candidate/header', null, true);
        $template["contents"] = $this->load->view('candidate/job', null, true);
        $this->load->view('common/candidate/layout', $template);
    }
    
    // Logout from admin page
    public function logout() {  
        // Removing session data
        redirect( base_url('candidate') );
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
    
    // To save / register jobs into job table.
    private function _saveApplication($jobNumber, $CandEmail) {

        $ApplicationModels = array();

        $this->db->trans_start();
        
        $data_email = array('email' => $CandEmail);
        
        // setup password
        $ApplicationModel = new grabtalent_application_model();
        $ApplicationModel->row['candidate_appln_ref_id']         = $this->login_database->fetch_cand_refId($data_email);
        $ApplicationModel->row['candidate_email']                = $CandEmail;
        $ApplicationModel->row['candidate_appln_job_id']         = $jobNumber;
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
                echo "success; Please check your email for the reset password link!";
            } else {
                //show_error($this->email->print_debugger());
                echo "failure; Please try again as the email was not sent";
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