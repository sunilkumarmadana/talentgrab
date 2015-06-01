<div class="site-wrapper vert-offset-top-6">
    <?php $sess_data = $this->session->userdata('user_data'); ?>
    <div class="site-wrapper-inner">
        <div class="container">
            <?php 
            //print_r($this->session->all_userdata()); 
            $video_url = '';
            ?>            
            <!-- Personal Information section -->
            <!-- First Row - Start -->
            <div class="row">
                <div class="col-md-6">
                    <?php foreach($sess_data as $usrdt){ ?>
                        <input type="hidden" value="<?php echo $usrdt['candidate_email'];?>" name="skill-email" id="skill-email"/><br />
                        <div class="row">
                            <div class="col-md-4"><b><?=lang('candidatesignup.name')?>:</b></div>
                            <div class="col-md-6"><?php echo ($usrdt['candidate_gender']='Male' ) ? "Mr. " :"Mrs. ";?><?php echo $usrdt['candidate_firstname']." ".$usrdt['candidate_lastname'];?></div>
                        </div><br />
                        <div class="row">
                            <div class="col-md-4"><b><?=lang('candidatesignup.phonenumber')?>:</b></div>
                            <div class="col-md-6"><?php echo $usrdt['candidate_phonecountrycode']. " - ". $usrdt['candidate_phonenumber'];?></div>
                        </div><br />
                        <div class="row">
                            <div class="col-md-4"><b><?=lang('candidatesignup.email')?>:</b></div>
                            <div class="col-md-6"><?php echo $usrdt['candidate_email'];?></div>
                        </div><br />                        
                        <div class="row">
                            <div class="col-md-4"><b><?=lang('candidatesignup.briefdescription')?>:</b></div>                            
                        </div><br />
                        <div class="row">
                            <div class="col-md-12"><p style="word-wrap: normal;"><?php echo $usrdt['brief_description'];?></p></div>
                        </div>
                        <?php $video_url = $usrdt['video_resume_url']; ?>
                    <?php } ?>
                </div>
                <div class="col-md-6">
                    <?php if( $video_url != "" || !empty($video_url) ) { ?>
                        <video width="520" height="350" controls class="col-xs-12 col-sm-12 col-md-12">
                            <source src="" type="video/mp4" />
                            Your browser does not support the video tag.
                        </video>        
                    <?php } else { ?>
                        <img src="/images/no-video-pic.jpg" style="border: 1px solid black;" class="col-xs-12 col-sm-12 col-md-12" />
                    <?php } ?>
                </div>
            </div>
            <!-- First Row - End -->
            
            <!-- Skills Section -->
            <!-- Second Row - Start -->
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <h4><?=lang('candidatedash.skills')?>:<button type="button" class="btn btn-xs" data-toggle="modal" data-target="#skillModal" title="Add more Skills"><img src="/images/add_icon.png" height="20" width="20"/></button></h4>
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr class="info">
                                <th><?=lang('candidatedash.skilltblheading1');?></th>
                                <th><?=lang('candidatedash.skilltblheading2');?></th>
                                <th><?=lang('candidatedash.skilltblheading3');?></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = $this->db->select('candidate_skills')->where_in('candidate_email', $this->session->userdata('logged_in') )->get('candidate_signup');
                                foreach ($query->result_array() as $row) {
                                    if( $row['candidate_skills'] != null || $row['candidate_skills'] != "") {
                                        $skills = explode(";", $row['candidate_skills']);                                        
                                        foreach($skills as $val) {                                            
                                            $sklval = explode(",", $val);
                                            echo "<tr>";
                                            echo "<td>".$sklval[0]."</td>";
                                            echo "<td>".$sklval[1]."</td>";
                                            echo "<td>".$sklval[2]."</td>";
                                            echo "<td><button type='button' class='btn btn-xs btn-danger' data-toggle='modal' id='skill-btn-delete' value='".$val."'>Delete</button></td>";
                                            echo "</tr>";    
                                        }    
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 hidden-xs">
                    <h4><?=lang('candidatedash.candidatereference');?>:</h4>
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr class="info">
                                <th><?=lang('candidatedash.candidaterefheading1');?></th>
                                <th><?=lang('candidatedash.candidaterefheading2');?></th>
                                <th><?=lang('candidatedash.candidaterefheading3');?></th>
                                <th><?=lang('candidatedash.candidaterefheading4');?></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- Second Row - End -->
            <!-- Third Row - Start -->
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <h4><?=lang('candidatedash.academicdetails')?>:</h4>
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr class="info">
                                <th><?=lang('candidatesignup.educationcolumn1')?></th>
                                <th><?=lang('candidatesignup.educationcolumn2')?></th>
                                <th><?=lang('candidatesignup.educationcolumn3')?></th>
                                <th><?=lang('candidatesignup.educationcolumn4')?></th>
                                <th><?=lang('candidatesignup.educationcolumn5')?></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = $this->db->select('*')->where_in('candidate_email', $this->session->userdata('logged_in') )->get('candidate_education');
                                foreach ($query->result_array() as $row) {
                                    echo "<tr>";
                                    echo "<td>".$row["candidate_univ_name"]."</td>";
                                    echo "<td>".$row["candidate_degree"]."</td>";
                                    echo "<td>".$row["candidate_field_of_study"]."</td>";
                                    echo "<td>".date("d-M-Y",strtotime($row["candidate_edu_startDt"]))."</td>";
                                    echo "<td>".date("d-M-Y",strtotime($row["candidate_edu_endDt"]))."</td>";
                                    echo "<td><button type='button' class='btn btn-xs btn-success' data-toggle='modal'>Edit</button></td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Third Row - End -->
            <!-- Fourth Row - Start -->
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <h4><?=lang('candidatedash.workexp')?>:<button type="button" class="btn btn-xs" data-toggle="modal" data-target="#workExpModal" title="Add Work Experience"><img src="/images/add_icon.png" height="20" width="20"/></button></h4>
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr class="info">
                                <th><?=lang('candidatedash.workexptblheading1');?></th>
                                <th><?=lang('candidatedash.workexptblheading2');?></th>
                                <th><?=lang('candidatedash.workexptblheading3');?></th>
                                <th><?=lang('candidatedash.workexptblheading4');?></th>
                                <th><?=lang('candidatedash.workexptblheading5');?></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = $this->db->select('*')->where_in('candidate_email', $this->session->userdata('logged_in') )->get('candidate_employment');
                                foreach ($query->result_array() as $row) {
                                    echo "<tr>";
                                    echo "<td>".$row["candidate_emp_name"]."</td>";
                                    echo "<td>".$row["candidate_curr_designation"]."</td>";
                                    echo "<td>".$row["candidate_emp_location"]."</td>";
                                    echo "<td>".date("d-M-Y",strtotime($row["candidate_emp_startDt"]))."</td>";
                                    echo "<td>".date("d-M-Y",strtotime($row["candidate_emp_endDt"]))."</td>";
                                    echo "<td><button type='button' class='btn btn-xs btn-danger' data-toggle='modal' id='workExp-btn-delete' value='".$row["candidate_ref_id"]."'>Delete</button></td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Fourth Row - End -->
            <!-- Fifth Row - Start -->
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 hidden-xs">
                    <h4><?=lang('candidatedash.mypastapplication')?>:</h4>
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr class="info">
                                <th><?=lang('candidatedash.mypastapplnheading1');?></th>
                                <th><?=lang('candidatedash.mypastapplnheading2');?></th>
                                <th><?=lang('candidatedash.mypastapplnheading3');?></th>
                                <th><?=lang('candidatedash.mypastapplnheading4');?></th>
                                <th><?=lang('candidatedash.mypastapplnheading5');?></th>
                                <th><?=lang('candidatedash.mypastapplnheading6');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = $this->db->select('*')->where_in('candidate_email', $this->session->userdata('logged_in') )->get('candidate_application');
                                foreach ($query->result_array() as $row) {
                                    echo "<tr>";
                                    echo "<td><a href='/candidate/job/".$row['candidate_appln_job_id']."'>".$row['candidate_appln_job_id']."</a></td>";
                                    echo "<td>".$row['candidate_applied_date']."</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>Application</td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Fifth Row - End -->
            
            <!-- Skill Modal Window -- Start -->
            <div class="modal fade" id="skillModal" tabindex="-1" role="dialog" aria-labelledby="skillModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="skillModalLabel"><?=lang('candidatedash.skilltblheadingpopup');?></h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" accept-charset="utf-8" enctype="multipart/form-data" role="form" id="example-form">
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label"><?=lang('candidatedash.skilltblheading1');?>:</label>
                                    <input type="text" class="form-control" id="skill-name" name="skill-name">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="control-label"><?=lang('candidatedash.skilltblheading2');?>:</label>
                                    <select id="skill-level" name="skill-level" class="required form-control">
                                        <option>--None--</option>
                                        <option>Basic</option>
                                        <option>Intermediate</option>
                                        <option>Advanced</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="control-label"><?=lang('candidatedash.skilltblheading3');?>:</label>
                                    <select id="skill-rating" name="skill-rating" class="required form-control">
                                        <option>--None--</option>
                                        <option>0</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="skill-btn-save">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Skill Modal Window -- End -->
            <!-- Work Experience Modal Window -- Start -->
            <div class="modal fade" id="workExpModal" tabindex="-1" role="dialog" aria-labelledby="workExpModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="workExpModalLabel"><?=lang('candidatedash.workexptblheadingpopup');?></h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" accept-charset="utf-8" enctype="multipart/form-data" role="form" id="example-form">
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label"><?=lang('candidatedash.workexptblheading1');?>:</label>
                                    <input type="text" class="form-control" id="employer-name" name="employer-name"/>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="control-label"><?=lang('candidatedash.workexptblheading2');?>:</label>
                                    <input type="text" class="form-control" id="designation" name="designation"/>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="control-label"><?=lang('candidatedash.workexptblheading3');?>:</label>
                                    <select id="country" name="country" class="form-control">
                                        <option value="0">--None--</option>
                                        <?php
                                            $nationality_status_list = $this->db->query('SELECT * FROM candidate_country order by country_name')->result_array();
                                            foreach($nationality_status_list as $v) {
                                                echo '<option value="'.$v['country_name'].'">'.$v['country_name'].'</option>';
                                            }                                    
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="control-label"><?=lang('candidatedash.workexptblheading4');?>:</label>
                                    <div class="form-group">                                    
                                        <div class="col-xs-12 col-md-4">
                                            <select id="empstart-date" name="empstart-date" class="form-control">
                                                <option value="0"><?=lang('candidatesignup.addeducationpopupDtlbl1');?></option>
                                                <?php
                                                    for($dt=1; $dt <= 31; $dt++) {
                                                        echo '<option value="'.$dt.'">'.$dt.'</option>';
                                                    }                                    
                                                ?>
                                            </select>
                                        </div>                                    
                                        <div class="col-xs-12 col-md-4">
                                            <select id="empstart-month" name="empstart-month" class="form-control">
                                                <option value="0"><?=lang('candidatesignup.addeducationpopupDtlbl2');?></option>
                                                <?php
                                                    $i = 1;
                                                    $month_list = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
                                                    foreach($month_list as $mth) {
                                                        echo '<option value="'.$i.'">'.$mth.'</option>';
                                                        $i++;
                                                    }                                    
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <select id="empstart-year" name="empstart-year" class="form-control">
                                                <option value="0"><?=lang('candidatesignup.addeducationpopupDtlbl3');?></option>
                                                <?php                                            
                                                    for($i = 1910; $i <= 2015; $i++) {
                                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                                    }                                    
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div><br /><br />
                                <div class="form-group">
                                    <label for="message-text" class="control-label"><?=lang('candidatedash.workexptblheading5');?>:</label>
                                    <div class="form-group">                                    
                                        <div class="col-xs-12 col-md-4">
                                            <select id="empend-date" name="empend-date" class="form-control">
                                                <option value="0"><?=lang('candidatesignup.addeducationpopupDtlbl1');?></option>
                                                <?php
                                                    for($dt=1; $dt <= 31; $dt++) {
                                                        echo '<option value="'.$dt.'">'.$dt.'</option>';
                                                    }                                    
                                                ?>
                                            </select>
                                        </div>                                    
                                        <div class="col-xs-12 col-md-4">
                                            <select id="empend-month" name="empend-month" class="form-control">
                                                <option value="0"><?=lang('candidatesignup.addeducationpopupDtlbl2');?></option>
                                                <?php
                                                    $i = 1;
                                                    $month_list = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
                                                    foreach($month_list as $mth) {
                                                        echo '<option value="'.$i.'">'.$mth.'</option>';
                                                        $i++;
                                                    }                                    
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <select id="empend-year" name="empend-year" class="form-control">
                                                <option value="0"><?=lang('candidatesignup.addeducationpopupDtlbl3');?></option>
                                                <?php                                            
                                                    for($i = 1910; $i <= 2015; $i++) {
                                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                                    }                                    
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div><br />
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="workExp-btn-save">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Work Experience Modal Window -- End -->
        </div>
    </div>
</div>
<script>
 $(function() {
    var tmp_url = <?php echo "'".base_url()."'"; ?>;
    var post_url = tmp_url.split('/en')[0].replace('http://','https://') + <?php echo "'".$this->lang->lang()."'"; ?>;
    event.preventDefault();
    //Skill add window.
	$("button#skill-btn-save").click(function(event) {
	   $(this).html('<img src="/images/loading.gif" height="20" width="20" />');
        var email = $("input[name^='skill-email']").val();
        var skillname = $("input[name^='skill-name']").val();
        var skilllvl = $("#skill-level option:selected").text();
        var skillrate = $("#skill-rating option:selected").text();
        $.ajax({
        	type                : 'POST',
        	url                 : post_url+'/candidate_dashboard/add_skill',
        	data                : {'skillemail' : email, 'skillname' : skillname, 'skilllevel' : skilllvl, 'skillrating' : skillrate},
            crossDomain         : true
        }).done(function() {
            $('#skillModal').modal('hide');
            window.location.reload();
            $(this).html(<?php echo "'".lang('candidateprofile.companyprofchgpwd')."'";?>).removeAttr("disabled");
        })
        .fail(function(data) {
            alert("Something went wrong, Please try again!.");
        });
        event.preventDefault();
	});
    //Skill delete window.
	$("button#skill-btn-delete").click(function() {
        var tmp_url = <?php echo "'".base_url()."'"; ?>;
        var post_url = tmp_url.split('/en')[0].replace('http://','https://') + <?php echo "'".$this->lang->lang()."'"; ?>;
        $(this).prop('disabled','true');
        $(this).html('<img src="/images/loading.gif" height="20" width="20" />');
        var email = $("input[name^='skill-email']").val();
        var skilldelval = $(this).val();
        $.ajax({
        	'type': 'POST',
        	'url' : post_url+'/candidate_dashboard/remove_skill',
        	'crossDomain' : true,
        	'data': {'skillemail' : email, 'skilldelvalue' : skilldelval},
        	'success': function(response) {
                if(response == "success") {
                     window.location.reload(true); 
                } 
            },
        	'failure': function(response) { alert("Something went wrong.");}
        });
	});
    
    //Work Experience add window.
	$("button#workExp-btn-save").click(function() {
        var email = $("input[name^='skill-email']").val();
        var empname = $("input[name^='employer-name']").val();
        var empdesignation = $("input[name^='designation']").val();
        var empcountry = $("#country").find('option:selected').val();
        var empstrtDt = $("#empstart-date").find('option:selected').val();
        var empstrtMth = $("#empstart-month").find('option:selected').val();
        var empstrtYr = $("#empstart-year").find('option:selected').val();
        var empendDt = $("#empend-date").find('option:selected').val();
        var empendMth = $("#empend-month").find('option:selected').val();
        var empendYr = $("#empend-year").find('option:selected').val();
        var empstartDt = empstrtYr +"-"+ empstrtMth +"-"+ empstrtDt;
        var empendDt = empendYr +"-"+ empendMth +"-"+ empendDt;
        $.ajax({
			'type': 'POST',
			'url' : post_url+'/candidate_dashboard/add_Workexp',
			'crossDomain' : true,
			'data': {
			     'candidateemail' : email, 
                 'employername' : empname, 
                 'employerdesig' : empdesignation, 
                 'employerctry' : empcountry,
                 'employerStartDt' : empstartDt,
                 'employerEndDt' : empendDt
            },
			'success': function(response) { 
                if(response == "success") { 
			         $('#workExpModal').modal('hide');
                     window.location.reload(true); 
                } 
            },
			'failure': function(response) { alert("Something went wrong.");}
		});
	});
    
    //Work Experience delete window.
	$("button#workExp-btn-delete").click(function() {
	   $(this).prop('disabled','true');
       $(this).html('<img src="/images/loading.gif" height="25" width="25" />');
        var email = $("#skill-email").val();
        var candRefid = $(this).val();
        $.ajax({
			'type': 'POST',
			'url' : post_url+'/candidate_dashboard/delete_Workexp',
			'crossDomain' : true,
			'data': {
			     'candidateemail' : email, 
                 'candidateId' : candRefid
            },
			'success': function(response) { 
                if(response == "success") { 
                     window.location.reload(true); 
                } 
            },
			'failure': function(response) { alert("Something went wrong.");}
		});
	});
});
</script>