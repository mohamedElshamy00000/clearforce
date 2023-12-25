@extends('layouts.backend')
@section('title')
Q&A categories
@endsection

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Q&A /</span>categories</h4>
<div class="row">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0"><span id="actiontype">Add</span></h5>
            </div>
            <div class="card-body">
                {{-- add form --}}
              <form action="{{ route('QAcategorys.store') }}" method="POST" id="addForm">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" placeholder="">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-check m-0">
                        <input type="checkbox" class="form-check-input" name="status" value="1" checked/>
                        <span class="form-check-label">Status</span>
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>
                </div>
                <button type="submit" class="btn btn-primary waves-effect waves-light w-100">Save</button>
              </form>
              {{-- edit form --}}
              <form action="{{ route('QAcategorys.update') }}" method="POST" id="editForm" style="display: none">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="name">Name</label>
                    <input type="hidden" name="id" id="id" >
                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" id="name" placeholder="">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-check ps-0">
                        <label class="col-md-12 col-form-label">status</label>
                        <select class="form-select" name="status">
                            <option value="0" id="statusfalse">no</option>
                            <option value="1" id="statustrue">yes</option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </label>
                </div>
                <button type="submit" class="btn btn-primary waves-effect waves-light w-100">Save</button>
              </form>

            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="table-responsive text-nowrap mb-3">
                <table class="table yajra-datatable" id="category">
                    <thead>
                        <tr>
                            <th>name</th>
                            <th>date</th>
                            <th>status</th>
                            <th>Action</th>
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
    function changeToEdit(id, name, status) {
        $('#editForm').show();
        $('#addForm').hide();
        $('#name').val(name);
        $('#actiontype').html('Edit');
        $('#id').val(id);
        if (status == 1) {
            $('#statustrue').attr('selected','selected');
            $('#statusfalse').attr('selected', false)
        } else {
            $('#statusfalse').attr('selected','selected');
            $('#statustrue').attr('selected', false)
        }
    }

    $(document).ready( function () {
        var table = $('#category').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('get.QAcategorys') }}",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'date', name: 'date'},
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
@endpush