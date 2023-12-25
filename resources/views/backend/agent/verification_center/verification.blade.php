@extends('layouts.agent')
@section('title')
    {{ __('general.Verification_Center') }}
@endsection
@section('content')

<h4 class="fw-bold py-3"><span class="text-muted fw-light">{{ __('general.Agent') }} /</span>  {{ __('general.Settings') }} </h4>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title mb-0">{{ __('general.Account Settings') }}</h5>
    </div>
    <div class="card-body">
        <div class="row">
            
            <!-- Navigation -->
            <div class="col-12 col-md-4 mx-auto card-separator">
                
                @include('backend.inclouds.agent.settingNav')
                
            </div>
            <!-- /Navigation -->
            <!-- Options -->
            <div class="col-12 col-md-8 pt-4 pt-md-0">
                <div class="tab-content p-0 ps-md-3">
                    <!-- Restock Tab -->
                    <div class="tab-pane fade show active" id="restock" role="tabpanel">
                        <div class="mb-4">
                            
                            @if (Auth::user()->verification()->where('status', 1)->count() == 0)
                            <div class="col-md-12">
                                <div class="border card rounded">
                                    <div class="card-header">
                                        <h4 class="text-base leading-6 font-bold text-gray-900 dark:text-gray-100">{{ __('general.Verification_Center') }}</h2>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">{{ __('general.Help us make marketplace safe') }}</p>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('agent.verification.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="mb-3 col-6">
                                                    <label for="media"> {{ __('general.files') }} </label>
                                                    <input name="media" type="file" id="media" class="form-control" required/>
                                                    @error('media')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3 col-6">
                                                    <label for="licensenumber"> {{ __('general.license number') }} </label>
                                                    <input name="number" type="text" id="licensenumber" class="form-control" required/>
                                                    @error('number')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary me-2 waves-effect waves-light">{{ __('general.Save_Changes') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="card-body">
                                <div class="py-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <dt class="text-sm font-medium text-gray-500">{{ __('general.Verification status') }}</dt>
                                            @if (Auth::user()->IfVerified())
                                            <dd class="mt-1 text-xs font-semibold text-success">{{ __('general.Account verified') }}</dd>
                                            @else
                                            <dd class="mt-1 text-xs font-semibold text-danger">{{ __('general.The account has not been verified') }} </dd>
                                                
                                            @endif
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <dt class="text-sm font-medium text-gray-500">{{ __('general.Verified at') }}</dt>
                                            <dd class="mt-1 text-xs text-gray-500">
                                                @if (Auth::user()->IfVerified())
                                                {{ Auth::user()->IfVerified()->updated_at }}
                                                @else
                                                {{ __('general.not yet') }}
                                                @endif
                                            </dd>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="card-title mb-3 mb-1">{{ __('general.Verification documents') }}</h5>
                                <div class="table-responsive border rounded">
                                    <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-nowrap">{{ __('general.files') }}</th>
                                            <th class="text-nowrap">{{ __('general.Note') }}</th>
                                            <th class="text-nowrap">{{ __('general.license number') }}</th>
                                            <th class="text-nowrap">{{ __('general.Status') }}</th>
                                            <th class="text-nowrap"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($verifications as $verification)
                                            <tr class="border-transparent">
                                                <td class="text-nowrap">{{ $verification->documents }}</td>
                                                <td class="text-nowrap">{{ $verification->note }}</td>
                                                <td class="text-nowrap">{{ $verification->number }}</td>
                                                <td class="text-nowrap">
                                                    @if ($verification->status == 1)
                                                    <span class="badge bg-label-success">{{ __('general.approved') }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('agent.file.download', $verification->documents ) }}" class="btn btn-outline-dark float-end waves-effect waves-light">
                                                        <i class="ti ti-download"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <!-- /Notifications -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Options-->
        </div>
    </div>
</div>

@endsection
