@extends('layouts.client')

@section('navicon') <i class="menu-icon ti ti-lifebuoy"></i> @endsection

@section('title')
    Help Center
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/quill/typography.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/quill/katex.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/quill/editor.css') }}" />
@endsection

@section('content')

<h4 class="py-3 mb-2">
    <span class="text-muted fw-light">help center /</span> Ticket Information
</h4>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
    
    <div class="d-flex flex-column justify-content-center gap-2 gap-sm-0">
        <h5 class="mb-1 mt-3 d-flex flex-wrap gap-2 align-items-end">ticket #{{ $ticket->id }}</h5>
    </div>
</div>

<!-- Order Details Table -->

<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title m-0">{{ $ticket->title }}</h5>
                <p class="text-body m-0"><i class="ti ti-calendar-event"></i> {{ $ticket->created_at }}</p>
            </div>
            
            <div class="card-body">
                <p>{!! $ticket->description !!}</p>
            </div>

            <ul class="timeline timeline-advance timeline-advance mb-2 pb-1" id="show_messages" data-url="{{ route('clinet.showMessages', $ticket->id) }}">
                @foreach ($ticket->messages as $message)
                    <li class="timeline-item ps-4 border-left-dashed">
                        <span class="timeline-indicator rounded timeline-indicator-success">
                            <i class="ti ti-message"></i>
                        </span>
                        <div class="timeline-event ps-0 pb-0">
                            <h6 class="mb-0 text-medium">{{ $message->user->name }} <small class="text-muted mb-0 text-nowrap">{{ $message->created_at->format('d/m/Y - g:i A') }}</small></h6>
                            <div class="timeline-header mb-2 p-2 rounded">
                                <small class="text-dark fw-bold">{!! $message->message !!}</small>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- send messages --}}
        <div class="card mb-4">
            <h5 class="card-header">Send Message</h5>
            <div class="card-body">
                <form method="post" id="formMessageSupportTicket" data-action="{{ route('client.supportticket.send.message', $ticket->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div id="snow-editor"></div>
                    </div>
                    <div class="form-group text-start mt-3">
                        <button type="submit" class="btn btn-primary btn-sm px-4">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-lg-4">    
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between">
                <h6 class="card-title m-0">Ticket Information</h6>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-start align-items-center">
                    <div class="d-flex flex-column">
                        <h6>Status : 
                            @if ($ticket->status == 0)
                            <span class="badge bg-label-danger">new</span>
                            @elseif($ticket->status == 1)
                                <span class="badge bg-label-info">inprogress</span>
                            @elseif($ticket->status == 2)
                                <span class="badge bg-label-danger">On-Hold</span>
                            @elseif($ticket->status == 3)
                                <span class="badge bg-label-success">solved</span>
                            @endif
                        </h6>
                        
                    </div>
                </div>
                @if ($ticket->project)
                    <p class=" mb-1"><strong>Project</strong>  : <a href="{{ route('single.project', $ticket->project->uuid) }}"><i class="fa fa-link"></i> OPEN</a></p>
                @endif
                <p class=" mb-1"><strong>Open date</strong>: {{ $ticket->created_at->format('d/m/Y - g:i A') }}</p>
                <p class=" mb-0"><strong>Category</strong> : {{ $ticket->category }}</p>
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
    var sendaple = false;
    var form = '#formMessageSupportTicket';

    const snowEditor = new Quill('#snow-editor', {
        bounds: '#snow-editor',
        modules: {
            formula: true,
        },
        theme: 'snow'
    });
    
    snowEditor.on('text-change', function(delta, oldDelta, source) {
        editor_content = snowEditor.root.innerHTML;
        if (snowEditor.getLength() <= 1) {
            sendaple = false;
        } else {
            sendaple = true;
        }
        // console.log(editor_content);
    });
    
    $(document).ready(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(form).on('submit', function(event){
            $(document).ajaxSend(function() {
                $(".page-loading").fadeIn(300);　
            }); 

            event.preventDefault();
            var url = $(this).attr('data-action');

            if (sendaple == true) {
                $.ajax({
                    url: url,
                    method: 'POST',
                    type: 'POST',
                    data : {
                        message : editor_content,
                    },
                    dataType: 'JSON',
                    success:function(response)
                    {

                        $('#show_messages').append(`
                            <li class="timeline-item ps-4 border-left-dashed">
                                <span class="timeline-indicator rounded timeline-indicator-success">
                                    <i class="ti ti-message"></i>
                                </span>
                                <div class="timeline-event ps-0 pb-0">
                                    <h6 class="mb-0 text-medium">{{ auth()->user()->name }}<small class="text-muted mb-0 text-nowrap"> now </small></h6>
                                    <div class="timeline-header mb-2 p-2 rounded">
                                        <small class="text-dark fw-bold">${ editor_content }</small>
                                    </div>
                                </div>
                            </li>
                        `);

                        snowEditor.setText('');
                        toastr.success(response.success)
                    },
                    error: function(response) {
                        var errors = response.responseJSON;
                        setTimeout(function(){
                            $(".page-loading").fadeOut(300);
                        },10);
                        toastr.error('error')
                        
                    }
                }).done(function() {
                    setTimeout(function(){
                        $(".page-loading").fadeOut(300);
                    },10);
                });
            } else {
                toastr.error('message empty')
            }
        });

    });
    
</script>

@endsection