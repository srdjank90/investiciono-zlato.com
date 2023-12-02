@extends('backend.layout.backend')

@section('content')
<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('backend')}}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item"><a href="{{route('backend.orders.index')}}">{{ __('Orders') }}</a></li>
            <li class="breadcrumb-item active" aria-current="orders">{{ __('Settings') }}</li>
        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-md-12 mb-3">
        <div class="col-md-12 mb-3 d-flex justify-content-between align-items-center">
            <div class="left-page-actions">
                <a class="btn btn-primary" href="{{ route('backend.orders.index')}}"><i
                        class="bi bi-arrow-left-circle"></i> {{ __('Back') }}</a>
            </div>
            <div class="right-page-actions">

            </div>
        </div>
    </div>
    <div class="col-md-12">
        <form class="panel-body" action="" method="POST">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">{{ __('Orders Per Page') }}</label>
                        <input type="number" class="form-control" name="order_per_page" min="1" id="orderPerPage">
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <button class="btn btn-primary">{{ __('Update') }}</button>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection