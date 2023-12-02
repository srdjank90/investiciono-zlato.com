@extends('backend.layout.backend')
@section('content')
<!-- Breadcrumbs -->
<div class="sk-breadcrumb-wrapper">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('backend')}}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item"><a href="{{route('backend.products.index')}}">{{ __('Products') }}</a></li>
            <li class="breadcrumb-item active" aria-current="products">{{ __('Settings') }}</li>
        </ol>
    </nav>
</div>
<!-- Page Content -->
<div class="row">
    <div class="col-md-12 mb-3">
        <div class="col-md-12 mb-3 d-flex justify-content-between align-items-center">
            <div class="left-page-actions">
                <a class="btn btn-primary" href="{{ route('backend.products.index')}}"><i
                        class="bi bi-arrow-left-circle"></i> {{ __('Back') }}</a>
            </div>
            <div class="right-page-actions">

            </div>
        </div>
    </div>


    <div class="col-md-3 mb-3">
        <form class="panel-body" action="/backend/options/store" method="POST">
            @csrf
            @method('post')
            <div class="row">
                <h4>Product Settings</h4>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">{{__('Products Per Page')}}</label>
                        <input type="number" class="form-control"
                            value="{{isset($options['product_per_page_opt']) ? $options['product_per_page_opt'] : ''}}"
                            name="product_per_page_opt" min="1" id="productPerPageOpt">
                    </div>
                    <div class="form-group">
                        <label for="">{{__('Products Currency')}}</label>
                        <input type="text" class="form-control"
                            value="{{isset($options['product_currency_opt']) ? $options['product_currency_opt'] : ''}}"
                            name="product_currency_opt" id="productCurrencyOpt">
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <button class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-9 mb-3">
        <div class="row">
            <div class="col-md-12">
                <h4>Product Featured Options</h4>
                <button data-bs-toggle="modal" data-bs-target="#productMetaModal" class="btn btn-primary mb-3 d-none"><i
                        class="bi bi-plus-circle"></i> {{__('Add Featured Option')}}</button>
            </div>
        </div>
    </div>
    <div class="col-md-12 mb-3">
        <h4>Product Meta Settings</h4>
        <button data-bs-toggle="modal" data-bs-target="#productMetaModal" class="btn btn-primary mb-3"><i
                class="bi bi-plus-circle"></i> {{__('Add Product Meta')}}</button>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>{{__("Name")}}</th>
                    <th>{{__("Description")}}</th>
                    <th>{{__("Input Name")}}</th>
                    <th>{{__("Input Type")}}</th>
                    <th>{{__("Value Type")}}</th>
                    <th>{{__("Display in Table")}}</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($options['product_metas_opt']))
                @foreach ($options['product_metas_opt'] as $metaItem)
                <tr>
                    <td>{{ $metaItem['name']}}</td>
                    <td>{{ $metaItem['description']}}</td>
                    <td>{{ $metaItem['inputLabel']}}</td>
                    <td>{{ $metaItem['inputType']}}</td>
                    <td>{{ $metaItem['valueType']}}</td>
                    <td>{{ $metaItem['displayInTable']}}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<!-- Product Neta Modal -->
<div class="modal modal-alert fade" id="productMetaModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" id="productMetaForm" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">{{__("Product Meta Settings")}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <h6>{{ __('Add product meta option (size,color,...)') }}</h6>
                    <div class="row">
                        <div class="col-md-8 mb-2">
                            <div class="form-group">
                                <label for="">{{ __('Name') }}</label>
                                <input type="text" name="name" id="name" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="form-group">
                                <label for="">{{ __('Description') }}</label>
                                <input type="text" name="description" id="description"
                                    class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label for="">{{ __('Input Label') }}</label>
                                <input type="text" name="inputLabel" id="inputLabel"
                                    class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label for="">{{ __('Input Type') }}</label>
                                <select class="form-select" name="inputType" id="inputType">
                                    <option value="">Select</option>
                                    <option value="text">text</option>
                                    <option value="number">number</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label for="">{{ __('Value Type') }}</label>
                                <select class="form-select" name="valueType" id="valueType">
                                    <option value="">{{ __('Select') }}</option>
                                    <option value="text">{{ __('text') }}</option>
                                    <option value="file">{{ __('file') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" value="on" id="displayMetasInTable">
                                <label class="form-check-label" for="displayMetasInTable">{{ __('Display in table') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel')
                            }}</button>
                        <button type="button" class="btn btn-primary"
                            onclick="addProductMetaSettings()">{{__("Add")}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Add Product Meta Settings
    function addProductMetaSettings() {
        let productMetaForm = $('#productMetaForm');
        let name = $('#name').val();
        let description = $('#description').val();
        let inputLabel = $('#inputLabel').val();
        let inputType = $('#inputType').val();
        let valueType = $('#valueType').val();
        let displayInTable = $('#displayMetasInTable').is(":checked");
        $.ajax({
            url: "{{ route('backend.products.settings.metas.store') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                name: name,
                description: description,
                inputLabel: inputLabel,
                inputType: inputType,
                valueType: valueType,
                displayInTable: displayInTable
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