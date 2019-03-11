 <?php include_once('head.php');include_once('scripts.php')?>
 <!-- Proceed Order Modal -->
    <div class="modal fade" id="proceed_modal" tabindex="-1" role="dialog" aria-labelledby="proceedOrderModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="padding:0px;">
            <!-- Modal Body -->
            <div class="modal-body text-center delius">
                <h3 class="gab">One More Thing</h3>
                <p class="px-2">Please confirm that all the changes made are the final order list to be submitted.</p>
            </div>
            <div class="modal-footer justify-content-center delius">
                <button type="button" class="btn btn-outline-dark-green" data-dismiss="modal">I'm Not Done Yet</button>
                <button type="button" class="btn btn-dark-green" onclick="window.location.href='thankyou.html'">Proceed To Order</button>
            </div>
            </div>
        </div>
    </div>