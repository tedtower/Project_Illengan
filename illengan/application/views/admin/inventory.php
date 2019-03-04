<!-- End of Left Sidebar -->

<!-- Content -->
<!-- ADD INVENTORY ITEM -->
<div id="addmodal">
    <div><span>Add Inventory</span></div>
    <form method="post">
        <div>
            <span>Stock Name: </span>
            <span>Stock Quantity: </span>
            <span>Stock Unit: </span>
            <span>Stock Minimum Quantity: </span>
            <span>Stock Category: </span>
            <span>Stock Status: </span>
        </div>
        <div>
            <input name="stock_name" type="text" value="<?php echo set_value('stock_name');?>">
            <input name="stock_quantity" type="number" value="<?php echo set_value('stock_quantity');?>">
            <input name="stock_unit" type="text" value="<?php echo set_value('stock_unit');?>">
            <input name="stock_minqty" type="number" value="<?php echo set_value('stock_minqty');?>">
            <select name="stock_category">
                <?php
            if(isset($category)){
                foreach($category as $category_item){
            ?>
                <option value="<?php echo $category_item['category_id'];?>"
                    <?php echo set_select('stock_category', $category_item['category_id']);?>>
                    <?php echo $category_item['category_name'];?></option>
                <?php        
                }
            }
            ?>
            </select>
            <select name="stock_status">
                <option value="Available" <?php echo set_select('stock_status', 'Available');?>>Available</option>
                <option value="Unavailable" <?php echo set_select('stock_status', 'Unavailable');?>>Unavailable
                </option>
            </select>
        </div>
        <div>
            <button>Cancel</button>
            <button type="submit" formaction="<?php echo site_url('admin/inventory/add')?>">Add</button>
        </div>
    </form>
</div>
<!-- END ADD INVENTORY ITEM -->
<!-- EDIT INVENTORY ITEM -->
<div id="editmodal">
    <div><span>Edit Inventory</span></div>
    <form method="post">
        <div>
            <span>Stock Code: </span>
            <span>Stock Name: </span>
            <span>Stock Quantity: </span>
            <span>Stock Unit: </span>
            <span>Stock Minimum Quantity: </span>
            <span>Stock Category: </span>
            <span>Stock Status: </span>
        </div>
        <div>
            <span class="text-danger"><?php echo form_error('new_stock_id')?></span>
            <input name="new_stock_id" type="text" value="" readonly>
            <span class="text-danger"><?php echo form_error('new_stock_name')?></span>
            <input name="new_stock_name" type="text" value="">
            <span class="text-danger"><?php echo form_error('new_stock_quantity')?></span>
            <input name="new_stock_quantity" type="number" value="">
            <span class="text-danger"><?php echo form_error('new_stock_unit')?></span>
            <input name="new_stock_unit" type="text" value="">
            <span class="text-danger"><?php echo form_error('new_stock_minqty')?></span>
            <input name="new_stock_minqty" type="number" value="">
            <span class="text-danger"><?php echo form_error('new_stock_category')?></span>
            <select name="new_stock_category">
                <?php
            if(isset($category)){
                foreach($category as $category_item){
            ?>
                <option value="<?php echo $category_item['category_id'];?>">
                    <?php echo $category_item['category_name'];?></option>
                <?php        
                }
            }
            ?>
            </select>
            <span class="text-danger"><?php echo form_error('new_stock_status')?></span>
            <select name="new_stock_status">
                <option value="Available">Available</option>
                <option value="Unavailable">Unavailable</option>
            </select>
        </div>
        <div>
            <button type="reset">Cancel</button>
            <button type="submit" formaction="<?php echo site_url("admin/inventory/edit")?>">OK</button>
        </div>
    </form>
</div>
<!-- END EDIT INVENTORY ITEM -->
<!-- Table -->
<div class="container">
    <table id="table" class="display">
        <thead>
            <tr>
                <th scope="col">Code</th>
                <th scope="col">Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Unit</th>
                <th scope="col">Min Quantity</th>
                <th scope="col">Category</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php 
                    if (isset($stock)){
                        $count=0;
                      foreach ($stock as $stock_item){
                    ?>
            <tr>
                <td class="stock_id"><?php echo $stock_item['stock_id'] ;?></td>
                <td class="stock_name"><?php echo $stock_item['stock_name'];?></td>
                <td class="stock_qty"><?php echo $stock_item['stock_quantity'];?></td>
                <td class="stock_unit"><?php echo $stock_item['stock_unit'];?></td>
                <td class="stock_min"><?php echo $stock_item['stock_minimum'];?></td>
                <td class="category_name"><?php echo $stock_item['category_name'];?></td>
                <td class="stock_status"><?php echo $stock_item['stock_status'];?></td>
                <td>
                    <div class="text-left mt-2">
                        <button class="btn btn-primary btn-xs mb-2 myEditBtn"
                            data-idx="<?php echo $count;?>">Edit</button>
                        <a class="btn btn-success btn-xs mb-2 myRemBtn" href="<?php echo site_url('admin/inventory/delete/'.$stock_item['stock_id'])?>"
                            data-id="<?php echo $stock_item['stock_id']?>">Delete</a>
                    </div>
                </td>
            </tr>
            <?php  
                        $count++;
                        }
                    }
                    ?>
        </tbody>
    </table>
</div>
</body>

</html>
<script>
$(document).ready(function() {
    $('.myEditBtn').on('click', function() {
        showEditModal($(this).attr('data-idx'));
    });

    $('.myRemBtn').on('click', function() {
        showRemModal($(this).attr('data-id'));
    });

});

function showEditModal(index) {
    $("#editmodal").css('display', 'block');
    $("#editmodal input[name='new_stock_id']").val($(".stock_id").eq(index).text());
    $("#editmodal input[name='new_stock_name']").val($(".stock_name").eq(index).text());
    $("#editmodal input[name='new_stock_quantity']").val($(".stock_qty").eq(index).text());
    $("#editmodal input[name='new_stock_unit']").val($(".stock_unit").eq(index).text());
    $("#editmodal input[name='new_stock_minqty']").val($(".stock_min").eq(index).text());
    $("#editmodal input[name='new_stock_status']").val($(".stock_status").eq(index).text());
}

// function showDeleteModal() {
//     $("#deletemodal").css('display','none');
// }
</script>