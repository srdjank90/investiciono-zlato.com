@extends('backend.layout.backend')
@section('content')
    <!-- Breadcrumbs -->
    <div class="sk-breadcrumb-wrapper">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend') }}">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.pages.index') }}">{{ __('Pages') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Add Page') }}</li>
            </ol>
        </nav>
    </div>
    <!-- Page Content -->
    <div class="row">
        <div class="sk-page-actions col-md-12">
            <div class="sk-page-actions-left">
                <a class="btn btn-primary" href="{{ route('backend.pages.index') }}"><i class="bi bi-arrow-left-circle"></i>
                    {{ __('Back') }}</a>
            </div>
            <div class="sk-page-actions-right">
                <button type="button" data-id="{{ $page->id }}" data-model="Page"
                    class="btn btn-secondary show-seo-modal">
                    <i class="bi bi-google"></i> {{ __('SEO') }}
                </button>
            </div>
        </div>
        <div class="col-md-12">
            <form class="panel-body" action="/backend/pages/update/{{ $page->id }}" method="POST">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-8">
                        <!-- Title And Slug -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="p-0 m-0">{{ __('Page Name') }}</h6>
                                <small><i
                                        class="bi bi-info-circle-fill text-info me-1"></i>{{ __('Information about page Name and page Slug') }}</small>
                                <div class="form-group">
                                    <label for="name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ $page->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="slug">{{ __('Slug') }}</label>
                                    <input type="text" name="slug" id="slug" class="form-control"
                                        value="{{ $page->slug }}">
                                </div>
                            </div>
                        </div>

                        <!-- Page Content -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="p-0 m-0">{{ __('Page Content') }}</h6>
                                <small><i
                                        class="bi bi-info-circle-fill text-info me-1"></i>{{ __('Content of a page that will be shown on a frontent') }}</small>
                                <div class="form-group">
                                    <label for="content">{{ __('Content') }}</label>
                                    <textarea class="form-control tinymce" name="content" id="content" cols="30" rows="10">{{ $page->content }}</textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <!-- Page Statistic -->
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
                        <!-- Page Status -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <b>Created:</b>
                                    <span>{{ $page->created_at }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <b>Updated:</b>
                                    <span>{{ $page->updated_at }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <b>Status:</b>
                                    @if ($page->status == 'draft')
                                        <span class="badge bg-warning">{{ __('Draft') }}</span>
                                    @endif
                                    @if ($page->status == 'published')
                                        <span class="badge bg-success">{{ __('Published') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="template">{{ __('Change Status') }}</label>
                                    <select type="text" name="status" id="status" class="form-select"
                                        value="{{ $page->status }}">
                                        <option value="draft" {{ $page->status == 'draft' ? 'selected' : '' }}>
                                            {{ __('Draft') }}</option>
                                        <option value="published" {{ $page->status == 'published' ? 'selected' : '' }}>
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

                        <div class="card">
                            <div class="card-body">
                                <small><i
                                        class="bi bi-info-circle-fill text-info me-1"></i>{{ __('Template for rendering page content') }}</small>
                                <div class="form-group">
                                    <label for="template">{{ __('Template') }}</label>
                                    <select type="text" name="template" id="template" class="form-select"
                                        value="{{ $page->template }}">
                                        <option value="default">{{ __('Default') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
