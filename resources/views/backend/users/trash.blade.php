@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="col-lg-12">
            <form action="{{ route('check.trash') }}" method="POST">
                @csrf
                <div class="card" style="margin-top: 100px">
                    <div class="card-header d-flex justify-content-between py-2">
                        <h3 class="mt-2">Trash List</h3>
                        <p>
                            <button name="restore[]" class="btn btn-primary">Restore All</button>
                            <button name="delete[]" class="btn btn-danger">Delete All</button>
                        </p>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            @if (session('select'))
                                <div class="alert alert-info">
                                    {{ session('select') }}
                                </div>
                            @endif
                            @if (session('trash_restore'))
                                <div class="alert alert-info">
                                    {{ session('trash_restore') }}
                                </div>
                            @endif
                            @if (session('trash_delete'))
                                <div class="alert alert-info">
                                    {{ session('trash_delete') }}
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
                                            <img width="40" src="{{ Avatar::create($user->name)->toBase64() }}"
                                                alt="">
                                        @else
                                            <img width="40" class="h-100 rounded-circle"
                                                src="{{ asset('/uploads/users') }}/{{ $user->image }}" alt="">
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('trash.restore', $user->id) }}"
                                            class="btn btn-primary text-white">Restore</a>
                                        <a data-parent="{{ route('trash.restore', $user->id) }}"
                                            class="btn btn-danger text-white delete">Delete</a>
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
        $('.delete').click(function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    var link = $(this).attr('data-parent');
                    location.href = link;

                    Swal.fire(
                        'Deleted!',
                        'User has been Deleted',
                        'success'
                    );

                }
            })
        });
    </script>

    <script>
        $("#checkAll").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endsection
