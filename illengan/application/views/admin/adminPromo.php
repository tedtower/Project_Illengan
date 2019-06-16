<!--End Side Bar-->
<body style="background:white">
<div class="content">
    <div class="container-fluid">
        <br>
        <p style="text-align:right; font-weight: regular; font-size: 16px">
            <!-- Real Time Date & Time -->
            <?php echo date("M j, Y -l"); ?>
        </p>
        <div class="content" style="margin-left:250px;">
            <div class="container-fluid">
                <!--Table-->
                <div class="card-content">
                    <button id="addPromo" class="btn btn-primary btn-sm" onclick="addItemOptions();removeOptions()"
                        data-toggle="modal" data-target="#newPromo" data-original-title style="margin:0">Add Promo</button>
                    <br>
                    <br>
                    <table id="menuTable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>Promo Name</th>
                                <th>Promo Type</th>
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
                    <div class="modal fade bd-example-modal-lg" aria-labelledby="exampleModalLabel" aria-hidden="true" id="newPromo" 
                        tabindex="-1" role="dialog" style="overflow: auto !important;">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Promo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?php echo base_url()?>admin/promo/add" method="get"
                                    accept-charset="utf-8">
                                    <div class="modal-body">
                                        <!--Menu Name-->
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                    style="width:105px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                    Promo Name</span>
                                            </div>
                                            <input type="text" name="pmName" id="pmName"
                                                class="form-control form-control-sm">
                                        </div>
                                        <!--Description-->
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                    style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                    Start Date</span>
                                            </div>
                                            <input type="date" name="pmStartDate" id="pmStartDate"
                                                class="form-control form-control-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                    style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;margin-left: 10px;">
                                                    End Date</span>
                                            </div>
                                            <input type="date" name="pmEndDate" id="pmEndDate"
                                                class="form-control form-control-sm">
                                        </div>

 
                                        <!--Menu Items-->
                                        <a id="addFreebie1" class="btn btn-primary btn-sm" style="color:blue">Add
                                            Freebies</a>
                                        <!--Button to add row in the table-->
                                        <br><br>

                                        <div id="fbTable"></div>

                                        <!--Menu Items-->
                                        <a class="btn btn-warning btn-sm" style="color:orange">Add Discounts</a>
                                        <!--Button to add row in the table-->
                                        <br><br>
                                        <table class="table table-sm table-borderless">
                                            <!--Table containing the different input fields in adding trans items -->
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Discount Percentage</th>
                                                    <th>Add Items</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type="text" name="dcName" id="dcName"
                                                            class="form-control form-control-sm"></td>
                                                    <td><a class="btn btn-warning btn-sm" style="color:orange">Add
                                                            Discount Item</a></td>
                                                </tr>
                                        </table>

                                        <table class="table table-sm table-borderless">
                                            <!--Table containing the different input fields in adding trans items -->
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Menu Item</th>
                                                    <th>Quantity Constraint</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><select class="form-control promoOpt" name="dc_item"
                                                            id="dc_item">
                                                        </select></td>
                                                    <td><input type="number" name="pcQty" min="0" id="pcQty"
                                                            class="form-control form-control-sm"></td>
                                                </tr>
                                        </table>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-sm"
                                                data-dismiss="modal">Cancel</button>
                                            <button id="submitPromo" onclick="addPromos()"
                                                class="btn btn-success btn-sm" type="button">Insert</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--End of Modal "Add Transaction"-->
                    <!--START OF ADD SUB FREEBIES-->
                    <div class="modal fade bd-example-modal" style="background:rgba(0, 0, 0, 0.3)" id="addSubFreebie" 
                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Freebie Items</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!--Modal Content-->
                                <form id="formAdd" action="<?= site_url('admin/purchaseorder/add')?>" method="post"
                                    accept-charset="utf-8">
                                    <div class="modal-body">
                                    <a id="addSubFBtn" class="btn btn-primary btn-sm" style="color:blue">Add
                                            Items</a>
                                            <br>
                                    <table id="subAddFreebie" class="table table-lg table-borderless">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Menu Item</th>
                                                <th>Quantity Constraint</th>
                                                <th>Freebie Item</th>
                                                <th>Freebie Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbFb">
                                            <tr id="trFb">
                                                <td><select class="form-control promoOpt menuName" name="menu_name" 
                                                id="menu_name"></select></td>
                                                <td><input type="number" name="pcQty" id="pcQty" min="0" 
                                                class="form-control form-control-sm"></td>
                                                <td><select class="form-control promoOpt fbItem" name="fb_item" 
                                                id="fb_item"></select></td>
                                                <td><input type="number" name="fbQty" id="fbQty" min="0" 
                                                class="form-control form-control-sm"></td>
                                            </tr>
                                            </tbody>
                                            </table>
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-sm"
                                                data-dismiss="modal">Cancel</button>
                                            <button class="btn btn-success btn-sm" id="submitPOrder"
                                                onclick="addPurchaseOrder()" type="button">Add</button>
                                        </div>
                                    </div>
                                </form>
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

<?php include_once('templates/scripts.php') ?>
<script src="<?= admin_js().'addPromos.js'?>"></script>
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
                    promos[index].freebies = data.freebies.filter(fb =>  fb.pmID ==  item.pmID);
                    promos[index].discounts = data.discounts.filter(disc =>  disc.pmID==  item.pmID);
                    

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
                <tr class="table_row" data-promoId="${item.promos.pmID}">   <!-- table row ng table -->
                    <td><a href="javascript:void(0)" class="ml-2 mr-4"><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></a>${item.promos.pmName}</td>
                    <td>${item.promos.freebie != null ? "Freebie" : ""}
                    ${item.promos.discount != null ? "Discount" : ""}</td>
                    <td>${item.promos.pmStartDate}</td>
                    <td>${item.promos.pmEndDate}</td>
                    <td>${item.promos.status}</td>
                    <td>
                        <button class="editBtn btn btn-sm btn-secondary">Edit</button>
                        <button class="deleteBtn btn btn-sm btn-warning">Archived</button>
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
                        <td>${fb.fbName}</td>
                        <td>${fb.menu_item}</td>
                        <td>${fb.pcQty}</td>
                        <td>${fb.menu_freebie}</td>
                        <td>${fb.fbQty}</td>
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
                <td colspan="6"> <!-- table row ng accordion -->
                    <div style="overflow:auto;display:none"> <!-- container ng accordion -->
                        
                        <div style="width:68%;overflow:auto"> <!-- description, preferences, and addons container -->
                            
                            <div class="aoAndPreferences" style="overflow:auto;margin-top:1%"> <!-- Preferences and addons container-->
                                
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            `;
            var addonsDiv = `
            <br><br><br><div class=" addons" > <!-- Discounts table container--><br><span><b>Discounts</b></span><br>
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
                            <td>${disc.pcQty}</td>
                            <td>${disc.dcName}</td>
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

    $(document).ready(function() {
    
        $('#addSubFBtn').on('click', function() {
            var itm = document.getElementById("trFb");
            var wrapper = document.createElement('div');
            var el = wrapper.appendChild(itm);
            document.getElementById("tbFb").append(el);
            console.log(el);
        });
    });
</script>
</body>