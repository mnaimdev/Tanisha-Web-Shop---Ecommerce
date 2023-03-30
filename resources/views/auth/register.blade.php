{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('/dashboard_assets/css/app.min.css') }}">
</head>

<body>
    <div class="app" style="border-radius: 10px;">
        <div class="container-fluid p-h-0 p-v-20 bg full-height d-flex">
            <div class="d-flex flex-column justify-content-between w-100">
                <div class="container d-flex h-100">
                    <div class="row align-items-center w-100">
                        <div class="col-md-7 col-lg-5 m-h-auto">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <div class="mb-5 text-center">
                                        <h2>Register</h2>
                                    </div>
                                    <form action="{{ route('register') }}" method="POST">
                                        @csrf

                                        <div class="form-group">

                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" required autocomplete="name" autofocus
                                                placeholder="Fullname">

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">

                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email"
                                                placeholder="Email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>


                                        <div class="form-group">

                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="new-password"
                                                placeholder="Password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="new-password"
                                                placeholder="Confirm Password">
                                        </div>

                                        <div class="form-group">
                                            <div class="p-t-15">
                                                <p class="text-muted text-sm">Aready registered? <a
                                                        href="{{ route('login') }}">login</a></p>
                                                <button type="submit" class="btn btn-primary">Register</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html> --}}
