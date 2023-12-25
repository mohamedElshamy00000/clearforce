@extends('layouts.backend')
@section('title')
ports
@endsection

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Projects / </span> Shipping Ways - ports</h4>
<div class="row">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0"><span id="actiontype">Add</span> Ports by Excel</h5>
            </div>
            <div class="card-body">
            {{-- add form excel --}}
            <form action="{{ route('ports.store.excel.file') }}" method="POST" id="addForm" enctype="multipart/form-data" @error('name_en') style="display: none" @enderror>
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
            {{-- edit form excel --}}
            <form action="{{ route('port.update') }}" method="POST" id="editForm" style="display: none">
                @csrf
                <input type="hidden" name="id" id="id" >

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
                    <label class="form-label" for="name_en">Name en</label>
                    <input type="text" class="form-control @error('name_en') is-invalid @enderror" value="{{ old('name_en') }}" name="name_en" id="name_en" placeholder="">
                    @error('name_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                {{-- <div class="mb-3">
                    <label class="form-check ps-0">
                        <label class="col-md-12 col-form-label">Country</label>
                        <select class="form-select" name="country">
                            @foreach ($countries as $country)
                                <option value="{{ $country->code }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('country')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </label>
                </div> --}}
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
                <table class="table yajra-datatable" id="ports">
                    <thead>
                        <tr>
                            <th>name</th>
                            <th>name ar</th>
                            {{-- <th>Shipping Way</th> --}}
                            <th>country</th>
                            {{-- <th>date</th> --}}
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
    function changeToEdit(id, name_en, name_ar, country, status) {
        $('#editForm').show();
        $('#addForm').hide();
        $('#name_ar').val(name_ar);
        $('#name_en').val(name_en);
        // $('#country').val(country);
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
        var table = $('#ports').DataTable({
            processing: true,
            responsive: true,
            serverSide: true,
            ajax: "{{ route('admin.getPorts') }}",
            columns: [
                {data: 'name_en', name: 'name_en'},
                {data: 'name_ar', name: 'name_ar'},
                // {data: 'shipingWay', name: 'shipingWay'},
                {data: 'country', name: 'country'},
                // {data: 'created_at', name: 'created_at'},
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