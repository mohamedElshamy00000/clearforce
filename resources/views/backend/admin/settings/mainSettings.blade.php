@extends('layouts.backend')
@section('title')
    main settings
@endsection

@section('content')

    <h4 class="py-3 mb-0">
      <span class="text-muted fw-light">setting /</span><span class="fw-medium"> Application Settings</span>
    </h4>
    
    <div class="app-ecommerce">
    
        <form class="form-repeater" action="{{ route('admin.main.setting.update') }}" method="POST">
            <!-- Add Product -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
            
                <div class="d-flex flex-column justify-content-center">
                    <h4 class="mb-1 mt-3">Edit website settings</h4>
                </div>
                <div class="d-flex align-content-center flex-wrap gap-3">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">save changes</button>
                </div>
            
            </div>
        
            <div class="row">
                
                @csrf
                <!-- First column-->
                <div class="col-12 col-lg-8">
                    <!-- Product Information -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-tile mb-0">website information</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="">Name</label>
                                <input type="text" class="form-control" id="" value="{{ $settings->productName }}" name="productName" >
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description ar</label>
                                <textarea class="form-control" name="productDescription_ar">{{ $settings->productDescription_ar }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description en</label>
                                <textarea class="form-control" name="productDescription_en">{{ $settings->productDescription_en }}</textarea>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label" for="">phone</label>
                                    <input type="text" class="form-control" value="{{ $settings->phone }}" name="phone" >
                                </div>
                                <div class="col">
                                    <label class="form-label" for="">email</label>
                                    <input type="text" class="form-control" value="{{ $settings->email }}" name="email" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label" for="">address ar</label>
                                    <input type="text" class="form-control" value="{{ $settings->address_ar }}" name="address_ar" >
                                </div>
                                <div class="col">
                                    <label class="form-label" for="">address en</label>
                                    <input type="text" class="form-control" value="{{ $settings->address_en }}" name="address_en" >
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <label class="form-label" for="">footer Quote ar</label>
                                    <input type="text" class="form-control" value="{{ $settings->footerQuote_ar }}" name="footerQuote_ar" >
                                </div>
                                <div class="col">
                                    <label class="form-label" for="">footer Quote en</label>
                                    <input type="text" class="form-control" value="{{ $settings->footerQuote_en }}" name="footerQuote_en" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-tile mb-0">Social media links</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="">twitter</label>
                                <input type="text" class="form-control" value="{{ $settings->twitter }}" name="twitter" >
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="">facebook</label>
                                <input type="text" class="form-control" value="{{ $settings->facebook }}" name="facebook" >
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label" for="">linked in</label>
                                    <input type="text" class="form-control" value="{{ $settings->linkedin }}" name="linkedin" >
                                </div>
                                <div class="col">
                                    <label class="form-label" for="">youtube</label>
                                    <input type="text" class="form-control" value="{{ $settings->youtube }}" name="youtube" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Product Information -->

                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">MAIL Configration</h5>
                        </div>
                        <div class="card-body">
                            
                            <div data-repeater-list="group-a">
                                <div data-repeater-item="">
                                    <div class="row">
                                        <div class="col-4">
                                            <label class="form-label " for="form-repeater-1-2">mail Driver</label>
                                            <input type="text" id="form-repeater-1-2" name="mail_driver" class="form-control" value="{{ $settings->mail_driver }}">
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label " for="form-repeater-1-2">mail Host</label>
                                            <input type="text" id="form-repeater-1-2" name="mail_host" class="form-control" value="{{ $settings->mail_host }}">
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label " for="form-repeater-1-2">mail Port</label>
                                            <input type="text" id="form-repeater-1-2" name="mail_port" class="form-control" value="{{ $settings->mail_port }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <label class="form-label " for="form-repeater-1-2">mail username</label>
                                            <input type="text" id="form-repeater-1-2" name="mail_username" class="form-control" value="{{ $settings->mail_username }}">
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label " for="form-repeater-1-2">mail password</label>
                                            <input type="text" id="form-repeater-1-2" name="mail_password" class="form-control" value="{{ $settings->mail_password }}">
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label " for="form-repeater-1-2">mail encryption</label>
                                            <input type="text" id="form-repeater-1-2" name="mail_encryption" class="form-control" value="{{ $settings->mail_encryption }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <label class="form-label " for="form-repeater-1-2">From Addesss(Email)</label>
                                            <input type="text" id="form-repeater-1-2" name="mail_from_Addesss" class="form-control" value="{{ $settings->mail_from_Addesss }}">
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label " for="form-repeater-1-2">From name</label>
                                            <input type="text" id="form-repeater-1-2" name="mail_from_name" class="form-control" value="{{ $settings->mail_from_name }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="col-12 col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Moyasar API</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="MOYASAR_API_KEY">API KEY</label>
                                <input type="text" class="form-control" id="MOYASAR_API_KEY" value="{{ $settings->moyasar_api_key }}" name="moyasar_api_key">
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">S3 Storage</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="Access_KEY">Access KEY</label>
                                <input type="text" class="form-control" id="Access_KEY" value="{{ $settings->s3_access_key }}" name="s3_access_key">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="s3_secret_key">Secret KEY</label>
                                <input type="text" class="form-control" id="s3_secret_key" value="{{ $settings->s3_secret_key }}" name="s3_secret_key">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="s3_sefault_key">Default Region</label>
                                <input type="text" class="form-control" id="s3_sefault_key" value="{{ $settings->s3_sefault_key }}" name="s3_sefault_key">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="s3_bucket">Bucket</label>
                                <input type="text" class="form-control" id="s3_bucket" value="{{ $settings->s3_bucket }}" name="s3_bucket">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-content-center flex-wrap gap-3">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">save changes</button>
                </div>
                
            </div>
        </form>
    </div>

@endsection

@push('script')

@endpush