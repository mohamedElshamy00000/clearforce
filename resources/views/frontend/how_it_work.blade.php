@extends('layouts.app')

@section('title', 'ClearForce how it work')

@section('content')

<section class="section has-shape has-mask">
    <div class="nk-shape bg-shape-blur-m mt-8 start-50 top-0 translate-middle-x"></div>
    <div class="nk-mask bg-pattern-dot bg-blend-around mt-n5 mb-5p mh-50vh"></div>
    <div class="container">
        <div class="section-head pb-0">
            <div class="row justify-content-center text-center">
                <div class="col-lg-9 col-xl-8">
                    <h2 class="title h1">{{ __('general.future_customs_clearance') }}</h2>
                </div>
            </div>
        </div><!-- .section-head -->
    </div><!-- .container -->
</section><!-- .section -->

<section class="section section-bottom-0 has-shape">
    <div class="nk-shape bg-shape-blur-m ms-n8 start-50 top-50 ms-n25 translate-middle-y"></div>
    <div class="container">
        
        <div class="section-content">
            <div class="row gx-gs gy-6 justify-content-center align-items-center">
                <div class="col-xl-7">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card rounded-4 border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="feature">
                                        <div class="feature-media">
                                            <div class="media media-middle media-lg text-white bg-primary rounded-3">
                                                <em class="icon fa-solid fa-ship"></em>
                                            </div>
                                        </div>
                                        <div class="feature-text">
                                            <h3 class="title">{{ __('general.Freight Forwarding') }}</h3>
                                            <p>{{ __('general.Freight Forwarding description') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card -->
                            <div class="card rounded-4 border-0 shadow-sm mt-gs">
                                <div class="card-body">
                                    <div class="feature">
                                        <div class="feature-media">
                                            <div class="media media-middle media-lg text-white bg-warning rounded-3">
                                                <em class="icon fa-solid fa-earth-africa"></em>
                                            </div>
                                        </div>
                                        <div class="feature-text">
                                            <h3 class="title">{{ __('general.Traiff Classification') }}</h3>
                                            <p>{{ __('general.Traiff Classification description') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-sm-6 mt-5">
                            <div class="card rounded-4 border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="feature">
                                        <div class="feature-media">
                                            <div class="media media-middle media-lg text-white bg-info rounded-3">
                                                <em class="icon fa-solid fa-calculator"></em>
                                            </div>
                                        </div>
                                        <div class="feature-text">
                                            <h3 class="title">{{ __('general.Duty and Tax Calculation') }}</h3>
                                            <p>{{ __('general.Duty and Tax Calculation description') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card -->
                            <div class="card rounded-4 border-0 shadow-sm mt-gs">
                                <div class="card-body">
                                    <div class="feature">
                                        <div class="feature-media">
                                            <div class="media media-middle media-lg text-white bg-danger rounded-3">
                                                <em class="icon fa-solid fa-file"></em>
                                            </div>
                                        </div>
                                        <div class="feature-text">
                                            <h3 class="title">{{ __('general.Customs Valuation Assistance') }}</h3>
                                            <p>{{ __('general.Customs Valuation Assistance description') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .section-content -->
    </div><!-- .container -->
</section><!-- .section -->

<section class="section section-bottom-0 ">
    <div class="container">
        <div class="section-head">
            <div class="row justify-content-center text-center">
                <div class="col-lg-9 col-xl-8">
                    <h6 class="overline-title text-primary">{{ __('general.How_it_works') }}</h6>
                    <h2 class="title h1">{{ __('general.Instruct_to_our_Work_Flow') }}</h2>
                </div>
            </div>
        </div><!-- .section-head -->
        <div class="section-content">
            <div class="row g-gs justify-content-center flex-md-row-reverse align-items-center">
                <div class="col-xl-4 col-lg-5 col-md-6">
                    <div class="rounded-4 p-5 pe-0">
                        <div class="block-gfx me-n4">
                            <img class="w-100 rounded-3 " src="{{ asset('frontend/assets/images/clear forces-03_v.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 col-md-6">
                    <div class="block-text">
                        <div class="media media-middle text-bg-primary-soft rounded-pill fw-medium fs-5 mb-3">01</div>
                        <h3 class="title">{{ __('general.work_a_title') }}</h3>
                        <p>{{ __('general.work_a_desc') }}</p>
                    </div>
                </div>
            </div><!-- .row -->
        </div><!-- .section-content -->
        <div class="sction-sap text-center py-3 d-none d-md-block">
            <svg class="h-3rem h-sm-5rem h-lg-7rem" viewBox="0 0 444 112" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M442.989 1C443.49 18.4197 426.571 53.2592 354.892 53.2591C265.293 53.2591 126.139 53.2591 80.0875 53.2591C34.0366 53.2591 7.00663 85.784 0.999979 111" stroke="currentColor" stroke-dasharray="7 7" />
            </svg>
        </div><!-- .sction-sap -->
        <div class="h-3rem d-md-none"></div>
        <div class="section-content">
            <div class="row g-gs justify-content-center align-items-center">
                <div class="col-xl-4 col-lg-5 col-md-6">
                    <div class="rounded-4 p-5 ps-0">
                        <div class="block-gfx ms-n4">
                            <img class="w-100 rounded-3 " src="{{ asset('frontend/assets/images/clear forces-03_v copy.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 col-md-6">
                    <div class="block-text px-xxl-5">
                        <div class="media media-middle text-bg-primary-soft rounded-pill fw-medium fs-5 mb-3">02</div>
                        <h3 class="title">{{ __('general.work_b_title') }}</h3>
                        <p>{{ __('general.work_b_desc') }}</p>
                    </div>
                </div>
            </div><!-- .row -->
        </div><!-- .section-content -->
        <div class="sction-sap text-center py-3 d-none d-md-block">
            <svg class="h-3rem h-sm-5rem h-lg-7rem" viewBox="0 0 444 114" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.01068 1C0.510125 18.7364 17.4289 54.2093 89.1082 54.2093C178.707 54.2093 317.861 54.2093 363.912 54.2093C409.963 54.2093 436.993 87.3256 443 113" stroke="currentColor" stroke-dasharray="7 7" />
            </svg>
        </div><!-- .sction-sap -->
        <div class="h-3rem d-md-none"></div>
        <div class="section-content">
            <div class="row g-gs justify-content-center flex-md-row-reverse align-items-center">
                <div class="col-xl-4 col-lg-5 col-md-6">
                    <div class="rounded-4  p-5 pe-0">
                        <div class="block-gfx me-n4">
                            <img class="w-100 rounded-3 " src="{{ asset('frontend/assets/images/clear forces-03_v copy 2.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 col-md-6">
                    <div class="block-text">
                        <div class="media media-middle text-bg-primary-soft rounded-pill fw-medium fs-5 mb-3">03</div>
                        <h3 class="title">{{ __('general.work_c_title') }}</h3>
                        <p>{{ __('general.work_c_desc') }}</p>
                    </div>
                </div>
            </div><!-- .row -->
        </div><!-- .section-content -->
    </div><!-- .container -->
</section><!-- .section -->

@include('frontend.inclouds.cta')

@endsection