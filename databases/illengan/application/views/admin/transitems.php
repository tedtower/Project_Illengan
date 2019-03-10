<?php
                if(!empty($transitems)){
                ?>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php 
                    while($transitems[$lastIndex]['trans_id'] == $transaction['trans_id']){                      
                            $lastindex++;
                ?>
                        <tr>
                            <td><?php echo $transitems[$lastIndex]['item_name']?></td>
                            <td><?php echo $transitems[$lastIndex]['item_qty']?></td>
                            <td><?php echo $transitems[$lastIndex]['item_unit']?></td>
                            <td><?php echo $transitems[$lastIndex]['item_price']?></td>
                            <td><?php echo $transitems[$lastIndex]['total_price']?></td>
                        </tr>                
                <?php
                    }
                ?>
                        <tr class="Total Amount"><td colspan="4">Total Amount: </td><td><?php echo $transaction['trans_amt']?></td></tr>
                    </tbody>
                </table>
                <?php
                }else{
                ?>
                    <p>There are no Transaction Items recorded!!</p>     
                <?php               
                }
                ?>