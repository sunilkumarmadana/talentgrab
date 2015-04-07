<div class="site-wrapper">
    <div class="site-wrapper-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-6"><br /><br />
                    <form action="/contact" method="post" accept-charset="utf-8" class="form-horizontal contact" role="form">
                        <?php if (validation_errors()) : ?>
                        <div class="error-message">
                            <p>Oops, you left some fields blank. Please fill in the fields highlighted red and proceed.</p>
                        </div>
                        <?php endif?>
                        <div class="form-group">
                            <p class="col-xs-12">You may leave us a message and we will get back to you as soon as possible.</p>
                            <label class="col-xs-4">First Name*</label>
                            <div class="col-xs-8">
                                <input name="firstname" type="text" class="form-control<?php if (form_error('firstname')) echo " error" ?>" id="inputFirstName" placeholder="Your first name" value="<?php echo set_value('firstname'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4">Last Name*</label>
                            <div class="col-xs-8">
                                <input name="lastname" type="text" class="form-control<?php if (form_error('lastname')) echo " error" ?>" id="inputLastName" placeholder="Your last name" value="<?php echo set_value('lastname'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4">Email*</label>
                            <div class="col-xs-8">
                                <input name="email" type="email" class="form-control<?php if (form_error('email')) echo " error" ?>" id="inputEmail" placeholder="Your email" value="<?php echo set_value('email'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4">Phone No</label>
                            <div class="col-xs-8">
                                <input name="phonenumber" type="tel" class="form-control<?php if (form_error('phonenumber')) echo " error" ?>" id="inputTel" placeholder="Your phone no." value="<?php echo set_value('phonenumber'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4">Reason for contact*</label>
                            <div class="col-xs-8">
                                <input name="reason" type="text" class="form-control<?php if (form_error('reason')) echo " error" ?>" id="inputReason" placeholder="Reason for contact" value="<?php echo set_value('reason'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4">Message*</label>
                            <div class="col-xs-8">
                                <textarea name="message" class="form-control<?php if (form_error('message')) echo " error" ?>" id="inputMessage" placeholder="Enter your message"><?php echo set_value('message'); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="col-xs-12">
                                <button type="submit" class="btn btn-primary pull-right">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <div class="col-md-6 text-right">
                    <h1 class="cover-heading">Contact Us</h1>
                    <p>Call Us at +65 62244390</p>
                    <p><a href="mailto:sales@grab-talent.com">sales@grab-talent.com</a></p>
                </div>                
            </div>
        </div>
    </div>
</div>