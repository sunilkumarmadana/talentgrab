<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {
       
    public function index() {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('firstname',   'First Name',         'trim|required|max_length[50]|xss_clean');
        $this->form_validation->set_rules('lastname',    'Last Name',          'trim|required|max_length[50]|xss_clean');
        $this->form_validation->set_rules('email',       'Email',              'trim|required|max_length[255]|valid_email|xss_clean');
        $this->form_validation->set_rules('phonenumber', 'Phone number',       'trim|regex_match[/^[\-0-9]+$/]|xss_clean');
        $this->form_validation->set_rules('reason',      'Reason for contact', 'trim|required|max_length[255]|xss_clean');
        $this->form_validation->set_rules('message',     'Message',            'trim|required|xss_clean');

        if ($this->form_validation->run()) {
            $this->load->library('email');

            $subject = "Message from [{$this->input->post('firstname')} {$this->input->post('lastname')}]";
            $message = <<<EOF
            Please contact the following person regarding to below matter.
            
            First Name: {$this->input->post('firstname')}
            Last Name: {$this->input->post('lastname')}
            Email: {$this->input->post('email')}
            Phone No: {$this->input->post('phonenumber')}
            Reason for contact: {$this->input->post('reason')}
            Message: {$this->input->post('message')}
EOF;

            $this->email->from(RGF_MAIL_FROM);
            $this->email->to(RGF_MAIL_TO);
            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->send();
            
            redirect(base_url('contact/complete'));

        } else {
            
            $head_params = array(
                'title' => 'Contact Us | Grab Talent',
                'description' => "Grab Talent is the best online recruitment portal",
                'keywords' => 'jobs singapore, recruitment agency, GT, Grab Talent',
            );
            
            $template["head"] = $this->load->view('common/head', $head_params, true);
            $template["header"] = $this->load->view('common/header', null, true);
            $template["contents"] = $this->load->view('contact/index', null, true);
            //$template["footer"] = $this->load->view('common/footer', null, true);
            $this->load->view('common/layout', $template);
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
        //$template["footer"] = $this->load->view('common/footer', null, true);
        $this->load->view('common/layout', $template);
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */