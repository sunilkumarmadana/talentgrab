<script src="/js/jquery-1.11.2.js"></script>
<script src="/js/bootstrap.min.js"></script>
<link href="/css/bootstrap.min.css" rel="stylesheet"/>
<?php
$user_data = $this->session->userdata('user_data');
$cand_email = $user_data[0]['candidate_email'];
$tmp_url = base_url();
$resume_url = str_replace('http://','https://',$tmp_url).$this->lang->lang()."/candidate/candidate_resumeupdate";
?>
<form action="<?php echo $resume_url; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" role="form" id="candidate_chgpassword-form">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <input type="hidden" name="candidate-profile-email" id="candidate-profile-email" value="<?php echo $cand_email;?>" />
                <div class="col-md-4">
                    <input type="file" name="fileToUpload" id="fileToUpload"/>
                </div><br />
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary" id="password-btn-save">Save</button>
                </div>
            </div>  
        </div>
    </div>
</form>