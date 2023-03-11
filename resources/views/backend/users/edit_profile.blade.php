@extends('layouts.dashboard')

@section('content')
    <div class="container d-flex">
        <div class="col-lg-8">
            <div class="card" style="margin-top: 100px;">
                <div class="card-header">
                    <h3 class="mt-2">Edit User Profile</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('update.profile') }}" method="post">
                        @csrf
                        @if (session('update'))
                            <div class="alert alert-success">
                                {{ session('update') }}
                            </div>
                        @endif
                        <div class="mb-3">
                            <input type="text" name="name" placeholder="Username*" class="form-control"
                                value="{{ Auth::user()->name }}">
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" placeholder="Email*" class="form-control"
                                value="{{ Auth::user()->email }}">
                        </div>

                        <div class="mb-3">
                            <input type="password" name="old_password" placeholder="Old Password*" class="form-control">
                        </div>
                        <div class="mb-3">
                            <input type="password" name="new_password" placeholder="New Password*" class="form-control">
                            @if (session('password'))
                                <strong class="text-danger">
                                    {{ session('password') }}
                                </strong>
                            @endif
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card" style="margin-top: 100px">
                <div class="card-header">
                    <h3 class="mt-2">Edit User Image</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('update.profile.image') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if (session('image'))
                            <div class="alert alert-success">
                                {{ session('image') }}
                            </div>
                        @endif
                        <div class="mb-3">
                            <label>Upload your image</label>
                            <input name="image" type="file" class="form-control"
                                onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                        <div class="mb-3">
                            <img id="blah" width="200" />
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
