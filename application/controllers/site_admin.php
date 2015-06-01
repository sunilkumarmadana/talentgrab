<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_admin extends CI_Controller {

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
        $template["contents"] = $this->load->view('site_admin/index', null, true);
        $this->load->view('common/layout', $template);
	}
        
    // Check for employer login process
    public function siteadmin_login() {
        
        $data = array(
            'username' => $this->input->post('emailaddress'),
            'password' => $this->input->post('password')
        );
        $result = $this->login_database->employerlogin($data);
        
        if($result == TRUE){                                
            // Add user data in session
            $this->session->set_userdata('logged_in', $this->input->post('emailaddress'));                        
            $redirect_url = str_replace('http://','https://',base_url()).$this->lang->lang()."/siteadmin_dashboard";
            echo "success,".$redirect_url;
        } else {
            echo "error,Invalid Username or Password";
        }
        
    }
        
    // Logout from admin page
    public function logout() {    
        // Removing session data
        redirect( secure_url($curr_lang.'/recruiter') );
    }    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */