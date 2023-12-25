@extends('layouts.auth')

@section('content')

<div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
    <div class="w-px-400 mx-auto">

        <div class="app-brand mb-4">
            <a href="{{ url('/') }}" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                    <img src="{{ asset('backend/assets/img/clear forces-10.png') }}" width="100%" alt="">
                </span>
            </a>
        </div>

        <h3 class="mb-1 fw-bold">{{ __('Reset Password') }}</h3>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        
        <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('password.email') }}">
            @csrf

            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{{ __('general.E_mail') }}" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <button class="btn btn-primary d-grid w-100 mt-3" type="submit">{{ __('Send Password Reset Link') }}</button>

        </form>
        
    </div>
</div>
@endsection
