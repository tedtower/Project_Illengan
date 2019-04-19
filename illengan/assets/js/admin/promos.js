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
                    promos[index].promo_cons = data.promo_cons.filter(pc => pc.promo_id == item.promo_id);
                    promos[index].menu = data.menu.filter(menu => menu.pref_id == pc.menu_id);
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
                <tr class="table_row" data-menuId="${item.promos.menu_id}">   <!-- table row ng table -->
                    <td><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></td>
                    <td>${item.promos.promo_name}</td>
                    <td>${item.promos.start_date}</td>
                    <td>${item.promos.status}</td>
                    <td>
                        <button class="editBtn btn btn-sm btn-primary">Edit</button>
                        <button class="deleteBtn btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            `;
            var preferencesDiv = `
            <div class="preferences" style="width:45%;overflow:auto;float:left;margin-right:3%" > <!-- Preferences table container-->
                ${item.freebies.length === 0 ? "Not Applicable" : 
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
                    ${item.freebies.map(fb => {
                        return `
                        <tr>
                        <td>${fb.elective}</td>
                            <td>&#8369; $fb.fb_qty}</td>
                            <td>${fb.elective}</td>
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
            <div class=" addons" style="width:45%;overflow:auto" > <!-- Addons table container--><span><b>Addons:</b></span><br>
                ${item.discounts.length === 0 ? "No addons are set for this menu item." : 
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
                        ${item.discounts.map(disc => {
                            return `<tr><td>${disc.dc_name}</td>
                            <td>&#8369; ${disc.dc_amount}</td>
                            <td>${disc.dc_amount}</td></tr>`;
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