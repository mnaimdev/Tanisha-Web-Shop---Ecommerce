@extends('layouts.dashboard')

@section('content')
    <div class="col-lg-8 m-auto">
        <div class="card" style="margin-top: 100px;">
            <div class="card-header">
                <h3 class="mt-2">Edit Category</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('category.update') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    @if (session('category_update'))
                        <div class="alert alert-success">
                            {{ session('category_update') }}
                        </div>
                    @endif
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="category_name" class="form-control"
                            value="{{ $categories->category_name }}">

                        @error('category_name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror

                        <input type="hidden" value="{{ $categories->id }}" name="category_id">
                    </div>
                    <div class="form-group">
                        <label>Category Image</label>
                        <input type="file" name="cat_img" class="form-control"
                            onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        @error('cat_img')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <img width="200" src="{{ asset('/uploads/category') }}/{{ $categories->cat_img }}" id="blah"
                            alt="">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
