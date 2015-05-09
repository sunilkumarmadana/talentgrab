<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grabtalent_application_model extends CI_Model {

    const TABLE_NAME = 'candidate_application';

    var $row = array(
        'candidate_appln_job_id' => null,
        'candidate_email' => null,
        'candidate_applied_date' => null
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
