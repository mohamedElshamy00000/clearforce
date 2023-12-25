@extends('layouts.agent')
@section('title')
{{ __('general.Explore_Projects') }}
@endsection
@section('content')

<h4 class="fw-bold py-3"><span class="text-muted fw-light">{{ __('general.Projects') }} /</span>  @if ( !empty($searchCount) ) search result ({{ $searchCount }}) @else {{ __('general.Explore_Projects') }} @endif</h4>

<!-- Project Cards -->
<div class="row g-4">
    <div class="col-md-8">
        <div class="row">
            @forelse ($projects as $project)
                <div class="col-md-12 mb-3">
                    <div class="card">
                        
                        <div class="card-header">
                            <div class="d-flex align-items-start">
                                <div data-url="{{ route('agentExpoloreSingleProjectData', $project->id) }}"  class="show-project d-flex align-items-start" style="cursor: pointer">
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
                                            
                                        </div>
                                        @foreach ($project->hscodes as $hscode)
                                            <span class="mt-2 badge rounded-pill bg-label-secondary"> {{ $hscode->hs_code }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="ms-auto">
                                    <div class="dropdown zindex-2">
                                        @if ( $project->proposals->where('user_id', Auth::user()->id)->count() == 0 )
                                        <a type="button" class="btn btn-dark btn-sm waves-effect waves-light" href="{{ route('agent.single.projects', $project->uuid) }}">
                                            {{ __('general.View Activity') }}
                                        </a>
                                        @else
                                        <a type="button" class="btn btn-success btn-sm waves-effect waves-light" href="{{ route('agent.single.projects', $project->uuid) }}">
                                            {{ __('general.View Activity') }}
                                        </a>  
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (auth()->user()->supportTransfer == 1)
                        <div class="card-body">
                            <div class="d-flex align-items-center flex-wrap">
                            
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
                            
                        </div>
                        @endif
                        <div class="card-body border-top">

                            <div class="d-flex align-items-center justify-content-between mb-2 mt-4">
                                <h6 class="mb-1">{{ __('general.from') }} : <span class="text-body fw-normal">{{ $project->countryfrom->name }}</span></h6>
                                <h6 class="mb-1">{{ __('general.to') }} : <span class="text-body fw-normal">{{ $project->countryto->name }}</span></h6>
                                <h6 class="mb-0">
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
                            
                        </div>
                    </div>
                </div>
            @empty
                <div class="misc-wrapper text-center d-flex justify-content-center align-items-center ">
                    {{-- <div><h2 class="mb-1 mt-4">Projects Not Found :(</h2></div> --}}
                    <div class="mt-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-archive" width="100" height="100" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"></path>
                            <path d="M5 8v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-10"></path>
                            <path d="M10 12l4 0"></path>
                        </svg>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <div class="col-xl-4 col-lg-5 col-md-5" id="singleProjectContent" style="display: none">
        <!-- About project -->
    </div>
    <div class="col-xl-4 col-lg-5 col-md-5" id="searchBar">
        <div class="card mb-3">
            <div class="card-header border-bottom">
                
                <div class="card-title mb-3 d-flex justify-content-between">
                    <h5 class="card-title mb-0">{{ __('general.Search Filter') }}</h5>
                    <a href="{{ route('agent.expolore.projects') }}" class="text-muted">{{ __('general.reset') }}</a>
                </div>
                <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
                    <form action="{{ route('agent.explore.search') }}" method="POST">
                        <!-- Property Features -->
                        @csrf
                        <div id="shipment-details" class="content">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="row pb-2">
                                      <div class="col-md-6 mb-md-0 mb-2 ">
                                        <div class="form-check custom-option custom-option-icon">
                                          <label class="form-check-label custom-option-content" for="clearanceType1">
                                            <span class="custom-option-body">
                                              <span class="custom-option-title">{{ __('general.Import') }}</span>
                                            </span>
                                            <input name="plClearanceType"  class="form-check-input" type="radio" value="1" id="clearanceType1" />
                                          </label>
                                        </div>
                                      </div>
                                      <div class="col-md-6 mb-md-0 mb-2">
                                        <div class="form-check custom-option custom-option-icon">
                                          <label class="form-check-label custom-option-content" for="clearanceType2">
                                            <span class="custom-option-body">
                                              <span class="custom-option-title"> {{ __('general.Export') }} </span>
                                            </span>
                                            <input name="plClearanceType" class="form-check-input" type="radio" value="2" id="clearanceType2" />
                                          </label>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                <div class="row p-0 m-0">
                                    <label class="form-label mb-2">{{ __('general.Shipping_Mode') }}</label>
                                    @forelse ($shiping_modes as $shiping_mode)
                                    <div class="col-md mb-md-0 mb-2">
                                        <div class="form-check custom-option custom-option-basic">
                                        <label class="form-check-label custom-option-content" for="TransportationType-{{ $shiping_mode->id }}">
                                            <input class="form-check-input" type="radio" name="plTransportationType" value="{{ $shiping_mode->id }}" id="TransportationType-{{ $shiping_mode->id }}">
                                            <span class="custom-option-header pb-0">
                                            <span class="h6 mb-0">{{ $shiping_mode->name }}</span>
                                        </label>
                                        </div>
                                    </div>
                                    @empty
                                    {{ __('general.notFound') }}
                                    @endforelse
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="plCountryFrom">{{ __('general.Shipment From') }}</label>
                                    <select id="plCountryFrom" name="plCountryFrom" class="form-select">
                                    <option value="" selected disabled="disabled">{{ __('general.Choose_Country') }}</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                    
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="plCountryTo">{{ __('general.Shipment to') }}</label>
                                    <select id="plCountryTo" name="plCountryTo" class="form-select">
                                    <option value="" selected disabled="disabled">{{ __('general.Choose_Country') }}</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                
                                <div class="col-sm-12">
                                    <label class="form-label" for="plports">{{ __('general.Port') }}</label>
                                    <select id="plports" name="plports" class="form-select">
                                    <option selected disabled value="">{{ __('general.Select_Port') }}</option>
                                    </select>
                                    <small class="text-danger" style="display: none" id="portError"></small>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="w-100 btn btn-dark waves-effect waves-light mt-4">{{ __('general.Search') }}</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="mbp_pagination text-center mt30">
        @if ($projects->count() > 0)
        {{ $projects->links('vendor.pagination.bootstrap-4') }}
        @endif
    </div>
</div>
<!--/ Project Cards -->

@endsection

@section('script')
<script>
$(document).ready(function () {
    $('#searchBar').fadeIn();
    $('#singleProjectContent').fadeOut();
    $('body').on('click', '.closeMin', function () {
        $('#searchBar').fadeIn();
        $('#singleProjectContent').fadeOut();
    })

    $('body').on('click', '.show-project', function () {
        $('#searchBar').fadeOut();
        $('#singleProjectContent').fadeIn();
        var userURL = $(this).data('url');
        
        $(document).ajaxSend(function() {
            $(".page-loading").fadeIn(300);　
        }); 
        $.ajax({
            url: userURL,
            type: 'GET',
            success: function(data){ 
                console.log(data);
                var html        = '',
                type        = data.type,
                countryTo   = data.countryTo,
                countryFrom = data.countryFrom,
                arrivalDate = data.arrivalDate,
                port        = data.port_id,
                shpingWay   = '',
                route       = `{{URL::to('dashboard/agent/SingleProject/${data.uuid}')}}`;
                if (type == 1) {
                    projectType = `
                        <svg xmlns="http://www.w3.org/2000/svg" width="23px" class="icon icon-tabler icon-tabler-transfer-in" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M4 18v3h16v-14l-8 -4l-8 4v3"></path>
                            <path d="M4 14h9"></path>
                            <path d="M10 11l3 3l-3 3"></path>
                        </svg>
                        <span class="fw-bold mx-2">type :</span> <span class="mt-3">import</span>
                    `;
                }else{
                    projectType = `
                        <svg xmlns="http://www.w3.org/2000/svg" width="23px" class="icon icon-tabler icon-tabler-transfer-out" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M4 19v2h16v-14l-8 -4l-8 4v2"></path>
                            <path d="M13 14h-9"></path>
                            <path d="M7 11l-3 3l3 3"></path>
                        </svg>
                        <span class="fw-bold mx-2">type :</span> <span class="mt-3">export</span>
                    `;
                }
                if (data.shiping_mode.name == 'Air') {
                    shpingWay += `<i class="ti ti-plane-arrival"></i>  - Air`;
                }
                else if(data.shiping_mode.name == 'Land'){
                    shpingWay += `<i class="ti ti-truck"></i> - Land`;
                }
                else if(data.shiping_mode.name == 'Sea'){
                    shpingWay += `<i class="ti ti-ship"></i> - Sea`;
                }
                html += `
                <div class="card mb-4">
                <div class="card-body">
                    <li class="list-inline-item closeMin" style="float: right;">
                        <a href="javascript:void(0);" class="card-close"><i class="tf-icons ti ti-x ti-sm"></i></a>
                    </li>
                    <small class="card-text text-uppercase">About</small>
                    
                    <ul class="list-unstyled mb-4 mt-3">
                        ${ projectType }
                        <li class="d-flex align-items-center mb-3 mt-2">
                            <i class="ti ti-clock"></i><span class="fw-bold mx-2">created at:</span>
                            <span>${ dateFormat(data.created_at, 'MM-dd-yyyy')}</span>
                        </li>
                    </ul>
                    <small class="card-text text-uppercase">Shipment information</small>
                    <ul class="list-unstyled mb-4 mt-3">
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-arrow-right"></i><span class="fw-bold mx-2">From :</span>
                            <span>${ data.countryfrom.name }</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-arrow-left"></i><span class="fw-bold mx-2">To :</span>
                            <span>${ data.countryto.name }</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-bolt fw-normal" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M20.984 12.53a9 9 0 1 0 -7.552 8.355"></path>
                                <path d="M12 7v5l3 3"></path>
                                <path d="M19 16l-2 3h4l-2 3"></path>
                            </svg>
                            
                            <span class="fw-bold mx-2">Arrival:</span>
                            ${ data.arrivalDate }
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            ${ shpingWay }
                            <span class="fw-bold mx-2">Port :</span>
                            <span>${ data.port.name }</span>
                        </li>
                    </ul>
                    <a href="${ route }" type="button" class="w-100 btn btn-dark waves-effect waves-light">View Details</a>
                    </div>
                </div>
                `;
            
                $('#singleProjectContent').html('');
                $('#singleProjectContent').append(html);
                // console.log(html);
            },
            error: function(data) {
                alert('woops!'); //or whatever
            }
        }).done(function() {
            setTimeout(function(){
                $(".page-loading").fadeOut(300);
            },10);
        });

    });
});

//  ports get by shiping type
$('input[type=radio][name=plTransportationType]').change(function() {
    
    id = this.value;
    let countryId;
    let plClearanceType = document.querySelector('input[name="plClearanceType"]:checked').value;

    if (plClearanceType == 1) { // import
        countryId = $('#plCountryFrom option:selected').val();
        portAjax(id,countryId)
    }
    if (plClearanceType == 2) { // export
        countryId = $('#plCountryTo option:selected').val();
        portAjax(id,countryId)
    }

});
    
$('#plCountryFrom').change(function() {
    plClearanceType = document.querySelector('input[name="plClearanceType"]:checked').value;

    if (plClearanceType == 1) { // import
        countryId = $('#plCountryFrom option:selected').val();
        // console.log(countryId)
        portAjax(id,countryId)
    } 
});

$('#plCountryTo').change(function() {
    plClearanceType = document.querySelector('input[name="plClearanceType"]:checked').value;

    if (plClearanceType == 2) { // export
        countryId = $('#plCountryTo option:selected').val();
        // console.log(countryId)
        portAjax(id,countryId)
    } 
});

function portAjax(id, countryId){
    $.ajax({
        url  : "{{route('agent.getPorts')}}",
        type : "GET",
        data : {
            _token    : '{{ csrf_token() }}',
            id        : id,
            countryId : countryId,
        },
        dataType: "json",
        success: data => {
            // console.log(data.ports);
            $('#plports').empty();
            $('#portError').hide();
            data.ports.forEach( port =>
            $('#plports').append(`<option value="${port.id}">${port.name}</option>`)
            )
            if(data.ports.length == 0){
                $('#portError').show();
                $('#portError').html('Not Found');
            }
        },error: function () {
            //Empty Output  Div ON Error Returned From Ajax Request
        },
        cache: true
    })
}

</script>
@endsection