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
                            <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#brochure"
                                data-original-title style="margin:0" id="addTransaction">Add Purchases/Deliveries</a>
                            <br>
                            <br>
                            <table id="transTable" class="table table-bordered dt-responsive nowrap"
                                cellspacing="0" width="100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width:10px"></th>
                                        <th><b class="pull-left">Receipt No.</b></th>
                                        <th><b class="pull-left">Supplier</b></th>
                                        <th><b class="pull-left">Transaction Date</b></th>
                                        <th><b class="pull-left">Total</b></th>
                                        <th><b class="pull-left">Status</b></th>
                                        <th><b class="pull-left">Actions</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <!--showTable()-->
                                </tbody>
                            </table>
                        
                        <!--Start of Brochure Modal"-->
                        <div class="modal fade bd-example-modal-lg" id="brochure" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Select Stock Item</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="formAdd" action="<?= site_url('admin/transactions/add')?>" method="post" accept-charset="utf-8">
                                            <div class="modal-body">
                                                <!--checkboxes-->
                                                <table id="brochure" class="table table-bordered dt-responsive nowrap"
                                                cellspacing="0" width="100%">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th><b class="pull-left">Receipt No.</b></th>
                                                        <th><b class="pull-left">Supplier</b></th>
                                                        <th><b class="pull-left">Transaction Date</b></th>
                                                        <th><b class="pull-left">Total</b></th>
                                                        <th><b class="pull-left">Type</b></th>
                                                        <th><b class="pull-left">See Items</b></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   <!--show itesm-->
                                                </tbody>
                                            </table>
                                            </div>
                                            <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                    
                                                    
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
               <!--here--> <!--Start of Modal "Add Transaction"-->
               <div class="modal fade bd-example-modal-lg" id="newTransaction" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Purchases/Deliveries</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="addReturns" method="post">
                                            <div class="modal-body">
                                            <div class="form-row">
                                                <!--Source Name-->
                                                <input type="hidden" name="invoID" id="invoID"/>
                                                <input type="hidden" name="supID" id="supID"/>
                                                <input type="hidden" name="variance" id="variance"/>
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">      
                                                            <span class="input-group-text" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Supplier</span>
                                                        </div>
                                                        <input type="text"class="form-control form-control-sm" name="sourceName" id="sourceName" readonly/>
                                                    </div>
                                                <!--Receipt Number-->
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">      
                                                            <span class="input-group-text" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Receipt No.</span>
                                                        </div>
                                                        <input type="text" class="form-control" name="receiptNum" id="receiptNum" readonly>
                                                    </div>
                                                    </div>

                                                <div class="form-row">
                                                <!--Stock Name-->
                                                <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Stock Name:</span>
                                                        </div>
                                                        <input type="text" name="itemName" id="itemName" class="form-control form-control-sm" readonly/>
                                                        <input type="hidden" name="stckID" id="stckID"/>
                                                    </div>
                                                <!--Invoice Type-->
                                                <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Invoice Type</span>
                                                        </div>
                                                        <input type="text" class="form-control form-control-sm" name="transType" id="transType" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                <!--item quantity-->
                                                <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Quantity</span>
                                                        </div>
                                                <input type="number" name="itemQty" id="itemQty" class="form-control form-control-sm" readonly/>
                                                </div>
                                                 <!--item unit-->
                                                 <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Unit</span>
                                                        </div>
                                                <input type="text" name="itemUnit" id="itemUnit" class="form-control form-control-sm" readonly/>
                                                </div>
                                                <!--Price-->
                                                <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Price per Unit</span>
                                                        </div>
                                                        <input type="number" name="itemPrice" id="itemPrice" class="form-control form-control-sm" readonly>
                                                </div>
                                                </div>
                                                <!--Button to add launce the brochure modal-->
                                                <br>
                                                <div class="form-row">
                                                 <!--date -->
                                                 <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Return Date</span>
                                                        </div>
                                                        <input type="date" required class="form-control" name="retDate" id="retDate" />
                                                    </div>
                                                <!--Status-->
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">      
                                                            <span class="input-group-text" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Return Status</span>
                                                        </div>
                                                        <select required class="form-control form-control-sm" name="retType" id="retType" />
                                                        <option value="">Choose</option>
                                                            <option value="pending">pending</option>
                                                            <option value="partially resolved">partially resolved</option>
                                                        </select>
                                                    </div>
                                                    </div>
                                                <br>
                                                <!--Remarks-->
                                                <div class="form-now">
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Remarks</span>
                                                        </div>
                                                        <textarea type="text" name="remarks" id="remarks" class="form-control form-control-sm" rows="1"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">      
                                                            <span class="input-group-text" style="width:110px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Return Quantity</span>
                                                        </div>
                                                       <input type="number" required name="returnQty" id="returnQty" min="1" class="form-control form-control-sm"/>
                                                </div>
                                                 <!--item unit-->
                                                 <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:90px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Unit</span>
                                                        </div>
                                                        <select class="form-control form-control-sm" name="returnUnit" id="returnUnit">
                                                        <option value="">Choose</option>
                                                            <option value="pack">pack</option>
                                                            <option value="bottle">bottle</option>
                                                            <option value="others">others</option>
                                                        </select>
                                                </div>
                                                <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">      
                                                            <span class="input-group-text" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Subtotal</span>
                                                        </div>
                                                        <input type="number" name="itemSubtotal" id="itemSubtotal" class="form-control form-control-sm"/>
                                                </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-dismiss="modal">Cancel</button>
                                                    <button type="submit" id="submitReturn" class="btn btn-success btn-sm">Add To Returns</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                </div>
                        <!--End of Modal "Add Transaction"-->
                        <!--Edit Transaction-->
                        <div class="modal fade bd-example-modal-lg" id="editReturns" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Return</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="formEdit" method="post">
                                            <div class="modal-body">
                                            <div class="form-row">
                                                <!--Source Name-->
                                                <input type="hidden" name="einvoID" id="einvoID"/>
                                                <input type="hidden" name="esupID" id="esupID"/>
                                                <!--input type="hidden" name="evar" id="evar"/-->
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">      
                                                            <span class="input-group-text" style="width:100px;background:#3366ff;color:rgb(242, 242, 242);font-size:14px;">
                                                                Supplier</span>
                                                        </div>
                                                        <input type="text"  class="form-control" name="esourceName" id="esourceName" required/>
                                                        <input type="hidden" name="estckID" id="estckID"/>
                                                    </div>
                                                <!--Receipt Number-->
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">      
                                                            <span class="input-group-text" style="width:100px;background:#3366ff;color:rgb(242, 242, 242);font-size:14px;">
                                                                Receipt No.</span>
                                                        </div>
                                                        <input type="text" class="form-control" name="ereceiptNum" id="ereceiptNum" required/>
                                                    </div>
                                                 <!--Status-->
                                                 <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">      
                                                            <span class="input-group-text" style="width:100px;background:#3366ff;color:rgb(242, 242, 242);font-size:14px;">
                                                                Status</span>
                                                        </div>
                                                        <input type="text" class="form-control" name="estatus" id="estatus" required/>
                                                        
                                                    </div>
                                            </div>
                                            <div class="form-row">
                                                <!--returnDate-->
                                                <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:#3366ff;color:rgb(242, 242, 242);font-size:14px;">
                                                                Return Date</span>
                                                        </div>
                                                <input type="date" name="reDate" id="reDate" class="form-control form-control-sm" required/>
                                                </div>
                                                 <!--item unit-->
                                                 <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:120px;background:#3366ff;color:rgb(242, 242, 242);font-size:14px;">
                                                                Date Recorded</span>
                                                        </div>
                                                <input type="text" name="dateRecord" id="dateRecord" class="form-control form-control-sm" required/>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:#3366ff;color:rgb(242, 242, 242);font-size:14px;">
                                                                Total</span>
                                                        </div>
                                                <input type="text" name="eTotal" id="eTotal" class="form-control form-control-sm" required/>
                                                </div>
                                                <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:#3366ff;color:rgb(242, 242, 242);font-size:14px;">
                                                                Remarks</span>
                                                        </div>
                                                <input type="text" name="eRemarks" id="eRemarks" class="form-control form-control-sm" />
                                                </div>
                                                </div>
                                                <br>
                                                 <!--Transaction Items-->
                                                
                                                <table class="returnsItemsTable table table-sm table-borderless">
                                                    <!--Table containing the different input fields in adding trans items -->
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th width="30%">Items Name/s</th>
                                                            <th>Old Returned Qty</th>
                                                            <th>New Returned Qty</th>
                                                            <th>Unit</th>
                                                            <th>Price</th>
                                                            <th>Subtotal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                               
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-dismiss="modal">Cancel</button>
                                                    <button type="submit" id="submitEditedReturn" class="btn btn-success btn-sm">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <!--End ---->
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
//var allReturns = < ?= json_encode($allReturns)?>;
var retItems = <?= json_encode($retItems)?>;
var invRet = <?= json_encode($invRet)?>;
var invoice = [];
var returns= [];
var invoSup = [];
var invoiceitems = [];
$(function(){
    $.ajax({
            url: '<?= base_url("admin/transactions/getReturns")?>',
            dataType: 'json',
            success: function(data){
                var retLastIndex = 0;
                var invoLastIndex = 0;
                $.each(data.invoice, function(index, item){
                    invoice.push({"invoice" : item});
                    invoice[index].returns = data.returns.filter(ret => ret.iID == item.iID);
                });
                showTableReturns();

                $.each(data.invoSup, function(index, item){
                    invoSup.push({"invoSup" : item});
                    invoSup[index].invoiceitems = data.invoiceitems.filter(invo => invo.iID == item.iID);
                });
                showItems();
                console.log('Success');
            },
            error: function(response,setting, errorThrown){
                console.log(errorThrown);
                console.log(response.responseText);
            }
        });
}); 
function showTableReturns(){
        invoice.forEach(function(item){
            var tableRow = `
                            <tr data-id="${item.invoice.iID}">
                                <td><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></td>
                                <td>${item.invoice.iNumber}</td>
                                <td>${item.invoice.spName}</td>
                                <td>${item.invoice.iDate}</td>
                                <td><span class="fs-24">₱</span>${item.invoice.iTotal}</td>
                                <td>${item.invoice.resolvedStatus}</td>
                                <td>
                                    <button id="editBtn" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editReturns">Edit</button>
                                    <!--button class="deleteBtn btn btn-sm btn-danger" data-toggle="modal" data-target="#delete">Delete</button-->
                                </td>
                            </tr>
                        `;
            var returnItemsDiv = `
                        <div class="returns">
                        <span>Date Recorded: </span>${item.invoice.iDateRecorded}
                        <div style="overflow:auto">
                        <span style="float:left;margin-right:1%">Remarks:</span><p style="float:left">${item.invoice.iRemarks}</p> <!--Remarks of Invoice-->
                        </div>
                        <table class="table">
                            <tr>
                                <thead style="background:white">
                                <tr>
                                    <th>Item Name</th>
                                    <th>Unit</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Subtotal</th>
                                </tr>
                                </thead>
                        <tbody>
                ${item.returns.map(ret => {
                        return `
                        <tr>
                            <td>${ret.iName}</td>
                            <td>${ret.iUnit}</td>
                            <td>${ret.iQty}</td>
                            <td><span class="fs-24">₱</span>${ret.iPrice}</td>
                            <td><span class="fs-24">₱</span>${ret.iSubTotal}</td>
                        </tr>
                        `;
                    }).join('')}
                    </tbody>
                </table>
                </div>
            `;
            var accordion = `
            <tr class="accordion" style="display:none">
                <td colspan="8">
                <div class="container" style="display:none">
                <div class="returnItems">
                
                </div>
                </div>
                </td>
            </tr>
            `;
           
            $("#transTable > tbody").append(tableRow);
            $("#transTable > tbody").append(accordion);
            $(".returnItems").last().append(returnItemsDiv);
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
$("button#editBtn").on("click", function() {
            $("#editReturns form")[0].reset();
            $("#editReturns .returnsItemsTable > tbody").empty();
            var retid = $(this).closest("tr").attr("data-id");
            console.log(retid);
            var suplier = retItems.filter(function(s){
                return s.iID == retid;
            });
            console.log(suplier);
          showEditModal($("#editReturns"),invRet.filter(item => item.iID === retid)[0],retItems.filter(invIt => invIt.iID === retid));
        }); 
}

function showEditModal(modal, allinvoice, invoiceItems){
    console.log(allinvoice.spID, allinvoice.vID, allinvoice.iRemarks);
    var count=0;
    modal.find("input[name='einvoID']").val(allinvoice.iID);
    modal.find("input[name='esupID']").val(allinvoice.spID);
    modal.find("input[name='ereceiptNum']").val(allinvoice.iNumber);
    modal.find("input[name='esourceName']").val(allinvoice.spName);
    modal.find("input[name='estckID']").val(allinvoice.stID);
    modal.find("input[name='estatus']").val(allinvoice.resolvedStatus);
    modal.find("input[name='reDate']").val(allinvoice.iDate);
    modal.find("input[name='dateRecord']").val(allinvoice.iDateRecorded);
    modal.find("input[name='eTotal']").val(allinvoice.iTotal);
    modal.find("input[name='eRemarks']").val(allinvoice.iRemarks);

    invoiceItems.forEach(invIt =>{
        console.log(invIt.stName, invIt.iQty,invIt.iUnit, invIt.vID);
        modal.find(".returnsItemsTable > tbody").append(`
        <tr class="returnsItems" data-id="${invIt.iItemID}" data-varid="${invIt.vID}" data-stckID="${invIt.stID}">
         <td><input type="text" name="eitemName" value="${invIt.stName}" class="form-control form-control-sm"></td>
         <td><input type="number" name="eoldQty" value="${invIt.iQty}" class="form-control form-control-sm" readonly></td>
         <td><input type="number" id="eitemQuantity" name="eitemQty"  onchange="computeSubtotal()" min="1" class="form-control form-control-sm" required></td>
         <td><input type="text" name="eitemUnit" value="${invIt.iUnit}" class="form-control form-control-sm"></td>
         <td><input type="number" id="eitemPrice" name="eitemPrice" value="${invIt.iPrice}" class="form-control form-control-sm"></td>
         <td><input type="number" id="eitemSubtotal" name="eitemSubtotal" value="${invIt.iSubTotal}" class="form-control form-control-sm"></td>
     </tr>
        `);
        
    })
}
function showItems(){
        invoSup.forEach(function(item){
            var tableInvoice = `
                            <tr data-invoiceId="${item.invoSup.iID}">    
                                <td>${item.invoSup.iNumber}</td>
                                <td>${item.invoSup.spName}</td>
                                <td>${item.invoSup.iDate}</td>
                                <td><span class="fs-24">₱</span>${item.invoSup.iTotal}</td>
                                <td>${item.invoSup.iType}</td>
                                <td><img class="accordionBtnInvoice" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></td>
                            </tr>    
                                `;
            var invitems = `
                ${item.invoiceitems.map(invo => {
                        return `
                        <tr data-invoiceId="${invo.iID}">
                            <td>${invo.iName}</td>
                            <td>${invo.iQty}&nbsp;${invo.iUnit}</td>
                            <td><span class="fs-24">₱</span>${invo.iPrice}</td>
                            <td><span class="fs-24">₱</span>${invo.iSubTotal}</td>
                            <td><button type="button" id="addBtn" data-toggle="modal" data-target="#newTransaction" class="btn btn-sm btn-primary" value="${invo.iID}">Select</button></td>
                        </tr>
                        `;
                    }).join('')}
            `;
            var accordion = `
            <tr class="accordion" style="display:none">
                <td colspan="8">
                <div class="container" style="display:none">
                <div class="invoiceItems">
                <table class="table">
                        <tr>
                            <thead style="background:white">
                            <tr>
                                <th>Item Name</th>
                                <th>Unit</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                </table>
                </div>
                </div>
                </td>
            </tr>
            `;
            $("#brochure > tbody").append(tableInvoice);
            $("#brochure > tbody").append(accordion);
            $(".invoiceItems table.table > tbody").last().append(invitems);
        });
    $(".accordionBtnInvoice").on('click', function(){
    if($(this).closest("tr").next(".accordion").css("display") == 'none'){
        $(this).closest("tr").next(".accordion").css("display","table-row");
        $(this).closest("tr").next(".accordion").find("td > div").slideDown("slow");
    }else{
        $(this).closest("tr").next(".accordion").find("td > div").slideUp("slow");
        $(this).closest("tr").next(".accordion").hide("slow");
    }
    });
$('button#addBtn').on('click', function(e){
    var id = $(this).val();
        $('#newTransaction').modal('show');
        showAddModal(id);
    });
}


function showAddModal(id){
    console.log(id);
        $.ajax({
            url: '<?= base_url("admin/transactions/getReturns")?>',
            type: 'POST',
            dataType: 'json',
            data: {'id' : id},
            success: function(data){
                document.getElementById('invoID').value = data.selected[0].iID;
                document.getElementById('supID').value = data.selected[0].spID;
                document.getElementById('variance').value = data.selected[0].vID;
                document.getElementById('stckID').value = data.selected[0].stID;
                document.getElementById('sourceName').value = data.selected[0].spName;
                document.getElementById('transType').value = data.selected[0].iType;
                document.getElementById('receiptNum').value = data.selected[0].iNumber;
                document.getElementById('itemName').value = data.selected[0].stName;
                document.getElementById('itemQty').value = data.selected[0].iQty;
                document.getElementById('itemUnit').value = data.selected[0].iUnit;
                document.getElementById('itemPrice').value = data.selected[0].iPrice;

                $('#returnQty').keyup(function(){
                    var x = $('#returnQty').val();
                var y = $('#itemPrice').val();
                var subtotal = x * y;
                    $('#itemSubtotal').val(subtotal);
                });

            },
            error: function(response,setting, errorThrown){
                console.log(errorThrown);
                console.log(response.responseText);
            }
        });
    }

$('#editReturns form#formEdit').on('submit', function(e){
    event.preventDefault();
        var eID=$(this).find("input[name='einvoID']").val();
        var eSpID=$(this).find("input[name='esupID']").val();
        var eRNum=$(this).find("input[name='ereceiptNum']").val();
        var eSName=$(this).find("input[name='esourceName']").val();
        var eStID=$(this).find("input[name='estckID']").val();
        var eStat=$(this).find("input[name='estatus']").val();
        var eRDate=$(this).find("input[name='reDate']").val();
        var eDRec=$(this).find("input[name='dateRecord']").val();
        var eTotal=$(this).find("input[name='eTotal']").val();
        var eRemarks=$(this).find("input[name='eRemarks']").val();
        var eType = 'return';

        var edited = [];
        for (var index = 0; index < $(this).find(".returnsItemsTable > tbody").children().length; index++) {
            var row = $(this).find(".returnsItemsTable > tbody > tr").eq(index);
            edited.push({
                itemID : parseInt(row.attr('data-id')),
                varId : parseInt(row.attr('data-varid')),
                stckId : parseInt(row.attr('data-stckID')),
                itName : row.find("input[name='eitemName']").val(),
                itQty :  row.find("input[name='eitemQty']").val(),
                itUnit: row.find("input[name='eitemUnit']").val(),
                itPri: row.find("input[name='eitemPrice']").val(),
                itSub: row.find("input[name='eitemSubtotal']").val()
            });
        }
        console.log(eID, eRemarks);
        $.ajax({
            url: "<?= site_url("admin/returntransactions/edit")?>",
            method: "POST",
            data : {
                'eID' : eID,
                'eSpID' : eSpID,
                'eRNum' : eRNum,
                'eSName' : eSName,
                'eStID' : eStID,
                'eStat' : eStat,
                'eRDate' : eRDate,
                'eDRec' : eDRec,
                'eTotal' :  eTotal,
                'eRemarks' : eRemarks,
                'eType' : eType,
                'eRetIt' : JSON.stringify(edited)
                    },
            //dataType: "json",
            success: function(data) {
                console.log(data);
                location.reload();
                alert('Updated');
            },
            complete: function() {
                $("#editReturns").modal("hide");
            },
            error: function(response,setting, errorThrown){
                console.log(errorThrown);
                console.log(response.responseText);
            }
        });
});

$('#newTransaction form#addReturns').on('submit', function(e){
    event.preventDefault();
    var returnQty = document.getElementById("returnQty").value;
    var returnUnit = document.getElementById("returnUnit").value;
    var supID = document.getElementById("supID").value;
    var retDate = document.getElementById("retDate").value;
    var receiptNum = document.getElementById("receiptNum").value;
    var remarks = document.getElementById("remarks").value;
    var retType = document.getElementById("retType").value;
    var itemName = document.getElementById("itemName").value;
    var itemSubtotal = document.getElementById("itemSubtotal").value;
    var variance = document.getElementById("variance").value;
    var stckID = document.getElementById("stckID").value;
    var itemPrice = document.getElementById("itemPrice").value;

console.log(returnQty, returnUnit,supID, retDate, receiptNum,remarks,retType,itemName,itemSubtotal,variance,stckID,itemPrice);
   $('#newTransaction').modal('hide');
    $.ajax({
            url: '<?= base_url("admin/returns/add")?>',
            type: 'POST',
            data: {
                'reQty' : returnQty,
                'reUnit' : returnUnit,
                'supID' : supID,
                'dateRet' : retDate,
                'receipt' : receiptNum,
                'remarks' : remarks,
                'reStat' : retType,
                'stckName' : itemName,
                'subtotal' : itemSubtotal,
                'variance' : variance,
                'stckID' : stckID,
                'cost' : itemPrice
                },
            success: function(data){
                location.reload();
                alert('Successful');

            },
            error: function(response,setting, errorThrown){
                console.log(errorThrown);
                console.log(response.responseText);
            }
        });
    });
function computeSubtotal(){
    var quantity = $("#eitemQuantity").val();
    var price = $("#eitemPrice").val();
     var subtotal= quantity * price;
     $("#eitemSubtotal").val(subtotal);
     $("input[name='eTotal']").val(subtotal);
}
</script>
