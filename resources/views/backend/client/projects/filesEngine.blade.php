@extends('layouts.client')
@section('title')
{{ __('general.Create_Project') }}
@endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
            
            
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">project / </span> Request for clearance with files only
    </h4>
    
    <div class="row">
    
        <div class="col-xl-6 m-auto">
            
            @if ($data != null)
            <ul class="p-0 m-0">

                @foreach ($data['keys_values'] as $list)
                    <li class="d-flex align-items-center mb-4">
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <div class="d-flex align-items-center">
                                <h6 class="mb-0 me-1">{{ $list['standard_key']}}</h6>
                                </div>
                            </div>
                            <div class="user-progress">
                                <p class="text-success fw-medium mb-0 d-flex justify-content-center gap-1">
                                {{ $list['value']}}
                                </p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>

            @endif
            <!-- Commercial Files -->
            <div class="card">
                <h5 class="card-header">{{ __('general.Commercial_Files') }}</h5>
                <div class="card-body">
                    <form action="{{ route('client.filesEngine.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="formFile" class="form-label">{{ __('general.PACKING_SLIP') }}</label>
                                <input class="form-control" name="PACKING_SLIP" type="file" id="formFile">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="formFileDisabled" class="form-label">{{ __('general.BILL_OF_LADING') }}</label>
                                <input class="form-control @error('BILL_OF_LADING') is-invalid @enderror" name="BILL_OF_LADING" type="file" id="formFileDisabled" >
                                @error('BILL_OF_LADING')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="formFile" class="form-label">{{ __('general.COMMERCIAL_INVOICE') }}</label>
                                <input class="form-control" name="COMMERCIAL_INVOICE" type="file" id="formFile">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="formFileDisabled" class="form-label">{{ __('general.CERTIFICATE_OF_ORIGIN') }}</label>
                                <input class="form-control" name="CERTIFICATE_OF_ORIGIN" type="file" id="formFileDisabled" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="formFileDisabled" class="form-label">{{ __('general.CUSTOM_DECLARATION') }}</label>
                                <input class="form-control" name="CUSTOM_DECLARATION" type="file" id="formFileDisabled" >
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="formFileMultiple" class="form-label">{{ __('general.other files') }}</label>
                                <input class="form-control" name="otherFiles" type="file" id="formFileMultiple" multiple="">
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-primary w-100" style="submit">{{ __('general.Send') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection


@section('script')

@endsection