@if (session('message'))
    <div class="alert alert-{{session('alert')}} alert-dismissible mt-2" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (Session::has('import_errors'))
    @foreach (Session::get('import_errors') as $failure)
    <div class="alert alert-danger alert-dismissible" role="alert">
        {{ $failure->errors()[0] }} at line {{ $failure->row() }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endforeach                   
@endif
