@extends('layouts.app')

@section('title', 'ClearForce Home')

@section('content')

<section class="section has-mask">
    <div class="nk-mask bg-pattern-dot bg-blend-around mt-10p mb-3"></div>
    <div class="container">
        <!-- <div class="section-actions text-center">
            <ul class="btn-list btn-list-inline gx-gs gy-3">
                <li><a href="#" class="btn btn-primary btn-lg"><span>Start today</span></a></li>
                <li><a href="#" class="btn btn-primary btn-soft btn-lg"><em class="icon ni ni-play"></em><span>See How it Work</span></a></li>
            </ul>
        </div> -->

        <div class="section-content">
            <div class="row gx-5 gy-6 align-items-center">
                <div class="col-lg-6 col-xl-6">
                    <div class="block-gfx pe-xl-5 pe-lg-3">
                        <img loading="lazy" class="w-100 rounded-4" src="{{ asset('frontend/assets/images/placeholder-01.png') }}" alt="clearforces">
                    </div>
                </div><!-- .col -->
                <div class="col-lg-6 col-xl-6">
                    <div class="block-text">
                        <p>{{ __('general.contact_title') }}</p>
                        <h2 class="title">{{ __('general.Features_Benefits') }}</h2>
                        <ul class="list gy-3 mt-4 mb-4">
                            <li><em class="icon ni ni-minus text-primary"></em><span>{{ __('general.Stay_updated') }}</span></li>
                            <li><em class="icon ni ni-minus text-primary"></em><span> {{ __('general.Features_a') }}</span></li>
                            <li><em class="icon ni ni-minus text-primary"></em><span>{{ __('general.Features_b') }}</span></li>
                            <li><em class="icon ni ni-minus text-primary"></em><span>{{ __('general.Features_c') }}</span></li>
                            <li><em class="icon ni ni-minus text-primary"></em><span>{{ __('general.streamlining') }}</span></li>
                        </ul>
                        <a href="{{ route('contact.us') }}" class="btn btn-secondary btn-lg"><span>{{ __('general.Contact_Us') }}</span></a>
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
                            <img loading="lazy" class="h-2rem visible-on-light-mode" src="{{ asset('frontend/assets/images/logo-dark2x.png') }}" alt="logo">
                        </li>
                        <li class="px-3 px-xl-5">
                            <img loading="lazy" class="h-2rem visible-on-light-mode" src="{{ asset('frontend/assets/images/logo-dark2x.png') }}" alt="logo">
                        </li>
                        <li class="px-3 px-xl-5">
                            <img loading="lazy" class="h-2rem visible-on-light-mode" src="{{ asset('frontend/assets/images/logo-dark2x.png') }}" alt="logo">
                        </li>
                        <li class="px-3 px-xl-5">
                            <img loading="lazy" class="h-2rem visible-on-light-mode" src="{{ asset('frontend/assets/images/logo-dark2x.png') }}" alt="logo">
                        </li>
                        <li class="px-3 px-xl-5">
                            <img loading="lazy" class="h-2rem visible-on-light-mode" src="{{ asset('frontend/assets/images/logo-dark2x.png') }}" alt="logo">
                        </li>
                    </ul>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .section-content -->
    </div><!-- .container -->
</section><!-- .section -->

{{-- <section class="section section-lg">
    <div class="container">
        <div class="section-head">
            <div class="row justify-content-center text-center">
                <div class="col-lg-9 col-xl-8 col-xxl-6">
                    <h6 class="overline-title text-primary">{{ __('general.ClearForce_Overview') }}</h6>
                    <h2 class="title">{{ __('general.We_provide') }}</h2>
                </div>
            </div>
        </div><!-- .section-head -->
        <div class="section-content">
            <div class="overflow-hidden">
                <ul class="nav nav-tabs nav-tabs-stretch mb-5" role="tablist">
                    <li class="w-100 w-sm-50 w-lg-auto">
                        <button role="tab" class="nav-link w-100 w-lg-auto active" data-bs-toggle="tab" data-bs-target="#social-media-adds"><em class="icon fa-solid fa-warehouse"></em><span>Bonded Warehousing <div class="badge text-bg-primary-soft-outline text-uppercase rounded-pill px-3 py-2 ">soon</div></span></button>
                    </li>
                    <li class="w-100 w-sm-50 w-lg-auto">
                        <button role="tab" class="nav-link w-100 w-lg-auto" data-bs-toggle="tab" data-bs-target="#website-copy-seo"><em class="icon fa-solid fa-earth-africa"></em><span>Traiff Classification</span></button>
                    </li>
                    <li class="w-100 w-sm-50 w-lg-auto">
                        <button role="tab" class="nav-link w-100 w-lg-auto" data-bs-toggle="tab" data-bs-target="#blog-section-writing"><em class="icon fa-solid fa-calculator"></em><span>Tax Calculation</span></button>
                    </li>
                    <li class="w-100 w-sm-50 w-lg-auto">
                        <button role="tab" class="nav-link w-100 w-lg-auto" data-bs-toggle="tab" data-bs-target="#ecommerce-copy"><em class="icon fa-solid fa-file"></em><span>Customs Valuation</span></button>
                    </li>
                    <li class="w-100 w-sm-50 w-lg-auto">
                        <button role="tab" class="nav-link w-100 w-lg-auto" data-bs-toggle="tab" data-bs-target="#magic-command"><em class="icon fa-solid fa-ship"></em><span>Freight Fawarding</span></button>
                    </li>
                </ul><!-- .nav -->
            </div>
            <div class="tab-content p-5 card border-0 rounded-4 shadow-sm">
                <div class="tab-pane p-lg-3 fade show active" id="social-media-adds" tabindex="0">
                    <div class="row g-gs flex-xl-row-reverse">
                        <div class="col-xl-6 col-lg-10">
                            <div class="block-gfx">
                                <img loading="lazy" class="w-100 rounded-3" src="{{ asset('frontend/assets/images/placeholder-02.png') }}" alt="">
                            </div>
                        </div><!-- .col -->
                        <div class="col-xl-6">
                            <div class="block-text pe-xl-7">
                                <h3 class="mb-4">Bonded Warehousing</h3>
                                <p class="lead">We provide secure storage of imported cargo pending importation into and/or exportation out of the country. Our  personnel are sufficient to control access to the bonded warehouse premises and provide secure storage of goods.</p>
                                <!-- <ul class="list gy-3">
                                    <li>
                                        <em class="icon text-primary ni ni-check-circle-fill"></em>
                                        <span>Analyze your business cost easily with group transaction thorugh tagging feature.</span>
                                    </li>
                                    <li>
                                        <em class="icon text-primary ni ni-check-circle-fill"></em>
                                        <span>Arrange your business expenses by date, name, etc.</span>
                                    </li>
                                    <li>
                                        <em class="icon text-primary ni ni-check-circle-fill"></em>
                                        <span>Add more than one card for payment. Integrated with more than 50+ payment method and support bulk payment.</span>
                                    </li>
                                </ul> -->
                            </div>
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .tab-pane -->
                <div class="tab-pane p-lg-3 fade" id="website-copy-seo" tabindex="0">
                    <div class="row g-gs flex-xl-row-reverse">
                        <div class="col-xl-6 col-lg-10">
                            <div class="block-gfx">
                                <img loading="lazy" class="w-100 rounded-3" src="{{ asset('frontend/assets/images/placeholder-02.png') }}" alt="">
                            </div>
                        </div><!-- .col -->
                        <div class="col-xl-6">
                            <div class="block-text pe-xl-7">
                                <h3 class="mb-4">Traiff Classification</h3>
                                <p> We classify your goods according to the appropriate customs tariff, ensuring compliance with local and international customs laws and regulations.</p>
                                
                            </div>
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .tab-pane -->
                <div class="tab-pane p-lg-3 fade" id="blog-section-writing" tabindex="0">
                    <div class="row g-gs flex-xl-row-reverse">
                        <div class="col-xl-6 col-lg-10">
                            <div class="block-gfx">
                                <img loading="lazy" class="w-100 rounded-3" src="{{ asset('frontend/assets/images/placeholder-02.png') }}" alt="">
                            </div>
                        </div><!-- .col -->
                        <div class="col-xl-6">
                            <div class="block-text pe-xl-7">
                                <h3 class="mb-4">Duty and Tax Calculation</h3>
                                <p class="lead mb-5">We calculate customs duties and taxes related to import and export, ensuring accurate calculations and compliance with customs legislation.</p>
                                <p class="lead mb-5">Our team stays up to date with the latest customs laws and regulations to ensure compliance and reduce costs</p>
                            </div>
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .tab-pane -->
                <div class="tab-pane p-lg-3 fade" id="ecommerce-copy" tabindex="0">
                    <div class="row g-gs flex-xl-row-reverse">
                        <div class="col-xl-6 col-lg-10">
                            <div class="block-gfx">
                                <img loading="lazy" class="w-100 rounded-3" src="{{ asset('frontend/assets/images/placeholder-02.png') }}" alt="">
                            </div>
                        </div><!-- .col -->
                        <div class="col-xl-6">
                            <div class="block-text pe-xl-7">
                                <h3 class="mb-4">Customs Valuation Assistance</h3>
                                <p class="lead">We assist in determining the customs value of imported goods, ensuring compliance with internationally recognized methods of customs valuation.</p>
                                <p class="lead">Our team has extensive experience in customs value estimation and can help you avoid costly mistakes</p>
                            </div>
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .tab-pane -->
                <div class="tab-pane p-lg-3 fade" id="magic-command" tabindex="0">
                    <div class="row g-gs flex-xl-row-reverse">
                        <div class="col-xl-6 col-lg-10">
                            <div class="block-gfx">
                                <img loading="lazy" class="w-100 rounded-3" src="{{ asset('frontend/assets/images/placeholder-02.png') }}" alt="">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="block-text pe-xl-7">
                                <h3 class="mb-4">Freight Forwarding</h3>
                                <p class="lead">We organize and manage international shipping operations for goods, providing transportation, customs clearance, and insurance services.</p>
                                
                                <p>Our team has a deep understanding of the logistics of international shipping and can help you deal with complex regulations and reduce costs1</p>

                            </div>
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .tab-pane -->
            </div><!-- .tab-content -->
        </div><!-- .section-content -->
    </div><!-- .container -->
</section> --}}


<section class="section section-lg section-bottom-0 pt-5">
    <div class="container">
        <div class="section-head">
            <div class="row justify-content-center text-center">
                <div class="col-lg-9 col-xl-8 col-xxl-7">
                    <h6 class="overline-title text-primary">{{ __('general.How_it_works') }}</h6>
                    <h2 class="title">{{ __('general.Instruct_to_our_Work_Flow') }}</h2>
                </div>
            </div>
        </div><!-- .section-head -->
        <div class="section-content">
            <div class="row g-gs">
                <div class="col-md-6 col-xl-4">
                    <div class="feature">
                        <div class="feature-image ms-n3">
                            <img loading="lazy" class="h-xl-16rem" src="{{ asset('frontend/assets/images/clear forces-03_v.png') }}" alt="clearforces">
                        </div>
                        <div class="feature-text">
                            <h4 class="title">{{ __('general.work_a_title') }}</h4>
                            <p class="fs-6">{{ __('general.work_a_desc') }}</p>
                        </div>
                    </div>
                </div><!-- .col -->
                <div class="col-md-6 col-xl-4">
                    <div class="feature">
                        <div class="feature-image ms-n3">
                            <img loading="lazy" class="h-xl-16rem" src="{{ asset('frontend/assets/images/clear forces-03_v copy.png') }}" alt="clearforces">
                        </div>
                        <div class="feature-text">
                            <h4 class="title">{{ __('general.work_b_title') }}</h4>
                            <p class="fs-6">{{ __('general.work_b_desc') }}</p>
                        </div>
                    </div>
                </div><!-- .col -->
                <div class="col-md-6 col-xl-4">
                    <div class="feature">
                        <div class="feature-image ms-n3">
                            <img loading="lazy" class="h-xl-16rem" src="{{ asset('frontend/assets/images/clear forces-03_v copy 2.png') }}" alt="clearforces">
                        </div>
                        <div class="feature-text">
                            <h4 class="title">{{ __('general.work_c_title') }}</h4>
                            <p class="fs-6">{{ __('general.work_c_desc') }}</p>
                        </div>
                    </div>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .section-content -->
    </div><!-- .container -->
</section><!-- .section -->

<section class="section section-lg section-bottom-">
    <div class="container">
        <div class="section-wrap section-wrap-angle section-wrap-angle-top-right bg-darker is-dark rounded-4 has-shape">
            <div class="section-content p-4 pt-3 pt-sm-5 p-sm-6 overflow-hidden">
                <div class="nk-shape bg-shape-blur-n mt-n10p ms-n10p"></div>
                <div class="nk-shape bg-shape-blur-o mt-n10p me-n20p end-0"></div>
                <div class="row justify-content-center text-center">
                    <div class="col-xl-8 col-xxl-9">
                        <div class="block-text">
                            <h2 class="title">{{ __('general.get_in_touch') }}</h2>
                            <p class="lead mt-3">{{ __('general.site_description') }}</p>
                            <form data-action="form/message-form.php" method="post" class="form-submit-init">
                                <div class="row g-4">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="email" name="user-email" class="form-control form-control-lg" placeholder="Your Email Address" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <button class="btn btn-primary w-100" type="submit" id="submit-btn"> {{ __('general.Submit') }}</button>
                                        </div>
                                        <div class="form-result mt-4"></div>
                                    </div>
                                </div>
                                <!-- .row -->
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- .section-content -->
        </div><!-- .section-wrap -->
    </div><!-- .container -->
</section><!-- .section -->

<section class="section section-bottom-0 has-shape has-mask">
    <div class="nk-shape bg-shape-blur-m mt-8 start-50 top-0 translate-middle-x"></div>
    <div class="nk-shape bg-shape-blur-m mt-8 start-50 top-50 translate-middle-x"></div>
    <div class="nk-mask bg-pattern-dot bg-blend-around mt-n5 mb-10p mh-50vh"></div>
    <div class="container">
        <div class="section-head">
            <div class="row justify-content-center text-center">
                <div class="col-lg-9 col-xl-7 col-xxl-6">
                    <h6 class="overline-title text-primary">{{ __('general.Blog') }}</h6>
                    <h2 class="title">{{ __('general.blog_title') }}</h2>
                </div>
            </div>
        </div><!-- .section-head -->
        <div class="section-content">
            <div class="row g-gs">

                @if ( $articles->count() == 0)
                  <div class="w-100 text-center">
                    <i class="ti ti-package fs-1"></i>
                  </div>
                @endif
                @foreach ($articles as $article)
                <div class="col-md-6 col-xl-4">
                    <div class="card border-0 shadow-tiny rounded-4">
                        <div class="card-body p-4">
                            @if ($article->media)
                            <a class="d-block" href="{{ route('blog.single', $article->slug) }}"><img loading="lazy" class="rounded-4 w-100" src="{{ asset('assets/blog/' . $article->media->file_name) }}" alt="clearforces"></a>                                
                            @endif
                            <a href="#" class="badge px-3 py-2 mt-4 mb-3 text-bg-primary-soft fw-normal rounded-pill">{{ $article->user()->name }}</a>
                            <h3><a href="{{ route('blog.single', $article->slug) }}" class="link-dark line-clamp-2">{{ $article->title }}</a></h3>
                            <div class="d-flex pt-4">
                                <div class="media-info me-3">
                                    <ul class="list list-row gx-1">
                                        <li>
                                            <div class="sub-text">{{ $article->created_at->format('D m Y') }}</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card -->
                </div><!-- .col -->
                @endforeach
                
            </div><!-- .row -->
        </div><!-- .section-content -->
    </div><!-- .container -->
</section><!-- .section -->

{{-- <section class="section section-lg section-bottom-0">
    <div class="container">
        <div class="section-head">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-xl-7 col-xxl-6">
                    <h6 class="overline-title text-primary">Testimonials</h6>
                    <h2 class="title">ClearForce is rated 4.9/5 stars in over 2,000 reviews</h2>
                </div>
            </div>
        </div>
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

<section class="section section-lg has-shape">
    <div class="nk-shape bg-shape-border-e ms-n25p mt-2 start-50 translate-middle-x"></div>
    <div class="container">
        <div class="nk-shape bg-shape-wormhole-a mt-n45p mt-xl-n40p mt-xxl-n35p ms-2 start-50 top-100 translate-middle-x"></div>
        <div class="section-head">
            <div class="row justify-content-center text-center">
                <div class="col-lg-9 col-xl-7 col-xxl-8">
                    <h2 class="title h1">{{ __('general.QA_title') }}</h2>
                    <p class="lead px-lg-10 px-xxl-9">{{ __('general.QA_description') }}</p>
                </div>
            </div>
        </div><!-- .section-head -->
        <div class="section-content">
            <div class="row g-gs justify-content-center">
                <div class="col-xl-9 col-xxl-8">
                    <div class="accordion accordion-separated" id="faq-1">
                        @if ( $questions->count() == 0)
                        <div class="w-100 text-center">
                            <i class="ti ti-package fs-1"></i>
                        </div>
                        @endif
                        @foreach ($questions as $question)
                            <div class="accordion-item border-0 bg-gradient-light">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#faq-1-1"> {{ $question->question }} </button>
                                </h2>
                                <div id="faq-1-1" class="accordion-collapse collapse " data-bs-parent="#faq-1">
                                    <div class="accordion-body"> {!! $question->description !!} </div>
                                </div>
                            </div>   
                        @endforeach
                    </div><!-- .accordion -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .section-content -->
    </div><!-- .container -->
</section><!-- .section -->

<section class="section section-bottom-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12 m-auto">
                <div class="section-wrap bg-primary bg-opacity-10 rounded-4">
                    <div class="section-content bg-pattern-dot-sm p-4 p-sm-6">
                        <div class="block-text">
                            <h2 class="title">{{ __('general.CTA_Join_Client') }}</h2>
                            <p class="lead mt-3">{{ __('general.CTA_desc') }}</p>
                            <ul class="btn-list btn-list-inline">
                                <li><a href="{{ route('register') }}" class="btn btn-lg btn-primary"><span>{{ __('general.Start_Now') }}</span><em class="icon ni ni-arrow-long-right"></em></a></li>
                            </ul>
                        </div>
                    </div><!-- .section-content -->
                </div><!-- .section-wrap -->
            </div>
        </div>
    </div><!-- .container -->
</section><!-- .section -->

@endsection