<header class="nk-header has-mask">

    @if(Route::is('home'))
    <div class="nk-mask bg-gradient-a"></div>
    <div class="nk-mask bg-pattern-dot bg-blend-top"></div>
    @endif

    <div class="nk-header-main nk-menu-main will-shrink is-transparent ignore-mask">
        <div class="container">
            <div class="nk-header-wrap ">
                <div class="nk-header-logo">
                    <a href="{{ route('home') }}" class="logo-link">
                        <div class="logo-wrap">
                            <img class="logo-img logo-light" src="{{ asset('frontend/assets/images/logo.png') }}" width="150" srcset="{{ asset('frontend/assets/images/logo.png') }}" alt="clearforce">
                            <img class="logo-img logo-dark" src="{{ asset('frontend/assets/images/logo-dark.png') }}" width="150" srcset="{{ asset('frontend/assets/images/logo-dark.png') }}" alt="clearforce">
                        </div>
                    </a>
                </div><!-- .nk-header-logo -->
                <div class="nk-header-toggle">
                    {{-- <button class="dark-mode-toggle">
                        <em class="off icon ni ni-sun-fill"></em>
                        <em class="on icon ni ni-moon-fill"></em>
                    </button> --}}
                    <div class="dropdown">
                        <a class="link link-base fw-medium dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-offset="0, 12"> <i class="ti ti-language fs-3"></i> </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">

                            <li><a class="dropdown-item link-base py-2 px-4" href="{{ url('locale/en') }}">en</a></li>
                            <li><a class="dropdown-item link-base py-2 px-4" href="{{ url('locale/ar') }}">ar</a></li>

                        </ul>
                    </div>
                    <button class="btn btn-light btn-icon header-menu-toggle">
                        <em class="icon ni ni-menu"></em>
                    </button>
                </div>
                <nav class="nk-header-menu nk-menu">
                    <ul class="nk-menu-list mx-auto">
                        
                        <li class="nk-menu-item {{ (request()->is('/home')) ? ' active ' : '' }} ">
                            <a href="{{ route('home') }}" class="nk-menu-link">
                                <span class="nk-menu-text">{{ __('general.home') }}</span>
                            </a>
                        </li>
                        <li class="nk-menu-item {{ (request()->is('/about')) ? ' active ' : '' }}">
                            <a href="{{ route('about') }}" class="nk-menu-link">
                                <span class="nk-menu-text">{{ __('general.about') }}</span>
                            </a>
                        </li>
                        <li class="nk-menu-item {{ (request()->is('/how_it_work')) ? ' active ' : '' }}">
                            <a href="{{ route('how.it.work') }}" class="nk-menu-link">
                                <span class="nk-menu-text">{{ __('general.Features') }}</span>
                            </a>
                        </li>
                        <li class="nk-menu-item {{ (request()->is('/blog')) ? ' active ' : '' }}">
                            <a href="{{ route('blog') }}" class="nk-menu-link">
                                <span class="nk-menu-text">{{ __('general.Blog') }}</span>
                            </a>
                        </li>

                    </ul>
                    
                    <ul class="nk-menu-buttons flex-lg-row-reverse">
                        <li><a href="{{ route('contact.us') }}" class="btn btn-primary">{{ __('general.Contact_Us') }}</a></li>
                        @guest
                            <li><a class="link link-dark" href="{{ route('login') }}">{{ __('general.Login') }} <i class="ti ti-login ms-2"></i></a></li>
                            {{-- <li><a class="link link-dark" href="{{ route('register') }}">Create Acount <i class="ti ti-user-plus ms-2"></i></a></li> --}}
                        @elseif (Auth::user()->hasRole('admin'))
                            <li><a class="link link-dark" href="{{ route('admin.index') }}">{{ __('general.Dashboard') }} </a></li>
                        @elseif (Auth::user()->hasRole('supervisor'))
                            <li><a class="link link-dark" href="{{ route('supervisor.index') }}">{{ __('general.Dashboard') }} </a></li>
                        @elseif (Auth::user()->hasRole('client'))
                            <li><a class="link link-dark" href="{{ route('client.index') }}">{{ __('general.Dashboard') }} </a></li>
                        @elseif (Auth::user()->hasRole('agent'))
                            <li><a class="link link-dark" href="{{ route('agent.index') }}">{{ __('general.Dashboard') }} </a></li>
                        @endguest

                        <li class="dropdown d-sm-none d-md-block">
                            <a class="link link-base fw-medium dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-offset="0, 12"> <i class="ti ti-language fs-3"></i> </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">

                                <li><a class="dropdown-item link-base py-2 px-4" href="{{ url('locale/en') }}">en</a></li>
                                <li><a class="dropdown-item link-base py-2 px-4" href="{{ url('locale/ar') }}">ar</a></li>

                            </ul>
                        </li>
                    </ul><!-- .nk-menu-buttons -->
                </nav><!-- .nk-header-menu -->
            </div><!-- .nk-header-wrap -->
        </div><!-- .container -->
    </div><!-- .nk-header-main -->

    @if(Route::is('home') )
    <div class="nk-hero pt-xl-5">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-11 col-xl-9 col-xxl-8">
                    <div class="nk-hero-content py-5 py-lg-6">
                        <h1 class="title mb-3 mb-lg-4">{{ __('general.site_description') }}</h1>
                        <p class="lead px-md-8 px-lg-6 mb-4 mb-lg-5">{{ __('general.site_sub_description') }}</p>
                        <ul class="btn-list btn-list-inline">
                            <li><a href="{{ route('register') }}" class="btn btn-secondary btn-lg"><span>{{ __('general.Start_Now') }}</span></a></li>
                        </ul>
                        <!-- <p class="sub-text mt-2">No credit card required</p> -->
                    </div>
                    <div class="nk-hero-gfx">
                        <img class="w-100 rounded-top-4" src="{{ asset('frontend/assets/images/mainimg.png') }}" alt="clearforce">
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .nk-hero -->    
    @endif 
</header><!-- .nk-header -->