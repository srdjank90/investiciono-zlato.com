@extends('backend.layout.backend')

@section('content')
<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('backend')}}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item"><a href="{{route('backend.posts.index')}}">{{ __('Posts') }}</a></li>
            <li class="breadcrumb-item active" aria-current="postCategories">{{ __('Categories') }}</li>
        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-md-12 mb-3">
        <div class="col-md-12 mb-3 d-flex justify-content-between align-items-center">
            <div class="left-page-actions">
                <a class="btn btn-primary" href="{{ route('backend.posts.index')}}"><i class="bi bi-arrow-left-circle"></i> {{ __('Back') }}</a>
            </div>
            <div class="right-page-actions">

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <form action="/backend/posts/categories/store" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">{{__('Name')}}</label>
                <input type="text" name="name" id="name" class="form-control form-control-sm generate-slug" required value="">
                <div id="nameHelp" class="form-text">{{ __('The name is how it appears on your site.')}}</div>
            </div>
            <div class="form-group">
                <label for="slug">{{__('Slug')}}</label>
                <input type="text" name="slug" id="slug" class="form-control form-control-sm slug-generated" required value="">
                <div id="slugHelp" class="form-text">{{ __('The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.')}}</div>
            </div>
            <div class="form-group">
                <label for="parent">{{__('Parent')}}</label>
                <select name="parent" id="parent" class="form-select form-select-sm">
                    <option value="">None</option>
                </select>
                <div id="parentHelp" class="form-text">{{ __('Categories, unlike tags, can have a hierarchy. You might have a Jazz category, and under that have children categories for Bebop and Big Band. Totally optional.')}}</div>
            </div>
            <button role="submit" class="btn btn-primary mt-3"><i class="bi bi-check2-circle"></i> {{ __('Add New Category') }}</button>
        </form>
    </div>
    <div class="col-md-8">
        <!-- Table -->
        <table class="lp-table table">
            <thead>
                <th>#</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Slug') }}</th>
                <th class="text-center" width="100">{{ __('Posts') }}</th>
                <th width="50"></th>
            </thead>
            <tbody>
                @foreach($postCategories as $key => $category)
                <tr id="tr-{{ $category->id }}">
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td class="text-center">{{ $category->posts_count }}</td>
                    <td class="lp-table-actions">
                        @if($category->id != 1)
                        <button role="button" data-model="posts/categories" data-id="{{ $category->id }}" class="btn btn-danger btn-sm rounded-circle item-delete">
                            <i class="bi bi-trash"></i>
                        </button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $postCategories->links() }}
    </div>
</div>

@endsection
