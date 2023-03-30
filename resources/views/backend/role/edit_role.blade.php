@extends('layouts.dashboard')

@section('content')
    <div class="container" style="margin-top: 100px;">
        <div class="col-lg-8 m-auto col-sm-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mt-3">Edit Role</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('role.update') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Role</label>
                            <input type="text" readonly value="{{ $roles->name }}" class="form-control">
                            <input type="hidden" name="role_id" value="{{ $roles->id }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <h5>Select Permission</h5>
                            @foreach ($permissions as $permission)
                                <div>
                                    <input {{ $roles->hasPermissionTo($permission->name) ? 'checked' : '' }} type="checkbox"
                                        name="permission[]" value="{{ $permission->id }}">
                                    {{ $permission->name }}
                                </div>
                            @endforeach

                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
