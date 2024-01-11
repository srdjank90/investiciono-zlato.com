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
                    <i class="bi bi-plus-circle"></i>
                </button>
                <form class="ms-3" action="/backend/products" method="GET">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="search" value="{{ $search }}" id="search"
                            placeholder="🔍 {{ __('Search') }}">
                    </div>
                </form>
                <div class="ms-5 d-flex flex-row">
                    <form class="me-2" action="/backend/products" method="GET">
                        <input type="hidden" name="cat" value="1g">
                        @if ($cat == '1g')
                            <button class="btn btn-primary">1g</button>
                        @else
                            <button class="btn btn-secondary">1g</button>
                        @endif
                        @csrf
                    </form>
                    <form class="me-2" action="/backend/products" method="GET">
                        <input type="hidden" name="cat" value="2g">
                        @if ($cat == '2g')
                            <button class="btn btn-primary">2g</button>
                        @else
                            <button class="btn btn-secondary">2g</button>
                        @endif
                        @csrf
                    </form>
                    <form class="me-2 d-none" action="/backend/products" method="GET">
                        <input type="hidden" name="cat" value="2.5g">
                        @if ($cat == '2.5g')
                            <button class="btn btn-primary">2.5g</button>
                        @else
                            <button class="btn btn-secondary">2.5g</button>
                        @endif
                        @csrf
                    </form>
                    <form class="me-2" action="/backend/products" method="GET">
                        <input type="hidden" name="cat" value="5g">
                        @if ($cat == '5g')
                            <button class="btn btn-primary">5g</button>
                        @else
                            <button class="btn btn-secondary">5g</button>
                        @endif
                        @csrf
                    </form>
                    <form class="me-2" action="/backend/products" method="GET">
                        <input type="hidden" name="cat" value="10g">
                        @if ($cat == '10g')
                            <button class="btn btn-primary">10g</button>
                        @else
                            <button class="btn btn-secondary">10g</button>
                        @endif
                        @csrf
                    </form>
                    <form class="me-2" action="/backend/products" method="GET">
                        <input type="hidden" name="cat" value="20g">
                        @if ($cat == '20g')
                            <button class="btn btn-primary">20g</button>
                        @else
                            <button class="btn btn-secondary">20g</button>
                        @endif
                        @csrf
                    </form>
                    <form class="me-2" action="/backend/products" method="GET">
                        <input type="hidden" name="cat" value="1unca">
                        @if ($cat == '1unca')
                            <button class="btn btn-primary">1unca</button>
                        @else
                            <button class="btn btn-secondary">1unca</button>
                        @endif
                        @csrf
                    </form>
                    <form class="me-2" action="/backend/products" method="GET">
                        <input type="hidden" name="cat" value="50g">
                        @if ($cat == '50g')
                            <button class="btn btn-primary">50g</button>
                        @else
                            <button class="btn btn-secondary">50g</button>
                        @endif
                        @csrf
                    </form>
                    <form class="me-2" action="/backend/products" method="GET">
                        <input type="hidden" name="cat" value="100g">
                        @if ($cat == '100g')
                            <button class="btn btn-primary">100g</button>
                        @else
                            <button class="btn btn-secondary">100g</button>
                        @endif
                        @csrf
                    </form>
                    <form class="me-2 d-none" action="/backend/products" method="GET">
                        <input type="hidden" name="cat" value="250g">
                        @if ($cat == '250g')
                            <button class="btn btn-primary">250g</button>
                        @else
                            <button class="btn btn-secondary">250g</button>
                        @endif
                        @csrf
                    </form>
                    <form class="me-2" action="/backend/products" method="GET">
                        <input type="hidden" name="cat" value="500g">
                        @if ($cat == '500g')
                            <button class="btn btn-primary">500g</button>
                        @else
                            <button class="btn btn-secondary">500g</button>
                        @endif
                        @csrf
                    </form>
                    <form class="me-2" action="/backend/products" method="GET">
                        <input type="hidden" name="cat" value="1000g">
                        @if ($cat == '1000g')
                            <button class="btn btn-primary">1000g</button>
                        @else
                            <button class="btn btn-secondary">1000g</button>
                        @endif
                        @csrf
                    </form>
                    <form class="me-2" action="/backend/products" method="GET">
                        <input type="hidden" name="cat" value="Dukati">
                        @if ($cat == 'Dukati')
                            <button class="btn btn-primary">Dukati</button>
                        @else
                            <button class="btn btn-secondary">Dukati</button>
                        @endif
                        @csrf
                    </form>
                    <form class="me-2" action="/backend/products" method="GET">
                        <input type="hidden" name="cat" value="Nedefinisano">
                        @if ($cat == 'Nedefinisano')
                            <button class="btn btn-primary">Nedefinisano</button>
                        @else
                            <button class="btn btn-secondary">Nedefinisano</button>
                        @endif
                        @csrf
                    </form>
                    <form class="me-2" action="/backend/products" method="GET">
                        <input type="hidden" name="cat" value="">
                        @if ($cat == '')
                            <button class="btn btn-primary">Sve</button>
                        @else
                            <button class="btn btn-secondary">Sve</button>
                        @endif
                        @csrf
                    </form>
                </div>
            </div>
            <div class="sk-page-actions-right">
                <div class="me-2" style="float: left">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ __('Exports') }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="{{ route('backend.products.prices.export') }}"><i
                                        class="bi bi-cloud-download"></i> {{ __('Export Price Changes') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('backend.products.export', $cat) }}"> <i
                                        class="bi bi-cloud-download"></i> {{ __('Export Products List') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('backend.product.prices.files.download.zip') }}">
                                    <i class="bi bi-file-earmark-zip"></i> {{ __('Download Todays Zip') }}</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{ route('backend.products.prices.exports') }}">{{ __('Exports') }}</a></li>
                        </ul>
                    </div>
                </div>


                <a class="btn btn-primary d-none" href="{{ route('backend.products.actions.index') }}">
                    <i class="bi bi-piggy-bank"></i> {{ __('Actions') }}
                </a>
                <a class="btn btn-primary" href="{{ route('backend.products.categories.index') }}">
                    <i class="bi bi-folder"></i> {{ __('Categories') }}</a>
                <a class="btn btn-secondary" href="{{ route('backend.products.settings') }}"><i
                        class="bi bi-gear"></i></a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="sk-table-wrapper">
                @if (count($products) > 0)
                    <table class="lp-table table table-hover">
                        <thead>
                            <th>#</th>
                            <th>Key</th>
                            <th>{{ __('name') }}</th>
                            <th>{{ __('Type') }}</th>
                            @foreach ($productMetas as $key => $meta)
                                @if ($meta['displayInTable'] == 'true')
                                    <th class="">{{ $meta['name'] }}</th>
                                @endif
                            @endforeach
                            <th>{{ __('Categories') }}</th>
                            <th>{{ __('Company') }}</th>
                            <th>{{ __('Selling Price') }}</th>
                            <th>{{ __('Purchase Price') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th width="160"></th>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $product)
                                <tr id="tr-{{ $product->id }}">
                                    <td>{{ $product->id }}</td>
                                    <td><span title="{{ $product->name_default }}">{{ $product->unique_key }}</span>
                                    </td>
                                    <td>{{ $product->name }} <a target="_blank" href="{{ $product->url }}">link</a></td>
                                    <td>{{ $product->quantity_type }}</td>
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
                                    <td>{{ $product->company->name }}</td>
                                    <td>
                                        @if ($product->selling_price)
                                            <div><b>💰 @priceFormat($product->selling_price)</b> {{ $currency }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($product->purchase_price)
                                            <div><b>💰 @priceFormat($product->purchase_price)</b> {{ $currency }}</div>
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
                                                title="Publishing on {{ $product->published_at }}"
                                                style="font-size: 12px" class="bi bi-alarm cursor-pointer"></i>
                                        @endif
                                    </td>

                                    <td class="lp-table-actions">
                                        <a href="{{ route('backend.products.edit.prices', $product->id) }}"
                                            type="button" class="btn btn-secondary btn-sm rounded-circle"
                                            title="Cene proizvoda">
                                            <i class="bi bi-currency-dollar"></i>
                                        </a>
                                        <a target="_blank" class="btn btn-info btn-sm rounded-circle" target="_blank"
                                            href="{{ $product->url }}">
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
                    {{ $products->withQueryString()->links() }}
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
