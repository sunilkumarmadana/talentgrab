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
                    <a class="navbar-brand" href="#">GrabTalent</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Jobs</a></li>
                        <li><a href="#">Settings</a></li>
                        <li><a href="#">Profile</a></li>
                        <li><a href="/candidate">Logout</a></li>
                        <!-- <li><a class="btn btn-warning" href="">Logout</a></li> -->
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
<div class="site-wrapper">
    <?php
        $sess_data = $this->session->userdata('user_data');
    ?>
    <div class="site-wrapper-inner">
        <div class="container">
            <!-- First Row - Start -->
            <div class="row">
                <div class="col-md-6">
                    <?php foreach($sess_data as $usrdt){ ?>
                    <table class="table borderless">
                        <tbody>
                            <tr>
                                <td><b>Name:</b></td>
                                <td><?php echo $usrdt['firstname']." ".$usrdt['lastname'];?></td>
                            </tr>
                            <tr>
                                <td><b>Phone Number:</b></td>
                                <td><?php echo $usrdt['phonenumber'];?></td>
                            </tr>
                            <tr>
                                <td><b>Email:</b></td>
                                <td><?php echo $usrdt['email'];?></td>
                            </tr>
                            <tr>
                                <td><b>Residential Status:</b></td>
                                <td><?php echo $usrdt['residential_status_in_singapore'];?></td>
                            </tr>
                        </tbody>
                    </table>
                    <?php } ?>
                </div>
                <div class="col-md-6">
                    <!-- Carousel======== -->
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <!-- <img class="first-slide" src="" alt="First slide"> -->
                                <div class="container">
                                    <div class="carousel-caption">
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="container">
                                    <div class="carousel-caption">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Carousel======== -->
                </div>
            </div>
            <!-- First Row - End -->
            <!-- Second Row - Start -->
            <div class="row">
                <div class="col-md-6">
                    <h4>Skills:</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="info">
                                <th>Skill Name</th>
                                <th>Skill Level</th>
                                <th>Rating (Out of 5)</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php 
                                $skills = $usrdt['job_function'];
                                $sklary = explode(",", $skills);
                                foreach($sklary as $key => $val) {
                                    echo "<tr>";
                                    echo "<td>".$sklary[$key]."</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                } 
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <h4>Candidate References:</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="info">
                                <th>Name</th>
                                <th>Company</th>
                                <th>Email.</th>
                                <th>Phone (If any)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- First Row - End -->
            <!-- Third Row - Start -->
            <div class="row">
                <div class="col-md-12">
                    <h4>Work Experience:</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="info">
                                <th>Employer Name</th>
                                <th>Designation</th>
                                <th>Country</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>Otto</td>
                                <td>Otto</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>Thornton</td>
                                <td>Thornton</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>the Bird</td>
                                <td>the Bird</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Third Row - End -->
            <!-- Fourth Row - Start -->
            <div class="row">
                <div class="col-md-12">
                    <h4>My Past Applications:</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="info">
                                <th>Job Title</th>
                                <th>Job Applied Date</th>
                                <th>Job Posted Date</th>
                                <th>Client</th>
                                <th>Stage reached</th>
                                <th>End Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>Otto</td>
                                <td>Otto</td>
                                <td>Otto</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>Thornton</td>
                                <td>Thornton</td>
                                <td>Thornton</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>the Bird</td>
                                <td>the Bird</td>
                                <td>the Bird</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Fourth Row - End -->
        </div>
    </div>
</div>