<!DOCTYPE html>
<html>

<head>
    <?php include_once('head.php') ?>
</head>
<body>
<?php include_once('navigation.php') ?>
<div class="content">
    <div class="container-fluid" style="margin-top:70px">
        <br>
        <p style="text-align:right; font-weight: regular; font-size: 16px">
            <!-- Real Time Date & Time -->
            <?php echo date("M j, Y - l"); ?>
        </p>
        <div class="content">
            <div class="container-fluid">
                <!--Table-->
                    
                    <table id="orders" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="10%"><b class="pull-left">Order No.</b></th>
                                <th><b class="pull-left">Order</b></th>
                                <th width="10%"><b class="pull-left">Quantity</b></th>
                                <th><b class="pull-left">Date & Time</b></th>
                                <th width="10%"><b class="pull-left">Table No.</b></th>
                                <th><b class="pull-left">Customer</b></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    </div>
                    </div>
                    </div>
                    </div>


<?php include_once('scripts.php') ?>

</body>
<script>
var orders = [];
 $(function () {
        $.ajax({
            url: '/chef/orders',
            dataType: 'json',
            success: function (data) {
                var poLastIndex = 0;
                $.each(data.orders, function (index, items) {
                    orders.push({
                        "orders": items
                    });
                    orders[index].addons = data.addons.filter(ao => ao.olID == items.olID);
                   
                });
               
                showTable();
                console.log(orders);
            },
            error: function (response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
            }
        });

        
    });
    function showTable() {
       orders.forEach(function (item) {
            var tableRow = `
                <tr class="table_row" data-id="${item.orders.osID}">   <!-- table row ng table -->
                    <td style="text-align: center;">
                    <img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" 
                    style="height:15px;width: 15px; margin-right: 5px;"/> 
                    ${item.orders.olID}</td>
                    <td><b>${item.orders.olDesc}</b></td>
                    <td><b>${item.orders.olQty}</b></td>
                    <td>${item.orders.osDateTime}</td>
                    <td>${item.orders.tableCode}</td>
                    <td>${item.orders.custName}</td>
                </tr>
            `;
            var addonsDiv = `
            <div class="preferences" style="float:left;margin-right:3%" > <!-- Preferences table container-->
                ${parseInt(item.addons.length) === 0 && item.orders.olRemarks === null ? "No orders" : 
                `<caption><b>Add Ons</b></caption>
                <br>
                <table id="addons" class=" table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Add On</th>
                            <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                    ${item.addons.map(ao => {
                        return `
                        <tr>
                            <td>${ao.aoName}</td>
                            <td>${ao.aoQty}</td>
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
                <td colspan="10"> <!-- table row ng accordion -->
                    <div style="overflow:auto;display:none"> <!-- container ng accordion -->
                        
                        <div style="width:100%;overflow:auto;padding-left: 5%"> <!-- description, preferences, and addons container -->
                            
                            <div class="AOaccordion" style="overflow:auto;margin-top:1%"> <!-- Preferences and addons container-->
                                
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            `;

            var remarks = `
            <div class="addons" style="float:left;margin-right:3%" > <!-- Preferences table container-->
                ${item.orders.olRemarks === null || item.orders.olRemarks === "" ? " " : 
                `<caption><b>Order Remarks</b></caption>
                <br>
                <table class="table table-bordered"> <!-- Preferences table-->
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>${item.orders.olRemarks}</td>
                        </tr>
                    </tbody>
                </table>
                `}
            </div>
            `;
        
            $("#orders > tbody").append(tableRow);
            $("#orders > tbody").append(accordion);
            $(".AOaccordion").last().append(addonsDiv);
            $(".AOaccordion").last().append(remarks);
        });
        $(".accordionBtn").on('click', function () {
            if ($(this).closest("tr").next(".accordion").css("display") == 'none') {
                $(this).closest("tr").next(".accordion").css("display", "table-row");
                $(this).closest("tr").next(".accordion").find("td > div").slideDown("slow");
            } else {
                $(this).closest("tr").next(".accordion").find("td > div").slideUp("slow");
                $(this).closest("tr").next(".accordion").hide("slow");
            }
        });

    }
</script>

</html>,