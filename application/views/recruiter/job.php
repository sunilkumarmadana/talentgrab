<?php
$jobs = $this->session->userdata('job_detail');
?>
<div class="site-wrapper">
    <div class="site-wrapper-inner">
        <div class="container">
            <br />
            <div class="row">
                <div class="col-md-12 col-md-offset-0">
                    <?php if($jobs) {?>
                        <?php foreach($jobs as $job) { ?>
                            <div class="col-md-6">
                                <p><?php echo $job['job_description']?></p>
                            </div>
                            <div class="col-md-6">
                                <video width="520" height="350" controls>
                                    <source src="<?php echo "../../public/recruiter/".$job['video_url']; ?>" type="video/mp4" />
                                    Your browser does not support the video tag.
                                </video>
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