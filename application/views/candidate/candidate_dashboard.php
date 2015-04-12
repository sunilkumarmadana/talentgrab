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
                            <?php
                                $query = $this->db->select('*')->where_in('email', $usrdt['email'] )->get('grabtalent_application');
                                $i = 1;
                                foreach ($query->result_array() as $row) {
                                    echo "<tr>";
                                    echo "<td><a href='/candidate/job/".$row['job_id']."'>".$row['job_id']."</a></td>";
                                    echo "<td>".$row['created_date']."</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>Application</td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                    $i++;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Fourth Row - End -->
        </div>
    </div>
</div>