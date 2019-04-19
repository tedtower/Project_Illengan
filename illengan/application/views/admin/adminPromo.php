<?php include_once('templates/sideNav.php') ?>
    <!--End Side Bar-->
    <div class="content">
        <div class="container-fluid">
            <br>
            <p style="text-align:right; font-weight: regular; font-size: 16px">
                <!-- Real Time Date & Time -->
                <?php echo date("M j, Y -l"); ?>
            </p>
            <div class="content" style="margin-left:250px;">
                <div class="container-fluid">
                    <div class="content">
                        <div class="container-fluid">
                            <!--Table-->
                            <div class="card-content">
                                <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#newPromo"
                                    data-original-title style="float: left">Add Promo Item</a>
                                <!--Search
                            <div id ="example_filter" class="dataTables_filter">
                                <label>
                                    "Search:"
                                    <div class="form-group form-group-sm is-empty">
                                       <input type="search" class="form-control" placeholder aria-controls="example">
                                       <span class="material-input"></span> 
                                    </div>
                                </label>
                            </div>-->
                                <br>
                                <br>
            <table id="menuTable" class="table dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th></th>
                        <th>Promo</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
            <!--Start of Modal "Add Menu"-->
            <div class="modal fade bd-example-modal-lg" id="newPromo" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Promo</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?php echo base_url()?>admin/promo/add" method="get"
                                                accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <div class="input-group mb-3"> <!--Menu Image-->
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" style="width:105px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">Promo Type</span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <select class="custom-select" name="promo_type" id="promo_type">
                                                            <option value="freebie" selected>Freebie</option>
                                                            <option value="discount">Discount</option>
                                                        </select>
                                                        </div>
                                                    </div> 
                                                    <!--Menu Name-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:105px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Promo Name</span>
                                                        </div>
                                                        <input type="text" name="promo_name" id="promo_name" class="form-control form-control-sm">
                                                    </div>  
                                                    <!--Description-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Start Date</span>
                                                        </div>
                                                        <input type="date" name="start_date" id="start_date" class="form-control form-control-sm">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;margin-left: 10px;">
                                                            End Date</span>
                                                        </div>
                                                        <input type="date" name="start_date" id="start_date" class="form-control form-control-sm">
                                                    </div>                                                                                                                                                       


                                                    <!--Menu Items-->
                                                    <a class="btn btn-primary btn-sm" style="color:blue">Add Freebies</a> <!--Button to add row in the table-->
                                                    <br><br>
                                                    <table class="table table-sm table-borderless"> <!--Table containing the different input fields in adding trans items -->
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Temperature</th>
                                                                <th>Price</th>
                                                                <th>Status</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><input type="text" name="menu_name" id="menu_name" class="form-control form-control-sm"></td>
                                                                <td>
                                                                    <select class="form-control" name="menu_availability" id="menu_availability">
                                                                        <option selected>Choose</option>
                                                                        <option></option>
                                                                    </select>
                                                                </td>
                                                                <td><input type="number" name="pref_price" id="pref_price" class="form-control form-control-sm"></td>
                                                                <td>
                                                                    <select class="form-control" name="menu_availability" id="menu_availability">
                                                                        <option selected>Choose</option>
                                                                        <option></option>
                                                                    </select>
                                                                </td>
                                                                <td><img class="exitBtn" id="exitBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px"></td>
                                                            </tr>
                                                    </table>
                                                    <!--Menu Items-->
                                                    <a class="btn btn-primary btn-sm" style="color:blue">Add Discounts</a> <!--Button to add row in the table-->
                                                    <br><br>
                                                    <table class="table table-sm table-borderless"> <!--Table containing the different input fields in adding trans items -->
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th style="width:50%">Name</th>
                                                                <th style="width:50%">Price</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <select class="form-control" name="menu_availability" id="menu_availability">
                                                                        <option selected>Choose</option>
                                                                        <option></option>
                                                                    </select>
                                                                </td>
                                                                <td><input type="number" name="item_qty" id="item_qty" class="form-control form-control-sm"></td>
                                                                <td><img class="exitBtn" id="exitBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px;right:0"></td>
                                                            </tr>
                                                    </table>
                         
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-success btn-sm"
                                                            type="submit">Insert</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
<!--End of Modal "Add Transaction"-->

        </div>
   
    </div>
    </div>
    </div>
    
   

                    </div>
                </div>
            </div>

<?php include_once('templates/scripts.php') ?>
<script>
    var promos = [];
    $(function(){
        $.ajax({
            url: '<?= base_url("admin/jsonPromos")?>',
            dataType: 'json',
            success: function(data){
                var pcLastIndex = 0;
                var menuLastIndex = 0;
                var fbLastIndex = 0;
                var discLastIndex = 0;
                $.each(data.promos, function(index, item){
                    promos.push({"promos" : item});
                    promos[index].freebies = data.freebies.filter(fb =>  fb.promo_id ==  item.promo_id);
                    promos[index].discounts = data.discounts.filter(disc =>  disc.promo_id==  item.promo_id);
                });
                showTable();
            },
            error: function(response,setting, errorThrown){
                console.log(errorThrown);
                console.log(response.responseText);
            }
        });

    });
    function showTable(){
        promos.forEach(function(item){
            var tableRow = `                
                <tr class="table_row" data-promoId="${item.promos.promo_id}">   <!-- table row ng table -->
                    <td><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></td>
                    <td>${item.promos.promo_name}</td>
                    <td>${item.promos.start_date}</td>
                    <td>${item.promos.end_date}</td>
                    <td>${item.promos.status}</td>
                    <td>
                        <button class="editBtn btn btn-sm btn-primary">Edit</button>
                        <button class="deleteBtn btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            `;
            var preferencesDiv = `
            <div class="preferences" style="float:left;margin-right:3%" > <!-- Preferences table container-->
            <span><b>Freebies</b></span><br>
                ${item.freebies.length === 0 ? "No freebies are set for this promo." : 
                `
                 <!-- label-->
                <table class="table table-bordered"> <!-- Freebies table-->
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Freebie Name</th>
                            <th scope="col">Menu Item</th>
                            <th scope="col">Quantity Req.</th>
                            <th scope="col">Freebie Item</th>
                            <th scope="col">Get Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                    ${item.freebies.map(fb => {
                        return `
                        <tr>
                        <td>${fb.freebie_name}</td>
                        <td>${fb.menu_item}</td>
                        <td>${fb.pc_qty}</td>
                        <td>${fb.menu_freebie}</td>
                        <td>${fb.fb_qty}</td>
                        </tr>
                        `;
                    }).join('')}
                    </tbody>
                </table>
                `}
            </div>
            `;
            var accordion = `
            <tr class="accordion" style="display:none">
                <td colspan="5"> <!-- table row ng accordion -->
                    <div style="overflow:auto;display:none"> <!-- container ng accordion -->
                        
                        <div style="width:68%;overflow:auto"> <!-- description, preferences, and addons container -->
                            <div><b>Description:</b> <!-- label-->
                                <p>${item.promos.promo_name}
                                </p>
                            </div>
                            
                            <div class="aoAndPreferences" style="overflow:auto;margin-top:1%"> <!-- Preferences and addons container-->
                                
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            `;
            var addonsDiv = `
            <br><br><div class=" addons" > <!-- Discounts table container--><br><span><b>Discounts</b></span><br>
                ${item.discounts.length === 0 ? "No discounts are set for this promo." : 
                    `<!-- label-->
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Menu Item</th>
                                <th scope="col">Quantity Req.</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Price</th>
                                <th scope="col">Discount Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                        ${item.discounts.map(disc => {
                            return `<tr>
                            <td>${disc.menu_item}</td>
                            <td>${disc.pc_qty}</td>
                            <td>${disc.dc_name}</td>
                            <td>&#8369; ${disc.pref_price}</td>
                            <td>&#8369; ${disc.dc_amt}</td>
                            </tr>`
                            }).join('')}
                        </tbody>
                    </table>`
                }
            </div>`;
            $("#menuTable > tbody").append(tableRow);
            $("#menuTable > tbody").append(accordion);
            $(".aoAndPreferences").last().append(preferencesDiv);
            $(".aoAndPreferences").last().append(addonsDiv);
        });
        $(".accordionBtn").on('click', function(){
            if($(this).closest("tr").next(".accordion").css("display") == 'none'){
                $(this).closest("tr").next(".accordion").css("display","table-row");
                $(this).closest("tr").next(".accordion").find("td > div").slideDown("slow");
            }else{
                $(this).closest("tr").next(".accordion").find("td > div").slideUp("slow");
                $(this).closest("tr").next(".accordion").hide("slow");
            }
        });
        $(".editBtn").on("click",function(){
            var menuID = $(this).closest("tr").attr("data-menuID");
            //set Modal contents;

        });

    }  
</script>