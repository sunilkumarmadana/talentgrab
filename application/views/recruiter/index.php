<script type="text/javascript">
$(function(){
    // process the form
    $('form').submit(function(event) {
        var formData = {
            'emailaddress'  : $('input[name=emailaddress]').val(),
            'password'      : $('input[name=password]').val()
        };
        $('#button-sign-in').html("<img src='/images/loading.gif' width='25px' height='25px'/>&nbsp;Authenticating").attr("disabled","disabled");
        
        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/recruiter/recruiter_login', // the url where we want to POST
            data        : formData, // our data object
            crossDomain : true 
        })
        .done(function(data) {
            if(data == "Please enter valid Username or Password") {
				$('.alert-danger').css("display","block").html(data);
                $('#button-sign-in').html("Sign-in").removeAttr("disabled");
			} else if(data == "Invalid Username or Password") {                
                $('.alert-danger').css("display","block").html(data);
                $('#button-sign-in').html("Sign-in").removeAttr("disabled");
            } else {
                window.location ="/recruiter_dashboard";
            }
            $('.alert').delay(3000).fadeOut('slow').on('hide', function() {
                  console.log('#foo is hidden');
            });
        })
        .fail(function(data) {
            alert("Something went wrong, Please try again!.");
        });
        
        event.preventDefault();
    });
});
</script>
<div class="site-wrapper">
    <div class="site-wrapper-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-success" role="alert" style="display: none;"></div>
                    <div class="alert alert-danger" role="alert" style="display: none;"></div>
                    <?php //echo validation_errors(); ?>
                    <h2>Recruiter Portal</h2>
                    <form method="post" accept-charset="utf-8" role="form">                            
                        <label for="emailaddress" class="sr-only">Email Address</label>
                        <input type="text" class="form-control" name="emailaddress" id="emailaddress" placeholder="Email Address" required /><br />
                        <label for="inputPassword" class="sr-only">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required><br />
                        <a href="<?php echo https_url("/recruiter/forgotpassword"); ?>" target="_parent">Forgot Password?</a><br /><br />
                        <button class="btn btn-lg btn-primary btn-block" type="submit" id="button-sign-in">Sign in</button>
                    </form>                                
                </div>
            </div>            
        </div> <!-- /container -->
    </div>
</div>