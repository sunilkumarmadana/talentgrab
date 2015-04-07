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
        'current_salary_breakdown' => null,
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

    static function get_by_code(&$db, $code)
    {
        $result = $db->where('code', $code)->get(self::TABLE_NAME)->result();

        $ret = array();

        foreach($result as $v) {
            $obj = new Avature_signup_model;
            $obj->row['id']                                 = $v->id;
            $obj->row['code']                               = $v->code;
            $obj->row['firstname']                          = $v->firstname;
            $obj->row['lastname']                           = $v->lastname;
            $obj->row['email']                              = $v->email;
            $obj->row['job_category']                       = $v->job_category;
            $obj->row['job_function']                       = $v->job_function;
            $obj->row['job_industry']                       = $v->job_industry;
            $obj->row['job_sub_industry']                   = $v->job_sub_industry;
            $obj->row['registration_date']                  = $v->registration_date;
            $obj->row['job_id']                             = $v->job_id;
            $obj->row['workflow']                           = $v->workflow;
            $obj->row['source']                             = $v->source;
            $obj->row['current_annual_salary']              = $v->current_annual_salary;
            $obj->row['current_salary_breakdown']           = $v->current_salary_breakdown;
            $obj->row['residential_status_in_singapore']    = $v->Residential_Status_in_Singapore;
            $obj->row['job_alert_agreement']                = $v->job_alert_agreement;
            $obj->row['title']     = $v->title;
            array_push($ret, $obj);
        }

        return $ret;
    }
}

/* End of file avature_signup_model.php */
/* Location: ./application/models/avature_signup_model.php */
