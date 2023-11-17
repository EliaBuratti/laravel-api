@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('Dashboard') }}
        </h2>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Total project</div>

                    <div class="card-body text-center">
                        <strong>{{ count($projects) }} Projects</strong>

                        <a class="btn btn-outline-primary d-block mt-3" href="{{ route('admin.project.index') }}">View all
                            project</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Total users') }}</div>

                    <div class="card-body text-center">
                        <strong>Users: </strong>
                        {{ $total_users }}
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Admin Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        Welcome {{ Auth::user()->name }}!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
