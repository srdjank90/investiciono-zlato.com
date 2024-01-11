@extends('frontend.themes.gold.layout.layout')
@section('title', $post->title)
@section('description', '')
@section('keywords', '')
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
                                        <a class="d-none" href="javascript:void(0);">{{ $post->user->name }}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dz-media">
                                @if ($post->image)
                                    <img src="{{ $storageUrl . $post->image->path }}" alt="/">
                                @endif

                            </div>

                            <div id="toc-content" class="dz-info">
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
                            <div class="widget style-1">
                                <h5>Sadržaj</h5>
                                {!! $post->toc !!}
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

@section('scripts')
    <script>
        $(document).ready(function() {
            // Assuming you have an HTML string or element containing headings
            var htmlContent = document.getElementById('toc-content').innerHTML;


            // Create a temporary div to hold the HTML content
            var tempDiv = document.createElement('div');
            tempDiv.innerHTML = htmlContent

            // Get all heading elements (h1, h2, h3, etc.)
            var headingElements = tempDiv.querySelectorAll('h1, h2, h3, h4, h5, h6');

            // Use forEach loop to add id attribute to each heading
            headingElements.forEach(function(heading, index) {
                heading.id = 'section' + (index + 1); // You can customize the id as needed
            });

            document.getElementById('toc-content').innerHTML = tempDiv.innerHTML
        });
    </script>
@endsection
