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
                        $sess_array = array('username' => $this->session->userdata('logged_in'));
                        $jobs = $this->login_database->job_dashboard($sess_array);
                    ?>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Job Number</th>
                                    <th>Job Name</th>
                                    <th>Job Location</th>
                                    <th>Job Industry</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; if($jobs){ ?>
                                    <?php foreach($jobs as $job) { ?>
                                        <tr>
                                            <td><?php echo $job['job_number']; ?></td>
                                            <input type="hidden" value="<?php echo $job['job_number']; ?>" name="inputJobnumber-<?php echo $i; ?>" id="inputJobnumber-<?php echo $i; ?>"/>
                                            <td class="job-title"><a href="<?php echo '/candidate/job/'.$job['job_number']; ?>"><?php echo htmlspecialchars($job['job_title']); ?></a></td>
                                            <td><?php echo htmlspecialchars($job['primary_work_location_city'].', '.$job['primary_work_location_country']); ?></td>
                                            <td class="job-salary"><?php echo $job['job_industry']; ?></td>
                                            <td class="job-apply">
                                            <?php
                                                $query = $this->db->query("SELECT * FROM grabtalent_application WHERE email='".$this->session->userdata('logged_in')."' AND job_id='".$job['job_number']."'");
                                                if ($query->num_rows() == 0) {
                                                    echo "<button type='button' id='jobApplybtn-".$i."' class='btn btn-primary'>Apply</button>";
                                                } else {
                                                    echo "<button type='button' class='btn btn-success' disabled='disabled'>Applied</button>";
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
            </div>            
        </div> <!-- /container -->
    </div>
</div>