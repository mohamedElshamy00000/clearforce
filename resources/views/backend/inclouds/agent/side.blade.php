<!-- Menu -->
<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
    <div class="container-xxl d-flex h-100">
        <ul class="menu-inner w-100 menu-d-flex">
            <!-- Dashboards -->
            <li class="menu-item {{ (request()->is('dashboard/agent')) ? ' active ' : '' }}">
                <a href="{{ route('agent.index') }}" class="menu-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon icon icon-tabler icon-tabler-smart-home" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M19 8.71l-5.333 -4.148a2.666 2.666 0 0 0 -3.274 0l-5.334 4.148a2.665 2.665 0 0 0 -1.029 2.105v7.2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-7.2c0 -.823 -.38 -1.6 -1.03 -2.105"></path>
                        <path d="M16 15c-2.21 1.333 -5.792 1.333 -8 0"></path>
                    </svg>
                    <div data-i18n="Dashboards">{{ __('general.Dashboard') }}</div>
                </a>
            </li>

            <li class="menu-item {{ (request()->is('dashboard/agent/myProposals')) ? ' active ' : '' }}">
                <a href="{{ route('agent.my.proposals') }}" class="menu-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon icon icon-tabler icon-tabler-apps" width="23" height="23" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                        <path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                        <path d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                        <path d="M14 7l6 0"></path>
                        <path d="M17 4l0 6"></path>
                    </svg>
                    <div data-i18n="Projects">{{ __('general.My_Proposals') }}</div>
                </a>
            </li>

            {{-- <li class="menu-item {{ (request()->is('dashboard/agent/helpcenter')) ? ' active ' : '' }}">
                <a href="{{ route('agent.helpcenter') }}" class="menu-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon icon icon-tabler icon-tabler-24-hours" width="23" height="23" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M4 13c.325 2.532 1.881 4.781 4 6"></path>
                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2"></path>
                        <path d="M4 5v4h4"></path>
                        <path d="M12 15h2a1 1 0 0 1 1 1v1a1 1 0 0 1 -1 1h-1a1 1 0 0 0 -1 1v1a1 1 0 0 0 1 1h2"></path>
                        <path d="M18 15v2a1 1 0 0 0 1 1h1"></path>
                        <path d="M21 15v6"></path>
                     </svg>
                     
                     <div data-i18n="Support">Support</div>
                </a>
            </li> --}}

            <!-- Payments -->
            <li class="menu-item {{ (request()->is('dashboard/agent/withdraw/*')) ? ' active ' : '' }}">
                <a href="{{ route('agent.withdraw.history') }}" class="menu-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon icon icon-tabler icon-tabler-wallet" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M17 8v-3a1 1 0 0 0 -1 -1h-10a2 2 0 0 0 0 4h12a1 1 0 0 1 1 1v3m0 4v3a1 1 0 0 1 -1 1h-12a2 2 0 0 1 -2 -2v-12"></path>
                        <path d="M20 12v4h-4a2 2 0 0 1 0 -4h4"></path>
                    </svg>
                    <div data-i18n="wallet">{{ __('general.Wallet') }}</div>
                </a>
            </li>

        {{-- </ul>

        <ul class="menu-inner" > --}}
            
            <!-- Create Project -->
            <li class="menu-item">
                <a href="{{ route('agent.expolore.projects') }}" class="btn btn-dark text-white menu-link ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon icon icon-tabler icon-tabler-input-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M20 11v-2a2 2 0 0 0 -2 -2h-12a2 2 0 0 0 -2 2v5a2 2 0 0 0 2 2h5"></path>
                        <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                        <path d="M20.2 20.2l1.8 1.8"></path>
                    </svg>
                    <div data-i18n="CreateProject">{{ __('general.Explore_Projects') }}</div>
                </a>
            </li>
        </ul>
    </div>
  </aside>
  <!-- / Menu -->
