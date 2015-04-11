<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grabtalent_signup_model extends CI_Model {

    const TABLE_NAME = 'grabtalent_signup';

    var $row = array(
        'id' => null,
        'firstname' => null,
        'lastname' => null,
        'email' => null,
        'job_category' => null,
        'job_function' => null,
        'job_industry' => null,
        'job_sub_industry' => null,
        'registration_date' => null,
        'current_annual_salary' => null,
        'residential_status_in_singapore' => null,
        'job_alert_agreement' => null,
        'title' => null,
    );


    function __construct() {
        parent::__construct();
    }

    // save to Database
    function save() {
        if ($this->row['id']) {
            // update
            $this->db->update(self::TABLE_NAME, $this->row, array('id' => $this->row['id']));
        } else {
            // new
            $this->db->insert(self::TABLE_NAME, $this->row);
            $this->row['id'] = $this->db->insert_id();
        }
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
