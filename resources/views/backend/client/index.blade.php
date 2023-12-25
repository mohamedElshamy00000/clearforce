@extends('layouts.client')
@section('title')
    Home
@endsection

@section('content')
{{--  status, 0 = new, 1 = accepted, 2 = Ongoing, 3 = Completed, 4 = rejected --}}

{{-- <div class="d-flex justify-content-between align-items-center">
  <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Dashboard /</span> home</h4>
  <div>
    <a href="{{ route('client.all.projects') }}" class="btn btn-light text-dark menu-link  waves-effect waves-light">manage projects</a>
  </div>
</div> --}}


<div class="row">
  <div class="row m-auto">
    <div class="col-md-12 card mb-4 mt-3 shadow-none alertCard">
      <div class="card-body p-3">
        <p class="title mb-0 text-center"><strong>👋 {{ __('general.Welcome to ClearForce') }}</strong> {{ __('general.Welcome alert description') }}</p>
      </div>
    </div>
  </div>
</div>

<div class="row dash-header mb-4 shadow-sm">
  
    <div class="col-md-8 p-md-0">
        <div class="row">
            <div class="col-sm-6 pe-md-0 col-xl-3">
              <div class="card shadow-none bg-label-primary ">
                <div class="card-body">
                  <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                      <span>{{ __('general.All_Projects') }}</span>
                      <div class="d-flex align-items-center my-2">
                        <h3 class="mb-0 me-2">{{ $projectsCount->count() }}</h3>
                      </div>
                      <p class="mb-0">{{ __('general.Total_Projects') }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 pe-md-0 col-xl-3">
              <div class="card shadow-none bg-label-success">
                <div class="card-body">
                  <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                      <span>{{ __('general.Completed') }}</span>
                      <div class="d-flex align-items-center my-2">
                        <h3 class="mb-0 me-2">{{ $projectsCount->where('status', 3)->count() }}</h3>
                      </div>
                      <p class="mb-0">{{ __('general.Completed_Projects') }} </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 pe-md-0 col-xl-3">
              <div class="card shadow-none bg-label-info">
                <div class="card-body">
                  <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                      <span>{{ __('general.Ongoing') }}</span>
                      <div class="d-flex align-items-center my-2">
                        <h3 class="mb-0 me-2">{{ $projectsCount->where('status', 2)->count() }}</h3>
                      </div>
                      <p class="mb-0">{{ __('general.Ongoing_Projects') }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-xl-3">
              <div class="card shadow-none bg-label-danger">
                <div class="card-body">
                  <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                      <span>{{ __('general.Completed') }}</span>
                      <div class="d-flex align-items-center my-2">
                        <h3 class="mb-0 me-2">{{ $projectsCount->where('status', 4)->count() }}</h3>
                      </div>
                      <p class="mb-0">{{ __('general.Completed_Projects') }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 pe-md-0">
        <div class="row h-100">
            <div class="col-12">
              <div class="card shadow-none bg-dark h-100">
                <div class="card-body" style="padding: 12px;">
                  <div class="d-flex align-items-start justify-content-between rounded bg-dark" style="background: #F8F7FA;padding: 18px;">
                    <div class="content-left">
                      <span class="text-white">{{ __('general.Total_Amount_Received_on_All_Projects') }}</span>
                      <div class="d-flex align-items-center my-2">
                        <h3 class="mb-0 me-2"></h3>
                      </div>
                      <h4 class="mb-0 mt-4 me-2 text-white">{{ $amountSpent }} <sup class="fs-6">SAR</sup></h4>
                    </div>
                    <div class="avatar">
                      <span class="avatar-initial rounded bg-label-dark">
                        <i class="ti ti-cash ti-sm"></i>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-5 myprojects">
        @forelse ($projects as $project)
            <div class="card mb-3 ">
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
                                    <strong>{{ __('general.HS_Codes') }} : </strong><span class="text-muted">
                                      @foreach ($project->hscodes as $hscode)
                                        <span class="badge rounded-pill bg-label-secondary"> {{ $hscode->hs_code }}</span>
                                      @endforeach
                                    </span>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted">{{ $project->arrivalDate > now()->format('Y-m-d') ?  __('general.Arrival Date') . ' : ' . $project->arrivalDate  : 'The shipment is delivered to the port' }}</p>

                                </div>
                            </div>
                        </div>
                        <div class="ms-auto">
                            
                            <div class="dropdown zindex-2">
                                <span class="mx-2">{{ $project->created_at->format('d-m-Y') }}</span>
                                <a type="button" class="btn btn-label-dark btn-sm waves-effect waves-light" href="{{ route('single.project', $project->uuid) }}">{{ __('general.View Activity') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h6 class="mb-1">{{ __('general.from') }} : <span class="text-body fw-normal">{{ $project->countryfrom->name }}</span></h6>
                        
                        <h6 class="mb-1">{{ __('general.to') }}: <span class="text-body fw-normal">{{ $project->countryto->name }}</span></h6>
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
                    @if ($project->ActiveProposal() != false )                 
                    <div class="d-flex align-items-center pt-1">
                        
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
                                    <small class="text-muted"><strong class="text-black">Agent</strong> : {{ $project->ActiveProposal()->agent->name }}</small><br>
                                    <small class="text-muted">{{ $project->ActiveProposal()->agent->email }}</small>
                                </li>
                            </ul>
                        </div>                        
                    </div>
                    @else
                        {{-- <div class="ms-auto">
                                <a href="#" class="text-body"><i class="ti ti-edit ti-sm"></i> Edit</a>
                            </div>  --}}
                    @endif
                    
                </div>
            </div>
        @empty
            
        @endforelse
        
        <div class="mbp_pagination text-center mt30">
            {{ $projects->links('vendor.pagination.bootstrap-4') }}
        </div>
        
    </div>
    <div class="col-md-7">
        <div class="card myinvoices">
            <div class="card-header pb-0">
                <h5 class="mb-0">{{ __('general.Invoices') }}</h5>
            </div>
            <div class="card-body p-0">
                <table class="table yajra-datatable" id="Invoices">
                    <thead>
                        <tr>
                            <th>{{ __('general.amount') }}</th>
                            <th>{{ __('general.status') }}</th>
                            <th>{{ __('general.project') }}</th>
                            <th>{{ __('general.date') }}</th>
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

@section('script')
<script>
    $(document).ready( function () {

        var table = $('#Invoices').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('clientGetInvoices') }}",
            columns: [
                {data: 'amount', name: 'amount'},
                {
                    data: 'status', 
                    name: 'status', 
                    orderable: true, 
                    searchable: true,
                },
                {data: 'project', name: 'project'},
                {data: 'date', name: 'date'},
                
            ],
            dom: 'Bfrtip'
        });

    });

</script>
@endsection