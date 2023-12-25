@extends('layouts.client')

@section('title')
    user settings
@endsection

@section('content')
            
  <h4 class="py-3 mb-4">
    <span class="text-muted fw-light">{{ __('general.Account Settings') }} /</span> {{ __('general.Account') }}
  </h4>
  
  <div class="row fv-plugins-icon-container">
    <div class="col-md-12">
      <ul class="nav nav-pills flex-column flex-md-row mb-4">
        <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="ti-xs ti ti-users me-1"></i> {{ __('general.Account') }} </a></li>
        {{-- <li class="nav-item"><a class="nav-link" href=""><i class="ti-xs ti ti-lock me-1"></i> Security</a></li>
        <li class="nav-item"><a class="nav-link" href=""><i class="ti-xs ti ti-bell me-1"></i> Notifications</a></li> --}}
      </ul>
      <div class="card mb-4">
        <h5 class="card-header">{{ __('general.project details') }}</h5>
        <form action="{{ route('user.update.info', $user->id) }}" method="POST">
          @csrf
          <!-- Account -->
          {{-- <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-4">
              <img src="{{ asset('backend/assets/img/avatar.svg') }}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar">
              <div class="button-wrapper">
                <label for="upload" class="btn btn-primary me-2 mb-3 waves-effect waves-light" tabindex="0">
                  <span class="d-none d-sm-block">Upload new photo</span>
                  <i class="ti ti-upload d-block d-sm-none"></i>
                  <input type="file" id="upload" class="account-file-input" hidden="" accept="image/png, image/jpeg">
                </label>
                <button type="button" class="btn btn-label-secondary account-image-reset mb-3 waves-effect">
                  <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                  <span class="d-none d-sm-block">Reset</span>
                </button>
    
                <div class="text-muted">Allowed JPG, PNG. Max size of 800K</div>
              </div>
            </div>
          </div> --}}
          <hr class="my-0">
          <div class="card-body">
            <form id="formAccountSettings" method="POST" onsubmit="return false" class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
              <div class="row">
                <div class="mb-3 col-md-6 fv-plugins-icon-container">
                  <label for="name" class="form-label">{{ __('general.Name') }}</label>
                  <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ $user->name }}" autofocus="">
                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                <div class="mb-3 col-md-6">
                  <label for="email" class="form-label">{{ __('general.E_mail') }}</label>
                  <input class="form-control @error('email') is-invalid @enderror" type="text" id="email" name="email" value="{{ $user->email }}" disabled placeholder="">
                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="phone">{{ __('general.Phone_Number') }}</label>
                  <div class="input-group input-group-merge">
                    {{-- <span class="input-group-text">US (+1)</span> --}}
                    <input type="text" id="phone" name="phone" class="@error('phone') is-invalid @enderror form-control" value="{{ $user->phone }}">
                    @error('phone')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                  </div>
                </div>
                <div class="mb-3 col-md-6">
                  <label for="address" class="form-label">{{ __('general.Address') }}</label>
                  <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ $user->address }}">
                  @error('address')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="mb-3 col-md-6">
                  <label for="zipCode" class="form-label">{{ __('general.Zip_Code') }}</label>
                  <input type="text" class="form-control @error('zipCode') is-invalid @enderror" id="zipCode" name="zipCode" value="{{ $user->zipCode }}" maxlength="6">
                  @error('zipCode')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="country">{{ __('general.Country') }}</label>
                  <select id="country" name="country" class="select2 form-select @error('country') is-invalid @enderror">
                    <option value="">Select</option>
                    @foreach ($countries as $country)
                      <option @if ($country->code == $user->country) selected="selected" @endif value="{{ $country->code }}"> {{ $country->name }}</option>
                    @endforeach
                  </select>
                  @error('country')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="password">{{ __('general.Password') }}</label>
                    <div class="input-group input-group-merge">
                        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="" aria-describedby="password" />
    
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
    
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="password">{{ __('general.Confirm Password') }}</label>
                    <div class="input-group input-group-merge">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- <div class="mb-3 col-md-6">
                  <label for="language" class="form-label">Language</label>
                  <select id="language" class="select2 form-select">
                    <option value="">Select Language</option>
                    <option value="en">English</option>
                    <option value="ar">Arabic</option>
                  </select>
                </div> --}}
                
              </div>
              <div class="mt-2">
                <button type="submit" class="btn btn-primary me-2 waves-effect waves-light">{{ __('general.Save_Changes') }}</button>
              </div>
            <input type="hidden"></form>
          </div>
          <!-- /Account -->

        </form>
      </div>
      {{-- <div class="card">
        <h5 class="card-header">Delete Account</h5>
        <div class="card-body">
          <div class="mb-3 col-12 mb-0">
            <div class="alert alert-warning">
              <h5 class="alert-heading mb-1">Are you sure you want to delete your account?</h5>
              <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
            </div>
          </div>
          <form id="formAccountDeactivation" onsubmit="return false" class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
            <div class="form-check mb-4">
              <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation">
              <label class="form-check-label" for="accountActivation">I confirm my account deactivation</label>
            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
            <button type="submit" class="btn btn-danger deactivate-account waves-effect waves-light">Deactivate Account</button>
          <input type="hidden"></form>
        </div>
      </div> --}}
    </div>
  </div>
            
@endsection

@section('script')

@endsection