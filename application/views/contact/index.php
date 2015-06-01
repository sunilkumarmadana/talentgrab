<div class="visible-xs visible-sm vert-offset-top-1"></div>
<div class="visible-lg visible-md vert-offset-top-5"></div>
<div class="contactus-wrapper">
    <div class="container">
        <div class="row">            
            <div class="col-md-6 text-left">
                <h1 class="cover-heading"><?=lang('contact.heading1');?></h1>
                <p><?=lang('contact.label7');?>&nbsp;+65 62244390</p>
                <p><a href="mailto:sales@grab-talent.com">sales@grab-talent.com</a></p>
                <div id="googleMap" style="width:100%;height:300px;"></div>
            </div>
            
            <div class="col-md-6 vert-offset-top-2">
                <div class="alert alert-success" role="alert" style="display: none;"></div>
                <div class="alert alert-danger" role="alert" style="display: none;"></div>
                <form action="/contact" method="post" accept-charset="utf-8" class="form-horizontal contact" role="form">
                    <div class="form-group">
                        <p class="col-xs-12"><?=lang('contact.headercontent');?></p>
                        <label class="col-xs-4"><?=lang('contact.label1');?>*</label>
                        <div class="col-xs-8">
                            <input name="firstname" type="text" class="form-control<?php if (form_error('firstname')) echo " error" ?>" id="inputFirstName" placeholder="<?=lang('contact.label1_1');?>" value="<?php echo set_value('firstname'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-4"><?=lang('contact.label2');?>*</label>
                        <div class="col-xs-8">
                            <input name="lastname" type="text" class="form-control<?php if (form_error('lastname')) echo " error" ?>" id="inputLastName" placeholder="<?=lang('contact.label2_1');?>" value="<?php echo set_value('lastname'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-4"><?=lang('contact.label3');?>*</label>
                        <div class="col-xs-8">
                            <input name="email" type="email" class="form-control<?php if (form_error('email')) echo " error" ?>" id="inputEmail" placeholder="<?=lang('contact.label3_1');?>" value="<?php echo set_value('email'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-4"><?=lang('contact.label4');?></label>
                        <div class="col-xs-8">
                            <input name="phonenumber" type="tel" class="form-control<?php if (form_error('phonenumber')) echo " error" ?>" id="inputTel" placeholder="<?=lang('contact.label4_1');?>" value="<?php echo set_value('phonenumber'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-4"><?=lang('contact.label5');?>*</label>
                        <div class="col-xs-8">
                            <input name="reason" type="text" class="form-control<?php if (form_error('reason')) echo " error" ?>" id="inputReason" placeholder="<?=lang('contact.label5_1');?>" value="<?php echo set_value('reason'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-4"><?=lang('contact.label6');?>*</label>
                        <div class="col-xs-8">
                            <textarea name="message" class="form-control<?php if (form_error('message')) echo " error" ?>" id="inputMessage" placeholder="<?=lang('contact.label6_1');?>"><?php echo set_value('message'); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-primary pull-right" id="button-contact-send">Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function(){
    // process the form
    $('form').submit(function(event) {
        var tmp_url = <?php echo "'".base_url()."'"; ?>;
        var post_url = tmp_url.split('/en')[0]+ <?php echo "'".$this->lang->lang()."'"; ?> + '/contact';
        $('#button-contact-send').html("<img src='/images/loading.gif' width='25px' height='25px'/>&nbsp;Please wait..").attr("disabled","disabled");
        
        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : post_url+'/contact_form', // the url where we want to POST
            data        : $( this ).serialize(),
            crossDomain : true 
        })
        .done(function(data) {  
            var response = data.split(';')[0];
            if(response == "success") {
                $('.alert-success').css("display","block").html(data.split(';')[1]);
                $('#button-contact-send').html("Send").removeAttr("disabled");
                $("form").trigger('reset');
			} else if(response == "error") {
                $('.alert-danger').css("display","block").html(data.split(';')[1]);
                $('#button-contact-send').html("Send").removeAttr("disabled");
            }
            $('.alert').delay(3000).fadeOut('slow').on('hide', function(){});
        })
        .fail(function(data) {
            alert("Something went wrong, Please try again!.");
        });
        
        event.preventDefault();
    });
});
function initialize() {
  var mapProp = {
    center:new google.maps.LatLng(1.3777931,103.8970106),
    zoom:10,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  var map=new google.maps.Map(document.getElementById("googleMap"), mapProp);
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>