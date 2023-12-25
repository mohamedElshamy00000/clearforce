@extends('layouts.app')

@section('title', 'ClearForce blog')

@section('content')

<section class="section has-mask">
    <div class="nk-mask bg-pattern-dot bg-blend-around mt-n5 mb-10p mh-50vh"></div>
    <div class="container">
        <div class="section-content">
            <div class="row g-gs justify-content-center">
                <div class="col-xxl-8 col-xl-9 col-lg-10">
                    <div class="text-center">
                        <h6 class="overline-title text-primary">{{ $article->user->name }}</h6>
                        <h1 class="title">{{ $article->title }}</h1>
                        <ul class="list list-row gx-2">
                            <li>
                                <div class="sub-text fs-5">{{ $article->created_at->format('D m Y') }}</div>
                            </li>
                        </ul>
                        <div class="my-5">
                            <img class="rounded-4 w-100" src="{{ asset('assets/blog/' . $article->media->file_name) }}" alt="">
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="block-typo">
                            {!! $article->content !!}
                        </div>
                        {{-- <ul class="btn-list gy-3 ps-xl-6 ps-lg-4 ps-3">
                            <li><a class="link-secondary" href="#"><em class="icon fs-3 ni ni-facebook-circle"></em></a></li>
                            <li><a class="link-secondary" href="#"><em class="icon fs-3 ni ni-twitter"></em></a></li>
                            <li><a class="link-secondary" href="#"><em class="icon fs-3 ni ni-linkedin-round"></em></a></li>
                        </ul> --}}
                    </div>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .section-content -->
    </div><!-- .container -->
</section><!-- .section -->

@endsection