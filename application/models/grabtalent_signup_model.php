<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grabtalent_signup_model extends CI_Model {

    const TABLE_NAME = 'candidate_signup';

    var $row = array(
        'candidate_ref_id' => null,
        'candidate_firstname' => null,
        'candidate_lastname' => null,
        'candidate_email' => null,
        'candidate_phonecountrycode' => null,
        'candidate_phonenumber' => null,
        'candidate_gender' => null,
        'candidate_nationality' => null,
        'brief_description' => null,
        'candidate_skills' => null,
        'candidate_total_experience' => null,
        'candidate_exp_annualsalcode' => null,
        'candidate_exp_annualsalary' => null,
        'job_alert_agreement' => null,
        'registration_date' => null,
        'created_date' => null,
        'resume_url' => null,
        'video_resume_url' => null,
    );


    function __construct() {
        parent::__construct();
    }

    // save to Database
    function save() {
        $this->db->insert(self::TABLE_NAME, $this->row);
        return ($this->db->affected_rows() != 1) ? false : true;
    }


    /*
      Static methods.
    ---------------------------------------------------------------------------*/

    static function generate_unique_code()
    {
        return hash_hmac('sha256', uniqid(mt_rand(), true), false);
    }
}

/* End of file avature_signup_model.php */
/* Location: ./application/models/avature_signup_model.php */
