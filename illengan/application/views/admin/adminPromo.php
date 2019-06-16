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
                    <button id="addPromo" class="btn btn-primary btn-sm"
                        data-toggle="modal" data-target="#addPromosModal" data-original-title style="margin:0">Add Promo</button>
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
                    <!--Start of Modal "Add Promos "-->
                    <div id="addPromosModal" class="modal fade bd-example-modal-lg" aria-labelledby="exampleModalLabel" aria-hidden="true" 
                        tabindex="-1" role="dialog" style="overflow: auto !important;">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Promo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?php echo base_url()?>admin/promos/add" method="get"
                                    accept-charset="utf-8">
                                    <div class="modal-body">
                                        <!--Menu Name-->
                                        <div class="form-row">
                                        <div class="input-group mb-3 col">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                    style="width:105px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                    Promo Name</span>
                                            </div>
                                            <input type="text" name="pmName" id="pmName"
                                                class="form-control form-control-sm">
                                        </div>

                                        <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Status</span>
                                                </div>
                                                <select class="form-control" name="status" id="status">
                                                <option value="enabled">enabled</option>
                                                <option value="disabled">disabled</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--Description-->
                                        <div class="form-row">
                                            <!--Pay date-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Start Date</span>
                                                </div>
                                                <input type="date" name="pmStartDate" id="pmStartDate"
                                                    class="form-control form-control-sm" required>
                                            </div>

                                            <!--Order date-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        End Date</span>
                                                </div>
                                                <input type="date" name="pmEndDate" id="pmEndDate"
                                                    class="form-control form-control-sm" required>
                                            </div>
                                        </div>
 
                                        <!--Menu Items-->
                                        <a id="addFreebie1" class="btn btn-primary btn-sm" style="color:blue">Add
                                            Menu Freebies</a>
                                        <!--Button to add row in the table-->
                                        <br><br>

                                        <div class="fbTableDiv"></div>

                                        <!--Menu Items-->
                                        <a class="addDiscounts btn btn-warning btn-sm" style="color:orange">Add Menu Discounts</a>
                                        <!--Button to add row in the table-->
                                        <br><br>
                                        <div class="discountsDiv"></div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-sm"
                                                data-dismiss="modal">Cancel</button>
                                            <button id="submitPromo"
                                                class="btn btn-success btn-sm" type="submit">Insert</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--End of Modal "Promos"-->

                    <!--Start of Modal "Edit Promos "-->
                    <div id="editPromosModal" class="modal fade bd-example-modal-lg" aria-labelledby="exampleModalLabel" aria-hidden="true" 
                        tabindex="-1" role="dialog" style="overflow: auto !important;">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Promo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?php echo base_url()?>admin/promos/edit" method="get"
                                    accept-charset="utf-8">
                                    <div class="modal-body">
                                        <!--Menu Name-->
                                        <div class="form-row">
                                        <div class="input-group mb-3 col">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                    style="width:105px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                    Promo Name</span>
                                            </div>
                                            <input type="text" name="pmName" id="pmName"
                                                class="form-control form-control-sm">
                                        </div>

                                        <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Status</span>
                                                </div>
                                                <select class="form-control" name="status" id="status">
                                                <option value="enabled">enabled</option>
                                                <option value="disabled">disabled</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--Description-->
                                        <div class="form-row">
                                            <!--Pay date-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Start Date</span>
                                                </div>
                                                <input type="date" name="pmStartDate" id="pmStartDate"
                                                    class="form-control form-control-sm" required>
                                            </div>

                                            <!--Order date-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        End Date</span>
                                                </div>
                                                <input type="date" name="pmEndDate" id="pmEndDate"
                                                    class="form-control form-control-sm" required>
                                            </div>
                                        </div>
 
                                        <!--Menu Items-->
                                        <a id="addFreebie1" class="btn btn-primary btn-sm" style="color:blue">Add
                                            Menu Freebies</a>
                                        <!--Button to add row in the table-->
                                        <br><br>

                                        <div class="fbTableDiv"></div>

                                        <!--Menu Items-->
                                        <a class="addDiscounts btn btn-warning btn-sm" style="color:orange">Add Menu Discounts</a>
                                        <!--Button to add row in the table-->
                                        <br><br>
                                        <div class="discountsDiv"></div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-sm"
                                                data-dismiss="modal">Cancel</button>
                                            <button id="submitPromo"
                                                class="btn btn-success btn-sm" type="submit">Insert</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--End of Modal "Edit Promos"-->

                       <!--Start of Menu Items Modal"-->
                       <div class="modal fade bd-example-modal" id="menuItems" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Select Menu Items</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="menuItemsForm" method="post"
                                    accept-charset="utf-8">
                                    <div class="modal-body">
                                        <div style="margin:1% 3%" id="list">
                                            <!--checkboxes-->
                                            <label style="width:96%"><input type="checkbox" class="mr-2" value="">Sample
                                                data 2</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal" id="addMenuItems">Ok</button>
                                    </div>
                                </form> 
                            </div>
                        </div>
                    </div>
                    <!--End of Menu Items Modal"-->
               
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
var menuItems = [];
var promos = [];
var menupromos = [];
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
                    promos[index].menufreebies = data.menufreebies.filter(mf => mf.pmID == item.pmID);
                    promos[index].discounts = data.discounts.filter(disc =>  disc.pmID==  item.pmID);

                });
                menupromos = data;
                console.log(data);
                menuItems = data.menuitems;
                showTable();
            },
            error: function(response,setting, errorThrown){
                console.log(errorThrown);
                console.log(response.responseText);
            }
        });

        $('#addPromo').on("click",function() {
            $('#addPromosModal form')[0].reset();
            $('#editPromosModal form')[0].reset();
            $('.fbTableDiv').empty();
            $('.discountsDiv').empty();
        });
    });

function setBrochureContent(menuitems, button){
        $("#list").empty();
        $("#list").append(`${menuitems.map(menu => {
            return `<label style="width:96%"><input type="checkbox" id="prID${menu.prID}" class="menuitems mr-2" 
            value="${menu.prID}"> ${menu.menu_item}</label>`
        }).join('')}`);
        disableSelected(button);
    }
    
    function disableSelected(button) {
        var trElements = $(button).closest('table').find('tr');
        var addedItems;

        console.log($(button).hasClass("addFreebie2"));
        if($(button).hasClass("addFreebie2")) {
            addedItems = $(button).closest("table").next(".freebies").find('tr.promoconstraint').find('#prID');
        } else if($(button).hasClass("addFreebie3")) {
            addedItems = $(button).closest("tr.promoconstraint").nextUntil("tr.promoconstraint").find('#prID');
        } else if($(button).hasClass("addDiscountItems")) {
            addedItems = $(button).closest("table").next(".discountsTB").find('tr.promoconstraint').find('#prID');
        } else if($(button).hasClass("addDiscounts2")) {
            addedItems = $(button).closest("tr.promoconstraint").nextUntil("tr.promoconstraint").find('#prID');
        }

        if(addedItems != 0 || addedItems != null) {
            for(var i = 0; i <= addedItems.length-1; i++) {
            var id = $(addedItems).eq(i).data("id");
            $('#prID'+id).attr("disabled","disabled");
            console.log(id);
            }
        }
    }

function showTable(){
        promos.forEach(function(item){
            var tableRow = `                
                <tr class="table_row" data-id="${item.promos.pmID}">   <!-- table row ng table -->
                    <td><a href="javascript:void(0)" class="ml-2 mr-4">
                    <img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></a>${item.promos.pmName}</td>
                    <td>${item.promos.freebie != null ? "Freebie" : ""}
                    ${item.promos.discount != null ? "Discount" : ""}</td>
                    <td>${item.promos.pmStartDate}</td>
                    <td>${item.promos.pmEndDate}</td>
                    <td>${item.promos.status}</td>
                    <td>
                        <button class="editBtn btn btn-sm btn-secondary" data-toggle="modal" data-target="#editPromosModal">Edit</button>
                        <button class="deleteBtn btn btn-sm btn-warning">Archived</button>
                    </td>
                </tr>
            `;
            var freebies = `
            <div class="freebies col-sm" style="float:left;margin-right:3%" >
            <span><b>Items with Freebies</b></span>
                ${item.freebies.length === 0 ? "<br>No freebies are set for this promo." : 
                `
                 <!-- label-->
              . <table class="table table-bordered"> <!-- Freebies table-->
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Freebie Name</th>
                            <th scope="col">Menu Item</th>
                            <th scope="col">Qty Req.</th>
                        </tr>
                    </thead>
                    <tbody>
                    ${item.freebies.map(fb => {
                        return `
                        <tr>
                        <td>${fb.fbName}</td>
                        <td>${fb.menu_item}</td>
                        <td>${fb.pcQty}</td>
                        </tr> 
                        `;
                    }).join('')}
                    </tbody>
                </table>
                `}
            </div>
            `;
            var menufbDiv = `
            <div class="menufreebies col-sm">
            <span><b>Freebie Items</b></span><br>
                ${item.menufreebies.length === 0 ? "No freebies are set for this promo." : 
                `
                 <!-- label-->
                <table class="table table-bordered"> <!-- Freebies table-->
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Freebie Name</th>
                            <th scope="col">Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                    ${item.menufreebies.map(mf => {
                        return `
                        <tr>
                        <td>${mf.menu_freebie}</td>
                        <td>${mf.fbQty}</td>
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
                        
                        <div style="overflow:auto"> <!-- description, preferences, and addons container -->
                            
                            <div class="freebieItems row" style="overflow:auto;margin-top:1%;padding: 5px;"> <!-- Preferences and addons container-->
                                
                            </div>
                            <div class="discountItems row" style="overflow:auto;margin-top:1%;padding: 5px;"> <!-- Preferences and addons container-->
                                
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            `;
            var discountsDiv = `
            <div class="discounts col-sm"> <!-- Discounts table container--><span><b>Discounts</b></span><br>
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
                            <td>&#8369; ${disc.prPrice}</td>
                            <td>&#8369; ${disc.dcAmount}</td>
                            </tr>`
                            }).join('')}
                        </tbody>
                    </table>`
                }
            </div>`;
            
            $("#menuTable > tbody").append(tableRow);
            $("#menuTable > tbody").append(accordion);
            $(".freebieItems").last().append(freebies);
            $(".freebieItems").last().append(menufbDiv);
            $(".discountItems").last().append(discountsDiv);
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
        $(".editBtn").on("click", function() {
        $('#addPromosModal form')[0].reset();
        $('#editPromosModal form')[0].reset();
        $('.fbTableDiv').empty();
        $('.discountsDiv').empty();
        var pmID = $(this).closest("tr").attr("data-id");
        setEditModal($("#editPromosModal"), promos.filter(item => item.promos.pmID === pmID)[0],
        menupromos.fb.filter(item => item.pmID === pmID), menupromos.dc.filter(item => item.pmID === pmID),
        menupromos.menudiscounts.filter(item => item.pmID === pmID));
        console.log(menupromos.fb.filter(item => item.pmID === pmID));
    });

    }  

var btn;
function getSelectedMenu() {
    $(document).ready(function() {
        var value = 0;
        var choices = document.getElementsByClassName('menuitems');
        var merchChecked;
     
        for (var i = 0; i <= choices.length - 1; i++) {
            if (choices[i].checked) {
            value = choices[i].value;
            var menupromo = menuItems.filter(item => item.prID === value);

            
            var freebieDiv = `
                        <tr class="promoconstraint" data-promotype="f">
                            <td><input type="text" id="prID" name="prID" data-id="${value}" class="prID form-control 
                            form-control-sm" value="${menupromo[0].menu_item}" readonly="readonly"></td>
                            <td><input type="number" id="pcQty" name="pcQty" class="pcQty form-control form-control-sm"
                                    value="1" min="1" required></td>
                            <td><a class="addFreebie3 btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#menuItems" data-original-title style="margin:0"
                                    style="color:blue">Freebies</a></td>
                        </tr>`;
           
            if ($('#addPromosModal').is(':visible')) {
                $('#addPromosModal').find(".freebies").last().append(freebieDiv);
            } else {
                $('#editPromosModal').find(".freebies").last().append(freebieDiv);
            }

            }
        }

        $(".addFreebie3").on('click',function(){
            btn = $(this);
            setBrochureContent(menuItems, $(this));
            $('#addMenuItems').attr("onclick","getSelectedFreebies()");
        });
    }); 
    
}

function getSelectedFreebies() {
    $(document).ready(function() {
        var value = 0;
        var choices = document.getElementsByClassName('menuitems');
        var merchChecked;
     
        for (var i = 0; i <= choices.length - 1; i++) {
            if (choices[i].checked) {
                value = choices[i].value;
                var menupromo = menuItems.filter(item => item.prID === value);
            
            var freebieDiv = `
            <tr class="menufreebies">
                <td>
                    <div class="input-group col">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm"
                                style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                Freebie</span>
                        </div>
                        <input type="text" id="prID" name="prID" data-id="${value}" class="prID form-control 
                        form-control-sm" value="${menupromo[0].menu_item}" readonly="readonly">
                    </div>
                </td>
                <td><input type="number" id="fbQty" name="fbQty" class="pcQty form-control form-control-sm" value="1"
                        min="1" required></td>
                <td style="text-align:center;"></td>
            </tr>`;
                
            $(btn).closest('tr').after(freebieDiv);
            }
        }

    }); 
}
var btnDC;
$(document).ready(function() {
        var count;
        // Adding Freebie Promos
        $('#addFreebie1').on('click', function() {
            var fbTable = `<table class="table table-lg table-borderless fbTable pmTab">
            <thead class="thead-light">
                <tr>
                    <th>Freebie Name</th>
                    <th>Freebie Type</th>
                    <th>Add Freebie</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr class="freebiesmain">
                    <td><input type="text" name="fbName" id="fbName" placeholder="(e.g. Buy One Take One)" class="form-control form-control-sm" required></td>
                    <td><select class="isElective form-control" name="isElective" id="isElective">
                            <option value="0" selected>Self Freebie</option>
                            <option value="1">Freebie Selection</option>
                        </select></td>
                    <td><a class="addFreebie2 btn btn-primary btn-sm" data-toggle="modal" data-target="#menuItems"
                            data-original-title style="margin:0" style="color:blue">Add Items</a></td>
                    <td><img class="delBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px"
                            onclick="removeItem(this)"></td>
                </tr>
                <tr class="accordion" style="display:table-row">
                        <!-- table row ng accordion -->
                        <div class="preferences"></div>
                        <table class="freebies table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Menu Item</th>
                                    <th width="25%" scope="col">Qty Req.</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                </tr>
            </tbody>
        </table>`;
        
            if ($('#addPromosModal').is(':visible')) {
                $('#addPromosModal').find('.fbTableDiv').append(fbTable);
            } else {
                $('#editPromosModal').find('.fbTableDiv').append(fbTable);
            }
       

        $(".addFreebie2").on('click',function(){
            setBrochureContent(menuItems, $(this));
            $('#addMenuItems').attr("onclick","getSelectedMenu()");

        });
        
        $(".fbItem").on('change', function() {
            $(".fbItem").val($(".menuName").val());
        });
        });
        //End of Adding Freebie Promos

        $('.addDiscounts').on("click", function() {
            var discountsHTML = `<table class="discTable table table-sm table-borderless">
            <!--Table containing the different input fields in adding trans items -->
            <thead class="thead-light">
                <tr>
                    <th>Discount Percentage</th>
                    <th>Add Items</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr class="discounts">
                    <td><input type="text" name="dcName" id="dcName"
                            class="dcName form-control form-control-sm" placeholder="(e.g. 20)" required></td>
                    <td><a class="addDiscountItems btn btn-primary btn-sm" data-toggle="modal" data-target="#menuItems"
                    data-original-title style="margin:0" style="color:blue">Add Items</a></td>
                    <td><img class="delBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px"
                            onclick="removeItem(this)"></td>
                </tr>
        </table>

        <table class="discountsTB table table-sm table-borderless">
                <thead class="thead-light">
                    <tr>
                        <th>Menu Item</th>
                        <th>Quantity Constraint</th>
                        <th scope="col">Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody></table>
`;
        if ($('#addPromosModal').is(':visible')) {
                $('#addPromosModal').find('.discountsDiv').append(discountsHTML);
            } else {
                $('#editPromosModal').find('.discountsDiv').append(discountsHTML);
            }

        $('.addDiscountItems').on("click", function() {
            var dcName = parseFloat($(this).closest('tr').find('input.dcName').val());
 
            if(dcName === "" || dcName === 0 || dcName === null || isNaN(dcName) ) {
                alert('Please enter discount value first');
                $(this).attr("data-target","");
            } else {
                $(this).attr("data-target","#menuItems");
                setBrochureContent(menuItems,  $(this));
                $('#addMenuItems').attr("onclick","getSelectedDiscount()");
            }
        
        });
        });

       
});

function getSelectedDiscount() {
    $(document).ready(function() {
        var value = 0;
        var choices = document.getElementsByClassName('menuitems');
        var merchChecked;
     
        for (var i = 0; i <= choices.length - 1; i++) {
            if (choices[i].checked) {
                value = choices[i].value;
                var menupromo = menuItems.filter(item => item.prID === value);
                
            var discDiv = `
                    <tr class="promoconstraint" data-promotype="d">
                        <td><input type="text" name="prID" min="0" id="prID" data-id="${value}" value="${menupromo[0].menu_item}" 
                        class="form-control form-control-sm"  readonly="readonly"></td>
                        <td><input type="number" name="pcQty" min="0" id="pcQty" value="1" min="1" 
                        class="form-control form-control-sm" >
                        </td>
                        <td><a class="addDiscounts2 btn btn-primary btn-sm" data-toggle="modal" data-target="#menuItems"
                            data-original-title style="margin:0" style="color:blue">Items</a></td>
                    </tr> `;

            if ($('#addPromosModal').is(':visible')) {
                $('#addPromosModal').find('.discountsTB > tbody').append(discDiv);
            } else {
                $('#editPromosModal').find('.discountsTB > tbody').append(discDiv);
            }

            }
        }

        $('.addDiscounts2').on("click", function() {
        btnDC = $(this);
        setBrochureContent(menuItems, $(this));
        $('#addMenuItems').attr("onclick","getDiscountItems()");
    });
    }); 
}

function getDiscountItems() {
    $(document).ready(function() {
        var value = 0;
        var choices = document.getElementsByClassName('menuitems');
        var merchChecked;
        var prPrice = 0, discount = 0;
        for (var i = 0; i <= choices.length - 1; i++) {
            if (choices[i].checked) {
                value = choices[i].value;
                var menupromo = menuItems.filter(item => item.prID === value);
                prPrice = parseFloat(menupromo[0].prPrice);
                discount = $('.addDiscounts2').eq(0).closest('table').prev('.discTable').find('.dcName').val();
                
                discount = discount / 100;
                var discountPrice = prPrice * parseFloat(discount);
                var newPrice = prPrice - discountPrice;
                var dcDiv = `
                    <tr class="menudiscounts">
                        <td>
                            <div class="input-group col">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                        style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Discounted Item</span>
                                </div>
                                <input type="text" id="prID" name="prID" data-id="${value}" class="prID form-control 
                                form-control-sm" value="${menupromo[0].menu_item}" readonly="readonly">
                            </div>
                        </td>
                        <td><input type="number" id="dcAmount" name="dcAmount" class="dcAmount form-control form-control-sm" value="${newPrice}"
                                min="1"></td>
                        <td style="text-align:center;"></td>
                    </tr>`;

                $(btnDC).closest('tr').after(dcDiv);
            }
        }

    }); 
}
function removeItem(remove) {
    $(remove).closest("tr").remove();
   
}
// ------------------------------- ADDING PROMOS -------------------------------------
$(document).ready(function() {
    $("#addPromosModal form").on('submit', function(event) {
        event.preventDefault();
        var pmName = $(this).find("input[name='pmName']").val();
        var pmStartDate = $(this).find("input[name='pmStartDate']").val();
        var pmEndDate = $(this).find("input[name='pmEndDate']").val();
        var status = $(this).find("select[name='status']").val();
        var freebie = isNaN(parseInt($(this).find(".freebies").length)) || 
        parseInt($(this).find(".freebies").length) === 0 ?  (null) : 'y';
        var discount = isNaN(parseInt($(this).find(".discounts").length)) ||
         parseInt($(this).find(".discounts").length) === 0 ?  (null) : 'y';
       console.log(parseInt($(this).find(".discounts").length));
        // Freebies Table
        var fb = [];
        console.log($(this).find(".freebiesmain"));
        for (var index = 0; index < $(this).find(".freebiesmain").length; index++) {
            var row = $(this).find(".freebiesmain").eq(index);
            fb.push({
                fbName :  row.find("input[name='fbName']").val(),
                isElective:  row.find("select[name='isElective']").val()
            });
        }

        // Discounts Table
        var dc = [];
        for (var index = 0; index < $(this).find(".discounts").length; index++) {
            var row = $(this).find(".discounts").eq(index);
            dc.push({
                dcName :  row.find("input[name='dcName']").val()
            });
        }

        // Promoconstraint Table
        var pc = [];
        console.log( $(this).find(".promoconstraint"));
        for (var index = 0; index < $(this).find(".promoconstraint").length; index++) {
            var row = $(this).find(".promoconstraint").eq(index);
            pc.push({
                prID :  row.find("input[name='prID']").attr('data-id'),
                pcType:  row.attr('data-promotype'),
                pcQty: row.find("input[name='pcQty']").val()
            });
        }
 
        // Menu Freebies Table
        var mfb = [];
        for (var index = 0; index < $(this).find(".menufreebies").length; index++) {
            var row = $(this).find(".menufreebies").eq(index);
            mfb.push({
                prID :  row.find("input[name='prID']").attr('data-id'),
                fbQty: row.find("input[name='fbQty']").val()
            });
        }

        // Menu Discounts Table
        var mdc = [];
        for (var index = 0; index < $(this).find(".menudiscounts").length; index++) {
            var row = $(this).find(".menudiscounts").eq(index);
            mdc.push({
                prID :  row.find("input[name='prID']").attr('data-id'),
                dcAmount: row.find("input[name='dcAmount']").val()
            });
        }
    
        $.ajax({
            url: "<?= site_url("admin/promos/add")?>",
            method: "post",
            data: {
                pmName: pmName,
                pmStartDate: pmStartDate,
                pmEndDate: pmEndDate,
                freebie: freebie,
                discount: discount,
                status: status,
                pc: JSON.stringify(pc),
                fb: JSON.stringify(fb),
                dc: JSON.stringify(dc),
                mfb: JSON.stringify(mfb),
                mdc: JSON.stringify(mdc)
            },
            beforeSend: function() {
                console.log('pmName ' +pmName);
                console.log('pmStartDate '+pmStartDate);
                console.log('pmEndDate '+pmEndDate);
                console.log('freebie '+freebie);
                console.log('status '+status);
                console.log('discount '+discount );
                console.log('Promoconst arr');
                console.log(pc);
                console.log('Freebies arr');
                console.log(fb);
                console.log('Discounts arr');
                console.log(dc);
                console.log('Menu Freebies');
                console.log(mfb);
                console.log('Menu Discounts');
                console.log(mdc);
            },
            success: function() {
                alert('Promos Added');
                //location.reload();
            },
            error: function (response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
            }
        });
    });
});
// ---------------------------- END OF ADDING PROMOS ---------------------------------

// ---------------------------- START OF EDIT PROMOS ---------------------------------
function setEditModal(modal, promos, freebies, discounts, mdc) {
    // Conversion of Date to Datetime-local format
    modal.find("input[name='pmName']").val(promos.promos.pmName);
    modal.find("input[name='pmStartDate']").val(promos.promos.pmStartDate);
    modal.find("input[name='pmEndDate']").val(promos.promos.pmEndDate);
    modal.find("select[name='status']").find(`option[value=${promos.promos.status}]`).attr("selected","selected");

    freebies.forEach(pf => {
        modal.find(".fbTableDiv").append(`
        <table class="table table-lg table-borderless fbTable pmTab">
            <thead class="thead-light">
                <tr>
                    <th>Freebie Name</th>
                    <th>Freebie Type</th>
                    <th>Add Freebie</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr class="freebiesmain">
                    <td><input type="text" name="fbName" id="fbName" value="${pf.fbName}" placeholder="(e.g. Buy One Take One)" class="form-control form-control-sm" required></td>
                    <td><select class="isElective form-control" name="isElective" id="isElective">
                            <option value="0" selected>Self Freebie</option>
                            <option value="1">Freebie Selection</option>
                        </select></td>
                    <td><a class="addFreebie2 btn btn-primary btn-sm" data-toggle="modal" data-target="#menuItems"
                            data-original-title style="margin:0" style="color:blue">Add Items</a></td>
                    <td><img class="delBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px"
                            onclick="removeItem(this)"></td>
                </tr>
                <tr class="accordion" style="display:table-row">
                        <!-- table row ng accordion -->
                        <div class="preferences"></div>
                        <table class="freebies table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Menu Item</th>
                                    <th width="25%" scope="col">Qty Req.</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                </tr>
            </tbody>
        </table>
        `);
      modal.find("select[name='isElective']").find(`option[value=${pf.isElective}]`).attr("selected","selected");
    });
   
    // Items with freebies
    promos.freebies.forEach(pf => {
        modal.find(".freebies > tbody").append(`<tr class="promoconstraint" data-promotype="f">
                            <td><input type="text" id="prID" name="prID" data-id="${pf.prID}" class="prID form-control 
                            form-control-sm" value="${pf.menu_item}" readonly="readonly"></td>
                            <td><input type="number" id="pcQty" name="pcQty" class="pcQty form-control form-control-sm"
                                    value="1" min="1" required></td>
                            <td><a class="addFreebie3 btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#menuItems" data-original-title style="margin:0"
                                    style="color:blue">Freebies</a></td>
                        </tr>`);

        // Menu freebies
        
    });
    promos.menufreebies.forEach(fb => {
            modal.find(".freebies > tbody").append(`<tr class="menufreebies">
                    <td>
                        <div class="input-group col">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                    style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                    Freebie</span>
                            </div>
                            <input type="text" id="prID" name="prID" data-id="${fb.prID}" class="prID form-control 
                            form-control-sm" value="${fb.menu_freebie}" readonly="readonly">
                        </div>
                    </td>
                    <td><input type="number" id="fbQty" name="fbQty" class="pcQty form-control form-control-sm" value="1"
                            min="1" required></td>
                    <td style="text-align:center;"></td>
                </tr>`);
        });

    discounts.forEach(pd => {
        modal.find(".discountsDiv").append(`<table class="discTable table table-sm table-borderless">
            <!--Table containing the different input fields in adding trans items -->
            <thead class="thead-light">
                <tr>
                    <th>Discount Percentage</th>
                    <th>Add Items</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr class="discounts">
                    <td><input type="text" name="dcName" id="dcName" value="${pd.dcName}"
                            class="dcName form-control form-control-sm" placeholder="(e.g. 20)" required></td>
                    <td><a class="addDiscountItems btn btn-primary btn-sm" data-toggle="modal" data-target="#menuItems"
                    data-original-title style="margin:0" style="color:blue">Add Items</a></td>
                    <td><img class="delBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px"
                            onclick="removeItem(this)"></td>
                </tr>
        </table>

        <table class="discountsTB table table-sm table-borderless">
                <thead class="thead-light">
                    <tr>
                        <th>Menu Item</th>
                        <th>Quantity Constraint</th>
                        <th scope="col">Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody></table>`);

    });

    promos.discounts.forEach(dc => {
        modal.find(".discountsTB > tbody").append(` <tr class="promoconstraint" data-promotype="d">
                        <td><input type="text" name="prID" min="0" id="prID" data-id="${dc.prID}" value="${dc.menu_item}" 
                        class="form-control form-control-sm"  readonly="readonly"></td>
                        <td><input type="number" name="pcQty" min="0" id="pcQty" value="1" min="1" 
                        class="form-control form-control-sm" >
                        </td>
                        <td><a class="addDiscounts2 btn btn-primary btn-sm" data-toggle="modal" data-target="#menuItems"
                            data-original-title style="margin:0" style="color:blue">Items</a></td>
                    </tr> `);

    });

    mdc.forEach(mdc => {
        modal.find(".discountsTB > tbody").append(`<tr class="menudiscounts">
                        <td>
                            <div class="input-group col">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                        style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Discounted Item</span>
                                </div>
                                <input type="text" id="prID" name="prID" data-id="${mdc.prID}" class="prID form-control 
                                form-control-sm" value="${mdc.menu_item}" readonly="readonly">
                            </div>
                        </td>
                        <td><input type="number" id="dcAmount" name="dcAmount" class="dcAmount form-control form-control-sm" value="${mdc.dcAmount}"
                                min="1"></td>
                        <td style="text-align:center;"></td>
                    </tr>`);

    });

  
}


</script>
</body>