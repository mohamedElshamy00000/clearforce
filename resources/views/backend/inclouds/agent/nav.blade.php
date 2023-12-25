<nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="container-xxl">
        <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
            <a href="{{ url('/') }}" class="app-brand-link">
                <span class="app-brand-logo demo">
                    <img src="{{ asset('backend/assets/img/clear forces-10.png') }}" width="100%" alt="">
                </span>
                <span class="app-brand-text demo menu-text fw-bold">ClearForce</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
            <i class="ti ti-x ti-sm align-middle"></i>
            </a>
        </div>

        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="ti ti-menu-2 ti-sm"></i>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        
            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Language -->
                <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <i class="ti ti-language fis rounded-circle me-1 fs-3"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item"  href="{{ url('locale/en') }}" data-language="en">
                                <span class="align-middle">en</span>
                            </a>
                            <a class="dropdown-item"  href="{{ url('locale/ar') }}" data-language="ar">
                                <span class="align-middle">ar</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--/ Language -->
                <!-- Notification -->
                <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                    <a
                        class="nav-link dropdown-toggle hide-arrow"
                        href="javascript:void(0);"
                        data-bs-toggle="dropdown"
                        data-bs-auto-close="outside"
                        aria-expanded="false">
                        <i class="ti ti-bell ti-md"></i>
                        <span class="badge bg-danger rounded-pill badge-notifications">{{ auth()->user()->notifications()->where('read_at', null)->count() }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end py-0">
                        <li class="dropdown-menu-header border-bottom">
                        <div class="dropdown-header d-flex align-items-center py-3">
                            <h5 class="text-body mb-0 me-auto">{{ __('general.notifications') }}</h5>
                            <a
                            href="javascript:void(0)"
                            class="dropdown-notifications-all text-body"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Mark all as read"
                            ><i class="ti ti-mail-opened fs-4"></i
                            ></a>
                        </div>
                        </li>
                        <li class="dropdown-notifications-list scrollable-container">
                            <ul class="list-group list-group-flush">
                                @foreach (auth()->user()->notifications()->where('read_at' , null)->get() as $notification)
                                <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar">
                                                <div class="avatar text-center">
                                                    @if ( $notification->data['category'] == 'support-message' )
                                                        <i class="fs-3 ti ti-message-dots"></i>
                                                    @elseif ( $notification->data['category'] == 'support')
                                                        <i class="fs-3 ti ti-ticket"></i>
                                                    @else
                                                        <i class="fs-3 ti ti-bell-ringing-2"></i>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">{{ $notification->data['user_name'] }}</h6>
                                            @if ($notification->data['category'] == 'new-project-data' || $notification->data['category'] == 'invoice-accepted')
                                                <a href="{{ route('agent.single.projects', $notification->data['link']) }}" class="mb-0"><strong>{!! $notification->data['title'] !!} </strong> <br> {!! $notification->data['description'] !!}</a>
                                            @else
                                                <p class="mb-0"><strong>{!! $notification->data['title'] !!} </strong> {!! $notification->data['description'] !!}</p>
                                            @endif
                                        <br><small class="text-muted">{{ $notification->created_at->format('d/m/Y h:m A') }}</small>
                                        </div>
                                        <div class="flex-shrink-0 dropdown-notifications-actions">
                                            @if ($notification->read_at == null)
                                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        {{-- <li class="dropdown-menu-footer border-top">
                            <a
                                href="javascript:void(0);"
                                class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center">
                                View all notifications
                            </a>
                        </li> --}}
                    </ul>
                </li>
                <!--/ Notification -->
        
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                        <img src="{{ asset('backend/assets/img/avatar.svg') }}" alt class="h-auto rounded-circle" />
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <img src="{{ asset('backend/assets/img/avatar.svg') }}" alt class="h-auto rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                                        <small class="text-muted">{{ Auth::user()->email }}</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        {{-- @if (!Auth::user()->hasRole('admin'))
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);">
                                <i class="ti ti-user-check me-2 ti-sm"></i>
                                <span class="align-middle">My Profile</span>
                            </a>
                        </li>
                        @endif --}}
                        
                        <li>
                            <a class="dropdown-item" href="{{ route('user.userSettingInfo') }}">
                                <i class="ti ti-settings me-2 ti-sm"></i>
                                <span class="align-middle">{{ __('general.Settings') }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('agent.verification') }}">
                                <i class="ti ti-shield me-2 ti-sm"></i>
                                <span class="align-middle">{{ __('general.Verification_Center') }}</span>
                            </a>
                        </li>
                        {{-- <li>
                            <a class="dropdown-item" href="javascript:void(0);">
                                <span class="d-flex align-items-center align-middle">
                                <i class="flex-shrink-0 ti ti-credit-card me-2 ti-sm"></i>
                                <span class="flex-grow-1 align-middle">Billing</span>
                                <span class="flex-shrink-0 badge badge-center rounded-pill bg-label-danger w-px-20 h-px-20"
                                    >2</span
                                >
                                </span>
                            </a>
                        </li> --}}
                        {{-- <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);">
                                <i class="ti ti-lifebuoy me-2 ti-sm"></i>
                                <span class="align-middle">Help</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);">
                                <i class="ti ti-help me-2 ti-sm"></i>
                                <span class="align-middle">FAQ</span>
                            </a>
                        </li> --}}
                        {{-- <li>
                            <a class="dropdown-item" href="javascript:void(0);">
                                <i class="ti ti-currency-dollar me-2 ti-sm"></i>
                                <span class="align-middle">Pricing</span>
                            </a>
                        </li> --}}
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" target="_blank">
                                <i class="ti ti-logout me-2 ti-sm"></i>
                                <span class="align-middle"> {{ __('general.Logout') }}</span>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--/ User -->
            </ul>
        </div>

        <!-- Search Small Screens -->
        <div class="navbar-search-wrapper search-input-wrapper container-xxl d-none">
            <input
            type="text"
            class="form-control search-input border-0"
            placeholder="Search..."
            aria-label="Search..." />
            <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
        </div>
    </div>
</nav>