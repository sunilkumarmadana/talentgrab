<div class="site-wrapper vert-offset-top-5">
    <div class="site-wrapper-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-success" role="alert" style="display: none;"></div>
                    <div class="alert alert-danger" role="alert" style="display: none;"></div>
                    <h3><b><?=lang('recruiterhome.labelforgotpasswd');?></b></h3><br />
                    <p><?=lang('recruiterhome.labelforgotpwdtxt');?></p>
                    <form method="post" accept-charset="utf-8" role="form">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="email" class="form-control" name="emailaddress" id="emailaddress" placeholder="<?=lang('recruiterhome.labelemail');?>" required />
                            </div>
                        </div><br />
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-lg btn-primary btn-block" type="submit" id="button-submit-password">Get a New Password</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- End of Row -->
            </div>  
        </div>
    </div>
</div>
<script type="text/javascript">
$(function(){
    // process the form
    $('form').submit(function(event) {
        var tmp_url = <?php echo "'".base_url()."'"; ?>;
        var post_url = tmp_url.split('/en')[0].replace('http://','https://') + <?php echo "'".$this->lang->lang()."'"; ?> + '/candidate';
        var formData = {
            'email'             : $('input[name=emailaddress]').val()
        };
        $('#button-submit-password').html("<img src='/images/loading.gif' width='25px' height='25px'/>&nbsp;Please Wait").attr("disabled","disabled");
        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : post_url+'/sendforgotpwd', // the url where we want to POST
            data        : formData, // our data object
            crossDomain : true 
        })
        .done(function(data) {
            var response = data.split(';')[0];
            if(response == "success") {
                $('.alert-success').css("display","block").html(data.split(';')[1]);
                window.location = tmp_url.split('/en')[0].replace('http://','https://') + <?php echo "'".$this->lang->lang()."'"; ?> + '/candidate';
			} else if(response == "error") {
                $('.alert-danger').css("display","block").html(data.split(';')[1]);
            }
            $('.alert').delay(3000).fadeOut('slow');
        })
        .fail(function(data) {
            alert("Something went wrong, Please try again!.");
        });
        
        event.preventDefault();
    });
});
</script>