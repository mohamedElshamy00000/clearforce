@extends('layouts.backend')
@section('navicon') <i class="menu-icon tf-icons ti ti-smart-home"></i> @endsection
@section('title') {{ __('general.home') }} @endsection
@section('content')

<div class="d-flex justify-content-between align-items-center">
  <h4 class="fw-bold py-2 mb-0">{{ __('general.Financials') }}</h4>
</div>

<div class="row dash-header mb-4 shadow-sm">
  <div class="col-md-8 p-md-0">
      <div class="row">
          <div class="col-sm-6 pe-md-0 col-xl-4">
            <div class="card shadow-none bg-label-light ">
              <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                  <div class="content-left">
                    <span class="text-dark">{{ __('general.Income') }}</span>
                    <div class="d-flex align-items-center my-2">
                      <h4 class="mb-0 me-2">{{ $paidInvoices }} <sup>SAR</sup></h4>
                    </div>
                    <p class="mb-0 text-dark">{{ __('general.Total') }} / {{ __('general.online payment') }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 pe-md-0 col-xl-4">
            <div class="card shadow-none bg-label-light">
              <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                  <div class="content-left">
                    <span class="text-dark">{{ __('general.Withdraw') }}</span>
                    <div class="d-flex align-items-center my-2">
                      <h4 class="mb-0 me-2">{{ $withdrawInvoices }} <sup>SAR</sup></h4>
                    </div>
                    <p class="mb-0 text-dark">{{ __('general.Withdrawn_Invoices') }} </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-xl-4">
            <div class="card shadow-none bg-label-light">
              <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                  <div class="content-left">
                    <span class="text-dark">{{ __('general.Available') }}</span>
                    <div class="d-flex align-items-center my-2">
                      <h4 class="mb-0 me-2">{{ $paidInvoices - $withdrawInvoices }} <sup>SAR</sup></h4>
                    </div>
                    <p class="mb-0 text-dark">{{ __('general.Available_Cash') }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
  </div>
  <div class="col-md-4">
    <div class="row">
      <div class="col-12 pe-md-0">
        <div class="card shadow-none bg-label-dark">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between">
              <div class="content-left">
                <span class="text-dark">Pending invoices</span>
                <div class="d-flex align-items-center my-2">
                  <h4 class="mb-0 me-2">{{ $unpaidSubInvoices }} <sup>SAR</sup></h4>
                </div>
                <p class="mb-0 text-dark">On project sub-invoices</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="d-flex justify-content-between align-items-center">
  <h4 class="fw-bold py-2 mb-0">{{ __('general.Projects') }}</h4>
</div>

<div class="row dash-header mb-4 shadow-sm">
    <div class="p-md-0">
        <div class="row">
            <div class="col-sm-6 pe-md-0 col-xl-4">
              <div class="card shadow-none bg-label-light ">
                <div class="card-body p-3">
                  <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left text-dark">
                      <span>{{ __('general.All_Projects') }}</span>
                      <div class="d-flex align-items-center my-2">
                        <h3 class="mb-0 me-2">{{ $projects->count() }}</h3>
                      </div>
                      <p class="mb-0">{{ __('general.Total_Projects') }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 pe-md-0 col-xl-4">
              <div class="card shadow-none bg-label-light">
                <div class="card-body p-3">
                  <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left text-dark">
                      <span>{{ __('general.Completed') }}</span>
                      <div class="d-flex align-items-center my-2">
                        <h3 class="mb-0 me-2">{{ $projects->where('status', 3)->count() }}</h3>
                      </div>
                      <p class="mb-0">{{ __('general.Completed_Projects') }} </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-xl-4">
              <div class="card shadow-none bg-label-light">
                <div class="card-body p-3">
                  <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left text-dark">
                      <span>{{ __('general.Ongoing') }}</span>
                      <div class="d-flex align-items-center my-2">
                        <h3 class="mb-0 me-2">{{ $projects->where('status', 2)->count() }}</h3>
                      </div>
                      <p class="mb-0">{{ __('general.Ongoing_Projects') }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center">
    <h4 class="fw-bold py-2 mb-0">{{ __('general.Users') }}</h4>
</div>

<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>{{ __('general.Clients') }}</span>
              <div class="d-flex align-items-center my-1">
                <h4 class="mb-0 me-2">{{ $clients }}</h4>
                {{-- <span class="text-success">(+29%)</span> --}}
              </div>
              <span>{{ __('general.Total_Users') }}</span>
            </div>
            <span class="badge bg-label-primary rounded p-2">
              <i class="ti ti-user ti-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>{{ __('general.Paying_Users') }}</span>
              <div class="d-flex align-items-center my-1">
                <h4 class="mb-0 me-2">{{ $paidUsers }}</h4>
                {{-- <span class="text-success">(+18%)</span> --}}
              </div>
              <span> {{ __('general.Total_Users') }} </span>
            </div>
            <span class="badge bg-label-success rounded p-2">
              <i class="ti ti-cash ti-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>{{ __('general.CRR') }}</span>
              <div class="d-flex align-items-center my-1">
                <h4 class="mb-0 me-2">...</h4>
                {{-- <span class="text-danger">(-14%)</span> --}}
              </div>
              <span>{{ __('general.Customer Retention Rate') }}</span>
            </div>
            <span class="badge bg-label-info rounded p-2">
              <i class="ti ti-user-check ti-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>{{ __('general.Client_Satisfaction') }}</span>
              <div class="d-flex align-items-center my-1">
                <h4 class="mb-0 me-2"> --- </h4>
                <span class="text-success">0.0</span>
              </div>
              <span>{{ __('general.Total_Users') }}</span>
            </div>
            <span class="badge bg-label-warning rounded p-2">
              <i class="ti ti-user-exclamation ti-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center">
    <h4 class="fw-bold py-2 mb-0">{{ __('general.Agents') }}</h4>
</div>

<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>{{ __('general.Agents') }}</span>
              <div class="d-flex align-items-center my-1">
                <h4 class="mb-0 me-2">{{ $agents }}</h4>
                {{-- <span class="text-success">(+29%)</span> --}}
              </div>
              <span>{{ __('general.Total_Agents') }}</span>
            </div>
            <span class="badge bg-label-primary rounded p-2">
              <i class="ti ti-user ti-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>{{ __('general.Verified_Agents') }}</span>
              <div class="d-flex align-items-center my-1">
                <h4 class="mb-0 me-2">{{ $verifiyagents }}</h4>
                <span class="text-success"></span>
              </div>
              <span>{{ __('general.Total_Verified_Agents') }}</span>
            </div>
            <span class="badge bg-label-success rounded p-2">
              <i class="ti ti-user-plus ti-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>{{ __('general.Pending') }}</span>
              <div class="d-flex align-items-center my-1">
                <h4 class="mb-0 me-2">{{ $verifiyPending }}</h4>
                {{-- <span class="text-danger">(-14%)</span> --}}
              </div>
              <span>{{ __('general.Verified Pending') }}</span>
            </div>
            <span class="badge bg-label-info rounded p-2">
              <i class="ti ti-user-check ti-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>{{ __('general.Banned') }}</span>
              <div class="d-flex align-items-center my-1">
                <h4 class="mb-0 me-2"> -- </h4>
                <span class="text-success">0.0</span>
              </div>
              <span>{{ __('general.Total_Agents') }}</span>
            </div>
            <span class="badge bg-label-warning rounded p-2">
              <i class="ti ti-user-exclamation ti-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection

@section('script')

@endsection