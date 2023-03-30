@extends('layouts.dashboard')

@section('content')
    <div class="container">

        <div class="card" style="margin-top: 100px;">
            <div class="card-header">
                <h3 class="mt-3">Add Product</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div style="display: flex;">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <select name="category_id" class="form-control" id="category">

                                    <option> -- Select Category -- </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach

                                </select>

                            </div>

                            <div class="form-group">
                                <input type="text" name="product_name" class="form-control" placeholder="Product Name">
                                @error('product_name')
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="number" name="discount" class="form-control" placeholder="Discount %">
                            </div>

                            <div class="form-group">
                                <label>Preview</label>
                                <input type="file" name="preview" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <select name="subcategory_id" id="subcategory" class="form-control">
                                    <option> -- Select Subcategory -- </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="number" name="price" class="form-control" placeholder="Product Price">
                                @error('price')
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                @enderror
                            </div>

                            <div class="form-group">


                                <select name="brand_id" class="form-control">
                                    <option>-- Select Brand --</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>

                                @error('brand')
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Thumbnails</label>
                                <input type="file" name="thumbnails[]" multiple class="form-control">
                            </div>

                        </div>

                    </div>

                    <div class="col-lg-12">

                        <div class="form-group">
                            <input type="text" name="short_desp" class="form-control" placeholder="Short Description">
                        </div>

                        <div class="form-group">
                            <label>Product Description</label>
                            <textarea name="long_desp" class="form-control" style="resize: none;" placeholder="Long Description" id="summernote"></textarea>
                            @error('long_desp')
                                <strong class="text-danger">
                                    {{ $message }}
                                </strong>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>
    </div>

    </div>
@endsection

@section('footer_script')
    @if (session('product'))
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
                icon: "success",
                title: "{{ session('product') }}",
            })
        </script>
    @endif


    <script>
        $("#category").change(function() {
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
                    $("#subcategory").html(data);
                }
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endsection
