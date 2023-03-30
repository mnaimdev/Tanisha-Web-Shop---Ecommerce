@extends('layouts.dashboard')

@section('content')
    <div class="container" style="margin-top: 100px;">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mt-3 text-center">Role List</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>SL</th>
                            <th>Role</th>
                            <th>Permission</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($roles as $sl => $role)
                            <tr>
                                <td>{{ $sl + 1 }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @foreach ($role->getPermissionNames() as $permission)
                                        <span class="badge badge-secondary my-2">{{ $permission }}</span>
                                    @endforeach
                                </td>
                                <td class="d-flex">
                                    <a href="{{ route('edit.role', $role->id) }}" class="btn btn-primary mx-2">Edit</a>

                                    <a href="{{ route('remove.role', $role->id) }}" class="btn btn-danger mx-2">X</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="mt-3">Add Role</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('role.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Role</label>
                            <input type="text" name="role" class="form-control">
                        </div>
                        <div class="form-group">
                            <h5>Select Permission</h5>
                            @foreach ($permissions as $permission)
                                <div>
                                    <input type="checkbox" name="permission[]" value="{{ $permission->id }}">
                                    {{ $permission->name }}
                                </div>
                            @endforeach

                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="mt-3">Add Permission</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('permission.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Permission</label>
                            <input type="text" name="permission" class="form-control">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}
    </div>
@endsection
