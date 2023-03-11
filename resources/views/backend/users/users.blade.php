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



    </div>
@endsection

@section('footer_script')
    <script>
        $("#checkAll").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endsection
