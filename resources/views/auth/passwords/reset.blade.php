@extends('layouts.auth')

@section('content')

<div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
    <div class="w-px-400 mx-auto">
        <!-- Logo -->
        <div class="app-brand mb-4">
            <a href="{{ url('/') }}" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                    <img src="{{ asset('backend/assets/img/clear forces-10.png') }}" width="100%" alt="">
                </span>
            </a>
        </div>
        <!-- /Logo -->
        <h3 class="mb-1 fw-bold">{{ __('Reset Password') }}</h3>

        <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">


            <div class="col-md-12">
                <label for="email" class="col-form-label">{{ __('Email Address') }}</label>

                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" placeholder="{{ __('general.E_mail') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div class="col-md-12">
                <label for="password" class="col-form-label">{{ __('Password') }}</label>

                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div class="col-md-12">
                <label for="password-confirm" class="col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>

            <button class="btn btn-primary d-grid w-100 mt-3" type="submit">{{ __('Reset Password') }}</button>
        </form>
    
    </div>
</div>


@endsection
