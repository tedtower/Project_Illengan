<!--End Side Bar-->
<div class="content" style="background:white">
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
                                <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#newMenu"
                                    data-original-title style="margin:0;">Add Menu Item</a>
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
            <table id="menuTable" class="table  table-bordered dt-responsive nowrap" cellpadding="0" width="100%">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th>Menu Item</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>

            <!--Start of Modal "Add Menu"-->
            <div class="modal fade bd-example-modal-lg" id="newMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Menu Item</h5>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?php echo base_url()?>admin/menu/add" method="post"
                            accept-charset="utf-8" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="input-group mb-3"> <!--Menu Image-->
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="width:105px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">Image</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="mImage" id="mImage">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div> 
                                <!--Menu Name-->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Name</span>
                                    </div>
                                    <input type="text" name="mName" class="form-control form-control-sm" required>
                                </div>  
                                <!--Description-->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Description</span>
                                    </div>
                                    <textarea type="text" name="mDesc" class="form-control form-control-sm"></textarea>
                                </div>                                                                                                                                                       
                                <div class="form-row"> <!--Container of receipt no. and transaction date-->
                                    <!--Receipt no-->
                                    <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Category</span>
                                    </div>
                                    <select class="custom-select" name="ctName" required>
                                        <option value="" selected disabled>Choose</option>
                                        <?php foreach($category as $category){?>
                                            <option value="<?= $category['ctID']?>"><?= $category['ctName']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                    <!--Transaction date-->
                                    <div class="input-group mb-3 col">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Status</span>
                                    </div>
                                    <select class="custom-select" name="mAvailability" required>
                                        <option value="" selected>Choose</option>
                                        <option value="available">Available</option>
                                        <option value="unavailable">Unvailable</option>
                                    </select>
                                    </div>
                                </div>



                                <!--Menu Items-->
                                <a class="addPreference btn btn-primary btn-sm" style="color:blue;margin:0">Add Preferences</a> <!--Button to add row in the table-->
                                <br><br>
                                <table class="preferencetable table table-sm table-borderless"> <!--Table containing the different input fields in adding trans items -->
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
                                    </tbody>
                                </table>
                                <!--Menu Items-->
                                <a class="addAddon btn btn-primary btn-sm" style="color:blue;margin:0">Add Addons</a> <!--Button to add row in the table-->
                                <br><br>
                                <table class="addontable table table-sm table-borderless"> <!--Table containing the different input fields in adding trans items -->
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="width:96%;text-align:center">Addon Name</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
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
var menu = [];
var addons = <?= json_encode($addons)?>;
$(document).ready(function() {
    $(function(){
        $.ajax({
            url: '<?= base_url("admin/menu/getDetails")?>',
            dataType: 'json',
            success: function(data){
                var prefLastIndex = 0;
                var aoLastIndex = 0;
                $.each(data.menu, function(index, item){
                    menu.push({"menu" : item});
                    menu[index].preferences = data.preferences.filter(pref => pref.mID == item.mID);
                    menu[index].addons = data.addons.filter(ao => ao.mID == item.mID);
                });
                showTable();
            },
            error: function(response,setting, errorThrown){
                console.log(errorThrown);
                console.log(response.responseText);
            }
        });

    });

    $("#addBtn").on('click', function() {
        $("#newMenu form")[0].reset();
    });
    $(".addPreference").on('click',function(){
        var row=`
        <tr data-id="">
            <td><input type="text" name="prName[]" class="form-control form-control-sm"></td>
            <td>
                <select class="form-control" name="mTemp[]">
                    <option value="" selected>Choose</option>
                    <option value="c">Cold</option>
                    <option value="h">Hot</option>
                    <option value="hc">Hot and Cold</option>
                </select>
            </td>
            <td><input type="number" name="prPrice[]" class="form-control form-control-sm"></td>
            <td>
                <select class="form-control" name="prStatus[]">
                    <option value="" selected disabled>Choose</option>
                    <option value="available">Available</option>
                    <option value="unavailable">Unvailable</option>
                    <option value="deleted">Deleted</option>
                </select>
            </td>
            <td><img class="exitBtn1" src="/assets/media/admin/error.png" style="width:20px;height:20px"></td>
        </tr>
        `;
        $(this).closest(".modal").find(".preferencetable > tbody").append(row);
        $(this).closest(".modal").find(".exitBtn1").last().on('click',function(){
            $(this).closest("tr").remove();
        });
    });
    $(".addAddon").on('click',function(){
        var row=`
        <tr data-id="">
            <td>
                <select class="form-control" name="aoName[]">
                ${addons.map(addon => {
                        return `
                        <option value="${addon.aoID}">${addon.aoName}</option>`
                    }).join('')}
                </select>
            </td>
            <td><img class="exitBtn2" src="/assets/media/admin/error.png" style="width:20px;height:20px;right:0"></td>
        </tr>
        `;
        $(this).closest(".modal").find(".addontable > tbody").append(row);
        $(this).closest(".modal").find(".exitBtn2").last().on('click',function(){
            $(this).closest("tr").remove();
        });
    });

    $("#newMenu form").on('submit', function(event) {
        event.preventDefault();
        // var image = $(this).find("input[name='mImage']")[0].files[0];
        // var name = $(this).find("input[name='mName']").val();
        // var description = $(this).find("input[name='mDesc']").val();
        // var category = $(this).find("input[name='ctName']").val();
        // var status = $(this).find("input[name='mAvailability']").val();
        var preferences = [];
        for (var index = 0; index < $(this).find(".preferencetable > tbody").children().length; index++) {
            preferences.push({
                prName: $(this).find("input[name='prName[]']").eq(index).val(),
                mTemp: $(this).find("input[name='mTemp[]']").eq(index).val(),
                prPrice: $(this).find("input[name='prPrice[]']").eq(index).val(),
                prStatus: $(this).find("select[name='prStatus[]']").eq(index).val()
            });
        }
        var addons = [];
        for (var index = 0; index < $(this).find(".addontable > tbody").children().length; index++) {
            addons.push({
                aoName: $(this).find("select[name='aoName[]']").eq(index).val()
            });
        }
        $.ajax({
            url: "<?= site_url("admin/menu/add")?>",
            method: "post",
            data: {
                formdata: new FormData(this),
                preferences: JSON.stringify(preferences),
                addons: JSON.stringify(addons)
            },
            processData: false,
            contentType: false,
            dataType: "json",
            beforeSend: function() {
                console.log(preferences,addons);
            },
            success: function(data) {
                console.log(data);
                // inventory = data;
                // lastIndex = 0;
                // setTableData();
            },
            error: function(response, setting, error) {
                console.log(error);
                console.log(response);
            },
            complete: function() {
                $("#newMenu").modal("hide");
            }
        });
    });

    $("#editSupplier form").on('submit', function(event) {
        event.preventDefault();
        var id = $(this).find("input[name='sourceID']").val();
        var name = $(this).find("input[name='supplierName']").val();
        var contactNum = $(this).find("input[name='contactNum']").val();
        var email = $(this).find("input[name='email']").val();
        var address = $(this).find("input[name='supplierAddress']").val();
        var status = $(this).find("select[name='status']").val();
        var supplierMerchandise = [];
        for (var index = 0; index < $(this).find(".merchandisetable > tbody").children().length; index++) {
            var row = $(this).find(".merchandisetable > tbody > tr").eq(index);
            console.log(row);
            supplierMerchandise.push({
                spmID : isNaN(parseInt(row.attr('data-id'))) ?  (null) : parseInt(row.attr('data-id')),
                merchName: row.find("input[name='merchName[]']").val(),
                merchUnit: row.find("input[name='merchUnit[]']").val(),
                merchPrice: parseFloat(row.find("input[name='merchPrice[]']").val()),
                varID: parseInt(row.find("select[name='variance[]']").val())
            });
        }

        console.log(id, name, contactNum, email, address, status, supplierMerchandise);
        $.ajax({
            url: "<?= site_url("admin/supplier/edit")?>",
            method: "post",
            data: {
                id : id,
                name: name,
                contactNum: contactNum,
                email: email,
                address: address,
                status: status,
                merchandises: JSON.stringify(supplierMerchandise)
            },
            dataType: "json",
            beforeSend: function() {
                console.log(name, contactNum, email, address, status, supplierMerchandise);
            },
            success: function(data) {
                console.log(data);
                // inventory = data;
                // lastIndex = 0;
                // setTableData();
            },
            error: function(response, setting, error) {
                console.log(error);
                console.log(response.responseText);
            },
            complete: function() {
                $("#editSupplier").modal("hide");
            }
        });
    });

});
    function showTable(){
        menu.forEach(function(item){
            var tableRow = `                
                <tr class="table_row" data-menuId="${item.menu.mID}">   <!-- table row ng table -->
                    <td><a href="javascript:void(0)" class="ml-2 mr-4"><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></a>${item.menu.mName}</td>
                    <td>${item.menu.ctName}</td>
                    <td class="text-center">${item.menu.mAvailability}</td>
                    <td>
                        <button class="editBtn btn btn-sm btn-primary">Edit</button>
                        <button class="deleteBtn btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            `;
            var preferencesDiv = `
            <div class="preferences" style="width:45%;overflow:auto;float:left;margin-right:3%" > <!-- Preferences table container-->
                <span><b>Preferences:</b></span><br> <!-- label-->
                ${item.preferences.length === 0 ? "No prefernces are set for this menu item" : 
                `
                <table class="table table-bordered"> <!-- Preferences table-->
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Size Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    ${item.preferences.map(pref => {
                        return `
                        <tr>
                            <td>${pref.prName.toLowerCase() === 'normal' ? `${pref.mTemp == null ? "Regular" : pref.mTemp === 'h' ? "Hot" : pref.mTemp === 'c' ? "Cold" : "Hot and Cold" }` : `${pref.prName+ " "+ `${pref.mTemp == null ? "" : pref.mTemp}`}`}</td>
                            <td>&#8369; ${pref.prPrice}</td>
                            <td>${pref.prStatus}</td>
                        </tr>
                        `;
                    }).join('')}
                    </tbody>
                </table>
                `}
            </div>
            `;
            var accordion = `
            <tr class="accordion" style="display:none;background: #f9f9f9">
                <td colspan="5"> <!-- table row ng accordion -->
                    <div style="overflow:auto;display:none"> <!-- container ng accordion -->
                        <div style="width:280px;overflow:auto;float:left;margin-right:3%"> <!-- image container -->
                            <img src="<?= site_url('uploads/');?>${item.menu.mImage == null ? 'no_image.jpg' : item.menu.mImage}" alt="Missing Image" style="width:280px;height:180px">
                        </div>
                        
                        <div style="width:68%;overflow:auto"> <!-- description, preferences, and addons container -->
                            <div><b>Description:</b> <!-- label-->
                                <p>${item.menu.mDesc == null ? "Description is not available." : item.menu.mDesc}
                                </p>
                            </div> 
                        </div>
                    </div>
                </td>
            </tr>
            `;
            var addonsDiv = `
            <div class="addons" style="width:45%;overflow:auto" > <!-- Addons table container--><span><b>Addons:</b></span><br>
                ${item.addons.length === 0 ? "No addons are set for this menu item." : 
                    `<!-- label-->
                    <table class="table table-bordered"> <!-- Addons table-->
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Addons Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        ${item.addons.map(addon => {
                            return `<tr><td>${addon.aoName}</td>
                            <td>&#8369; ${addon.aoPrice}</td>
                            <td>${addon.aoStatus}</td></tr>`;
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

    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });
  
</script>