<?php
$forgoturl = $this->lang->lang()."/candidate/forgotpassword";
$newuserurl = $this->lang->lang()."/candidate/register";
?>
<div class="visible-xs visible-sm vert-offset-top-1"></div>
<div class="visible-lg visible-md vert-offset-top-6"></div>
<div class="jobseeker-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success" role="alert" style="display: none;"></div>
                <div class="alert alert-danger" role="alert" style="display: none;"></div>
                <?php //print_r($this->session->all_userdata()); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h2><?=lang('candidatehome.heading');?></h2>
                <form method="post" accept-charset="utf-8" role="form" name="login-form">
                    <label for="name" class="sr-only">Email Address</label>
                    <input type="email" class="form-control" name="emailaddress" id="emailaddress" placeholder="<?=lang('candidatehome.labelemail');?>" required /><br />
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="<?=lang('candidatehome.labelpasswd');?>" required><br />
                    <a href="<?php echo https_url($forgoturl); ?>" target="_parent"><?=lang('candidatehome.labelforgotpasswd');?></a><br /><br />
                    <button class="btn btn-lg btn-primary btn-block" type="submit" id="button-sign-in">Sign in</button>
                </form>                                
            </div>
            <div class="col-md-6">
                <h3><?=lang('candidatehome.newuserheading');?></h3>
                <p><?=lang('candidatehome.text');?></p>
                <a class="btn btn-lg btn-primary btn-block" href="<?php echo https_url($newuserurl);?>"><?=lang('candidatehome.newuserlabeltxt');?></a>
            </div>
        </div>            
    </div> <!-- /container -->
</div>
<script type="text/javascript">
$(function(){   
    
    // process the form
    $('form').submit(function(event) {
        var tmp_url = <?php echo "'".base_url()."'"; ?>;
        var post_url = tmp_url.split('/en')[0].replace('http://','https://') + <?php echo "'".$this->lang->lang()."'"; ?>;
        $('#button-sign-in').html("<img src='/images/loading.gif' width='25px' height='25px'/>&nbsp;Authenticating").attr("disabled","disabled");
        
        var formData = {
            'emailaddress'  : $('input[name=emailaddress]').val(),
            'password'      : $('input[name=password]').val()
        };
        
        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : post_url+'/candidate/candidate_login', // the url where we want to POST
            data        : formData // our data object 
        })
        .done(function(data) {
            var response = data.split(';')[0];
            if(response == "error") {
				$('.alert-danger').css("display","block").html(data.split(';')[1]);
                $('#button-sign-in').html("Sign-in").removeAttr("disabled");
			} else {
                window.location ="candidate_dashboard";
            }
            $('.alert').delay(3000).fadeOut('slow').on('hide', function() {});
        })
        .fail(function(data) {
            alert("Something went wrong, Please try again!.");
        });
        
        event.preventDefault();
    });
});
</script>