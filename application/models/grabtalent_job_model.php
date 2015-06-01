<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grabtalent_job_model extends CI_Model {

    const TABLE_NAME = 'jobs';

    var $row = array(
        'job_number' => null,
        'job_title' => null,
        'job_minsalary_currency' => null,
        'job_minmonth_salary' => null,
        'job_maxsalary_currency' => null,
        'job_maxmonth_salary' => null,
        'job_mandatory_skills' => null,
        'job_desired_skills' => null,
        'job_primaryworklocation_country' => null,
        'job_primaryworklocation_city' => null,        
        'job_category' => null,
        'job_function' => null,
        'job_industry' => null,
        'job_sub_industry' => null,
        'job_description' => null,
        'job_benefits' => null,
        'job_workinghours' => null,
        'job_postdate' => null,
        'job_posted' => null,
        'job_created_by' => null,
        'job_created_date' => null,
        'job_view_count' => null,
        'job_active' => null,
        'job_video_url' => null
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
