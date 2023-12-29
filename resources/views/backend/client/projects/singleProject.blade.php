@extends('layouts.client')
@section('title')
    My Project
@endsection
@section('content')

<div class="d-flex align-items-center justify-content-between py-3">
    <h4 class="fw-bold"><span class="text-muted fw-light">{{ __('general.Project') }} /</span> {{ __('general.project details') }}</h4>
    <a class="btn btn-primary" href="{{ route('client.storage.create.deliveryOrder', $project->uuid) }}">create delivary order</a>
</div>

@if($errors->any())
<div class="alert alert-danger alert-dismissible d-flex align-items-baseline" role="alert">
  <span class="alert-icon alert-icon-lg text-danger me-2">
    <i class="ti ti-error-404 ti-sm"></i>
  </span>
  <div class="d-flex flex-column ps-1">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        <li><p class="mb-0">{{ $error }}</p></li>
      @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
</div>

@endif
<!-- Project Cards -->
@if ($project->status == 2)
    @if ($project->endRequests->count() == 1 && $project->endRequests->first()->status == 0 )
    <div class="card mb-4 bg-primary">
        <div class="card-body">
          <div class="row justify-content-between mb-0">
            <div class="col-md-6 d-flex align-items-center text-center text-lg-start text-xl-center text-xxl-start order-1 order-lg-0 order-xl-1 order-xxl-0">
                <span class="alert-icon text-primary bg-white rounded me-2 px-1 py-1 pt-0">
                    <i class="ti ti-bell ti-xs"></i>
                </span>
                <h5 class="card-title text-white mb-0 text-nowrap d-flex align-items-center">{{ __('general.Request to end the project from the agent') }}</h5>
            </div>
            <div class="col-md-6 text-end mx-auto mx-md-0 mb-0">
                <button class="btn btn-white text-primary px-5 fw-medium shadow-md waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#clientConfirmEndProject">{{ __('general.Show') }}</button>
            </div>
          </div>
        </div>
    </div>
    @endif
@endif

<div class="row g-4">
    <div class="col-md-5">
        <div class="card mb-4">
            
            <div class="card-header">
                {!! $project->Status() !!}
                
                <div class="d-flex align-items-start">
                    <div class="d-flex align-items-start">
                        <div class="avatar me-2">
                            @if ($project->type == 1)
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-transfer-in" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 18v3h16v-14l-8 -4l-8 4v3"></path>
                                <path d="M4 14h9"></path>
                                <path d="M10 11l3 3l-3 3"></path>
                            </svg>
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-transfer-out" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 19v2h16v-14l-8 -4l-8 4v2"></path>
                                <path d="M13 14h-9"></path>
                                <path d="M7 11l-3 3l3 3"></path>
                            </svg>
                            @endif
                        
                        </div>
                        
                        <div class="me-2 ms-1">
                            {{-- <div class="mb-0">
                                <strong>Goods type: </strong> <span class="text-muted">{{ $project->Goodstype }}</span>
                            </div> --}}
                            <div>
                                <strong>{{ __('general.HS_Codes') }}: </strong>
                                @foreach ($project->hscodes as $hscode)
                                    <span class="badge rounded-pill bg-label-secondary"> {{ $hscode->hs_code }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="ms-auto">
                        <div class=" zindex-2">
                            <span class="mb-1 d-flex align-items-center">
                                <i class="ti ti-alarm fw-bold fs-3 me-1"></i>
                                <span class="text-body fw-normal">{{ $project->created_at->format('d-m-Y') }}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body ">
                <div class="row m-0 p-0">
                    <div class="col-md-6 ps-0">
                        <div class="mb-2">
                            <h5>{{ __('general.Shipment_Details') }}</h5>
                            <h6 class="mb-2">{{ __('general.from') }} : <span class="text-body fw-normal">{{ $project->countryfrom->name }}</span></h6>
                            <h6 class="mb-2">{{ __('general.to') }} : <span class="text-body fw-normal">{{ $project->countryto->name }}</span></h6>
                            <h6 class="mb-2">
                                @if ($project->shipingMode->name == 'Air')
                                    {{ __('general.Air') }}
                                @elseif($project->shipingMode->name == 'Land')
                                    {{ __('general.Land') }}
                                @elseif($project->shipingMode->name == 'Sea')
                                    {{ __('general.Ocean') }}
                                @endif
                                <br class="mb-2">
                                {{ __('general.Port') }} : 
                                <span class="text-body fw-normal">
                                    @if (App::isLocale('ar'))
                                    {{ $project->port->name_ar }}
                                    @else
                                    {{ $project->port->name_en }}
                                    @endif
                                </span>
                            </h6>
                            
                            <h6 class="mb-2">{{ __('general.Arrival Date') }} : <span class="text-body fw-normal">{{ $project->arrivalDate > now()->format('Y-m-d') ? $project->arrivalDate  : 'delivered to the port' }}</span></h6>
                            
                        </div>
                    </div>
                    <div class="col-md-6 pe-0">
                        <div class="flex-wrap">
                            @if ($project->Budget != null)
                            <div class="bg-lighter px-3 py-2 rounded me-auto mb-3">
                                <h6 class="mb-0">{{ __('general.Budget') }} : {{ $project->Budget }} <sup class="text-success">SAR</sup> </h6>
                            </div>
                            @endif
                        
                            <div class="text-start mb-3">
                                @if ($project->needShiping == 1)
                                <h6 class="mb-0">{{ __('general.needShiping') }}</h6>
                                @endif
                            </div>
        
                            @if ($project->needShiping == 1)
                            <ul class="mb-0 bg-lighter py-2 px-3 w-100 ">
                                <li class="menu"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pins" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M10.828 9.828a4 4 0 1 0 -5.656 0l2.828 2.829l2.828 -2.829z"></path>
                                    <path d="M8 7l0 .01"></path>
                                    <path d="M18.828 17.828a4 4 0 1 0 -5.656 0l2.828 2.829l2.828 -2.829z"></path>
                                    <path d="M16 15l0 .01"></path>
                                </svg> : {{ $project->deliveryPlace }}</li>
                            </ul>
                            @endif
                        </div>
                        @if ($project->note != null)
                        <p class="mb-0 mt-2"><span class="text-info">{{ __('general.Note') }}</span> : {{ $project->note }}</p>
                        @endif
                    </div>
                    @if ($project->ActiveProposal() != false ) 
                    <div class="col-md-12 pe-0 ps-0">
                        <h6 class="mb-2">
                            <span class="fw-bold">{{ __('general.payment mode') }} : 
                                @if ($project->payment_mode == 1)
                                    <span class="badge rounded-pill bg-label-primary">{{ __('general.Payment with every invoice') }}</span>
                                @elseif($project->payment_mode == 2)
                                    <span class="badge rounded-pill bg-label-success">{{ __('general.Payment after project completion') }}</span>
                                @endif
                            </span>
                        </h6>
                        <div class="d-flex align-items-center pt-1">

                            <div class="d-flex align-items-center">
                                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0 zindex-2 mt-1">
                                    <li>
                                        <strong class="text-black">{{ __('general.Agent') }}</strong> : 
                                        <strong class="text-muted">{{ $project->ActiveProposal()->agent->name }}</strong><br>
                                        <strong class="text-muted">{{ $project->ActiveProposal()->agent->email }}</strong><br>
                                        <strong class="text-muted">{{ __('general.license number') }} : {{ $project->ActiveProposal()->agent->Verifiy->where('status',1)->first()->number }}</strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                
            </div>
        </div>
        <div class="card card-action mb-4">
            <div class="card-header align-items-center">
                <h5 class="card-action-title mb-0">{{ __('general.files') }}</h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    @forelse ($project->files as $file)
                    <li class="mb-2">
                        <div class="d-flex align-items-center btn btn-outline-dark waves-effect ">
                            @if (File::extension('assets/files/projects/'. $file->file_name) != 'pdf')
                            <i class="fa fa-file me-3 fs-4"></i> 
                            @else
                            <i class="fa fa-file-pdf me-3 fs-4"></i> 
                            @endif
                            <div class="text-start me-2">
                                <h6 class="text-dark mb-0">{{ $file->fileType->name_en }}</h5>
                                <h6 class="mb-0 text-muted">{{ substr($file->file_name, 0, -20) }}...{{ substr($file->file_name, -3, 3) }}</h6>
                            </div>
                            @if (File::extension('assets/files/projects/'. $file->file_name) != 'pdf')
                                <a href="{{ asset('assets/files/projects/'. $file->file_name) }}" target="_blank" class="ms-auto">
                                    <span class="btn btn-label-dark btn-icon btn-sm">
                                        <i class="ti ti-eye ti-xs"></i>
                                    </span>
                                </a>
                            @else
                                <a href="{{ route('file.download', $file->file_name) }}" class="ms-auto">
                                    <span class="btn btn-label-dark btn-icon btn-sm">
                                        <i class="ti ti-arrow-down ti-xs"></i>
                                    </span>
                                </a>
                            @endif
                            
                        </div>
                    </li>
                    
                    @empty
                    <li class="mb-3 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-archive" width="60" height="60" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"></path>
                            <path d="M5 8v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-10"></path>
                            <path d="M10 12l4 0"></path>
                        </svg>
                    </li>
                    @endforelse
                </ul>
            </div>
        
        </div>

        @if ($project->Budget && $project->proposals()->count() > 0)
            @if ($invoice)
                @if ($invoice->status == 0)
                    <div class="card mt-4 border-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="me-2 badge bg-label-success rounded p-2">
                                    <i class="ti ti-credit-card fs-2 "></i>
                                </div>
                                <div class="me-2 text-body h5 mb-0">{{ __('general.Payment Required') }}</div>
                            </div>

                            <div class="d-flex align-items-center pt-1">
                                <p class="mb-0">
                                    {{ __('general.The summary was evaluated at') }} <span class="text-dark">{{ $project->Budget }} SAR</span>
                                </p>
                                <div class="ms-auto">
                                    <a href="{{ route('credit.checkout', $invoice->id) }}" type="button" class="btn btn-primary waves-effect waves-light">{{ __('general.Pay now') }}</a>
                                </div>
                            </div>
                
                        </div>
                    </div> 
                @endif           
            @endif
        @endif
    </div>
    <div class="col-md-7">

        <!-- Milestone -->
        <div class="card card-action mb-4">
            <div class="card-header align-items-center">
                <h5 class="card-action-title mb-0">{{ __('general.Milestones') }}</h5>
                <div class="dropdown">
                    <button class="btn p-0" type="button" id="routeVehicles" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="ti ti-dots-vertical"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="routeVehicles">
                      <a class="dropdown-item" href="{{ route('client.storage.create.deliveryOrder', $project->uuid) }}">create delivary order</a>
                    </div>
                </div>
            </div>
            <div class="card-body pb-0">
                <ul class="timeline ms-1 mb-0">
                    @forelse ($project->millstone as $millstone)
                        @if ($millstone->projectMillStone)
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-primary"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header">
                                        <h6 class="mb-0">{{ $millstone->projectMillStone->name }}</h6>
                                        {{-- <small class="text-muted">{{ $millstone->created_at->format('Y-m-d') }}</small> --}}
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        <div class="">
                                            <span>{{ $millstone->created_at->format('Y-m-d h:m A') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @else
                        <li class="timeline-item timeline-item-transparent">
                            <span class="timeline-point timeline-point-info"></span>
                            <div class="timeline-event">
                                <div class="timeline-header">
                                    <h6 class="mb-0">{{ $millstone->name }}</h6>
                                    <small class="text-muted">{{ $millstone->created_at->format('Y-m-d h:m A') }}</small>
                                </div>
                                <div class="d-flex flex-wrap">
                                    <div class="">
                                        <span>{{ $millstone->desc }}</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endif
                    @empty
                        <div class="alert mb-3 text-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-archive" width="60" height="60" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"></path>
                                <path d="M5 8v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-10"></path>
                                <path d="M10 12l4 0"></path>
                            </svg>
                        </div>
                    @endforelse
                    
                    
                </ul>
            </div>
        </div>

        <!-- invoices table -->
        <div class="card card-action mb-4">
            <div class="card-header align-items-center">
                <h5 class="card-action-title mb-0">{{ __('general.Invoices') }}</h5>
                @if ($project->status == 3)
                    <a href="{{ route('clinet.single.invoice', $project->uuid) }}" type="button" class="btn btn-dark waves-effect">
                        {{ __('general.show invoices') }}
                    </a>
                @endif
            </div>
            <div class="card-body px-0">
                <table class="table yajra-datatable" id="invoices">
                    <thead>
                        <tr>
                            <th>{{ __('general.Total') }}</th>
                            <th>{{ __('general.date') }}</th>
                            <th>{{ __('general.Status') }}</th>
                            <th>{{ __('general.Action') }}</th>
                            <th>{{ __('general.unpaid') }}</th>
                            <th>{{ __('general.proof') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Projects table -->
    </div>
</div>
<!--/ Project Cards -->
 
{{--  client Confirm Invoice Payment --}}
{{-- <div class="modal fade" id="clientConfirmInvoicePayment" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered modal-simple">
      <div class="modal-content p-3 p-md-4">
        <div class="modal-body">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="text-center mb-4">
                <h3 class="mb-2">Confirm Payment</h3>
                <p class="text-muted">Add an invoice or payment instrument</p>
            </div>
            <form id="addProposal" class="row g-3" method="POST" action="{{ route('client.confirm.invoice.payment', $invoice->id) }}">
                @csrf
                <div class="col-12">
                    <label class="form-label w-100" for="budget">Add Budget <span class="text-danger">*</span></label>
                    <div class="input-group input-group-merge">
                        <input id="budget" name="budget" class="form-control" type="number" placeholder="" required />
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label w-100" for="note">Add Note</label>
                    <div class="input-group input-group-merge">
                        <textarea id="note" name="note" class="form-control" type="text" ></textarea>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1 w-100">Submit</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</div> --}}

    <!-- Modal -->
    <div class="modal fade" id="paymentconfirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('general.Invoices') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
            
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                        <h6 class="m-0 d-none d-sm-block">{{ __('general.code') }} : <span id="data-code"></span></h6>
                    </div>
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="display: none !important" id="transaction_id">
                        <div class="d-flex gap-2 align-items-center">
                            <h6 class="m-0" >{{ __('general.Note') }} : <span id="data-note"></span></h6>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                        <h6 class="m-0 d-none d-sm-block">{{ __('general.Amount') }} : <span id="data-amount"></span> <sup>SAR</sup></h6>
                    </div>
                    <form action="" id="instrumentform" method="post" enctype="multipart/form-data" class="te-file-type">
                        @csrf
                        <input type="hidden" name="id" id="invoiceID">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">{{ __('general.Add an invoice or payment instrument') }}</label>
                            <input class="form-control" name="media" type="file" id="formFile" />
                        </div>
                        <div class="">
                            <button class="btn btn-primary">{{ __('general.Send') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--  client Confirm end project --}}
    @if ($project->status == 2)
        @if ($project->endRequests->count() == 1 && $project->endRequests->first()->status == 0 )
        {{--  client Confirm end project --}}
        <div class="modal fade" id="clientConfirmEndProject" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h4 class="modal-title mt-2" id="modalToggleLabel">{{ __('general.Confirm clearance completion') }}</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <h6>{{ __('general.The latest copy of the customs declaration') }}</h6>  
                        <a href="{{ route('files.download', ["certification",$project->endRequests->first()->file_name]) }}" class="d-flex align-items-center btn btn-outline-dark waves-effect ">
                            <div class="d-flex align-items-start me-2">
                                <i class="ti ti-file me-2"></i> <h6 class="mb-0">{{ substr( $project->endRequests->first()->file_name, 0, -20) }}...{{ substr( $project->endRequests->first()->file_name, -3, 3) }}</h6>
                            </div>
                            
                            <div class="ms-auto">
                                <span class="btn btn-label-dark btn-icon btn-sm">
                                    <i class="ti ti-arrow-down ti-xs"></i>
                                </span>
                            </div>
                        </a>  
                    </div>
                    <div class="mt-3">
                        <table>
                          <tbody>
                            {{-- <tr>
                              <td class="pe-4">Clearance process completed :</td>
                              <td><strong>{{ $project->endRequests->first()->status == 0 ? 'no' : 'yes' }}</strong></td>
                            </tr> --}}
                            @if ($project->needShiping == 1)
                                <tr>
                                    <td class="pe-4">{{ __('general.Transportation ends and shipment arrives') }} :</td>
                                    <td>{{ $project->endRequests->first()->transfer == 0 ? 'not yet' : 'yes' }}</td>
                                </tr>
                            @endif
                          </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger waves-effect waves-light m-0" >{{ __('general.Reject') }}</button>
                    <a href="{{ route('client.confirm.enf.eroject', $project->uuid) }}" class="btn btn-primary waves-effect waves-light m-0 ms-2">Confirm</a>
                </div>
            </div>
            </div>
        </div>
        @endif
    @endif

    <div class="float-now">
        <button data-bs-toggle="modal" data-bs-target="#createSupportTicket" class="btn btn-primary btn-float-now waves-effect waves-light">support</button>
    </div>
    {{--  support modal --}}
    <div class="modal fade" id="createSupportTicket" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h4 class="modal-title mt-2" id="modalToggleLabel">{{ __('general.create support ticket') }}</h4>
                </div>
                <div class="modal-body">
                    <form id="addProposal" class="row g-3" method="POST" action="{{ route('client.create.support.ticket', $project->id) }}">
                        @csrf
                        <div class="col-12">
                            <label class="form-label w-100" for="title">{{ __('general.supject') }} <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <input id="title" name="title" class="form-control" type="text" placeholder="" required />
                            </div>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="category">{{ __('general.category') }}</label>
                            <select id="category" name="category" class="form-select" required>
                                <option value="" selected disabled="disabled">{{ __('general.category') }}</option>
                                <option value="Payment problems">{{ __('general.Payment problems') }}</option>                              
                                <option value="Problems in the clearance process">{{ __('general.Problems in the clearance process') }}</option>                              
                                <option value="Another question">{{ __('general.Another question') }}</option>                              
                            </select>
                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label w-100" for="description">{{ __('general.Description') }}</label>
                            <div class="input-group input-group-merge">
                                <textarea id="description" name="description" class="form-control" required type="text" ></textarea>
                            </div>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1 w-100">{{ __('general.Submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script>
    $(document).ready( function () {
    
        var table = $('#invoices').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('client.getTProjectInvoices', $project->id) }}",
            columns: [
                {data: 'amount', name: 'amount'},
                {data: 'date', name: 'date'},
                {
                    data: 'status', 
                    name: 'status', 
                    orderable: true, 
                    searchable: true,
                },
                {data: 'action', name: 'action'},
                {
                    data: 'unpaid', 
                    name: 'unpaid', 
                    orderable: false, 
                    searchable: false,
                },
                {
                    data: 'proof', 
                    name: 'proof', 
                    orderable: false, 
                    searchable: false,
                },
            ],
            dom: 'Bfrtip'
        });

    
        $('body').on('click', '#show-details', function () {

            var userURL = $(this).data('url');

            $.get(userURL, function (data) {

                var url = "{{route('client.confirm.invoice.payment', '')}}"+"/"+data.id;

                $('#paymentconfirm').modal('show');

                console.log(data.transaction_id);
                $('#data-code').text(data.code);
                $('#data-note').text(data.note);
                $('#data-amount').text(data.amount);
                $('#invoiceID').val(data.id);
                
                // admin.debit.payout.approve
                if (data.status == 2) {
                    $('#instrumentform').hide();
                } else {
                    $('#instrumentform').show();
                    $('#instrumentform').get(0).setAttribute('action' ,url);
                }
            })

        });

    });

</script>
@endsection