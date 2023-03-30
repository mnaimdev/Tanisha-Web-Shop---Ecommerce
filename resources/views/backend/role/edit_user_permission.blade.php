@extends('layouts.dashboard')

@section('content')
    <div class="container" style="margin-top: 100px;">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="mt-3 text-center">Update User Permission</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('update.user.permission') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <div class="bg-dark p-3 text-white d-flex justify-content-between">
                                <span>{{ $users->name }}</span>
                                <span class="badge badge-secondary">{{ $roles->first() }}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="user_id" value="{{ $users->id }}">
                            @foreach ($permissions as $permission)
                                <div>
                                    <input {{ $users->hasPermissionTo($permission) ? 'checked' : '' }} type="checkbox"
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
