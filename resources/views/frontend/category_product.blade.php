@extends('frontend.master')

@section('content')
    <section class="bg-cover" style="background:url({{ asset('/frontend_assets/img/banner-2.png') }}) no-repeat;">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="text-left py-5 mt-3 mb-3">
                        <h1 class="ft-medium mb-3">{{ $category_info->category_name }}</h1>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product list -->

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
@endsection
