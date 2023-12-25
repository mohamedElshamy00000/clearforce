@extends('layouts.backend')
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
                <p class="text-body m-0"><i class="ti ti-calendar-event"></i> {{ $ticket->created_at->format('d m Y') }}</p>
            </div>
            
            <div class="card-body">
                <p>{!! $ticket->description !!}</p>
            </div>

            <ul class="timeline timeline-advance timeline-advance mb-2 pb-1" id="show_messages">
                @foreach ($ticket->messages as $message)
                    <li class="timeline-item ps-4 border-left-dashed">
                        <span class="timeline-indicator rounded timeline-indicator-success">
                            <i class="ti ti-message"></i>
                        </span>
                        <div class="timeline-event ps-0 pb-0">
                            <h6 class="mb-0 text-medium">{{ $message->user->name }} <small class="text-muted mb-0 text-nowrap">{{ $message->created_at->format('D m Y - g:i A') }}</small></h6>
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
                <form method="post" id="formMessageSupportTicket" data-action="{{ route('admin.supportticket.send.message', $ticket->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div id="snow-editor"></div>
                    </div>

                    <div class="form-group text-start mt-3">
                        <button type="submit" class="btn btn-primary btn-sm px-4">Send</button>
                        <label for="status" class="fw-bold ms-3">status</label>
                        <div class="form-check form-check-inline ms-3 mt-3">
                            <input class="form-check-input" @if ($ticket->status == 1) checked @endif type="radio" name="status" id="inlineRadio1" value="1">
                            <label class="form-check-label" for="inlineRadio1">inprogress</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" @if ($ticket->status == 2) checked @endif type="radio" name="status" id="inlineRadio2" value="2">
                            <label class="form-check-label" for="inlineRadio2">on-Hold</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" @if ($ticket->status == 3) checked @endif type="radio" name="status" id="inlineRadio3" value="3">
                            <label class="form-check-label" for="inlineRadio2">solved</label>
                        </div>
                    </div>
                    
                </form>
            </div>
         
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="card mb-4">
          <div class="card-header">
            <h6 class="card-title m-0">Customer details</h6>
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-start align-items-center mb-4">
              <div class="d-flex flex-column">
                <a href="" class="text-body text-nowrap">
                  <h6 class="mb-0">{{ $ticket->user->name }}</h6>
                </a>
                <small class="text-muted">Customer ID: #{{ $ticket->user->id }}</small></div>
            </div>
            <div class="d-flex justify-content-start align-items-center mb-4">
              <span class="avatar rounded-circle bg-label-success me-2 d-flex align-items-center justify-content-center"><i class="ti ti-table-export ti-sm"></i></span>
              <h6 class="text-body text-nowrap mb-0">{{ $ticket->user->projects->count() }} Project</h6>
            </div>
            <div class="d-flex justify-content-between">
              <h6>Contact info</h6>
            </div>
            <p class=" mb-1">Email: {{ $ticket->user->email }}</p>
            <p class=" mb-0">Mobile: {{ $ticket->user->phone }}</p>
          </div>
        </div>
    
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between">
                <h6 class="card-title m-0">Ticket Information</h6>
                <div class="dropdown">
                    <button class="btn p-0" type="button" id="totalEarning" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Priority <i class="ti ti-dots ti-sm text-muted"></i> 
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalEarning">
                        <a class="dropdown-item" href="{{ route('admin.ticket.edit.priority', [$ticket->id, 'low'] ) }}">low</a>
                        <a class="dropdown-item" href="{{ route('admin.ticket.edit.priority', [$ticket->id, 'medium'] ) }}">medium</a>
                        <a class="dropdown-item" href="{{ route('admin.ticket.edit.priority', [$ticket->id, 'high'] ) }}">high</a>
                        <a class="dropdown-item" href="{{ route('admin.ticket.edit.priority', [$ticket->id, 'critical'] ) }}">critical</a>
                    </div>
                </div>
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
                <div class="d-flex justify-content-start align-items-center mb-4">
                    <div class="d-flex flex-column">
                        <h6>Priority :
                        @if ($ticket->priority == 'low')
                            <span class="badge bg-label-success">low</span>
                        @elseif($ticket->priority == 'medium')
                            <span class="badge bg-label-info">medium</span>
                        @elseif($ticket->priority == 'high')
                            <span class="badge bg-label-danger">high</span>
                        @elseif($ticket->priority == 'critical')
                            <span class="badge bg-danger">critical</span>
                        @endif
                        </h6>
                    </div>
                </div>
                @if ($ticket->project)
                <p class=" mb-1">Project  : <a href="{{ route('admin.project.single', $ticket->project->uuid) }}"><i class="fa fa-link"></i> OPEN</a></p>
                @endif
                <p class=" mb-1">Open date: {{ $ticket->created_at->format('D M Y') }}</p>
                <p class=" mb-0">Category : {{ $ticket->category }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
        <div class="modal-content p-3 p-md-5">
          <div class="modal-body">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="text-center mb-4">
              <h3 class="mb-2">Edit User Information</h3>
              <p class="text-muted">Updating user details will receive a privacy audit.</p>
            </div>
            <form id="editUserForm" class="row g-3 fv-plugins-bootstrap5 fv-plugins-framework" onsubmit="return false" novalidate="novalidate">
              <div class="col-12 col-md-6 fv-plugins-icon-container">
                <label class="form-label" for="modalEditUserFirstName">First Name</label>
                <input type="text" id="modalEditUserFirstName" name="modalEditUserFirstName" class="form-control" placeholder="John">
              <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
              <div class="col-12 col-md-6 fv-plugins-icon-container">
                <label class="form-label" for="modalEditUserLastName">Last Name</label>
                <input type="text" id="modalEditUserLastName" name="modalEditUserLastName" class="form-control" placeholder="Doe">
              <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
              <div class="col-12 fv-plugins-icon-container">
                <label class="form-label" for="modalEditUserName">Username</label>
                <input type="text" id="modalEditUserName" name="modalEditUserName" class="form-control" placeholder="john.doe.007">
              <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
              <div class="col-12 col-md-6">
                <label class="form-label" for="modalEditUserEmail">Email</label>
                <input type="text" id="modalEditUserEmail" name="modalEditUserEmail" class="form-control" placeholder="example@domain.com">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label" for="modalEditUserStatus">Status</label>
                <div class="position-relative"><div class="position-relative"><select id="modalEditUserStatus" name="modalEditUserStatus" class="select2 form-select select2-hidden-accessible" aria-label="Default select example" tabindex="-1" aria-hidden="true" data-select2-id="modalEditUserStatus">
                  <option selected="" data-select2-id="14">Status</option>
                  <option value="1">Active</option>
                  <option value="2">Inactive</option>
                  <option value="3">Suspended</option>
                </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="13" style="width: auto;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-modalEditUserStatus-container"><span class="select2-selection__rendered" id="select2-modalEditUserStatus-container" role="textbox" aria-readonly="true" title="Status">Status</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span></div></div>
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label" for="modalEditTaxID">Tax ID</label>
                <input type="text" id="modalEditTaxID" name="modalEditTaxID" class="form-control modal-edit-tax-id" placeholder="123 456 7890">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label" for="modalEditUserPhone">Phone Number</label>
                <div class="input-group">
                  <span class="input-group-text">US (+1)</span>
                  <input type="text" id="modalEditUserPhone" name="modalEditUserPhone" class="form-control phone-number-mask" placeholder="202 555 0111">
                </div>
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label" for="modalEditUserLanguage">Language</label>
                <div class="position-relative"><div class="position-relative"><select id="modalEditUserLanguage" name="modalEditUserLanguage" class="select2 form-select select2-hidden-accessible" multiple="" tabindex="-1" aria-hidden="true" data-select2-id="modalEditUserLanguage">
                  <option value="">Select</option>
                  <option value="english" selected="" data-select2-id="25">English</option>
                  <option value="spanish">Spanish</option>
                  <option value="french">French</option>
                  <option value="german">German</option>
                  <option value="dutch">Dutch</option>
                  <option value="hebrew">Hebrew</option>
                  <option value="sanskrit">Sanskrit</option>
                  <option value="hindi">Hindi</option>
                </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="24" style="width: auto;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false"><ul class="select2-selection__rendered"><li class="select2-selection__choice" title="English" data-select2-id="26"><span class="select2-selection__choice__remove" role="presentation">×</span>English</li><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" placeholder="" style="width: 0.75em;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span></div></div>
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label" for="modalEditUserCountry">Country</label>
                <div class="position-relative"><div class="position-relative"><select id="modalEditUserCountry" name="modalEditUserCountry" class="select2 form-select select2-hidden-accessible" data-allow-clear="true" tabindex="-1" aria-hidden="true" data-select2-id="modalEditUserCountry">
                  <option value="" data-select2-id="53">Select</option>
                  <option value="Australia">Australia</option>
                  <option value="Bangladesh">Bangladesh</option>
                  <option value="Belarus">Belarus</option>
                  <option value="Brazil">Brazil</option>
                  <option value="Canada">Canada</option>
                  <option value="China">China</option>
                  <option value="France">France</option>
                  <option value="Germany">Germany</option>
                  <option value="India">India</option>
                  <option value="Indonesia">Indonesia</option>
                  <option value="Israel">Israel</option>
                  <option value="Italy">Italy</option>
                  <option value="Japan">Japan</option>
                  <option value="Korea">Korea, Republic of</option>
                  <option value="Mexico">Mexico</option>
                  <option value="Philippines">Philippines</option>
                  <option value="Russia">Russian Federation</option>
                  <option value="South Africa">South Africa</option>
                  <option value="Thailand">Thailand</option>
                  <option value="Turkey">Turkey</option>
                  <option value="Ukraine">Ukraine</option>
                  <option value="United Arab Emirates">United Arab Emirates</option>
                  <option value="United Kingdom">United Kingdom</option>
                  <option value="United States">United States</option>
                </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="52" style="width: auto;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-modalEditUserCountry-container"><span class="select2-selection__rendered" id="select2-modalEditUserCountry-container" role="textbox" aria-readonly="true"><span class="select2-selection__placeholder">Select value</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span></div></div>
              </div>
              <div class="col-12">
                <label class="switch">
                  <input type="checkbox" class="switch-input">
                  <span class="switch-toggle-slider">
                    <span class="switch-on"></span>
                    <span class="switch-off"></span>
                  </span>
                  <span class="switch-label">Use as a billing address?</span>
                </label>
              </div>
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">Submit</button>
                <button type="reset" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
              </div>
            <input type="hidden"></form>
          </div>
        </div>
    </div>
</div>
<!--/ Edit User Modal -->
    

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
            var status = document.querySelector('input[name="status"]:checked').value;

            if (sendaple == true) {
                $.ajax({
                    url: url,
                    method: 'POST',
                    type: 'POST',
                    data : {
                        message : editor_content,
                        status : status,
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
                        alert('error');
                        setTimeout(function(){
                            $(".page-loading").fadeOut(300);
                        },10);
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