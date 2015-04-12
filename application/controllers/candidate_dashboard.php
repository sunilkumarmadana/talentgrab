<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Candidate_dashboard extends CI_Controller {

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
            'title' => 'Job Seeker Portal | Grab Talent',
            'description' => "Grab Talent is the best online recruitment portal",
            'keywords' => 'jobs singapore, recruitment agency, GT, Grab Talent',
        );
        $template["head"] = $this->load->view('common/candidate/head', $head_params, true);
        $template["header"] = $this->load->view('common/candidate/header', null, true);
        $template["contents"] = $this->load->view('candidate/candidate_dashboard', null, true);
        $this->load->view('common/candidate/layout', $template);	   
	}
            
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */