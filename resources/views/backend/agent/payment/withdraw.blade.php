@extends('layouts.agent')
@section('title')
    {{ __('general.Payout History') }}
@endsection
@section('content')

    <div class="row">
        <div class="col-4">
            <div class="card">
              <div class="card-header">
                <div class="d-flex justify-content-between mb-3">
                  <h5 class="card-title mb-0">{{ __('general.Statistics') }}</h5>
                  <small class="text-muted">{{ __('general.Updated') }}</small>
                </div>
              </div>
              <div class="card-body">
                <div class="row gy-3">
                  <div class="col-md-6 col-12">
                    <div class="d-flex align-items-center">
                      <div class="badge rounded-pill bg-label-primary me-3 p-2"><i class="ti ti-cash ti-sm"></i></div>
                      <div class="card-info">
                        <h5 class="mb-0">{{ $totalAmount .' SAR' }}</h5>
                        <small>{{ __('general.Total_Amount_Received_on_All_Projects') }}</small>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="d-flex align-items-center">
                      <div class="badge rounded-pill bg-label-info me-3 p-2"><i class="ti ti-credit-card ti-sm"></i></div>
                      <div class="card-info">
                        <h5 class="mb-0">{{ auth()->user()->balance() . ' SAR'}}</h5>
                        <small>{{ __('general.Total_Amount_Available_in_Wallet') }}</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">

                <!-- Column Search -->
                <div class="">
                    <table class="table yajra-datatable" id="result2">
                        <thead>
                            <tr>
                                <th>{{ __('general.Amount') }}</th>
                                <th>{{ __('general.purpose') }}</th>
                                <th>{{ __('general.date') }}</th>
                                <th>{{ __('general.Status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!--/ Column Search -->
            
                @include('backend.admin.components.models.payoutShow')
            
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready( function () {

            var table = $('#result2').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('agent.getTPayoutHistory') }}",
                columns: [
                    // {data: 'id', name: 'id'},
                    {data: 'amount', name: 'amount'},
                    {data: 'purpose', name: 'purpose'},
                    {data: 'date', name: 'date'},
                    {
                        data: 'status', 
                        name: 'status', 
                        orderable: true, 
                        searchable: true,
                    }
                ],
                dom: 'Bfrtip'
            });


        });
    </script>
@endsection