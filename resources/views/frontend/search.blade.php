@extends('frontend.master')

@section('content')
    <!-- ======================= Shop Style 1 ======================== -->
    <section class="bg-cover" style="background:url({{ asset('/frontend_assets/img/banner-2.png') }}) no-repeat;">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="text-left py-5 mt-3 mb-3">
                        <h1 class="ft-medium mb-3">Shop</h1>
                        <ul class="shop_categories_list m-0 p-0">
                            <li><a href="#">Men</a></li>
                            <li><a href="#">Speakers</a></li>
                            <li><a href="#">Women</a></li>
                            <li><a href="#">Accessories</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================= Shop Style 1 ======================== -->


    <!-- ======================= Filter Wrap Style 1 ======================== -->
    <section class="py-3 br-bottom br-top">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Shop</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Women's</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================= Filter Wrap ============================== -->


    <!-- ======================= All Product List ======================== -->
    <section class="middle">
        <div class="container">
            <div class="row">

                <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 p-xl-0">
                    <div class="search-sidebar sm-sidebar border">
                        <div class="search-sidebar-body">

                            <!-- Category Single Option -->
                            <div class="single_search_boxed">
                                <div class="widget-boxed-header px-3">
                                    <h4 class="mt-3">Categories</h4>
                                </div>
                                <div class="widget-boxed-body">
                                    <div class="side-list no-border">
                                        <div class="filter-card" id="shop-categories">

                                            <!-- Single Filter Card -->
                                            @foreach ($categories as $category)
                                                <div class="single_filter_card">

                                                    <div class="form-check">
                                                        <input class="category_id" type="radio" name="category"
                                                            {{ $category->id == @$_GET['category_id'] ? 'checked' : '' }}
                                                            id="flexRadioDefault{{ $category->id }}"
                                                            value="{{ $category->id }}">

                                                        <label class="form-check-label"
                                                            for="flexRadioDefault{{ $category->id }}">
                                                            {{ $category->category_name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Pricing Single Option -->
                            <div class="single_search_boxed">
                                <div class="widget-boxed-header">
                                    <h4><a href="#pricing" data-toggle="collapse" aria-expanded="false"
                                            role="button">Pricing</a></h4>
                                </div>
                                <div class="widget-boxed-body collapse show" id="pricing" data-parent="#pricing">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <input type="number" id="min" placeholder="Min">
                                        </div>

                                        <div class="col-lg-5">
                                            <input type="number" id="max" placeholder="Max">
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <!-- Single Option -->
                            <div class="single_search_boxed">
                                <div class="widget-boxed-header">
                                    <h4><a href="#brands" data-toggle="collapse" aria-expanded="false"
                                            role="button">Brands</a></h4>
                                </div>
                                <div class="widget-boxed-body collapse show" id="brands" data-parent="#brands">
                                    <div class="side-list no-border">
                                        <!-- Single Filter Card -->
                                        <div class="single_filter_card">
                                            <div class="card-body pt-0">
                                                <div class="inner_widget_link">
                                                    <ul class="no-ul-list">
                                                        @foreach ($brands as $brand)
                                                            <li>

                                                                <input class="brand_id" type="radio" name="brand_id"
                                                                    id="brand{{ $brand->id }}"
                                                                    value="{{ $brand->id }}"
                                                                    {{ $brand->id == @$_GET['brand'] ? 'checked' : '' }}>

                                                                <label class="form-check-label"
                                                                    for="brand{{ $brand->id }}">
                                                                    {{ $brand->brand_name }}
                                                                </label>

                                                            </li>
                                                        @endforeach

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Size -->
                            <div class="single_search_boxed">
                                <div class="widget-boxed-header">
                                    <h4><a href="#size" data-toggle="collapse" class="collapsed" aria-expanded="false"
                                            role="button">Size</a></h4>
                                </div>
                                <div class="widget-boxed-body collapse" id="size" data-parent="#size">
                                    <div class="side-list no-border">
                                        <!-- Single Filter Card -->
                                        <div class="single_filter_card">
                                            <div class="card-body pt-0">
                                                <div class="text-left pb-0 pt-2">

                                                    @foreach ($sizes as $size)
                                                        <div class="form-check form-option form-check-inline mb-2">
                                                            <input class="size_id" type="radio" name="size_id"
                                                                id="26{{ $size->id }}" value="{{ $size->id }}"
                                                                {{ $size->id == @$_GET['size_id'] ? 'checked' : '' }}>

                                                            <label class="form-option-label"
                                                                for="26{{ $size->id }}">{{ $size->size_name }}
                                                            </label>
                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <!-- Colors -->
                            <div class="single_search_boxed">
                                <div class="widget-boxed-header">
                                    <h4><a href="#colors" data-toggle="collapse" class="collapsed" aria-expanded="false"
                                            role="button">Colors</a></h4>
                                </div>
                                <div class="widget-boxed-body collapse" id="colors" data-parent="#colors">
                                    <div class="side-list no-border">
                                        <!-- Single Filter Card -->
                                        <div class="single_filter_card">
                                            <div class="card-body pt-0">
                                                <div class="text-left">

                                                    @foreach ($colors as $color)
                                                        <div class="form-check form-option form-check-inline mb-1">
                                                            <input class="color_id" type="radio" name="color_id"
                                                                id="white{{ $color->id }}"
                                                                value="{{ $color->id }}"
                                                                {{ $color->id == @$_GET['color_id'] ? 'checked' : '' }}>

                                                            <label class="form-option-label rounded-circle"
                                                                for="white{{ $color->id }}">
                                                                <span class="form-option-color rounded-circle"
                                                                    style="background: {{ $color->color_code }}">
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @endforeach


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12">

                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="border mb-3 mfliud">
                                <div class="row align-items-center py-2 m-0">
                                    <div class="col-xl-3 col-lg-4 col-md-5 col-sm-12">
                                        <h6 class="mb-0">315 Items Found</h6>
                                    </div>

                                    <!-- Default Sorting -->
                                    <div class="col-xl-9 col-lg-8 col-md-7 col-sm-12">
                                        <div class="filter_wraps d-flex align-items-center justify-content-end m-start">
                                            <div class="single_fitres mr-2 br-right">
                                                <select class="sort">
                                                    <option selected="">Default Sorting</option>
                                                    <option value="1" {{ @$_GET['sort'] == 1 ? 'selected' : '' }}>
                                                        Sort
                                                        by Letter: A - Z</option>
                                                    <option value="2" {{ @$_GET['sort'] == 2 ? 'selected' : '' }}>
                                                        Sort
                                                        letter: Z - A </option>
                                                    <option value="3" {{ @$_GET['sort'] == 3 ? 'selected' : '' }}>
                                                        Sort
                                                        by: Low Price</option>
                                                    <option value="4" {{ @$_GET['sort'] == 4 ? 'selected' : '' }}>
                                                        Sort
                                                        by: High Price</option>
                                                </select>
                                            </div>
                                            <div class="single_fitres">
                                                <a href="shop-style-5.html" class="simple-button active mr-1"><i
                                                        class="ti-layout-grid2"></i></a>
                                                <a href="shop-list-sidebar.html" class="simple-button"><i
                                                        class="ti-view-list"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- row -->
                    <div class="row align-items-center rows-products">

                        <!-- Single -->
                        @forelse ($products as $product)
                            <div class="col-xl-4 col-lg-4 col-md-6 col-6">
                                <div class="product_grid card b-0">

                                    @if ($product->discount)
                                        <div
                                            class="badge bg-danger text-white position-absolute ft-regular ab-left text-upper">
                                            {{ $product->discount }}
                                        </div>
                                    @endif

                                    <div class="card-body p-0">
                                        <div class="shop_thumb position-relative">
                                            <a class="card-img-top d-block overflow-hidden"
                                                href="shop-single-v1.html"><img class="card-img-top"
                                                    src="{{ asset('/uploads/product/preview') }}/{{ $product->preview }}"
                                                    alt="..."></a>
                                            <div
                                                class="product-hover-overlay bg-dark d-flex align-items-center justify-content-center">
                                                <div class="edlio"><a href="#" data-toggle="modal"
                                                        data-target="#quickview" class="text-white fs-sm ft-medium"><i
                                                            class="fas fa-eye mr-1"></i>Quick View</a></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer b-0 p-0 pt-2 bg-white">

                                        <div class="text-left">
                                            <h5 class="fw-bolder fs-md mb-0 lh-1 mb-1"><a
                                                    href="shop-single-v1.html">{{ $product->name }}</a></h5>
                                            <div class="elis_rty"><span class="ft-bold text-dark fs-sm">TK
                                                    {{ $product->after_discount }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="m-auto">
                                <strong class="text-danger text-center">
                                    No Product Found
                                </strong>
                            </div>
                        @endforelse

                    </div>
                    <!-- row -->

                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 text-center mt-5">
                            <a href="#" class="btn stretched-link borders m-auto"><i
                                    class="lni lni-reload mr-2"></i>Load More</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ======================= All Product List ======================== -->
@endsection
