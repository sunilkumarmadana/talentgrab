<div class="site-wrapper vert-offset-top-6">
    <div class="site-wrapper-inner">
        <div class="container">
        <?php //print_r($this->session->all_userdata());?>
        <?php $tmpurl = base_url().$this->lang->lang(); $baseurl = str_replace("http://", "https://",$tmpurl); ?>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <form action="<?php echo $baseurl."/signup/register_submit"; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" class="form-horizontal application" role="form" id="example-form">
                        <div>
                            <h3><?=lang('candidatesignup.header1');?></h3>
                            <section>
                                <p><font color="red"><font color="red" size="4px">*</font> <?=lang('candidatesignup.mandatory');?></font></p>
                                <label for="inputfirstName"><?=lang('candidatesignup.firstname');?>: <font color="red" size="4px">*</font></label>
                                    <input type="text" id="inputfirstName" name="inputfirstName" class="required form-control"/><br />
                                <label for="inputlastName"><?=lang('candidatesignup.lastname');?>: <font color="red" size="4px">*</font></label>
                                    <input type="text" id="inputlastName" name="inputlastName" class="required form-control"/><br />                                
                                <label for="email"><?=lang('candidatesignup.email');?>:</label>
                                    <input type="email" value="<?php echo $this->session->userdata('emailaddress'); ?>" class="form-control" disabled /><br />
                                <label for="inputphoneNumberCode"><?=lang('candidatesignup.countryofresidence');?>: <font color="red" size="4px">*</font></label>
                                    <select id="inputphoneNumberCode" name="inputphoneNumberCode" class="required form-control">
                                        <option value="0">--Please Select--</option>
                                        <?php                                
                                            $visa_status_list = $this->db->query('SELECT * FROM candidate_country order by country_name')->result_array();
                                            foreach($visa_status_list as $v) {
                                                echo '<option name="'.$v['country_currency_code'].'" value="'.$v['country_code'].' (+'.$v['country_phone_code'].')">'.$v['country_name'].'</option>';
                                            }                                    
                                        ?>
                                    </select><br />
                                <label for="inputphoneNumber"><?=lang('candidatesignup.phonenumber');?>: <font color="red" size="4px">*</font></label>
                                    <div class="input-group">
                                        <span class="input-group-addon" id="id_phone_country_code"></span>
                                        <input type="text" id="inputphoneNumber" min="1" name="inputphoneNumber" class="required form-control" maxlength="20"/>
                                    </div><br />
                                <label for="inputGender" class="required"><?=lang('candidatesignup.gender');?>: <font color="red" size="4px">*</font></label>
                                <label class="radio-inline">
                                    <input type="radio" name="inputGender" id="inlineRadio1" value="Male" class="required" /> <?=lang('candidatesignup.genderoptn1');?>
                                </label>
                                <label class="radio-inline required">
                                    <input type="radio" name="inputGender" id="inlineRadio2" value="Female" class="required" /> <?=lang('candidatesignup.genderoptn2');?>
                                </label><br /><br />                                
                                <label for="inputNationality"><?=lang('candidatesignup.nationality');?>: <font color="red" size="4px">*</font></label>
                                <select id="inputNationality" name="inputNationality" class="required form-control">
                                    <option value="0">--Please Select--</option>
                                    <?php                                
                                        $nationality_status_list = $this->db->query('SELECT * FROM candidate_country order by country_name')->result_array();
                                        foreach($nationality_status_list as $v) {
                                            echo '<option value="'.$v['country_name'].'">'.$v['country_name'].'</option>';
                                        }                                    
                                    ?>
                                </select><br />
                            </section>
                            <h3><?=lang('candidatesignup.header2');?></h3>
                            <section>
                                <p><font color="red"><font color="red" size="4px">*</font> <?=lang('candidatesignup.mandatory');?></font></p>
                                <label for="inputCurrentposition"><?=lang('candidatesignup.currentposition');?>: <font color="red" size="4px">*</font></label>
                                    <input type="text" name="inputCurrentposition" class="form-control required" id="inputCurrentposition"/><br />
                                <label for="inputCurrentcompany"><?=lang('candidatesignup.currentemployer');?>: <font color="red" size="4px">*</font></label>
                                    <input type="text" name="inputCurrentcompany" class="form-control required" id="inputCurrentcompany"/><br />
                                <label for="inputCompanylocation"><?=lang('candidatesignup.employerlocation');?>: <font color="red" size="4px">*</font></label>
                                    <select id="inputCompanylocation" name="inputCompanylocation" class="required form-control">
                                        <option value="0">--Please Select--</option>
                                        <?php                                
                                            $emp_location_list = $this->db->query('SELECT * FROM candidate_country order by country_name')->result_array();
                                            foreach($emp_location_list as $v) {
                                                echo '<option value="'.$v['country_name'].'">'.$v['country_name'].'</option>';
                                            }                                    
                                        ?>
                                    </select><br />
                                <label for="inputcurrentAnnualSal"><?=lang('candidatesignup.currentmonthsalary');?></label>
                                <div class="row">
                                    <div class="col-xs-3 col-md-2">
                                        <select id="inputcurrAnnualSalCode" name="inputcurrAnnualSalCode" class="required form-control">
                                            <option value="0">--None--</option>
                                            <?php                                
                                                $AnnualSalcurr_code_list = $this->db->query('SELECT distinct(country_currency_code) FROM candidate_country order by country_currency_code')->result_array();
                                                foreach($AnnualSalcurr_code_list as $v) {
                                                    echo '<option value="'.$v['country_currency_code'].'">'.$v['country_currency_code'].'</option>';
                                                }                                    
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-3 col-md-10">
                                        <input type="text" id="inputcurrentAnnualSal" name="inputcurrentAnnualSal" class="required form-control" aria-label="Amount (to the nearest dollar)"/>
                                    </div>
                                </div><br />
                                <label for="inputexpAnnualSal"><?=lang('candidatesignup.expectmonthsalary');?></label>
                                <div class="row">
                                    <div class="col-xs-3 col-md-2">
                                        <select id="inputexpAnnualSalCode" name="inputexpAnnualSalCode" class="required form-control">
                                            <option value="0">--None--</option>
                                            <?php                                
                                                $expAnnualSalcurr_code_list = $this->db->query('SELECT distinct(country_currency_code) FROM candidate_country order by country_currency_code')->result_array();
                                                foreach($expAnnualSalcurr_code_list as $v) {
                                                    echo '<option value="'.$v['country_currency_code'].'">'.$v['country_currency_code'].'</option>';
                                                }                                    
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-3 col-md-10">
                                        <input type="text" id="inputexpAnnualSal" name="inputexpAnnualSal" class="required form-control" aria-label="Amount (to the nearest dollar)"/>
                                    </div>
                                </div><br />
                                <label for="inputExperience"><?=lang('candidatesignup.totyearsexperience');?> <font color="red" size="4px">*</font></label>
                                <input type="text" name="inputTotExperience" id="inputTotExperience" maxlength="2" class="form-control required"/><br />
                            </section>
                            <h3><?=lang('candidatesignup.header3');?></h3>
                            <section>
                                <p><font color="red"><font color="red" size="4px">*</font> <?=lang('candidatesignup.mandatory');?></font></p>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#eduLvlModal"><?=lang('candidatesignup.addeducationbtnlbl');?></button><br /><br />
                                <table class="table table-bordered table-hover" id="eduLvl_table">
                                    <thead>
                    					<tr>
                    						<th class="text-center">#</th>
                    						<th class="text-center"><?=lang('candidatesignup.educationcolumn1');?></th>
                    						<th class="text-center"><?=lang('candidatesignup.educationcolumn2');?></th>
                    						<th class="text-center"><?=lang('candidatesignup.educationcolumn3');?></th>
                                            <th class="text-center"><?=lang('candidatesignup.educationcolumn4');?></th>
                                            <th class="text-center"><?=lang('candidatesignup.educationcolumn5');?></th>
                    					</tr>
                    				</thead>
                                    <tbody id="eduLvl_table_tbody">
                    					<tr id="addr0"></tr>
                    				</tbody>
                                </table>
                                <input type="text" name="inputEducationLvl" id="inputEducationLvl" value="" style="visibility: hidden;" />
                                <label for="inputbriefDesc"><?=lang('candidatesignup.briefdescription');?>:</label>
                                <textarea id="inputbriefDesc" name="inputbriefDesc" rows="7" class="form-control"></textarea><br />
                                <label>
                                    <input type="checkbox" id="inputjobalertagreement" name="inputjobalertagreement"/> <?=lang('candidatesignup.jobalertagreement');?>
                                </label><br /><br />
                                <label id="lblTermsagreement" data-toggle="tooltip" data-placement="top" title="Please choose this option">
                                    <input type="checkbox" id="termsagreement" name="termsagreement"/> <?=lang('candidatesignup.termsandconditions');?>&nbsp;<a href="#" target="_blank"><?=lang('candidatesignup.termsandconditionstxt');?></a>
                                </label><br /><br />
                            </section>
                        </div>
                    </form>
                    <!-- End of Form -->    
                </div>
                <!-- End of Row -->
            </div>
            <!-- Education Level Modal Window -- Start -->
            <div class="modal fade" id="eduLvlModal" tabindex="-1" role="dialog" aria-labelledby="eduLvlModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="eduLvlModalLabel"><?=lang('candidatesignup.addeducationpopuplbl');?></h4>
                        </div>
                        <div class="modal-body">
                            <center><span id="modal-error-msg" style="color: red;"></span></center>
                            <form method="post" accept-charset="utf-8" enctype="multipart/form-data" role="form" id="example-form">
                                <div class="form-group">
                                    <label for="inputSchool" class="control-label"><?=lang('candidatesignup.educationcolumn1');?>:</label>
                                    <input type="text" class="form-control" id="inputSchool" name="inputSchool" required/>
                                </div>
                                <div class="form-group">
                                    <label for="educationlvl" class="control-label"><?=lang('candidatesignup.educationcolumn2');?>:</label>
                                    <select id="educationlvl" name="educationlvl" class="required form-control">
                                        <option value="0">None</option>
                                        <?php                                
                                            $Highdegree_list = array(
                                                "Doctorate" => "Doctorate",
                                                "Master" => "Master",
                                                "Degree" => "Degree",
                                                "Diploma" => "Diploma",
                                                "Professional Certification" => "Professional Certification",
                                                "Higher Nitec" => "Higher Nitec",
                                                "Nitec" => "Nitec",
                                                "A-Level" => "A-Level",
                                                "O-Level" => "O-Level",
                                                "N-Level" => "N-Level",
                                                "Primary" => "Primary",
                                                "N/A" => "N/A"
                                            );
                                            foreach($Highdegree_list as $k => $v) {
                                                echo '<option value="'.$k.'">'.$v.'</option>';
                                            }                                    
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="control-label"><?=lang('candidatesignup.educationcolumn3');?>:</label>
                                    <input type="text" class="form-control" id="inputFieldofStudy" name="inputFieldofStudy" required/>
                                </div>
                                <label for="message-text" class="control-label"><?=lang('candidatesignup.educationcolumn4');?>:</label>
                                <div class="form-group">                                    
                                    <div class="col-xs-12 col-md-4">
                                        <select id="edustart-date" name="edustart-date" class="form-control">
                                            <option value="0"><?=lang('candidatesignup.addeducationpopupDtlbl1');?></option>
                                            <?php
                                                for($dt=1; $dt <= 31; $dt++) {
                                                    echo '<option value="'.$dt.'">'.$dt.'</option>';
                                                }                                    
                                            ?>
                                        </select>
                                    </div>                                    
                                    <div class="col-xs-12 col-md-4">
                                        <select id="edustart-month" name="edustart-month" class="form-control">
                                            <option value="0"><?=lang('candidatesignup.addeducationpopupDtlbl2');?></option>
                                            <?php
                                                $month_list = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
                                                foreach($month_list as $mth) {
                                                    echo '<option value="'.$mth.'">'.$mth.'</option>';
                                                }                                    
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-md-4">
                                        <select id="edustart-year" name="edustart-year" class="form-control">
                                            <option value="0"><?=lang('candidatesignup.addeducationpopupDtlbl3');?></option>
                                            <?php                                            
                                                for($i = 1910; $i <= 2015; $i++) {
                                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                                }                                    
                                            ?>
                                        </select>
                                    </div>
                                </div><br /><br />
                                <label for="message-text" class="control-label"><?=lang('candidatesignup.educationcolumn5');?>:</label>
                                <div class="form-group">                                    
                                    <div class="col-xs-12 col-md-4">
                                        <select id="eduend-date" name="eduend-date" class="form-control">
                                            <option value="0"><?=lang('candidatesignup.addeducationpopupDtlbl1');?></option>
                                            <?php
                                                for($dt=1; $dt <= 31; $dt++) {
                                                    echo '<option value="'.$dt.'">'.$dt.'</option>';
                                                }                                    
                                            ?>
                                        </select>                                        
                                    </div>                                    
                                    <div class="col-xs-12 col-md-4">
                                        <select id="eduend-month" name="eduend-month" class="form-control">
                                            <option value="0"><?=lang('candidatesignup.addeducationpopupDtlbl2');?></option>
                                            <?php
                                                $month_list = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
                                                foreach($month_list as $mth) {
                                                    echo '<option value="'.$mth.'">'.$mth.'</option>';
                                                }                                    
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-md-4">
                                        <select id="eduend-year" name="eduend-year" class="form-control">
                                            <option value="0"><?=lang('candidatesignup.addeducationpopupDtlbl3');?></option>
                                            <?php                                            
                                                for($i = 1910; $i <= 2015; $i++) {
                                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                                }                                    
                                            ?>
                                        </select>
                                    </div>
                                </div><br /><br />
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="eduLvl-btn-add">Add</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Education Level Modal Window -- End -->  
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
    /** Whole signup page Steps with three buttons on top **/
    var form = $("#example-form");
    form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function (event, currentIndex, newIndex) {
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onFinishing: function (event, currentIndex) {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function (event, currentIndex) {

            var educTbl = $("#eduLvl_table > tbody > tr").length;
            var cols = [];
            for(var i = 0; i < (educTbl-1) ; i++) {
                var $columns = $("#addr"+i).find('td');
                var values = "";
                
                $.each($columns, function(i, item) {
                    values = values + item.innerHTML + ',';
                });
                var edited = values.replace(/,\s*$/g,';');
                cols.push(edited);                
            }
            $("#inputEducationLvl").val(cols);
            var terms = $('input[name="termsagreement"]:checked').length;
            var educLvl = $("#inputEducationLvl").val().length;
            if( educLvl == 0 ) {
                $("#eduLvl_table > thead").css("background-color","red");                
                return false;
            } else {
                $("#eduLvl_table > thead").css("background-color","");
                if( terms == 0 ) {
                    $('label[id="lblTermsagreement"]').css("color","red");
                    $('input[id="termsagreement"]').tooltip('show');
                    return false;
                } else {
                    $('label[id="lblTermsagreement"]').css("color","");
                    form.submit();
                    return true;
                }                    
            }            
        }
    });
    
    /** Do not allow characters in Phone Number & Total Experience fields **/
    $('#inputphoneNumber, #inputTotExperience').unbind('keyup change input paste').bind('keyup keypress change input paste',function(e){
        var $this = $(this);
        var val = $this.val();
        var valLength = val.length;
        var maxCount = $this.attr('maxlength');
        if(valLength>maxCount){
            $this.val($this.val().substring(0,maxCount));
        }
        return !(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46);
    });
    
    /** Do not allow characters in Current Monthly Salary, Expected Monthly Salary & Total Work Experience fields **/
    $('#inputcurrentAnnualSal, #inputexpAnnualSal, #inputTotExperience').unbind('keyup change input paste').bind('keyup keypress change input paste',function(e){        
        return !(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46);
    });
    
    /** To Auto-fill Phone code after selecting the Current Living country **/
    $('#inputphoneNumberCode').on('change',function() {
        $('#id_phone_country_code').text($(this).val());
        $('#inputphoneNumber').val('').attr("placeholder","");
        $('#inputresStatusinSG').val($(this).val());
    });
    
    
    $('#inputphoneNumber').on('change',function(){
        //In order to validate drop-downs, we have a hidden field to check the same.
        if( $('#inputphoneNumberCode').val() == 0){
            $(this).attr("placeholder","Please select Country of Residence").val("");
            $('#inputphoneNumberCode').removeClass("valid").addClass("error");
        }
    });
        
    /** Education Level add window. **/
    var j = 0;
	$("button#eduLvl-btn-add").click(function() {
        var schoolname = $("input[name^='inputSchool']").val();
        var educationLvl = $("#educationlvl").find('option:selected').val();
        var fieldofStudy = $("input[name^='inputFieldofStudy']").val();
        var edustrtDt = $("#edustart-date").find('option:selected').val();
        var edustrtMth = $("#edustart-month").find('option:selected').val();
        var edustrtYr = $("#edustart-year").find('option:selected').val();
        var eduendDt = $("#eduend-date").find('option:selected').val();
        var eduendMth = $("#eduend-month").find('option:selected').val();
        var eduendYr = $("#eduend-year").find('option:selected').val();
        var eduStart = edustrtDt +"-"+ edustrtMth +"-"+ edustrtYr;
        var eduEnd = eduendDt +"-"+ eduendMth +"-"+ eduendYr;
        
        /** Check if School Name field is not blank **/
        if (schoolname.length == 0) { $("input[name^='inputSchool']").addClass("error"); }
        $("input[name^='inputSchool']").bind('keyup keydown change', function (e) {
            if ($(this).val().length == 0) { $(this).addClass("error"); } else { $(this).removeClass("error"); }
        });
        
        /** Check if Education Level field is not blank **/
        if (educationLvl == 0) { $("#educationlvl").addClass("error"); }
        $("#educationlvl").bind('change', function (e) {
            if ($(this).val() == 0) { $(this).addClass("error"); } else { $(this).removeClass("error"); }
        });
        
        /** Check if Field of Study field is not blank **/
        if (fieldofStudy.length == 0) { $("input[name^='inputFieldofStudy']").addClass("error"); }
        $("input[name^='inputFieldofStudy']").bind('keyup keydown change', function (e) {
            if ($(this).val().length == 0) { $(this).addClass("error"); } else { $(this).removeClass("error"); }
        });
        
        /** Check if Start Date field is not blank **/
        if (edustrtDt == 0) { $("#edustart-date").addClass("error"); }
        $("#edustart-date").bind('change', function (e) {
            if ($(this).val() == 0) { $(this).addClass("error"); } else { $(this).removeClass("error"); }
        });
        
        if (edustrtMth == 0) { $("#edustart-month").addClass("error"); }
        $("#edustart-month").bind('change', function (e) {
            if ($(this).val() == 0) { $(this).addClass("error"); } else { $(this).removeClass("error"); }
        });
        
        if (edustrtYr == 0) { $("#edustart-year").addClass("error"); }
        $("#edustart-year").bind('change', function (e) {
            if ($(this).val() == 0) { $(this).addClass("error"); } else { $(this).removeClass("error"); }
        });
        
        /** Check if End Date field is not blank **/
        if (eduendDt == 0) { $("#eduend-date").addClass("error"); }
        $("#eduend-date").bind('change', function (e) {
            if ($(this).val() == 0) { $(this).addClass("error"); } else { $(this).removeClass("error"); }
        });
        
        if (eduendMth == 0) { $("#eduend-month").addClass("error"); }
        $("#eduend-month").bind('change', function (e) {
            if ($(this).val() == 0) { $(this).addClass("error"); } else { $(this).removeClass("error"); }
        });
        
        if (eduendYr == 0) { $("#eduend-year").addClass("error"); }
        $("#eduend-year").bind('change', function (e) {
            if ($(this).val() == 0) { $(this).addClass("error"); } else { $(this).removeClass("error"); }
        });
        
        if ( (eduendYr < edustrtYr) && eduendYr !=0 ) {
            $("#modal-error-msg").text("Education End Year cannot be less than Start Year");
        } else {
            $("#modal-error-msg").text("");
        }
        var numItems = $(".modal-body").find('input.error, select.error').length;
        var errormsg = $("#modal-error-msg").text().length;
        if(numItems == 0 && errormsg == 0) {
            $('#addr'+j).html("<td class='text-center'>"+ (j+1) +"</td><td class='text-center'>"+ schoolname +"</td><td class='text-center'>"+ educationLvl +"</td><td class='text-center'>"+ fieldofStudy +"</td><td class='text-center'>"+ eduStart +"</td><td class='text-center'>"+ eduEnd +"</td>");
            $('#eduLvl_table').append('<tr id="addr'+(j+1)+'"></tr>');
            j++;
            $("#eduLvlModal").find('input:text').val('');
            $("#eduLvlModal").find('span').text('');
            $("#eduLvlModal").find('select').val('0');
            $('#eduLvlModal').modal('hide');
            return true;    
        } else {
            return false;    
        }
	});
    $(".modal").on("hidden.bs.modal", function(){
        $(".modal-body").find('input, select').removeClass("error");
        $("#eduLvlModal").find('input:text').val('');
        $("#eduLvlModal").find('span').text('');
        $("#eduLvlModal").find('select').val('0');
    });
});
</script>