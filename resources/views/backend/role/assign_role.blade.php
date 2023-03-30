@extends('layouts.dashboard')

@section('content')
    <div class="container" style="margin-top: 100px;">
        <div class="col-lg-12">
            <table class="table">
                <tr>
                    <th>SL</th>
                    <th>User</th>
                    <th>Role</th>
                    <th>Permission</th>
                    <th>Action</th>
                </tr>
                @foreach ($users as $sl => $user)
                    <tr>
                        <td>{{ $sl + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>
                            @forelse ($user->getRoleNames() as $role)
                                <span class="lead">{{ $role }}</span>
                            @empty
                                <span class="text-muted">N/A</span>
                            @endforelse
                        </td>
                        <td>
                            @forelse ($user->getAllPermissions() as $permission)
                                <span class="badge badge-secondary my-2">{{ $permission->name }}</span>
                            @empty
                                <span class="text-muted">N/A</span>
                            @endforelse
                        </td>
                        <td class="d-flex">
                            <a href="{{ route('user.edit.permission', $user->id) }}" class="btn btn-primary mx-2">
                                <img width="16" src="{{ asset('/dashboard_assets/pencil.png') }}" alt="">
                            </a>
                            <a href="{{ route('remove.user.role', $user->id) }}" class="btn btn-danger">X</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="mt-3">Assign Role</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.assign.role') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <select name="user_id" class="form-control">
                                <option>-- Select User --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <select name="role_id" class="form-control">
                                <option>-- Select Role --</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
