<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Candidate_dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Load form helper library
        $this->load->helper('form');
        
        $this->load->helper('view_helper');
        
        // Load form validation library
        $this->load->library('form_validation');
        
        // Load session library
        $this->load->library('session');
        
        // Load database
        $this->load->model('login_database');
        
        if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != "on") {
            $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
            redirect($url);
            exit;
        }
        
    }
    
    // Employer Portal login page with user-email and password.
	public function index() {
        if($this->session->userdata('logged_in') != null || $this->session->userdata('logged_in') != "") {
        
            $head_params = array(
                'title' => 'Job Seeker Portal | Grab Talent',
                'description' => "Grab Talent is the best online recruitment portal",
                'keywords' => 'jobs singapore, recruitment agency, GT, Grab Talent',
            );
            $template["head"] = $this->load->view('common/candidate/head', $head_params, true);
            $template["header"] = $this->load->view('common/candidate/header', null, true);
            $template["contents"] = $this->load->view('candidate/candidate_dashboard', null, true);
            $this->load->view('common/candidate/layout', $template);
        } else {
            redirect(base_url('candidate'));
        }
	}
    
    // Validate and update skill data in database
    public function add_skill() {
        
        // To initially check if the email is registered in the system.
        $condition = "candidate_email =" . "'" . $this->input->post('skillemail') . "'";
        $this->db->select('*');
        $this->db->from('candidate_signup');
        $this->db->where($condition);
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            echo $row['candidate_skills'];
            if($row['candidate_skills'] == "0" || $row['candidate_skills'] == null) {
                $skillVal = $this->input->post('skillname').",".$this->input->post('skilllevel').",".$this->input->post('skillrating');
            } else {
                $skillVal = $row['candidate_skills'].";".$this->input->post('skillname').",".$this->input->post('skilllevel').",".$this->input->post('skillrating');
            }
        }
        $data = array('candidate_skills' => $skillVal);
        $this->db->where('candidate_email', $this->input->post('skillemail'));
        $this->db->update('candidate_signup', $data);
        if($this->db->trans_status() == '1') {
            echo "success";
        } else {
            echo "failure";            
        }
    }
    
    // Validate and update skill data in database
    public function remove_skill() {
        
        // To initially check if the email is registered in the system.
        $condition = "candidate_email =" . "'" . $this->input->post('skillemail') . "'";
        $this->db->select('*');
        $this->db->from('candidate_signup');
        $this->db->where($condition);
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $skillsArr = explode(";",$row['candidate_skills']);
            $pos = array_search($this->input->post('skilldelvalue'), $skillsArr);
            if ($pos !== false) {
                unset($skillsArr[$pos]);
                $skillsVal = implode(";",$skillsArr);                     
                $data = array('candidate_skills' => $skillsVal);
                $this->db->where('candidate_email', $this->input->post('skillemail'));
                $this->db->update('candidate_signup', $data);
                if($this->db->trans_status() == '1') {
                    echo "success";
                } else {
                    echo "failure";            
                }
            }
        }
    }
    
    // Validate and store registration data in database
    public function add_Workexp() {
        
        $session_email = array('email' => $this->input->post('candidateemail'));
        $candRefId = $this->login_database->fetch_cand_refId($session_email);
        
        $WorkExpdata = array(
            'candidate_ref_id' => $candRefId,
            'candidate_email' => $this->input->post('candidateemail'),
            'candidate_emp_name' => $this->input->post('employername'),
            'candidate_curr_designation' => $this->input->post('employerdesig'),
            'candidate_emp_location' => $this->input->post('employerctry'),
            'candidate_emp_startDt' => $this->input->post('employerStartDt'),
            'candidate_emp_endDt' => $this->input->post('employerEndDt')
        );
        $this->db->insert('candidate_employment', $WorkExpdata);
        if($this->db->trans_status() == '1') {
            echo "success";
        } else {
            echo "failure";            
        }
    }
    
    // Validate and store registration data in database
    public function delete_Workexp() {
        
        $WorkExpdata = array(
            'candidate_email' => $this->input->post('candidateemail'),
            'candidate_ref_id' => $this->input->post('candidateId'),
        );
        $this->db->delete('candidate_employment', $WorkExpdata);
        if($this->db->trans_status() == '1') {
            echo "success";
        } else {
            echo "failure";            
        }
    }
            
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */