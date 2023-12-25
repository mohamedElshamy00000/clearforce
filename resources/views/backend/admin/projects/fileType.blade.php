@extends('layouts.backend')
@section('title')
    Product Type
@endsection

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Projects /</span> File Type</h4>
<div class="row">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0"><span id="actiontype">Add</span> Type</h5>
            </div>
            <div class="card-body">
                {{-- add form --}}
              <form action="{{ route('product.file.type.store') }}" method="POST" id="addForm">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="name_en">Name en</label>
                    <input type="text" class="form-control @error('name_en') is-invalid @enderror" value="{{ old('name_en') }}" name="name_en" placeholder="">
                    @error('name_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="name_ar">Name ar</label>
                    <input type="text" class="form-control @error('name_ar') is-invalid @enderror" value="{{ old('name_ar') }}" name="name_ar" placeholder="">
                    @error('name_ar')
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
              <form action="{{ route('product.file.type.update') }}" method="POST" id="editForm" style="display: none">
                @csrf
                <input type="hidden" name="id" id="id" >
                <div class="mb-3">
                    
                    <label class="form-label" for="name_en">Name en</label>
                    <input type="text" class="form-control @error('name_en') is-invalid @enderror" value="{{ old('name_en') }}" name="name_en" id="name_en" placeholder="">
                    @error('name_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="name_ar">Name ar</label>
                    <input type="text" class="form-control @error('name_ar') is-invalid @enderror" value="{{ old('name_ar') }}" name="name_ar" id="name_ar" placeholder="">
                    @error('name_ar')
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
                <table class="table yajra-datatable" id="projectFileTypes">
                    <thead>
                        <tr>
                            <th>name en</th>
                            <th>name ar</th>
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
    function changeToEdit(id, name_en,name_ar, status) {
        $('#editForm').show();
        $('#addForm').hide();
        $('#name_en').val(name_en);
        $('#name_ar').val(name_ar);
        $('#actiontype').html('Edit');
        // <span id="actiontype">Add</span>
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
        var table = $('#projectFileTypes').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('getProductFileTypes') }}",
            columns: [
                {data: 'name_en', name: 'name_en'},
                {data: 'name_ar', name: 'name_ar'},
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