@extends('backend.layout.backend')
@section('content')
    <!-- Breadcrumbs -->
    <div class="sk-breadcrumb-wrapper">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend') }}">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Pages') }}</li>
            </ol>
        </nav>
    </div>
    <!-- Page Content -->
    <div class="row">
        <div class="sk-page-actions col-md-12">
            <div class="sk-page-actions-left">
                <button data-bs-toggle="modal" data-bs-target="#createModal" class="btn btn-primary"><i
                        class="bi bi-plus-circle"></i> {{ __('Add Page') }}</button>
                <form class="ms-3" action="/backend/pages" method="GET">
                    <div class="form-group">
                        <input type="text" class="form-control" name="search" value="{{ $search }}" id="search"
                            placeholder="🔍 {{ __('Search') }}">
                    </div>
                </form>
            </div>
            <div class="sk-page-actions-right">
                <a class="btn btn-secondary" href="{{ route('backend.pages.settings') }}"><i class="bi bi-gear"></i></a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="sk-table-wrapper">
                @if (count($pages) > 0)
                    <table class="sk-table table">
                        <thead>
                            <th>#</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Slug') }}</th>
                            <th>{{ __('Created By') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th width="170">{{ __('Date') }}</th>
                            <th width="120"></th>
                        </thead>
                        <tbody>
                            @foreach ($pages as $key => $page)
                                <tr id="tr-{{ $page->id }}">
                                    <td>{{ $page->id }}</td>
                                    <td>{{ $page->name }}</td>
                                    <td>{{ $page->slug }}</td>
                                    <td>{{ $page->user->name }}</td>
                                    <td>
                                        @if ($page->status == 'draft' || $page->status == 'auto-draft')
                                            <span class="badge bg-warning text-light">{{ $page->status }}</span>
                                        @endif
                                        @if ($page->status == 'published')
                                            <span class="badge bg-success text-light"> {{ $page->status }}
                                            </span>
                                        @endif
                                        @if ($page->status == 'future')
                                            <span class="badge bg-info text-light">
                                                {{ $page->status }}</span>
                                            <i data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Publishing on {{ $page->published_at }}" style="font-size: 12px"
                                                class="bi bi-alarm cursor-pointer"></i>
                                        @endif
                                    </td>
                                    <td>{{ $page->created_at }}</td>
                                    <td class="lp-table-actions">
                                        <a target="_blank" class="btn btn-info btn-sm rounded-circle"
                                            href="{{ route('frontend.page', $page->slug) }}">
                                            <i class="bi bi-globe"></i>
                                        </a>
                                        <a class="btn btn-primary btn-sm rounded-circle"
                                            href="/backend/pages/edit/{{ $page->id }}">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <button role="button" data-model="pages" data-id="{{ $page->id }}"
                                            class="btn btn-danger btn-sm rounded-circle item-delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $pages->links() }}
                @else
                    <div class="sk-table-empty">
                        @if ($search != '')
                            {{ __('There is no pages for search:') }} <b class="ms-2 text-warning">{{ $search }}</b>
                        @else
                            {{ __('There is no pages in database, you can create it') }} <a role="button"
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
                        <h5 class="modal-title">{{ __('Add Page') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group mb-2">
                            <label for="pageName">Page name</label>
                            <input type="text" name="name" id="pageName" class="form-control"
                                placeholder="Enter your page name">
                        </div>
                        <i class="fas fa-info-circle text-info me-2"></i>{{ __('On next page you will add page details') }}
                        <div class="mt-3 text-end">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                            <button type="button" class="btn btn-primary"
                                onclick="pageCreate()">{{ __('Create') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Create page
        function pageCreate() {
            let createForm = $('#createForm');
            let name = $('#pageName').val();
            $.ajax({
                url: "{{ route('backend.pages.store') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    name: name,
                },
                success: function(response) {
                    window.location.replace(response.url);
                },
                error: function(response) {
                    console.log(response)
                    $('#nameErrorMsg').text(response.responseJSON.errors.name);
                },
            });
        }
    </script>
@endsection
