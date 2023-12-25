@extends('layouts.app')

@section('title', 'Terms of Service')

@section('content')

<section class="section section-bottom-0 has-mask">
    <div class="nk-mask bg-pattern-dot bg-blend-around mt-n5 mb-10p mh-50vh"></div>
    <div class="container">
        <div class="section-content">
            <div class="row g-gs justify-content-center">
                <div class="col-xxl-8 col-xl-9 col-lg-10">
                    <div class="text-center mb-6">
                        <h6 class="overline-title text-primary">{{ __('general.SiteName') }}</h6>
                        <h1 class="title">{{ __('general.Terms of Service') }}</h1>
                        <ul class="list list-row gx-2">
                            <li>
                                <div class="sub-text fs-5">{{ __('general.Last Updated') }}  {!! App\Models\PrivacyTerms::first()->updated_at !!}</div>
                            </li>
                        </ul>
                    </div>
                    <div class="block-typo">
                        @if (App::isLocale('ar'))
                        {!! App\Models\PrivacyTerms::first()->terms_ar !!}    

                        @else
                        {!! App\Models\PrivacyTerms::first()->terms_en !!}    

                        @endif
                    </div>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .section-content -->
    </div><!-- .container -->
</section><!-- .section -->

@include('frontend.inclouds.cta')

@endsection