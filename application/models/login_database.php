<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Login_Database extends CI_Model {

    // Fetch Candidate Reference Id
    public function fetch_cand_refId($data) {
    
        // Query to check whether username already exist or not
        $condition = "candidate_email =" . "'" . $data['email'] . "'";
        $this->db->select('*');
        $this->db->from('candidate_login');
        $this->db->where($condition);
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            return $row['candidate_ref_id'];
        }
    }
    
    // Insert registration data in database
    public function registration_insert($data) {
    
        // Query to check whether username already exist or not
        $condition = "candidate_email =" . "'" . $data['candidate_email'] . "'";
        $this->db->select('*');
        $this->db->from('candidate_login');
        $this->db->where($condition);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
        
            // Query to insert data in database
            $this->db->insert('candidate_login', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        } else {
            return false;
        }
    }

    // Candidate Login
    // Read data using username and password
    public function candidatelogin($data) {
    
        $condition = "candidate_email =" . "'" . $data['emailaddress'] . "' AND " . "candidate_password =" . "'" . md5($data['password']) . "'";
        $this->db->select('*');
        $this->db->from('candidate_login');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    
    // Employer Login
    // Read data using username and password
    public function employerlogin($data) {
    
        $condition = "employer_email =" . "'" . $data['username'] . "' AND " . "employer_password =" . "'" . md5($data['password']) . "'";
        $this->db->select('*');
        $this->db->from('employer_login');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    // Read data from database to show data in admin page
    public function read_user_information($sess_array, $type) {
        if($type == 'candidate') {
            
            $condition = "candidate_email =" . "'" . $sess_array['username'] . "'";
            $this->db->select('*');
            $this->db->from('candidate_signup');
            $this->db->where($condition);
            $this->db->limit(1);
            $query = $this->db->get();
            if ($query->num_rows() == 1) {
                return $query->result_array();
            } else {
                return false;
            }
                
        } else if($type == 'employer') {
            
            $condition = "employer_email =" . "'" . $sess_array['username'] . "'";
            $this->db->select('*');
            $this->db->from('employers');
            $this->db->where($condition);
            $this->db->limit(1);
            $query = $this->db->get();
            if ($query->num_rows() == 1) {
                return $query->result_array();
            } else {
                return false;
            }
            
        }
    }
    
    // Read data from database to show data in admin page
    public function job_dashboard($sess_array) {
        
        $condition = "created_by =" . "'" . $sess_array['username'] . "'";
        $this->db->select('*');
        $this->db->from('jobs');
        $this->db->where($condition);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    
    // Posted jobs for Candidate
    public function candidate_job_dashboard() {
        
        $condition = "post_job = 'on'";
        $this->db->select('*');
        $this->db->from('jobs');
        $this->db->where($condition);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }  
    
    // Read data from database to show data in admin page
    public function read_job_information($data) {
        
        $condition = "job_number =" . "'" . $data . "'";
        $this->db->select('*');
        $this->db->from('jobs');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    
    // Check forgot password email.
    public function forgot_passwdemailchk($sess_array) {
        
        $condition = "candidate_email =" . "'" . $sess_array . "'";
        $this->db->select('*');
        $this->db->from('candidate_login');
        $this->db->where($condition);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
}

?>