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
                                <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#newMenu"
                                    data-original-title style="float: left">Add Menu Item</a>
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
            <div class="modal fade bd-example-modal-lg" id="newMenu" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Menu Item</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?php echo base_url()?>admin/menu/add" method="get"
                                                accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <div class="input-group mb-3"> <!--Menu Image-->
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" style="width:105px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">Image</span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="menu_image" id="inputGroupFile01">
                                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                        </div>
                                                    </div> 
                                                    <!--Menu Name-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Name</span>
                                                        </div>
                                                        <input type="text" name="menu_name" id="menu_name" class="form-control form-control-sm">
                                                    </div>  
                                                    <!--Description-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Description</span>
                                                        </div>
                                                        <textarea type="text" name="menu_description" id="menu_description" class="form-control form-control-sm"></textarea>
                                                    </div>                                                                                                                                                       
                                                    <div class="form-row"> <!--Container of receipt no. and transaction date-->
                                                        <!--Receipt no-->
                                                        <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Category</span>
                                                        </div>
                                                        <select class="custom-select" name="category_name" id="category_name">
                                                            <option selected>Choose</option>
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                        <!--Transaction date-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Status</span>
                                                        </div>
                                                        <select class="custom-select" name="menu_availability" id="menu_availability">
                                                            <option selected>Choose</option>
                                                            <option></option>
                                                        </select>
                                                        </div>
                                                    </div>



                                                    <!--Menu Items-->
                                                    <a class="btn btn-primary btn-sm" style="color:blue">Add Preferences</a> <!--Button to add row in the table-->
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
                                                    <a class="btn btn-primary btn-sm" style="color:blue">Add Addons</a> <!--Button to add row in the table-->
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
    var menu = [];
    $(function(){
        $.ajax({
            url: '<?= base_url("admin/menu/getDetails")?>',
            dataType: 'json',
            success: function(data){
                var prefLastIndex = 0;
                var aoLastIndex = 0;
                $.each(data.menu, function(index, item){
                    menu.push({"menu" : item});
                    menu[index].preferences = data.preferences.filter(pref => pref.menu_id == item.menu_id);
                    menu[index].addons = data.addons.filter(ao => ao.menu_id == item.menu_id);
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
        menu.forEach(function(item){
            var tableRow = `                
                <tr class="table_row" data-menuId="${item.menu.menu_id}">   <!-- table row ng table -->
                    <td><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></td>
                    <td>${item.menu.menu_name}</td>
                    <td>${item.menu.category_name}</td>
                    <td>${item.menu.menu_availability}</td>
                    <td>
                        <button class="editBtn btn btn-sm btn-primary">Edit</button>
                        <button class="deleteBtn btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            `;
            var preferencesDiv = `
            <div class="preferences" style="width:45%;overflow:auto;float:left;margin-right:3%" > <!-- Preferences table container-->
                ${item.preferences.length === 0 ? "Not Applicable" : 
                `
                <span><b>Preferences:</b></span> <!-- label-->
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
                            <td>${pref.size_name.toLowerCase() === 'normal' ? `${pref.temp == null ? "Regular" : pref.temp === 'h' ? "Hot" : pref.temp === 'c' ? "Cold" : "Hot and Cold" }` : `${pref.size_name+ " "+ `${pref.temp == null ? "" : pref.temp}`}`}</td>
                            <td>&#8369; ${pref.pref_price}</td>
                            <td>${pref.size_status}</td>
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
                        <div style="width:280px;overflow:auto;float:left;margin-right:3%"> <!-- image container -->
                            <img src="<?=site_url('uploads/')?>${item.menu.menu_image}" style="width:280px;height:180px">
                        </div>
                        
                        <div style="width:68%;overflow:auto"> <!-- description, preferences, and addons container -->
                            <div><b>Description:</b> <!-- label-->
                                <p>${item.menu.menu_description}
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
                            return `<tr><td>${addon.ao_name}</td>
                            <td>&#8369; ${addon.ao_price}</td>
                            <td>${addon.ao_status}</td></tr>`;
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