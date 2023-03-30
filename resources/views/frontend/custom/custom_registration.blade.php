@extends('frontend.master')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 m-auto">
            <div class="card">
                <div class="card-header bg-dark text-center">
                    <h3 class="text-white">Register</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('register.store') }}" method="POST">
                        @csrf


                        @if (session('verify'))
                            <div class="alert alert-warning">
                                {{ session('verify') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <label>Fullname*</label>
                            <input type="text" name="name" style="width: 100%; padding: 8px;">
                            @error('name')
                                <strong class="text-danger">
                                    {{ $message }}
                                </strong>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Email *</label>
                            <input type="email" name="email" style="width: 100%; padding: 8px;">
                            @error('email')
                                <strong class="text-danger">
                                    {{ $message }}
                                </strong>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Password *</label>
                            <input type="password" name="password" style="width: 100%; padding: 8px;">
                            @error('password')
                                <strong class="text-danger">
                                    {{ $message }}
                                </strong>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Confirm Password *</label>
                            <input type="password" name="password_confirmation" style="width: 100%; padding: 8px;">

                            @if (session('match'))
                                <strong class="text-danger">
                                    {{ session('match') }}
                                </strong>
                            @endif

                            @error('password_confirmation')
                                <strong class="text-danger">
                                    {{ $message }}
                                </strong>
                            @enderror
                        </div>


                        <div class="form-group">
                            <button class="btn-dark btn" type="submit
                            ">Register</button>
                            <span class="float-right">Already Registred? <a class="text-info"
                                    href="{{ route('customer.login') }}">Sign In</a>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_script')
    @if (session('register'))
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
                title: '{{ session('register') }}'
            })
        </script>
    @endif
@endsection
