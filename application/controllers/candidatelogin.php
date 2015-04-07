<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Candidatelogin extends CI_Controller {
    
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
        $template["head"] = $this->load->view('common/login/head', null, true);
        $template["head"] = $this->load->view('common/login/header', null, true);
        $template["contents"] = $this->load->view('candidate/index', null, true);
        $this->load->view('common/login/layout', $template);
	}
    
    // Validate and store registration data in database
    public function signup() {
    
        // Check validation for user input in SignUp form
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $template["head"] = $this->load->view('common/head', null, true);
            $template["contents"] = $this->load->view('candidate/signup', null, true);
            $this->load->view('common/layout', $template);
        } else {
            $logindata = array(
                'user_name' => $this->input->post('email'),
                'user_email' => $this->input->post('email'),
                'user_password' => md5($this->input->post('password'))
            ); 
            
            $data = array(
                'name' => $this->input->post('name'),
                'user_name' => $this->input->post('email'),
                'user_email' => $this->input->post('email'),
                'user_password' => $this->input->post('password')
            );
            $result = $this->login_database->registration_insert($logindata) ;
            if ($result == TRUE) {
                $data['message_display'] = 'Registration Successfully !';
                redirect( base_url('/candidate') );
            } else {
                $data['message_display'] = 'Username already exist!';
                $template["head"] = $this->load->view('common/head', null, true);
                $template["contents"] = $this->load->view('candidate/signup', null, true);
                $this->load->view('common/layout', $template);
            }
        }
    }
    
    // Check for user login process
    public function user_login_process() {
        
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
    
        if ($this->form_validation->run() == FALSE) {
            redirect( base_url('candidatelogin/index') );
        } else {
            $data = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password')
            );
            $result = $this->login_database->login($data);
            if($result == TRUE){
                $sess_array = array('username' => $this->input->post('username'));
                
                // Add user data in session
                $this->session->set_userdata('logged_in', $sess_array);
                $result = $this->login_database->read_user_information($sess_array);
                if($result != false) {
                    $data = array(
                    'username' =>$result[0]->user_name,
                    'email' =>$result[0]->user_email,
                    'password' =>$result[0]->user_password
                    );
                    $template["head"] = $this->load->view('common/head', null, true);
                    $template["contents"] = $this->load->view('candidate/home', $data, true);
                    $this->load->view('common/layout', $template);
                }
            } else {
                $data = array('error_message' => 'Invalid Username or Password');
                $template["head"] = $this->load->view('common/head', null, true);
                $template["contents"] = $this->load->view('candidate/index', $data, true);
                $this->load->view('common/layout', $template);
            }
        }
    }
    
    // Logout from admin page
    public function logout() {    
        // Removing session data
        $sess_array = array('username' => '');
        $this->session->unset_userdata('logged_in', $sess_array);
        $data['message_display'] = 'Successfully Logout';
        //$this->load->view('candidatelogin/index.php', $data);
        redirect( base_url('candidate') );
    }    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */