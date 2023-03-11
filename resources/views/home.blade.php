@extends('layouts.dashboard')

@section('content')
    <div class="container" style="margin-top: 100px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mt-3">Dashboard</h3>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <p class="text-lg font-size-24we">Logged in, {{ Auth::user()->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
