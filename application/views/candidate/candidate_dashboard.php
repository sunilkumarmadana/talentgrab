<script>
 $(function() {        
    //Skill add window.
	$("button#skill-btn-save").click(function() {
	   var email = $("input[name^='skill-email']").val();
	   var skillname = $("input[name^='skill-name']").val();
       var skilllvl = $("#skill-level option:selected").text();
       var skillrate = $("#skill-rating option:selected").text();
        $.ajax({
			'type': 'POST',
			'url' : 'candidate_dashboard/add_skill',
			'crossDomain' : true,
			'data': {'skillemail' : email, 'skillname' : skillname, 'skilllevel' : skilllvl, 'skillrating' : skillrate},
			'success': function(response) {
                if(response == "success") { 
			         $('#skillModalLabel').modal('hide');
                     window.location.reload(); 
                } 
            },
			'failure': function(response) { alert("Something went wrong.");}
		});
	});
    //Skill delete window.
	$("button#skill-btn-delete").click(function() {
	   $(this).prop('disabled','true');
       $(this).html('<img src="images/loading.gif" height="25" width="25" />');
	   var email = $("input[name^='skill-email']").val();
       var skilldelval = $(this).val();
       $.ajax({
			'type': 'POST',
			'url' : 'candidate_dashboard/remove_skill',
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
			'url' : 'candidate_dashboard/add_Workexp',
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
       $(this).html('<img src="images/loading.gif" height="25" width="25" />');
        var email = $("#skill-email").val();
        var candRefid = $(this).val();
        $.ajax({
			'type': 'POST',
			'url' : 'candidate_dashboard/delete_Workexp',
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

<div class="site-wrapper">
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
                            <div class="col-md-4"><b>Name:</b></div>
                            <div class="col-md-6"><?php echo ($usrdt['candidate_gender']='Male' ) ? "Mr. " :"Mrs. ";?><?php echo $usrdt['candidate_firstname']." ".$usrdt['candidate_lastname'];?></div>
                        </div><br />
                        <div class="row">
                            <div class="col-md-4"><b>Phone Number:</b></div>
                            <div class="col-md-6"><?php echo $usrdt['candidate_phonecountrycode']. " - ". $usrdt['candidate_phonenumber'];?></div>
                        </div><br />
                        <div class="row">
                            <div class="col-md-4"><b>Email:</b></div>
                            <div class="col-md-6"><?php echo $usrdt['candidate_email'];?></div>
                        </div><br />                        
                        <div class="row">
                            <div class="col-md-4"><b>Brief Description:</b></div>                            
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
                    <h4>Skills:<button type="button" class="btn btn-xs" data-toggle="modal" data-target="#skillModal" title="Add more Skills"><img src="/images/add_icon.png" height="20" width="20"/></button></h4>
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr class="info">
                                <th>Skill Name</th>
                                <th>Skill Level</th>
                                <th>Rating (Out of 5)</th>
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
                                            echo "<td><button type='button' class='btn btn-xs btn-success' data-toggle='modal'>Edit</button>&nbsp;&nbsp;<button type='button' class='btn btn-xs btn-danger' data-toggle='modal' id='skill-btn-delete' value='".$val."'>Delete</button></td>";
                                            echo "</tr>";    
                                        }    
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 hidden-xs">
                    <h4>Candidate References:</h4>
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr class="info">
                                <th>Name</th>
                                <th>Company</th>
                                <th>Email.</th>
                                <th>Phone (If any)</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- Second Row - End -->
            <!-- Third Row - Start -->
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <h4>Academic Details:</h4>
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr class="info">
                                <th>School Name</th>
                                <th>Degree</th>
                                <th>Field of Study</th>
                                <th>Start Date</th>
                                <th>End Date</th>
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
                    <h4>Work Experience:<button type="button" class="btn btn-xs" data-toggle="modal" data-target="#workExpModal" title="Add Work Experience"><img src="/images/add_icon.png" height="20" width="20"/></button></h4>
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr class="info">
                                <th>Employer Name</th>
                                <th>Designation</th>
                                <th>Country</th>
                                <th>Start Date</th>
                                <th>End Date</th>
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
                    <h4>My Past Applications:</h4>
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr class="info">
                                <th>Job Title</th>
                                <th>Job Applied Date</th>
                                <th>Job Posted Date</th>
                                <th>Client</th>
                                <th>Stage reached</th>
                                <th>End Date</th>
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
                            <h4 class="modal-title" id="skillModalLabel">Add Skill</h4>                                             
                        </div>
                        <div class="modal-body">
                            <form method="post" accept-charset="utf-8" enctype="multipart/form-data" role="form" id="example-form">
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Skill Name:</label>
                                    <input type="text" class="form-control" id="skill-name" name="skill-name">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="control-label">Skill Level:</label>
                                    <select id="skill-level" name="skill-level" class="required form-control">
                                        <option>--None--</option>
                                        <option>Basic</option>
                                        <option>Intermediate</option>
                                        <option>Advanced</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="control-label">Rating:</label>
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
                            <h4 class="modal-title" id="workExpModalLabel">Add Work Experience</h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" accept-charset="utf-8" enctype="multipart/form-data" role="form" id="example-form">
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Employer Name:</label>
                                    <input type="text" class="form-control" id="employer-name" name="employer-name"/>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="control-label">Designation:</label>
                                    <input type="text" class="form-control" id="designation" name="designation"/>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="control-label">Country:</label>
                                    <select id="country" name="country" class="form-control">
                                        <?php
                                            $nationality_status_list = $this->db->query('SELECT * FROM candidate_country order by country_name')->result_array();
                                            foreach($nationality_status_list as $v) {
                                                echo '<option value="'.$v['country_name'].'">'.$v['country_name'].'</option>';
                                            }                                    
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="control-label">Start Date:</label>
                                    <div class="form-group">                                    
                                        <div class="col-xs-12 col-md-4">
                                            <select id="empstart-date" name="empstart-date" class="form-control">
                                                <option value="0">Date</option>
                                                <?php
                                                    for($dt=1; $dt <= 31; $dt++) {
                                                        echo '<option value="'.$dt.'">'.$dt.'</option>';
                                                    }                                    
                                                ?>
                                            </select>
                                        </div>                                    
                                        <div class="col-xs-12 col-md-4">
                                            <select id="empstart-month" name="empstart-month" class="form-control">
                                                <option value="0">Month</option>
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
                                                <option value="0">Year</option>
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
                                    <label for="message-text" class="control-label">End Date:</label>
                                    <div class="form-group">                                    
                                        <div class="col-xs-12 col-md-4">
                                            <select id="empend-date" name="empend-date" class="form-control">
                                                <option value="0">Date</option>
                                                <?php
                                                    for($dt=1; $dt <= 31; $dt++) {
                                                        echo '<option value="'.$dt.'">'.$dt.'</option>';
                                                    }                                    
                                                ?>
                                            </select>
                                        </div>                                    
                                        <div class="col-xs-12 col-md-4">
                                            <select id="empend-month" name="empend-month" class="form-control">
                                                <option value="0">Month</option>
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
                                                <option value="0">Year</option>
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