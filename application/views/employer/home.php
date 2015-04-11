<div class="site-wrapper">
    <div class="site-wrapper-inner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 main">
                    <h2 class="sub-header">Welcome</h2>
                    <?php 
                        $jobs = $this->session->userdata('jobs');
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
                                <?php if($jobs): ?>
                                    <?php foreach($jobs as $job): ?>
                                    <tr>
                                        <td><?php echo $job['job_number']?></td>
                                        <td class="job-title"><a href="<?php echo '/job/'.urlencode($job['job_title']).'/'.$job['job_number']?>"><?php echo htmlspecialchars($job['job_title'])?></a></td>
                                        <td><?php echo htmlspecialchars($job['primary_work_location_city'].', '.$job['primary_work_location_country'])?></td>
                                        <td class="job-salary"><?php echo $job['job_industry'] ?></td>
                                        <td>2</td>
                                    </tr>
                                    <?php endforeach;?>
                                <?php else:?>
                                    <tr>
                                        <td colspan="5"><center>There are no jobs created by you.</center></td>
                                    </tr>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>            
        </div> <!-- /container -->
    </div>
</div>