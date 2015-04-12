<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grabtalent_application_model extends CI_Model {

    const TABLE_NAME = 'grabtalent_application';

    var $row = array(
        'job_id' => null,
        'email' => null,
        //'firstname' => null,
        //'lastname' => null,        
        //'phonenumber' => null,
        //'location' => null,
        //'visa_status' => null,
        //'salary' => null,
        //'resume_url' => null,
        'created_date' => null
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
