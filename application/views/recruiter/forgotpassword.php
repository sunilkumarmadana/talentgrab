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
                    <h3><b>Forgot Password</b></h3><br />
                    <p>Please provide your email address. We'll send you a link where you can reset your password.</p>
                    <form action="<?php echo https_url("/recruiter/sendforgotpwd"); ?>" method="post" accept-charset="utf-8" role="form">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email Address" required />
                            </div>
                        </div><br />
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-lg btn-primary btn-block" type="submit">Get a New Password</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- End of Row -->
            </div>  
        </div>
    </div>
</div>