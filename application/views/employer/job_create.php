<script type="text/javascript">
$(function(){
    $('.alert').delay(3000).fadeOut('slow');
});
</script>
<div class="site-wrapper">
    <div class="site-wrapper-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-md-offset-0">
                    <div class="error_msg">
                        <?php 
                            echo validation_errors();
                            $success_message = $this->session->flashdata('success_message');
                            if (isset($success_message) && $success_message != "") {
                                echo "<div class='alert alert-success' role='alert'>";
                                    echo $success_message;
                                echo "</div>";
                            }
                            
                            $error_message = $this->session->flashdata('error_message');
                            if (isset($error_message) && $error_message != "") {
                                echo "<div class='alert alert-danger' role='alert'>";
                                    echo $error_message;
                                echo "</div>";
                            }
                        ?>
                    </div>
                    <h3><b>Job Creation</b></h3><br />
                    <?php $login = $this->session->userdata('logged_in'); ?>
                    <form action="<?php echo "/employer/job_register"?>" method="post" accept-charset="utf-8" role="form" id="joborderform" class="form-horizontal">
                        <input type="hidden" id="inputEmail" name="inputEmail" value="<?php echo $login['username']; ?>" />
                        <div class="form-group">
                            <label for="inputJobTitle" class="col-sm-2 control-label">Job Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputJobTitle" name="inputJobTitle" placeholder="Job Title" required autofocus>
                            </div>
                        </div><br />
                        <div class="form-group">
                            <label for="inputJobMinSalary" class="col-sm-2 control-label">Min. Monthly Salary</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputJobMinSalary" name="inputJobMinSalary" placeholder="Min. Monthly Salary" required>
                            </div>
                        </div><br />
                        <div class="form-group">
                            <label for="inputJobMaxSalary" class="col-sm-2 control-label">Max. Monthly Salary</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputJobMaxSalary" name="inputJobMaxSalary" placeholder="Max. Monthly Salary" required>
                            </div>
                        </div><br />
                        <div class="form-group">
                            <label for="inputJobPriworklocctry" class="col-sm-2 control-label">Primary Work Location Country</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputJobPriworklocctry" name="inputJobPriworklocctry" placeholder="Primary Work Location Country" required>
                            </div>
                        </div><br />
                        <div class="form-group">
                            <label for="inputJobPriworkloccity" class="col-sm-2 control-label">Primary Work Location City</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputJobPriworkloccity" name="inputJobPriworkloccity" placeholder="Primary Work Location City" required>
                            </div>
                        </div><br />                        
                        <div class="form-group">
                            <label for="inputJobCurrency" class="col-sm-2 control-label">Currency</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputJobCurrency" name="inputJobCurrency" placeholder="Currency" required>
                            </div>
                        </div><br />
                        <div class="form-group">
                            <label for="inputJobCategory" class="col-sm-2 control-label">Job Category</label>
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
                            <label for="inputJobFunction" class="col-sm-2 control-label">Job Function</label>
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
                            <label for="inputJobIndustry" class="col-sm-2 control-label">Job Industry</label>
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
                            <label for="inputJobSubIndustry" class="col-sm-2 control-label">Job Sub Industry</label>
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
                            <label for="inputJobDescription" class="col-sm-2 control-label">Job Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="16" id="inputJobDescription" name="inputJobDescription" placeholder="Job Description" required></textarea>
                            </div>
                        </div><br />
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="postjob" name="postjob"> Post Job to Job Seeker.
                                    </label>
                                </div>
                            </div>
                        </div><br />
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-lg btn-primary btn-block" type="submit">Register and continue</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- End of Row -->
            </div>  
        </div>
    </div>
</div>