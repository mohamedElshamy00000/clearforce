<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="ti ti-menu-2 ti-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item navbar-search-wrapper mb-0">
                <span class="nav-item nav-link search-toggler d-flex align-items-center px-0 fs-5 fw-bold">
                    @yield('navicon') @yield('title') 
                </span>
            </div>
        </div>
        <!-- /Search -->

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
                        <h5 class="text-body mb-0 me-auto">Notification</h5>
                        <a
                        href="javascript:void(0)"
                        class="dropdown-notifications-all text-body"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Mark all as read">
                        <i class="ti ti-mail-opened fs-4"></i></a>
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
                                                @elseif ( $notification->data['category'] == 'new-payment')
                                                    <i class="fs-3 ti ti-credit-card"></i>
                                                @elseif ( $notification->data['category'] == 'new-project')
                                                    <i class="fs-3 ti ti-playlist-add"></i>
                                                @elseif ( $notification->data['category'] == 'new-payout')
                                                    <i class="fs-3 ti ti-receipt-2"></i>
                                                    
                                                @else
                                                    <i class="fs-3 ti ti-bell-ringing-2"></i>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">{{ $notification->data['user_name'] }}</h6>
                                        @if ($notification->data['category'] == 'new-project' || $notification->data['category'] == 'new-proposal' || $notification->data['category'] == 'new-project-invoice')
                                            <a href="{{ route('admin.project.single', $notification->data['link']) }}" class="mb-0"><strong>{!! $notification->data['title'] !!} </strong> {!! $notification->data['description'] !!}</a>
                                        @elseif ($notification->data['category'] == 'new-payment')
                                            <a href="{{ route('admin.users.transaction.history') }}" class="mb-0"><strong>{!! $notification->data['title'] !!} </strong> {!! $notification->data['description'] !!}</a>
                                        @elseif ($notification->data['category'] == 'support')
                                            <a href="{{ route('admin.ticket.single', $notification->data['link']) }}" class="mb-0"><strong>{!! $notification->data['title'] !!} </strong> {!! $notification->data['description'] !!}</a>
                                        @else
                                            <p class="mb-0"><strong>{!! $notification->data['title'] !!} </strong> {!! $notification->data['description'] !!}</p>
                                        @endif
                                        <br>
                                        <small class="text-muted">{{ $notification->created_at->format('d/m/Y h:m A') }}</small>
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
                    <li class="dropdown-menu-footer border-top">
                        <a
                            href="javascript:void(0);"
                            class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center">
                            View all notifications
                        </a>
                    </li>
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
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);">
                            <i class="ti ti-settings me-2 ti-sm"></i>
                            <span class="align-middle">{{ __('general.Settings') }}</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" target="_blank">
                            <i class="ti ti-logout me-2 ti-sm"></i>
                            <span class="align-middle"> {{ __('Logout') }}</span>
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

</nav>