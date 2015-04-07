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
    <div class="site-wrapper-inner">
        <div class="container">
            <!-- First Row - Start -->
            <div class="row">
                <div class="col-md-6">
                    <table class="table borderless">
                        <tbody>
                            <tr>
                                <td><b>Salutation:</b></td>
                                <td>Mr.</td>
                            </tr>
                            <tr>
                                <td><b>Name:</b></td>
                                <td><?php echo $firstname; ?></td>
                            </tr>
                            <tr>
                                <td><b>Contact Details:</b></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="td-spacer"><b>Phone:</b></td>
                                <td></td>
                            </tr>                                
                            <tr>
                                <td class="td-spacer"><b>Mobile:</b></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><b>Email:</b></td>
                                <td><?php echo $email; ?></td>
                            </tr>
                        </tbody>
                    </table>
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
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Otto</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Larry</td>
                                <td>the Bird</td>
                            </tr>
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