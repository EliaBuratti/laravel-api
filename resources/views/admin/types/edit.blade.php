@extends('layouts.app')

@section('content')
    <main>
        <div class="container mt-4">

            <h2 class="fs-4 text-secondary my-4">
                {{ __('Update type: ' . $type->name) }}
            </h2>

            <form action="{{ route('admin.type.update', $type) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Type name:</label>
                    <input type="text" class="form-control @error('name') is-invalid  @enderror" name="name"
                        id="name" placeholder="Write new type" value="{{ $type->name }}">
                    @error('name')
                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Attenzione!</strong> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="action mt-4 w-100 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a class="btn btn-success" href="{{ route('admin.type.index') }}">Go back</a>
                </div>
            </form>
        </div>
    </main>
@endsection
