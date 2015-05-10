<!-- Navigation Top bar -->
<div class="navbar-wrapper">
    <div class="container">
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">Grab Talent</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <?php
                            if( ($this->uri->segment(2) == 'home') ) {
                                echo '<li class="active"><a href="'.base_url("/".$this->lang->lang()."/home").'">'.lang('home.index').'</a></li>';
                            } else {
                                echo '<li><a href="'.base_url("/".$this->lang->lang()."/home").'">'.lang('home.index').'</a></li>';
                            }
                                                        
                            if( $this->uri->segment(2) == 'aboutus'){
                                echo '<li class="active"><a href="'.base_url("/".$this->lang->lang()."/aboutus").'">'.lang('home.about').'</a></li>';
                            } else {
                                echo '<li><a href="'.base_url("/".$this->lang->lang()."/aboutus").'">'.lang('home.about').'</a></li>';
                            }
                                                        
                            if( $this->uri->segment(2) == 'contact'){
                                echo '<li class="active"><a href="'.base_url("/".$this->lang->lang()."/contact").'">'.lang('home.contact').'</a></li>';
                            } else {
                                echo '<li><a href="'.base_url("/".$this->lang->lang()."/contact").'">'.lang('home.contact').'</a></li>';
                            }
                        ?>                        
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <?php 
                                if($this->lang->lang() == 'en') { 
                                    echo "<img src='/images/flags/united-kingdom.png'/>&nbsp;&nbsp;&nbsp;English"; 
                                } else if($this->lang->lang() == 'fr') {
                                    echo "<img src='/images/flags/france.png'/>&nbsp;&nbsp;&nbsp;French"; 
                                } else if($this->lang->lang() == 'ch') {
                                    echo "<img src='/images/flags/china.png'/>&nbsp;&nbsp;&nbsp;&#20013;&#22269;"; 
                                }
                            ?><span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-cart" role="menu">
                                <li style="<?php if($this->lang->lang() == 'en'){ echo "background-color: #f5f5f5;"; } ?>" >
                                    <a href="<?php echo base_url($this->lang->switch_uri('en'),'English');?>">
                                        <img src="/images/flags/united-kingdom.png"/>&nbsp;&nbsp;&nbsp;English
                                    </a>
                                </li>
                                <li style="<?php if($this->lang->lang() == 'fr'){ echo "background-color: #f5f5f5;"; } ?>" >
                                    <a href="<?php echo base_url($this->lang->switch_uri('fr'),'French');?>">
                                        <img src="/images/flags/france.png"/>&nbsp;&nbsp;&nbsp;French
                                    </a>
                                </li>
                                <li style="<?php if($this->lang->lang() == 'ch'){ echo "background-color: #f5f5f5;"; } ?>" >
                                    <a href="<?php echo base_url($this->lang->switch_uri('ch'),'Chinese');?>">
                                        <img src='/images/flags/china.png'/>&nbsp;&nbsp;&nbsp;&#20013;&#22269;
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="navbar-form navbar-right">                        
                        <a href="<?php echo https_url('/'.$this->lang->lang().'/recruiter'); ?>" class="btn btn-warning"><?php echo lang('home.recruiter'); ?></a>
                        <a href="<?php echo https_url('/'.$this->lang->lang().'/candidate'); ?>" class="btn btn-primary"><?php echo lang('home.jobseeker'); ?></a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>