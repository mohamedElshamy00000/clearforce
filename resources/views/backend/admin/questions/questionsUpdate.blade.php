@extends('layouts.backend')
@section('title')
Q&A edit question
@endsection
@section('style')
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/quill/typography.css') }}" />
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/quill/katex.css') }}" />
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/quill/editor.css') }}" />
@endsection
@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Q&A /</span>edit question</h4>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0"><span id="actiontype">Edit</span></h5>
            </div>
            <div class="card-body">
                {{-- add form --}}
              <form action="{{ route('QAquestions.change', $question->id) }}" method="POST" id="addForm">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="name">Name</label>
                    <input type="text" class="form-control @error('question') is-invalid @enderror" value="{{ $question->question }}" name="question" placeholder="">
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
                            <option value="{{ $category->id }}" @if ($category->id == $question->categories_id) selected @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('categoryId')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="snow-editor" class="form-label fs-5">answer</label>
                    <div id="snow-editor">{!! $question->description !!}</div>
                    <textarea id="textarea-editor" name="description" style="display: none" class="w-100 p-4" rows="10">{!! $question->description !!}</textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-check m-0">
                        <input type="checkbox" class="form-check-input" name="status" value="1"  @if ($question->status == 1) checked @endif />
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
                        <input type="checkbox" class="form-check-input" name="showLanding" value="1"  @if ($question->showLanding == 1) checked @endif />
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