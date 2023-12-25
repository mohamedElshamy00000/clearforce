@extends('layouts.backend')
@section('title')
countries
@endsection

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Projects /</span> Countries</h4>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0"><span id="actiontype">Add</span> Countries</h5>
            </div>
            <div class="card-body">
                {{-- add form --}}
              <form action="{{ route('countrys.store.excel.file') }}" method="POST" id="addForm" enctype="multipart/form-data" @error('name') style="display: none" @enderror>
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="ExcelFile">Excel File</label>
                    <input type="file" class="form-control @error('ExcelFile') is-invalid @enderror" value="{{ old('ExcelFile') }}" name="ExcelFile" placeholder="">
                    @error('ExcelFile')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary waves-effect waves-light ">Upload</button>
              </form>
              {{-- edit form --}}
              <form action="{{ route('countrys.update') }}" method="POST" id="editForm" @error('name') @else  style="display: none" @enderror>
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="name">name</label>
                    <input type="hidden" name="id" id="id" >
                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" id="name" placeholder="">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="code">code</label>
                    <input type="text" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}" name="code" id="code" placeholder="">
                    @error('code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-check ps-0">
                        <label class="col-md-12 col-form-label">import</label>
                        <select class="form-select" name="import">
                            <option value="0" id="importfalse">no</option>
                            <option value="1" id="importtrue">yes</option>
                        </select>
                        @error('import')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </label>
                </div>
                <div class="mb-3">
                    <label class="form-check ps-0">
                        <label class="col-md-12 col-form-label">export</label>
                        <select class="form-select" name="export">
                            <option value="0" id="exportfalse">no</option>
                            <option value="1" id="exporttrue">yes</option>
                        </select>
                        @error('export')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </label>
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
    <div class="col-md-12">
        <div class="card">
            <div class="table-responsive text-nowrap mb-3">
                <table class="table yajra-datatable" id="Countrys">
                    <thead>
                        <tr>
                            <th>name</th>
                            {{-- <th>code</th> --}}
                            <th>import</th>
                            <th>export</th>
                            <th>status</th>
                            {{-- <th>action</th> --}}
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
        var table = $('#Countrys').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            lengthChange: true,
            pageLength: 20,
            ajax: "{{ route('get.country') }}",
            columns: [
                {data: 'name', name: 'name'},
                // {data: 'code', name: 'code'},
                {data: 'import', name: 'import'},
                {data: 'export', name: 'export'},
                {
                    data: 'status', 
                    name: 'status', 
                    orderable: true, 
                    searchable: true,
                },
                // {
                //     data: 'action', 
                //     name: 'action', 
                //     orderable: true, 
                //     searchable: true,
                // }
            ],
            dom: 'Bfrtip'
        });
        console.log(table);
    });

    // function changeToEdit(id, name, code, import, export, status) {
    //     $('#editForm').show();
    //     $('#addForm').hide();
    //     $('#name').val(name);
    //     $('#code').val(code);
    //     $('#actiontype').html('Edit');
    //     // <span id="actiontype">Add</span>
    //     $('#id').val(id);
    //     if (status == 1) {
    //         $('#statustrue').attr('selected','selected');
    //         $('#statusfalse').attr('selected', false)
    //     } else {
    //         $('#statusfalse').attr('selected','selected');
    //         $('#statustrue').attr('selected', false)
    //     }
    //     if (import == 1) {
    //         $('#importtrue').attr('selected','selected');
    //         $('#importfalse').attr('selected', false)
    //     } else {
    //         $('#importfalse').attr('selected','selected');
    //         $('#importtrue').attr('selected', false)
    //     }
    //     if (export == 1) {
    //         $('#exporttrue').attr('selected','selected');
    //         $('#exportfalse').attr('selected', false)
    //     } else {
    //         $('#exportfalse').attr('selected','selected');
    //         $('#exporttrue').attr('selected', false)
    //     }
    // }

</script>
@endpush