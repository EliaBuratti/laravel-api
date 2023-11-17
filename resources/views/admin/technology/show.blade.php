@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('Showing technology: ' . $technology->name) }}
        </h2>

        <div class="my-4">
            <div class="card col-6 p-4 mx-auto">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Name: </strong> {{ $technology->name }}</li>
                    <li class="list-group-item"><strong>Slug: </strong> {{ $technology->slug }}</li>
                    <li class="list-group-item"><strong>Created: </strong> {{ $technology->created_at }}</li>
                    <li class="list-group-item"><strong>Updated: </strong> {{ $technology->updated_at }}</li>
                </ul>
            </div>
        </div>
        <div class="action mt-4 text-end">
            <a class="btn btn-success" href="{{ route('admin.technology.index') }}">Go back</a>
        </div>
    </div>
@endsection
