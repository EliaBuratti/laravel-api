@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('Showing type: ' . $type->name) }}
        </h2>

        <div class="my-4">
            <div class="card col-6 p-4 mx-auto">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Name: </strong> {{ $type->name }}</li>
                    <li class="list-group-item"><strong>Slug: </strong> {{ $type->slug }}</li>
                    <li class="list-group-item"><strong>Created: </strong> {{ $type->created_at }}</li>
                    <li class="list-group-item"><strong>Updated: </strong> {{ $type->updated_at }}</li>
                </ul>
            </div>
        </div>
        <div class="action mt-4 text-end">
            <a class="btn btn-success" href="{{ route('admin.type.index') }}">Go back</a>
        </div>
    </div>
@endsection
