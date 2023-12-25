@extends('layouts.client')
@section('title')
Payment Error
@endsection
@section('content')
<div class="row mt-4">
    <h4 class="fw-bold py-3"><span class="text-muted fw-light">Payment Error</h4>
    <div class="layout-demo-wrapper">
        <div class="layout-demo-placeholder">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-exclamation-circle text-danger" width="50" height="50" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                <path d="M12 9v4" />
                <path d="M12 16v.01" />
            </svg>
        </div>
        <div class="layout-demo-info">
            <h4>Payment Error</h4>
            <div class=" mt-4" role="alert">
                <a href="{{ route('contact.us') }}" class="btn btn-danger fw-medium">Contact us</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection