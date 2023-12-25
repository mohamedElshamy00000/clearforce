@extends('layouts.client')
@section('title')
    checkout
@endsection
@section('content')

<h4 class="fw-bold py-3"><span class="text-muted fw-light">{{ __('general.payment') }} </h4>

<!-- Project Cards -->
<div class="row g-4">
    <div class="col-md-6 m-auto">

        <div class="card mt-4 border-success">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="me-2 badge bg-label-success rounded p-2">
                        <i class="ti ti-credit-card fs-2 "></i>
                    </div>
                    <div class="me-2 text-body h5 mb-0">
                        {{ __('general.payment') }}
                        <p class="text-muted fs-6 mb-0">
                            {{ __('general.The summary was evaluated at') }} <span class="text-dark">{{ $invoice->amount }} SAR</span>
                            @if ($invoice->tax_type_id != null)
                               + {{ $invoice->tax->percentage }}% (TAX)
                            @endif
                        </p>
                    </div>
                </div>

                <form action="{{ route('credit.payapi', $invoice->id) }}" class="row g-3" method="POST" accept-charset="UTF-8" id="creditCardForm" >
                    @csrf
                        
                    <div class="mb-3">
                        <label class="form-label w-100" for="creditCardMask">{{ __('general.Card Number') }}</label>
                        <div class="input-group input-group-merge">
                            <input
                                type="text"
                                name="number"
                                id="creditCardMask"
                                class="form-control credit-card-mask @error('number') is-invalid @enderror"
                                value="{{ old('number') }}"
                                required
                                placeholder="0000 0000 0000 0000"
                                aria-describedby="creditCardMask2" />
                            <span class="input-group-text cursor-pointer p-1" id="creditCardMask2"><span class="card-type"></span></span>
                        </div>
                        @error('number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                        <label class="form-label" for="collapsible-payment-name">{{ __('general.Name') }}</label>
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            id="collapsible-payment-name"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="John Doe" />
                        </div>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-6 col-md-2">
                        <div class="mb-3">
                            <label class="form-label" for="collapsible-payment-expiry-month">{{ __('general.month') }}</label>
                            <input
                            type="text"
                            name="month"
                            value="{{ old('month') }}"
                            required
                            id="collapsible-payment-expiry-month"
                            class="form-control expiry-month-mask  @error('month') is-invalid @enderror"
                            placeholder="MM" />
                        </div>
                        @error('month')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-6 col-md-2">
                        <div class="mb-3">
                        <label class="form-label" for="collapsible-payment-expiry-year">{{ __('general.year') }}</label>
                        <input
                            type="text"
                            name="year"
                            required
                            value="{{ old('year') }}"
                            id="collapsible-payment-expiry-year"
                            class="form-control expiry-year-mask  @error('year') is-invalid @enderror"
                            placeholder="YY" />
                        </div>
                        @error('year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    

                    <div class="col-6 col-md-2">
                        <div class="mb-3">
                            <label class="form-label" for="collapsible-payment-cvv">{{ __('general.CVC Code') }}</label>
                            <div class="input-group input-group-merge">
                                <input
                                type="text"
                                name="cvc"
                                required
                                value="{{ old('cvc') }}"
                                id="collapsible-payment-cvv"
                                class="form-control cvv-code-mask  @error('cvc') is-invalid @enderror"
                                maxlength="3"
                                placeholder="654" />
                                <span class="input-group-text cursor-pointer" id="collapsible-payment-cvv2">
                                <i
                                    class="ti ti-help text-muted"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Card Verification Value"></i></span>
                            </div>
                            @error('cvc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <button type="submit" id="paysubmit" class="btn btn-success w-100 me-sm-3 me-1">
                            @if ($invoice->tax_type_id != null)
                            {{ __('general.PAY') }} {{ $invoice->amount + ($invoice->amount * ($invoice->tax->percentage / 100)) }} SAR
                            @else
                            {{ __('general.PAY') }} {{ $invoice->amount }} SAR
                            @endif
                            
                        </button>
                    </div>
                </form>
            
            </div>
        </div>
    </div>

</div>
<!--/ Project Cards -->

@endsection

@section('script')
<script>
    const button = document.querySelector("form");

    document.getElementById("paysubmit").addEventListener("click", (event) => {

        var exMonth=document.getElementById("collapsible-payment-expiry-month").value;
        var exYear=document.getElementById("collapsible-payment-expiry-year").value;

        if (validateExpirationDate(exMonth,exYear) == false) {
            event.preventDefault();
            alert("The expiry year is before today's date. Please select a valid expiry date");
        }
    });

    function validateExpirationDate(expirationMonth, expirationYear) {
        var currentDate = new Date();
        var currentYear = currentDate.getFullYear();
        var currentMonth = currentDate.getMonth() + 1; // January is 0
        
        console.log(expirationYear)
        expirationYear = "20"+ expirationYear;

        if (expirationYear > currentYear) {
            return true;
        } else if (expirationYear === currentYear && expirationMonth >= currentMonth) {
            return true;
        }

        return false;
    }

</script>
@endsection