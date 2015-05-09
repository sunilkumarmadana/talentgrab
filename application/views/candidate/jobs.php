<script>
$(document).ready(function(){
    $( "button[id^='jobApplybtn']" ).on("click", function() {
		var tmpVal = $( this ).attr("id");
        var btnname = tmpVal.split("-");
        var joname = $("input[name^='inputJobnumber-"+btnname[1]+"']").val();
        $(this).html('Please Wait!');
                        
		$.ajax({
			'type': 'POST',
			'url' : 'registercandidate_application',
			'crossDomain' : true,
			'data': {'jobId' : joname},
			'success': function(response) {			 
							if(response == "accepted") {
								$( "button[id^='jobApplybtn-"+btnname[1]+"']" ).attr('disabled','disabled').html('Applied');
                                $( "button[id^='jobApplybtn-"+btnname[1]+"']" ).removeClass('btn-primary').addClass('btn-success');
							}
						},
			'failure': function(response) { alert("Something went wrong.");}
		})
	}); 
});
</script>

<div class="site-wrapper">
    <div class="site-wrapper-inner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 main">
                    <h2 class="sub-header">All Posted jobs</h2>
                    <?php 
                        //print_r($this->session->all_userdata());
                        $jobs = $this->login_database->candidate_job_dashboard();
                        $sess_array = $this->session->userdata('user_data');
                        $resume = '';                        
                        foreach($sess_array as $usrDt){
                            $resume = $usrDt['resume_url'];
                        }
                    ?>
                    <!-- To show only on mobile - start -->
                    <div class="visible-xs-block">
                        <?php $i=1; if($jobs){ ?>
                            <div class="list-group">
                                <?php foreach($jobs as $job) { ?>                                
                                    <a href="<?php echo '/candidate/job/'.$job['job_number']?>" class="list-group-item">
                                        <h4 class="list-group-item-heading"><?php echo htmlspecialchars($job['job_title'])?></h4>
                                        <p class="list-group-item-text"><?php echo htmlspecialchars($job['primary_work_location_city'].', '.$job['primary_work_location_country'])?></td></p>
                                        <p class="list-group-item-text"><?php echo "SGD ".$job['min_month_salary']." - ".$job['max_month_salary']; ?></p>
                                        <p class="list-group-item-text"><?php echo $job['job_industry'] ?></p><br />
                                        <?php
                                            if($resume != null || $resume != "" || !empty($resume)) {
                                                $query = $this->db->query("SELECT * FROM grabtalent_application WHERE candidate_email='".$this->session->userdata('logged_in')."' AND job_id='".$job['job_number']."'");
                                                if ($query->num_rows() == 0) {
                                                    echo "<button type='button' id='jobApplybtn-".$i."' class='btn btn-primary'>Apply</button>";
                                                } else {
                                                    echo "<button type='button' class='btn btn-success' disabled='disabled' style='vertical-align:top;'>Applied</button>";
                                                }
                                            } else {
                                                echo "<center><font color='red'><b>Upload Resume to apply.</b></font></center>";
                                            }                                            
                                        ?>
                                    </a>
                                <?php } $i++; ?>
                            </div>
                        <?php } else{ ?>
                            <div class="panel panel-default">
                                <div class="panel-body">There are no jobs created by you.</div>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- To show only on mobile - end -->
                    
                    <!-- To show only on Tablet - start -->
                    <div class="visible-sm-block">
                        <div class="panel panel-default">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Job Number</th>
                                        <th>Job Name</th>
                                        <th>Salary</th>
                                        <th>Job Location</th>
                                        <th>One-Click Apply</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; if($jobs){ ?>
                                        <?php foreach($jobs as $job) { ?>
                                            <tr>
                                                <td><?php echo $job['job_number']; ?></td>
                                                <input type="hidden" value="<?php echo $job['job_number']; ?>" name="inputJobnumber-<?php echo $i; ?>" id="inputJobnumber-<?php echo $i; ?>"/>
                                                <td class="job-title"><a href="<?php echo '/candidate/job/'.$job['job_number']; ?>"><?php echo htmlspecialchars($job['job_title']); ?></a></td>
                                                <td class="job-salary"><?php echo "SGD ".$job['min_month_salary']." - ".$job['max_month_salary']; ?></td>
                                                <td><?php echo htmlspecialchars($job['primary_work_location_city'].', '.$job['primary_work_location_country']); ?></td>
                                                <td><?php echo $job['job_industry']; ?></td>
                                                <td>
                                                <?php
                                                    if($resume != null || $resume != "" || !empty($resume)) {
                                                        $query = $this->db->query("SELECT * FROM grabtalent_application WHERE candidate_email='".$this->session->userdata('logged_in')."' AND job_id='".$job['job_number']."'");
                                                        if ($query->num_rows() == 0) {
                                                            echo "<button type='button' id='jobApplybtn-".$i."' class='btn btn-primary'>Apply</button>";
                                                        } else {
                                                            echo "<button type='button' class='btn btn-success' disabled='disabled'>Applied</button>";
                                                        }
                                                    } else {
                                                        echo "<font color='red'><b>Upload Resume to apply.</b></font>";
                                                    }
                                                ?>
                                                </td>
                                            </tr>
                                        <?php $i++; } ?>
                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="5"><center>There are no jobs created by you.</center></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- To show only on Tablet - end -->
                    
                    <!-- For larger Desktops -- start -->
                    <div class="table-responsive visible-md-block visible-lg-block">
                        <div class="panel panel-default">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Job Number</th>
                                        <th>Job Name</th>
                                        <th>Salary</th>
                                        <th>Job Location</th>
                                        <th>Job Industry</th>
                                        <th>One-Click Apply</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; if($jobs){ ?>
                                        <?php foreach($jobs as $job) { ?>
                                            <tr>
                                                <td><?php echo $job['job_number']; ?></td>
                                                <input type="hidden" value="<?php echo $job['job_number']; ?>" name="inputJobnumber-<?php echo $i; ?>" id="inputJobnumber-<?php echo $i; ?>"/>
                                                <td class="job-title"><a href="<?php echo '/candidate/job/'.$job['job_number']; ?>"><?php echo htmlspecialchars($job['job_title']); ?></a></td>
                                                <td class="job-salary"><?php echo "SGD ".$job['min_month_salary']." - ".$job['max_month_salary']; ?></td>
                                                <td><?php echo htmlspecialchars($job['primary_work_location_city'].', '.$job['primary_work_location_country']); ?></td>
                                                <td><?php echo $job['job_industry']; ?></td>
                                                <td>
                                                <?php
                                                    if($resume != null || $resume != "" || !empty($resume)) {                                                
                                                        $query = $this->db->query("SELECT * FROM grabtalent_application WHERE candidate_email='".$this->session->userdata('logged_in')."' AND job_id='".$job['job_number']."'");
                                                        if ($query->num_rows() == 0) {
                                                            echo "<button type='button' id='jobApplybtn-".$i."' class='btn btn-primary'>Apply</button>";
                                                        } else {
                                                            echo "<button type='button' class='btn btn-success' disabled='disabled'>Applied</button>";
                                                        }
                                                    } else {
                                                        echo "<font color='red'><b>Upload Resume to apply.</b></font>";
                                                    }                                                    
                                                ?>
                                                </td>
                                            </tr>
                                        <?php $i++; } ?>
                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="6"><center>There are no jobs created by you.</center></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- For larger Desktops -- end ->
                </div>
            </div>            
        </div> <!-- /container -->
    </div>
</div>