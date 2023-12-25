@extends('layouts.client')
@section('title')
{{ __('general.Create_Project') }}
@endsection
@section('content')

<div class="container">
    <h4 class="fw-bold py-3">
        <span class="text-muted fw-light">{{ __('general.Projects') }} /</span> {{ __('general.Create_Project') }}
    </h4>
    
    {{-- <a href="{{ route('client.filesEngine') }}">test ai files Engine</a> --}}

    {{-- 
    ١. استيراد ام تصدير
    ٢. بحري، جوي، بري - الدولة - الميناء
    ٣. مع نقل - موقع واحد او اكثر - إضافة مواقع...
    ٤. رفع الملفات...فاتورة، بوليصة، شهادة منشأ...
    
    --}}

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

    <!-- Property Listing Wizard -->
      <div id="wizard-property-listing" class="bs-stepper vertical mt-2">
        <div class="bs-stepper-header">
          <div class="step" data-target="#clearance-type">
            <button type="button" class="step-trigger">
              <span class="bs-stepper-circle"><i class="ti ti-clipboard ti-sm"></i></span>
              <span class="bs-stepper-label">
                <span class="bs-stepper-title">{{ __('general.Clearance_Type') }}</span>
                <span class="bs-stepper-subtitle">{{ __('general.import/export') }}</span>
              </span>
            </button>
          </div>
          <div class="line"></div>
          <div class="step" data-target="#description-details">
            <button type="button" class="step-trigger">
              <span class="bs-stepper-circle"><i class="ti ti-wand ti-sm"></i></span>
              <span class="bs-stepper-label">
                <span class="bs-stepper-title">{{ __('general.Description') }}</span>
                <span class="bs-stepper-subtitle">{{ __('general.More_About_Goods') }}</span>
              </span>
            </button>
          </div>
          <div class="line"></div>
          <div class="step" data-target="#shipment-details">
            <button type="button" class="step-trigger">
              <span class="bs-stepper-circle"><i class="ti ti-box ti-sm"></i></span>
              <span class="bs-stepper-label">
                <span class="bs-stepper-title">{{ __('general.Shipment_Details') }}</span>
                <span class="bs-stepper-subtitle">{{ __('general.shiping mode / Shipment From-to / Arrival / Bill') }}</span>
              </span>
            </button>
          </div>
          <div class="line"></div>
          <div class="step" data-target="#upload-files">
            <button type="button" class="step-trigger">
              <span class="bs-stepper-circle"><i class="ti ti-folder ti-sm"></i></span>
              <span class="bs-stepper-label">
                <span class="bs-stepper-title">{{ __('general.Upload_Files') }}</span>
                <span class="bs-stepper-subtitle">{{ __('general.Commercial_Files') }} ...</span>
              </span>
            </button>
          </div>
        </div>
        <div class="bs-stepper-content">
          <form id="wizard-property-listing-form" onSubmit="return false" data-action="{{ route('client.project.store') }}" action="{{ route('client.project.store') }}" method="POST" enctype="multipart/form-data" class="te-file-type">
              <!-- Personal Details -->
            @csrf
            <input type="hidden" name="company" value="{{ $company->id }}">
            <input type="hidden" name="payment_mode" value="{{ auth()->user()->project_payment_mode }}">
            <div id="clearance-type" class="content">
              <div class="row g-3">
                <div class="col-12">
                  <div class="row pb-2">
                    <div class="col-md-6 mb-md-0 mb-2 ">
                      <div class="form-check custom-option custom-option-icon">
                        <label class="form-check-label custom-option-content" for="clearanceType1">
                          <span class="custom-option-body">

                            <i class="fa fa-arrow-down iconB"></i>
                            <span class="custom-option-title">{{ __('general.Import') }}</span>
                            <small>{{ __('general.Importing products from other countries to your country') }}</small>

                          </span>
                          <input name="plClearanceType" class="form-check-input" type="radio" value="1" id="clearanceType1" />
                        </label>
                      </div>
                    </div>
                    <div class="col-md-6 mb-md-0 mb-2">
                      <div class="form-check custom-option custom-option-icon">
                        <label class="form-check-label custom-option-content" for="clearanceType2">
                          <span class="custom-option-body">
                            <i class="fa fa-arrow-up iconB"></i>
                            <span class="custom-option-title"> {{ __('general.Export') }} </span>
                            <small>{{ __('general.Exporting products from your country abroad') }}</small>
                          </span>
                          <input name="plClearanceType" class="form-check-input" type="radio" value="2" id="clearanceType2" />
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                
                
                <div class="col-12 d-flex justify-content-between mt-4">
                  <button class="btn btn-label-secondary btn-prev" disabled>
                    <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                    <span class="align-middle d-sm-inline-block d-none">{{ __('general.Previous') }}</span>
                  </button>
                  <button class="btn btn-primary btn-next">
                    <span class="align-middle d-sm-inline-block d-none me-sm-1">{{ __('general.Next') }}</span>
                    <i class="ti ti-arrow-right ti-xs"></i>
                  </button>
                </div>

              </div>
            </div>

            <!-- Property Details -->
            <div id="description-details" class="content">
              <div class="row g-3">
                
                {{-- <div class="col-md-12 mb-2">
                  <label for="plGoodsType" class=" d-block">Goods Type</label>
                  <input type="text" id="plGoodsType" class="form-control" name="plGoodsType" />
                </div> --}}
                
                <div class="col-md-12 mb-2" id="shCodeInput">
                  <label for="plShsearch" class="my-2 fs-5">{{ __('general.HS_Codes') }}</label>
                  <select id="plShsearch" name="plShsearch[]" class="select2 form-select" multiple></select>
                </div>
                
                <div class="col-sm-6">
                  <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" value="1" name="needShiping" id="needShiping" />
                    <label class="form-check-label" for="needShiping">{{ __('general.Do_you_need_to_ship_after_clearance') }}</label>
                  </div>
                </div>

                <div class="col-sm-12" id="needShipingData" style="display: none">
                  <div class="col-sm-4">
                    <label class="form-label d-block" for="deliveryPlace">{{ __('general.Delivery_Address') }}</label>
                    <input type="text" id="deliveryPlace" name="deliveryPlace" class="form-control" placeholder="address" />
                  </div>
                </div>

                <div class="col-12 d-flex justify-content-between mt-4">
                  <button class="btn btn-label-secondary btn-prev">
                    <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                    <span class="align-middle d-sm-inline-block d-none">{{ __('general.Previous') }}</span>
                  </button>
                  <button class="btn btn-primary btn-next">
                    <span class="align-middle d-sm-inline-block d-none me-sm-1">{{ __('general.Next') }}</span>
                    <i class="ti ti-arrow-right ti-xs"></i>
                  </button>
                </div>
              </div>
            </div>

            <!-- Property Features -->
            <div id="shipment-details" class="content">
              <div class="row g-3">
                <div class="row p-0 m-0">
                  <label class="form-label mb-2 mt-4">{{ __('general.Shipping_Mode') }}</label>
                  @forelse ($shiping_modes as $shiping_mode)
                    <div class="col-md mb-md-0 mb-2">
                      <div class="form-check custom-option custom-option-basic">
                        <label class="form-check-label custom-option-content" for="TransportationType-{{ $shiping_mode->id }}">
                          <input class="form-check-input" type="radio" name="plTransportationType" value="{{ $shiping_mode->id }}" id="TransportationType-{{ $shiping_mode->id }}">
                          <span class="custom-option-header">
                            <span class="h6 mb-0">{{ $shiping_mode->name }}</span>
                            <span>{{ __('general.transportation') }}</span>
                          </span>
                          {{-- <span class="custom-option-body">
                            <small> Friday, 15 Nov - Monday, 18 Nov </small>
                          </span> --}}
                        </label>
                      </div>
                    </div>
                  @empty
                    {{ __('general.notFound') }}
                  @endforelse
                </div>
                <div class="col-sm-4">
                  <label class="form-label" for="plCountryFrom">{{ __('general.Shipment From') }}</label>
                  <select id="plCountryFrom" name="plCountryFrom" class="form-select">
                    <option value="" selected disabled="disabled">{{ __('general.Select country') }}</option>
                    @foreach ($countries as $country)
                      <option value="{{ $country->id }}" data-code="{{ $country->code }}">{{ $country->name }}</option>
                    @endforeach
                    
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="form-label" for="plCountryTo">{{ __('general.Shipment to') }}</label>
                  <select id="plCountryTo" name="plCountryTo" class="form-select">
                    <option value="" selected disabled="disabled">{{ __('general.Select country') }}</option>
                    @foreach ($countries as $country)
                      <option value="{{ $country->id }}" data-code="{{ $country->code }}">{{ $country->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="form-label d-block" for="plArrival">{{ __('general.Arrival Date') }}</label>
                  <input type="date" id="plArrival" name="plArrival" class="form-control inputdate" placeholder="YYYY-MM-DD" />
                </div>

                <div class="col-sm-6">
                  <label class="form-label" for="plports">{{ __('general.Port') }}</label>
                  <select id="plports" name="plports" class="form-select">
                    <option selected disabled value="">{{ __('general.Select_Port') }}</option>
                    
                  </select>
                  <small class="text-danger" style="display: none" id="portError"></small>
                </div>
                <div class="col-sm-6">
                  <label class="form-label d-block" for="plBill">{{ __('general.Bill_of_Lading') }}</label>
                  <input type="text" id="plBill" name="plBill" class="form-control" placeholder="EE000000000EE" />
                </div>
                

                <div class="col-12 d-flex justify-content-between mt-4">
                  <button class="btn btn-label-secondary btn-prev">
                    <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                    <span class="align-middle d-sm-inline-block d-none">{{ __('general.Previous') }}</span>
                  </button>
                  <button class="btn btn-primary btn-next">
                    <span class="align-middle d-sm-inline-block d-none me-sm-1">{{ __('general.Next') }}</span>
                    <i class="ti ti-arrow-right ti-xs"></i>
                  </button>
                </div>
              </div>
            </div>

            <!-- Property Area -->
            <div id="upload-files" class="content">
              <div class="row g-3">
                <div class="col-sm-12">
                    <label for="media" class="form-label h5">{{ __('general.Upload_Files') }}</label>
                   
                    {{-- <input class="form-control" type="file" name="media[]" id="media" multiple/> --}}
                    <div class="row targetDiv" id="div1">
                      <div class="col-md-12">
                        <div id="group2" class="fvrduplicate">
                          <div class="row entry">
                            <!-- Field Start -->
                            <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                              <label class="form-label" for="form-repeater-1-1">file</label>
                              <input type="file" name="media[]" id="media" id="form-repeater-1-1" class="form-control" />
                            </div>
                            <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                              <label class="form-label" for="form-repeater-1-2">type</label>
                              <select id="form-repeater-1-2" name="file_type[]" class="form-select">
                                @foreach ($fileTypes as $type)
                                  @if (App::isLocale('ar'))
                                    <option value="{{ $type->id }}">{{ $type->name_ar }}</option>
                                  @else
                                    <option value="{{ $type->id }}">{{ $type->name_en }}</option>
                                  @endif
                                @endforeach
                              </select>
                            </div>
                            <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                              <div class="form-group">
                                <button type="button" class="btn btn-label-success mt-4 waves-effect btn-add">
                                  <i class="fa fa-plus"></i>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                
                <div class="col-12 d-flex justify-content-between mt-4">
                  <button class="btn btn-label-secondary btn-prev">
                    <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                    <span class="align-middle d-sm-inline-block d-none">{{ __('general.Previous') }}</span>
                  </button>
                  <button class="btn btn-success btn-submit btn-next">
                    <span class="align-middle d-sm-inline-block d-none me-sm-1">{{ __('general.Submit') }}</span
                    ><i class="ti ti-check ti-xs"></i>
                  </button>
                </div>
              </div>
            </div>

          </form>
        </div>
      </div>
      <!--/ Property Listing Wizard -->
</div>

<!-- helpPopup -->
{{-- <div class="modal fade" id="helpPopup" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered modal-simple">
      <div class="modal-content p-3 p-md-4">
        <div class="modal-body">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="text-center mb-4">
                <h3 class="mb-2">How to find the HS code</h3>
                <h5 class="text-muted">Add an invoice or payment instrument</h5>
            </div>
        </div>
      </div>
    </div>
</div> --}}
<!--/ helpPopup -->

@endsection


@section('script')


<script type="text/javascript">
  $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script> 

<script>

  $(function() {
      $(document).on('click', '.btn-add', function(e) {
          e.preventDefault();
          var controlForm = $(this).closest('.fvrduplicate'),
              currentEntry = $(this).parents('.entry:first'),
              newEntry = $(currentEntry.clone()).appendTo(controlForm);
          newEntry.find('input').val('');
          controlForm.find('.entry:not(:last) .btn-add')
              .removeClass('btn-add').addClass('btn-remove')
              .removeClass('btn-success').addClass('btn-label-danger')
              .html('<i class="fa fa-minus" aria-hidden="true"></i>');
      }).on('click', '.btn-remove', function(e) {
          $(this).closest('.entry').remove();
          return false;
      });
  });

  // 00----------00

  $(document).ready(function(){
    // get hs code
    $( "#plShsearch" ).select2({
      
      ajax: {
        url: "{{route('getHsCodes')}}",
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
          return {
              _token: '{{ csrf_token() }}',
              search: params.term // search term
          };
        },
        processResults: function (response) {
          console.log(response);
          setTimeout(function(){
              $(".page-loading").fadeOut(300);
          },10);
          return {
            results: response
          };
          
        },
        cache: true
      }

    });

  });



  //  ports get by shiping type
  // $('input[type=radio][name=plTransportationType]').change(function() {
    
  //   let id = this.value;
  //   // id = 0;
  //   let countryId;
  //   let plClearanceType = document.querySelector('input[name="plClearanceType"]:checked').value;

  //   if (plClearanceType == 2) { // import
  //     countryId = $('#plCountryFrom option:selected').val();
  //     portAjax(id,countryId)
  //   }
  //   if (plClearanceType == 1) { // export
  //     countryId = $('#plCountryTo option:selected').val();
  //     portAjax(id,countryId)
  //   }

  // });
    
  $('#plCountryFrom').change(function() {
    plClearanceType = document.querySelector('input[name="plClearanceType"]:checked').value;
    let id = 0;
    if (plClearanceType == 2) { // import
      countryId = $('#plCountryFrom option:selected').attr('data-code');
      console.log(countryId)
      portAjax(id,countryId)
    } 
  });

  $('#plCountryTo').change(function() {
    plClearanceType = document.querySelector('input[name="plClearanceType"]:checked').value;
    let id = 0;
    if (plClearanceType == 1) { // export
      countryId = $('#plCountryTo option:selected').attr('data-code');
      // console.log(countryId)
      portAjax(id,countryId)
    } 
  });

  function portAjax(id, countryId){
    $(document).ajaxSend(function() {
      $(".page-loading").fadeIn(300);　
    });
    $.ajax({
      url  : "{{route('client.getPorts')}}",
      type : "GET",
      data : {
        _token    : '{{ csrf_token() }}',
        id        : id,
        countryId : countryId,
      },
      dataType: "json",
      success: data => {
        console.log(data.ports);
        $('#plports').empty();
        $('#portError').hide();
        data.ports.forEach( function(port){

          if ( "{{ App::isLocale('ar') }}" ) {
            $('#plports').append(`<option value="${port.id}">${port.name_ar}</option>`)
          } else {
            $('#plports').append(`<option value="${port.id}">${port.name_en}</option>`)
          }

          // $('#plports').append(`<option value="${port.id}">${port.name_en}</option>`)

        })
        if(data.ports.length == 0){
          $('#portError').show();
          $('#portError').html('Not Found');
        }
      },error: function () {
        //Empty Output  Div ON Error Returned From Ajax Request
      },
      cache: true
    }).done(function() {
        setTimeout(function(){
            $(".page-loading").fadeOut(300);
        },10);
    });
  }

  $(function(){
      var dtToday = new Date();
  
      var month = dtToday.getMonth() + 1;
      var day = dtToday.getDate();
      var year = dtToday.getFullYear();
      if(month < 10)
          month = '0' + month.toString();
      if(day < 10)
          day = '0' + day.toString();
      
      var maxDate = year + '-' + month + '-' + day;
      $('.inputdate').attr('min', maxDate);
  });

  $("#needShiping").change(function() {
      if(this.checked) {
        $('#needShipingData').fadeIn();
      } else {
        $('#needShipingData').fadeOut();
      }
  });

</script>

@endsection