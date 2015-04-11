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
        $template["header"] = $this->load->view('common/header_login', null, true);
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
            $template["header"] = $this->load->view('common/header_login', null, true);
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
    public function user_login() {
                
        $this->form_validation->set_rules('emailaddress', 'Email Address', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
    
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error_message', 'Your account was registered successfully, you may login now!');
            redirect( base_url('candidate') );
        } else {
            $data = array(
            'emailaddress' => $this->input->post('emailaddress'),
            'password' => $this->input->post('password')
            );
                        
            $result = $this->login_database->candidatelogin($data);
            if($result == TRUE){
                $temp_array = array('username' => $this->input->post('emailaddress'));
                
                // Read user data with email address
                $this->session->set_userdata('logged_in', $temp_array);
                $result = $this->login_database->read_user_information($temp_array, 'candidate');
                $this->session->set_userdata('user_data', $result);
                
                if($result != false) {
                    
                    $head_params = array(
                        'title' => 'Candidate Portal | Grab Talent',
                        'description' => "Grab Talent is the best online recruitment portal",
                        'keywords' => 'jobs singapore, recruitment agency, GT, Grab Talent',
                    );
                    
                    $template["head"] = $this->load->view('common/head', $head_params, true);
                    $template["header"] = $this->load->view('common/header', null, true);
                    $template["contents"] = $this->load->view('candidate/home', null, true);
                    $this->load->view('common/layout', $template);
                }
            } else {
                $this->session->set_flashdata('error_message', 'Invalid Username or Password');
                redirect( base_url('candidate') );
            }
        }
    }
    
    // Logout from admin page
    public function logout() {    
        // Removing session data
        $sess_array = array('username' => '');
        $this->session->unset_userdata('logged_in', $sess_array);
        $data['message_display'] = 'Successfully Logout';
        redirect( base_url('candidate') );
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */