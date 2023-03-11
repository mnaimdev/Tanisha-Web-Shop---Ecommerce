@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="col-lg-12">
            <div class="card" style="margin-top: 100px;">
                <div class="card-header">
                    <h3 class="mt-2">Show Category</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>SL</th>
                            <th>Category Name</th>
                            <th>Category Image</th>
                            <th>Added By</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($categories as $sl => $category)
                            <tr>
                                <td>{{ $sl + 1 }}</td>
                                <td>{{ $category->category_name }}</td>
                                <td>
                                    <img width="40" height="40" class="rounded-circle"
                                        src="{{ asset('/uploads/category') }}/{{ $category->cat_img }}" alt="">
                                </td>
                                <td>
                                    {{ $category->rel_to_user->name }}
                                </td>
                                <td>
                                    <a href="{{ route('edit.category', $category->id) }}" class="btn btn-primary mr-2">
                                        <img width="16" src="{{ asset('/dashboard_assets/pencil.png') }}"
                                            alt="">
                                    </a>
                                    <a href="{{ route('delete.category', $category->id) }}" class="btn btn-danger delete">
                                        <img width="16" src="{{ asset('/dashboard_assets/x.png') }}" alt="">
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card" style="margin-top: 100px;">
                <div class="card-header">
                    <h3 class="mt-2">Add Category</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Category</label>
                            <input type="text" class="form-control" name="category_name">
                            @error('category_name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Category Image</label>
                            <input type="file" class="form-control" name="cat_img"
                                onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            @error('cat_img')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="form-group">
                            <img width="200" id="blah" alt="">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
