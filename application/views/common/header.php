<!-- Navigation Top bar -->
<div class="navbar-wrapper">
    <div class="container">
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">Grab Talent</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <?php
                            if( ($this->uri->segment(1) != 'contact') && ($this->uri->segment(1) != 'aboutus') ) {
                                echo '<li class="active"><a href="/">Home</a></li>';
                            } else {
                                echo '<li><a href="/">Home</a></li>';
                            }
                                                        
                            if( $this->uri->segment(1) == 'aboutus'){
                                echo '<li class="active"><a href="/aboutus">About</a></li>';
                            } else {
                                echo '<li><a href="/aboutus">About</a></li>';
                            }
                                                        
                            if( $this->uri->segment(1) == 'contact'){
                                echo '<li class="active"><a href="/contact">Contact</a></li>';
                            } else {
                                echo '<li><a href="/contact">Contact</a></li>';
                            }
                        ?>                        
                    </ul>
                    <div class="navbar-form navbar-right">
                        <a href="/recruiter" class="btn btn-warning">Recruiter</a>
                        <a href="/candidate" class="btn btn-primary">Job Seeker</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>