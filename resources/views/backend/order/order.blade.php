@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="col-lg-12">
            <div class="card" style="margin-top: 100px;">
                <div class="card-header">
                    <h3 class="mt-3">Orders List</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>SL</th>
                            <th>Order Id</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($orders as $sl => $order)
                            <tr>
                                <td>{{ $sl + 1 }}</td>
                                <td>{{ $order->order_id }}</td>
                                <td>
                                    @php
                                        if ($order->status == 0) {
                                            echo 'Placed';
                                        } elseif ($order->status == 1) {
                                            echo 'Packaging';
                                        } elseif ($order->status == 2) {
                                            echo 'Shipped';
                                        } elseif ($order->status == 3) {
                                            echo 'Ready to Deliver';
                                        } elseif ($order->status == 4) {
                                            echo 'Delivered';
                                        }
                                    @endphp
                                </td>
                                <td>TK {{ $order->total }}</td>
                                <td>
                                    <form action="{{ route('order.status') }}" method="POST">
                                        @csrf

                                        <button class=" btn-info" type="submit" name="status"
                                            value="{{ $order->order_id . ',' . '0' }}">Placed</button>

                                        <button class=" btn-dark" type="submit" name="status"
                                            value="{{ $order->order_id . ',' . '1' }}">Packaging</button>

                                        <button class=" btn-secondary" type="submit" name="status"
                                            value="{{ $order->order_id . ',' . '2' }}">Shipped</button>

                                        <button class=" btn-danger" type="submit" name="status"
                                            value="{{ $order->order_id . ',' . '3' }}">Ready to Deliver</button>

                                        <button class=" btn-primary" type="submit" name="status"
                                            value="{{ $order->order_id . ',' . '4' }}">Delivered</button>

                                    </form>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
