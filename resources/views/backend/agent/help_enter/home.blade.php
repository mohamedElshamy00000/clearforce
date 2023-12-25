@extends('layouts.agent')

@section('title')
    Help Center
@endsection

@section('content')

  <div class="faq-header d-flex flex-column justify-content-center align-items-center rounded">
    <h3 class="text-center">Hello, how can we help?</h3>
    <p class="text-center mb-0 px-3">choose a category to quickly find the help you need</p>
  </div>

  <div class="row mt-4">
    <!-- Navigation -->
    <div class="col-lg-3 col-md-4 col-12 mb-md-0 mb-3">
      <div class="d-flex justify-content-between flex-column mb-2 mb-md-0">
        <ul class="nav nav-align-left nav-pills flex-column">
          <li class="nav-item mb-2">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#Tickets">
              <i class="ti ti-ticket me-1 ti-sm"></i>
              <span class="align-middle fw-semibold">Support Tickets</span>
            </button>
          </li>
          <li class="nav-item mb-2">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#payment">
              <i class="ti ti-credit-card me-1 ti-sm"></i>
              <span class="align-middle fw-semibold">Payment</span>
            </button>
          </li>
          <li class="nav-item mb-2">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#cancellation">
              <i class="ti ti-rotate-clockwise-2 me-1 ti-sm"></i>
              <span class="align-middle fw-semibold">Cancellation & Return</span>
            </button>
          </li>
          <li class="nav-item mb-2">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#orders">
              <i class="ti ti-box me-1 ti-sm"></i>
              <span class="align-middle fw-semibold">My Projects</span>
            </button>
          </li>
          <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#product">
              <i class="ti ti-settings me-1 ti-sm"></i>
              <span class="align-middle fw-semibold">Services</span>
            </button>
          </li>
        </ul>
      </div>
    </div>
    <!-- /Navigation -->

    <!-- FAQ's -->
    <div class="col-lg-9 col-md-8 col-12">
      <div class="tab-content py-0">
        <div class="tab-pane fade show active" id="Tickets" role="tabpanel">
          <div class="d-flex mb-3 gap-3">
            <div>
              <span class="badge bg-label-primary rounded-2 p-2">
                <i class="ti ti-ticket ti-lg"></i>
              </span>
            </div>
            <div>
              <h4 class="mb-0">
                <span class="align-middle">My Support Tickets</span>
              </h4>
              <small>tickets</small>
            </div>
          </div>
          <div class="card shadow-xs">
              <!-- Column Search -->
              {{-- <table class="table yajra-datatable" id="supportTickets">
                  <thead>
                      <tr>
                          <th>id</th>
                          <th>subject</th>
                          <th>category</th>
                          <th>project</th>
                          <th>date</th>
                          <th>status</th>
                      </tr>
                  </thead>
                  <tbody>
                  </tbody>
              </table> --}}
              <!--/ Column Search -->
          </div>
        </div>
        <div class="tab-pane fade" id="payment" role="tabpanel">
          <div class="d-flex mb-3 gap-3">
            <div>
              <span class="badge bg-label-primary rounded-2 p-2">
                <i class="ti ti-ticket ti-lg"></i>
              </span>
            </div>
            <div>
              <h4 class="mb-0">
                <span class="align-middle">Payment</span>
              </h4>
              <small>payemnt</small>
            </div>
          </div>
          <div id="accordionDelivery" class="accordion">
            <div class="card accordion-item">
              <h2 class="accordion-header">
                <button
                  class="accordion-button"
                  type="button"
                  data-bs-toggle="collapse"
                  aria-expanded="true"
                  data-bs-target="#accordionDelivery-1"
                  aria-controls="accordionDelivery-1">
                  How to pay for customs clearance service?
                </button>
              </h2>

              <div id="accordionDelivery-1" class="accordion-collapse collapse show">
                <div class="accordion-body">
                  Via online payment, Visa or MasterCard
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="tab-pane fade" id="cancellation" role="tabpanel">
          <div class="d-flex mb-3 gap-3">
            <div>
              <span class="badge bg-label-primary rounded-2 p-2">
                <i class="ti ti-rotate-clockwise-2 ti-lg"></i>
              </span>
            </div>
            <div>
              <h4 class="mb-0"><span class="align-middle">Cancellation & Return</span></h4>
              <small>.</small>
            </div>
          </div>
          <div id="accordionCancellation" class="accordion">

          </div>
        </div>
        <div class="tab-pane fade" id="orders" role="tabpanel">
          <div class="d-flex mb-3 gap-3">
            <div>
              <span class="badge bg-label-primary rounded-2 p-2">
                <i class="ti ti-box ti-lg"></i>
              </span>
            </div>
            <div>
              <h4 class="mb-0">
                <span class="align-middle">My Orders</span>
              </h4>
              <small>.</small>
            </div>
          </div>
          <div id="accordionOrders" class="accordion">

          </div>
        </div>
        <div class="tab-pane fade" id="product" role="tabpanel">
          <div class="d-flex mb-3 gap-3">
            <div>
              <span class="badge bg-label-primary rounded-2 p-2">
                <i class="ti ti-camera ti-lg"></i>
              </span>
            </div>
            <div>
              <h4 class="mb-0">
                <span class="align-middle">Product & Services</span>
              </h4>
              <small>.</small>
            </div>
          </div>
          <div id="accordionProduct" class="accordion">

          </div>
        </div>
      </div>
    </div>
    <!-- /FAQ's -->
</div>

@endsection

@section('script')
<script>
  // $(document).ready( function () {

  //     var table = $('#supportTickets').DataTable({
  //         processing: true,
  //         serverSide: true,
  //         responsive: true,
  //         ajax: "{{ route('client.getSupport.tickets') }}",
  //         columns: [
  //             {data: 'id', name: 'id'},
  //             {data: 'subject', name: 'subject'},
  //             {data: 'category', name: 'category'},
  //             {data: 'project', name: 'project'},
  //             {data: 'date', name: 'date'},

  //             {
  //                 data: 'status', 
  //                 name: 'status', 
  //                 orderable: true, 
  //                 searchable: true,
  //             },
              
  //         ],
  //         dom: 'Bfrtip'
  //     });

  // });

</script>
@endsection