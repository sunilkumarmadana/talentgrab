<script type="text/javascript">
$(function(){
    // process the form
    $('form').submit(function(event) {
        var formData = {
            'email'             : $('input[name=emailaddress]').val()
        };
        $('#button-submit-password').html("<img src='/images/loading.gif' width='25px' height='25px'/>&nbsp;Please Wait").attr("disabled","disabled");
        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/candidate/sendforgotpwd', // the url where we want to POST
            data        : formData, // our data object
            crossDomain : true 
        })
        .done(function(data) {
            console.log(data);
            if(data == "This email is not registered with us!") {
				$('.alert-danger').css("display","block").html(data);
			} else {            
                window.location ="/candidate";
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
<div class="site-wrapper">
    <div class="site-wrapper-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-success" role="alert" style="display: none;"></div>
                    <div class="alert alert-danger" role="alert" style="display: none;"></div>
                    <h3><b>Forgot Password</b></h3><br />
                    <p>Please provide your email address. We'll send you a link where you can reset your password.</p>
                    <form method="post" accept-charset="utf-8" role="form">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="email" class="form-control" name="emailaddress" id="emailaddress" placeholder="Email Address" required />
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