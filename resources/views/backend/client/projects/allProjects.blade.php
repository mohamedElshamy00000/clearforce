@extends('layouts.client')
@section('title')
{{ __('general.My_Projects') }}
@endsection
@section('content')

<h4 class="fw-bold py-3"><span class="text-muted fw-light">{{ __('general.Projects') }} /</span> {{ __('general.My_Projects') }}</h4>

<!-- Project Cards -->
<div class="row g-4">

    @forelse ($projects as $project)
        <div class="col-md-4">
            <div class="card">
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
                            
                            <div class="dropdown zindex-2">
                                <a type="button" class="btn btn-dark btn-sm waves-effect waves-light" href="{{ route('single.project', $project->uuid) }}">{{ __('general.View Activity') }}</a>

                                {{-- <button
                                    type="button"
                                    class="btn dropdown-toggle hide-arrow p-0"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    View Activity
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('single.project', $project->uuid) }}">View Activity</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">View details</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Add to favorites</a></li>
                                    <li>
                                    <hr class="dropdown-divider" />
                                    </li>
                                    <li><a class="dropdown-item text-danger" href="javascript:void(0);">Leave Project</a></li>
                                </ul> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center flex-wrap mb-3">
                        @if ($project->Budget != null)
                        <div class="bg-lighter px-3 py-2 rounded me-auto mb-3">
                            {{-- <span>Budget</span> --}}
                            <h6 class="mb-0">{{ __('general.Budget') }} : {{ $project->Budget }} <sup class="text-success">SAR</sup> </h6>
                            {{-- <span>Expected budget</span> --}}
                        </div>
                        @endif
                    
                        <div class="text-start mb-3">
                            <h6 class="mb-1">{{ __('general.date') }}: <span class="text-body fw-normal">{{ $project->created_at->format('d-m-Y') }}</span></h6>
                            @if ($project->needShiping == 1)
                            <h6 class="mb-0">{{ __('general.needShiping') }}</h6>
                            @endif
                        </div>

                        @if ($project->needShiping == 1)
                        <ul class="mb-0 bg-lighter py-2 px-3 w-100">
                            {{-- <li class="mb-2 menu"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-truck-delivery" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                <path d="M5 17h-2v-4m-1 -8h11v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5"></path>
                                <path d="M3 9l4 0"></path>
                            </svg> : {{ $project->truckType }}</li> --}}
                            <li class="mb-2 menu"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pins" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                    <p class="mb-0"><span class="text-info">{{ __('general.Note') }}</span> : {{ $project->note }}</p>
                    @endif
                </div>
                
                <div class="card-body border-top">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h6 class="mb-1">{{ __('general.from') }} : <span class="text-body fw-normal">{{ $project->countryfrom->name }}</span></h6>
                        
                        <h6 class="mb-1">{{ __('general.to') }} : <span class="text-body fw-normal">{{ $project->countryto->name }}</span></h6>
                        
                        <h6 class="mb-1">
                            @if ($project->shipingMode->name == 'Air') 
                                <i class="ti ti-plane-arrival fs-3"></i> 
                            @elseif($project->shipingMode->name == 'Land')
                                <i class="ti ti-truck fs-3"></i>
                            @elseif($project->shipingMode->name == 'Sea')
                                <i class="ti ti-ship fs-3"></i>
                            @endif
                            <span class="text-body fw-normal">
                                @if (App::isLocale('ar'))
                                    {{ $project->port->name_ar }}
                                @else
                                    {{ $project->port->name_en }}
                                @endif    
                            </span>
                        </h6>
                        
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-2 pb-1">
                        <small>{{ $project->arrivalDate > now()->format('Y-m-d') ? __('general.Arrival Date') . ' : ' . $project->arrivalDate  : 'The shipment is delivered to the port' }}</small>
                    </div>
                    
                    {{--  --}}
                    
                    <div class="d-flex align-items-center pt-1">
                        @if ($project->ActiveProposal() != false ) 
                            <div class="d-flex align-items-center">
                                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0 zindex-2 mt-1">
                                    <li
                                        data-bs-toggle="tooltip"
                                        data-popup="tooltip-custom"
                                        data-bs-placement="top"
                                        title="{{ $project->ActiveProposal()->agent->name }}"
                                        class="avatar avatar-sm pull-up me-2">
                                        <img class="rounded-circle" src="{{ asset('backend/assets/img/avatar.svg') }}" alt="Avatar" />
                                    </li>
                                    <li>
                                        <small class="text-muted"><strong class="text-black">{{ __('general.Agent') }}</strong> : {{ $project->ActiveProposal()->agent->name }}</small><br>
                                        <small class="text-muted">{{ $project->ActiveProposal()->agent->email }}</small>
                                    </li>
                                </ul>
                            </div>
                        @else
                           {{-- <div class="ms-auto">
                                <a href="#" class="text-body"><i class="ti ti-edit ti-sm"></i> Edit</a>
                            </div>  --}}
                        @endif
                        
                    </div>
                    
                    
                </div>
            </div>
        </div>
    @empty
        
    @endforelse
    
    <div class="mbp_pagination text-center mt30">
        {{ $projects->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
<!--/ Project Cards -->

@endsection

@section('script')
<script>

</script>
@endsection