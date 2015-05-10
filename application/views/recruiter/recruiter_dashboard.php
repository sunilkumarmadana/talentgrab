<div class="site-wrapper">
    <div class="site-wrapper-inner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 main">
                    <?php
                        $sess_array = array('username' => $this->session->userdata('logged_in'));
                        $jobs = $this->login_database->job_dashboard($sess_array);
                        $userData = $this->session->userdata('user_data');
                        //print_r($this->session->all_userdata());
                    ?>
                    <!-- To show only on mobile - start -->
                    <div class="visible-xs-block">
                        <h2 class="sub-header">Welcome <?php echo $userData[0]['employer_contact_firstname']." ".$userData[0]['employer_contact_lastname']; ?></h2>
                        <?php if($jobs){ ?>
                            <div class="list-group">
                                <?php foreach($jobs as $job) { ?>
                                <a href="<?php echo '/recruiter/job/'.$job['job_number']?>" class="list-group-item">
                                    <h4 class="list-group-item-heading"><?php echo htmlspecialchars($job['job_title'])?></h4>
                                    <span class="badge">
                                        <?php
                                            $total_count = $this->db->select('count(*) as cnt')->where_in('candidate_appln_job_id', $job['job_number'])->get('candidate_application')->result()[0]->cnt;
                                            echo "<font size=3px>".$total_count."</font>";
                                        ?>
                                    </span>
                                    <p class="list-group-item-text"><?php echo htmlspecialchars($job['primary_work_location_city'].', '.$job['primary_work_location_country'])?></td></p>
                                    <p class="list-group-item-text"><?php echo "SGD ".$job['min_month_salary']." - ".$job['max_month_salary']; ?></p>
                                    <p class="list-group-item-text"><?php echo $job['job_industry'] ?></p>                                    
                                </a>
                                <?php } ?>
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
                        <h2 class="sub-header">Welcome <?php echo $userData[0]['employer_contact_firstname']." ".$userData[0]['employer_contact_lastname']; ?></h2>
                        <div class="panel panel-default">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Job Number</th>
                                        <th>Job Name</th>
                                        <th>Salary</th>
                                        <th>Job Location</th>
                                        <th>No.of Candidate Applications</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($jobs){ ?>
                                        <?php foreach($jobs as $job) { ?>
                                        <tr>
                                            <td><?php echo $job['job_number']?></td>
                                            <td class="job-title"><a href="<?php echo '/recruiter/job/'.$job['job_number']?>"><?php echo htmlspecialchars($job['job_title'])?></a></td>          
                                            <td><?php echo "SGD ".$job['min_month_salary']." - ".$job['max_month_salary']; ?></td>
                                            <td><?php echo htmlspecialchars($job['primary_work_location_city'].', '.$job['primary_work_location_country'])?></td>
                                            <?php
                                                $total_count = $this->db->select('count(*) as cnt')->where_in('candidate_appln_job_id', $job['job_number'])->get('candidate_application')->result()[0]->cnt;
                                                echo "<td>".$total_count."</td>";
                                            ?>
                                        </tr>
                                        <?php } ?>
                                    <?php } else{ ?>
                                        <tr>
                                            <td colspan="6"><center>There are no jobs created by you.</center></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- To show only on Tablet - end -->
                    
                    <!-- For larger Desktops -- start -->
                    <div class="table-responsive visible-md-block visible-lg-block">
                        <h2 class="sub-header">Welcome <?php echo $userData[0]['employer_contact_firstname']." ".$userData[0]['employer_contact_lastname']; ?></h2>
                        <div class="panel panel-default">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Job Number</th>
                                        <th>Job Name</th>
                                        <th>Salary</th>
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
                                            <td><?php echo "SGD ".$job['min_month_salary']." - ".$job['max_month_salary']; ?></td>
                                            <td><?php echo htmlspecialchars($job['primary_work_location_city'].', '.$job['primary_work_location_country'])?></td>
                                            <td><?php echo $job['job_industry'] ?></td>
                                            <?php
                                                $total_count = $this->db->select('count(*) as cnt')->where_in('candidate_appln_job_id', $job['job_number'])->get('candidate_application')->result()[0]->cnt;
                                                echo "<td>".$total_count."</td>";
                                            ?>
                                        </tr>
                                        <?php } ?>
                                    <?php } else{ ?>
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