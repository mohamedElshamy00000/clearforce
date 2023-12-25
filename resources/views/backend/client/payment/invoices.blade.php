@extends('layouts.client')
@section('title')
{{ __('general.My_Invoices') }}
@endsection
@section('content')

<h4 class="fw-bold py-3"><span class="text-muted fw-light">{{ __('general.payment') }} /</span> {{ __('general.My_Invoices') }}</h4>

<!-- Project Cards -->
<div class="row g-4">

    <div class="card">

        <!-- Column Search -->
        <div class="">
            <table class="table yajra-datatable" id="proposals">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('general.Amount') }}</th>
                        <th>{{ __('general.discount') }}</th>
                        <th>{{ __('general.comment') }}</th>
                        <th>{{ __('general.project') }}</th>
                        <th>{{ __('general.date') }}</th>
                        <th>{{ __('general.status') }}</th>
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
            ajax: "{{ route('clientGetInvoices') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'amount', name: 'amount'},
                {data: 'discount', name: 'discount'},
                {data: 'comment', name: 'comment'},
                {data: 'project', name: 'project'},
                {data: 'date', name: 'date'},
                {
                    data: 'status', 
                    name: 'status', 
                    orderable: true, 
                    searchable: true,
                },
            ],
            dom: 'Bfrtip'
        });

    });

</script>
@endsection