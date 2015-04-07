<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends CI_Controller {
    
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
            'title' => 'Candidate Registration | Grab Talent',
            'description' => "Grab Talent is the best online recruitment portal",
            'keywords' => 'jobs singapore, recruitment agency, GT, Grab Talent',
        );
        
        $logindata = array(        
            'email' => $this->input->post('email'),            
            'password' => md5($this->input->post('password'))
        );
            
        $template["head"] = $this->load->view('common/login/head', $head_params, true);
        $template["header"] = $this->load->view('common/login/header', null, true);
        $template["contents"] = $this->load->view('candidate/signup', $logindata, true);
        $this->load->view('common/login/layout', $template);
	}
    
    // Validate and store registration data in database
    public function register_submit() {
        
        //To retrieve email from session.
        $email = $this->session->userdata('emailaddress');
        
        // Check validation for user input in SignUp form
        $this->load->model('grabtalent_signup_model');        
        $SignupModels = $this->_saveSignups(
            $this->input->post('jobtitle'),
            $this->input->post('firstname'),
            $this->input->post('lastname'),
            $email,
            $this->input->post('industryskills'),
            $this->input->post('funcexpertise')
        );
        if($this->db->trans_status() == '1') {
            $this->session->set_flashdata('success_message', 'Your account was registered successfully, you may login now!');
        } else {
            $this->session->set_flashdata('error_message', 'Your account was not registered, please try again!');            
        }
        redirect(base_url('candidate'));
    }
    
    private function _saveSignups($title, $firstname, $lastname, $email, $jobfunction, $jobindustry) {

        $SignupModels = array();

        $this->db->trans_start();

        // setup password
        $SignupModel = new grabtalent_signup_model();
        $SignupModel->row['firstname']                          = $firstname;
        $SignupModel->row['lastname']                           = $lastname;
        $SignupModel->row['email']                              = $email;
        $SignupModel->row['job_category']                       = '';
        $SignupModel->row['job_function']                       = $jobfunction;
        $SignupModel->row['job_industry']                       = $jobindustry;
        $SignupModel->row['job_sub_industry']                   = '';
        $SignupModel->row['registration_date']                  = '';
        $SignupModel->row['current_annual_salary']              = '';
        $SignupModel->row['current_salary_breakdown']           = '';
        $SignupModel->row['residential_status_in_singapore']    = '';
        $SignupModel->row['job_alert_agreement']                = '';
        $SignupModel->row['title']                              = $title;
        $SignupModel->save();
        array_push($SignupModels, $SignupModel);

        $this->db->trans_complete();

        return $SignupModels;
    }    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */