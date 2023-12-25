@extends('layouts.client')

@section('title')
{{ __('general.create delivary order') }}
@endsection

@section('content')
<link href="{{ asset('backend/assets/css/print.css') }}" rel="stylesheet" media="print" type="text/css">

<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">{{ __('general.storage') }} /</span> {{ __('general.create delivary order') }}
</h4>

<div class="row ">
    <!-- Add-->
    <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
      <div class="card preview-card printable">
        <div class="card-body">
            <form class="source-item pt-4 px-0" action="{{ route('client.storage.store.deliveryOrder') }}" method="POST">
                @csrf
                <input type="hidden" name="company_id" value="{{ $company->id }}">
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                <div class="row m-0">
                    <div class="col-md-7 mb-md-0 mb-4 ps-0">
                        <div class="d-flex svg-illustration mb-4 gap-2 align-items-center">
                            <span class="fw-bold fs-4"> {{ $company->name }} </span>
                        </div>
                        <p class="mb-2">{{ __('general.Address') }} : {{ $company->address }}</p>
                        <p class="mb-3">{{ __('general.registration NO') }} : {{ $company->registration }}</p>
                    </div>
                    <div class="col-md-5">
                    <dl class="row mb-2">
                        <dt class="col-sm-6 mb-2 mb-sm-0 text-md-start ps-0">
                            <span class="h4 text-capitalize mb-0 text-nowrap">{{ __('general.delivary order') }}</span>
                        </dt>
                        <dd class="col-sm-6 d-flex justify-content-md-end pe-0 ps-0 ps-sm-2">
                            <div class="input-group input-group-merge disabled w-px-150">
                                <span class="input-group-text">#</span>
                                <input type="text" class="form-control" disabled placeholder="" value="{{ $order->id }}" />
                            </div>
                        </dd>
                        <dt class="col-sm-6 mb-2 mb-sm-0 text-md-start ps-0">
                            <span class="fw-normal">{{ __('general.deliver date') }}</span>
                        </dt>
                        <dd class="col-sm-6 d-flex justify-content-md-end pe-0 ps-0 ps-sm-2">
                            <input type="date" name="deliver_date" class="@error('deliver_date') is-invalid @enderror form-control w-px-150" disabled value="{{ $order->deliver_date  }}" placeholder="YYYY-MM-DD" />
                            @error('deliver_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </dd>
                        <dt class="col-sm-6 mb-2 mb-sm-0 text-md-start ps-0">
                            <span class="fw-normal">{{ __('general.deliver time') }}</span>
                        </dt>
                        <dd class="col-sm-6 d-flex justify-content-md-end pe-0 ps-0 ps-sm-2">
                            <input type="time" name="deliver_time" class="@error('deliver_time') is-invalid @enderror form-control w-px-150" disabled value="{{ $order->deliver_time }}"/>
                            @error('deliver_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </dd>
                    </dl>
                    </div>
                </div>

                <hr class="my-3 mx-n4" />

                <div class="row p-0 py-3">
                    <label for="salesperson" class="form-label me-4 fw-semibold">{{ __('general.Address') }}:</label>

                    <div class="col-md-6 mb-md-0 mb-4">
                        <input type="text" class="form-control @error('deliver_to') is-invalid @enderror" name="deliver_to" placeholder="deliver to" disabled value="{{ $order->deliver_to }}"/>
                        @error('deliver_to')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-md-0 mb-4">
                        <input type="text" class="@error('deliver_address') is-invalid @enderror form-control" name="deliver_address" placeholder="deliver address" disabled value="{{ $order->deliver_address }}"/>
                        @error('deliver_address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <hr class="my-3 mx-n4" />

                <div class="mb-3" data-repeater-list="group-a">
                    <div class="repeater-wrapper pt-0 pt-md-4" data-repeater-item>
                        <div class="d-flex border rounded position-relative pe-0">
                            <div class="row w-100 p-3">
                                <div class="col-md-10 col-12 mb-md-0 mb-3">
                                    <p class="mb-2 repeater-title">Item</p>
                                    <textarea class="@error('description') is-invalid @enderror form-control" rows="4" name="description" placeholder="Item Information" disabled>{!! $order->description !!}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-2 col-12 mb-md-0 mb-3">
                                    <p class="mb-2 repeater-title">Qty</p>
                                    <input type="number" class="@error('qty') is-invalid @enderror form-control" name="qty" min="1" value="{{ $order->qty }}" disabled/>
                                    @error('qty')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row ">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="note" class="form-label fw-semibold">Note:</label>
                            <textarea class="form-control" rows="2" id="note" name="remarks" disabled placeholder="note">{{ $order->remarks }}</textarea>
                        </div>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
    <!-- / Add-->
    <!-- order Actions -->
    <div class="col-xl-3 col-md-4 col-12">
        <div class="card">
          <div class="card-body">
              {{-- <a class="btn btn-primary d-grid w-100 mb-2" target="_blank" href="{{ route('clinet.downlaod.invoice', $project->uuid) }}">Download</a> --}}
              <button class="print-window btn btn-primary d-grid w-100">
                  Print
              </button>
          </div>
        </div>
    </div>
    <!-- /order Actions -->
</div>

@endsection

@section('script')
<script>
$('.print-window').click(function() {
    window.print();
});
</script>
@endsection