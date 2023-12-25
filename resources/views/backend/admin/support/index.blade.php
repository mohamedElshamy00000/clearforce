@extends('layouts.backend')
@section('navicon') <i class="menu-icon ti ti-lifebuoy"></i> @endsection

@section('title')
Help Center
@endsection
@section('content')

<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>all tickets</span>
              <div class="d-flex align-items-center my-1">
                <h4 class="mb-0 me-2">{{ $tickets->count() }}</h4>
              </div>
            </div>
            <span class="badge bg-label-dark rounded p-2">
                <i class="ti ti-ticket ti-sm"></i>
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
                    <span>active tickets</span>
                    <div class="d-flex align-items-center my-1">
                        <h4 class="mb-0 me-2">{{ $tickets->where('status', 1)->count() }}</h4>
                    </div>
                </div>
                <span class="badge bg-label-dark rounded p-2">
                    <i class="ti ti-ticket ti-sm"></i>
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
                    <span>closed tickets</span>
                    <div class="d-flex align-items-center my-1">
                        <h4 class="mb-0 me-2">{{ $tickets->where('status', 3)->count() }}</h4>
                    </div>
                </div>
                <span class="badge bg-label-dark rounded p-2">
                    <i class="ti ti-ticket ti-sm"></i>
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
                    <span>on-hold tickets</span>
                    <div class="d-flex align-items-center my-1">
                    <h4 class="mb-0 me-2">{{ $tickets->where('status', 2)->count() }}</h4>
                    </div>
                </div>
                <span class="badge bg-label-dark rounded p-2">
                    <i class="ti ti-ticket ti-sm"></i>
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
        <table class="table yajra-datatable" id="tickets">
            <thead>
                <tr>
                    <th>id</th>
                    <th>user</th>
                    <th>title</th>
                    <th>project</th>
                    <th>priority</th>
                    <th>category</th>
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

        var table = $('#tickets').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('admin.getTickets') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'user', name: 'user'},
                {data: 'title', name: 'title'},
                {data: 'project', name: 'project'},
                {data: 'priority', name: 'priority'},
                {data: 'category', name: 'category'},
                {data: 'date', name: 'date'},
                {
                    data: 'status', 
                    name: 'status', 
                    orderable: true, 
                    searchable: true,
                } 
            ],
            dom: 'Bfrtip',
            
        });

    });

</script>
@endsection