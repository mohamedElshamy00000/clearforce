@extends('layouts.backend')
@section('title')
    transactions
@endsection
@section('content')

<div class="card mb-4">
    <div class="card-widget-separator-wrapper">
        <div class="card-body card-widget-separator">
            <div class="row gy-4 gy-sm-1">
                <div class="col-sm-6 col-lg-3">
                    <div class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                        <div>
                            
                            <h3 class="mb-1">{{ $allInvoices }}</h3>
                            <p class="mb-0">Transactions</p>
                        </div>
                        <span class="avatar me-lg-4">
                            <span class="avatar-initial bg-label-secondary rounded"><i class="ti ti-file-invoice ti-md"></i></span>
                        </span>
                    </div>
                    <hr class="d-none d-sm-block d-lg-none">
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                        <div>
                            <h4 class="mb-1">{{ $unPaidInvoices }} SAR</h4>
                            <p class="mb-0">UnPaid</p>
                        </div>
                        <span class="avatar me-sm-4">
                            <span class="avatar-initial bg-label-secondary rounded"><i class="ti ti-cash-off ti-md"></i></span>
                        </span>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                        <div>
                            <h4 class="mb-1">{{ $paidInvoices }} SAR</h4>
                            <p class="mb-0">Paid</p>
                        </div>
                        <span class="avatar me-sm-4">
                            <span class="avatar-initial bg-label-secondary rounded"><i class="ti ti-checks ti-md"></i></span>
                        </span>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h4 class="mb-1">{{ $withdrawInvoices }} SAR</h4>
                            <p class="mb-0">Withdraw</p>
                        </div>
                        <span class="avatar">
                            <span class="avatar-initial bg-label-secondary rounded"><i class="ti ti-arrow-up ti-md"></i></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">

    <!-- Column Search -->
    <div class="">
        <table class="table yajra-datatable" id="result2">
            <thead>
                <tr>
                    <th>user</th>
                    <th>type</th>
                    <th>amount</th>
                    <th>description</th>
                    <th>date</th>
                    <th>status</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <!--/ Column Search -->

</div>

@endsection

@section('script')
<script>
    $(document).ready( function () {

        var table = $('#result2').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('getTransactions') }}",
            columns: [
                // {data: 'id', name: 'id'},
                {data: 'user', name: 'user'},
                {data: 'type', name: 'type'},
                {data: 'amount', name: 'amount'},
                {data: 'description', name: 'description'},
                {data: 'date', name: 'date'},
                {
                    data: 'status', 
                    name: 'status', 
                    orderable: true, 
                    searchable: true,
                },
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false,
                }
            ],
            dom: 'Bfrtip'
        });

    });

</script>
@endsection