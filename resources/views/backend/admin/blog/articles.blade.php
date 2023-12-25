@extends('layouts.backend')
@section('navicon') <i class="menu-icon tf-icons ti ti-clipboard"></i>  @endsection

@section('title')
    Articles
@endsection
@section('content')

<h4 class="py-3 mb-2 d-flex align-content-center justify-content-between">
    <div><span class="text-muted fw-light">Blog /</span> Articles</div>
    <a href="{{ route('admin.add.articles') }}" class="btn btn-primary">Add new</a>
</h4>

<div class="card">

    <!-- Column Search -->
    <div class="">
        <table class="table yajra-datatable" id="projects">
            <thead>
                <tr>
                    <th>title</th>
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
            ajax: "{{ route('admin.getArticles') }}",
            columns: [
                {data: 'title', name: 'title'},
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