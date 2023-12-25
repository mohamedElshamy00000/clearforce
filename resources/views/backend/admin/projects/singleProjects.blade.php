@extends('layouts.backend')
@section('title')
    Projects
@endsection

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Project /</span>
     @foreach ($project->hscodes as $hscode)
        <span class="badge rounded-pill fs-6 bg-secondary"> 
            {{ $hscode->hs_code . ' - ' . $hscode->item_en }}
        </span>
    @endforeach
</h4>

<!-- project Content -->
<div class="row">
    <div class="col-xl-4 col-lg-5 col-md-5">
      <!-- About project -->
        <div class="card mb-4">
            <div class="card-body">
            
                <small class="card-text text-uppercase">About</small>
                <div class="d-flex justify-content-start align-items-center user-name mt-3">
                    <div class="avatar-wrapper">
                        <div class="avatar me-3">
                            <img src="{{ asset('backend/assets/img/avatar.svg') }}" alt="Avatar" class="rounded-circle">
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <a href="{{ route('admin.users.details', $project->user->id) }}" class="text-body text-truncate fs-6">
                            <span class="fw-bold">{{ $project->user->name }}</span>
                        </a>
                        <span class="fw-muted">{{ $project->user->email }}</span>
                        <small class="text-muted">{{ $project->user->phone }}</small>
                    </div>
                </div>
                <ul class="list-unstyled mb-4 mt-3">
                    @if ($project->type == 1)
                    <svg xmlns="http://www.w3.org/2000/svg" width="23px" class="icon icon-tabler icon-tabler-transfer-in" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M4 18v3h16v-14l-8 -4l-8 4v3"></path>
                        <path d="M4 14h9"></path>
                        <path d="M10 11l3 3l-3 3"></path>
                    </svg>
                    <span class="fw-bold mx-2">type :</span> <span class="mt-3">import</span>
                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" width="23px" class="icon icon-tabler icon-tabler-transfer-out" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M4 19v2h16v-14l-8 -4l-8 4v2"></path>
                        <path d="M13 14h-9"></path>
                        <path d="M7 11l-3 3l3 3"></path>
                    </svg>
                    <span class="fw-bold mx-2">type :</span> <span class="mt-3">export</span>
                    @endif

                    <li class="d-flex align-items-center mt-3">
                        <i class="ti ti-cash"></i>
                        <span class="fw-bold mx-2">payment mode : 
                            <span class="mt-3">
                                @if ($project->payment_mode == 1)
                                    <span class="badge rounded-pill bg-label-primary">{{ __('general.Payment with every invoice') }}</span>
                                @elseif($project->payment_mode == 2)
                                    <span class="badge rounded-pill bg-label-success">{{ __('general.Payment after project completion') }}</span>
                                @elseif($project->payment_mode == 0)
                                    <span class="badge rounded-pill bg-label-info">normal</span>
                                @endif
                            </span>
                        </span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-check"></i><span class="fw-bold mx-2">Status:</span> <span class="mt-3">{!! $project->Status() !!}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-barcode"></i><span class="fw-bold mx-2">Goods type :</span> <span>{{ $project->Goodstype }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-zoom-code"></i><span class="fw-bold mx-2">hS Code :</span>
                        <span>
                            @foreach ($project->hscodes as $hscode)
                                <span class="badge rounded-pill bg-label-secondary"> {{ $hscode->hs_code }}</span>
                            @endforeach
                        </span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-clock"></i><span class="fw-bold mx-2">created at:</span>
                        <span>{{ $project->created_at->format('d-m-Y') }}</span>
                    </li>
                </ul>
                <small class="card-text text-uppercase">Shipment information</small>
                <ul class="list-unstyled mb-4 mt-3">
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-arrow-right"></i><span class="fw-bold mx-2">From :</span>
                        <span>{{ $project->countryfrom->name }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-arrow-left"></i><span class="fw-bold mx-2">To :</span>
                        <span>{{ $project->countryto->name }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-bolt fw-normal" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M20.984 12.53a9 9 0 1 0 -7.552 8.355"></path>
                            <path d="M12 7v5l3 3"></path>
                            <path d="M19 16l-2 3h4l-2 3"></path>
                        </svg>
                        
                        <span class="fw-bold mx-2">Arrival:</span>
                        {{ $project->arrivalDate > now()->format('Y-m-d') ? $project->arrivalDate  : 'delivered to the port' }}
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        @if ($project->shipingMode->name == 'Air')
                            <i class="ti ti-plane-arrival"></i>  - Air
                        @elseif($project->shipingMode->name == 'Land')
                            <i class="ti ti-truck"></i> - Land
                        @elseif($project->shipingMode->name == 'Sea')
                            <i class="ti ti-ship"></i> - Sea
                        @endif
                        <span class="fw-bold mx-2">Port :</span>
                        <span>
                            @if (App::isLocale('ar'))
                                {{ $project->port->name_ar }}
                            @else
                                {{ $project->port->name_en }}
                            @endif
                        </span>
                    </li>
                    <div class="text-start mb-3">
                        @if ($project->needShiping == 1)
                        <small class="card-text text-uppercase">need shiping : </small>
                        @endif
                    </div>

                    @if ($project->needShiping == 1)
                    <ul class="mb-0 bg-lighter py-2 px-3 w-100 ">
                        {{-- <li class="mb-2 menu"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-truck-delivery" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                            <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                            <path d="M5 17h-2v-4m-1 -8h11v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5"></path>
                            <path d="M3 9l4 0"></path>
                        </svg> : {{ $project->truckType }}</li> --}}
                        <li class="menu"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pins" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M10.828 9.828a4 4 0 1 0 -5.656 0l2.828 2.829l2.828 -2.829z"></path>
                            <path d="M8 7l0 .01"></path>
                            <path d="M18.828 17.828a4 4 0 1 0 -5.656 0l2.828 2.829l2.828 -2.829z"></path>
                            <path d="M16 15l0 .01"></path>
                        </svg> : {{ $project->deliveryPlace }}</li>
                    </ul>
                    @endif

                </ul>
                @if ($project->deliveryOrders->count() > 0)
                <small class="card-text text-uppercase">delivery Orders</small>

                @endif

                <table class="table card-table">
                    <tbody class="table-border-bottom-0">
                        @foreach ($project->deliveryOrders as $deliveryOrder)
                        <tr>
                            <td class="ps-0">
                                <div class="d-flex justify-content-start align-items-center">
                                    <div class="me-2">
                                        <i class="ti ti-truck mt-n1"></i> DO-#{{ $deliveryOrder->id }}
                                    </div>
                                    {{-- <div class="dropdown">
                                        <button type="button" class="btn btn-sm btn-label-primary dropdown-toggle waves-effect" data-bs-toggle="dropdown" aria-expanded="false">
                                            @if ($deliveryOrder->status == 0) 
                                                Waiting
                                            @elseif ($deliveryOrder->status == 1)
                                                Loading
                                            @elseif ($deliveryOrder->status == 2)
                                                On the way
                                            @elseif ($deliveryOrder->status == 3)
                                                in warehouse
                                            @endif
                                        </button>
                                        <ul class="dropdown-menu" style="">
                                          <li><a class="dropdown-item" href="javascript:void(0);">Waiting</a></li>
                                          <li><a class="dropdown-item" href="javascript:void(0);">Loading</a></li>
                                          <li><a class="dropdown-item" href="javascript:void(0);">On the way</a></li>
                                          <li><a class="dropdown-item" href="javascript:void(0);">in warehouse</a></li>
                                        </ul>
                                    </div> --}}
                                    <h6 class="mb-0 fw-normal">
                                        @if ($deliveryOrder->status == 0) 
                                            <span class="badge rounded bg-label-info">Waiting</span>
                                        @elseif ($deliveryOrder->status == 1)
                                            <span class="badge rounded bg-label-warning">Loading</span>
                                            @elseif ($deliveryOrder->status == 2)
                                            <span class="badge rounded bg-label-primary">On the way</span>
                                            @elseif ($deliveryOrder->status == 3)
                                            <span class="badge rounded bg-label-success">in warehouse</span>
                                        @endif
                                    </h6>
                                </div>
                            </td>
                                <td class="text-end pe-0 text-nowrap">
                                <h6 class="mb-0">Date <small class="text-muted">{{ $deliveryOrder->deliver_date }}</small></h6>
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
                @if ($project->Budget != null)
                <small class="card-text text-uppercase">Budget</small>

                    <ul class="list-unstyled mb-0 mt-3">
                        <li class="d-flex align-items-center mb-3">
                            <img class="me-2" src="{{ asset('backend/assets/img/clear forces-10.png') }}" width="23px" alt="">
                            <div class="d-flex flex-wrap">
                                <span class="fw-bold me-2">Paltform Budget : </span><span>{{ $project->Budget }}<sup class="text-dark fw-bold"> SAR</sup></span>
                            </div>
                        </li>
                        @if ($project->proposals->where('project_id', $project->id)->where('status',1)->count() > 0)
                        <li class="d-flex align-items-center">
                            <i class="ti ti-cash me-2"></i>
                            <div class="d-flex flex-wrap">
                                <span class="fw-bold me-2">Agent Budget : </span><span>{{ $project->proposals->where('project_id', $project->id)->where('status',1)->first()->budget }}</span>
                            </div>
                        </li>
                        @else
                        <li class="d-flex align-items-center">
                            <i class="ti ti-cash me-2"></i>
                            <div class="d-flex flex-wrap">
                                <span class="fw-bold me-2">Agent Budget : </span> not yet!
                            </div>
                        </li>
                        @endif
                    </ul>
                @endif
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                @if ($project->status == 0 && $project->Budget == null)
                    <button class="btn btn-dark w-100" data-bs-toggle="modal" data-bs-target="#AproveSendProposal">Aprove & Send Proposal</button>
                @else
                    <button class="btn btn-black w-100 disabled"  data-bs-toggle="modal" @if($project->status == 3) disabled='true' @endif data-bs-target="#EditSendProposal">Edit Proposal</button>
                @endif
            </div>
        </div>
    </div>
    <div class="col-xl-8 col-lg-7 col-md-7">

        <div class="card card-action mb-4">
            <div class="card-header align-items-center">
                <h5 class="card-action-title mb-0">Proposals</h5>
                @if ($project->proposals->where('status', 1)->count() == 0)
                    <button  type="button" class="btn btn-dark waves-effect"  data-bs-toggle="modal" data-bs-target="#SelectAgent">
                        Invite Agent
                    </button>

                @endif
            </div>
            <div class="card-body">
                <ul class="mb-0 ps-0">
                    @forelse ($project->proposals as $proposal)
                        <li class="d-flex flex-wrap mb-3">
                            <div class="avatar me-3">
                                <img src="{{ asset('backend/assets/img/avatar.svg') }}" alt="avatar" class="rounded-circle">
                            </div>
                            <div class="d-flex justify-content-between align-items-center flex-grow-1">
                                <div class="me-2">
                                    <p class="mb-0">{{ $proposal->agent->name }}</p>
                                    <p class="mb-0 text-muted">{{ $proposal->agent->email }}</p>
                                    <p class="mb-0 text-muted">{{ $proposal->agent->phone }}</p>
                                    
                                </div>
                                <div class="me-2">
                                    @if ($proposal->status == 0)
                                        <span class="badge bg-label-dark ms-auto ">Pending</span>
                                    @elseif($proposal->status == 1)
                                        <span class="badge bg-label-info ms-auto ">accepted</span>
                                    @elseif($proposal->status == 2)
                                        <span class="badge bg-label-success ms-auto ">Completed</span>
                                    @elseif($proposal->status == 3)
                                        <span class="badge bg-label-primary ms-auto ">rejected</span>
                                    @endif

                                    <h4 class="mb-0">{{ $proposal->budget }} SAR 
                                        @if ($project->Budget != null)
                                            @if (($project->Budget - $proposal->budget) > 0 )
                                                <span class="h6 text-success">( <i class="fa fa-arrow-up"></i> {{ ($project->Budget - $proposal->budget) }} )</span>
                                                @else
                                                <span class="h6 text-danger">( <i class="fa fa-arrow-down"></i> {{ ($project->Budget - $proposal->budget) }} )</span>
                                            @endif
                                        @endif
                                    </h4>
                                    @if ($proposal->note)
                                        <p class="mb-0 text-muted"><strong>Note : </strong>{{ $proposal->note }}</p>
                                    @endif
                                </div>
                                @if ($proposal->status == 0)
                                    <a href="{{ route('admin.project.accept.agent.proposal', $proposal->id) }}" onclick="return confirm('Are you sure you want to approve this agent?');" class="btn btn-dark waves-effect p-2">
                                        <span class="fw-normal d-none d-sm-inline-block">approve <i class="ti ti-circle-check"></i></span>
                                    </a>
                                @elseif ($proposal->status == 1)
                                    <button type="button" class="btn btn-success waves-effect p-2">
                                        <span class="fw-normal d-none d-sm-inline-block">approved <i class="ti ti-check"></i></span>
                                    </button>
                                @endif
                                
                            </div>
                        </li>
                    @empty
                        <span class="flex-wrap mb-3">
                            <div class="alert mb-3 text-center" role="alert">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-archive" width="60" height="60" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"></path>
                                    <path d="M5 8v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-10"></path>
                                    <path d="M10 12l4 0"></path>
                                </svg>
                            </div>
                        </span>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- Milestone -->
        <div class="card card-action mb-4">
            <div class="card-header align-items-center">
                <h5 class="card-action-title mb-0">Milestones</h5>
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

        <!-- Files -->
        <div class="card card-action mb-4">
            <div class="card-header align-items-center">
                <h5 class="card-action-title mb-0">Files</h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    @forelse ($project->files as $file)
                    <li class="mb-2">
                        <a href="{{ route('file.download', $file->file_name) }}" class="d-flex align-items-center btn btn-outline-dark waves-effect ">
                            <i class="ti ti-file me-2"></i> 

                            <div class="text-start me-2">
                                <h6 class="text-dark mb-0">{{ $file->fileType->name_en }}</h5>
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
    
        <!-- invoices table -->
        <div class="card card-action mb-4">
            <div class="card-header align-items-center">
                <h5 class="card-action-title mb-0">Invoices</h5>
                @if ($project->payment_mode == 2)
                    <div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm @if ($checkInvoiceIspayed == true) btn-outline-success @else btn-outline-danger @endif  dropdown-toggle waves-effect" data-bs-toggle="dropdown" aria-expanded="false">
                                CLIENT @if ($checkInvoiceIspayed == true) Paid @else UnPaid @endif : {{ $project->ProjectInvoice->sum('amount') }} SAR
                            </button>
                            @if ($project->ProjectInvoice->sum('amount') > 0 && $checkInvoiceIspayed == false)
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" onclick="return confirm('Are you sure ?')" href="{{ route('admin.credit.projectInvoice.confirm', $project->uuid) }}">Set as paid</a></li>
                            </ul> 
                            @endif
                        </div>
                        <span class="badge rounded bg-label-dark"></span>
                    </div>
                @endif
            </div>
            <table class="table yajra-datatable" id="invoices">
                <thead>
                    <tr>
                        <th>type</th>
                        <th>Amount</th>
                        <th>unpaid</th>
                        <th>proof</th>
                        <th>action</th>
                        <th>due date</th>
                        <th>created</th>
                        <th>status</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <!--/ Projects table -->
    </div>
</div>
  <!--/ Content -->

<div class="modal fade" id="AproveSendProposal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered modal-simple">
        <div class="modal-content p-3 p-md-4">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">Aprove & Send Proposal</h3>
                    <p class="text-muted">Add a price quote for the project</p>
                </div>
                <form id="addProposal" class="row g-3" method="POST" action="{{ route('admin.project.addProposal',  $project->id ) }}">
                    @csrf
                    <div class="col-12">
                        <label class="form-label w-100" for="budget">Add Budget <span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <input id="budget" name="budget" class="form-control" type="number" placeholder="400" required />
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
</div>

<div class="modal fade" id="EditSendProposal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered modal-simple">
        <div class="modal-content p-3 p-md-4">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">Edit Proposal</h3>
                    <p class="text-muted">edit a price for the project</p>
                </div>
                <form id="addProposal" class="row g-3" method="POST" action="{{ route('admin.project.editProposal',  $project->id ) }}">
                    @csrf
                    <div class="col-12">
                        <label class="form-label w-100" for="budget">Add Budget <span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <input id="budget" name="budget" class="form-control" type="number" placeholder="400" required />
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
</div>

<div class="modal fade" id="SelectAgent" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered modal-simple">
        <div class="modal-content p-3 p-md-4">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">Send invitation to agents</h3>
                    <p class="text-muted">Choose an agent for clearance</p>
                </div>
                <form id="FormSelectAgent" class="row g-3" method="POST" action="{{ route('admin.project.invite.agent') }}">
                    @csrf
                    <input type="hidden" name="projectId" value="{{ $project->id }}">
                    <div class="col-md-12 mb-4">
                        <label for="select2Basic" class="form-label">Agents</label>

                        <div class="row m-0">
                            <div class="col-md-10 p-0 m-0">
                                <select id="select2Basic" multiple name="agents[]" class="select2 form-select form-select-lg" required data-allow-clear="true">
                                    @foreach ($agents as $agent)
                                        @if ($agent->hasRole('agent'))
                                            @if ($project->proposals->where('user_id', $agent->id)->count() > 0)
                                            <option disabled value="{{ $agent->id }}" class="text-danger">
                                                {{ $agent->name }} ( Submitted to this project )
                                            </option>   
                                            @else 
                                            <option value="{{ $agent->id }}">
                                                {{ $agent->name }}
                                            </option>                                  
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 p-0 m-0">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1 w-100">Send</button>        
                            </div>
                        </div>
                    </div>
                </form>
                <div class="col-md-12 mb-2">
                    <h6 class="mb-4">Suggestions</h6>
                    @foreach ($suggestions as $suggestion)
                    @if ($suggestion->hasRole('agent'))
                        @if ($project->proposals->where('user_id', $suggestion->id)->count() == 0)
                        <div class="border rounded py-2 px-3 d-flex justify-content-between flex-wrap gap-2">
                            <div class="d-flex flex-wrap">
                                <div class="avatar me-3">
                                <img src="{{ asset('backend/assets/img/avatar.svg') }}" alt="Avatar" class="rounded-circle">
                                </div>
                                <div>
                                <p class="mb-0">{{ $suggestion->name }}</p>
                                <span class="text-muted">{{ $suggestion->email }}</span>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap align-items-center cursor-pointer">
                                <button type="button" class="btn btn-icon btn-dark waves-effect">
                                    <span class="ti ti-send"></span>
                                </button>
                            </div>
                        </div>    
                                                
                        @endif
                    @endif
                    
                    @endforeach
                </div>
                    
            </div>
        </div>
    </div>
</div>

@endsection


@push('script')
    <script>
    var table = $('#invoices').DataTable({

        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ route('admin.getTProjectInvoices', $project->id) }}",
        columns: [
            {data: 'type', name: 'type'},
            {data: 'amount', name: 'amount'},
            {data: 'unpaid', name: 'unpaid'},
            {data: 'proof', name: 'proof'},
            {data: 'action', name: 'action'},
            {data: 'dueDate', name: 'dueDate'},
            {data: 'created_at', name: 'created_at'},
            {
                data: 'status', 
                name: 'status',
                orderable: false, 
                searchable: false,
            },
        ],
        
        dom: 'Bfrtip'
    });
    </script>
@endpush