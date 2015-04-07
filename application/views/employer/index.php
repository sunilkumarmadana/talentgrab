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
                    <h2>Employer Portal</h2>
                    <?php 
                        echo validation_errors();
                        $error_message = $this->session->flashdata('error_message');
                        if (isset($error_message) && $error_message != "") {
                            echo "<div class='alert alert-danger' role='alert'>";
                                echo $error_message;
                            echo "</div>";
                        }
                    ?>
                    <form action="<?php echo "/employer/employer_login_process"?>" method="post" accept-charset="utf-8" role="form">                            
                        <label for="name" class="sr-only">Username</label>
                        <input type="text" class="form-control" name="username" id="name" placeholder="username" required autofocus/><br />
                        <label for="inputPassword" class="sr-only">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required><br />
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                    </form>                                
                </div>
            </div>            
        </div> <!-- /container -->
    </div>
</div>