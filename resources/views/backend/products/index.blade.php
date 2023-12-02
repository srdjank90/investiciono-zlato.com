@extends('backend.layout.backend')
@section('content')
    <!-- Breadcrumbs -->
    <div class="sk-breadcrumb-wrapper">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend') }}">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item active" aria-current="products">{{ __('Products') }}</li>
            </ol>
        </nav>
    </div>
    <!-- Page Content -->
    <div class="row">
        <div class="sk-page-actions col-md-12">
            <div class="sk-page-actions-left">
                <button data-bs-toggle="modal" data-bs-target="#createModal" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> {{ __('Add Prouct') }}
                </button>
                <form class="ms-3" action="/backend/products" method="GET">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="search" value="{{ $search }}" id="search"
                            placeholder="🔍 {{ __('Search') }}">
                    </div>
                </form>
            </div>
            <div class="sk-page-actions-right">
                <a class="btn btn-primary" href="{{ route('backend.products.actions.index') }}">
                    <i class="bi bi-piggy-bank"></i> {{ __('Actions') }}
                </a>
                <a class="btn btn-primary" href="{{ route('backend.products.categories.index') }}">
                    <i class="bi bi-folder"></i> {{ __('Categories') }}</a>
                <a class="btn btn-secondary" href="{{ route('backend.products.settings') }}"><i class="bi bi-gear"></i></a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="sk-table-wrapper">
                @if (count($products) > 0)
                    <table class="lp-table table table-hover">
                        <thead>
                            <th>#</th>
                            <th>{{ __('name') }}</th>
                            @foreach ($productMetas as $key => $meta)
                                @if ($meta['displayInTable'] == 'true')
                                    <th class="">{{ $meta['name'] }}</th>
                                @endif
                            @endforeach
                            <th>{{ __('Categories') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th width="120"></th>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $product)
                                <tr id="tr-{{ $product->id }}">
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    @foreach ($productMetas as $key => $meta)
                                        @if ($meta['displayInTable'] == 'true')
                                            <td>
                                                @foreach ($product->meta as $key => $productMeta)
                                                    @if ($productMeta->type == $meta['name'])
                                                        <span class="badge bg-secondary">{{ $productMeta->name }}</span>
                                                    @endif
                                                @endforeach
                                            </td>
                                        @endif
                                    @endforeach

                                    <td>
                                        @foreach ($product->categories as $key => $category)
                                            <span class="badge bg-primary text-light">{{ $category->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <div><b>💰 @priceFormat($product->price)</b> {{ $currency }}</div>
                                        @if ($product->price_old && $product->price_old != '' && $product->price_old != 0)
                                            <div style="font-size: 10px;padding-left:45px">
                                                <b class="text-decoration-line-through">💰
                                                    @priceFormat($product->price_old)</b> {{ $currency }}
                                            </div>
                                        @endif

                                    </td>
                                    <td>
                                        @if ($product->status == 'draft' || $product->status == 'auto-draft')
                                            <span class="badge bg-warning text-light">{{ $product->status }}</span>
                                        @endif
                                        @if ($product->status == 'published')
                                            <span class="badge bg-success text-light">
                                                {{ $product->status }} </span>
                                        @endif
                                        @if ($product->status == 'future')
                                            <span class="badge bg-info text-light">
                                                {{ $product->status }}</span>
                                            <i data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Publishing on {{ $product->published_at }}" style="font-size: 12px"
                                                class="bi bi-alarm cursor-pointer"></i>
                                        @endif
                                    </td>

                                    <td class="lp-table-actions">
                                        <a target="_blank" class="btn btn-info btn-sm rounded-circle"
                                            href="{{ route('frontend.product', $product->slug) }}">
                                            <i class="bi bi-globe"></i>
                                        </a>
                                        <a class="btn btn-primary btn-sm rounded-circle"
                                            href="/backend/products/edit/{{ $product->id }}">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <button role="button" data-model="products" data-id="{{ $product->id }}"
                                            class="btn btn-danger btn-sm rounded-circle item-delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $products->links() }}
                @else
                    <div class="sk-table-empty">
                        @if ($search != '')
                            {{ __('There is no products for search:') }} <b
                                class="ms-2 text-warning">{{ $search }}</b>
                        @else
                            {{ __('There is no products in database, you can create it') }} <a data-bs-toggle="modal"
                                data-bs-target="#createModal" role="button"> <span
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
                        <h5 class="modal-title">{{ __('Add Product') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group mb-2">
                            <label for="productName">Product name</label>
                            <input type="text" name="name" id="productName" required class="form-control"
                                placeholder="Enter your product name">
                        </div>
                        <i
                            class="fas fa-info-circle text-info me-2"></i>{{ __('On next page you will add product details') }}
                        <div class="mt-3 text-end">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                            <button type="button" class="btn btn-primary"
                                onclick="productCreate()">{{ __('Create') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // Create product
        function productCreate() {
            let createForm = $('#createForm');
            let name = $('#productName').val();
            $.ajax({
                url: "{{ route('backend.products.store') }}",
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
