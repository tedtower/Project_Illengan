<table>
    <th>
        <tr>
            <td>Discount Code</td>
            <td>Name</td>
            <td>Discount Percentage</td>
            <td>Discounted Items</td>
            <td>Actions</td>
        </tr>
    </th>
    <tbody>
    <?php
    if(isset($discount)){
        $count=0;
        foreach($discount as $discount_item){
    ?>
        <tr>
            <td class="dc_code"><?php echo $discount_item['dc_id']?></td>
            <td class="dc_name"><?php echo $discount_item['dc_name']?></td>
            <td class="dc_perc"><?php echo $discount_item['dc_percentage']?></td>
            <td class="dc_items"><?php echo $discount_item['dc_count']?></td>
            <td>
                <button class="myViewBtn" data-idx="<?php echo $count?>">View</button>
                <button class="myEditBtn" data-idx="<?php echo $count?>">Edit</button>
                <button class="myRemBtn" data-id="<?php echo $discount_item['dc_id']?>">Remove</button>
            </td>
        </tr>
    <?php
        $count++;
        }
    }
    ?>
    </tbody>
</table>
<script>
$(document).ready(function(){
    $(".myViewBtn").on("click",function(){
        var index = $(this).attr('data-idx');
        
    });
    $(".myEditBtn").on("click",showEditModal());
    $(".myRemBtn").on("click",showRemModal());
});
</script>