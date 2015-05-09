<script type="text/javascript">
$(function(){
    $('.alert').delay(3000).fadeOut('slow');
});
</script>
<div class="site-wrapper">
    <div class="site-wrapper-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="error_msg">
                        <?php
                            $error_message = $this->session->flashdata('error_message');
                            if (isset($error_message) && $error_message != "") {
                                echo "<div class='alert alert-danger' role='alert'>";
                                    echo $error_message;
                                echo "</div>";
                            }
                        ?>
                    </div>
                    <a href="<?php echo https_url('/candidate');?>" target="_self"> << Back to Login </a><br />
                    <h3><b>Grab Talent registration takes less than 5 minutes</b></h3><br />
                    <form action="<?php echo "/candidate/register"?>" method="post" accept-charset="utf-8" role="form">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email Address" required />
                            </div>
                        </div><br />
                        <div class="row">
                            <div class="col-md-12">
                                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required />
                            </div>
                        </div><br />
                        <div class="row">
                            <div class="col-md-12">
                                <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" placeholder="Confirm Password" required />
                            </div>
                        </div><br />
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-lg btn-primary btn-block" type="submit">Register and continue</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- End of Row -->
            </div>  
        </div>
    </div>
</div>