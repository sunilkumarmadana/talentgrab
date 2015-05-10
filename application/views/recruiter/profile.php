<script type="text/javascript">
$(document).ready(function() {
    $('#inputPhonenumber').unbind('keyup change input paste').bind('keyup keypress change input paste',function(e){
        var $this = $(this);
        var val = $this.val();
        var valLength = val.length;
        var maxCount = $this.attr('maxlength');
        if(valLength>maxCount){
            $this.val($this.val().substring(0,maxCount));
        }
        return !(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46);
    });
    
    //Skill add window.
	$("button#password-btn-save").click(function() {
	   var candidate_email = $("input[name='candidate-profile-email']").val();
	   var newpassword = $("input[name='newPassword']").val();
	   var confirmnewpassword = $("input[name='confirmnewPassword']").val();
       if(newpassword == confirmnewpassword) {
            $(this).html("<img src='/images/loading.gif' width='20px' height='20px'/>&nbsp;Please Wait").attr("disabled","disabled");
            // process the form
            $.ajax({
                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url         : '/candidate/change_candidate_password', // the url where we want to POST
                data        : {'candidate-email' : candidate_email, 'newpassword' : newpassword}, // our data object
                crossDomain : true 
            })
            .done(function(data) {
                if(data == "success") { 
			         $('#chgpasswdModal').modal('hide');
                     $('.alert-success').css("display","block").html("Password has been changed successfully!!");
                     redirect_page();
                } 
            })
            .fail(function(data) {
                alert("Something went wrong, Please try again!.");
            });
            $('.alert').delay(3000).fadeOut('slow');
            event.preventDefault();
       } else {
            $("#modal-error-msg").text("Passwords do not match, please try again!");
            $("input[name^='new-password']").val('');
            $("input[name^='new-confirm-password']").val('');
            $('#modal-error-msg').delay(1000).fadeOut('slow');
            return false;
       }
        
	});
    function redirect_page(){
        window.location.href = "/candidate";
    }
});
</script>
<div class="site-wrapper">
    <?php $sess_data = $this->session->userdata('user_data'); ?>
    <div class="site-wrapper-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                        //print_r($this->session->all_userdata());
                        $userData = $this->session->userdata('user_data');
                    ?>
                    <div class="alert alert-success" role="alert" style="display: none;"></div>
                    <div class="alert alert-danger" role="alert" style="display: none;"></div>
                </div>
            </div>
            <?php
                $Vidresume = '';
                $candidate_email = ''; 
            ?>
            <form action="/candidate/profile_update" method="post" enctype="multipart/form-data" role="form" class="form-horizontal">
                <div class="row">
                    <center>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#chgpasswdModal" title="Change Password">Change Password</button>
                            <input type="reset" class="btn btn-danger" value="Reset" />
                        </div>
                    </center>                    
                </div><br />
                <!-- Personal Information section - start -->
                <!-- First Row - Start -->
                <div class="row">
                    <div class="col-md-6">
                        <?php foreach($userData as $usrdt){ ?>
                            <input type="hidden" value="<?php echo $usrdt['employer_contact_email'];?>" name="profile-email" id="profile-email"/><br />
                            <div class="row">
                                <div class="col-md-4"><b>Employer Name:</b></div>
                                <div class="col-md-6"><?php echo $usrdt['employer_name'];?></div>
                            </div><br />
                            <div class="row">
                                <div class="col-md-4"><b>Web-Address:</b></div>
                                <div class="col-md-6"><a href="<?php echo $usrdt['employer_web_address'];?>" target="_blank"><?php echo $usrdt['employer_web_address'];?></a></div>
                            </div><br />
                            <div class="row">
                                <div class="col-md-4"><b>Phone Number:</b></div>
                                <div class="col-md-6"><input type="number" min="0" id="inputPhonenumber" name="inputPhonenumber" value="<?php echo $usrdt['employer_phone'];?>" class="form-control" required maxlength="20"/></div>
                            </div><br />
                            <div class="row">
                                <div class="col-md-4"><b>Fax:</b></div>
                                <div class="col-md-6"><input type="number" min="0" id="inputPhonenumber" name="inputPhonenumber" value="<?php echo $usrdt['employer_fax'];?>" class="form-control" required maxlength="20"/></div>
                            </div><br />
                            <div class="row">
                                <div class="col-md-4"><b>Employer Contact First Name:</b></div>
                                <div class="col-md-6"><?php echo $usrdt['employer_contact_firstname'];?></div>
                            </div><br />
                            <div class="row">
                                <div class="col-md-4"><b>Employer Contact Last Name:</b></div>
                                <div class="col-md-6"><?php echo $usrdt['employer_contact_lastname'];?></div>
                            </div><br />
                            <div class="row">
                                <div class="col-md-4"><b>Employer Contact Email:</b></div>
                                <div class="col-md-6"><?php echo $usrdt['employer_contact_email'];?></div>
                            </div><br />
                            <div class="row">
                                <div class="col-md-4"><b>Employer Brief Description:</b></div>                            
                            </div><br />
                            <div class="row">
                                <div class="col-md-12">
                                <textarea class="form-control" rows="6" id="inputbriefDesc" name="inputbriefDesc"><?php echo $usrdt['employer_description'];?></textarea></div>
                            </div>
                        <?php 
                            $candidate_email = $usrdt['employer_contact_email'];
                            $Vidresume = $usrdt['employer_video'];
                        } ?>
                    </div>
                    <div class="col-md-6">
                        <?php if( $Vidresume != "" || !empty($Vidresume) ) { ?>
                            <video width="520" height="350" controls class="col-xs-12 col-sm-12 col-md-12">
                                <source src="" type="video/mp4" />
                                Your browser does not support the video tag.
                            </video>        
                        <?php } else { ?><br />
                            <img src="/images/no-video-pic.jpg" style="border: 1px solid black;" class="col-xs-12 col-sm-12 col-md-12" />
                        <?php } ?>
                    </div>
                </div><br />
                <!-- Personal Information section - end -->
            </form>
            <!-- Change password window -- Start -->
            <div class="modal fade" id="chgpasswdModal" tabindex="-1" role="dialog" aria-labelledby="chgpasswdModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="chgpasswdModalLabel">Change Password</h4>                                             
                        </div>
                        <div class="modal-body">
                            <center><span id="modal-error-msg" style="color: red;"></span></center>
                            <form method="post" accept-charset="utf-8" enctype="multipart/form-data" role="form" id="candidate_chgpassword-form">
                                <input type="hidden" name="candidate-profile-email" id="candidate-profile-email" value="<?php echo $candidate_email;?>" />
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">New Password:</label>
                                    <input type="password" class="form-control" id="newPassword" name="newPassword"/>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Confirm New Password:</label>
                                    <input type="password" class="form-control" id="confirmnewPassword" name="confirmnewPassword"/>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="password-btn-save">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Change password window -- End -->
        </div>
    </div>
</div>