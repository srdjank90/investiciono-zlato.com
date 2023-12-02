@extends('frontend.themes.lika.layout.layout')

@section('content')
<!-- Breadcrumb -->
<div class="bg-light">
    <div class="container py-4">
        <div class="row">
            <div class="col-sm">
                <h4 class="mb-0">Products</h4>
            </div>
            <!-- End Col -->

            <div class="col-sm-auto">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('frontend.index')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Products</li>
                    </ol>
                </nav>
                <!-- End Breadcrumb -->
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
    </div>
</div>
<!-- End Breadcrumb -->

<!-- Card Grid -->
<div class="container content-space-t-1 content-space-t-md-2 content-space-b-2 content-space-b-lg-3">
    <div class="row">
        <div class="col-lg-3">
            <!-- Navbar -->
            <div class="navbar-expand-lg mb-5">
                <!-- Navbar Toggle -->
                <div class="d-grid">
                    <button type="button" class="navbar-toggler btn btn-white mb-3" data-bs-toggle="collapse" data-bs-target="#navbarVerticalNavMenu" aria-label="Toggle navigation" aria-expanded="false" aria-controls="navbarVerticalNavMenu">
                        <span class="d-flex justify-content-between align-items-center">
                            <span class="text-dark">Filter</span>

                            <span class="navbar-toggler-default">
                                <i class="bi-list"></i>
                            </span>

                            <span class="navbar-toggler-toggled">
                                <i class="bi-x"></i>
                            </span>
                        </span>
                    </button>
                </div>
                <!-- End Navbar Toggle -->

                <!-- Navbar Collapse -->
                <div id="navbarVerticalNavMenu" class="collapse navbar-collapse">
                    <div class="w-100">
                        <!-- Form -->
                        <form>
                            <div class="border-bottom pb-4 mb-4">
                                <h5>Category</h5>

                                <div class="d-grid gap-2">
                                    <!-- Checkboxes -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="tshirtCheckbox" checked>
                                        <label class="form-check-label d-flex" for="tshirtCheckbox">T-shirt <span class="ms-auto">(73)</span></label>
                                    </div>
                                    <!-- End Checkboxes -->

                                    <!-- Checkboxes -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="shoesCheckbox">
                                        <label class="form-check-label d-flex" for="shoesCheckbox">Shoes <span class="ms-auto">(0)</span></label>
                                    </div>
                                    <!-- End Checkboxes -->

                                    <!-- Checkboxes -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="accessoriesCheckbox" checked>
                                        <label class="form-check-label d-flex" for="accessoriesCheckbox">Accessories <span class="ms-auto">(51)</span></label>
                                    </div>
                                    <!-- End Checkboxes -->

                                    <!-- Checkboxes -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="topsCheckbox" checked>
                                        <label class="form-check-label d-flex" for="topsCheckbox">Tops <span class="ms-auto">(5)</span></label>
                                    </div>
                                    <!-- End Checkboxes -->

                                    <!-- Checkboxes -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="bottomCheckbox">
                                        <label class="form-check-label d-flex" for="bottomCheckbox">Bottom <span class="ms-auto">(11)</span></label>
                                    </div>
                                    <!-- End Checkboxes -->
                                </div>

                                <!-- View More - Collapse -->
                                <div class="collapse" id="collapseCategory">
                                    <div class="d-grid gap-2">
                                        <!-- Checkboxes -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="shortsCheckbox">
                                            <label class="form-check-label d-flex" for="shortsCheckbox">Shorts <span class="ms-auto">(6)</span></label>
                                        </div>
                                        <!-- End Checkboxes -->

                                        <!-- Checkboxes -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="hatsCheckbox">
                                            <label class="form-check-label d-flex" for="hatsCheckbox">Hats <span class="ms-auto">(3)</span></label>
                                        </div>
                                        <!-- End Checkboxes -->

                                        <!-- Checkboxes -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="socksCheckbox">
                                            <label class="form-check-label d-flex" for="socksCheckbox">Socks <span class="ms-auto">(8)</span></label>
                                        </div>
                                        <!-- End Checkboxes -->
                                    </div>
                                </div>
                                <!-- End View More - Collapse -->

                                <!-- Link -->
                                <a class="link-sm link-collapse" href="#collapseCategory" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapseCategory">
                                    <span class="link-collapse-default">View more</span>
                                    <span class="link-collapse-active">View less</span>
                                </a>
                                <!-- End Link -->
                            </div>
                            <div class="d-grid">
                                <button type="button" class="btn btn-white btn-transition">Clear all</button>
                            </div>
                        </form>
                        <!-- End Form -->
                    </div>
                </div>
                <!-- End Navbar Collapse -->
            </div>
            <!-- End Navbar -->
        </div>
        <!-- End Col -->

        <div class="col-lg-9">
            <div class="row align-items-center mb-5">
                <div class="col-sm mb-3 mb-sm-0">
                    <h6 class="mb-0">110 products</h6>
                </div>

                <div class="col-sm-auto">
                    <div class="d-sm-flex justify-content-sm-end align-items-center">
                        <!-- Select -->
                        <div class="mb-2 mb-sm-0 me-sm-2">
                            <select class="form-select form-select-sm">
                                <option value="alphabeticalOrderSelect1" selected>A-to-Z</option>
                                <option value="alphabeticalOrderSelect2">Z-to-A</option>
                            </select>
                        </div>
                        <!-- End Select -->

                        <!-- Nav -->
                        <ul class="nav nav-segment d-none">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">
                                    <i class="bi-grid-fill"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="bi-list"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- End Nav -->
                    </div>
                </div>
            </div>
            <!-- End Row -->

            <!-- Products -->
            <div class="row row-cols-sm-2 row-cols-md-3 mb-10">
                <!-- Product Item -->
                @foreach($products as $key => $product)
                <div class="col mb-4">
                    <div class="card card-bordered shadow-none text-center h-100">
                        <div class="card-pinned">
                            <img class="card-img-top" src="{{$storageUrl.$product->files[0]['path']}}" alt="Image Description">
                            <div class="card-pinned-top-start">
                                <span class="badge bg-success rounded-pill">New arrival</span>
                            </div>
                            <div class="card-pinned-top-end">

                            </div>
                        </div>

                        <div class="card-body">
                            <div class="mb-2">
                                @if(count($product->categories) > 0)
                                @foreach($product->categories as $cKey => $category)
                                <a class="link-sm link-secondary" href="#">{{ $category->name }}</a>
                                @endforeach
                                @endif
                            </div>

                            <h4 class="card-title">
                                <a class="text-dark" href="{{ route('frontend.product',$product->slug)}}">{{ $product->name }}</a>
                            </h4>
                            <p class="card-text text-dark">{{ $product->price }} {{$currency}}</p>
                        </div>

                        <div class="card-footer pt-0">
                            <button type="button" class="btn btn-outline-primary btn-sm rounded-pill">Add to cart</button>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- End Product Item -->
            </div>
            <!-- End Products -->

            <!-- Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">
                                <i class="bi-chevron-double-left small"></i>
                            </span>
                        </a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">
                                <i class="bi-chevron-double-right small"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- End Pagination -->
        </div>
        <!-- End Col -->
    </div>
    <!-- End Row -->
</div>
<!-- End Card Grid -->
@endsection
