@extends('layouts.backend')

@section('title')
    Agents Verification Center
@endsection

@section('content')


<div class="card">
    <div class="card-datatable table-responsive">
        <table class="table" id="Verifications">
        <thead>
            <tr>
            <th>agent</th>
            <th>documents</th>
            <th>note</th>
            <th>License number</th>
            <th>date</th>
            <th>Status</th>
            <th>Action</th>
            </tr>
        </thead>
        </table>
    </div>
    </div>
    <!--/ Row grouping -->

@endsection

@section('script')
<script>

$(document).ready( function () {

    var table = $('#Verifications').DataTable({
        processing: true,
        responsive: true,
        serverSide: true,
        ajax: "{{ route('admin.users.getVerifications') }}",
        columns: [
            {data: 'agent', name: 'agent'},
            {data: 'documents', name: 'documents'},
            {data: 'note', name: 'note'},
            {data: 'number', name: 'number'},
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
