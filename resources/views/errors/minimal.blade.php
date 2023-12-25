@extends('layouts.app')

@section('title', 'error')

@section('content')
    
<div class="container-xxl container-p-y text-center mt-5 pt-5">
    <div class="misc-wrapper">
        <div style="width: 150px;
        height: 150px;
        margin: auto;
        margin-bottom: auto;
        background: #EEF;
        display: flex;
        border-radius: 50%;
        align-items: center;
        justify-content: center;
        margin-bottom: 2em;">
        <h1 class="text-primary">@yield('code')</h1>
        </div>
        <h2 class="mb-4 mx-2">@yield('message')</h2>
        <a href="{{ route('home') }}" class="btn btn-primary mb-4 waves-effect waves-light">Back to home</a>
    </div>
</div>

@endsection

