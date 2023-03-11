@extends('layouts.dashboard')

@section('content')
    <div class="container">

        <div class="col-lg-12">

            <div class="card" style="margin-top: 100px;">
                <div class="card-header">
                    <h3 class="mt-3">Subcategory List</h3>

                    @if (session('sub_delete'))
                        <div class="alert alert-danger">
                            {{ session('sub_delete') }}
                        </div>
                    @endif

                </div>
                <div class="card-body">
                    <table class="table" id="table_id">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Subcategory Name</th>
                                <th>Category Name</th>
                                <th>Added By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subcategories as $sl => $subcategory)
                                <tr>
                                    <td>{{ $sl + 1 }}</td>
                                    <td>{{ $subcategory->subcategory_name }}</td>
                                    <td>{{ $subcategory->rel_to_category->category_name }}</td>
                                    <td>{{ $subcategory->rel_to_user->name }}</td>
                                    <td>
                                        <a href="{{ route('edit.subcategory', $subcategory->id) }}"
                                            class="btn btn-primary">Edit</a>
                                        <a href="{{ route('del.subcategory', $subcategory->id) }}"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- <div class="col-lg-12">
            <div class="card" style="margin-top
            : 100px;">
                <div class="card-header">
                    <h3 class="mt-3">Subcategory List</h3>
                </div>
                <div class="card-body">
                    <select name="category_id" class="form-control" id="category_id">
                        <option> -- Select Category -- </option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>

                    <div class="mt-5" id="subcate">

                    </div>

                </div>
            </div>
        </div> --}}

        <div class="col-lg-12">
            <div class="card" style="margin-top: 100px;">
                <div class="card-header">
                    <h3 class="mt-2">Add SubCategory</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('sub.category.store') }}" method="POST">
                        @csrf

                        @if (session('subcategory'))
                            <div class="alert alert-success">
                                {{ session('subcategory') }}
                            </div>
                        @endif


                        <div class="form-group">
                            <select name="category_id" class="form-control">
                                <option>-- Select Category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Sub Category</label>
                            <input type="text" class="form-control" name="subcategory_name">
                            @error('subcategory_name')
                                <strong class="text-danger">
                                    {{ $message }}
                                </strong>
                            @enderror
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

@section('footer_script')
    {{-- <script>
        $("#category_id").change(function() {
            var category_id = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/getsubcategory",
                type: "POST",
                data: {
                    "category_id": category_id
                },
                success: function(data) {
                    $("#subcate").html(data);
                }

            });

        });
    </script> --}}

    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
    </script>
@endsection
