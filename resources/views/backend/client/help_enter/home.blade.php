@extends('layouts.client')

@section('title')
    Help Center
@endsection

@section('content')

  <div class="faq-header d-flex flex-column justify-content-center align-items-center rounded">
    <h3 class="text-center">{{ __('general.Hello, how can we help?') }}</h3>
    <p class="text-center mb-0 px-3">{{ __('general.choose a category to') }}</p>
  </div>

  <div class="row mt-4">
    <!-- Navigation -->
    <div class="col-lg-3 col-md-4 col-12 mb-md-0 mb-3">
      <div class="d-flex justify-content-between flex-column mb-2 mb-md-0">
        <ul class="nav nav-align-left nav-pills flex-column">
          <li class="nav-item mb-2">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#Tickets">
              <i class="ti ti-ticket me-1 ti-sm"></i>
              <span class="align-middle fw-semibold"> {{ __('general.Support Tickets') }}</span>
            </button>
          </li>
          @foreach ($qCategory as $category)
          <li class="nav-item mb-2">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#category{{ $category->id }}">
              <i class="ti ti-box me-1 ti-sm"></i>
              <span class="align-middle fw-semibold">{{ $category->name }}</span>
            </button>
          </li>
          @endforeach
          
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
                <span class="align-middle">{{ __('general.My Support Tickets') }}</span>
              </h4>
              <small>{{ __('general.tickets') }}</small>
            </div>
          </div>
          <div class="card shadow-xs">
              <!-- Column Search -->
              <table class="table yajra-datatable" id="supportTickets">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>{{ __('general.supject') }}</th>
                          <th>{{ __('general.category') }}</th>
                          <th>{{ __('general.project') }}</th>
                          <th>{{ __('general.date') }}</th>
                          <th>{{ __('general.status') }}</th>
                      </tr>
                  </thead>
                  <tbody>
                  </tbody>
              </table>
              <!--/ Column Search -->
          </div>
        </div>

        @foreach ($qCategory as $category)
        <div class="tab-pane fade" id="category{{ $category->id }}" role="tabpanel">
          <div class="d-flex mb-3 gap-3">
            <div>
              <span class="badge bg-label-primary rounded-2 p-2">
                <i class="ti ti-box ti-lg"></i>
              </span>
            </div>
            <div>
              <h4 class="mb-0">
                <span class="align-middle">{{ $category->name }}</span>
              </h4>
            </div>
          </div>
          @foreach ($category->questions as $question)
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
                    {{ $question->question }}
                  </button>
                </h2>

                <div id="accordionDelivery-1" class="accordion-collapse collapse show">
                  <div class="accordion-body">
                    {!! $question->description !!}
                  </div>
                </div>
              </div>

            </div>
          @endforeach
        </div>
        @endforeach
        
      </div>
    </div>
    <!-- /FAQ's -->
</div>

@endsection

@section('script')
<script>
  $(document).ready( function () {

      var table = $('#supportTickets').DataTable({
          processing: true,
          serverSide: true,
          responsive: true,
          ajax: "{{ route('client.getSupport.tickets') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'subject', name: 'subject'},
              {data: 'category', name: 'category'},
              {data: 'project', name: 'project'},
              {data: 'date', name: 'date'},

              {
                  data: 'status', 
                  name: 'status', 
                  orderable: true, 
                  searchable: true,
              },
              
          ],
          dom: 'Bfrtip'
      });

  });

</script>
@endsection