@extends('layouts.backend')
@section('navicon') <i class="menu-icon tf-icons ti ti-users"></i> @endsection

@section('title')
    Agents
@endsection
@section('content')

<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Agents</span>
              <div class="d-flex align-items-center my-1">
                <h4 class="mb-0 me-2">{{ $agents->count() }}</h4>
                {{-- <span class="text-success">(+29%)</span> --}}
              </div>
              <span>Total Agents</span>
            </div>
            <span class="badge bg-label-primary rounded p-2">
              <i class="ti ti-user ti-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Verified Agents</span>
              <div class="d-flex align-items-center my-1">
                <h4 class="mb-0 me-2">{{ $verifiyagents }}</h4>
                <span class="text-success"></span>
              </div>
              <span>Total Verified Agents</span>
            </div>
            <span class="badge bg-label-success rounded p-2">
              <i class="ti ti-user-plus ti-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>V Pending</span>
              <div class="d-flex align-items-center my-1">
                <h4 class="mb-0 me-2">{{ $verifiyPending }}</h4>
                {{-- <span class="text-danger">(-14%)</span> --}}
              </div>
              <span>Verified Pending</span>
            </div>
            <span class="badge bg-label-info rounded p-2">
              <i class="ti ti-user-check ti-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Banned Pending</span>
              <div class="d-flex align-items-center my-1">
                <h4 class="mb-0 me-2"> -- </h4>
                {{-- <span class="text-success">0.0</span> --}}
              </div>
              <span>Total Agents</span>
            </div>
            <span class="badge bg-label-warning rounded p-2">
              <i class="ti ti-user-exclamation ti-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
</div>
  <!-- Users List Table -->
<div class="card">

    <!-- Column Search -->
    <div class="">
        <table class="table yajra-datatable" id="result2">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <!--/ Column Search -->

    <!-- Offcanvas to add new user -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
      <div class="offcanvas-header">
        <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
        <button
          type="button"
          class="btn-close text-reset"
          data-bs-dismiss="offcanvas"
          aria-label="Close"></button>
      </div>
      <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
        <form class="add-new-user pt-0" id="addNewUserForm" onsubmit="return false">
          <div class="mb-3">
            <label class="form-label" for="add-user-fullname">Full Name</label>
            <input
              type="text"
              class="form-control"
              id="add-user-fullname"
              placeholder="John Doe"
              name="userFullname"
              aria-label="John Doe" />
          </div>
          <div class="mb-3">
            <label class="form-label" for="add-user-email">Email</label>
            <input
              type="text"
              id="add-user-email"
              class="form-control"
              placeholder="john.doe@example.com"
              aria-label="john.doe@example.com"
              name="userEmail" />
          </div>
          <div class="mb-3">
            <label class="form-label" for="add-user-contact">Contact</label>
            <input
              type="text"
              id="add-user-contact"
              class="form-control phone-mask"
              placeholder="+1 (609) 988-44-11"
              aria-label="john.doe@example.com"
              name="userContact" />
          </div>
          <div class="mb-3">
            <label class="form-label" for="add-user-company">Company</label>
            <input
              type="text"
              id="add-user-company"
              class="form-control"
              placeholder="Web Developer"
              aria-label="jdoe1"
              name="companyName" />
          </div>
          <div class="mb-3">
            <label class="form-label" for="country">Country</label>
            <select id="country" class="select2 form-select">
              <option value="">Select</option>
              <option value="Australia">Australia</option>
              <option value="Bangladesh">Bangladesh</option>
              <option value="Belarus">Belarus</option>
              <option value="Brazil">Brazil</option>
              <option value="Canada">Canada</option>
              <option value="China">China</option>
              <option value="France">France</option>
              <option value="Germany">Germany</option>
              <option value="India">India</option>
              <option value="Indonesia">Indonesia</option>
              <option value="Israel">Israel</option>
              <option value="Italy">Italy</option>
              <option value="Japan">Japan</option>
              <option value="Korea">Korea, Republic of</option>
              <option value="Mexico">Mexico</option>
              <option value="Philippines">Philippines</option>
              <option value="Russia">Russian Federation</option>
              <option value="South Africa">South Africa</option>
              <option value="Thailand">Thailand</option>
              <option value="Turkey">Turkey</option>
              <option value="Ukraine">Ukraine</option>
              <option value="United Arab Emirates">United Arab Emirates</option>
              <option value="United Kingdom">United Kingdom</option>
              <option value="United States">United States</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label" for="user-role">User Role</label>
            <select id="user-role" class="form-select">
              <option value="subscriber">Subscriber</option>
              <option value="editor">Editor</option>
              <option value="maintainer">Maintainer</option>
              <option value="author">Author</option>
              <option value="admin">Admin</option>
            </select>
          </div>
          <div class="mb-4">
            <label class="form-label" for="user-plan">Select Plan</label>
            <select id="user-plan" class="form-select">
              <option value="basic">Basic</option>
              <option value="enterprise">Enterprise</option>
              <option value="company">Company</option>
              <option value="team">Team</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
        </form>
      </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready( function () {

        var table = $('#result2').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('getAgentsData') }}",
            columns: [
                // {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {
                    data: 'status', 
                    name: 'status', 
                    orderable: true, 
                    searchable: true,
                },
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: true, 
                    searchable: true,
                },
                
                
            ],
            dom: 'Bfrtip'
        });

    });

</script>
@endsection