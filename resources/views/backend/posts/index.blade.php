@extends('backend.layout.backend')
@section('content')
    <!-- Breadcrumbs -->
    <div class="sk-breadcrumb-wrapper">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend') }}">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.products.index') }}">{{ __('Products') }}</a></li>
                <li class="breadcrumb-item active" aria-current="productCategories">{{ __('Categories') }}</li>
            </ol>
        </nav>
    </div>
    <!-- Page Content -->
    <div class="row">
        <div class="sk-page-actions col-md-12">
            <div class="sk-page-actions-left">
                <button data-bs-toggle="modal" data-bs-target="#createModal" class="btn btn-primary"><i
                        class="bi bi-plus-circle"></i> Add Post</button>
                <form class="ms-3" action="/backend/posts" method="GET">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="search" value="{{ $search }}" id="search"
                            placeholder="🔍 {{ __('Search') }}">
                    </div>
                </form>
            </div>
            <div class="sk-page-actions-right">
                <a class="btn btn-primary" href="{{ route('backend.posts.categories.index') }}"><i class="bi bi-folder"></i>
                    Categories</a>
                <a class="btn btn-secondary" href="{{ route('backend.posts.settings') }}"><i class="bi bi-gear"></i></a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="sk-table-wrapper">
                @if (count($posts) > 0)
                    <table class="lp-table table">
                        <thead>
                            <th>#</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Categories') }}</th>
                            <th>{{ __('Created By') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Date') }}</th>
                            <th width="120"></th>
                        </thead>
                        <tbody>
                            @foreach ($posts as $key => $post)
                                <tr id="tr-{{ $post->id }}">
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>
                                        @foreach ($post->categories as $key => $category)
                                            <span class="badge bg-primary text-light">{{ $category->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>
                                        @if ($post->status == 'draft' || $post->status == 'auto-draft')
                                            <span class="badge bg-warning text-light">{{ $post->status }}</span>
                                        @endif
                                        @if ($post->status == 'published')
                                            <span class="badge bg-success text-light"> {{ $post->status }}
                                            </span>
                                        @endif
                                        @if ($post->status == 'future')
                                            <span class="badge bg-info text-light">
                                                {{ $post->status }}</span>
                                            <i data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Publishing on {{ $post->published_at }}" style="font-size: 12px"
                                                class="bi bi-alarm cursor-pointer"></i>
                                        @endif
                                    </td>
                                    <td>{{ $post->created_at }}</td>
                                    <td class="lp-table-actions">
                                        <a target="_blank" class="btn btn-info btn-sm rounded-circle"
                                            href="{{ route('frontend.post', $post->slug) }}">
                                            <i class="bi bi-globe"></i>
                                        </a>
                                        <a class="btn btn-primary btn-sm rounded-circle"
                                            href="/backend/posts/edit/{{ $post->id }}">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <button role="button" data-model="posts" data-id="{{ $post->id }}"
                                            class="btn btn-danger btn-sm rounded-circle item-delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $posts->links() }}
                @else
                    <div class="sk-table-empty">
                        @if ($search != '')
                            {{ __('There is no posts for search:') }} <b class="ms-2 text-warning">{{ $search }}</b>
                        @else
                            {{ __('There is no posts in database, you can create it') }} <a role="button"
                                data-bs-toggle="modal" data-bs-target="#createModal"> <span
                                    class="ms-2">{{ __('here') }}</span> </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Create modal -->
    <div class="modal modal-alert fade" id="createModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" id="createForm" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Add Post') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group mb-2">
                            <label for="postTitle">{{ __('Post Title') }}</label>
                            <input type="text" name="title" id="postTitle" class="form-control"
                                placeholder="Enter your post title">
                        </div>
                        <i class="fas fa-info-circle text-info me-2"></i>{{ __('On next page you will add post details') }}
                        <div class="mt-3 text-end">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                            <button type="button" class="btn btn-primary"
                                onclick="postCreate()">{{ __('Create') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Create post
        function postCreate() {
            let createForm = $('#createForm');
            let title = $('#postTitle').val();
            $.ajax({
                url: "{{ route('backend.posts.store') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    title: title,
                },
                success: function(response) {
                    window.location.replace(response.url);
                },
                error: function(response) {
                    $('#nameErrorMsg').text(response.responseJSON.errors.name);
                },
            });
        }
    </script>
@endsection
