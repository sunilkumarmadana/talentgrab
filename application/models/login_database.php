<?php

Class Login_Database extends CI_Model {

    // Insert registration data in database
    public function registration_insert($data) {
    
        // Query to check whether username already exist or not
        $condition = "email =" . "'" . $data['email'] . "'";
        $this->db->select('*');
        $this->db->from('login_users');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
        
            // Query to insert data in database
            $this->db->insert('login_users', $data);
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
    
        $condition = "email =" . "'" . $data['emailaddress'] . "' AND " . "password =" . "'" . md5($data['password']) . "'";
        $this->db->select('*');
        $this->db->from('login_users');
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
    
        $condition = "email =" . "'" . $data['username'] . "' AND " . "password =" . "'" . md5($data['password']) . "'";
        $this->db->select('*');
        $this->db->from('login_users');
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
        if($type == 'candidate'){
            
            $condition = "email =" . "'" . $sess_array['username'] . "'";
            $this->db->select('*');
            $this->db->from('grabtalent_signup');
            $this->db->where($condition);
            $this->db->limit(1);
            $query = $this->db->get();
            if ($query->num_rows() == 1) {
                return $query->result();
            } else {
                return false;
            }
                
        } else if($type == 'employer'){
            
        }
        
        
        
    }    
}

?>