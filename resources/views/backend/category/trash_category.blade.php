@extends('layouts.dashboard')


@section('content')
    <div class="container" style="margin-top: 100px;">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mt-3">Trash Category</h3>
                </div>
                <div class="card-header">
                    <table class="table">
                        <tr>
                            <th>SL</th>
                            <th>Category Name</th>
                            <th>Category Image</th>
                            <th>Added By</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($trashes as $sl => $trash)
                            <tr>
                                <td>{{ $sl + 1 }}</td>
                                <td>{{ $trash->category_name }}</td>
                                <td>
                                    <img width="40" height="40" class="rounded-circle"
                                        src="{{ asset('/uploads/category') }}/{{ $trash->cat_img }}" alt="">
                                </td>
                                <td>
                                    {{ $trash->rel_to_user->name }}
                                </td>
                                <td>
                                    <a href="{{ route('category.trash.restore', $trash->id) }}"
                                        class="btn btn-primary mr-2">
                                        Restore
                                    </a>
                                    <a data-parent="{{ route('category.trash.delete', $trash->id) }}"
                                        class="btn btn-danger delete">
                                        <img width="16" src="{{ asset('/dashboard_assets/x.png') }}" alt="">
                                    </a>
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
    @if (session('category_delete'))
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
                icon: 'success',
                title: '{{ session('category_delete') }}'
            })
        </script>
    @endif

    @if (session('category_restore'))
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
                icon: 'success',
                title: '{{ session('category_restore') }}'
            })
        </script>
    @endif

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
                }
            });
        });
    </script>
@endsection
