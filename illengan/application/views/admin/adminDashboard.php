<div class="content">
    <div class="container-fluid">
        <p style="text-align:right; font-weight: regular; font-size: 16px">
            <!-- Real Time Date & Time -->
            <?php echo date("M j, Y -l"); ?>
        </p>
        <br>
        <div class="row">

            <div class="main-panel">
                <div class="content" style="margin-top:5px;">
                    <div class="container-fluid">
                        <div class="row">
                            <!--Card 1-->
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="card card-stats">
                                    <div class="card-header" data-background="orange">
                                        <i class="glyphicon glyphicon-leaf"></i>
                                    </div>
                                    <div class="card-content">
                                        <p class="category">Today's Total Sales</p>
                                        <h3 class="title">
                                            <?php //echo number_format($data1['todaytotalsales']);?>
                                        </h3>
                                    </div>
                                    <a href="adminSales.html">
                                        <div class="card-footer">
                                            <div class="stats">
                                                <i class="glyphicon glyphicon-circle-arrow-right">Details</i>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <!--Card 2-->
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="card card-stats">
                                    <div class="card-header" data-background="orange">
                                        <i class="glyphicon glyphicon-leaf"></i>
                                    </div>
                                    <div class="card-content">
                                        <p class="category">Today's Total Revenue</p>
                                        <h3 class="title">
                                            <?php //echo number_format($data1['todaytotalsales']);?>
                                        </h3>
                                    </div>
                                    <a href="views/adminTotalRevenue.html">
                                        <div class="card-footer">
                                            <div class="stats">
                                                <i class="glyphicon glyphicon-circle-arrow-right">Details</i>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <!--Card 3-->
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="card card-stats">
                                    <div class="card-header" data-background="orange">
                                        <i class="glyphicon glyphicon-leaf"></i>
                                    </div>
                                    <div class="card-content">
                                        <p class="category">Total Items</p>
                                        <h3 class="title">
                                            <?php //echo number_format($data1['todaytotalsales']);?>
                                        </h3>
                                    </div>
                                    <a href="views/adminTotalItems.html">
                                        <div class="card-footer">
                                            <div class="stats">
                                                <i class="glyphicon glyphicon-circle-arrow-right">Details</i>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <!--Card 4-->
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="card card-stats">
                                    <div class="card-header" data-background="orange">
                                        <i class="glyphicon glyphicon-leaf"></i>
                                    </div>
                                    <div class="card-content">
                                        <p class="category">Needs Restock</p>
                                        <h3 class="title">
                                            <?php //echo number_format($data1['todaytotalsales']);?>
                                        </h3>
                                    </div>
                                    <a href="views/adminNeedRestocks.html">
                                        <div class="card-footer">
                                            <div class="stats">
                                                <i class="glyphicon glyphicon-circle-arrow-right">Details</i>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <!--End Card 1 to 4 Dashboard-->
                            <div class="col-md-4">
                                <div class="card">

                                    <div class="header">
                                        <h4 class="title">Yearly Sales</h4>
                                        <p class="category">January to December 2018</p>
                                    </div>
                                    <div class="content">
                                        <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>

                                        <div class="footer">
                                            <div class="legend">
                                                <i class="fa fa-circle text-info"></i> High
                                                <i class="fa fa-circle text-danger"></i> Low
                                            </div>
                                            <hr>
                                            <div class="stats">
                                                <i class="fa fa-history"></i> Updated 10 minutes ago
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Top Menu Categories By Sales</h4>
                                        <p class="category">January - December 2018</p>
                                    </div>
                                    <div class="content">
                                        <div id="chartHours" class="ct-chart"></div>
                                        <div class="footer">
                                            <div class="legend">
                                                <i class="fa fa-circle text-info"></i> High
                                                <i class="fa fa-circle text-danger"></i> Low
                                            </div>
                                            <hr>
                                            <div class="stats">
                                                <i class="fa fa-history"></i> Updated 10 minutes ago
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-6">
                                <div class="card ">
                                    <div class="header">
                                        <h4 class="title">Top Menu Items By Sales</h4>
                                        <p class="category">January - December 2018</p>
                                    </div>
                                    <div class="content">
                                        <div id="chartActivity" class="ct-chart"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card ">
                                    <div class="header">
                                        <h4 class="title">Others</h4>
                                        <p class="category"></p>
                                    </div>
                                    <div class="content">
                                        <div class="table-full-width">
                                            <table class="table">
                                            </table>
                                        </div>

                                        <div class="footer">
                                            <hr>
                                            <div class="stats">
                                                <i class="fa fa-history"></i> Updated 25 minutes ago
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>