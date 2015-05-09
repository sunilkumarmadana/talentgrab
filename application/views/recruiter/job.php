<?php
$jobs = $this->session->userdata('job_detail');
?>
<div class="site-wrapper">
    <div class="site-wrapper-inner">
        <div class="container">
            <br />
            <div class="row">
                <div class="col-xs-12 col-md-12 col-md-offset-0">
                    <?php if($jobs) {?>
                        <?php foreach($jobs as $job) { ?>
                            <div class="col-xs-12 col-md-6">
                                <p><?php echo $job['job_description']?></p>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <video class="col-xs-12" controls>
                                    <source src="<?php echo "../../public/recruiter/".$job['video_url']; ?>" type="video/mp4" />
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        <?php } ?>
                </div>
                <div class="col-md-12 col-md-offset-0">
                    <?php } else { ?>
                        <div class="col-xs-12">
                            <h3>This job does not exist (or) you typed the wrong URL.</h3>
                            <p style="word-wrap: break-word;">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
                        </div>
                    <?php } ?>                
                </div>
            </div>
        </div>
    </div>
</div>