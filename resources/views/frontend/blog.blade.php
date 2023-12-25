@extends('layouts.app')

@section('title', 'ClearForce blog')

@section('content')

<section class="section section-bottom-0 has-shape has-mask">
    <div class="nk-shape bg-shape-blur-m mt-8 start-50 top-0 translate-middle-x"></div>
    <div class="nk-shape bg-shape-blur-m mt-8 start-50 top-50 translate-middle-x"></div>
    <div class="nk-mask bg-pattern-dot bg-blend-around mt-n5 mb-10p mh-50vh"></div>
    <div class="container">
        <div class="section-head">
            <div class="row justify-content-center text-center">
                <div class="col-lg-9 col-xl-7 col-xxl-6">
                    <h6 class="overline-title text-primary">{{ __('general.Blog') }}</h6>
                    <h1 class="title">{{ __('general.blog_title') }}</h1>
                    {{-- <label id="blog-search" class="d-flex align-items-center border rounded-3 py-2 px-4 mt-5 mt-lg-7 bg-white">
                        <em class="icon me-3 fs-3 ni ni-search"></em>
                        <input type="text" name="blog-search" class="form-control form-control-lg form-control-plaintext" placeholder="Search for articles" required>
                    </label> --}}
                </div>
            </div>
        </div><!-- .section-head -->
        <div class="section-content">
            <div class="row g-gs">
                @foreach ($articles as $article)
                <div class="col-md-6 col-xl-4">
                    <div class="card border-0 shadow-tiny rounded-4">
                        <div class="card-body p-4">
                            @if ($article->media)
                            <a class="d-block" href="{{ route('blog.single', $article->slug) }}"><img loading="lazy" class="rounded-4 w-100" src="{{ asset('assets/blog/' . $article->media->file_name) }}" alt=""></a>                                
                            @endif
                            <a href="#" class="badge px-3 py-2 mt-4 mb-3 text-bg-primary-soft fw-normal rounded-pill">{{ $article->user->name }}</a>
                            <h3><a href="{{ route('blog.single', $article->slug) }}" class="link-dark line-clamp-2">{{ $article->title }}</a></h3>
                            <div class="d-flex pt-4">
                                <div class="media-info me-3">
                                    <ul class="list list-row gx-1">
                                        <li>
                                            <div class="sub-text">{{ $article->created_at->format('D m Y') }}</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card -->
                </div><!-- .col -->
                @endforeach
                
            </div><!-- .row -->
        </div><!-- .section-content -->
        <div class="section-actions text-center">
            {{ $articles->links('vendor.pagination.bootstrap-4') }}
        </div><!-- .section-actions -->
    </div><!-- .container -->
</section><!-- .section -->

@endsection