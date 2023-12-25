@extends('layouts.backend')
@section('navicon') <i class="menu-icon tf-icons ti ti-users"></i> @endsection

@section('title')
  Clients
@endsection
@section('content')

{{-- LTV – Customer Lifetime Value
CAC – Customer Acquisition Cost
CRR – Customer Retention Rate --}}

<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>clients</span>
              <div class="d-flex align-items-center my-1">
                <h4 class="mb-0 me-2">{{ $clients->count() }}</h4>
                {{-- <span class="text-success">(+29%)</span> --}}
              </div>
              <span>Total Users</span>
            </div>
            <span class="badge bg-label-primary rounded p-2">
              <i class="ti ti-user ti-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Paid Users</span>
              <div class="d-flex align-items-center my-1">
                <h4 class="mb-0 me-2">{{ $paidUsers }}</h4>
                {{-- <span class="text-success">(+18%)</span> --}}
              </div>
              <span>Users <small>(has invoices)</small></span>
            </div>
            <span class="badge bg-label-success rounded p-2">
              <i class="ti ti-cash ti-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>CRR <small>Retention Rate</small> </span>
              <div class="d-flex align-items-center my-1">
                <h4 class="mb-0 me-2">...</h4>
                {{-- <span class="text-danger">(-14%)</span> --}}
              </div>
              <span>Total Users</span>
            </div>
            <span class="badge bg-label-success rounded p-2">
              <i class="ti ti-user-check ti-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Client Satisfaction</span>
              <div class="d-flex align-items-center my-1">
                <h4 class="mb-0 me-2"> --- </h4>
                <span class="text-success">0.0</span>
              </div>
              <span>Total Users</span>
            </div>
            <span class="badge bg-label-warning rounded p-2">
              <i class="ti ti-user-exclamation ti-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
</div>
  <!-- Users List Table -->
<div class="card">

    <!-- Column Search -->
    <div class="">
        <table class="table yajra-datatable" id="result">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Company</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>status</th>
                    <th>Action</th>
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

        var table = $('#result').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('getClientData') }}",
            columns: [
                // {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'company', name: 'company'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {
                    data: 'status', 
                    name: 'status', 
                    orderable: true, 
                    searchable: true,
                },
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: true, 
                    searchable: true,
                },
                
                
            ],
            dom: 'Bfrtip'
        });

    });

</script>
@endsection