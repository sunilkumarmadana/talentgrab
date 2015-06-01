<div class="site-wrapper vert-offset-top-6">
    <div class="site-wrapper-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
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
            <form method="post" enctype="multipart/form-data" role="form" class="form-horizontal">
                <div class="row">
                    <center>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary" id="profile-updateBtn"><?=lang('candidateprofile.companyprofupdBtn');?></button>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#chgpasswdModal" title="<?=lang('candidateprofile.companyprofchgpwd');?>"><?=lang('candidateprofile.companyprofchgpwd');?></button>
                            <input type="reset" class="btn btn-danger" value="<?=lang('candidateprofile.companyprofresetBtn');?>" />
                        </div>
                    </center>                    
                </div><br />
                <!-- Personal Information section - start -->
                <!-- First Row - Start -->
                <div class="row">
                    <div class="col-md-8">
                        <?php foreach($userData as $usrdt){ ?>
                            <input type="hidden" value="<?php echo $usrdt['candidate_email'];?>" name="profile-email" id="profile-email"/><br />
                            <div class="row">
                                <div class="col-md-4"><b><?=lang('candidateprofile.firstName')?>:</b></div>
                                <div class="col-md-6"><input type="text" min="0" id="inputCandFirstname" name="inputCandFirstname" value="<?php echo $usrdt['candidate_firstname']; ?>" class="form-control" required maxlength="20"/></div>
                            </div><br />
                            <div class="row">
                                <div class="col-md-4"><b><?=lang('candidateprofile.lastName')?>:</b></div>
                                <div class="col-md-6"><input type="text" min="0" id="inputCandLastname" name="inputCandLastname" value="<?php echo $usrdt['candidate_lastname']; ?>" class="form-control" required maxlength="20"/></div>
                            </div><br />
                            <div class="row">
                                <div class="col-md-4"><b><?=lang('candidateprofile.phonenumber')?>:</b></div>
                                <div class="col-md-6"><input type="number" min="0" id="inputPhonenumber" name="inputPhonenumber" value="<?php echo $usrdt['candidate_phonenumber'];?>" class="form-control" required maxlength="20"/></div>
                            </div><br />
                            <div class="row">
                                <div class="col-md-4"><b><?=lang('candidateprofile.email')?>:</b></div>
                                <div class="col-md-6"><?php echo $usrdt['candidate_email'];?>&nbsp;[<a href="#" target="_self" title="Change Email address">Change</a>]</div>
                            </div><br />                      
                            <div class="row">
                                <div class="col-md-4"><b><?=lang('candidateprofile.briefdescription')?>:</b></div>                            
                            </div><br />
                            <div class="row">
                                <div class="col-md-12">
                                <textarea class="form-control" rows="6" id="inputbriefDesc" name="inputbriefDesc"><?php echo $usrdt['brief_description'];?></textarea></div>
                            </div>
                        <?php 
                            $candidate_email = $usrdt['candidate_email'];
                            $resume = $usrdt['resume_url'];
                            $Vidresume = $usrdt['video_resume_url'];
                        } ?>
                    </div>
                    <div class="col-md-4">
                        <?php if( $Vidresume != "" || !empty($Vidresume) ) { ?>
                            <video width="520" height="350" controls class="col-xs-8 col-sm-8 col-md-8">
                                <source src="" type="video/mp4" />
                                Your browser does not support the video tag.
                            </video>        
                        <?php } else { ?><br />
                            <img src="/images/no-video-pic.jpg" style="border: 1px solid black;" class="col-xs-12 col-sm-12 col-md-12" />
                        <?php } ?>
                    </div>
                </div><br />
                <!-- First Row - End -->                
                <?php if( empty($resume) ) { ?>
                    <div class="row">
                        <div class="col-md-2">
                            <b><?=lang('candidateprofile.resumeUpd')?>:</b>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#resumeuploadModal">Upload Resume</button>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="row">
                        <div class="col-md-2">
                            <b><?=lang('candidateprofile.resumeUpd')?>:</b>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary" data-toggle="modal" id="resumeDownlod">View/Download</button>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#resumeuploadModal">Upload Resume</button>
                        </div>
                    </div>
                <?php } ?>
                <!-- Personal Information section - end -->
            </form>
            <!-- Change password window -- Start -->
            <div class="modal fade" id="chgpasswdModal" tabindex="-1" role="dialog" aria-labelledby="chgpasswdModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="chgpasswdModalLabel"><?=lang('candidateprofile.companyprofchgpwd');?></h4>                                             
                        </div>
                        <div class="modal-body">
                            <center><span id="modal-error-msg" style="color: red;"></span></center>
                            <form method="post" accept-charset="utf-8" enctype="multipart/form-data" role="form" id="candidate_chgpassword-form">
                                <input type="hidden" name="candidate-profile-email" id="candidate-profile-email" value="<?php echo $candidate_email;?>" />
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label"><?=lang('candidateprofile.companyprofchgpwdlbl1');?>:</label>
                                    <input type="password" class="form-control" id="newPassword" name="newPassword"/>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label"><?=lang('candidateprofile.companyprofchgpwdlbl2');?>:</label>
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
            <!-- Upload Resume window -- Start -->
            <div class="modal fade" id="resumeuploadModal" tabindex="-1" role="dialog" aria-labelledby="myresumeuploadModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Upload Resume</h4>
                        </div>
                        <div class="modal-body">
                            <?php
                                $tmp_url = base_url();
                                $uploadresume_url = str_replace('http://','https://',$tmp_url).$this->lang->lang()."/candidate/candidate_resumeupload";
                            ?>
                            <iframe src="<?php echo $uploadresume_url; ?>" width="100%" height="100" frameborder="0" allowtransparency="true"></iframe>  
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <!-- Upload Resume window -- End -->
        </div>
    </div>
</div>
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
    
    var tmp_url = <?php echo "'".base_url()."'"; ?>;
    var post_url = tmp_url.split('/en')[0].replace('http://','https://') + <?php echo "'".$this->lang->lang()."'"; ?> + '/candidate';
    
    // Profile Update
    $('form').submit(function(event) {
        var fname = $('#inputCandFirstname').val();
        var lname = $('#inputCandLastname').val();
        var cand_phone = $('#inputPhonenumber').val();

        if( $.trim(fname).length == 0 || $.trim(lname).length == 0 || $.trim(cand_phone).length == 0 ) {
            $('.alert-danger').css("display","block").html("Please fill all mandatory fields");
        } else {
            $('button#profile-updateBtn').html("<img src='/images/loading.gif' width='20px' height='20px'/>").attr("disabled","disabled");
            // process the form
            $.ajax({
                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url         : post_url+'/profile_update', // the url where we want to POST
                //data        : { 'candidate_phone' : cand_phone, 'candidate_briefdesc' : cand_briefDesc}, // our data object
                data        : $(this).serialize(),
                crossDomain : true 
            })
            .done(function(data) {
                var response = data.split(';')[0];
                if(response == "success") { 
                     $('.alert-success').css("display","block").html(data.split(';')[1]);
                     setTimeout(function(){ window.location.reload(); }, 3000);
                } else {
                    $('.alert-danger').css("display","block").html(data.split(';')[1]);
                }
                $('button#profile-updateBtn').html(<?php echo "'".lang('candidateprofile.companyprofupdBtn')."'";?>).removeAttr("disabled");
            })
            .fail(function(data) {
                alert("Something went wrong, Please try again!.");
            }); 
        }
        $('.alert').delay(3000).fadeOut('slow');
        event.preventDefault();        
    });
    
    //Resume Download / View button.
	$("button#resumeDownlod").click(function(e) {
        e.preventDefault();  //stop the browser from following
        window.open(post_url+"/candidate_resumedownload/"+<?php echo "'".$resume."'"; ?>);
	});
    
    //Skill add window.
	$("button#password-btn-save").click(function() {
        var candidate_email = $("input[name='candidate-profile-email']").val();
        var newpassword = $("input[name='newPassword']").val();
        var confirmnewpassword = $("input[name='confirmnewPassword']").val();
        if(newpassword == confirmnewpassword) {
            $(this).html("<img src='/images/loading.gif' width='20px' height='20px'/>").attr("disabled","disabled");
            // process the form
            $.ajax({
                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url         : post_url+'/change_candidate_password', // the url where we want to POST
                data        : {'candidate-email' : candidate_email, 'newpassword' : newpassword}, // our data object
                crossDomain : true 
            })
            .done(function(data) {
                if(data == "success") { 
        	         $('#chgpasswdModal').modal('hide');
                     $('.alert-success').css("display","block").html("Password has been changed successfully!!");
                     setTimeout(function() { 
                        window.location = tmp_url.split('/en')[0].replace('http://','https://') + <?php echo "'".$this->lang->lang()."'"; ?> + '/candidate'; 
                     }, 2000 );
                }
                $(this).html(<?php echo "'".lang('candidateprofile.companyprofchgpwd')."'";?>).removeAttr("disabled");
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
});
</script>