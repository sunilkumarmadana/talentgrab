<div class="site-wrapper vert-offset-top-5">
    <div class="site-wrapper-inner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 main">
                    <?php                        
                        // To add Employer & their created job information to session.
                        $sess_array = array('username' => $this->session->userdata('logged_in'));
                        $jobinfo = $this->login_database->job_dashboard($sess_array);
                        $empinfo = $this->login_database->read_user_information($sess_array,'employer');
                        $this->session->set_userdata('user_data', $empinfo);
                        $this->session->set_userdata('job_detail', $jobinfo);
                        $userData = $this->session->userdata('user_data');
                        $jobs = $this->session->userdata('job_detail');
                        //print_r($this->session->all_userdata());
                    ?>
                    <!-- To show only on mobile - start -->
                    <div class="visible-xs-block">
                        <h2 class="sub-header"><?php echo lang('recruiterlogin.Welcometxt'); ?></h2>
                        <?php if($jobs){ ?>
                            <div class="list-group">
                                <?php foreach($jobs as $job) { ?>
                                <a href="<?php echo '/'.$this->lang->lang().'/recruiter/job/'.$job['job_number']?>" class="list-group-item">
                                    <h4 class="list-group-item-heading"><?php echo htmlspecialchars($job['job_title'])?></h4>
                                    <span class="badge">
                                        <?php
                                            $total_count = $this->db->select('count(*) as cnt')->where_in('candidate_appln_job_id', $job['job_number'])->get('candidate_application')->result()[0]->cnt;
                                            echo "<font size=3px>".$total_count."</font>";
                                        ?>
                                    </span>
                                    <p class="list-group-item-text"><?php echo htmlspecialchars($job['job_primaryworklocation_city'].', '.$job['job_primaryworklocation_country'])?></td></p>
                                    <p class="list-group-item-text"><?php echo $job['job_minsalary_currency']." ".$job['job_minmonth_salary']." - ".$job['job_maxsalary_currency']." ".$job['job_maxmonth_salary']; ?></p>
                                    <p class="list-group-item-text"><?php echo $job['job_industry'] ?></p>                                    
                                </a>
                                <?php } ?>
                            </div>
                        <?php } else{ ?>
                            <div class="panel panel-default">
                                <div class="panel-body"><?=lang('recruiterlogin.homenojobslbl');?></div>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- To show only on mobile - end -->
                    
                    <!-- To show only on Tablet - start -->
                    <div class="visible-sm-block">
                        <h2 class="sub-header"><?php echo lang('recruiterlogin.Welcometxt'); ?></h2>
                        <div class="panel panel-default">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th><?=lang('recruiterlogin.hometablecol1');?></th>
                                        <th><?=lang('recruiterlogin.hometablecol2');?></th>
                                        <th><?=lang('recruiterlogin.hometablecol3');?></th>
                                        <th><?=lang('recruiterlogin.hometablecol4');?></th>
                                        <th><?=lang('recruiterlogin.hometablecol5');?></th>
                                        <th><?=lang('recruiterlogin.hometablecol6');?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($jobs){ ?>
                                        <?php foreach($jobs as $job) { ?>
                                        <tr>
                                            <td><?php echo $job['job_number']?></td>
                                            <td class="job-title"><a href="<?php echo '/'.$this->lang->lang().'/recruiter/job/'.$job['job_number']?>"><?php echo htmlspecialchars($job['job_title'])?></a></td>          
                                            <td><?php echo $job['job_minsalary_currency']." ".$job['job_minmonth_salary']." - ".$job['job_maxsalary_currency']." ".$job['job_maxmonth_salary']; ?></td>
                                            <td><?php echo htmlspecialchars($job['job_primaryworklocation_city'].', '.$job['job_primaryworklocation_country'])?></td>
                                            <?php
                                                $total_count = $this->db->select('count(*) as cnt')->where_in('candidate_appln_job_id', $job['job_number'])->get('candidate_application')->result()[0]->cnt;
                                                echo "<td>".$total_count."</td>";
                                            ?>
                                        </tr>
                                        <?php } ?>
                                    <?php } else{ ?>
                                        <tr>
                                            <td colspan="6"><center><?=lang('recruiterlogin.homenojobslbl');?></center></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- To show only on Tablet - end -->
                    
                    <!-- For larger Desktops -- start -->
                    <div class="table-responsive visible-md-block visible-lg-block">
                        <h2 class="sub-header"><?php echo lang('recruiterlogin.Welcometxt'); ?></h2>
                        <div class="panel panel-default">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th><?=lang('recruiterlogin.hometablecol1');?></th>
                                        <th><?=lang('recruiterlogin.hometablecol2');?></th>
                                        <th><?=lang('recruiterlogin.hometablecol3');?></th>
                                        <th><?=lang('recruiterlogin.hometablecol4');?></th>
                                        <th><?=lang('recruiterlogin.hometablecol5');?></th>
                                        <th><?=lang('recruiterlogin.hometablecol6');?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($jobs){ ?>
                                        <?php foreach($jobs as $job) { ?>
                                        <tr>
                                            <td><?php echo $job['job_number']?></td>
                                            <td class="job-title"><a href="<?php echo '/'.$this->lang->lang().'/recruiter/job/'.$job['job_number']?>"><?php echo htmlspecialchars($job['job_title'])?></a></td>          
                                            <td><?php echo $job['job_minsalary_currency']." ".$job['job_minmonth_salary']." - ".$job['job_maxsalary_currency']." ".$job['job_maxmonth_salary']; ?></td>
                                            <td><?php echo htmlspecialchars($job['job_primaryworklocation_city'].', '.$job['job_primaryworklocation_country'])?></td>
                                            <td><?php echo $job['job_industry'] ?></td>
                                            <?php
                                                $total_count = $this->db->select('count(*) as cnt')->where_in('candidate_appln_job_id', $job['job_number'])->get('candidate_application')->result()[0]->cnt;
                                                echo "<td>".$total_count."</td>";
                                            ?>
                                        </tr>
                                        <?php } ?>
                                    <?php } else{ ?>
                                        <tr>
                                            <td colspan="6"><center><?=lang('recruiterlogin.homenojobslbl');?></center></td>
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