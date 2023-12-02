@extends('backend.layout.backend')
@section('content')
    <!-- Breadcrumbs -->
    <div class="sk-breadcrumb-wrapper">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend') }}">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.products.index') }}">{{ __('Products') }}</a></li>
                <li class="breadcrumb-item active" aria-current="products">{{ __('Actions') }}</li>
            </ol>
        </nav>
    </div>
    <!-- Page Content -->
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="col-md-12 mb-3 d-flex justify-content-between align-items-center">
                <div class="left-page-actions">
                    <a class="btn btn-primary" href="{{ route('backend.products.index') }}"><i
                            class="bi bi-arrow-left-circle"></i> {{ __('Back') }}</a>

                </div>
                <div class="right-page-actions">

                </div>
            </div>
        </div>

        <div class="col-12">
            <button data-bs-toggle="modal" data-bs-target="#createModal" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> {{ __('Add Action') }}
            </button>
        </div>

        <div class="col-12 mt-3">
            <div class="row">
                @foreach ($productActions as $key => $action)
                    <div class="col-md-12 mb-3">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <img class="img-thumbnail" width="80" height="80"
                                        src="{{ $storageUrl }}/{{ $action->image->path }}" alt="">
                                    <span class="fw-bold">{{ $action->name }}</span>
                                    <span class="badge bg-success">-{{ $action->discount }}%</span>
                                </div>
                                <div class="d-flex justify-content-end align-items-center">
                                    <span class="me-3">{{ __('Start At') }}:
                                        <b>{{ $action->starts_at }}</b></span>
                                    <span class="me-3">{{ __('Ends At') }}:
                                        <b>{{ $action->ends_at }}</b></span>
                                    <span class="badge bg-primary me-3">{{ count(json_decode($action->products)) }}</span>
                                    <button data-product="{{ json_encode($action) }}" data-bs-toggle="modal"
                                        data-bs-target="#editModal"
                                        class="btn btn-sm btn-info edit-action">{{ __('Edit') }}</button>
                                    <button role="button" data-model="products/actions" data-id="{{ $action->id }}"
                                        class="btn btn-danger btn-sm rounded-circle item-delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>

    </div>

    <!-- Create modal -->
    <div class="modal modal-alert fade" id="createModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backend.products.actions.store') }}" enctype="multipart/form-data" id="createForm"
                    method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Add Action') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="actionName">{{ __('Name') }}</label>
                            <input type="text" name="name" id="actionName" required class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group mb-2">
                            <label for="actionDescription">{{ __('Description') }}</label>
                            <textarea cols="3" rows="3" name="description" class="form-control" id="actionDescription"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="actionImage" class="form-label">{{ __('Action Image') }}</label>
                                <input class="form-control form-control-sm" name="action_image" id="actionImage"
                                    type="file">
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="actionDiscount">{{ __('Discount') }}</label>
                            <input type="number" min="0" max="100" name="discount" id="actionDiscount" required
                                class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="actionType">{{ __('Type') }}</label>
                            <select required class="form-select" name="type" id="actionType">
                                <option value="time">Time</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="actionProducts">{{ __('Products') }}</label>
                            <select required class="form-select" multiple name="products[]" id="actionProducts">
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="actionStartsAt">{{ __('Starts At') }}</label>
                            <input type="date" name="starts_at" id="actionStartsAt" required class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="actionEndsAt">{{ __('Ends At') }}</label>
                            <input type="date" name="ends_at" id="actionEndsAt" required class="form-control">
                        </div>
                        <div class="mt-3 text-end">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit modal -->
    <div class="modal modal-alert fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" id="editForm" enctype="multipart/form-data" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Add Action') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="actionNameEdit">{{ __('Name') }}</label>
                            <input type="text" name="name" id="actionNameEdit" required class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="actionSlugEdit">{{ __('Slug') }}</label>
                            <input type="text" name="slug" id="actionSlugEdit" readonly required
                                class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="actionDescriptionEdit">{{ __('Description') }}</label>
                            <textarea cols="3" rows="3" name="description" class="form-control" id="actionDescriptionEdit"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="actionImageEdit" class="form-label">{{ __('Action Image') }}</label>
                                <div class="w-100 mb-2"><img id="actionImageEditPreview" width="80" height="80"
                                        src="" alt=""></div>

                                <input class="form-control form-control-sm" name="action_image" id="actionImageEdit"
                                    type="file">
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="actionDiscountEdit">{{ __('Discount') }}</label>
                            <input type="number" min="0" max="100" name="discount" id="actionDiscountEdit"
                                required class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="actionTypeEdit">{{ __('Type') }}</label>
                            <select required class="form-select" name="type" id="actionTypeEdit">
                                <option value="time">Time</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="actionProductsEdit">{{ __('Products') }}</label>
                            <select required class="form-select" multiple name="products[]" id="actionProductsEdit">
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="actionStartsAtEdit">{{ __('Starts At') }}</label>
                            <input type="date" name="starts_at" id="actionStartsAtEdit" required
                                class="form-control date-picker">
                        </div>
                        <div class="form-group mb-2">
                            <label for="actionEndsAtEdit">{{ __('Ends At') }}</label>
                            <input type="date" name="ends_at" id="actionEndsAtEdit" required class="form-control">
                        </div>
                        <div class="mt-3 text-end">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2)
                month = '0' + month;
            if (day.length < 2)
                day = '0' + day;

            return [year, month, day].join('-');
        }


        $(".edit-action").on('click', function() {
            let action = $(this).data('product');
            console.log(action)
            if (action.image) {
                $("#actionImageEditPreview").attr('src', {{ $storageUrl }} + action.image.path);
            }
            const startsAt = new Date(action.starts_at);
            const endsAt = new Date(action.ends_at);
            const selectedProducts = JSON.parse(action.products)

            $("#editForm").attr('action', '/backend/products/actions/update/' + action.id)
            $("#actionNameEdit").val(action.name);
            $("#actionSlugEdit").val(action.slug);
            $("#actionDescriptionEdit").val(action.description);
            $("#actionDiscountEdit").val(action.discount);
            $("#actionTypeEdit").val(action.type)
            $("#actionProductsEdit").val(action.products)
            $("#actionStartsAtEdit").val(formatDate(startsAt))
            $("#actionEndsAtEdit").val(formatDate(endsAt))

            // Select Products
            const actionProductsSelect = document.getElementById('actionProductsEdit');
            const actionProductsSelectOptions = actionProductsSelect.querySelectorAll('option');
            actionProductsSelectOptions.forEach((option) => {
                option.selected = selectedProducts.includes(option.value);
            });

        })
    </script>
@endsection
