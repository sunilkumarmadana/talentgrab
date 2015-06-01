<?php
$url = $this->lang->lang()."/recruiter/forgotpassword";
?>
<div class="visible-xs visible-sm vert-offset-top-3"></div>
<div class="visible-lg visible-md vert-offset-top-5"></div>
<div class="recruiter-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="alert alert-success" role="alert" style="display: none;"></div>
                <div class="alert alert-danger" role="alert" style="display: none;"></div>                    
                <?php //print_r($this->session->all_userdata()); ?>
                <center>
                    <div class="img-div">
                        <img src="/images/profile-pic.jpg" />
                    </div>
                </center>                    
                <h2><?=lang('recruiterhome.heading');?></h2>
                <form method="post" accept-charset="utf-8" role="form">
                    <input type="hidden" id="curr_lang" name="curr_lang" value="<?php echo $this->lang->lang();?>" />                            
                    <label for="emailaddress" class="sr-only">Email Address</label>
                    <input type="text" class="form-control" name="emailaddress" id="emailaddress" placeholder="<?=lang('recruiterhome.labelemail');?>" required autofocus /><br />
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="<?=lang('recruiterhome.labelpasswd');?>" required><br />
                    <a href="<?php echo https_url($url); ?>" target="_parent"><?=lang('recruiterhome.labelforgotpasswd');?></a><br /><br />
                    <button class="btn btn-lg btn-primary btn-block" type="submit" id="button-sign-in">Sign in</button>
                </form>                                
            </div>
        </div>      
    </div> <!-- /container -->
</div>
<script type="text/javascript">
$(function(){
    // process the form
    $('form').submit(function(event) {
        var curr_lang = $('#curr_lang').val();
        var post_url = window.location.href+'/recruiter_login';        
        var formData = {
            'emailaddress'  : $('input[name=emailaddress]').val(),
            'password'      : $('input[name=password]').val()
        };
        $('#button-sign-in').html("<img src='/images/loading.gif' width='25px' height='25px'/>&nbsp;Authenticating").attr("disabled","disabled");
        
        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : post_url, // the url where we want to POST
            data        : formData, // our data object
            crossDomain : true 
        })
        .done(function(data) {
            var response = data.split(',')[1];
            if(response == "Please enter valid Username or Password") {
				$('.alert-danger').css("display","block").html(response);
                $('#button-sign-in').html("Sign-in").removeAttr("disabled");
			} else if(response == "Invalid Username or Password") {                
                $('.alert-danger').css("display","block").html(response);
                $('#button-sign-in').html("Sign-in").removeAttr("disabled");
            } else {
                window.location = response;
            }
            $('.alert').delay(3000).fadeOut('slow').on('hide', function(){});
        })
        .fail(function(data) {
            alert("Something went wrong, Please try again!.");
        });
        
        event.preventDefault();
    });
});
</script>