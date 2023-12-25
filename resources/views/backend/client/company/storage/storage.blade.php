@extends('layouts.client')

@section('title')
    storage
@endsection

@section('content')
            
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">{{ __('general.company') }} /</span> {{ __('general.storage') }}
</h4>


<div class="row">
    <div class="col-12 order-5">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="card-title mb-0">
                <h5 class="m-0 me-2">{{ __('general.delivary order') }}</h5>
                </div>
            </div>
            <div class="card-datatable table-responsive">

                <table class="table yajra-datatable" id="deliveryOrder">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('general.Arrival Date') }}</th>
                            <th>{{ __('general.starting route') }}</th>
                            <th>{{ __('general.ending route') }}</th>
                            <th>{{ __('general.project') }}</th>
                            <th>{{ __('general.status') }}</th>
                            {{-- <th>{{ __('general.progress') }}</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready( function () {

        var table = $('#deliveryOrder').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('client.storage.GetDeliveryOrder', $company->id) }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'arivalDate', name: 'arivalDate'},
                {data: 'starting', name: 'starting'},
                {data: 'ending', name: 'ending'},
                {data: 'project', name: 'project'},
                {data: 'status', name: 'status'},
                // {
                //     data: 'progress', 
                //     name: 'progress', 
                //     orderable: true, 
                //     searchable: true,
                // },
            ],
            dom: 'Bfrtip'
        });

    });
</script>
@endsection