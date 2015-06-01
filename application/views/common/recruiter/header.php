<?php //print_r($this->session->all_userdata()); 
$tmpname = $this->session->userdata('user_data');
$loginname = $tmpname[0]['employer_contact_firstname']." ".$tmpname[0]['employer_contact_lastname'];
?>
<!-- Navigation Top bar -->
<div class="navbar-wrapper">
    <div class="container">
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand text-left" href="#">GrabTalent</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <p class="navbar-text">Logged in as <?php echo $loginname; ?></p>
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                            if( ($this->uri->segment(2) == 'recruiter_dashboard') ) {
                                echo '<li class="active"><a href="'.https_url("/".$this->lang->lang()."/recruiter_dashboard").'">'.lang('recruiterlogin.home').'</a></li>';                                
                            } else {
                                echo '<li><a href="'.https_url("/".$this->lang->lang()."/recruiter_dashboard").'">'.lang('recruiterlogin.home').'</a></li>';                                
                            }
                            
                            if( $this->uri->segment(3) == 'job_create'){
                                echo '<li class="active"><a href="'.https_url("/".$this->lang->lang()."/recruiter/job_create").'">'.lang('recruiterlogin.createjob').'</a></li>';
                            } else {
                                echo '<li><a href="'.https_url("/".$this->lang->lang()."/recruiter/job_create").'">'.lang('recruiterlogin.createjob').'</a></li>';
                            }
                            
                            if( $this->uri->segment(3) == 'profile'){
                                echo '<li class="active"><a href="'.https_url("/".$this->lang->lang()."/recruiter/profile").'">'.lang('recruiterlogin.companyprofile').'</a></li>';
                            } else {
                                echo '<li><a href="'.https_url("/".$this->lang->lang()."/recruiter/profile").'">'.lang('recruiterlogin.companyprofile').'</a></li>';
                            }
                        ?>
                        <li><a href="<?php echo https_url('/'.$this->lang->lang().'/recruiter'); ?>"><?=lang('recruiterlogin.logout');?></a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>