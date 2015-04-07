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
    
	public function index() {
        $head_params = array(
            'title' => 'Employer Portal | Grab Talent',
            'description' => "Grab Talent is the best online recruitment portal",
            'keywords' => 'jobs singapore, recruitment agency, GT, Grab Talent',
        );
        
        $template["head"] = $this->load->view('common/login/head', $head_params, true);
        $template["header"] = $this->load->view('common/login/header', null, true);
        $template["contents"] = $this->load->view('employer/index', null, true);
        $this->load->view('common/login/layout', $template);
	}
    
    // Check for user login process
    public function employer_login_process() {
        
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
                if($result != false) {
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
            } else {
                $this->session->set_flashdata('error_message', 'Invalid Username or Password');
                redirect( base_url('employer') );
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
        redirect( base_url('employer') );
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */