@extends('frontend.master')

@section('content')
    <div class="container d-flex justify-between my-5">

        <div class="col-lg-8">
            <div class="d-block mb-3">
                <h5 class="mb-4">Order Item: {{ $carts->count() }}</h5>
                <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x mb-4">
                    <form action="{{ route('cart.update') }}" method="POST">
                        @csrf

                        @if (session('cart_update'))
                            <div class="alert alert-success">
                                {{ session('cart_update') }}
                            </div>
                        @endif

                        @php
                            $sub_total = 0;
                        @endphp

                        @foreach ($carts as $cart)
                            <li class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-3">
                                        <!-- Image -->
                                        <a href="product.html"><img
                                                src="{{ asset('/uploads/product/preview') }}/{{ $cart->rel_to_product->preview }}"
                                                alt="..." class="img-fluid"></a>
                                    </div>
                                    <div class="col d-flex align-items-center">
                                        <div class="cart_single_caption pl-2">
                                            <h4 class="product_title fs-md ft-medium mb-1 lh-1">
                                                {{ $cart->rel_to_product->product_name }}</h4>

                                            <p class="mb-1 lh-1"><span class="text-dark">Size:
                                                    {{ $cart->size_id == null ? 'N/A' : $cart->rel_to_size->size_name }}</span>
                                            </p>

                                            <p class="mb-3 lh-1"><span class="text-dark">Color:
                                                    {{ $cart->color_id == null ? 'N/A' : $cart->rel_to_color->color_name }}</span>
                                            </p>

                                            <h4 class="fs-md ft-medium mb-3 lh-1">
                                                {{ $cart->rel_to_product->after_discount }} x
                                                {{ $cart->quantity }}
                                            </h4>


                                            <select class="mb-2 custom-select" name="quantity[{{ $cart->id }}]">
                                                <option value="1" {{ $cart->quantity == 1 ? 'selected' : '' }}>1
                                                </option>
                                                <option value="2" {{ $cart->quantity == 2 ? 'selected' : '' }}>2
                                                </option>
                                                <option value="3" {{ $cart->quantity == 3 ? 'selected' : '' }}>3
                                                </option>
                                                <option value="4" {{ $cart->quantity == 4 ? 'selected' : '' }}>4
                                                </option>
                                                <option value="5" {{ $cart->quantity == 5 ? 'selected' : '' }}>5
                                                </option>
                                            </select>


                                        </div>
                                    </div>
                                    <div class="fls_last"><a href="{{ route('cart.remove', $cart->id) }}"
                                            class="close_slide gray"><i class="ti-close"></i></a>
                                    </div>
                                </div>
                            </li>


                            @php
                                $sub_total += $cart->rel_to_product->after_discount * $cart->quantity;
                            @endphp
                        @endforeach

                </ul>


                <div class="d-flex justify-content-between">
                    <div class="m-auto ">
                        <button type="submit" class="btn btn-dark text-center">Update Cart</button>
                    </div>
                    </form>




                </div>



            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-4 gray">
                <div class="card-body">
                    <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                        <li class="list-group-item d-flex text-dark fs-sm ft-regular">

                            @if ($type == 1)
                                @php
                                    $discount = ($sub_total * $discount) / 100;
                                    $shipping_cost = ($sub_total * 2.5) / 100;
                                    $total = $sub_total - $discount + $shipping_cost;
                                @endphp
                            @else
                                @php
                                    $discount = $discount;
                                    $shipping_cost = ($sub_total * 2.5) / 100;
                                    $total = $sub_total - $discount + $shipping_cost;
                                @endphp
                            @endif

                            @php
                                session([
                                    'sub_total' => $sub_total,
                                    'discount' => $discount,
                                    'shipping_cost' => $shipping_cost,
                                    'total' => $total,
                                ]);
                            @endphp

                            <span>Subtotal</span> <span class="ml-auto text-dark ft-medium">TK {{ $sub_total }}</span>
                        </li>
                        <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                            <span>Discount</span> <span class="ml-auto text-dark ft-medium">TK {{ $discount }}</span>
                        </li>
                        <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                            <span>Shipping Cost</span> <span class="ml-auto text-dark ft-medium">TK {{ $shipping_cost }}
                            </span>
                        </li>
                        <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                            <span>Total</span> <span class="ml-auto text-dark ft-medium">TK {{ $total }}</span>
                        </li>
                        <li class="list-group-item fs-sm text-center">
                            Shipping cost calculated at Checkout *
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Coupon Code -->
            <form action="{{ route('cart') }}" method="GET">
                @csrf

                <strong class="text-success">
                    {{ $message }}
                </strong>

                <div class="d-flex mb-3 mt-3">
                    <input type="text" value="{{ @$_GET['coupon_code'] }}" name="coupon_code" class="form-control mr-2"
                        placeholder="Coupon Code">
                    <button class="btn btn-dark">Apply</button>
                </div>



            </form>

            <a href="{{ route('checkout') }}" class="btn btn-block btn-dark mb-3" href="checkout.html">Checkout</a>
        </div>

    </div>
@endsection
