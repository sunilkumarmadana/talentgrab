<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grabtalent_job_model extends CI_Model {

    const TABLE_NAME = 'job';

    var $row = array(
        'job_number' => null,
        'job_title' => null,
        'min_month_salary' => null,
        'max_month_salary' => null,
        'primary_work_location_country' => null,
        'primary_work_location_city' => null,
        'currency' => null,
        'job_category' => null,
        'job_function' => null,
        'job_industry' => null,
        'job_sub_industry' => null,
        'job_description' => null,
        'post_date' => null,
        'post_job' => null,
        'created_by' => null,
        'created_date' => null,
        'view_count' => null,
        'text_search' => null,
        'delete_flg' => null,
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
