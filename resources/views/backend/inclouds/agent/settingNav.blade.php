<div class="d-flex justify-content-between flex-column mb-3 mb-md-0 pe-md-3">
    <ul class="nav nav-align-left nav-pills flex-column" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link py-2 {{ (request()->is('dashboard/Verification-center')) ? ' active ' : '' }} " href="{{ route('agent.verification') }}">
                <i class="ti ti-shield me-2"></i>
                <span class="align-middle">Verification center</span>
            </a>
        </li>
    </ul>
</div>