<div class="modal fade" id="ordered_modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="text-center">
                    <img class="mt-2" src="<?php echo base_url().'assets/media/logo.png'?>" style="height:130px;width:130px">
                    <div class="modal-header">
                        <h1 class="modal-title w-200 delius">Thank you for ordering! </h1>
                    </div>
                
                <div class="modal-body">
                <a class="delius " href="<?php echo site_url("customer/clearOrder")?>">
                <button class="btn btn-dark-green"><h4>Order again</h4></button></a>
                     <br><br><br>
                <a class="delius font-weight-bold" href="<?php echo site_url("customer/checkin")?>">
                <button class="btn btn-dark-green"><h4>New customer</h4></button></a>
                </div>
            </div>
            </div>
        </div>
    </div>
