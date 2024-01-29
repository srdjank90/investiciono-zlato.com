@extends('frontend.themes.gold.layout.layout')
@section('title', 'Blog | Poredjenje cena investicionog zlata u realnom vremenu')
@section('description', '')
@section('keywords', '')
@section('image', 'themes/gold/assets/images/demo/demo-3.webp')
@section('content')
    <div class="page-content">
        <!--banner-->
        <div class="dz-bnr-inr style-1" style="background-image:url(images/background/bg-shape.jpg);">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1>Blog</h1>
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}"> Home</a></li>
                            <li class="breadcrumb-item">Blog</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <section class="content-inner-1 z-index-unset">
            <div class="container">
                <div class="row">
                    @foreach ($posts as $post)
                        <div class="col-lg-6 col-md-6 col-sm-6 m-lg-b30 m-b50 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="dz-card blog-half style-5">
                                <div class="dz-media">
                                    @if ($post->image)
                                        <img src="{{ $storageUrl . $post->image->path }}" alt="/">
                                    @endif
                                </div>
                                <div class="dz-info">
                                    <div class="dz-meta">
                                        <ul>
                                            <li class="post-date">{{ $post->created_at }}</li>
                                        </ul>
                                    </div>
                                    <h4 class="dz-title">
                                        <a href="{{ route('frontend.post', $post->slug) }}">{{ $post->title }}</a>
                                    </h4>
                                    <a href="{{ route('frontend.post', $post->slug) }}" class="font-14 read-btn">Detaljnije
                                        <i class="icon feather icon-chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {!! $posts->links() !!}
                </div>
            </div>
        </section>

    </div>
@endsection
