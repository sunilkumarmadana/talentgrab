<!-- Navigation Top bar -->
<div class="navbar-wrapper">
    <div class="container">
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand text-left" href="#">GrabTalent</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?php echo https_url('/recruiter_dashboard')?>">Home</a></li>
                        <li><a href="<?php echo https_url('/recruiter/job_create')?>">Create Job</a></li>
                        <li><a href="/recruiter">Logout</a></li>
                        <!-- <li><a class="btn btn-warning" href="">Logout</a></li> -->
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>