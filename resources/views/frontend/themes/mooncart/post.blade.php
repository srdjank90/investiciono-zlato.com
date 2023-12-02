@extends('frontend.themes.mooncart.layout.layout')
@section('title', isset($setting['setting_seo_title_opt']) ? $setting['setting_seo_title_opt'] : 'MinuteSHOP')
@section('description', isset($setting['setting_seo_description_opt']) ? $setting['setting_seo_description_opt'] : '')
@section('keywords', isset($setting['setting_seo_keywords_opt']) ? $setting['setting_seo_keywords_opt'] : '')
@section('content')
    <div class="page-content">
        <!-- Blog Large -->
        <section class="content-inner-1 bg-img-fix">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-8">
                        <!-- blog start -->
                        <div class="dz-blog blog-single style-1 sidebar">
                            <h1 class="dz-title">{{ $post->title }}</h1>
                            <div class="dz-meta">
                                <ul>
                                    <li class="post-date">{{ $post->created_at }}</li>
                                    <li class="dz-user">
                                        <i class="fa-solid fa-user"></i>
                                        <a href="javascript:void(0);">{{ $post->user->name }}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dz-media">
                                @if ($post->image)
                                    <img src="{{ $storageUrl . $post->image->path }}" alt="/">
                                @endif

                            </div>
                            <div class="dz-info">
                                {!! $post->content !!}
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-8 order-lg-1 order-2">
                        <aside class="side-bar sticky-top mt-lg-0 mt-md-5 mt-3">
                            <div class="widget">
                                <h5 class="widget-title">Pretraga</h5>
                                <div class="search-bx">
                                    <form role="search" method="post">
                                        <div class="input-group">
                                            <input name="text" class="form-control" placeholder="Pretraga"
                                                type="text">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn">
                                                    <i class="icon feather icon-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="widget widget_categories style-1">
                                <h5 class="widget-title">Kategorije</h5>
                                <ul>
                                    @foreach ($categories as $category)
                                        <li class="cat-item">
                                            <a href="{{ route('frontend.category.posts', $category->slug) }}">
                                                {{ $category->name }}
                                            </a>
                                            ({{ $category->posts->count() }})
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
