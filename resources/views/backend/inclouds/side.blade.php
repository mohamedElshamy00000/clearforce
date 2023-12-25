
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ url('/') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('backend/assets/img/clear forces-10.png') }}" width="100%" alt="">
            </span>
            <span class="app-brand-text demo menu-text fw-bold">ClearForce</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{ (request()->is('dashboard')) ? ' active open ' : '' }} ">
            <a href="{{ route('admin.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboards">{{ __('general.Dashboard') }}</div>
            </a>
        </li>

        <!-- Layouts -->
        <li class="menu-item {{ (request()->is('dashboard/admin/users/*')) ? ' active open ' : '' }} ">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="Layouts">{{ __('general.Users') }}</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item{{ (request()->is('dashboard/admin/users/clients')) ? ' active open ' : '' }}">
                    <a href="{{ route('admin.clients') }}" class="menu-link">
                        <div data-i18n="clients">{{ __('general.Clients') }}</div>
                    </a>
                </li>
                <li class="menu-item{{ (request()->is('dashboard/admin/users/agents')) ? ' active open ' : '' }}">
                    <a href="{{ route('admin.agents') }}" class="menu-link">
                        <div data-i18n="agents">{{ __('general.Agents') }}</div>
                    </a>
                </li>
                {{-- <li class="menu-item{{ (request()->is('dashboard/admin/users/roles')) ? ' active open ' : '' }}">
                    <a href="layouts-content-navbar-with-sidebar.html" class="menu-link">
                        <div data-i18n="roles">Roles</div>
                    </a>
                </li> --}}
                <li class="menu-item{{ (request()->is('dashboard/admin/users/verifications')) ? ' active open ' : '' }}">
                    <a href="{{ route('admin.users.verificationcenter') }}" class="menu-link">
                        <div data-i18n="verification-center">{{ __('general.Verification_Center') }}</div>
                    </a>
                </li>
                <li class="menu-item{{ (request()->is('dashboard/admin/users/transactions')) ? ' active open ' : '' }}">
                    <a href="{{ route('admin.users.transaction.history') }}" class="menu-link">
                        <div data-i18n="transaction-history">{{ __('general.Transaction_History') }}</div>
                    </a>
                </li>
                
            </ul>
        </li>
        <li class="menu-item {{ (request()->is('dashboard/project/*')) ? ' active open ' : '' }} ">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-clipboard"></i>
                <div data-i18n="projects">{{ __('general.Projects') }}</div>
                <div class="badge bg-label-success rounded-pill ms-auto">{{ App\Models\Project::where('status', 0)->count() }}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ (request()->is('dashboard/project/all')) ? ' active open ' : '' }}">
                    <a href="{{ route('admin.projects') }}" class="menu-link">
                        <div data-i18n="all-projects">{{ __('general.All_Projects') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->is('dashboard/project/productFileType')) ? ' active open ' : '' }}">
                    <a href="{{ route('admin.product.fileType') }}" class="menu-link">
                        <div data-i18n="files-type">File's type</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->is('dashboard/project/country')) ? ' active open ' : '' }}">
                    <a href="{{ route('admin.countries') }}" class="menu-link">
                        <div data-i18n="countries">{{ __('general.Countries') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->is('dashboard/project/shippingWays')) ? ' active open ' : '' }}">
                    <a href="{{ route('admin.shipping.way') }}" class="menu-link">
                        <div data-i18n="shipping-way">{{ __('general.Shipping_Mode') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->is('dashboard/project/shippingWayPort')) ? ' active open ' : '' }}">
                    <a href="{{ route('admin.shipping.way.port') }}" class="menu-link">
                        <div data-i18n="ports">{{ __('general.Ports') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->is('dashboard/project/HScode')) ? ' active open ' : '' }}">
                    <a href="{{ route('admin.HScode') }}" class="menu-link">
                        <div data-i18n="HS-codes">{{ __('general.HS_Codes') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->is('dashboard/project/millstone')) ? ' active open ' : '' }}">
                    <a href="{{ route('admin.millstones') }}" class="menu-link">
                        <div data-i18n="HS-codes">{{ __('general.Milestones') }}</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item {{ (request()->is('dashboard/payout/*')) ? ' active open ' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-arrows-left-right"></i>
                <div data-i18n="Withdraw-History">{{ __('general.Withdraw') }}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ (request()->is('dashboard/payout/history')) ? ' active ' : '' }}">
                    <a href="{{ route('admin.agent.payout.history') }}" class="menu-link">
                        <div data-i18n="all-History">{{ __('general.History') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->is('dashboard/payout/requests')) ? ' active ' : '' }}">
                    <a href="{{ route('admin.agent.payout.requests') }}" class="menu-link">
                        <div data-i18n="requests">{{ __('general.Requests') }}</div>
                        <div class="badge bg-label-{{ (request()->is('dashboard/payout/requests')) ? 'dark' : 'success' }} rounded-pill ms-auto">{{ App\Models\Withdraw::where('status', 0)->count() }}</div>
                    </a>
                </li>
            </ul>
        </li>

        {{-- <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
                <i class="menu-icon tf-icons ti ti-thumb-down"></i>
                <div data-i18n="Refunds">Refunds</div>
            </a>
        </li> --}}
        <li class="menu-item {{ (request()->is('dashboard/support/*')) ? ' active ' : '' }} ">
            <a href="{{ route('admin.support') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-lifebuoy"></i>
                <div data-i18n="Support">{{ __('general.Support') }}</div>
                <div class="badge bg-label-success rounded-pill ms-auto">{{ App\Models\SupportTicket::where('status', 0)->count() }}</div>

            </a>
        </li>
        <li class="menu-item {{ (request()->is('dashboard/blog/*')) ? ' active ' : '' }}">
            <a href="{{ route('admin.articles') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-files"></i>
                <div data-i18n="Blog">{{ __('general.Blog') }}</div>
            </a>
        </li>


        <li class="menu-item {{ (request()->is('dashboard/contact-us')) ? ' active ' : '' }}">
            <a href="{{ route('admin.contact.us') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-mail"></i>
                <div data-i18n="Contacts">{{ __('general.Contacts') }}</div>
            </a>
        </li>

        <li class="menu-item {{ (request()->is('dashboard/setting/*')) ? ' active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-settings"></i>
                <div data-i18n="Setting">{{ __('general.Settings') }}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ (request()->is('dashboard/setting/main-settings')) ? ' active open ' : '' }}">
                    <a href="{{ route('admin.main.setting') }}" class="menu-link">
                        <div data-i18n="List">main</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->is('dashboard/setting/Terms-Privacy')) ? ' active open ' : '' }}">
                    <a href="{{ route('admin.privacy.terms') }}" class="menu-link">
                        <div data-i18n="List"> Terms $ Privacy </div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->is('dashboard/setting/taxts')) ? ' active open ' : '' }}">
                    <a href="{{ route('admin.taxs') }}" class="menu-link">
                        <div data-i18n="taxs">taxs</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->is('dashboard/setting/QA/*')) ? ' active open ' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="Q&A">Q&A</div>
                    </a>
                    <ul class="menu-sub">
                        
                        <li class="menu-item {{ (request()->is('dashboard/setting/QA/categorys')) ? ' active open ' : '' }}">
                            <a href="{{ route('admin.questions.categorys') }}" class="menu-link">
                                <div data-i18n="categorys">categorys</div>
                            </a>
                        </li>
                        <li class="menu-item {{ (request()->is('dashboard/setting/QA/questions')) ? ' active open ' : '' }}">
                            <a href="{{ route('admin.questions') }}" class="menu-link">
                                <div data-i18n="questions">questions</div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>

    </ul>
</aside>
<!-- / Menu -->