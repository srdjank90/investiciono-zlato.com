@extends('backend.layout.backend')
@section('content')
    <!-- Breadcrumbs -->
    <div class="sk-breadcrumb-wrapper">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend') }}">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.products.index') }}">{{ __('Products') }}</a></li>
                <li class="breadcrumb-item active" aria-current="posts">{{ __('Product Landing') }}</li>
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

            </div>
        </div>
        <div class="col-md-12">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#landingItemModal">
                {{ __('Add Landing Item') }}
            </button>
        </div>
        <div class="col-md-12">
            <div id="landingContent" class="p-5">
                @foreach ($landing as $item)
                    <div class="d-flex justify-content-start align-items-center mb-2">
                        <form id="delete-form-{{ $item->uid }}" class="me-2" method="POST"
                            action="{{ route('backend.products.landing.delete', $product->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="uid" value="{{ $item->uid }}">
                            <div class="form-group">
                                <input type="submit" class="btn btn-danger" value="{{ __('Delete') }}">
                            </div>
                        </form>
                        <button data-item="{{ json_encode($item) }}"
                            class="btn btn-primary edit-item-btn">{{ __('Edit') }}</button>
                    </div>

                    @if ($item->imagePosition == 'left')
                        <div class="row mb-lg-18 mb-15 pb-3 align-items-center">
                            <div class="col-lg-6 pe-lg-0">
                                <div class="card border-0 hover-zoom-in rounded-0">
                                    <div class="image-box-4">
                                        @if (isset($item->image) && $item->image !== '')
                                            <img class="img-fluid w-100 loaded"
                                                src="{{ $storageUrl }}{{ $item->image }}"
                                                data-src="{{ $storageUrl }}{{ $item->image }}" width="960"
                                                height="640" alt="" loading="lazy" data-ll-status="loaded">
                                        @endif
                                    </div>
                                    <div class="d-none">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 px-lg-12 ps-xl-18 pe-xl-20 mt-12 mt-lg-0">
                                <h3 class="mb-8">{{ $item->title }}</h3>
                                <p class="mb-0">{!! $item->text !!}</p>
                            </div>
                        </div>
                    @endif
                    @if ($item->imagePosition == 'right')
                        <div class="row mb-lg-18 mb-15 pb-3 align-items-center">
                            <div class="col-lg-6 px-lg-12 ps-xl-18 pe-xl-20 mt-12 mt-lg-0">
                                <h3 class="mb-8">{{ $item->title }}</h3>
                                <p class="mb-0">{!! $item->text !!}</p>
                            </div>
                            <div class="col-lg-6 pe-lg-0">
                                <div class="card border-0 hover-zoom-in rounded-0">
                                    <div class="image-box-4">
                                        @if (isset($item->image) && $item->image !== '')
                                            <img class="img-fluid w-100 loaded"
                                                src="{{ $storageUrl }}{{ $item->image }}"
                                                data-src="{{ $storageUrl }}{{ $item->image }}" width="960"
                                                height="640" alt="" loading="lazy" data-ll-status="loaded">
                                        @endif
                                    </div>
                                    <div class="d-none">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($item->imagePosition == 'none')
                        <div class="row mb-lg-18 mb-15 pb-3 align-items-center">
                            <div class="col-lg-6 px-lg-12 ps-xl-18 pe-xl-20 mt-12 mt-lg-0">
                                <h3 class="mb-8">{{ $item->title }}</h3>
                                <p class="mb-0">{!! $item->text !!}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <!-- Modal Add Landing Item -->
    <div class="modal fade" id="landingItemModal" tabindex="-1" aria-labelledby="landingItemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="landingItemModalLabel">{{ __('Add Landing Item') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="landingItemForm"
                        action="{{ route('backend.products.landing.update', $product->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-2">
                            <label for="itemImagePosition">{{ __('Image Position') }}</label>
                            <select class="form-select" name="imagePosition" id="itemImagePosition">
                                <option value="left">{{ __('Image Left') }}</option>
                                <option value="right">{{ __('Image Right') }}</option>
                                <option value="none">{{ __('No Image') }}</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="itemTitle">{{ __('Title') }}</label>
                            <input class="form-control" type="text" name="title" id="itemTitle">
                        </div>
                        <div class="form-group mb-2">
                            <label for="itemText">{{ __('Text') }}</label>
                            <textarea class="form-control tinymce" type="text" name="text" id="itemText"> </textarea>
                        </div>
                        <div class="form-control mb-2">
                            <label for="itemImage" class="form-label">{{ __('Image') }}</label>
                            <input class="form-control" type="file" name="image" id="itemImage">
                        </div>
                        <input type="hidden" name="uid" id="uid">
                        <input type="hidden" name="id" id="id" value="{{ $product->id }}">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="button" role="button"
                        class="btn btn-primary add-item-btn">{{ __('Add') }}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Landing Item Edit-->
    <div class="modal fade" id="landingItemEditModal" tabindex="-1" aria-labelledby="landingItemEditModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="landingItemEditModalLabel">{{ __('Add Landing Item') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="landingItemFormEdit"
                        action="{{ route('backend.products.landing.item.update', $product->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-2">
                            <label for="itemImagePositionEdit">{{ __('Image Position') }}</label>
                            <select class="form-select" name="imagePosition" id="itemImagePositionEdit">
                                <option value="left">{{ __('Image Left') }}</option>
                                <option value="right">{{ __('Image Right') }}</option>
                                <option value="none">{{ __('No Image') }}</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="itemTitleEdit">{{ __('Title') }}</label>
                            <input class="form-control" type="text" name="title" id="itemTitleEdit">
                        </div>
                        <div class="form-group mb-2">
                            <label for="itemTextEdit">{{ __('Text') }}</label>
                            <textarea class="form-control tinymce" type="text" name="text" id="itemTextEdit"> </textarea>
                        </div>
                        <div class="form-control mb-2">
                            <label for="itemImageEdit" class="form-label w-100">{{ __('Image') }}</label>
                            <img id="itemImagePreview" width="300" class="d-none" src="" alt="">
                            <input class="form-control" type="file" name="image" id="itemImageEdit">
                        </div>
                        <input type="hidden" name="uid" id="uidEdit">
                        <input type="hidden" name="id" id="idEdit" value="{{ $product->id }}">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="button" role="button"
                        class="btn btn-primary update-item-btn">{{ __('Update') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let storageUrl = "{{ $storageUrl }}";
        async function addLandingItem(id, formData) {
            const token = '{{ csrf_token() }}';
            formData.append('_token', token)
            for (const value of formData.values()) {
                console.log(value);
            }

            fetch('/backend/products/landing/' + id + '/update', {
                    method: 'POST',
                    body: JSON.stringify(formData),
                    headers: {
                        "Accept": "application/json",
                        'Content-Type': 'multipart/form-data',
                        "X-CSRF-Token": token
                    },
                })
                .then(function(response) {
                    return response.json()
                })
                .then(function(data) {
                    // Do something if needed
                }).catch(error => console.error('Error:', error));
        }

        function removeLandingItem(id, uid) {
            console.log(uid)
        }


        $(document).ready(function() {

            let imagePositionElement = $('#itemImagePosition');
            let titleElement = $('#itemTitle');
            let textElement = $('#itemText');
            let iamgeElement = $('#itemImage');

            $('.add-item-btn').on('click', async function() {
                $("#uid").val(Date.now());
                $("#landingItemForm").submit();
            });

            $('.edit-item-btn').on('click', async function() {
                let item = $(this).data('item')
                $('#itemImagePositionEdit').val(item.imagePosition).change()
                $('#itemTitleEdit').val(item.title)
                tinyMCE.activeEditor.setContent(item.text);
                $('#itemImagePreview').attr('src', storageUrl + item.image)
                if (item.image != '') {
                    $('#itemImagePreview').removeClass('d-none')
                }
                $('#uidEdit').val(item.uid)
                $('#landingItemEditModal').modal('show');
            });

            $('.update-item-btn').on('click', async function() {
                $("#landingItemFormEdit").submit();
            });

            $('.delete-landing-item').on('click', function() {
                const token = '{{ csrf_token() }}';
                let uid = $(this).data('uid');
                let id = $(this).data('id');
                fetch(`/backend/products/landing/${id}`, {
                        method: 'DELETE',
                        body: JSON.stringify({
                            _token: token,
                            uid: uid,
                        }),
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-Token": token
                        },
                    })
                    .then(function(response) {
                        //return response.json()
                    })
                    .then(function(data) {
                        // Do something if needed
                    }).catch(error => console.error('Error:', error));

            })
        });
    </script>
@endsection
