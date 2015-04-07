<div class="site-wrapper">
    <div class="site-wrapper-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <form action="<?php echo "/signup/register_submit"?>" method="post" accept-charset="utf-8" role="form" id="example-form" class="form-horizontal">                        
                        <div>
                            <h3>About You</h3>
                            <section>
                                <p>(*) Mandatory</p>
                                <label for="name">First Name: *</label>
                                <input type="text" id="firstname" name="firstname" class="required form-control"><br />
                                <label for="name">Last Name: *</label>
                                <input type="text" id="lastname" name="lastname" class="required form-control"><br />
                                <label for="residentialphone">Residential Phone: *</label>
                                <input type="text" id="residentialphone" name="residentialphone" class="required form-control"><br />
                                <label for="mobilephone">Mobile Phone: *</label>
                                <input type="text" id="mobilephone" name="mobilephone" class="required form-control"><br />
                                <label for="currentlocation">Current Location: *</label>
                                <input type="text" id="currentlocation" name="currentlocation" class="required form-control"><br />
                                <label for="briefdescription">Brief Description: *</label>
                                <textarea id="briefdescription" rows="4" class="required form-control"></textarea>
                            </section>
                            <h3>Work Experience</h3>
                            <section>
                                <label for="jobtitle">Job Title *</label>
                                <input type="text" id="jobtitle" name="jobtitle" class="form-control required"><br />
                                <label for="joblocation">Job Location *</label>
                                <input type="text" id="joblocation" name="joblocation" class="form-control required"><br />
                                <label for="industryskills">Industry Skills *</label>
                                <input type="text" id="industryskills" name="industryskills" class="form-control required"><br />
                                <label for="funcexpertise">Functional Expertise</label>
                                <input type="text" id="funcexpertise" name="funcexpertise" class="form-control required">
                                <p>(*) Mandatory</p>
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