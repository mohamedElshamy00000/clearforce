@extends('layouts.client')

@section('title')
{{ __('general.Invoices') }}
@endsection

@section('content')
<link href="{{ asset('backend/assets/css/print.css') }}" rel="stylesheet" media="print" type="text/css">

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ __('general.Invoices') }} /</span> {{ __('general.Details') }}</h4>

<div class="row invoice-preview">
    <!-- Invoice -->
    <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
      <div class="card invoice-preview-card printable">
        <div class="card-body">
          <div
            class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
            <div class="mb-xl-0 mb-4">
                <div class="d-flex svg-illustration mb-4 gap-2 align-items-center">
                    <img src="{{ asset('backend/assets/img/logo-dark2x.png') }}" width="200px" alt="">
                </div>
                <p class="mb-2">{{ App\Models\Setting::where('id', 1)->first()->productName }}</p>
                <p class="mb-2">{{ App\Models\Setting::where('id', 1)->first()->productDescription }}</p>
                <p class="mb-2">{{ App\Models\Setting::where('id', 1)->first()->address }}</p>
                <p class="mb-3">{{ App\Models\Setting::where('id', 1)->first()->phone }}</p>
            </div>
            <div>
              <h4 class="fw-semibold mb-2">INVOICE #{{ $project->Invoice->id }}</h4>
              <div class="mb-2 pt-1">
                <span>Date Issues:</span>
                <span class="fw-semibold">{{ $project->Invoice->created_at->format('d-m-Y') }}</span>
              </div>
            </div>
          </div>
        </div>
        <hr class="my-0" />
        <div class="card-body">
          <div class="row p-sm-3 p-0">
            <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
              <h6 class="mb-3">Invoice To:</h6>
              <p class="mb-1">{{ auth()->user()->name }}</p>
              <p class="mb-1">{{ auth()->user()->company }}</p>
              <p class="mb-1">{{ auth()->user()->address  }}</p>
              <p class="mb-1">{{ auth()->user()->phone }}</p>
              <p class="mb-0">{{ auth()->user()->email }}</p>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <div class="invoice-calculations">
                  <div class="d-flex justify-content-between mb-2">
                    <span class="w-px-100">Subtotal:</span>
                    <span class="fw-medium">{{ $subtotal }} sar</span>
                  </div>
                  <div class="d-flex justify-content-between mb-2">
                    <span class="w-px-100">Tax:</span>
                    <span class="fw-medium">({{ $taxs }}%) {{ $taxsCalc }} sar</span>
                  </div>
                  <hr>
                  <div class="d-flex justify-content-between">
                    <span class="w-px-100">Total:</span>
                    <span class="fw-medium">{{ $total }} sar</span>
                  </div>
                </div>
            </div>
          </div>
        </div>
        <div class="table-responsive border-top">
          <table class="table m-0">
            <thead>
              <tr>
                <th>Item</th>
                <th>Description</th>
                <th>date</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-nowrap">{{ $project->Invoice->comment }}</td>
                    <td class="text-nowrap">customs clearnace service</td>
                    <td>{{ $project->Invoice->created_at->format('d/m/Y') }}</td>
                    <td>{{ $project->Invoice->amount }} sar</td>
                </tr>
                @foreach ($project->ProjectInvoice as $pInvoice)
                <tr>
                    <td class="text-nowrap">{{ $pInvoice->code }}</td>
                    <td class="text-nowrap">{{ $pInvoice->desc }} - Off-platform payment</td>
                    <td>{{ $pInvoice->created_at->format('d/m/Y') }}</td>
                    <td>{{ $pInvoice->amount }} sar</td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <div class="card-body mx-3">
          <div class="row">
            <div class="col-12">
              <span class="fw-semibold">Note:</span>
              <span>It was a pleasure working with you and your team. We hope you will keep us in mind for future projects. Thank You!</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /Invoice -->

    <!-- Invoice Actions -->
    <div class="col-xl-3 col-md-4 col-12 invoice-actions">
      <div class="card">
        <div class="card-body">
            <button
                class="btn btn-primary d-grid w-100 mb-2"
                data-bs-toggle="offcanvas"
                data-bs-target="#sendInvoiceOffcanvas">
                <span class="d-flex align-items-center justify-content-center text-nowrap">
                <i class="ti ti-send ti-xs me-1"></i>Send Invoice</span>
            </button>
            <a class="btn btn-label-secondary d-grid w-100 mb-2" target="_blank" href="{{ route('clinet.downlaod.invoice', $project->uuid) }}">Download</a>
            <button class="print-window btn btn-label-secondary d-grid w-100">
                Print
            </button>
            {{-- <button
                class="btn btn-primary d-grid w-100"
                data-bs-toggle="offcanvas"
                data-bs-target="#addPaymentOffcanvas">
                <span class="d-flex align-items-center justify-content-center text-nowrap">
                <i class="ti ti-currency-dollar ti-xs me-1"></i>Add Payment</span>
            </button> --}}
        </div>
      </div>
    </div>
    <!-- /Invoice Actions -->
  </div>

  <!-- Offcanvas -->
  <!-- Send Invoice Sidebar -->
  <div class="offcanvas offcanvas-end" id="sendInvoiceOffcanvas" aria-hidden="true">
    <div class="offcanvas-header my-1">
      <h5 class="offcanvas-title">Send Invoice</h5>
      <button
        type="button"
        class="btn-close text-reset"
        data-bs-dismiss="offcanvas"
        aria-label="Close"></button>
    </div>
    <div class="offcanvas-body pt-0 flex-grow-1">
      <form action="{{ route('client.send.invoice', $project->uuid) }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="invoice-from" class="form-label">From</label>
          <input
            type="text"
            class="form-control"
            id="invoice-from"
            value="{{ auth()->user()->email }}"
            disabled
            placeholder="company@email.com" />
        </div>
        <div class="mb-3">
          <label for="invoice-to" class="form-label">To</label>
          <input type="text" class="form-control" id="invoice-to" name="sendTo" placeholder="company@email.com" />
        </div>
        <div class="mb-3">
          <label for="invoice-subject" class="form-label">Subject</label>
          <input type="text" class="form-control" id="invoice-subject" name="subject" value="" placeholder="Invoice regarding goods" />
        </div>
        <div class="mb-3">
            <label for="invoice-message" class="form-label">Message</label>
            <textarea class="form-control" name="message" id="invoice-message" cols="3" rows="8"></textarea>
        </div>
        <div class="mb-4">
          <span class="badge bg-label-primary">
            <i class="ti ti-link ti-xs"></i>
            <span class="align-middle">Invoice Attached</span>
          </span>
        </div>
        <div class="mb-3 d-flex flex-wrap">
          <button type="submit" class="btn btn-primary w-100" data-bs-dismiss="offcanvas">Send</button>
        </div>
      </form>
    </div>
  </div>
  <!-- /Send Invoice Sidebar -->
  
@endsection

@section('script')
<script>
$('.print-window').click(function() {
    window.print();
});
</script>
@endsection