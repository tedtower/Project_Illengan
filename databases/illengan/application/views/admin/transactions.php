<!-- ADD Transaction Modal -->
<div id="addModal">
    <div>
        <span>Add Transaction</span>
    </div>
    <div>
        <form>
            <div>
                <div class="form-group row">
                    <label for="receipt_no">Receipt No.: </label>
                    <input type="text" class="form-control" id="receipt_no" name="receipt_no" value="" />
                </div>
                <div class="form-group row">
                    <label for="supplier">Supplier: </label>
                    <select id="supplier" name="supplier">
                        <option value=""></option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="trans_date">Transaction Date</label>
                    <input type="date" class="form-control" id="trans_date" name="trans_date" value="" />
                </div>
                <div class="form-group row">
                    <label for="trans_amt">Amount</label>
                    <input type="text" class="form-control" id="trans_amt" name="trans_amt" value="0.00" />
                </div>
                <div class="form-group row">
                    <label for="remarks">Remarks</label>
                    <textarea class="form-control" id="remarks" name="remarks"></textarea>
                </div>
            </div>
            <div>
                <button type="reset" class="btn btn-secondary">Cancel</button>
                <button type="submit" class="btn btn-success"
                    formaction="<?php echo site_url('admin/transactions/add')?>">Submit</button>
            </div>
        </form>
    </div>
</div>
<!-- END ADD MODAL -->
<!-- EDIT Modal -->
<div id="editModal">
    <div>
        <span>Edit Transaction</span>
    </div>
    <div>
        <form>
            <div>
                <div class="form-group row">
                    <label for="receipt_no">Receipt No.: </label>
                    <input type="text" class="form-control" id="receipt_no" name="receipt_no" value="" />
                </div>
                <div class="form-group row">
                    <label for="supplier">Supplier: </label>
                    <select id="supplier" name="supplier">
                        <option value=""></option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="trans_date">Transaction Date</label>
                    <input type="date" class="form-control" id="trans_date" name="trans_date" value="" />
                </div>
                <div class="form-group row">
                    <label for="trans_amt">Amount</label>
                    <input type="text" class="form-control" id="trans_amt" name="trans_amt" value="0.00" />
                </div>
                <div class="form-group row">
                    <label for="remarks">Remarks</label>
                    <textarea class="form-control" id="remarks" name="remarks"></textarea>
                </div>
            </div>
            <div>
                <button type="reset" class="btn btn-secondary">Cancel</button>
                <button type="submit" class="btn btn-primary"
                    formaction="<?php echo site_url('admin/transactions/add')?>">Submit</button>
            </div>
        </form>
    </div>
</div>
<!-- END EDIT MODAL -->
<div>
<button id="samplebutton">button</button>
    <table id="mytable">
        <thead>
            <tr>
                <th>Receipt No.</th>
                <th>Supplier</th>
                <th>Transaction Date</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if(!empty($transactions)){
                $lastIndex = 0;
                foreach($transactions as $transaction){
        ?>
            <tr>
                <td><?php echo $transaction['receipt_no']?></td>
                <td><?php echo $transaction['source_name']?></td>
                <td><?php echo $transaction['trans_date']?></td>
            </tr>
            <div>
                <div>
                    <span>Date Recorded:</span>
                    <span><?php echo $transaction['date_recorded']?></span>
                </div>                
                <div>
                    <span>remarks:</span>
                    <p><?php echo $transaction['remarks']?></p>
                </div>                
            </div>
        <?php
                }
            }
        ?>
        </tbody>
    </table>
</div>
<script>
$(function(){
    $('#samplebutton').on('click', function(){
        $.ajax({
            url: '<?php echo site_url('admin/sample')?>',
            data: { id : 1 },
            dataType: 'json',
            success: function(response){
                console.log(response);
            }
        });
    });
});
</script>