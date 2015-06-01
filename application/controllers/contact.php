<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('view_helper');
        $this->load->library('form_validation');        
        $this->load->helper('language');        
        $this->load->helper('url');
        $this->lang->load('common');
    }
       
    public function index() {        
        $head_params = array(
            'title' => 'Contact Us | Grab Talent',
            'description' => "Grab Talent is the best online recruitment portal",
            'keywords' => 'jobs singapore, recruitment agency, GT, Grab Talent',
        );
        
        $template["head"] = $this->load->view('common/head', $head_params, true);
        $template["header"] = $this->load->view('common/header', null, true);
        $template["contents"] = $this->load->view('contact/index', null, true);
        $this->load->view('common/layout', $template);
    }
    
    public function contact_form() {
        
        $subject = "Message from [{$this->input->post('firstname')} {$this->input->post('lastname')}]";
        $message = <<<EOF
        Please contact the following person regarding to below matter.<br /><br />
        
        First Name: {$this->input->post('firstname')}<br />
        Last Name: {$this->input->post('lastname')}<br />
        Email: {$this->input->post('email')}<br />
        Phone No: {$this->input->post('phonenumber')}<br />
        Reason for contact: {$this->input->post('reason')}<br />
        Message: {$this->input->post('message')}
EOF;

        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://ns3-999.999servers.com',
            'smtp_port' => 465,
            'smtp_user' => 'sunil.madana.kumar@ricemerchant.com', // change it to yours
            'smtp_pass' => 'Sunil2012Swathi', // change it to yours
            'mailtype' => 'html',
            'charset'=>'utf-8',
            'wordwrap' => TRUE            
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('sunil.madana.kumar@ricemerchant.com','Grab Talent'); // change it to yours
        $this->email->to($this->input->post("email"));// change it to yours
        $this->email->subject($subject);
        $this->email->message($message);
        if($this->email->send()) {
            echo "success; Thanks for the message, we will be in touch with you soon";
        } else {
            echo "failure; Your email was not sent, lease try again.";
        }
    }

    public function complete() {
        $head_params = array(
            'title' => 'Contact Us | Grab Talent',
            'description' => "Grab Talent is the best online recruitment portal",
            'keywords' => 'jobs singapore, recruitment agency, GT, Grab Talent',
        );
        
        $template["head"] = $this->load->view('common/head', $head_params, true);
        $template["header"] = $this->load->view('common/header', null, true);
        $template["contents"] = $this->load->view('contact/complete', null, true);
        $this->load->view('common/layout', $template);
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */