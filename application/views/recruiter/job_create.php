<div class="site-wrapper vert-offset-top-5">
    <div class="site-wrapper-inner">
        <div class="container">
            <div class="row">
                <?php //print_r($this->session->all_userdata()); ?>
                <div class="alert alert-success" role="alert" style="display: none;"></div>
                <div class="alert alert-danger" role="alert" style="display: none;"></div>                    
                <h3><b><?=lang('recruiterlogin.createjob');?></b></h3><br />
            </div>
            <div class="row">
                <div class="col-md-12 col-md-offset-0">                    
                    <?php $login = $this->session->userdata('logged_in'); ?>
                    <form action="<?php echo https_url("/recruiter/job_register"); ?>" method="post" accept-charset="utf-8" role="form" id="joborderform" class="form-horizontal" enctype="multipart/form-data">
                        <input type="hidden" id="inputEmail" name="inputEmail" value="<?php echo $login; ?>" />
                        <div class="form-group">
                            <label for="inputVideoResume" class="col-sm-2 control-label"><?=lang('recruiterlogin.videointrotxt');?></label>
                            <div class="col-sm-10">
                                <input type="file" name="userfile" size="20" />
                                <p class="help-block">Supported formats: .mp4, .mov (max. file size 2MB)<br />(width=560px, height=320px)</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputJobTitle" class="col-sm-2 control-label"><?=lang('recruiterlogin.jobtitle');?><font color="red" size="4px">*</font> </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputJobTitle" name="inputJobTitle" placeholder="<?=lang('recruiterlogin.jobtitle');?>" required autofocus>
                            </div>
                        </div><br />
                        <div class="form-group">
                            <label for="inputJobTitle" class="col-sm-2 control-label"><?=lang('recruiterlogin.mandatoryskills');?><font color="red" size="4px">*</font> </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputJobMandatorySkl" name="inputJobMandatorySkl" required data-role="tagsinput" placeholder="Add tags" />
                                <p class="help-block">Please enter Tags and press enter to register.</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputJobTitle" class="col-sm-2 control-label"><?=lang('recruiterlogin.desiredskills');?><font color="red" size="4px">*</font> </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputJobDesiredSkl" name="inputJobDesiredSkl" required data-role="tagsinput" placeholder="Add tags" />
                                <p class="help-block">Please enter Tags and press enter to register.</p>
                            </div>
                        </div><br />
                        <div class="form-group">
                            <label for="inputJobMinSalary" class="col-sm-2 control-label"><?=lang('recruiterlogin.minmonthsalary');?><font color="red" size="4px">*</font> </label>
                            <div class="col-sm-2">
                                <select id="inputJobMinSalCurrCode" name="inputJobMinSalCurrCode" class="required form-control">
                                    <option value="0">--None--</option>
                                    <?php                                
                                        $MinSalcurr_code_list = $this->db->query('SELECT distinct(country_currency_code) FROM candidate_country order by country_currency_code')->result_array();
                                        foreach($MinSalcurr_code_list as $v) {
                                            echo '<option value="'.$v['country_currency_code'].'">'.$v['country_currency_code'].'</option>';
                                        }                                    
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputJobMinSalary" name="inputJobMinSalary" placeholder="<?=lang('recruiterlogin.minmonthsalary');?>" required>
                            </div>
                        </div><br />
                        <div class="form-group">
                            <label for="inputJobMaxSalary" class="col-sm-2 control-label"><?=lang('recruiterlogin.maxmonthsalary');?><font color="red" size="4px">*</font> </label>
                            <div class="col-sm-2">
                                <select id="inputJobMaxSalCurrCode" name="inputJobMaxSalCurrCode" class="required form-control">
                                    <option value="0">--None--</option>
                                    <?php                                
                                        $MinSalcurr_code_list = $this->db->query('SELECT distinct(country_currency_code) FROM candidate_country order by country_currency_code')->result_array();
                                        foreach($MinSalcurr_code_list as $v) {
                                            echo '<option value="'.$v['country_currency_code'].'">'.$v['country_currency_code'].'</option>';
                                        }                                    
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputJobMaxSalary" name="inputJobMaxSalary" placeholder="<?=lang('recruiterlogin.maxmonthsalary');?>" required>
                            </div>
                        </div><br />
                        <div class="form-group">
                            <label for="inputJobPriworklocctry" class="col-sm-2 control-label"><?=lang('recruiterlogin.priworklocationctry');?><font color="red" size="4px">*</font> </label>
                            <div class="col-sm-10">
                                <select id="inputJobPriworklocctry" name="inputJobPriworklocctry" class="required form-control">
                                    <option value="0">--Please Select--</option>
                                    <?php                                
                                        $emp_location_list = $this->db->query('SELECT * FROM candidate_country order by country_name')->result_array();
                                        foreach($emp_location_list as $v) {
                                            echo '<option value="'.$v['country_name'].'">'.$v['country_name'].'</option>';
                                        }                                    
                                    ?>
                                </select>
                            </div>
                        </div><br />
                        <div class="form-group">
                            <label for="inputJobPriworkloccity" class="col-sm-2 control-label"><?=lang('recruiterlogin.priworklocationcity');?><font color="red" size="4px">*</font> </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputJobPriworkloccity" name="inputJobPriworkloccity" placeholder="<?=lang('recruiterlogin.priworklocationcity');?>" required>
                            </div>
                        </div><br />
                        <div class="form-group">
                            <label for="inputJobCategory" class="col-sm-2 control-label"><?=lang('recruiterlogin.jobcateg');?><font color="red" size="4px">*</font> </label>
                            <div class="col-sm-10">
                                <select id="inputJobCategory" name="inputJobCategory" class="required form-control">
                                    <option>--None--</option>
                                    <option>Executive</option>
                                    <option>Finance & Accounting</option>
                                    <option>Financial Services</option>
                                    <option>HR & GA</option>
                                    <option>Internal IT</option>
                                </select>
                            </div>
                        </div><br />
                        <div class="form-group">
                            <label for="inputJobFunction" class="col-sm-2 control-label"><?=lang('recruiterlogin.jobfunc');?><font color="red" size="4px">*</font> </label>
                            <div class="col-sm-10">
                                <select id="inputJobFunction" name="inputJobFunction" class="required form-control">
                                    <option>--None--</option>
                                    <option>CEO/Country Manager/MD</option>
                                    <option>GM</option>
                                    <option>CFO</option>
                                    <option>CTO</option>
                                    <option>CIO (IT)</option>
                                </select>
                            </div>
                        </div><br />
                        <div class="form-group">
                            <label for="inputJobIndustry" class="col-sm-2 control-label"><?=lang('recruiterlogin.jobindustry');?><font color="red" size="4px">*</font> </label>
                            <div class="col-sm-10">
                                <select id="inputJobIndustry" name="inputJobIndustry" class="required form-control">
                                    <option>--None--</option>
                                    <option>Financial Services</option>
                                    <option>Consumer/Retail</option>
                                    <option>Healthcare</option>
                                    <option>Services</option>
                                    <option>Technology/Online</option>
                                </select>
                            </div>
                        </div><br />
                        <div class="form-group">
                            <label for="inputJobSubIndustry" class="col-sm-2 control-label"><?=lang('recruiterlogin.jobsubindustry');?><font color="red" size="4px">*</font> </label>
                            <div class="col-sm-10">
                                <select id="inputJobSubIndustry" name="inputJobSubIndustry" class="required form-control">
                                    <option>--None--</option>
                                    <option>Financial Services</option>
                                    <option>Consumer/Retail</option>
                                    <option>Healthcare</option>
                                    <option>Services</option>
                                    <option>Technology/Online</option>
                                </select>
                            </div>
                        </div><br />
                        <div class="form-group">
                            <label for="inputJobDescription" class="col-sm-2 control-label"><?=lang('recruiterlogin.jobdesc');?><font color="red" size="4px">*</font> </label>
                            <div class="col-sm-10">
                                <!--<textarea class="form-control" rows="16" id="inputJobDescription" name="inputJobDescription" placeholder="Job Description" required></textarea>-->
                                <div class="btn-toolbar" data-role="editor-toolbar" data-target="#editor">
                                    <div class="btn-group">
                                        <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="icon-bold"></i></a>
                                        <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="icon-italic"></i></a>
                                        <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="icon-strikethrough"></i></a>
                                        <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="icon-underline"></i></a>
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="icon-list-ul"></i></a>
                                        <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="icon-list-ol"></i></a>
                                        <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="icon-indent-left"></i></a>
                                        <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="icon-indent-right"></i></a>
                                    </div>
                                </div><br />
                                <div id="editor" name="inputJobDescription"></div><br />
                                <p class="help-block" style="color: red;">Special characters and sybmols like #, [ ] and all others are not allowed.</p>
                            </div>
                        </div><br />
                        <div class="form-group">
                            <label for="inputJobBenefits" class="col-sm-2 control-label"><?=lang('recruiterlogin.jobbenefits');?></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputJobBenefits" name="inputJobBenefits" placeholder="<?=lang('recruiterlogin.jobbenefits');?>" required>
                            </div>
                        </div><br />
                        <div class="form-group">
                            <label for="inputJobWorkingHours" class="col-sm-2 control-label"><?=lang('recruiterlogin.jobworkinghours');?></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputJobWorkingHours" name="inputJobWorkingHours" placeholder="<?=lang('recruiterlogin.jobworkinghours');?>" required>
                            </div>
                        </div><br />
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="postjob" name="postjob"><?=lang('recruiterlogin.postlabel');?>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-lg btn-primary btn-block" type="submit" id="button-job-create"><?=lang('recruiterlogin.registerbuttonlabel')?></button>
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
    $('#editor').wysiwyg();
    /** Do not allow characters in Current Monthly Salary, Expected Monthly Salary & Total Work Experience fields **/
    $('#inputJobMinSalary, #inputJobMaxSalary').unbind('keyup change input paste').bind('keyup keypress change input paste',function(e){        
        return !(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46);
    });    
    // process the form
    $('form').submit(function(event) {
        
        var tmp_url = <?php echo "'".base_url()."'"; ?>;
        var post_url = tmp_url.split('/en')[0].replace('http://','https://') + <?php echo "'".$this->lang->lang()."'"; ?> + '/recruiter';
        $('#button-job-create').html("<img src='/images/loading.gif' width='25px' height='25px'/>").attr("disabled","disabled");
        
        if($('#inputJobMinSalCurrCode').val() == 0) {
            $('.alert-danger').css("display","block").html("Please select all the mandatory fields");
            $('.alert').delay(3000).fadeOut('slow').on('hide', function(){});
            return false;
        } else {
            var formData = $( this ).serialize() + '&inputJobDescription=' + $('#editor').html();  
            
            // process the form
            $.ajax({
                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url         : post_url+'/job_register', // the url where we want to POST
                data        : formData,
                crossDomain : true 
            })
            .done(function(data) {                
                var response = data.split(';')[0];
                if(response == "success") {
                    $('.alert-success').css("display","block").html(data.split(';')[1]);
                    $('html, body').animate({ scrollTop: 0 }, 0);
                    setTimeout(function() { 
                        window.location = tmp_url.split('/en')[0].replace('http://','https://') + <?php echo "'".$this->lang->lang()."'"; ?> + '/recruiter_dashboard';
                        }, 3000 );
    			} else if(response == "error") {
                    $('.alert-danger').css("display","block").html(data.split(';')[1]).focus();
                }
                $('.alert').delay(3000).fadeOut('slow').on('hide', function(){});
            })
            .fail(function(data) {
                alert("Something went wrong, Please try again!.");
            });
        }
        
        event.preventDefault();
    });
});
</script>