@extends('layouts.agent')
@section('title')
    {{ __('general.project details') }}
@endsection
@section('content')

<h4 class="fw-bold py-3"><span class="text-muted fw-light">{{ __('general.project') }} /</span> {{ __('general.project details') }}</h4>


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
<div class="row g-4">
    <div class="col-md-4">

        <div class="card">
            <div class="card-header">
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
                            <div>
                                <strong>{{ __('general.HS_Codes') }} : </strong>
                                @foreach ($project->hscodes as $hscode)
                                    <span class="badge rounded-pill bg-label-secondary"> {{ $hscode->hs_code }}</span>
                                @endforeach    
                            </div>
                            <h6 class="mt-2 mb-0">
                                <span class="text-body fw-normal">{!! $project->Status() !!}</span>
                            </h6>
                        </div>
                    </div>
                    <div class="ms-auto">
                        <div class="zindex-2">
                            <span class="mb-1 d-flex align-items-center"><i class="ti ti-alarm fw-bold fs-3 me-1"></i> <span class="text-body fw-normal">{{ $project->created_at->format('d-m-Y') }}</span></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body ">
                <div class="row m-0 p-0">
                    <div class="col-md-12">
                        <div class="mb-2">
                            <h5>{{ __('general.Shipment_Details') }}</h5>
                            <h6 class="mb-2">{{ __('general.from') }} : <span class="text-body fw-normal">{{ $project->countryfrom->name }}</span></h6>
                            <h6 class="mb-2">{{ __('general.to') }} : <span class="text-body fw-normal">{{ $project->countryto->name }}</span></h6>
                            <h6 class="mb-2">
                                <span class="fw-bold">{{ __('general.payment mode') }} : 
                                    @if ($project->payment_mode == 1)
                                        <span class="badge rounded-pill bg-label-primary">{{ __('general.Payment with every invoice') }}</span>
                                    @elseif($project->payment_mode == 2)
                                        <span class="badge rounded-pill bg-label-success">{{ __('general.Payment after project completion') }}</span>
                                    @endif
                                </span>
                            </h6>
                            <h6 class="mb-2">
                                
                                {{ __('general.Shipping_Mode') }} :
                                <span class="text-body fw-normal">
                                    @if ($project->shipingMode->name == 'Air')
                                        {{ __('general.Air') }}
                                    @elseif($project->shipingMode->name == 'Land')
                                        {{ __('general.Land') }}
                                    @elseif($project->shipingMode->name == 'Sea')
                                        {{ __('general.Ocean') }}
                                    @endif
                                </span>
                            </h6>
                            <h6 class="mb-2">{{ __('general.Port') }} : <span class="text-body fw-normal">
                                
                                @if (App::isLocale('ar'))
                                    {{ $project->port->name_ar }}
                                @else
                                    {{ $project->port->name_en }}
                                @endif 
                            </span></h6>
                            <h6 class="mb-2">
                                {{ __('general.Arrival Date') }} : <span class="text-body fw-normal">{{ $project->arrivalDate > now()->format('Y-m-d') ? $project->arrivalDate  : 'delivered to the port' }}</span>
                            </h6>
                        </div>
                    </div>
                    
                    @if (auth()->user()->supportTransfer === 1)
                    <div class="col-md-12">
                        <div class="flex-wrap">
                            <div class="text-start mb-3">
                                @if ($project->needShiping == 1)
                                <h6 class="mb-0">{{ __('general.needShiping') }}</h6>
                                @endif
                            </div>
                            
                            @if ($project->needShiping == 1)
                                <ul class="mb-0 bg-lighter py-2 px-3 w-100 mb-2">
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
                    </div>
                    @endif
                </div>
                @if ($project->status == 2 && $project->proposals->where('status', 1)->count() > 0)
                    @if ($project->endRequests->count() < 1)
                        <button type="button" class="btn btn-dark waves-effect w-100 mt-3" data-bs-toggle="modal" data-bs-target="#SendCompleteRequest">{{ __('general.complete now') }}</button>
                    @elseif($project->endRequests->count() == 1 && $project->endRequests->first()->status == 1)
                    @elseif ($project->endRequests->count() == 1 && $project->endRequests->first()->status == 0)
                        <button type="button" data-url="{{ route('agent.getEndRequest', $project->uuid) }}" class="btn btn-label-success waves-effect w-100 edit-request-modal mt-3" >{{ __('general.request sent') }} <i class="ti ti-pencil"></i></button>
                    @endif
                @endif
            </div>
        </div>
        {{-- files --}}
        <div class="card card-action mt-4">
            <div class="card-header align-items-center">
                <h5 class="card-action-title mb-0">{{ __('general.files') }}</h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    @forelse ($project->files as $file)
                    <li class="mb-2">
                        <a href="{{ route('file.download', $file->file_name) }}" class="d-flex align-items-center btn btn-outline-dark waves-effect ">
                            <i class="ti ti-file me-2"></i> 

                            <div class="text-start me-2">
                                @if (App::isLocale('ar'))
                                    <h6 class="text-dark mb-0">{{ $file->fileType->name_ar }}</h5>
                                @else
                                    <h6 class="text-dark mb-0">{{ $file->fileType->name_en }}</h5>
                                @endif 
                                <h6 class="mb-0 text-muted">{{ substr($file->file_name, 0, -20) }}...{{ substr($file->file_name, -3, 3) }}</h6>
                            </div>

                            <div class="ms-auto">
                                <span class="btn btn-label-dark btn-icon btn-sm">
                                    <i class="ti ti-arrow-down ti-xs"></i>
                                </span>
                            </div>
                        </a>
                    </li>
                    @empty
                    <li class="mb-3">
                        <div class="alert text-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-archive" width="60" height="60" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"></path>
                                <path d="M5 8v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-10"></path>
                                <path d="M10 12l4 0"></path>
                            </svg>
                        </div>
                    </li>
                    @endforelse
                    
        
                </ul>
            </div>
        
        </div>
    </div>
    <div class="col-8">
        @if ($proposal == null)
            <div class="card mb-4">
                <div class="card-body">
                    <button class="btn btn-dark w-100" data-bs-toggle="modal" data-bs-target="#AgentSendProposal">{{ __('general.Send Proposal') }}</button>                
                </div>
            </div>
        @elseif ($proposal != null)
            <div class="card mb-4 @if ($proposal->status == 0) bg-info @elseif ($proposal->status == 1) bg-success @elseif ($proposal->status == 2) bg-success @endif">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-start">
                            <div class="avatar text-white me-2">
                                @if ($proposal->status == 0)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-bolt fw-normal" width="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M20.984 12.53a9 9 0 1 0 -7.552 8.355"></path>
                                        <path d="M12 7v5l3 3"></path>
                                        <path d="M19 16l-2 3h4l-2 3"></path>
                                    </svg>
                                @elseif ($proposal->status == 1)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trophy-filled" width="40"  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M17 3a1 1 0 0 1 .993 .883l.007 .117v2.17a3 3 0 1 1 0 5.659v.171a6.002 6.002 0 0 1 -5 5.917v2.083h3a1 1 0 0 1 .117 1.993l-.117 .007h-8a1 1 0 0 1 -.117 -1.993l.117 -.007h3v-2.083a6.002 6.002 0 0 1 -4.996 -5.692l-.004 -.225v-.171a3 3 0 0 1 -3.996 -2.653l-.003 -.176l.005 -.176a3 3 0 0 1 3.995 -2.654l-.001 -2.17a1 1 0 0 1 1 -1h10zm-12 5a1 1 0 1 0 0 2a1 1 0 0 0 0 -2zm14 0a1 1 0 1 0 0 2a1 1 0 0 0 0 -2z" stroke-width="0" fill="currentColor"></path>
                                    </svg>
                                @elseif ($proposal->status == 2)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trophy-filled" width="40"  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M17 3a1 1 0 0 1 .993 .883l.007 .117v2.17a3 3 0 1 1 0 5.659v.171a6.002 6.002 0 0 1 -5 5.917v2.083h3a1 1 0 0 1 .117 1.993l-.117 .007h-8a1 1 0 0 1 -.117 -1.993l.117 -.007h3v-2.083a6.002 6.002 0 0 1 -4.996 -5.692l-.004 -.225v-.171a3 3 0 0 1 -3.996 -2.653l-.003 -.176l.005 -.176a3 3 0 0 1 3.995 -2.654l-.001 -2.17a1 1 0 0 1 1 -1h10zm-12 5a1 1 0 1 0 0 2a1 1 0 0 0 0 -2zm14 0a1 1 0 1 0 0 2a1 1 0 0 0 0 -2z" stroke-width="0" fill="currentColor"></path>
                                    </svg>
                                @endif
                            </div>
                            <div class="me-2 ms-1">
                                <h5 class="mb-0 text-white">@if ($proposal->status == 0) {{ __('general.proposal sent') }} @elseif ($proposal->status == 1) {{ __('general.proposal approved') }} @elseif ($proposal->status == 2) {{ __('general.project Completed') }} @endif </h5>
                                <strong class="text-white">{{ $proposal->budget }} SAR</strong>
                            </div>
                        </div>
                        <div class="ms-auto">
                            @if ($proposal->status == 0)
                                <a href="javascript:;"><span class="badge bg-dark">{{ __('general.Pending') }}</span></a>
                            @elseif ($proposal->status == 1)
                                <a href="javascript:;"><span class="badge bg-white text-dark">{{ __('general.approved') }}</span></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Milestone -->
        <div class="card card-action mb-4">
            <div class="card-header align-items-center">
                <h5 class="card-action-title mb-0">{{ __('general.Milestones') }}</h5>
                @if ($proposal != null && $proposal->status == 1 && $project->status == 2)
                    <button id="btnGroupDrop1" type="button" class="btn btn-dark dropdown-toggle waves-effect" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ __('general.Add millstone') }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                        @foreach ($allmillstones as $allmillstone)
                        <a class="dropdown-item" href="{{ route('agent.add.NewMillstone', [$allmillstone->id, $project->id]) }}">{{ $allmillstone->name }}</a>
                        @endforeach
                        <button class="dropdown-item text-primary"  data-bs-toggle="modal" data-bs-target="#AgentAddCustomMillstone">{{ __('general.custom millstone') }}</button>
                    </div>
                @endif
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
                @if ($proposal != null && $proposal->status == 1 && $project->status == 2)
                    <button type="button" class="btn btn-dark waves-effect" data-bs-toggle="modal" data-bs-target="#AgentAddInvoice">
                        {{ __('general.Add invoice') }}
                    </button>
                @endif
            </div>
            <div class="card-body">
                <table class="table yajra-datatable" id="invoices">
                    <thead>
                        <tr>
                            <th>{{ __('general.type') }}</th>
                            <th>{{ __('general.Total') }}</th>
                            {{-- <th>{{ __('general.Note') }}</th> --}}
                            <th>{{ __('general.date') }}</th>
                            <th>{{ __('general.due date') }}</th>
                            <th>{{ __('general.Status') }}</th>
                            <th width="10%">{{ __('general.unpaid') }}</th>
                            <th width="10%">{{ __('general.proof') }}</th>
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

@include('backend.agent.components.modal')


@endsection

@section('script')
<script>
$(document).ready( function () {

    var table = $('#invoices').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        bFilter: false,
        ajax: "{{ route('agent.getTProjectInvoices', $project->id) }}",
        columns: [
            {data: 'invoice_type', name: 'invoice_type'},
            {data: 'amount', name: 'amount'},
            // {data: 'desc', name: 'desc'},
            {data: 'date', name: 'date'},
            {data: 'duedate', name: 'duedate'},
            {
                data: 'status', 
                name: 'status', 
                orderable: true, 
                searchable: true,
            },
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

    // open edit request modal
    $('body').on('click', '.edit-request-modal', function () {

        var userURL = $(this).data('url');

        // $.get(userURL, function (data) {
        //     $('#editCompleteRequest').modal('show');
        //     // $('#data-file').val(data.file_name);
        //     $('#data-restrictions').val(data.restrictions);
        // })

        $.ajax({
            url: userURL,
            type: 'GET',
            success: function(data){ 
                $('#editCompleteRequest').modal('show');
                // $('#data-file').val(data.file_name);
                $('#data-restrictions').val(data.restrictions);

            },
            error: function(data) {
                alert('woops!'); //or whatever
            }
        }).done(function() {
            setTimeout(function(){
                $(".page-loading").fadeOut(300);
            },500);
        });

    });

});
</script>
@endsection