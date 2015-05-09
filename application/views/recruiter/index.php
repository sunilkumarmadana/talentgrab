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
                    <?php 
                        echo validation_errors();
                        $error_message = $this->session->flashdata('error_message');
                        if (isset($error_message) && $error_message != "") {
                            echo "<div class='alert alert-danger' role='alert'>";
                                echo $error_message;
                            echo "</div>";
                        }
                    ?>
                    <h2>Recruiter Portal</h2>
                    <form action="<?php echo https_url("/recruiter/recruiter_login"); ?>" method="post" accept-charset="utf-8" role="form">                            
                        <label for="emailaddress" class="sr-only">Email Address</label>
                        <input type="text" class="form-control" name="emailaddress" id="emailaddress" placeholder="Email Address" required /><br />
                        <label for="inputPassword" class="sr-only">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required><br />
                        <a href="<?php echo https_url("/recruiter/forgotpassword"); ?>" target="_parent">Forgot Password?</a><br /><br />
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                    </form>                                
                </div>
            </div>            
        </div> <!-- /container -->
    </div>
</div>