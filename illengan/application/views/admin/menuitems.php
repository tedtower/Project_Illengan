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

                    <div class="table-responsive" style="width:100%;">
            <table class="dataTable  dtr-inline collapsed table stripe table display" id="mydata">
                <thead>
                    <tr>
                        <th style="width:3%"></th>
                        <th>Menu Item</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="show_data">
                    
                </tbody>

            </table>
        </div>
   
    </div>
    </div>
    </div>
    
   

                    </div>
                </div>
            </div>

<?php include_once('templates/scripts.php') ?>