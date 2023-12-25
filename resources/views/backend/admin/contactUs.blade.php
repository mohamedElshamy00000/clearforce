@extends('layouts.backend')
@section('title')
    Contacts
@endsection

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">contacts /</span> all</h4>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="table-responsive text-nowrap mb-3">
                <table class="table yajra-datatable" id="contacts">
                    <thead>
                        <tr>
                            <th>name</th>
                            <th>email</th>
                            <th>subject</th>
                            <th>message</th>
                            <th>date</th>
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

@push('script')
<script>
    $(document).ready( function () {
        var table = $('#contacts').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.getContacts') }}",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'subject', name: 'subject'},
                {data: 'message', name: 'message'},
                {data: 'created_at', name: 'created_at'},
            ],
            dom: 'Bfrtip'
        });
    });
</script>
@endpush