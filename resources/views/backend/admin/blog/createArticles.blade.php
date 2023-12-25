@extends('layouts.backend')
@section('navicon') <i class="menu-icon tf-icons ti ti-clipboard"></i>  @endsection

@section('title')
    Articles
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/quill/typography.css') }}" />
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/quill/katex.css') }}" />
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/quill/editor.css') }}" />
@endsection

@section('content')

<h4 class="py-3 mb-2">
    <div><span class="text-muted fw-light">Blog /</span> Add Articles</div>
</h4>

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">create new article</h5>
                <small class="text-muted float-end"></small>
            </div>
            <div class="card-body">
                <form method="post" id="blogcreate" action="{{ route('admin.article.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fs-5">banner - image</label>
                        <input type="file" name="banner" class="form-control" accept="image/png, image/gif, image/jpeg" >
                        @error('banner')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fs-5" for="title">title</label>
                        <input type="text" name="title" class="form-control" id="title" >
                    </div>

                    <div class="mb-3">
                        <label for="snow-editor" class="form-label fs-5">content</label>
                        <div id="snow-editor"></div>
                        <textarea id="textarea-editor" name="content" style="display: none" class="w-100 p-4" rows="10"></textarea>
                        @error('content')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group text-start mt-3">
                        <button type="submit" class="btn btn-primary btn-sm px-4">Send</button>
                        <label for="status" class="fw-bold ms-3">status</label>
                        <div class="form-check form-check-inline ms-3 mt-3">
                            <input class="form-check-input" type="radio" name="status" id="inlineRadio1" checked value="1">
                            <label class="form-check-label" for="inlineRadio1">active</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"  type="radio" name="status" id="inlineRadio2" value="0">
                            <label class="form-check-label" for="inlineRadio2">not active</label>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<!-- Vendors JS -->
<script src="{{ asset('backend/assets/vendor/libs/quill/katex.js') }}"></script>
<script src="{{ asset('backend/assets/vendor/libs/quill/quill.js') }}"></script>

<script>
    var editor_content;
    var form = '#blogcreate';
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
@endsection