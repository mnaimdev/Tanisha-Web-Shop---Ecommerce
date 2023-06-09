@extends('frontend.master')


@section('content')
    <div class="container mt-5 mb-5">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 m-auto">
            <div class="card">
                <div class="card-header text-center bg-dark">
                    <h3 class="text-white">
                        Sign In
                    </h3>

                </div>
                <div class="card-body">
                    <form action="{{ route('login.store') }}" method="POST">
                        @csrf

                        @if (session('mail'))
                            <div class="alert alert-success">
                                {{ session('mail') }}
                            </div>
                        @endif

                        @if (session('reset'))
                            <div class="alert alert-success">
                                {{ session('reset') }}
                            </div>
                        @endif

                        @if (session('email_verify'))
                            <div class="alert alert-success">
                                {{ session('email_verify') }}
                            </div>
                        @endif

                        @if (session('exist'))
                            <div class="alert alert-danger">
                                {{ session('exist') }}
                            </div>
                        @endif

                        @if (session('cart'))
                            <div class="alert alert-danger">
                                {{ session('cart') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <label>Email *</label>
                            <input type="email" name="email"
                                style="width:
                            100%; padding: 8px;">
                        </div>

                        <div class="form-group">
                            <label>Password *</label>
                            <input type="password" name="password" style="width:100%; padding: 8px;">
                        </div>

                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="flex-1">
                                    <span>Don't have any account? <a class="text-info"
                                            href="{{ route('customer.register') }}">Register</a></span>
                                </div>
                                <div class="eltio_k2">
                                    <a href="{{ route('forget.password') }}">Forgot Password?</a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit"
                                class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Login</button>
                        </div>

                        <div class="form-group bg-primary p-2">
                            <p class="text-center font-weight-bold">
                                <a href="{{ route('google.redirect') }}" class="text-white">Login with
                                    <img src="{{ asset('/frontend_assets/img/google.png') }}" alt="" width="32">
                                </a>
                            </p>
                        </div>

                        <div class="form-group bg-secondary p-2">
                            <p class="text-center font-weight-bold">
                                <a href="{{ route('github.redirect') }}" class="text-white">Login with
                                    <img src="{{ asset('/frontend_assets/img/github.png') }}" alt=""
                                        width="32">
                                </a>
                            </p>
                        </div>

                        <div class="form-group p-2" style="background-color:#9abce6">
                            <p class="text-center font-weight-bold">
                                <a href="" class="text-white">Login with
                                    <img src="{{ asset('/frontend_assets/img/facebook.png') }}" alt=""
                                        width="32">
                                </a>
                            </p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
