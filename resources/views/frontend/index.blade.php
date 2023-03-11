@extends('frontend.master')

@section('content')
    <div class="clearfix"></div>
    <!-- ============================================================== -->
    <!-- Top header  -->
    <!-- ============================================================== -->

    <!-- ======================= Category & Slider ======================== -->
    <section class="p-0">
        <div class="container">
            <div class="row">

                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
                    <div class="killore-new-block-link border mb-3 mt-3">
                        <div class="px-3 py-3 ft-medium fs-md text-dark gray">Top Categories</div>

                        <div class="killore--block-link-content">
                            <ul>
                                @foreach ($categories as $category)
                                    <li><a href="">
                                            <i class=""></i>
                                            {{ $category->category_name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12">
                    <div class="home-slider auto-slider mb-3 mt-3">

                        <!-- Slide -->
                        @foreach ($feat_products as $product)
                            <div data-background-image="{{ asset('/uploads/product/preview') }}/{{ $product->preview }}"
                                class="item">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="home-slider-container">

                                                <!-- Slide Title -->
                                                <div class="home-slider-desc">
                                                    <div class="home-slider-title mb-4">
                                                        <h5 class="fs-sm ft-ragular mb-2">
                                                            {{ $product->rel_to_category->category_name }}</h5>
                                                        <h1 class="mb-2 ft-bold">
                                                            {{ $product->product_name }}
                                                        </h1>
                                                        <p class="text-danger">
                                                            {{ $product->short_desp }}
                                                        </p>
                                                    </div>

                                                    <a href="#" class="btn btn-white stretched-link hover-black">Buy
                                                        Now<i class="lni lni-arrow-right ml-2"></i></a>
                                                </div>
                                                <!-- Slide Title / End -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ======================= Category & Slider ======================== -->

    <!-- ======================= Product List ======================== -->
    <section class="middle">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="sec_title position-relative text-center">
                        <h2 class="off_title">Trendy Products</h2>
                        <h3 class="ft-bold pt-3">Our Trending Products</h3>
                    </div>
                </div>
            </div>

            <div class="row align-items-center rows-products">
                <!-- Single -->
                @foreach ($products as $product)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                        <div class="product_grid card b-0">
                            <div class="badge bg-info text-white position-absolute ft-regular ab-left text-upper">
                                Sale
                            </div>
                            <div class="badge bg-danger text-white position-absolute ft-regular ab-right text-upper">
                                -{{ $product->discount }} %</div>
                            <div class="card-body p-0">
                                <div class="shop_thumb position-relative">
                                    <a class="card-img-top d-block overflow-hidden"
                                        href="{{ route('product.details', $product->slug) }}"><img class="card-img-top"
                                            height="250"
                                            src="{{ asset('/uploads/product/preview') }}/{{ $product->preview }}"
                                            alt="..."></a>
                                    <div class="product-left-hover-overlay">
                                        <ul class="left-over-buttons">
                                            <li><a href="{{ route('product.details', $product->slug) }}"
                                                    class="d-inline-flex circle align-items-center justify-content-center"><i
                                                        class="fas fa-expand-arrows-alt position-absolute"></i></a>
                                            </li>
                                            <li><a href="javascript:void(0);"
                                                    class="d-inline-flex circle align-items-center justify-content-center snackbar-wishlist"><i
                                                        class="far fa-heart position-absolute"></i></a></li>
                                            <li><a href="javascript:void(0);"
                                                    class="d-inline-flex circle align-items-center justify-content-center snackbar-addcart"><i
                                                        class="fas fa-shopping-basket position-absolute"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer b-0 p-0 pt-2 bg-white d-flex align-items-start justify-content-between">
                                <div class="text-left">
                                    <div class="text-left">
                                        <div class="elso_titl"><span
                                                class="small">{{ $product->rel_to_category->category_name }}</span>
                                        </div>
                                        <h5 class="fs-md mb-0 lh-1 mb-1"><a
                                                href="shop-single-v1.html">{{ $product->product_name }}</a></h5>
                                        <div class="star-rating align-items-center d-flex justify-content-left mb-2 p-0">
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="elis_rty"><span class="ft-bold text-dark fs-sm">

                                                @if ($product->discount)
                                                    <span class="text-muted ft-medium line-through mr-2">৳
                                                        {{ $product->price }}</span>
                                                @endif
                                                <span class="text-muted ft-medium mr-2">৳
                                                    {{ $product->after_discount }}</span>

                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="position-relative text-center">
                        <a href="shop-style-1.html" class="btn stretched-link borders">Explore More<i
                                class="lni lni-arrow-right ml-2"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- ======================= Product List ======================== -->

    <!-- ======================= Brand Start ============================ -->
    <section class="py-3 br-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="smart-brand">

                        @foreach ($products as $product)
                            <div class="single-brnads">
                                @if ($product->brand)
                                    <div style="padding: 10px;" class="badge bg-danger">
                                        {{ $product->brand }}
                                    </div>
                                @else
                                @endif

                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================= Brand Start ============================ -->

    <!-- ======================= Tag Wrap Start ============================ -->
    <section class="bg-cover mt-5"
        style="background:url({{ asset('/frontend_assets/img/e-middle-banner.png') }}) no-repeat;">
        <div class="ht-60"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12">
                    <div class="tags_explore text-center">
                        <h2 class="mb-0 text-white ft-bold">Big Sale Up To 70% Off</h2>
                        <p class="text-light fs-lg mb-4">Exclussive Offers For Limited Time</p>
                        <p>
                            <a href="#" class="btn btn-lg bg-white px-5 text-dark ft-medium">Explore Your
                                Order</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="ht-60"></div>
    </section>
    <!-- ======================= Tag Wrap Start ============================ -->

    <!-- ======================= All Category ======================== -->
    <section class="middle">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="sec_title position-relative text-center">
                        <h2 class="off_title">Popular Categories</h2>
                        <h3 class="ft-bold pt-3">Trending Categories</h3>
                    </div>
                </div>
            </div>

            <div class="row align-items-center justify-content-center">
                <!-- Categories -->
                @foreach ($categories as $category)
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-4">
                        <div class="cats_side_wrap text-center mx-auto mb-3">
                            <div class="sl_cat_01">
                                <div class="d-inline-flex align-items-center justify-content-center mb-2 border">
                                    <a href=""><img
                                            src="{{ asset('/uploads/category') }}/{{ $category->cat_img }}"
                                            class="img-fluid" style="width: 80px; height: 60px;" alt=""></a>
                                </div>
                            </div>
                            <div class="sl_cat_02">
                                <h6 class="m-0 ft-medium fs-sm"><a
                                        href="javascript:void(0);">{{ $category->category_name }}</a></h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
    <!-- ======================= All Category ======================== -->

    <!-- ======================= Customer Review ======================== -->
    <section class="gray">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="sec_title position-relative text-center">
                        <h2 class="off_title">Testimonials</h2>
                        <h3 class="ft-bold pt-3">Client Reviews</h3>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12">
                    <div class="reviews-slide px-3">

                        <!-- single review -->
                        <div class="single_review">
                            <div class="sng_rev_thumb">
                                <figure><img src="assets/img/team-1.jpg" class="img-fluid circle" alt="" />
                                </figure>
                            </div>
                            <div class="sng_rev_caption text-center">
                                <div class="rev_desc mb-4">
                                    <p class="fs-md">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                        do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                        minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                                        ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                        velit esse cillum.</p>
                                </div>
                                <div class="rev_author">
                                    <h4 class="mb-0">Mark Jevenue</h4>
                                    <span class="fs-sm">CEO of Addle</span>
                                </div>
                            </div>
                        </div>

                        <!-- single review -->
                        <div class="single_review">
                            <div class="sng_rev_thumb">
                                <figure><img src="assets/img/team-2.jpg" class="img-fluid circle" alt="" />
                                </figure>
                            </div>
                            <div class="sng_rev_caption text-center">
                                <div class="rev_desc mb-4">
                                    <p class="fs-md">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                        do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                        minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                                        ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                        velit esse cillum.</p>
                                </div>
                                <div class="rev_author">
                                    <h4 class="mb-0">Henna Bajaj</h4>
                                    <span class="fs-sm">Aqua Founder</span>
                                </div>
                            </div>
                        </div>

                        <!-- single review -->
                        <div class="single_review">
                            <div class="sng_rev_thumb">
                                <figure><img src="assets/img/team-3.jpg" class="img-fluid circle" alt="" />
                                </figure>
                            </div>
                            <div class="sng_rev_caption text-center">
                                <div class="rev_desc mb-4">
                                    <p class="fs-md">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                        do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                        minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                                        ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                        velit esse cillum.</p>
                                </div>
                                <div class="rev_author">
                                    <h4 class="mb-0">John Cenna</h4>
                                    <span class="fs-sm">CEO of Plike</span>
                                </div>
                            </div>
                        </div>

                        <!-- single review -->
                        <div class="single_review">
                            <div class="sng_rev_thumb">
                                <figure><img src="assets/img/team-4.jpg" class="img-fluid circle" alt="" />
                                </figure>
                            </div>
                            <div class="sng_rev_caption text-center">
                                <div class="rev_desc mb-4">
                                    <p class="fs-md">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                        do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                        minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                                        ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                        velit esse cillum.</p>
                                </div>
                                <div class="rev_author">
                                    <h4 class="mb-0">Madhu Sharma</h4>
                                    <span class="fs-sm">Team Manager</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================= Customer Review ======================== -->

    <!-- ======================= Top Seller Start ============================ -->
    <section class="space min">
        <div class="container">

            <div class="row">

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <div class="top-seller-title">
                        <h4 class="ft-medium">Top Seller</h4>
                    </div>
                    <div class="ftr-content">

                        <!-- Single Item -->
                        <div class="product_grid row">
                            <div class="col-xl-4 col-lg-5 col-md-5 col-4">
                                <div class="shop_thumb position-relative">
                                    <div class="badge bg-info text-white position-absolute ft-regular ab-left text-upper">
                                        Sale</div>
                                    <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img
                                            class="card-img-top" src="assets/img/shop/1.png" alt="..."></a>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-7 col-md-7 col-8 pl-0">
                                <div class="text-left mfliud">
                                    <div class="elso_titl"><span class="small">Mobiles</span></div>
                                    <h5 class="fs-md mb-0 lh-1 mb-1 ft-medium"><a href="shop-single-v1.html">Zoomio
                                            iPhones</a></h5>
                                    <div class="star-rating align-items-center d-flex justify-content-left mb-2 p-0">
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div class="elis_rty"><span class="ft-bold text-dark fs-sm">$99 - $129</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Item -->
                        <div class="product_grid row">
                            <div class="col-xl-4 col-lg-5 col-md-5 col-4">
                                <div class="shop_thumb position-relative">
                                    <div
                                        class="badge bg-danger text-white position-absolute ft-regular ab-left text-upper">
                                        -50%</div>
                                    <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img
                                            class="card-img-top" src="assets/img/shop/2.png" alt="..."></a>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-7 col-md-7 col-8 pl-0">
                                <div class="text-left mfliud">
                                    <div class="elso_titl"><span class="small">TV/LED</span></div>
                                    <h5 class="fs-md mb-0 lh-1 mb-1 ft-medium"><a href="shop-single-v1.html">32
                                            Inch Smart LED</a></h5>
                                    <div class="star-rating align-items-center d-flex justify-content-left mb-2 p-0">
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div class="elis_rty"><span class="ft-bold text-dark fs-sm">$799 -
                                            $1200</span></div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Item -->
                        <div class="product_grid row">
                            <div class="col-xl-4 col-lg-5 col-md-5 col-4">
                                <div class="shop_thumb position-relative">
                                    <div
                                        class="badge bg-warning text-white position-absolute ft-regular ab-left text-upper">
                                        Hot</div>
                                    <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img
                                            class="card-img-top" src="assets/img/shop/10.png" alt="..."></a>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-7 col-md-7 col-8 pl-0">
                                <div class="text-left mfliud">
                                    <div class="elso_titl"><span class="small">Headphone</span></div>
                                    <h5 class="fs-md mb-0 lh-1 mb-1 ft-medium"><a href="shop-single-v1.html">Ziomi
                                            Headphone</a></h5>
                                    <div class="star-rating align-items-center d-flex justify-content-left mb-2 p-0">
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div class="elis_rty"><span class="ft-bold text-dark fs-sm">$49 - $110</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <div class="ftr-title">
                        <h4 class="ft-medium">Featured Products</h4>
                    </div>
                    <div class="ftr-content">
                        <!-- Single Item -->
                        @foreach ($feat_products as $feat_product)
                            <div class="product_grid row">
                                <div class="col-xl-4 col-lg-5 col-md-5 col-4">
                                    <div class="shop_thumb position-relative">
                                        <div
                                            class="badge bg-warning text-white position-absolute ft-regular ab-left text-upper">
                                            Hot</div>
                                        <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img
                                                class="card-img-top"
                                                src="{{ asset('/uploads/product/preview') }}/{{ $feat_product->preview }}"
                                                alt="..."></a>
                                    </div>
                                </div>
                                <div class="col-xl-8 col-lg-7 col-md-7 col-8 pl-0">
                                    <div class="text-left mfliud">
                                        <div class="elso_titl"><span
                                                class="small">{{ $feat_product->rel_to_category->category_name }}</span>
                                        </div>
                                        <h5 class="fs-md mb-0 lh-1 mb-1 ft-medium"><a
                                                href="">{{ $feat_product->product_name }}</a>
                                        </h5>
                                        <div class="star-rating align-items-center d-flex justify-content-left mb-2 p-0">
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="elis_rty"><span class="ft-bold text-dark fs-sm">

                                                @if ($feat_product->discount)
                                                    <span class="line-through text-muted">৳
                                                        {{ $feat_product->price }}</span>
                                                @endif
                                                <span>
                                                    ৳ {{ $feat_product->after_discount }}
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <div class="ftr-title">
                        <h4 class="ft-medium">Recent Products</h4>
                    </div>
                    <div class="ftr-content">
                        <!-- Single Item -->
                        <div class="product_grid row">
                            <div class="col-xl-4 col-lg-5 col-md-5 col-4">
                                <div class="shop_thumb position-relative">
                                    <div class="badge bg-info text-white position-absolute ft-regular ab-left text-upper">
                                        Sale</div>
                                    <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img
                                            class="card-img-top" src="assets/img/shop/7.png" alt="..."></a>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-7 col-md-7 col-8 pl-0">
                                <div class="text-left mfliud">
                                    <div class="elso_titl"><span class="small">TV/LED</span></div>
                                    <h5 class="fs-md mb-0 lh-1 mb-1 ft-medium"><a href="shop-single-v1.html">Smart
                                            43 Inch LED</a></h5>
                                    <div class="star-rating align-items-center d-flex justify-content-left mb-2 p-0">
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div class="elis_rty"><span class="ft-bold text-dark fs-sm">$909 -
                                            $1400</span></div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Item -->
                        <div class="product_grid row">
                            <div class="col-xl-4 col-lg-5 col-md-5 col-4">
                                <div class="shop_thumb position-relative">
                                    <div
                                        class="badge bg-warning text-white position-absolute ft-regular ab-left text-upper">
                                        Hot</div>
                                    <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img
                                            class="card-img-top" src="assets/img/shop/8.png" alt="..."></a>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-7 col-md-7 col-8 pl-0">
                                <div class="text-left mfliud">
                                    <div class="elso_titl"><span class="small">Headphone</span></div>
                                    <h5 class="fs-md mb-0 lh-1 mb-1 ft-medium"><a href="shop-single-v1.html">Vivo
                                            Smart Headphone</a></h5>
                                    <div class="star-rating align-items-center d-flex justify-content-left mb-2 p-0">
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div class="elis_rty"><span class="ft-bold text-dark fs-sm">$129 -
                                            $549</span></div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Item -->
                        <div class="product_grid row">
                            <div class="col-xl-4 col-lg-5 col-md-5 col-4">
                                <div class="shop_thumb position-relative">
                                    <div
                                        class="badge bg-danger text-white position-absolute ft-regular ab-left text-upper">
                                        -50%</div>
                                    <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img
                                            class="card-img-top" src="assets/img/shop/9.png" alt="..."></a>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-7 col-md-7 col-8 pl-0">
                                <div class="text-left mfliud">
                                    <div class="elso_titl"><span class="small">Mobiles</span></div>
                                    <h5 class="fs-md mb-0 lh-1 mb-1 ft-medium"><a href="shop-single-v1.html">Micro
                                            Android Phones</a></h5>
                                    <div class="star-rating align-items-center d-flex justify-content-left mb-2 p-0">
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div class="elis_rty"><span class="ft-bold text-dark fs-sm">$990 -
                                            $1949</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- ======================= Top Seller Start ============================ -->




    <!-- Product View Modal -->
    <div class="modal fade lg-modal" id="quickview" tabindex="-1" role="dialog" aria-labelledby="quickviewmodal"
        aria-hidden="true">
        <div class="modal-dialog modal-xl login-pop-form" role="document">
            <div class="modal-content" id="quickviewmodal">
                <div class="modal-headers">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="ti-close"></span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="quick_view_wrap">

                        <div class="quick_view_thmb">
                            <div class="quick_view_slide">
                                <div class="single_view_slide"><img src="assets/img/product/1.jpg" class="img-fluid"
                                        alt="" /></div>
                                <div class="single_view_slide"><img src="assets/img/product/2.jpg" class="img-fluid"
                                        alt="" /></div>
                                <div class="single_view_slide"><img src="assets/img/product/3.jpg" class="img-fluid"
                                        alt="" /></div>
                                <div class="single_view_slide"><img src="assets/img/product/4.jpg" class="img-fluid"
                                        alt="" /></div>
                            </div>
                        </div>

                        <div class="quick_view_capt">
                            <div class="prd_details">

                                <div class="prt_01 mb-1"><span class="text-light bg-info rounded px-2 py-1">Dresses</span>
                                </div>
                                <div class="prt_02 mb-2">
                                    <h2 class="ft-bold mb-1">Women Striped Shirt Dress</h2>
                                    <div class="text-left">
                                        <div class="star-rating align-items-center d-flex justify-content-left mb-1 p-0">
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star"></i>
                                            <span class="small">(412 Reviews)</span>
                                        </div>
                                        <div class="elis_rty"><span
                                                class="ft-medium text-muted line-through fs-md mr-2">$199</span><span
                                                class="ft-bold theme-cl fs-lg mr-2">$110</span><span
                                                class="ft-regular text-danger bg-light-danger py-1 px-2 fs-sm">Out
                                                of Stock</span></div>
                                    </div>
                                </div>

                                <div class="prt_03 mb-3">
                                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                        praesentium voluptatum deleniti atque corrupti quos dolores.</p>
                                </div>

                                <div class="prt_04 mb-2">
                                    <p class="d-flex align-items-center mb-0 text-dark ft-medium">Color:</p>
                                    <div class="text-left">
                                        <div class="form-check form-option form-check-inline mb-1">
                                            <input class="form-check-input" type="radio" name="color8"
                                                id="white8">
                                            <label class="form-option-label rounded-circle" for="white8"><span
                                                    class="form-option-color rounded-circle blc7"></span></label>
                                        </div>
                                        <div class="form-check form-option form-check-inline mb-1">
                                            <input class="form-check-input" type="radio" name="color8"
                                                id="blue8">
                                            <label class="form-option-label rounded-circle" for="blue8"><span
                                                    class="form-option-color rounded-circle blc2"></span></label>
                                        </div>
                                        <div class="form-check form-option form-check-inline mb-1">
                                            <input class="form-check-input" type="radio" name="color8"
                                                id="yellow8">
                                            <label class="form-option-label rounded-circle" for="yellow8"><span
                                                    class="form-option-color rounded-circle blc5"></span></label>
                                        </div>
                                        <div class="form-check form-option form-check-inline mb-1">
                                            <input class="form-check-input" type="radio" name="color8"
                                                id="pink8">
                                            <label class="form-option-label rounded-circle" for="pink8"><span
                                                    class="form-option-color rounded-circle blc3"></span></label>
                                        </div>
                                        <div class="form-check form-option form-check-inline mb-1">
                                            <input class="form-check-input" type="radio" name="color8"
                                                id="red">
                                            <label class="form-option-label rounded-circle" for="red"><span
                                                    class="form-option-color rounded-circle blc4"></span></label>
                                        </div>
                                        <div class="form-check form-option form-check-inline mb-1">
                                            <input class="form-check-input" type="radio" name="color8"
                                                id="green">
                                            <label class="form-option-label rounded-circle" for="green"><span
                                                    class="form-option-color rounded-circle blc6"></span></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="prt_04 mb-4">
                                    <p class="d-flex align-items-center mb-0 text-dark ft-medium">Size:</p>
                                    <div class="text-left pb-0 pt-2">
                                        <div class="form-check size-option form-option form-check-inline mb-2">
                                            <input class="form-check-input" type="radio" name="size" id="28"
                                                checked="">
                                            <label class="form-option-label" for="28">28</label>
                                        </div>
                                        <div class="form-check form-option size-option  form-check-inline mb-2">
                                            <input class="form-check-input" type="radio" name="size"
                                                id="30">
                                            <label class="form-option-label" for="30">30</label>
                                        </div>
                                        <div class="form-check form-option size-option  form-check-inline mb-2">
                                            <input class="form-check-input" type="radio" name="size"
                                                id="32">
                                            <label class="form-option-label" for="32">32</label>
                                        </div>
                                        <div class="form-check form-option size-option  form-check-inline mb-2">
                                            <input class="form-check-input" type="radio" name="size"
                                                id="34">
                                            <label class="form-option-label" for="34">34</label>
                                        </div>
                                        <div class="form-check form-option size-option  form-check-inline mb-2">
                                            <input class="form-check-input" type="radio" name="size"
                                                id="36">
                                            <label class="form-option-label" for="36">36</label>
                                        </div>
                                        <div class="form-check form-option size-option  form-check-inline mb-2">
                                            <input class="form-check-input" type="radio" name="size"
                                                id="38">
                                            <label class="form-option-label" for="38">38</label>
                                        </div>
                                        <div class="form-check form-option size-option  form-check-inline mb-2">
                                            <input class="form-check-input" type="radio" name="size"
                                                id="40">
                                            <label class="form-option-label" for="40">40</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="prt_05 mb-4">
                                    <div class="form-row mb-7">
                                        <div class="col-12 col-lg-auto">
                                            <!-- Quantity -->
                                            <select class="mb-2 custom-select">
                                                <option value="1" selected="">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg">
                                            <!-- Submit -->
                                            <button type="submit" class="btn btn-block custom-height bg-dark mb-2">
                                                <i class="lni lni-shopping-basket mr-2"></i>Add to Cart
                                            </button>
                                        </div>
                                        <div class="col-12 col-lg-auto">
                                            <!-- Wishlist -->
                                            <button class="btn custom-height btn-default btn-block mb-2 text-dark"
                                                data-toggle="button">
                                                <i class="lni lni-heart mr-2"></i>Wishlist
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="prt_06">
                                    <p class="mb-0 d-flex align-items-center">
                                        <span class="mr-4">Share:</span>
                                        <a class="d-inline-flex align-items-center justify-content-center p-3 gray circle fs-sm text-muted mr-2"
                                            href="#!">
                                            <i class="fab fa-twitter position-absolute"></i>
                                        </a>
                                        <a class="d-inline-flex align-items-center justify-content-center p-3 gray circle fs-sm text-muted mr-2"
                                            href="#!">
                                            <i class="fab fa-facebook-f position-absolute"></i>
                                        </a>
                                        <a class="d-inline-flex align-items-center justify-content-center p-3 gray circle fs-sm text-muted"
                                            href="#!">
                                            <i class="fab fa-pinterest-p position-absolute"></i>
                                        </a>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Log In Modal -->
    <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="loginmodal"
        aria-hidden="true">
        <div class="modal-dialog modal-xl login-pop-form" role="document">
            <div class="modal-content" id="loginmodal">
                <div class="modal-headers">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="ti-close"></span>
                    </button>
                </div>

                <div class="modal-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="m-0 ft-regular">Login</h2>
                    </div>

                    <form>
                        <div class="form-group">
                            <label>User Name</label>
                            <input type="text" class="form-control" placeholder="Username*">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password*">
                        </div>

                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="flex-1">
                                    <input id="dd" class="checkbox-custom" name="dd" type="checkbox">
                                    <label for="dd" class="checkbox-custom-label">Remember Me</label>
                                </div>
                                <div class="eltio_k2">
                                    <a href="#">Lost Your Password?</a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit"
                                class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Login</button>
                        </div>

                        <div class="form-group text-center mb-0">
                            <p class="extra">Not a member?<a href="#et-register-wrap" class="text-dark">
                                    Register</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Search -->
    <div class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;" id="Search">
        <div class="rightMenu-scroll">
            <div class="d-flex align-items-center justify-content-between slide-head py-3 px-3">
                <h4 class="cart_heading fs-md ft-medium mb-0">Search Products</h4>
                <button onclick="closeSearch()" class="close_slide"><i class="ti-close"></i></button>
            </div>

            <div class="cart_action px-3 py-4">
                <form class="form m-0 p-0">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Product Keyword.." />
                    </div>

                    <div class="form-group">
                        <select class="custom-select">
                            <option value="1" selected="">Choose Category</option>
                            <option value="2">Men's Store</option>
                            <option value="3">Women's Store</option>
                            <option value="4">Kid's Fashion</option>
                            <option value="5">Inner Wear</option>
                        </select>
                    </div>

                    <div class="form-group mb-0">
                        <button type="button" class="btn d-block full-width btn-dark">Search Product</button>
                    </div>
                </form>
            </div>

            <div class="d-flex align-items-center justify-content-center br-top br-bottom py-2 px-3">
                <h4 class="cart_heading fs-md mb-0">Hot Categories</h4>
            </div>

            <div class="cart_action px-3 py-3">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-4 mb-3">
                        <div class="cats_side_wrap text-center">
                            <div class="sl_cat_01">
                                <div class="d-inline-flex align-items-center justify-content-center p-3 circle mb-2 gray">
                                    <a href="javascript:void(0);" class="d-block"><img src="assets/img/tshirt.png"
                                            class="img-fluid" width="40" alt="" /></a>
                                </div>
                            </div>
                            <div class="sl_cat_02">
                                <h6 class="m-0 ft-medium fs-sm"><a href="javascript:void(0);">T-Shirts</a></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-4 mb-3">
                        <div class="cats_side_wrap text-center">
                            <div class="sl_cat_01">
                                <div class="d-inline-flex align-items-center justify-content-center p-3 circle mb-2 gray">
                                    <a href="javascript:void(0);" class="d-block"><img src="assets/img/pant.png"
                                            class="img-fluid" width="40" alt="" /></a>
                                </div>
                            </div>
                            <div class="sl_cat_02">
                                <h6 class="m-0 ft-medium fs-sm"><a href="javascript:void(0);">Pants</a></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-4 mb-3">
                        <div class="cats_side_wrap text-center">
                            <div class="sl_cat_01">
                                <div class="d-inline-flex align-items-center justify-content-center p-3 circle mb-2 gray">
                                    <a href="javascript:void(0);" class="d-block"><img src="assets/img/fashion.png"
                                            class="img-fluid" width="40" alt="" /></a>
                                </div>
                            </div>
                            <div class="sl_cat_02">
                                <h6 class="m-0 ft-medium fs-sm"><a href="javascript:void(0);">Women's</a></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-4 mb-3">
                        <div class="cats_side_wrap text-center">
                            <div class="sl_cat_01">
                                <div class="d-inline-flex align-items-center justify-content-center p-3 circle mb-2 gray">
                                    <a href="javascript:void(0);" class="d-block"><img src="assets/img/sneakers.png"
                                            class="img-fluid" width="40" alt="" /></a>
                                </div>
                            </div>
                            <div class="sl_cat_02">
                                <h6 class="m-0 ft-medium fs-sm"><a href="javascript:void(0);">Shoes</a></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-4 mb-3">
                        <div class="cats_side_wrap text-center">
                            <div class="sl_cat_01">
                                <div class="d-inline-flex align-items-center justify-content-center p-3 circle mb-2 gray">
                                    <a href="javascript:void(0);" class="d-block"><img src="assets/img/television.png"
                                            class="img-fluid" width="40" alt="" /></a>
                                </div>
                            </div>
                            <div class="sl_cat_02">
                                <h6 class="m-0 ft-medium fs-sm"><a href="javascript:void(0);">Television</a>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-4 mb-3">
                        <div class="cats_side_wrap text-center">
                            <div class="sl_cat_01">
                                <div class="d-inline-flex align-items-center justify-content-center p-3 circle mb-2 gray">
                                    <a href="javascript:void(0);" class="d-block"><img src="assets/img/accessories.png"
                                            class="img-fluid" width="40" alt="" /></a>
                                </div>
                            </div>
                            <div class="sl_cat_02">
                                <h6 class="m-0 ft-medium fs-sm"><a href="javascript:void(0);">Accessories</a>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>

    </div>
@endsection


@section('footer_script')
    @if (session('login'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '{{ session('login') }}'
            })
        </script>
    @endif

    @if (session('order'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '{{ session('order') }}'
            })
        </script>
    @endif
@endsection
