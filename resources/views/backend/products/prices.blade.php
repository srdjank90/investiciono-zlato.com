@extends('backend.layout.backend')
@section('content')
    <!-- Breadcrumbs -->
    <div class="sk-breadcrumb-wrapper">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend') }}">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.products.index') }}">{{ __('Products') }}</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('backend.products.edit', $product->id) }}">{{ $product->name }}</a></li>
                <li class="breadcrumb-item active" aria-current="products">{{ __('Prices') }}</li>
            </ol>
        </nav>
    </div>
    <!-- Page Content -->
    <div class="row">
        <div class="sk-page-actions col-md-12">
            <div class="sk-page-actions-left">
                <a class="btn btn-primary" href="{{ route('backend.products.edit', $product->id) }}"><i
                        class="bi bi-arrow-left-circle"></i> {{ __('Back') }}</a>
            </div>
            <div class="sk-page-actions-right">
                <a class="btn btn-success" href="{{ route('backend.products.edit.prices.export', $product->id) }}">
                    <i class="bi bi-cloud-download"></i> {{ __('Export') }}
                </a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="sk-table-wrapper">
                <h3>{{ $product->name }}</h3>
                @if (count($prices) > 0)
                    <table class="lp-table table table-hover">
                        <thead>
                            <th>{{ __('Selling Price') }}</th>
                            <th>{{ __('Purchase Price') }}</th>
                            <th>{{ __('Date') }}</th>
                        </thead>
                        <tbody>
                            @foreach ($prices as $key => $price)
                                <tr id="tr-{{ $price->id }}">
                                    <td>
                                        @php
                                            $percentageChange = 0;
                                            if (isset($prices[$key + 1]) && $price->selling_price != 0 && $prices[$key + 1]['selling_price'] != 0) {
                                                $percentageChange = (($price->selling_price - $prices[$key + 1]['selling_price']) / abs($prices[$key + 1]['selling_price'])) * 100;
                                            }
                                        @endphp
                                        @if ($price->selling_price)
                                            <div class="d-flex justify-center align-items-center">
                                                <b>💰 @priceFormat($price->selling_price)</b> {{ $currency }}
                                                @if ($percentageChange > 0)
                                                    <span
                                                        class="badge-price-changes badge bg-success text-white ms-2">{{ number_format($percentageChange, 2) }}%
                                                    </span>
                                                @elseif ($percentageChange < 0)
                                                    <span
                                                        class="badge-price-changes badge bg-danger text-white ms-2">{{ number_format($percentageChange, 2) }}%
                                                    </span>
                                                @else
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $percentageChange = 0;
                                            if (isset($prices[$key + 1]) && $price->purchase_price != 0 && $prices[$key + 1]['purchase_price'] != 0) {
                                                $percentageChange = (($price->purchase_price - $prices[$key + 1]['purchase_price']) / abs($prices[$key + 1]['purchase_price'])) * 100;
                                            }
                                        @endphp
                                        @if ($price->purchase_price)
                                            <div class="d-flex justify-center align-items-center">
                                                <b>💰 @priceFormat($price->purchase_price)</b> {{ $currency }}
                                                @if ($percentageChange > 0)
                                                    <span
                                                        class="badge-price-changes badge bg-success text-white ms-2">{{ number_format($percentageChange, 2) }}%
                                                    </span>
                                                @elseif ($percentageChange < 0)
                                                    <span
                                                        class="badge-price-changes badge bg-danger text-white ms-2">{{ number_format($percentageChange, 2) }}%
                                                    </span>
                                                @else
                                                @endif
                                            </div>
                                        @endif

                                    </td>
                                    <td>{{ $price->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $prices->withQueryString()->links() }}
                @else
                    <div class="sk-table-empty">
                        {{ __('There is no prices in database for this product') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script></script>
@endsection
