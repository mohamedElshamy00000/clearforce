@extends('layouts.agent')
@section('title')
    {{ __('general.My_Proposals') }}
@endsection
@section('content')

<h4 class="fw-bold py-3"><span class="text-muted fw-light">{{ __('general.Projects') }} /</span> {{ __('general.My_Proposals') }}</h4>

<!-- Project Cards -->
<div class="row g-4">

    <div class="card">

        <!-- Column Search -->
        <div class="">
            <table class="table yajra-datatable" id="proposals">
                <thead>
                    <tr>
                        <th>{{ __('general.Budget') }}</th>
                        <th>{{ __('general.Note') }}</th>
                        <th>{{ __('general.date') }}</th>
                        <th>{{ __('general.Status') }}</th>
                        <th>{{ __('general.Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <!--/ Column Search -->
    </div>
</div>
<!--/ Project Cards -->

@endsection

@section('script')
<script>
    $(document).ready( function () {

        var table = $('#proposals').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('agentgetProposalsData') }}",
            columns: [
                {data: 'budget', name: 'budget'},
                {data: 'note', name: 'note'},
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
                    orderable: false, 
                    searchable: false,
                },
            ],
            dom: 'Bfrtip'
        });

    });

</script>
@endsection