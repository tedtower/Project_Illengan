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

                    <div class="table-responsive" style="width:100%;">
            <table class="table" id="menuTable">
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
        </div>
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