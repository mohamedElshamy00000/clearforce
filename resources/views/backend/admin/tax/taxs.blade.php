@extends('layouts.backend')
@section('title')
Taxs
@endsection

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Settings /</span> Taxs</h4>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0"><span id="actiontype">Add</span> Tax</h5>
            </div>
            <div class="card-body">
            {{-- add form --}}
            <form action="{{ route('tax.store') }}" method="POST" id="addForm">
                @csrf
                <div class="row">
                    <div class="mb-3 col-6">
                        <label class="form-label" for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" placeholder="">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 col-6">
                        <label class="form-label" for="percentage">percentage</label>
                        <input type="text" class="form-control @error('percentage') is-invalid @enderror" value="{{ old('percentage') }}" name="percentage" placeholder="">
                        @error('percentage')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
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
                <button type="submit" class="btn btn-primary waves-effect waves-light ">Save</button>
            </form>

              <form action="{{ route('tax.update') }}" method="POST" id="editForm" @error('name') @else  style="display: none" @enderror>
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="name">name</label>
                        <input type="hidden" name="id" id="id" >
                        <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" id="name" placeholder="">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="code">percentage</label>
                        <input type="text" class="form-control @error('percentage') is-invalid @enderror" value="{{ old('percentage') }}" name="percentage" id="percentage" placeholder="">
                        @error('percentage')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-check ps-0">
                            <label >status</label>
                            <select class="form-select" name="status">
                                <option value="0" id="statusfalse">no</option>
                                <option value="1" id="statustrue">yes</option>
                            </select>
                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </label>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
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
                            <th>percentage</th>
                            <th>status</th>
                            <th>action</th>
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
            ajax: "{{ route('get.taxs') }}",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'percentage', name: 'percentage'},
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
                }
            ],
            dom: 'Bfrtip'
        });
        console.log(table);
    });

    function changeToEdit(id, name, percentage, status) {
        $('#editForm').show();
        $('#addForm').hide();
        $('#name').val(name);
        $('#percentage').val(percentage);
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

</script>
@endpush