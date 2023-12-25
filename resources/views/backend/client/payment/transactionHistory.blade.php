@extends('layouts.client')
@section('title')
    transactions
@endsection
@section('content')

<div class="card mb-4">
    <div class="card-widget-separator-wrapper">
        <div class="card-body card-widget-separator">
            <div class="row gy-4 gy-sm-1">
                <div class="col-sm-6 col-lg-4">
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
                <div class="col-sm-6 col-lg-4">
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
                <div class="col-sm-6 col-lg-4">
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
            </div>
        </div>
    </div>
</div>

<div class="card">

    <!-- Column Search -->
    <div class="">
        <table class="table yajra-datatable" id="clienttranactions">
            <thead>
                <tr>
                    <th>#</th>
                    <th>type</th>
                    <th>amount</th>
                    <th>description</th>
                    <th>date</th>
                    <th>status</th>
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

        var table = $('#clienttranactions').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('client.payment.getMyTransactions') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'type', name: 'type'},
                {data: 'amount', name: 'amount'},
                {data: 'description', name: 'description'},
                {data: 'date', name: 'date'},
                {
                    data: 'status', 
                    name: 'status', 
                    orderable: true, 
                    searchable: true,
                }
            ],
            dom: 'Bfrtip'
        });

    });

</script>
@endsection