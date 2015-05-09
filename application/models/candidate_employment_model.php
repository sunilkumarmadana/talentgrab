<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Candidate_employment_model extends CI_Model {

    const TABLE_NAME = 'candidate_employment';

    var $row = array(
        'candidate_ref_id' => null,
        'candidate_email' => null,
        'candidate_emp_name' => null,
        'candidate_curr_designation' => null,
        'candidate_salary' => null,
        'candidate_emp_location' => null,
        'candidate_emp_startDt' => null,        
        'candidate_emp_endDt' => null
    );


    function __construct() {
        parent::__construct();
    }

    // save to Database
    function save() {
        $this->db->insert(self::TABLE_NAME, $this->row);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

}

/* End of file avature_signup_model.php */
/* Location: ./application/models/avature_signup_model.php */
