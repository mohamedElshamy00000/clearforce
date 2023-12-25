<footer class="nk-footer">
    <div class="section pb-4">
        <div class="container">
            <div class="row g-5">
                <div class="col-xl-3 col-sm-4 col-6">
                    <div class="wgs">
                        <h6 class="wgs-title overline-title text-heading mb-3">{{ __('general.UseـCase') }}</h6>
                        <ul class="list gy-2 list-link-base">
                            <li><a class="link-base" href="{{ route('home') }}">{{ __('general.home') }}</a></li>
                            <li><a class="link-base" href="{{ route('about') }}">{{ __('general.about') }}</a></li>
                            <li><a class="link-base" href="{{ route('how.it.work') }}">{{ __('general.Features') }}</a></li>
                            <li><a class="link-base" href="{{ route('blog') }}">{{ __('general.Blog') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-4 col-6">
                    <div class="wgs">
                        <h6 class="wgs-title overline-title text-heading mb-3">{{ __('general.about') }}</h6>
                        <ul class="list gy-2 list-link-base">
                            <li><a class="link-base" href="{{ route('login') }}">{{ __('general.Login') }}</a></li>
                            <li><a class="link-base" href="{{ route('register') }}">{{ __('general.createـaccount') }}</a></li>
                            <li><a class="link-base" href="{{ route('privacy') }}">{{ __('general.Privacy_Policy') }}</a></li>
                            <li><a class="link-base" href="{{ route('terms') }}">{{ __('general.Terms_of_Service') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-7 col-md-9 me-auto order-xl-first">
                    <div class="block-text">
                        <a href="{{ route('home') }}" class="logo-link mb-4">
                            <div class="logo-wrap">
                                <img class="logo-img logo-light" src="{{ asset('frontend/assets/images/logo.png') }}" width="120" srcset="{{ asset('frontend/assets/images/logo.png') }}" alt="clearforce">
                                <img class="logo-img logo-dark" src="{{ asset('frontend/assets/images/logo-dark2x.png') }}" width="120" srcset="{{ asset('frontend/assets/images/logo-dark2x.png') }}" alt="clearforce">
                            </div>
                        </a>
                        <p>
                            {{ __('general.footerQuote') }}
                        </p>
                        <p class="text-heading mt-4">&copy; 2023 {{ App\Models\Setting::where('id', 1)->first()->productName }}.</p>
                    </div>
                </div>
            </div>
        </div><!-- .container -->
    </div><!-- .section -->
    <div class="section section-0 bg-transparent p-0">
        <hr class="border-opacity-25 border-primary m-0">
        <div class="container">
            <div class="py-4">
                <div class="row">
                    <div class="col-12">
                        <ul class="list gy-2 list-link-base" style="flex-direction: row;">
                            @if (App\Models\Setting::where('id', 1)->first()->twitter != null)
                                <li><a href="{{ App\Models\Setting::where('id', 1)->first()->twitter }}" class="link-base"><i class="ti ti-brand-twitter"></i></a></li>
                            @endif
                            @if (App\Models\Setting::where('id', 1)->first()->facebook != null)
                                <li><a href="{{ App\Models\Setting::where('id', 1)->first()->facebook }}" class="link-base"><i class="ti ti-brand-facebook"></i></a></li>
                            @endif
                            @if (App\Models\Setting::where('id', 1)->first()->linkedin != null)
                                <li><a href="{{ App\Models\Setting::where('id', 1)->first()->linkedin }}" class="link-base"><i class="ti ti-brand-linkedin"></i></a></li>
                            @endif
                            @if (App\Models\Setting::where('id', 1)->first()->youtube != null)
                                <li><a href="{{ App\Models\Setting::where('id', 1)->first()->youtube }}" class="link-base"><i class="ti ti-brand-youtube"></i></a></li>
                            @endif
                        </ul>
                    </div><!-- .col -->
                </div><!-- .row -->
            </div>
        </div><!-- .container -->
    </div>
</footer>