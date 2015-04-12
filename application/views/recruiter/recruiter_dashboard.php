<div class="site-wrapper">
    <div class="site-wrapper-inner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 main">
                    <h2 class="sub-header">Welcome</h2>
                    <?php
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
                                    <th>No.of Candidate Applications</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($jobs){ ?>
                                    <?php foreach($jobs as $job) { ?>
                                    <tr>
                                        <td><?php echo $job['job_number']?></td>
                                        <td class="job-title"><a href="<?php echo '/recruiter/job/'.$job['job_number']?>"><?php echo htmlspecialchars($job['job_title'])?></a></td>          
                                        <td><?php echo htmlspecialchars($job['primary_work_location_city'].', '.$job['primary_work_location_country'])?></td>
                                        <td class="job-salary"><?php echo $job['job_industry'] ?></td>
                                        <?php
                                            $total_count = $this->db->select('count(*) as cnt')->where_in('job_id', $job['job_number'])->get('grabtalent_application')->result()[0]->cnt;
                                            echo "<td>".$total_count."</td>";
                                        ?>
                                    </tr>
                                    <?php } ?>
                                <?php } else{ ?>
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