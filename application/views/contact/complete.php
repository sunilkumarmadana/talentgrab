<script>

// Start js process
$(function() {
    g_activeController = ApplicationController();
    g_activeController.execute({});
});

</script>

<!--Content-->
<section class="content-empty">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="complete-heading">Thank you, your message has been sent.</h2>
                <p>Our personnel-in-charge will contact you soon. In the meantime, you may want search our jobs portal or view:</p>
                <ul>
                    <li><a href="<?php echo http_url('/search')?>">RGF Jobs</a></li>
                </ul>
            </div>
        </div>
    </div>
<!--Search bar-->
    <div class="search-bar search-secondary">
        <div class="container">
            <div class="row">
                <form action="<?php echo http_url('/search')?>" method="get">
                    <div class="col-xs-12">
                        <div class="search-fields clearfix">
                            <div class="float-left">
                                <span class="glyphicon glyphicon-search"></span>
                                <label class="sr-only">Search Jobs</label>
                                <input type="search" id="searchInput" class="form-control" name="words" placeholder="Enter job title, keyword etc...">
                            </div>
                            <div class="float-left search-last">
                                <button type="submit" class="btn">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
