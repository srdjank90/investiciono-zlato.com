@extends('backend.layout.backend')

@section('content')
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend') }}">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.products.index') }}">{{ __('Products') }}</a></li>
                <li class="breadcrumb-item active" aria-current="productCategories">{{ __('Categories') }}</li>
            </ol>
        </nav>
    </div>
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
        <div class="col-md-4">
            <div class="category-add">
                <form action="/backend/products/categories/store" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" name="name" id="name"
                            class="form-control form-control-sm generate-slug" required value="">
                        <div id="nameHelp" class="form-text">{{ __('The name is how it appears on your site.') }}</div>
                    </div>
                    <div class="form-group">
                        <label for="slug">{{ __('Slug') }}</label>
                        <input type="text" name="slug" id="slug"
                            class="form-control form-control-sm slug-generated" value="">
                        <div id="slugHelp" class="form-text">
                            {{ __('The “slug” is the URL-friendly version of the name. It
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            is usually all lowercase and contains only letters, numbers, and hyphens.') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="categoryImage" class="form-label">{{ __('Category Image') }}</label>
                            <input class="form-control form-control-sm" name="category_image" id="categoryImage"
                                type="file">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="parent_id">{{ __('Parent') }}</label>
                        <select name="parent_id" id="parent_id" class="form-select form-select-sm">
                            <option value="">{{ __('None') }}</option>
                            @foreach ($productCategories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div id="parentHelp" class="form-text">
                            {{ __('Categories, unlike tags, can have a hierarchy. You might have a Jazz category, and under that have children categories for Bebop and Big Band.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 Totally optional.') }}
                        </div>
                    </div>
                    <button role="submit" class="btn btn-primary mt-3"><i class="bi bi-check2-circle"></i>
                        {{ __('Add New Category') }}</button>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <!-- Table -->
            <div class="sk-table-wrapper">
                <table class="lp-table table">
                    <thead>
                        <th width="64">#</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Slug') }}</th>
                        <th>{{ __('Parent') }}</th>
                        <th class="text-center" width="100">{{ __('Products') }}</th>
                        <th width="100"></th>
                    </thead>
                    <tbody>
                        @foreach ($productsCategories as $key => $category)
                            <tr class="align-middle" id="tr-{{ $category->id }}">
                                <td>
                                    @if ($category->image)
                                        <img width="64" class="rounded-3"
                                            src="{{ $storageUrl . $category->image->path }}" alt="">
                                    @else
                                        <div style="width: 64px;height:42px;background-color:gray" class="rounded-3"></div>
                                    @endif
                                </td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }} </td>
                                <td>
                                    @if ($category->parent)
                                        {{ $category->parent->name }}
                                    @endif
                                </td>
                                <td class="text-center">{{ $category->products_count }}</td>
                                <td class="lp-table-actions">
                                    <button data-category="{{ json_encode($category) }}" data-bs-toggle="modal"
                                        data-bs-target="#editModal" class="btn btn-sm btn-info edit-action"><i
                                            class="bi bi-pencil-fill"></i></button>
                                    @if ($category->id != 1)
                                        <button role="button" data-model="products/categories"
                                            data-id="{{ $category->id }}"
                                            class="btn btn-danger btn-sm rounded-circle item-delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $productsCategories->links() }}
            </div>

        </div>

        <!-- Edit modal -->
        <div class="modal modal-alert fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="" id="editForm" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">{{ __('Edit Product') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-2">
                                <label for="categoryNameEdit">{{ __('Name') }}</label>
                                <input type="text" name="name" id="categoryNameEdit" required
                                    class="form-control">
                            </div>

                            <div class="form-group mb-2">
                                <label for="categorySlugEdit">{{ __('Slug') }}</label>
                                <input type="text" name="slug" id="categorySlugEdit" required
                                    class="form-control">
                            </div>

                            <div class="form-group mb-2">
                                <label for="description">{{ __('Description') }}</label>
                                <textarea class="form-control tinymce" name="description" id="categoryDescriptionEdit" cols="30"
                                    rows="10"></textarea>
                            </div>

                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="categoryImageEdit" class="form-label">{{ __('Category Image') }}</label>
                                    <div class="w-100 mb-2"><img id="categoryImageEditPreview" width="80"
                                            height="80" src="" alt=""></div>

                                    <input class="form-control form-control-sm" name="category_image"
                                        id="categoryImageEdit" type="file">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="categoryNotificationPercentEdit">{{ __('Notification Change') }}</label>
                                <input type="text" name="notification_percent" id="categoryNotificationPercentEdit"
                                    required class="form-control">
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
    </div>
@endsection

@section('scripts')
    <script>
        tinymce.init({
            selector: "#categoryDescriptionEdit",
            plugins: "anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount",
            toolbar: "undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat",
        });

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
            let category = $(this).data('category');

            if (category.image && category.image != null) {
                $("#categoryImageEditPreview").attr('src', {{ $storageUrl }} + category.image.path);
            } else {
                $("#categoryImageEditPreview").attr('src', '');
            }

            $("#editForm").attr('action', '/backend/products/categories/update/' + category.id)
            $("#categoryNameEdit").val(category.name);
            $("#categorySlugEdit").val(category.slug);
            $("#categoryNotificationPercentEdit").val(category.notification_percent);
            $("#categoryDescriptionEdit").val(category.description);
            if (category.favorite_flag) {
                $("#categoryFavoriteFlagEdit").attr('checked', true)
            }
            console.log(category)
            if (category.description && category.description != '') {
                setTinyMCEContent(category.description)
            } else {
                setTinyMCEContent('')
            }

        })

        function setTinyMCEContent(value) {
            // Get TinyMCE instance by id
            var editor = tinymce.get('categoryDescriptionEdit');

            // Check if the editor instance exists
            if (editor) {
                // Set the content of the editor
                editor.setContent(value);
            }
        }
    </script>
@endsection
