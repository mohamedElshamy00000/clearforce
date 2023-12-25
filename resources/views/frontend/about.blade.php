@extends('layouts.app')

@section('title', 'ClearForce about')

@section('content')

<section class="section has-shape has-mask">
    <div class="nk-shape bg-shape-blur-m mt-8 start-50 top-0 translate-middle-x"></div>
    <div class="nk-mask bg-pattern-dot bg-blend-around mt-n5 mb-10p mh-50vh"></div>
    <div class="container">
        <div class="section-head">
            <div class="row justify-content-center text-center">
                <div class="col-lg-9 col-xl-8 col-xxl-7">
                    <h6 class="overline-title text-primary">{{ __('general.About_Us') }}</h6>
                    <h2 class="title h1">{{ __('general.future_customs_clearance') }}</h2>
                </div>
            </div>
        </div><!-- .section-head -->
        <div class="section-content">
            <div class="row g-gs justify-content-center align-items-center flex-lg-row-reverse">
                <div class="col-lg-6 col-md-11">
                    <div class="block-gfx ps-xxl-5">
                        <img loading="lazy" class="w-100 rounded-2" src="{{ asset('frontend/assets/images/placeholder-01.png') }}" alt="">
                    </div>
                </div><!-- .col -->
                <div class="col-lg-6">
                    <div class="block-text pe-xxl-7">
                        <h2 class="title">{{ __('general.site_description') }}</h2>
                        <ul class="list gy-3 pe-xxl-7">
                            <li><em class="icon text-success fs-5 ni ni-check-circle-fill"></em><span>{{ __('general.Stay_updated') }}</span></li>
                            
                            <li><em class="icon text-success fs-5 ni ni-check-circle-fill"></em><span>{{ __('general.Features_a') }}</span></li>
                            <li><em class="icon text-success fs-5 ni ni-check-circle-fill"></em><span>{{ __('general.Features_b') }}</span></li>
                            <li><em class="icon text-success fs-5 ni ni-check-circle-fill"></em><span>{{ __('general.Features_c') }}</span></li>
                        </ul>
                        <ul class="btn-list btn-list-inline gy-0">
                            <li><a href="{{ route('register') }}" class="btn btn-lg btn-primary"><span>{{ __('general.Start_Now') }}</span><em class="icon ni ni-arrow-long-right"></em></a></li>
                        </ul>
                    </div>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .section-content -->
    </div><!-- .container -->
</section><!-- .section -->

<section class="section section-lg section-bottom-0 pt-1 d-none">
    <div class="container">
        <div class="section-content">
            <div class="row justify-content-center text-center g-gs">
                <div class="col-xxl-10">
                    <!-- <p class="fs-4 pt-5 mt-xl-3 mb-3">Our Parteners</p> -->
                    <h2 class="title mb-5">{{ __('general.Our_Partners') }}</h2>
                    <ul class="d-flex flex-wrap justify-content-center has-gap gy-3">
                        <li class="px-3 px-xl-5">
                            <img loading="lazy" class="h-2rem visible-on-light-mode" src="{{ asset('frontend/assets/images/logo-dark2x.png') }}" alt="">
                        </li>
                        <li class="px-3 px-xl-5">
                            <img loading="lazy" class="h-2rem visible-on-light-mode" src="{{ asset('frontend/assets/images/logo-dark2x.png') }}" alt="">
                        </li>
                        <li class="px-3 px-xl-5">
                            <img loading="lazy" class="h-2rem visible-on-light-mode" src="{{ asset('frontend/assets/images/logo-dark2x.png') }}" alt="">
                        </li>
                        <li class="px-3 px-xl-5">
                            <img loading="lazy" class="h-2rem visible-on-light-mode" src="{{ asset('frontend/assets/images/logo-dark2x.png') }}" alt="">
                        </li>
                        <li class="px-3 px-xl-5">
                            <img loading="lazy" loading="lazy" class="h-2rem visible-on-light-mode" src="{{ asset('frontend/assets/images/logo-dark2x.png') }}" alt="">
                        </li>
                    </ul>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .section-content -->
    </div><!-- .container -->
</section><!-- .section -->
{{-- 
<section class="section section-bottom-0 has-shape">
    <div class="nk-shape bg-shape-blur-m ms-n8 start-50 top-50 ms-n25 translate-middle-y"></div>
    <div class="container">
        <div class="section-content">
            <div class="row gx-gs gy-6 justify-content-center align-items-center">
                <div class="col-xl-5 col-lg-8">
                    <div class="block-text pe-xxl-7 text-center text-xl-start">
                        <h2 class="title">{{ __('general.Features_Benefits') }}</h2>
                        <p class="lead">{{ __('general.Features_c') }}</p>
                        <ul class="btn-list btn-list-inline gy-0">
                            <li><a href="{{ route('how.it.work') }}" class="btn btn-lg btn-primary"><span>{{ __('general.How_it_works') }}</span><em class="icon ni ni-arrow-long-right"></em></a></li>
                        </ul>
                    </div>
                </div><!-- .col -->
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
                                            <h3 class="title">Freight Forwarding</h3>
                                            <p>We organize and manage international shipping operations for goods, providing transportation, customs clearance </p>
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
                                            <h3 class="title">Traiff Classification</h3>
                                            <p> We classify your goods according to the appropriate customs tariff, ensuring compliance with local and international customs laws and regulations.</p>
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
                                            <h3 class="title">Duty and Tax Calculation</h3>
                                            <p>We calculate customs duties and taxes related to import and export, ensuring accurate calculations and compliance with customs legislation.</p>
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
                                            <h3 class="title">Customs Valuation Assistance</h3>
                                            <p>We assist in determining the customs value of imported goods, ensuring compliance with internationally recognized methods of customs valuation.</p>
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
</section><!-- .section --> --}}

{{-- <section class="section section-lg section-bottom-0">
    <div class="container">
        <div class="section-head">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-xl-7 col-xxl-6">
                    <h6 class="overline-title text-primary">Testimonials</h6>
                    <h2 class="title">ClearForce is rated 4.9/5 stars in over 2,000 reviews</h2>
                </div>
            </div>
        </div><!-- .section-head -->
        <div class="section-content">
            <div class="row g-gs justify-content-center align-items-center">
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <p>In Saudi Arabia, customs clearance is done by going through several steps and procedures, according to multiple sources.</p>
                            <div class="d-flex pt-3">
                                <div class="media-info me-3">
                                    <h5 class="mb-1">mohamed hamed</h5>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card -->
                </div><!-- .col -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <p>In Saudi Arabia, customs clearance is done by going through several steps and procedures, according to multiple sources.</p>
                            <div class="d-flex pt-3">
                                <div class="media-info me-3">
                                    <h5 class="mb-1">mohamed hamed</h5>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card -->
                </div><!-- .col -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <p>In Saudi Arabia, customs clearance is done by going through several steps and procedures, according to multiple sources.</p>
                            <div class="d-flex pt-3">
                                <div class="media-info me-3">
                                    <h5 class="mb-1">mohamed hamed</h5>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .section-content -->
    </div><!-- .container -->
</section><!-- .section --> --}}

@include('frontend.inclouds.cta')

@endsection