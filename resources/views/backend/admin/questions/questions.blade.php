@extends('layouts.backend')
@section('title')
Q&A questions
@endsection
@section('style')
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/quill/typography.css') }}" />
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/quill/katex.css') }}" />
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/quill/editor.css') }}" />
@endsection
@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Q&A /</span>questions</h4>
<div class="row">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0"><span id="actiontype">Add</span></h5>
            </div>
            <div class="card-body">
                {{-- add form --}}
              <form action="{{ route('QAquestions.store') }}" method="POST" id="addForm">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="name">Name</label>
                    <input type="text" class="form-control @error('question') is-invalid @enderror" value="{{ old('question') }}" name="question" placeholder="">
                    @error('question')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="defaultSelect" class="form-label">categories</label>
                    <select id="defaultSelect" name="categoryId" class="form-select">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('categoryId')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="snow-editor" class="form-label fs-5">answer</label>
                    <div id="snow-editor"></div>
                    <textarea id="textarea-editor" name="description" style="display: none" class="w-100 p-4" rows="10"></textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
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
                <div class="mb-3">
                    <label class="form-check m-0">
                        <input type="checkbox" class="form-check-input" name="showLanding" value="1" checked/>
                        <span class="form-check-label">show in landing</span>
                        @error('showLanding')
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
                <table class="table yajra-datatable" id="questions">
                    <thead>
                        <tr>
                            <th>question</th>
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

<!-- Vendors JS -->
<script src="{{ asset('backend/assets/vendor/libs/quill/katex.js') }}"></script>
<script src="{{ asset('backend/assets/vendor/libs/quill/quill.js') }}"></script>

<script>

    $(document).ready( function () {
        var table = $('#questions').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('get.QAquestions') }}",
            columns: [
                {data: 'question', name: 'question'},
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

    var editor_content;
    const snowEditor = new Quill('#snow-editor', {
        bounds: '#snow-editor',
        modules: {
            formula: true,
        },
        theme: 'snow'
    });
    
    snowEditor.on('text-change', function(delta, oldDelta, source) {
        editor_content = snowEditor.root.innerHTML;
        textareaeditor = $('#textarea-editor').html(editor_content);
    });
</script>
@endpush