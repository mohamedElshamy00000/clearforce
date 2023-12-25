@extends('layouts.client')
@section('title')
Payment Success
@endsection
@section('content')
<div class="row mt-4">
    <h4 class="fw-bold py-3"><span class="text-muted fw-light">Payment Success</h4>
    <div class="layout-demo-wrapper">
        <div class="layout-demo-placeholder">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-rounded-check text-success" width="100" height="100" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M9 12l2 2l4 -4"></path>
                <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z"></path>
            </svg>
        </div>
        <div class="layout-demo-info">
            <h4>Payment Success</h4>
            <div class="alert alert-success mt-4" role="alert">
                <a href="{{ route('single.project', $myproject->uuid) }}" class="text-dark fw-medium">Go to My Project</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection