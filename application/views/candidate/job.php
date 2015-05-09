<?php
$jobs = $this->session->userdata('job_detail');
?>
<div class="site-wrapper">
    <div class="site-wrapper-inner">
        <div class="container">
            <ol class="breadcrumb visible-lg-block">
                <li><a href="<?php echo base_url('/candidate_dashboard')?>">Home</a></li>
                <li><a href="<?php echo base_url('/candidate/jobs')?>">Jobs</a></li>                        
            </ol><br />
            <div class="row">
                <div class="col-xs-12 col-md-12 col-md-offset-0">
                    <?php if($jobs) { //print_r($jobs); ?>
                        <?php foreach($jobs as $job) { ?>
                            <div class="col-xs-12 col-md-6">
                                <p><?php echo $job['job_description']?></p>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <?php if( $job['video_url'] != "" || !empty($job['video_url']) ) { ?>
                                    <video width="520" height="350" controls class="col-xs-12 col-sm-12 col-md-12">
                                        <source src="<?php echo "../../public/recruiter/".$job['video_url']; ?>" type="video/mp4" />
                                        Your browser does not support the video tag.
                                    </video>        
                                <?php } else { ?>
                                    <img src="/images/no-video-pic.jpg" style="border: 1px solid black;" class="col-xs-12 col-sm-12 col-md-12" />
                                <?php } ?>
                            </div>
                        <?php } ?>
                </div>
                <div class="col-md-12 col-md-offset-0">
                    <?php } else { ?>
                        <div class="col-xs-12">
                            <h1>This job does not exist (or) you typed the wrong URL.</h1>
                        </div>
                    <?php } ?>                
                </div>
            </div>
        </div>
    </div>
</div>