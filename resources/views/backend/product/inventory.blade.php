@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div style="display: flex;">
            <div class="col-lg-8">
                <div class="card" style="margin-top: 100px;">
                    <div class="card-header">
                        <h3 class="mt-3 bg-dark text-white p-2 text-center">
                            Inventory List
                        </h3>

                        @if (session('del_inventory'))
                            <div class="alert alert-danger">
                                {{ session('del_inventory') }}
                            </div>
                        @endif

                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>SL</th>
                                <th>Product Name</th>
                                <th>Color Name</th>
                                <th>Size Name</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($inventories as $sl => $inventory)
                                <tr>
                                    <td>{{ $sl + 1 }}</td>
                                    <td>{{ $inventory->rel_to_product->product_name }}</td>
                                    <td>{{ $inventory->rel_to_color->color_name }}</td>
                                    <td>{{ $inventory->rel_to_size->size_name }}</td>
                                    <td>
                                        {{ $inventory->quantity }}
                                    </td>
                                    <td>
                                        <a href="{{ route('del.inventory', $inventory->id) }}"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card" style="margin-top: 100px;">
                    <div class="card-header">
                        <h3 class="mt-3">
                            Add Inventory
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('inventory.store') }}" method="POST" class="form-horizontal">
                            @csrf

                            @if (session('inventory'))
                                <div class="alert alert-success">
                                    {{ session('inventory') }}
                                </div>
                            @endif

                            <div class="form-group">
                                <input type="hidden" value="{{ $product_info->id }}" name="product_id">
                                <input readonly type="text" value="{{ $product_info->product_name }}"
                                    class="form-control bg-secondary text-white">
                            </div>
                            <div class="mb-3 form-group">
                                <select name="color_id" class="form-control">
                                    <option>-- Select Color --</option>
                                    @foreach ($colors as $color)
                                        <option value="{{ $color->id }}">
                                            {{ $color->color_name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="mb-3 form-group">
                                <select name="size_id" class="form-control">
                                    <option>-- Select Size --</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->id }}">
                                            {{ $size->size_name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="form-group mb-3">
                                <input type="number" name="quantity" placeholder="Quantity" class="form-control">
                                @error('quantity')
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
