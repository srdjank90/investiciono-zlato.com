@extends('backend.layout.backend')
@section('content')
    <!-- Breadcrumbs -->
    <div class="sk-breadcrumb-wrapper">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend') }}">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item active" aria-current="orders">{{ __('Orders') }}</li>
            </ol>
        </nav>
    </div>
    <!-- Page Content -->
    <div class="row">
        <div class="sk-page-actions col-md-12">
            <div class="sk-page-actions-left">
                <form class="ms-0" action="/backend/orders" method="GET">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="search" value="{{ $search }}" id="search"
                            placeholder="🔍 {{ __('Search') }}">
                    </div>
                </form>
            </div>
            <div class="sk-page-actions-right">
                <a class="btn btn-secondary" href="{{ route('backend.orders.settings') }}"><i class="bi bi-gear"></i></a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="sk-table-wrapper">
                @if (count($orders) > 0)
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center" width="50">#</th>
                                <th>{{ __('Customer') }}</th>
                                <th>{{ __('Address') }}</th>
                                <th>{{ __('Products') }}</th>
                                <th width="120" class="text-center">{{ __('Total') }}</th>
                                <th width="95" class="text-center">{{ __('Status') }}</th>
                                <th width="125" class="text-center">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $order)
                                <tr>
                                    <!-- Number -->
                                    <th class="text-center align-middle" scope="row"> <span>{{ $order->oid }}</span>
                                    </th>
                                    <!-- Customer -->
                                    <td class="align-middle">
                                        <a class="fw-600 text-black text-decoration-none" href="#">
                                            <div class="order-customer-column">
                                                <div class="order-customer-name p-0 m-0" style="font-size: 1.2rem">
                                                    {{ $order->company }}
                                                </div>
                                                <div class="order-customer-contact">
                                                    <div class="email">{{ $order->first_name }}
                                                        {{ $order->last_name }}</div>
                                                    <div class="email"><i class="bi bi-at"></i> {{ $order->email }}</div>
                                                    <div class="phone"><i class="bi bi-phone"></i> {{ $order->phone }}
                                                    </div>

                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                    <!-- Address -->
                                    <td class="align-middle">
                                        <div class="order-address-column">
                                            <div class="address">
                                                <i class="bi bi-mailbox2 text-primary"></i> {{ $order->company_address }}
                                            </div>
                                            <div class="city d-none">
                                                <i class="bi bi-house-check-fill text-primary"></i> {{ $order->zip }}
                                                {{ $order->city }}
                                            </div>
                                            <div class="city">
                                                <i class="bi bi-globe-europe-africa text-primary"></i>
                                                {{ $order->country }}
                                            </div>


                                        </div>
                                    </td>
                                    <!-- Products -->
                                    <td class="align-middle">
                                        <div class="order-products-column">
                                            @foreach ($order->orderProducts as $oProduct)
                                                <div>
                                                    <a class="me-2"
                                                        href="{{ route('backend.products.edit', $oProduct->product->id) }}">{{ $oProduct->product->name }}
                                                    </a>
                                                    x <b> {{ $oProduct->quantity }} </b>
                                                    <div>
                                                        @if ($oProduct->meta_data)
                                                            @foreach (json_decode($oProduct->meta_data) as $key => $meta)
                                                                <b>{{ $meta->name }}:</b>
                                                                @if (@$meta->value)
                                                                    {{ $meta->value }},
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                            @if ($order->note && $order->note !== '' && $order->note !== null)
                                                <div>
                                                    <i data-bs-toggle="tooltip" data-bs-title="{{ $order->note }}"
                                                        class="bi bi-chat-quote"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <!-- Total -->
                                    <td class="text-center align-middle">
                                        <span data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Subtotal: {{ $order->subtotalFormated() }}">
                                            {{ $order->totalFormated() }} {{ $currency }}
                                        </span>
                                    </td>
                                    <!-- Status -->
                                    <td class="text-center align-middle order-status" role="button"
                                        data-id="{{ $order->id }}" data-shipping-no="{{ $order->shipping_number }}"
                                        data-status="{{ $order->status }}" data-bs-toggle="modal"
                                        data-bs-target="#changeStatusModal">{!! $order->statusLabel() !!}
                                    </td>
                                    <!-- Actions -->
                                    <td class="lp-table-actions">
                                        <a class="btn btn-secondary btn-sm rounded-circle" title="{{ __('Invoice') }}"
                                            href="{{ route('backend.orders.invoice', $order->id) }}">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                        </a>
                                        <a class="btn btn-primary btn-sm rounded-circle"
                                            href="{{ route('backend.orders.edit', $order->id) }}">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <button role="button" data-model="orders" data-id="{{ $order->id }}"
                                            class="btn btn-danger btn-sm rounded-circle item-delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $orders->links() }}
                @else
                    <div class="sk-table-empty">
                        @if ($search != '')
                            {{ __('There is no orders for search:') }} <b
                                class="ms-2 text-warning">{{ $search }}</b>
                        @else
                            {{ __('There is no orders in database') }}
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
