@extends('layouts.agent')
@section('title')
    {{ __('general.home') }}
@endsection

@section('style')
    <style>
        .dt-buttons{
            display: none;
        }
        .dataTables_wrapper{
            padding: 20px 0 !important;
        }
    </style>
@endsection
@section('content')
{{--  status, 0 = new, 1 = accepted, 2 = Ongoing, 3 = Completed, 4 = rejected --}}
<div class="row dash-header row mb-4 shadow-sm">
    <div class="col-md-6 p-md-0">
        <div class="row">
            <div class="col-sm-6 pe-md-0 col-xl-4">
              <div class="card shadow-none bg-label-primary ">
                <div class="card-body">
                  <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                      <span>{{ __('general.My_Proposals') }}</span>
                      <div class="d-flex align-items-center my-2">
                        <h3 class="mb-0 me-2">{{ $proposals->count() }}</h3>
                      </div>
                      <p class="mb-0">{{ __('total_proposals') }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 pe-md-0 col-xl-4">
              <div class="card shadow-none bg-label-info">
                <div class="card-body">
                  <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                      <span>{{ __('general.Ongoing') }}</span>
                      <div class="d-flex align-items-center my-2">
                        <h3 class="mb-0 me-2">{{ $proposals->where('status', 1)->count() }}</h3>
                      </div>
                      <p class="mb-0">{{ __('general.Ongoing_Projects') }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-xl-4">
              <div class="card shadow-none bg-label-success">
                <div class="card-body">
                  <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                      <span>{{ __('general.Completed') }}</span>
                      <div class="d-flex align-items-center my-2">
                        <h3 class="mb-0 me-2">{{ $proposals->where('status', 2)->count() }}</h3>
                      </div>
                      <p class="mb-0">{{ __('general.Completed_Projects') }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 pe-md-0">
        <div class="row h-100">
            <div class="pe-md-0 col-xl-6">
              <div class="card shadow-none bg-dark">
                <div class="card-body" style="padding: 12px;">
                  <div class="d-flex align-items-start justify-content-between rounded bg-dark" style="background: #F8F7FA;padding: 18px;">
                    <div class="content-left">
                      <span class="text-white">{{ __('general.Total_Amount_Received_on_All_Projects') }}</span>
                      <div class="d-flex align-items-center my-2">
                        <h3 class="mb-0 me-2"></h3>
                      </div>
                      <h4 class="mb-0 mt-4 me-2 text-white">{{ $totalAmount }} <sup class="fs-6">SAR</sup></h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-6">
                <div class="card shadow-none bg-dark h-100">
                  <div class="card-body" style="padding: 12px;">
                    <div class="d-flex align-items-start justify-content-between rounded bg-dark" style="background: #F8F7FA;padding: 18px;">
                      <div class="content-left">
                        <span class="text-white">{{ __('general.Total_Amount_Available_in_Wallet') }}</span>
                        <div class="d-flex align-items-center my-2">
                          <h3 class="mb-0 me-2"></h3>
                        </div>
                        <h4 class="mb-0 mt-4 me-2 text-white">{{ auth()->user()->balance() }} <sup class="fs-6">SAR</sup></h4>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header pb-0">
                <h5>{{ __('general.Invites') }}</h5>
            </div>
            <div class="card-body">
                <table class="table yajra-datatable" id="invites">
                    <thead>
                        <tr>
                            <th>{{ __('general.type') }}</th>
                            <th>{{ __('general.from') }}</th>
                            <th>{{ __('general.to') }}</th>
                            <th>{{ __('general.Port') }}</th>
                            <th>{{ __('general.Arrival Date') }}</th>
                            <th>{{ __('general.date') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header pb-0">
                <h5>{{ __('general.My_Proposals') }}</h5>
            </div>
            <div class="card-body">
                <table class="table yajra-datatable" id="proposals">
                    <thead>
                        <tr>
                            <th>{{ __('general.Budget') }}</th>
                            <th>{{ __('general.Note') }}</th>
                            <th>{{ __('general.date') }}</th>
                            <th>{{ __('general.Status') }}</th>
                            <th>{{ __('general.Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="p-3 rounded" style="background: url('{{ asset('backend/assets/img/cardwallet.png') }}');background-repeat: no-repeat;background-size: cover;">
                    <div class="mt-5 mb-3">
                        <h5 class="card-title text-white">{{ __('general.Bank_Transfer') }}</h5>
                        <h6 class="card-subtitle mt-3 text-muted">
                            @if ($userPayoutTypes)
                            IBAN : {{ str_replace(range(0,9), "*", substr($userPayoutTypes->iban, 0, -4)) .  substr($userPayoutTypes->iban, -4) }}
                            @endif
                        </h6>
                    </div>

                </div>
            </div>
            <div class="card-body p-2 pt-0">
                <form class="py-3 px-2 rounded" action="{{ route('agent.withdraw.request') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fs-5 mb-2" for="withdrawRequest">{{ __('general.Withdraw_Request') }}</label>
                        <div class="input-group input-group-merge">
                            <input type="text" id="withdrawRequest" name="amount" class="form-control" aria-describedby="withdrawRequest2">
                            <span id="withdrawRequest2" class="input-group-text text-success">{{ __('general.min') }} 100 SAR</span>

                        </div>
                    </div>
                    <button type="submit" class="w-100 btn btn-primary waves-effect waves-light">{{ __('general.Send') }}</button>
                </form>
                
                <div class="py-3 px-3 mx-2 mb-2 rounded bglight">
                    <h2 class="accordion-header" id="headingPaymentMethod">
                        <button
                          type="button"
                          class="accordion-button collapsed"
                          data-bs-toggle="collapse"
                          data-bs-target="#Setupbankaccount"
                          aria-expanded="false"
                          aria-controls="Setupbankaccount">
                          <i class="ti ti-building-bank me-2 fw-bold"></i> {{ __('general.Setup_Bank_Account') }}
                        </button>
                      </h2>
                      <div
                        id="Setupbankaccount"
                        class="accordion-collapse collapse"
                        aria-labelledby="headingPaymentMethod"
                        data-bs-parent="#collapsibleSection">
                        <form method="post" action="{{ route('agent.add.payout.user.data') }}">
                          @csrf
                          <div class="accordion-body">
                              <div class="mb-3 mt-3">
                                <label class="form-label" for="collapsible-payment-name">IBAN</label>
                                <input type="text" id="collapsible-payment-name" name="iban" class="form-control  @error('iban') is-invalid @enderror" value="" />
                                @error('iban')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                              <div class="mb-3 mt-3">
                                <label class="form-label" for="country">{{ __('general.Country') }}</label>
                                <select id="country" name="country" class="form-select">
                                  <option value="" selected disabled="disabled">{{ __('general.Choose_Country') }}</option>
                                  @foreach ($countries as $country)
                                    <option value="{{ $country->code }}">{{ $country->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="mt-1">
                                  <button type="submit" class="btn btn-primary me-sm-3 me-1">{{ __('general.Send') }}</button>
                              </div>
                          </div>
                        </form>
                      </div>
                </div>
            </div>

        </div>
        
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready( function () {

        var table = $('#invites').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            pageLength: 5,
            ajax: "{{ route('agent.getTAgentInviets') }}",
            columns: [
                {data: 'type', name: 'type'},
                {data: 'countryFrom', name: 'countryFrom'},
                {data: 'countryTo', name: 'countryTo'},
                {data: 'port', name: 'port'},
                {data: 'arrivalDate', name: 'arrivalDate'},
                {data: 'date', name: 'date'},
                
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false,
                },
                
            ],
            dom: 'Bfrtip'
        });


        var table = $('#proposals').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            // pageLength: 5,
            ajax: "{{ route('agentgetProposalsData') }}",
            columns: [
                {data: 'budget', name: 'budget'},
                {data: 'note', name: 'note'},
                {data: 'created_at', name: 'created_at'},
                {
                    data: 'status', 
                    name: 'status', 
                    orderable: true, 
                    searchable: true,
                },
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false,
                },
                
                
            ],
            dom: 'Bfrtip'
        });

    });
</script>
@endsection