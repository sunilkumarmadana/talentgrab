<script type="text/javascript">
$(function(){
    $('.alert').delay(3000).fadeOut('slow');
});
</script>
<div class="site-wrapper">
    <div class="site-wrapper-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php 
                        echo validation_errors();
                        $success_message = $this->session->flashdata('success_message');
                        if (isset($success_message) && $success_message != "") {
                            echo "<div class='alert alert-success' role='alert'>";
                                echo $success_message;
                            echo "</div>";
                        }
                        
                        $error_message = $this->session->flashdata('error_message');
                        if (isset($error_message) && $error_message != "") {
                            echo "<div class='alert alert-danger' role='alert'>";
                                echo $error_message;
                            echo "</div>";
                        }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h2>Job Seeker Portal</h2>
                    <form action="<?php echo "/candidate/user_login"?>" method="post" accept-charset="utf-8" role="form">                            
                        <label for="name" class="sr-only">Username</label>
                        <input type="text" class="form-control" name="emailaddress" id="emailaddress" placeholder="Email Address" required autofocus/><br />
                        <label for="inputPassword" class="sr-only">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required><br />
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                    </form>                                
                </div>
                <div class="col-md-6">
                    <h3>Create your GrabTalent profile in less than 5 minutes!!</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    <a class="btn btn-lg btn-primary btn-block" href="/candidate/register">New User? Sign-Up Here</a>
                </div>
            </div>            
        </div> <!-- /container -->
    </div>
</div>