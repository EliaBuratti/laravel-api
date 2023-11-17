@extends('layouts.app')

@section('content')
    <main>
        <div class="container mt-4">

            <h1>Update your project!</h1>

            <form action="{{ route('admin.project.update', $project) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">Project Title:</label>
                    <input type="text" class="form-control @error('title') is-invalid  @enderror" name="title"
                        id="title" placeholder="Write project title" value="{{ $project->title }}">
                    @error('title')
                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Attenzione!</strong> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <textarea class="form-control @error('description') is-invalid  @enderror" name="description" id="description">{{ $project->description }}</textarea>
                    @error('description')
                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Attenzione!</strong> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="cover_image" class="form-label d-block">Cover image:</label>

                    <img width="150" src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}">

                    <input type="file" class="form-control mt-2 @error('cover_image') is-invalid  @enderror"
                        name="cover_image" id="cover_image" placeholder="cover image">
                    @error('cover_image')
                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Attenzione!</strong> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="skills" class="form-label">Skills:</label>
                    <input type="text" class="form-control @error('skills') is-invalid  @enderror" name="skills"
                        id="skills" placeholder="Your skills " value="{{ $project->skills }}">
                    @error('skills')
                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Attenzione!</strong> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="type_id" class="form-label">Type of project:</label>
                    <select class="form-select @error('type_id') is-invalid  @enderror" aria-label="Default select example"
                        name="type_id" id="type_id">
                        <option selected disabled>Open this select menu</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}"
                                {{ $type->id === old('type_id', $project->type_id) ? 'selected' : '' }}>
                                {{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="technologies" class="form-label">Technologies of project:</label>
                    <select class="form-select @error('type_id') is-invalid  @enderror" multiple
                        aria-label="multiple select example" name="technologies[]" id="technologies">
                        <option disabled>Nothing selected</option>
                        @foreach ($technologies as $technology)
                            @if ($errors->any())
                                <option value="{{ $technology->id }}"
                                    {{ in_array($technology->id, old('technologies', [])) ? 'selected' : '' }}>
                                    {{ $technology->name }}
                                </option>
                            @else
                                <option value="{{ $technology->id }}"
                                    {{ $project->technology->contains($technology) ? 'selected' : '' }}>
                                    {{ $technology->name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    @error('technologies')
                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Attenzione!</strong> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="project_link" class="form-label">Project link:</label>
                    <input type="text" class="form-control @error('project_link') is-invalid  @enderror"
                        name="project_link" id="project_link" placeholder="project_link of comic book"
                        value="{{ $project->project_link }}">
                    @error('project_link')
                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Attenzione!</strong> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="github_link" class="form-label">Github link:</label>
                    <input type="text" class="form-control @error('github_link') is-invalid  @enderror"
                        name="github_link" id="github_link" placeholder="Link of your GitHub project page"
                        value="{{ $project->project_link }}">
                    @error('github_link')
                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Attenzione!</strong> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="action mt-4 w-100 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a class="btn btn-success" href="{{ route('admin.project.index') }}">Go back</a>
                </div>
            </form>
        </div>
    </main>
@endsection
