    <!-- Modal -->
    <div class="modal fade" id="payoutShowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Payout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
            
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                        <div class="d-flex gap-2 align-items-center">
                            <i class="ti ti-building-bank"></i>
                            <h6 class="m-0" id="data-type"></h6>
                        </div>
                        <h6 class="m-0 d-none d-sm-block">IBAN : <span id="data-iban"></span></h6>
                    </div>
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="display: none !important" id="transaction_id">
                        <div class="d-flex gap-2 align-items-center">
                            <i class="ti ti-file-invoice"></i>
                            <h6 class="m-0" >transaction id : <span id="data-transaction_id"></span></h6>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                        <div class="d-flex gap-2 align-items-center">
                            <i class="ti ti-world"></i>
                            <h6 class="m-0"><span id="data-country"></span></h6>
                        </div>
                        <h6 class="m-0 d-none d-sm-block">Amount : <span id="data-amount"></span> <sup>SAR</sup></h6>
                    </div>

                    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                        <div class="d-flex gap-2 align-items-center">
                            <i class="ti ti-zoom-money"></i>
                            <h6 class="m-0">Purpose : <span id="data-purpose"></span></h6>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <a href="" id="withdrawAccept" class="btn btn-primary waves-effect waves-light" >Approve</a>
                </div>
            </div>
        </div>
    </div>