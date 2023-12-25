@extends('layouts.auth')

@section('content')


    <!-- Login -->
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
            <h3 class="mb-1 fw-bold">{{ __('general.Welcome_to_ClearForce') }} 👋</h3>
            <p class="mb-4">{{ __('general.Please_sign-in_account') }}</p>

            <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('general.E_mail') }}</label>
                    <input
                    type="text"
                    class="form-control @error('email') is-invalid @enderror"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                    placeholder="Enter your email"
                    autofocus />
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                
                </div>
                               
                <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">{{ __('general.Password') }}</label>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        <small>{{ __('general.Forgot_Your_Password?') }}</small>
                    </a>
                    @endif

                    
                    </div>
                    <div class="input-group input-group-merge">
                        <input
                            type="password"
                            id="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password"
                            required
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="password" />
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
                    <label class="form-check-label" for="remember"> {{ __('general.Remember_Me') }} </label>
                    </div>
                </div>
                <button class="btn btn-primary d-grid w-100" type="submit">{{ __('general.Sign_in') }}</button>
            </form>

            <p class="text-center">
                <span>{{ __('general.Forgot_Your_Password?') }}</span>
                <a href="{{ route('register') }}">
                    <span>{{ __('general.Create_an_account') }}</span>
                </a>
            </p>
            
            </div>
        </div>
    </div>
    <!-- /Login -->
@endsection
