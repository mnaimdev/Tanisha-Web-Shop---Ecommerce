@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="col-lg-12">
            <div class="card" style="margin-top: 100px;">
                <div class="card-header">
                    <h3 class="mt-3 text-center">Product List</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>SL</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Discount</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($products as $sl => $product)
                            <tr>
                                <td>{{ $sl + 1 }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->discount == null ? 'N/A' : $product->discount }}</td>
                                <td>{{ $product->rel_to_category->category_name }}</td>


                                <td>{{ $product->brand == null ? 'Unknown' : $product->brand }}</td>
                                <td>
                                    <a href="{{ route('inventory', $product->id) }}" class="btn btn-secondary ">Inventory</a>
                                    <a href="{{ route('product.delete', $product->id) }}" class="btn btn-danger">X</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_script')
    @if (session('product_delete'))
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
                title: "{{ session('product_delete') }}",
            })
        </script>
    @endif
@endsection
