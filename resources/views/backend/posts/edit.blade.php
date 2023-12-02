@extends('backend.layout.backend')
@section('content')
    <!-- Breadcrumbs -->
    <div class="sk-breadcrumb-wrapper">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend') }}">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.posts.index') }}">{{ __('Posts') }}</a></li>
                <li class="breadcrumb-item active" aria-current="posts">{{ __('Edit Post') }}</li>
            </ol>
        </nav>
    </div>
    <!-- Page Content -->
    <div class="row">
        <div class="sk-page-actions col-md-12">
            <div class="sk-page-actions-left">
                <a class="btn btn-primary" href="{{ route('backend.posts.index') }}"><i class="bi bi-arrow-left-circle"></i>
                    {{ __('Back') }}</a>
            </div>
            <div class="sk-page-actions-right">
                <button type="button" data-id="{{ $post->id }}" data-model="Post"
                    class="btn btn-secondary show-seo-modal">
                    <i class="bi bi-google"></i> {{ __('SEO') }}
                </button>
            </div>
        </div>
        <div class="col-md-12">
            <form class="panel-body" enctype="multipart/form-data" action="/backend/posts/update/{{ $post->id }}"
                method="POST">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-8">
                        <!-- Post Name -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="p-0 m-0">{{ __('Post Title') }}</h6>
                                <small><i
                                        class="bi bi-info-circle-fill text-info me-1"></i>{{ __('Information about post Name and post Slug') }}</small>
                                <div class="form-group">
                                    <label for="title">{{ __('Title') }}</label>
                                    <input type="text" name="title" id="title" class="form-control"
                                        value="{{ $post->title }}">
                                </div>
                                <div class="form-group">
                                    <label for="slug">{{ __('Slug') }}</label>
                                    <input type="text" name="slug" id="slug" class="form-control"
                                        value="{{ $post->slug }}">
                                </div>
                            </div>
                        </div>

                        <!-- Post Content -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="p-0 m-0">{{ __('Post Content') }}</h6>
                                <small><i
                                        class="bi bi-info-circle-fill text-info me-1"></i>{{ __('Content of a post that will be shown on a frontent') }}</small>
                                <div class="form-group">
                                    <label for="content">{{ __('Content') }}</label>
                                    <textarea class="form-control tinymce" name="content" id="content" cols="30" rows="10">{{ $post->content }}</textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <!-- Post Statistic -->
                        <div class="card mb-3 d-none">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <b>{{ __('Visits') }}</b>
                                    <span><i class="bi bi-binoculars text-info"></i> 0</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <b>{{ __('SEO') }}</b>
                                    <span><i class="bi bi-search-heart text-success"></i> 100%</span>
                                </div>
                            </div>
                        </div>
                        <!-- Post Status -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <b>Created:</b>
                                    <span>{{ $post->created_at }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <b>Updated:</b>
                                    <span>{{ $post->updated_at }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <b>Status:</b>
                                    @if ($post->status == 'draft')
                                        <span class="badge bg-warning">{{ __('Draft') }}</span>
                                    @endif
                                    @if ($post->status == 'published')
                                        <span class="badge bg-success">{{ __('Published') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="template">{{ __('Change Status') }}</label>
                                    <select type="text" name="status" id="status" class="form-select"
                                        value="{{ $post->status }}">
                                        <option value="draft" {{ $post->status == 'draft' ? 'selected' : '' }}>
                                            {{ __('Draft') }}</option>
                                        <option value="published" {{ $post->status == 'published' ? 'selected' : '' }}>
                                            {{ __('Published') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center actions my-3">
                            <button role="button" class="btn btn-danger"> <i class="bi bi-trash"></i>
                                {{ __('Delete') }}</button>
                            <button role="submit" class="btn btn-primary"> <i class="bi bi-cassette"></i>
                                {{ __('Update') }}</button>
                        </div>

                        <!-- Post Categories -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="">{{ __('Categories') }}</label>
                                    <select name="categories[]" id="postCategories" multiple class="form-select">
                                        @foreach ($postCategories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ in_array($category->id, $postCategoriesIds) ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Post Image -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="postImage" class="w-100">{{ __('Image') }}</label>
                                    @if ($post->image)
                                        <img width="150" src="{{ $storageUrl }}{{ $post->image->path }}"
                                            alt="">
                                    @endif
                                    <input class="form-control form-control-sm" name="post_image" id="postImage"
                                        type="file">
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
