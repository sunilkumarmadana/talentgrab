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
                            echo validation_errors();
                            if (isset($message_display) && $message_display != "") {
                                echo "<div class='alert alert-danger' role='alert'>";
                                    echo $message_display;
                                echo "</div>";
                            }
                        ?>
                    </div>
                    <h3><b>GrabTalent registration takes less than 5 minutes</b></h3><br />
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