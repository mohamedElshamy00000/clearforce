@extends('layouts.app')

@section('content')

<div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
    <div class="w-px-400 mx-auto mt-10">

        <!-- /Logo -->
        <h3 class="mb-1 fw-bold">{{ __('auth.Verify Your Email Address') }}</h3>
        @if (session('resent'))
            <div class="alert alert-success mt-4" role="alert">
                {{ __('auth.A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            {{ __('auth.Before proceeding, please check your email for a verification link') }}
            {{ __('auth.If you did not receive the email') }},
            <button class="btn btn-primary d-grid mt-3 w-100" type="submit">{{ __('auth.click here to request another') }}</button>
        </form>
    </div>
</div>
    
@endsection

