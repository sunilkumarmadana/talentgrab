<div class="site-wrapper">
    <div class="site-wrapper-inner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 main">
                    <h2 class="sub-header">Welcome</h2>
                    <?php
    print_r($this->session->all_userdata());
?>
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Job Name</th>
                              <th>Client Name</th>
                              <th>Client Industry</th>
                              <th>No.of Candidate Applications</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1,001</td>
                              <td>Lorem</td>
                              <td>ipsum</td>
                              <td>dolor</td>
                              <td>sit</td>
                            </tr>
                            <tr>
                              <td>1,002</td>
                              <td>amet</td>
                              <td>consectetur</td>
                              <td>adipiscing</td>
                              <td>elit</td>
                            </tr>
                            <tr>
                              <td>1,003</td>
                              <td>Integer</td>
                              <td>nec</td>
                              <td>odio</td>
                              <td>Praesent</td>
                            </tr>
                            <tr>
                              <td>1,003</td>
                              <td>libero</td>
                              <td>Sed</td>
                              <td>cursus</td>
                              <td>ante</td>
                            </tr>
                            <tr>
                              <td>1,004</td>
                              <td>dapibus</td>
                              <td>diam</td>
                              <td>Sed</td>
                              <td>nisi</td>
                            </tr>
                            <tr>
                              <td>1,005</td>
                              <td>Nulla</td>
                              <td>quis</td>
                              <td>sem</td>
                              <td>at</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                </div>
            </div>            
        </div> <!-- /container -->
    </div>
</div>