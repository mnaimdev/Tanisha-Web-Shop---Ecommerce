<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="author" content="Themezhub" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kumo - Ecommerce Website</title>

    <!-- Custom CSS -->
    <link href="{{ asset('/frontend_assets/css/styles.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


</head>

<body>

    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader"></div>

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">

        <!-- ============================================================== -->
        <!-- Top header  -->
        <!-- ============================================================== -->
        <!-- Top Header -->
        <div class="py-2 br-bottom">
            <div class="container">
                <div class="row">

                    <div class="col-xl-7 col-lg-6 col-md-6 col-sm-12 hide-ipad">
                        <div class="top_second">
                            <p class="medium text-muted m-0 p-0"><i class="ti-truck mr-1"></i>Get Free delivery from
                                $2000 <a href="#" class="medium text-dark text-underline">Shop Now</a></p>
                        </div>
                    </div>

                    <!-- Right Menu -->
                    <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12">

                        <div class="currency-selector dropdown js-dropdown float-right">
                            <a href="javascript:void(0);" data-toggle="dropdown" class="popup-title" title="Currency"
                                aria-label="Currency dropdown">
                                <span class="hidden-xl-down medium text-muted">Currency:</span>
                                <span class="iso_code medium text-muted">$USD</span>
                                <i class="fa fa-angle-down medium text-muted"></i>
                            </a>
                            <ul class="popup-content dropdown-menu">
                                <li><a title="Euro" href="#" class="dropdown-item medium text-muted">EUR €</a>
                                </li>
                                <li class="current"><a title="US Dollar" href="#"
                                        class="dropdown-item medium text-muted">USD $</a></li>
                            </ul>
                        </div>

                        <!-- Choose Language -->

                        <div class="language-selector-wrapper dropdown js-dropdown float-right mr-3">
                            <a class="popup-title" href="javascript:void(0)" data-toggle="dropdown" title="Language"
                                aria-label="Language dropdown">
                                <span class="hidden-xl-down medium text-muted">Language:</span>
                                <span class="iso_code medium text-muted">English</span>
                                <i class="fa fa-angle-down medium text-muted"></i>
                            </a>
                            <ul class="dropdown-menu popup-content link">
                                <li class="current"><a href="javascript:void(0);"
                                        class="dropdown-item medium text-muted"><img src="assets/img/1.jpg"
                                            alt="en" width="16" height="11" /><span>English</span></a></li>
                                <li><a href="javascript:void(0);" class="dropdown-item medium text-muted"><img
                                            src="assets/img/2.jpg" alt="fr" width="16"
                                            height="11" /><span>Français</span></a></li>
                                <li><a href="javascript:void(0);" class="dropdown-item medium text-muted"><img
                                            src="assets/img/3.jpg" alt="de" width="16"
                                            height="11" /><span>Deutsch</span></a></li>
                                <li><a href="javascript:void(0);" class="dropdown-item medium text-muted"><img
                                            src="assets/img/4.jpg" alt="it" width="16"
                                            height="11" /><span>Italiano</span></a></li>
                                <li><a href="javascript:void(0);" class="dropdown-item medium text-muted"><img
                                            src="assets/img/5.jpg" alt="es" width="16"
                                            height="11" /><span>Español</span></a></li>
                                <li><a href="javascript:void(0);" class="dropdown-item medium text-muted"><img
                                            src="assets/img/6.jpg" alt="ar" width="16"
                                            height="11" /><span>اللغة العربية</span></a></li>
                            </ul>
                        </div>

                        <div class="currency-selector dropdown js-dropdown float-right mr-3">

                            @auth('customerlogin')
                                <div class="dropdown">
                                    <a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        {{ Auth::guard('customerlogin')->user()->name }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('customer.profile') }}">Profile</a>
                                        <a class="dropdown-item" href="{{ route('customer.logout') }}">Logout</a>

                                    </div>
                                </div>
                            @else
                                <a href="{{ route('customer.login') }}" class="text-muted medium"><i
                                        class="lni lni-user mr-1"></i>Sign In /</a>
                                <a href="{{ route('customer.register') }}" class="text-muted medium">Register</a>
                            @endauth


                        </div>

                        <div class="order-selector dropdown js-dropdown float-right mr-3">
                            <a href="javascript:void(0);" class="text-muted medium"><i
                                    class="lni lni-map-marker mr-1"></i>Order Tracking</a>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!-- Search -->
        <div class="headd-sty header">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="headd-sty-wrap d-flex align-items-center justify-content-between py-3">
                            <div class="headd-sty-left d-flex align-items-center">
                                <div class="headd-sty-01">
                                    <a class="nav-brand py-0" href="#">
                                        <img src="{{ asset('/frontend_assets/img/logo.png') }}" class="logo"
                                            alt="" />
                                    </a>
                                </div>

                                <div class="headd-sty-02 ml-3">
                                    <div class="bg-white rounded-md border-bold">
                                        <div class="input-group">
                                            <input type="text" id="search-input" value="{{ @$_GET['q'] }}"
                                                class="form-control custom-height b-0"
                                                placeholder="Search for products..." />
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <button class="btn bg-white text-danger custom-height rounded px-3"
                                                        id="search-btn" type="button">

                                                        <i class="fas fa-search"></i>

                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="headd-sty-last">
                                <ul class="nav-menu nav-menu-social align-to-right align-items-center d-flex">
                                    <li>
                                        <div class="call d-flex align-items-center text-left">
                                            <i class="lni lni-phone fs-xl"></i>
                                            <span class="text-muted small ml-3">Call Us Now:<strong
                                                    class="d-block text-dark fs-md">0(800) 123-456</strong></span>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#" onclick="openWishlist()">
                                            <i class="far fa-heart fs-lg"></i><span class="dn-counter bg-success">
                                                {{ App\Models\Wishlist::where('customer_id', Auth::guard('customerlogin')->id())->count() }}
                                            </span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" onclick="openCart()">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span
                                                    class="dn-counter theme-bg">{{ App\Models\Cart::where('customer_id', Auth::guard('customerlogin')->id())->count() }}</span>
                                                <div class="text-left ml-1">
                                                    <div class="text-muted small lh-1">Total</div>
                                                    <div class="primary-text cart-subtotal"><span
                                                            class="fs-md ft-medium"><span
                                                                class="prc-currency">$</span>0.00</span></div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="mobile_nav">
                                <ul>
                                    <li>
                                        <a href="#" onclick="openSearch()">
                                            <i class="lni lni-search-alt"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#login">
                                            <i class="lni lni-user"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" onclick="openWishlist()">
                                            <i class="lni lni-heart"></i><span class="dn-counter">2</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" onclick="openCart()">
                                            <i class="lni lni-shopping-basket"></i><span class="dn-counter">0</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Start Navigation -->
        <div class="headerd header-dark head-style-2">
            <div class="container">
                <nav id="navigation" class="navigation navigation-landscape">
                    <div class="nav-header">
                        <div class="nav-toggle"></div>
                        <div class="nav-menus-wrapper">
                            <ul class="nav-menu">

                                <li><a href="#" class="pl-0">Home</a>
                                    <ul class="nav-dropdown nav-submenu">
                                        <li><a href="index.html">Home 1</a></li>
                                        <li><a href="home-2.html">Home 2</a></li>
                                        <li><a href="home-3.html">Home 3</a></li>
                                        <li><a href="home-4.html">Home 4</a></li>
                                        <li><a href="home-5.html">Home 5</a></li>
                                        <li><a href="home-6.html">Home 6</a></li>
                                        <li><a href="home-7.html">Home 7</a></li>
                                        <li><a href="home-8.html">Home 8</a></li>
                                        <li><a href="home-9.html">Home 9</a></li>
                                        <li><a href="home-10.html">Home 10</a></li>
                                    </ul>
                                </li>

                                <li><a href="javascript:void(0);">Shop</a>
                                    <ul class="nav-dropdown nav-submenu">
                                        <li><a href="javascript:void(0);">Account Dashboard</a>
                                            <ul class="nav-dropdown nav-submenu">
                                                <li><a href="my-orders.html">My Order</a></li>
                                                <li><a href="wishlist.html">Wishlist</a></li>
                                                <li><a href="profile-info.html">Profile Info</a></li>
                                                <li><a href="addresses.html">Addresses</a></li>
                                                <li><a href="payment-methode.html">Payment Methode</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="javascript:void(0);">Support</a>
                                            <ul class="nav-dropdown nav-submenu">
                                                <li><a href="shoping-cart.html">Shopping Cart</a></li>
                                                <li><a href="checkout.html">Checkout</a></li>
                                                <li><a href="complete-order.html">Order Complete</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="shop-style-1.html">Shop Style 01</a></li>
                                        <li><a href="shop-style-2.html">Shop Style 02</a></li>
                                        <li><a href="shop-style-3.html">Shop Style 03</a></li>
                                        <li><a href="shop-style-4.html">Shop Style 04</a></li>
                                        <li><a href="shop-style-5.html">Shop Style 05</a></li>
                                        <li><a href="shop-list-view.html">Shop List Style</a></li>
                                    </ul>
                                </li>

                                <li><a href="javascript:void(0);">Product</a>
                                    <ul class="nav-dropdown nav-submenu">
                                        <li><a href="shop-single-v1.html">Product Detail v01</a></li>
                                        <li><a href="shop-single-v2.html">Product Detail v02</a></li>
                                        <li><a href="shop-single-v3.html">Product Detail v03</a></li>
                                        <li><a href="shop-single-v4.html">Product Detail v04</a></li>
                                    </ul>
                                </li>

                                <li><a href="javascript:void(0);">Pages</a>
                                    <ul class="nav-dropdown nav-submenu">
                                        <li><a href="blog.html">Blog Style</a></li>
                                        <li><a href="about-us.html">About Us</a></li>
                                        <li><a href="contact.html">Contact</a></li>
                                        <li><a href="404.html">404 Page</a></li>
                                        <li><a href="privacy.html">Privacy Policy</a></li>
                                        <li><a href="faq.html">FAQs</a></li>
                                    </ul>
                                </li>

                                <li><a href="docs.html">Docs</a></li>

                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- End Navigation -->
        <div class="clearfix"></div>
        <!-- ============================================================== -->

        @yield('content')


        <!-- ======================= Customer Features ======================== -->
        <section class="px-0 py-3 br-top">
            <div class="container">
                <div class="row">

                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="d-flex align-items-center justify-content-start py-2">
                            <div class="d_ico">
                                <i class="fas fa-shopping-basket"></i>
                            </div>
                            <div class="d_capt">
                                <h5 class="mb-0">Free Shipping</h5>
                                <span class="text-muted">Capped at $10 per order</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="d-flex align-items-center justify-content-start py-2">
                            <div class="d_ico">
                                <i class="far fa-credit-card"></i>
                            </div>
                            <div class="d_capt">
                                <h5 class="mb-0">Secure Payments</h5>
                                <span class="text-muted">Up to 6 months installments</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="d-flex align-items-center justify-content-start py-2">
                            <div class="d_ico">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div class="d_capt">
                                <h5 class="mb-0">15-Days Returns</h5>
                                <span class="text-muted">Shop with fully confidence</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="d-flex align-items-center justify-content-start py-2">
                            <div class="d_ico">
                                <i class="fas fa-headphones-alt"></i>
                            </div>
                            <div class="d_capt">
                                <h5 class="mb-0">24x7 Fully Support</h5>
                                <span class="text-muted">Get friendly support</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- ======================= Customer Features ======================== -->


        <!-- ============================ Footer Start ================================== -->
        <footer class="dark-footer skin-dark-footer style-2">
            <div class="footer-middle">
                <div class="container">
                    <div class="row">

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="footer_widget">
                                <img src="assets/img/logo-light.png" class="img-footer small mb-2" alt="" />

                                <div class="address mt-3">
                                    Kamrangir Char<br>Dhaka - 1211
                                </div>
                                <div class="address mt-3">
                                    +880 1794-556889<br>mnaimdev.com
                                </div>
                                <div class="address mt-3">
                                    <ul class="list-inline">
                                        <li class="list-inline-item"><a href="#"><i
                                                    class="lni lni-facebook-filled"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i
                                                    class="lni lni-twitter-filled"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i
                                                    class="lni lni-youtube"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i
                                                    class="lni lni-instagram-filled"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i
                                                    class="lni lni-linkedin-original"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                            <div class="footer_widget">
                                <h4 class="widget_title">Supports</h4>
                                <ul class="footer-menu">
                                    <li><a href="#">Contact Us</a></li>
                                    <li><a href="#">About Page</a></li>
                                    <li><a href="#">Size Guide</a></li>
                                    <li><a href="#">Shipping & Returns</a></li>
                                    <li><a href="#">FAQ's Page</a></li>
                                    <li><a href="#">Privacy</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                            <div class="footer_widget">
                                <h4 class="widget_title">Shop</h4>
                                <ul class="footer-menu">
                                    <li><a href="#">Men's Shopping</a></li>
                                    <li><a href="#">Women's Shopping</a></li>
                                    <li><a href="#">Kids's Shopping</a></li>
                                    <li><a href="#">Furniture</a></li>
                                    <li><a href="#">Discounts</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                            <div class="footer_widget">
                                <h4 class="widget_title">Company</h4>
                                <ul class="footer-menu">
                                    <li><a href="#">About</a></li>
                                    <li><a href="#">Blog</a></li>
                                    <li><a href="#">Affiliate</a></li>
                                    <li><a href="#">Login</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="footer_widget">
                                <h4 class="widget_title">Subscribe</h4>
                                <p>Receive updates, hot deals, discounts sent straignt in your inbox daily</p>
                                <div class="foot-news-last">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Email Address">
                                        <div class="input-group-append">
                                            <button type="button" class="input-group-text b-0 text-light"><i
                                                    class="lni lni-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="address mt-3">
                                    <h5 class="fs-sm text-light">Secure Payments</h5>
                                    <div class="scr_payment"><img src="{{ asset('/frontend_assets/img/card.png') }}"
                                            class="img-fluid" alt="" /></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12 col-md-12 text-center">
                            <p class="mb-0">© 2023 Kumo. Designd By <a href="https://mnaimdev.com/">Naim</a>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- ============================ Footer End ================================== -->


        <!-- Wishlist -->
        <div class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;"
            id="Wishlist">
            <div class="rightMenu-scroll">
                <div class="d-flex align-items-center justify-content-between slide-head py-3 px-3">
                    <h4 class="cart_heading fs-md ft-medium mb-0">Saved Products</h4>
                    <button onclick="closeWishlist()" class="close_slide"><i class="ti-close"></i></button>
                </div>
                <div class="right-ch-sideBar">

                    <div class="cart_select_items py-2">
                        <!-- Single Item -->
                        @php
                            $sub_total = 0;
                        @endphp
                        @foreach (App\Models\Wishlist::where('customer_id', Auth::guard('customerlogin')->id())->get() as $wishlist)
                            <div class="d-flex align-items-center justify-content-between br-bottom px-3 py-3">
                                <div class="cart_single d-flex align-items-center">
                                    <div class="cart_selected_single_thumb">
                                        <a href="#"><img
                                                src="{{ asset('/uploads/product/preview') }}/{{ $wishlist->rel_to_product->preview }}"
                                                width="60" class="img-fluid" alt="" /></a>
                                    </div>
                                    <div class="cart_single_caption pl-2">
                                        <h4 class="product_title fs-sm ft-medium mb-0 lh-1">
                                            {{ $wishlist->rel_to_product->product_name }}
                                        </h4>
                                        <p class="mb-2"><span
                                                class="text-dark ft-medium small">{{ $wishlist->size_id == null ? 'NA' : $wishlist->rel_to_size->size_name }}</span>,
                                            <span
                                                class="text-dark small">{{ $wishlist->color_id == null ? 'NA' : $wishlist->rel_to_color->color_name }}</span>
                                        </p>
                                        <h4 class="fs-md ft-medium mb-0 lh-1">TK
                                            {{ $wishlist->rel_to_product->after_discount }} X
                                            {{ $wishlist->quantity }}</h4>
                                    </div>
                                </div>
                                <div class="fls_last"><a href="{{ route('wishlist.remove', $wishlist->id) }}"
                                        class="close_slide gray"><i class="ti-close"></i></a>
                                </div>
                            </div>

                            @php
                                $sub_total += $wishlist->quantity * $wishlist->rel_to_product->after_discount;
                            @endphp
                        @endforeach

                    </div>

                    <div class="d-flex align-items-center justify-content-between br-top br-bottom px-3 py-3">
                        <h6 class="mb-0">Subtotal</h6>
                        <h3 class="mb-0 ft-medium">TK {{ $sub_total }}</h3>
                    </div>

                    <div class="cart_action px-3 py-3">
                        {{-- <div class="form-group">
                            <button type="button" class="btn d-block full-width btn-dark">Move To Cart</button>
                        </div> --}}
                        <div class="form-group">
                            <a href="{{ route('wishlist') }}" class="btn d-block full-width btn-dark-light">View
                                Wishlist</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Cart -->
        <div class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;"
            id="Cart">
            <div class="rightMenu-scroll">
                <div class="d-flex align-items-center justify-content-between slide-head py-3 px-3">
                    <h4 class="cart_heading fs-md ft-medium mb-0">Products List</h4>
                    <button onclick="closeCart()" class="close_slide"><i class="ti-close"></i></button>
                </div>
                <div class="right-ch-sideBar">

                    <div class="cart_select_items py-2">

                        @if (App\Models\Cart::where('customer_id', Auth::guard('customerlogin')->id())->count() > 0)
                            <a href="{{ route('cart.clear') }}" class="float-right mr-3 text-danger">Clear
                                Cart</a>
                            <!-- Single Item -->

                            @php
                                $sub_total = 0;
                            @endphp

                            @foreach (App\Models\Cart::where('customer_id', Auth::guard('customerlogin')->id())->get() as $cart)
                                <div class="d-flex align-items-center justify-content-between px-3 py-3">
                                    <div class="cart_single d-flex align-items-center">
                                        <div class="cart_selected_single_thumb">
                                            <a href="#">
                                                <img src="{{ asset('/uploads/product/preview') }}/{{ $cart->rel_to_product->preview }}"
                                                    width="60" class="img-fluid" alt="" /></a>
                                        </div>
                                        <div class="cart_single_caption pl-2">
                                            <h4 class="product_title fs-sm ft-medium mb-0 lh-1">
                                                {{ $cart->rel_to_product->product_name }}
                                            </h4>
                                            <p class="mb-2"><span
                                                    class="text-dark ft-medium small">{{ $cart->size_id == null ? '' : $cart->rel_to_size->size_name }}</span>

                                                {{ $cart->size_id == null ? '' : ',' }}

                                                <span
                                                    class="text-dark small">{{ $cart->color_id == null ? '' : $cart->rel_to_color->color_name }}</span>
                                            </p>
                                            <h4 class="fs-md ft-medium mb-0 lh-1">
                                                TK {{ $cart->rel_to_product->after_discount }} x {{ $cart->quantity }}
                                            </h4>

                                        </div>
                                    </div>
                                    <div class="fls_last"><a href="{{ route('cart.remove', $cart->id) }}"
                                            class="close_slide gray"><i class="ti-close"></i></a>
                                    </div>
                                </div>

                                @php
                                    $sub_total += $cart->rel_to_product->after_discount * $cart->quantity;
                                @endphp
                            @endforeach
                        @else
                            <h5 class="text-center my-2">Cart Empty</h5>
                        @endif

                    </div>

                    <!-- Subtotal -->
                    @if (App\Models\Cart::where('customer_id', Auth::guard('customerlogin')->id())->count() > 0)
                        <div class="d-flex align-items-center justify-content-between br-top br-bottom px-3 py-3">
                            <h6 class="mb-0">Subtotal</h6>
                            <h3 class="mb-0 ft-medium">TK {{ $sub_total }}</h3>
                        </div>
                    @endif


                    <div class="cart_action px-3 py-3">
                        <div class="form-group">
                            <a href="{{ route('cart') }}" class="btn d-block full-width btn-dark-light">View Cart</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->




    <script src="{{ asset('/frontend_assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/frontend_assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('/frontend_assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/frontend_assets/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('/frontend_assets/js/slick.js') }}"></script>
    <script src="{{ asset('/frontend_assets/js/slider-bg.js') }}"></script>
    <script src="{{ asset('/frontend_assets/js/lightbox.js') }}"></script>
    <script src="{{ asset('/frontend_assets/js/smoothproducts.js') }}"></script>
    <script src="{{ asset('/frontend_assets/js/snackbar.min.js') }}"></script>
    <script src="{{ asset('/frontend_assets/js/jQuery.style.switcher.js') }}"></script>

    <script src="{{ asset('/frontend_assets/js/custom.js') }}"></script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->




    <script>
        function openWishlist() {
            document.getElementById("Wishlist").style.display = "block";
        }

        function closeWishlist() {
            document.getElementById("Wishlist").style.display = "none";
        }
    </script>

    <script>
        function openCart() {
            document.getElementById("Cart").style.display = "block";
        }

        function closeCart() {
            document.getElementById("Cart").style.display = "none";
        }
    </script>

    <script>
        function openSearch() {
            document.getElementById("Search").style.display = "block";
        }

        function closeSearch() {
            document.getElementById("Search").style.display = "none";
        }
    </script>


    {{-- <script>
        $('#search-btn').click(function() {
            var search_input = $('#search-input').val();
            var min = $('#min').val();
            var max = $('#max').val();
            var category_id = $("input[class='category_id']:checked").attr('value');
            var brand = $("input[class='brand']:checked").attr('value');
            var color_id = $("input[class='color_id']:checked").attr('value');
            var size_id = $("input[class='size_id']:checked").attr('value');
            var sort = $('.sort').val();
            var link = "{{ route('search') }}" + "?q=" + search_input + "&min=" + min + "&max=" + max +
                "&category_id=" + category_id + "&color_id=" + color_id + "&size_id=" + size_id + "&sort=" + sort +
                "&brand=" + brand;
            location.href = link;
        });
    </script> --}}

    <script>
        $('#search-btn').click(function() {
            var search_input = $('#search-input').val();
            var min = $('#min').val();
            var max = $('#max').val();
            var category_id = $('input[class="category_id"]:checked').attr('value');
            var brand_id = $('input[class="brand_id"]:checked').attr('value');
            var color_id = $('input[class="color_id"]:checked').attr('value');
            var size_id = $('input[class="size_id"]:checked').attr('value');
            var sort = $('.sort').val();
            var link = "{{ route('search') }}" + "?q=" + search_input + "&category_id=" + category_id + "&min=" +
                min + "&max=" + max + "&brand_id=" + brand_id + "&color_id=" + color_id + "&size_id=" + size_id +
                "&sort=" + sort;
            location.href = link;
        });
    </script>


    @yield('footer_script')

</body>

</html>
