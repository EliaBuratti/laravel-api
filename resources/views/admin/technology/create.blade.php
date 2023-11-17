@extends('layouts.app')
@section('content')
    <div class="container mt-4">

        {{-- @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>Warning!</strong> {{ $error }}
                </div>
            @endforeach

  {{ dd($errors->all()) }} 
        @endif --}}

        <form action="{{ route('admin.technology.store') }}" method="POST" class="needs-validation">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Technology name:</label>
                <input type="text" class="form-control @error('name') is-invalid  @enderror" name="name" id="name"
                    placeholder="Write new type" value="{{ old('name') }}">
                @error('name')
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Attenzione!</strong> {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="action mt-4 w-100 d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Create</button>
                <a class="btn btn-success" href="{{ route('admin.technology.index') }}">Go back</a>
            </div>
        </form>
    </div>
@endsection
