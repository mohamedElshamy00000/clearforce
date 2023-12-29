@extends('layouts.backend')
@section('navicon') <i class="menu-icon tf-icons ti ti-clipboard"></i>  @endsection

@section('title')
    Projects
@endsection
@section('content')

<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left w-100">
              <h4 class="mb-0 me-2">{{ $projects->count() }} <span class="mb-0 text-muted fs-6 me-2">All</span></h4>
              <div class="row">
                  <div class="col-md-6">
                    <h4 class="mb-0 me-2">{{ $projects->where('status', 2)->count() }} <span class="mb-0 text-muted fs-6 me-2">Opened</span></h4>
                    
                  </div>
                  <div class="col-md-6">
                    <h4 class="mb-0 me-2">{{ $projects->where('status', 3)->count()  }} <span class="mb-0 text-muted fs-6 me-2">Finished</span></h4>
                  </div>
              </div>
              
            </div>
            <span class="badge bg-label-primary rounded p-2">
              <i class="tf-icons ti ti-clipboard"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-sm-6 col-xl-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Rejected</span>
              <div class="d-flex align-items-center my-1">
                <h4 class="mb-0 me-2">{{ $projects->where('status', 3)->count()  }} <span class="mb-0 text-muted fs-6 me-2">Total Rejected Projects </span></h4>  {{-- rejected statsu 3 --}}
              </div>
            </div>
            <span class="badge bg-label-danger rounded p-2">
              <i class="tf-icons ti ti-clipboard"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-12 col-xl-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span><small>Projects created in last Month</small> </span>
              <div class="d-flex align-items-center my-1">
                <h4 class="mb-0 me-2">{{ $thisMonthProject }}</h4>
                <span class="">({{ $differenceInpercentage }})</span>
              </div>
            </div>
            <span class="badge bg-label-success rounded p-2">
              <i class="ti ti-user-check ti-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
<div class="card">

    <!-- Column Search -->
    <div class="">
        <table class="table yajra-datatable" id="projects">
            <thead>
                <tr>
                    <th>client</th>
                    <th>payment mode</th>
                    <th>Budget</th>
                    <th>Proposals</th>
                    <th>Shipping</th>
                    <th>payment</th>
                    <th>date</th>
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

        var table = $('#projects').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('getProjectsData') }}",
            columns: [
                {data: 'client', name: 'client'},
                {data: 'payment_mode', name: 'payment_mode'},
                
                {data: 'Budget', name: 'Budget'},
                {data: 'Proposals', name: 'Proposals'},
                {data: 'needShiping', name: 'needShiping'},
                {data: 'payemnt', name: 'payemnt'},
                {data: 'created_at', name: 'created_at'},
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