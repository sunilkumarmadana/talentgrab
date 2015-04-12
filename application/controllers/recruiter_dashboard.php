<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recruiter_dashboard extends CI_Controller {

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
        $template["head"] = $this->load->view('common/recruiter/head', $head_params, true);
        $template["header"] = $this->load->view('common/recruiter/header', null, true);
        $template["contents"] = $this->load->view('recruiter/recruiter_dashboard', null, true);
        $this->load->view('common/recruiter/layout', $template);	   
	}
    
    // Logout from admin page
    public function logout() {    
        // Removing session data
        $sess_array = array('username' => '');
        $this->session->unset_userdata('logged_in', $sess_array);
        $data['message_display'] = 'Successfully Logout';
        $this->session->sess_destroy();
        redirect( base_url('recruiter') );
    }
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */