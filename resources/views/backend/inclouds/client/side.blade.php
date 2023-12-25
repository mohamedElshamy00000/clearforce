<!-- Menu -->
<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
    <div class="container-xxl d-flex h-100">
        <ul class="menu-inner w-100 menu-d-flex">
            <!-- Dashboards -->
            <li class="menu-item {{ (request()->is('dashboard/client')) ? ' active ' : '' }}">
                <a href="{{ route('client.index') }}" class="menu-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon icon icon-tabler icon-tabler-smart-home" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M19 8.71l-5.333 -4.148a2.666 2.666 0 0 0 -3.274 0l-5.334 4.148a2.665 2.665 0 0 0 -1.029 2.105v7.2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-7.2c0 -.823 -.38 -1.6 -1.03 -2.105"></path>
                        <path d="M16 15c-2.21 1.333 -5.792 1.333 -8 0"></path>
                    </svg>
                    <div data-i18n="Dashboards">{{ __('general.Dashboard') }}</div>
                </a>
            </li>

            <li class="menu-item {{ (request()->is('dashboard/projects')) ? ' active ' : '' }}">
                <a href="{{ route('client.all.projects') }}" class="menu-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon icon icon-tabler icon-tabler-apps" width="23" height="23" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                        <path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                        <path d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                        <path d="M14 7l6 0"></path>
                        <path d="M17 4l0 6"></path>
                    </svg>
                    <div data-i18n="Projects">{{ __('general.Projects') }}</div>
                </a>
            </li>

            <li class="menu-item {{ (request()->is('dashboard/user/helpcenter')) ? ' active ' : '' }}">
                <a href="{{ route('user.helpcenter') }}" class="menu-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon icon icon-tabler icon-tabler-24-hours" width="23" height="23" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M4 13c.325 2.532 1.881 4.781 4 6"></path>
                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2"></path>
                        <path d="M4 5v4h4"></path>
                        <path d="M12 15h2a1 1 0 0 1 1 1v1a1 1 0 0 1 -1 1h-1a1 1 0 0 0 -1 1v1a1 1 0 0 0 1 1h2"></path>
                        <path d="M18 15v2a1 1 0 0 0 1 1h1"></path>
                        <path d="M21 15v6"></path>
                     </svg>
                     
                     <div data-i18n="Support">{{ __('general.Support') }}</div>
                </a>
            </li>

            <!-- Invoices -->
            <li class="menu-item {{ (request()->is('dashboard/payment/invoices')) ? ' active ' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon icon icon-tabler icon-tabler-receipt-refund" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2"></path>
                        <path d="M15 14v-2a2 2 0 0 0 -2 -2h-4l2 -2m0 4l-2 -2"></path>
                    </svg>
                    <div data-i18n="Invoices">{{ __('general.payment') }}</div>
                </a>
                
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{ route('client.payment.invoices') }}" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-square"></i>
                            <div data-i18n="Blank">{{ __('general.payment') }}</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('client.payment.myTransactions') }}" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-square"></i>
                            <div data-i18n="Blank">{{ __('general.Wallet') }}</div>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- storage -->
            <li class="menu-item {{ (request()->is('dashboard/company/storage')) ? ' active ' : '' }}">
                <a href="{{ route('client.storage', App\Models\Company::where('user_id', auth()->user()->id)->first()->id) }}" class="menu-link">
                    {{-- <i class="menu-icon tf-icons ti ti-building-warehouse"></i> --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon icon icon-tabler icon-tabler-building-warehouse" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 21v-13l9 -4l9 4v13" />
                        <path d="M13 13h4v8h-10v-6h6" />
                        <path d="M13 21v-9a1 1 0 0 0 -1 -1h-2a1 1 0 0 0 -1 1v3" />
                      </svg>
                    <div data-i18n="storage">{{ __('general.storage') }}</div>
                </a>
            </li>

        {{-- </ul>

        <ul class="menu-inner" > --}}
            <!-- Create Project -->
            <li class="menu-item">
                <a href="{{ route('client.project.create') }}" class="addproject btn btn-dark text-white menu-link ">
                  <i class="menu-icon tf-icons ti ti-plus"></i>
                  <div data-i18n="CreateProject">{{ __('general.Create_Project') }}</div>
                </a>
            </li>
        </ul>
    </div>
  </aside>
  <!-- / Menu -->
