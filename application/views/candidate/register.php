<div class="site-wrapper vert-offset-top-6">
    <div class="site-wrapper-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-success" role="alert" style="display: none;"></div>
                    <div class="alert alert-danger" role="alert" style="display: none;"></div>
                    <a href="<?php echo https_url('/'.$this->lang->lang().'/candidate');?>" target="_self"> < <?=lang('candidatereg.backbtnlink');?></a><br />
                    <h3><b><?=lang('candidatereg.heading');?></b></h3><br />
                    <form method="post" accept-charset="utf-8" role="form">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="email" id="email" placeholder="<?=lang('candidatereg.emailaddress');?>" required />
                            </div>
                        </div><br />
                        <div class="row">
                            <div class="col-md-12">
                                <input type="password" id="password" name="password" class="form-control" placeholder="<?=lang('candidatereg.password');?>" required />
                            </div>
                        </div><br />
                        <div class="row">
                            <div class="col-md-12">
                                <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" placeholder="<?=lang('candidatereg.confirmpassword');?>" required />
                            </div>
                        </div><br />
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-lg btn-primary btn-block" type="submit" id="button-candidate-register"><?=lang('candidatereg.buttonlabel');?></button>
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
        var post_url = tmp_url.split('/en')[0].replace('http://','https://') + <?php echo "'".$this->lang->lang()."'"; ?>;
        $('#button-candidate-register').html("<img src='/images/loading.gif' width='25px' height='25px'/>").attr("disabled","disabled");
        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : post_url+ '/candidate/candidate_register', // the url where we want to POST
            data        : $(this).serialize(), // our data object
            crossDomain : true 
        })
        .done(function(data) {
            var response = data.split(';')[0];
            if(response == "success") {
                //$('.alert-success').css("display","block").html(data.split(';')[1]);
                setTimeout(function() { 
                        window.location = post_url + data.split(';')[1]; 
                        }, 1000 );
			} else if(response == "error") {
                $('.alert-danger').css("display","block").html(data.split(';')[1]);
            }
            $('.alert').delay(3000).fadeOut('slow');
            $('#button-candidate-register').html("<?=lang('candidatereg.buttonlabel');?>").removeAttr("disabled");
            $('form').trigger('reset');
        })
        .fail(function(data) {
            alert("Something went wrong, Please try again!.");
        });
        
        event.preventDefault();
    });
});
</script>