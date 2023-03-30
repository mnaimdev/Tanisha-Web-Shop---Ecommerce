@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="col-lg-12">
            <form action="{{ route('delete.check') }}" method="POST">
                @csrf

                <div class="card" style="margin-top: 100px">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="mt-2 py-4 text-center">Users List
                        </h3>
                        <p class="float-end py-4">
                            <button class="btn btn-danger" type="submit">Delete All</button>
                        </p>

                    </div>
                    <div class="card-body">
                        <table class="table">
                            @if (session('user_del'))
                                <div class="alert alert-danger">
                                    {{ session('user_del') }}
                                </div>
                            @endif
                            @if (session('user_all'))
                                <div class="alert alert-danger">
                                    {{ session('user_all') }}
                                </div>
                            @endif
                            <tr>
                                <th><input type="checkbox" id="checkAll"> Check All</th>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>

                            @foreach ($users as $sl => $user)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="checkbox[]" value="{{ $user->id }}">
                                    </td>
                                    <td>{{ $sl + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->image == null)
                                            <img width="50" src="{{ Avatar::create($user->name)->toBase64() }}"
                                                alt="">
                                        @else
                                            <img class="rounded-circle" width="50"
                                                src="{{ asset('/uploads/users') }}/{{ $user->image }}" alt="">
                                        @endif
                                    </td>
                                    <td>

                                        <a class="btn btn-danger text-white"
                                            href="{{ route('user.delete', $user->id) }}">Delete</a>
                                    </td>

                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mt-3">Add User</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('add.user') }}" method="POST">
                        @csrf

                        @if (session('not_match'))
                            <strong class="alert alert-danger mb-3">
                                {{ session('not_match') }}
                            </strong>
                        @endif

                        <div class="form-group mt-4">

                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                placeholder="Fullname">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">

                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email"
                                placeholder="Email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group">

                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password" placeholder="Password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                required autocomplete="new-password" placeholder="Confirm Password">

                        </div>

                        <div class="form-group">
                            <div class="p-t-15">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </div>
@endsection

@section('footer_script')
    <script>
        $("#checkAll").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endsection
