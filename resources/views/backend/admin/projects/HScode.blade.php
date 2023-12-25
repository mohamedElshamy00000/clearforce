@extends('layouts.backend')
@section('title')
HS Code
@endsection

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Projects /</span> HS Code</h4>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0"><span id="actiontype">Add</span> HS Code's</h5>
            </div>
            <div class="card-body">
                {{-- add form --}}
              <form action="{{ route('Hscode.store.excel.file') }}" method="POST" id="addForm" enctype="multipart/form-data" @error('general') style="display: none" @enderror>
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
              <form action="{{ route('Hscode.update') }}" method="POST" id="editForm" @error('hs_code') @else  style="display: none" @enderror>
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="hs_code">hs_code</label>
                    <input type="hidden" name="id" id="id" >
                    <input type="text" class="form-control @error('hs_code') is-invalid @enderror" value="{{ old('hs_code') }}" name="hs_code" id="hs_code" placeholder="">
                    @error('hs_code')
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
    <div class="col-md-12">
        <div class="card">
            <div class="table-responsive text-nowrap mb-3">
                <table class="table yajra-datatable" id="HScode">
                    <thead>
                        <tr>
                            <th>hsـcode</th>
                            <th>item en</th>
                            <th>duty</th>
                            <th>procedures</th>
                            <th>effective_date</th>
                            <th>status</th>
                            {{-- <th>Action</th> --}}
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
    function changeToEdit(id, hs_code, status) {
        $('#editForm').show();
        $('#addForm').hide();
        $('#hs_code').val(hs_code);
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
        var table = $('#HScode').DataTable({
            processing: true,
            serverSide: true,
            lengthChange: true,
            responsive: true,
            pageLength: 20,
            ajax: "{{ route('getHScode') }}",
            columns: [
                {data: 'hs_code', name: 'hs_code'},
                {data: 'item_en', name: 'item_en'},
                // {data: 'item_ar', name: 'item_ar'},
                {data: 'duty', name: 'duty'},
                {data: 'procedures', name: 'procedures'},
                {data: 'effective_date', name: 'effective_date'},
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
                // },
            ],
            dom: 'Bfrtip'
        });
    });

</script>
@endpush