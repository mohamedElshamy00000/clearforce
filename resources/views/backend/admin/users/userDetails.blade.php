@extends('layouts.backend')
@section('navicon') <i class="menu-icon tf-icons ti ti-users"></i> @endsection

@section('title')
  Clients Details
@endsection

@section('content')

<div class="row">
    <!-- User Sidebar -->
    <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
      <!-- User Card -->
      <div class="card mb-4">
        <div class="card-body">
          <div class="user-avatar-section">
            <div class="d-flex align-items-center flex-column">
              <div class="user-info text-center">
                <h4 class="mb-2">{{ $user->name }}</h4>
                <span class="badge bg-label-secondary mt-1">{{ $user->email }}</span>
              </div>
            </div>
          </div>
          <p class="mt-4 small text-uppercase text-muted">Details</p>
          <div class="info-container">
            <ul class="list-unstyled">
              <li class="mb-2">
                <span class="fw-semibold me-1">project payment mode:</span>
                @if ($user->project_payment_mode == 2)
                    <span class="badge bg-label-success">active</span>
                @elseif ($user->project_payment_mode == 1)
                    <span class="badge bg-label-danger">not active</span>
                @endif
              </li>
              <li class="mb-2">
                <span class="fw-semibold me-1">Username:</span>
                <span>{{ $user->name }}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Email:</span>
                <span>{{ $user->email }}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Status:</span>
                @if ($user->status == 1)
                    <span class="badge bg-label-success">active</span>
                @else
                    <span class="badge bg-label-danger">not active</span>
                @endif
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Role:</span>
                <span>{{ $user->roles[0]->name }}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">address:</span>
                <span>{{ $user->address }}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">zipCode:</span>
                <span>{{ $user->zipCode }}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Contact:</span>
                <span>{{ $user->phone }}</span>
              </li>
              
              <li class="pt-1">
                <span class="fw-semibold me-1">Country:</span>
                <span>{{ $user->country }}</span>
              </li>
            </ul>
            <div class="d-flex justify-content-center">
              <a href="javascript:;" class="w-100 btn btn-primary" data-bs-target="#editUser" data-bs-toggle="modal">Edit</a>
            </div>
          </div>
        </div>
      </div>
      <!-- /User Card -->
      <!-- Plan Card -->
      <div class="card mb-4">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start">
            <span class="badge bg-label-primary">Wallet</span>
          </div>
          <div class="d-flex justify-content-between align-items-center mt-3 mb-1 fw-semibold text-heading">
            <span>balance</span>
            <h5 class="mb-0">{{ $user->balance() }} <sup>SAR</sup></h5>
          </div>
          <div class="d-grid w-100 mt-4">
            <button class="btn btn-primary" data-bs-target="#upgradePlanModal" data-bs-toggle="modal">
                Wallet Charging
            </button>
          </div>
        </div>
      </div>
      <!-- /Plan Card -->
    </div>
    <!--/ User Sidebar -->

    <!-- User Content -->
    <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">

    @if ($user->hasRole('client'))
        <!-- Project table -->
        <div class="card mb-4">
            <h5 class="card-header">Projects List</h5>
            <div class="table-responsive">
            <table class="table datatable-project border-top" id="projects">
                <thead>
                <tr>
                    <th><i class="fa-solid fa-money-bill-1"></i></th>
                    <th><i class="fa-solid fa-people-arrows"></i></th>
                    <th><i class="fa-solid fa-truck-arrow-right"></i></th>
                    <th><i class="fa-solid fa-timeline"></i></th>
                    <th><i class="fa-regular fa-calendar-days"></i></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
            </table>
            </div>
        </div>
        <!-- /company table -->
        @if ($user->companies)
        <div class="card mb-4">
            <h5 class="card-header">Client Company's</h5>
            <div class="card-body pb-0">

              <ul class="list-unstyled mb-0">
                @foreach ($user->companies as $company)
                <li class="mb-4">
                  <div class="d-flex align-items-start">
                    <div class="badge bg-label-secondary p-2 me-3 rounded"><i class="ti ti-shadow ti-sm"></i></div>
                    <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                      <div class="me-2">
                        <h6 class="mb-0">{{ $company->name }}</h6>
                        <small class="text-muted">{{ $company->industry }}</small>
                      </div>
                      <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center avatar-group">
                          @foreach ($company->users as $cuser)
                  
                            <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" aria-label="{{ $cuser->name }}" data-bs-original-title="{{ $cuser->name }}">
                              <a href="{{ route('admin.users.details' , $cuser->id) }}" class="avatar-initial rounded-circle bg-dark text-white">{{ substr($cuser->name,0,2); }}</a>
                            </div>
                          @endforeach
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                @endforeach
              </ul>

            </div>
        </div>
        @endif
    @elseif ($user->hasRole('agent'))
          <!-- Project table -->
        <div class="card mb-4">
            <h5 class="card-header">Proposals List</h5>
            <div class="table-responsive">
            <table class="table datatable-project border-top" id="proposals">
                <thead>
                <tr>
                    <th>Budget</th>
                    <th>note</th>
                    <th>date</th>
                    <th>status</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
            </div>
        </div>
        <!-- /Project table -->
    @endif

      <!-- wallet -->
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
          <div class="card-title mb-0">
            <h5 class="mb-0">Wallet Transactions</h5>
            <small><a class="text-muted" href="{{ route('admin.users.transaction.history') }}">See All users transaction</a></small>
          </div>
        </div>

        <div class="card-body">
          <ul class="p-0 m-0">
              @foreach ($wallet as $transaction)
              <li class="mb-4 pb-1 d-flex justify-content-between align-items-center">
                <div class="badge text-dark rounded p-2">
                    @if ($transaction->type == 'debit')
                        <span class="ms-3 badge bg-label-dark ms-auto ">debit <i class="ti ti-arrow-up ti-xs"></i></span>
                     @elseif($transaction->type == 'credit')
                        <span class="ms-3 badge bg-label-success ms-auto ">credit <i class="ti ti-arrow-down ti-xs"></i></span>
                    @endif
                </div>
                <div class="d-flex justify-content-between w-100 flex-wrap">
                  <h6 class="mb-0 ms-3">{{ $transaction->description }}</h6>
                  <div class="d-flex">
                    <p class="mb-0 fw-semibold">{{ $transaction->amount }} SAR</p>
                    <p class="ms-3 text-success mb-0">{{ $transaction->created_at->format('d M Y') }}</p>
                  </div>
                </div>
                <div class="d-flex justify-content-end w-50 flex-wrap">
                    <button type="button" class="btn btn-sm btn-label-@if ($transaction->status == 1)success @elseif ($transaction->status == 0)danger @endif waves-effect" aria-expanded="false">
                      @if ($transaction->status == 1) 
                      Paid
                      @elseif ($transaction->status == 0)
                      Unpaid
                      @endif
                    </button>
                    @if ($transaction->status == 0)
                    <div class="dropdown ms-2">
                      <i class="ti ti-settings ti-xs cursor-pointer more-options-dropdown" role="button" id="dropdownMenuButton" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false"></i>
                      <form method="post" action="{{ route('admin.edit.transaction', $transaction->id)  }}">
                        @csrf
                          <div class="dropdown-menu dropdown-menu-end w-px-300 p-3" aria-labelledby="dropdownMenuButton">
                              <div class="row g-3">
                                  <div class="col-md-12">
                                      <label for="method" class="form-label">method</label>
                                      <select name="method" id="method" class="form-select tax-select">
                                          <option value="Bank transfer">Bank transfer</option>
                                          <option value="Cash">Cash</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="dropdown-divider my-3"></div>
                              <button type="submit" class="btn btn-label-primary btn-apply-changes waves-effect">Apply</button>
                          </div>
                      </form>
                    </div>
                    @endif
                </div>
                
              </li>
              @endforeach
          </ul>
        </div>
      </div>
      <!-- /wallet Timeline -->

    </div>
    <!--/ User Content -->
  </div>

  <!-- Modal -->
  <!-- Edit User Modal -->
  <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
      <div class="modal-content p-3 p-md-5">
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center mb-4">
            <h3 class="mb-2">Edit User Information</h3>
            <p class="text-muted">Updating user details will receive a privacy audit.</p>
          </div>
          <form id="editUserForm" class="row g-3" method="POST" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            <div class="col-12">
              <label class="form-label" for="modalEditUserName">Username</label>
              <input type="text" id="modalEditUserName" name="name" class="form-control  @error('name') is-invalid @enderror" value="{{ $user->name }}" />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="modalEditUserEmail">Email</label>
              <input type="text" id="modalEditUserEmail" name="email" disabled class="form-control  @error('email') is-invalid @enderror" value="{{ $user->email }}" />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="modalEditUserStatus">Status</label>
              <select id="modalEditUserStatus" name="status" class="form-select  @error('status') is-invalid @enderror" aria-label="Default select example">
                <option @if ($user->status == 1) selected @endif value="1">Active</option>
                <option @if ($user->status == 0) selected @endif value="0">Inactive</option>
              </select>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="modalEditAddress">Address</label>
              <input type="text" id="modalEditAddress" name="address" class=" @error('address') is-invalid @enderror form-control modal-edit-tax-id" value="{{ $user->address }}" />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="modalEditUserPhone">Phone Number</label>
              <div class="input-group">
                {{-- <span class="input-group-text">US (+1)</span> --}}
                <input
                  type="text"
                  id="modalEditUserPhone"
                  name="phone"
                  class="form-control phone-number-mask  @error('phone') is-invalid @enderror"
                  value="{{ $user->phone }}" />
              </div>
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label" for="modalEditUserCountry">Country</label>
                <select
                    id="modalEditUserCountry"
                    name="country"
                    class="select2 form-select  @error('country') is-invalid @enderror"
                    data-allow-clear="true">
                    @foreach ($countries as $country)
                        <option @if ($country->code == $user->country) selected @endif value="{{ $country->code }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            
            @if ($user->hasRole('agent'))
            <div class="col-12">
                <label class="switch">
                  <input type="checkbox" name="supportTransfer" class=" @error('supportTransfer') is-invalid @enderror switch-input" value="1" @if ($user->supportTransfer == 1) checked  @endif />
                  <span class="switch-toggle-slider">
                    <span class="switch-on"></span>
                    <span class="switch-off"></span>
                  </span>
                  <span class="switch-label">Provides transportation service?</span>
                </label>
            </div>
            @elseif ($user->hasRole('client'))
            <div class="col-12 col-md-6">
              <label class="form-label" for="modalEditUserStatus">Paid after completing the process</label>
              <select id="modalEditUserStatus" name="project_payment_mode" class="@error('project_payment_mode') is-invalid @enderror form-select">
                <option @if ($user->project_payment_mode == 2) selected @endif value="2">Active</option>
                <option @if ($user->project_payment_mode == 1) selected @endif value="1">Inactive</option>
              </select>
            </div>
            @endif
            <hr class="mx-md-n6 mx-n6 mt-4">
            <div class="col-12 col-md-6 mt-0">
                <label for="password" class="col-form-label">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-12 col-md-6 mt-0">
                <label for="password-confirm" class="col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
            </div>

            <div class="col-12 text-center mt-3">
              <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
            </div>
          </form>

        </div>
      </div>
    </div>
</div>
<!--/ Edit User Modal -->

<!-- Add New Credit Card Modal -->
<div class="modal fade" id="upgradePlanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
      <div class="modal-content p-3 p-md-5">
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center mb-4">
            <h3 class="mb-2">Wallet charging</h3>
          </div>
          <form id="upgradePlanForm" action="{{ route('admin.wallet.charging', $user->id) }}" class="row">
            <div class="col-md-6">
              <label class="form-label" for="choosePlan">Add Amount</label>
              <input type="number" class="form-control" name="amount">
            </div>
            <div class="col-md-6 p-4">
              <div class="form-check">
                <input class="form-check-input" name="paymentType" type="radio" value="1" id="defaultRadio1" checked="">
                <label class="form-check-label" for="defaultRadio1">Bank transfer</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" name="paymentType" type="radio" value="0" id="defaultRadio2" >
                <label class="form-check-label" for="defaultRadio2">unpaid charging</label>
              </div>
            </div>

            <div class="w-100 d-flex align-items-end">
              <button type="submit" class="btn btn-primary w-100">add</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>
<!--/ Add New Credit Card Modal -->


@endsection

@section('script')
@if ($user->hasrole('client'))
<script>
    $(document).ready( function () {

    var table = $('#projects').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ route('admin.getClientProjects', $user->id) }}",
        columns: [
            {data: 'Budget', name: 'Budget'},
            {data: 'Proposals', name: 'Proposals'},
            {data: 'needShiping', name: 'needShiping'},
            {data: 'milestones', name: 'milestones'},
            {data: 'created_at', name: 'created_at'},
            {
                data: 'status', 
                name: 'status', 
                orderable: true, 
                searchable: true,
            },
            {
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false,
            },
        ],
        dom: 'Bfrtip'
    });

    });
</script>
@elseif ($user->hasRole('agent'))
    <script>
        $(document).ready( function () {

            var table = $('#proposals').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('admin.getAgentProposals', $user->id) }}",
                columns: [
                    {data: 'budget', name: 'budget'},
                    {data: 'note', name: 'note'},
                    {data: 'created_at', name: 'created_at'},
                    {
                        data: 'status', 
                        name: 'status', 
                        orderable: true, 
                        searchable: true,
                    },
                    {
                        data: 'action', 
                        name: 'action', 
                        orderable: false, 
                        searchable: false,
                    },
                ],
                dom: 'Bfrtip'
            });

        });
    </script>
@endif
@endsection