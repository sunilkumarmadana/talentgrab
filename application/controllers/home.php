<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index(){

        $head_params = array(
            'title' => 'Best Online Recruitment Portal | Grab Talent',
            'description' => "Grab Talent is the best online recruitment portal",
            'keywords' => 'jobs singapore, recruitment agency, GT, Grab Talent',
        );
        
        $template["head"] = $this->load->view('common/head', $head_params, true);
        $template["header"] = $this->load->view('common/header', null, true);
        $template["contents"] = $this->load->view('home/index', null, true);
        //$template["footer"] = $this->load->view('common/footer', null, true);
        $this->load->view('common/layout', $template);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */