<div class="site-wrapper">
    <div class="site-wrapper-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <form action="<?php echo "/signup/register_submit"?>" method="post" accept-charset="utf-8" role="form" id="example-form" class="form-horizontal">                        
                        <div>
                            <h3>About You</h3>
                            <section>
                                <p>(*) Mandatory</p>
                                <label>
                                    <input type="checkbox" id="jobalertagreement" name="jobalertagreement"> I wish to receive Job alerts from GrabTalent.
                                </label><br /><br />
                                <label for="firstName">First Name: *</label>
                                <input type="text" id="firstName" name="firstName" class="required form-control"><br />
                                <label for="lastName">Last Name: *</label>
                                <input type="text" id="lastName" name="lastName" class="required form-control"><br />
                                <label for="phoneNumber">Phone Number: *</label>
                                <input type="text" id="phoneNumber" name="phoneNumber" class="required form-control"><br />
                                <label for="email">Email:</label>
                                <input type="text" value="<?php echo $this->session->userdata('emailaddress'); ?>" class="form-control" disabled><br />
                                <label for="briefDescription">Brief Description: *</label>
                                <textarea id="briefDescription" rows="4" class="required form-control"></textarea>
                            </section>
                            <h3>Work Experience</h3>
                            <section>
                                <p>(*) Mandatory</p>
                                <label for="jobCategory">Job Category: *</label>
                                <select id="jobCategory" name="jobCategory" class="required form-control">
                                    <option>--None--</option>
                                    <option>Executive</option>
                                    <option>Finance & Accounting</option>
                                    <option>Financial Services</option>
                                    <option>HR & GA</option>
                                    <option>Internal IT</option>
                                </select><br />
                                <label for="jobFunction">Job Function: *</label>
                                <select id="jobFunction" name="jobFunction" class="required form-control">
                                    <option>--None--</option>
                                    <option>CEO/Country Manager/MD</option>
                                    <option>GM</option>
                                    <option>CFO</option>
                                    <option>CTO</option>
                                    <option>CIO (IT)</option>
                                </select><br />
                                <label for="jobIndustry">Job Industry *</label>
                                <select id="jobIndustry" name="jobIndustry" class="required form-control">
                                    <option>--None--</option>
                                    <option>Financial Services</option>
                                    <option>Consumer/Retail</option>
                                    <option>Healthcare</option>
                                    <option>Services</option>
                                    <option>Technology/Online</option>
                                </select><br />
                                <label for="jobSubIndustry">Job Sub Industry *</label>
                                <select id="jobSubIndustry" name="jobSubIndustry" class="required form-control">
                                    <option>--None--</option>
                                    <option>Financial Services</option>
                                    <option>Consumer/Retail</option>
                                    <option>Healthcare</option>
                                    <option>Services</option>
                                    <option>Technology/Online</option>
                                </select><br />
                                <label for="currentAnnualSal">Current Annual Salary *</label>
                                <input type="text" id="currentAnnualSal" name="currentAnnualSal" class="form-control required"><br />
                                <label for="resStatusinSG">Residential Status in Singapore *</label>
                                <input type="text" id="resStatusinSG" name="resStatusinSG" class="form-control required">
                            </section>
                            <!--<h3>Education</h3>
                            <section>
                                <ul>
                                    <li>Foo</li>
                                    <li>Bar</li>
                                    <li>Foobar</li>
                                </ul>
                            </section>
                            <h3>More About You</h3>
                            <section>
                                <input id="acceptTerms" name="acceptTerms" type="checkbox" class="required"> <label for="acceptTerms">I agree with the Terms and Conditions.</label>
                            </section>-->
                        </div>
                    </form>
                    <!-- End of Form -->    
                </div>
                <!-- End of Row -->
            </div>  
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    var form = $("#example-form");
    form.validate({
        errorPlacement: function errorPlacement(error, element) { element.before(error); },
        rules: {
            confirm: {
                equalTo: "#password"
            }
        }
    });
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
            //alert("Submitted!");
            form.submit();
        }
    });
});
</script>