@extends('layouts.admin')

@section('content')
    <main>
        <div class="container-fluid mt-4">

            <h2 class="fs-4 text-secondary my-4">
                {{ __('Projects list') }}
            </h2>

            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>Success!</strong> {{ session('message') }}
                </div>
            @endif

            <div class="comic-list mt-3">
                <button class="btn btn-primary">
                    <a class="nav-link" href="{{ route('admin.project.create') }}">Add project</a>
                </button>
                <table class="table my-4 border">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Type</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($projects as $project)
                            <tr class="table-primary">
                                <th scope="row">{{ $project->id }}</th>
                                <td>
                                    <img width="150" src="{{ asset('storage/' . $project->cover_image) }}"
                                        alt="{{ $project->title }}">
                                </td>
                                <td>{{ $project->title }}</td>

                                <td>
                                    {{ $project->type ? $project->type->name : 'Nothing type selected' }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.project.show', $project->slug) }}"
                                        class="btn btn-primary">View</a>
                                    <a href="{{ route('admin.project.edit', $project->slug) }}"
                                        class="btn btn-secondary">Edit</a>


                                    <!-- Modal trigger button -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#modalId-{{ $project->id }}">
                                        Delete
                                    </button>

                                    <!-- Modal Body -->
                                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                    <div class="modal fade" id="modalId-{{ $project->id }}" tabindex="-1"
                                        data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                        aria-labelledby="modalTitle-{{ $project->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalTitleId-{{ $project->id }}">
                                                        {{ $project->id }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Warning! Are you sure to delete this project?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">No!</button>
                                                    <form action="{{ route('admin.project.destroy', $project->slug) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Yes!</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>Nothing to see.</td>
                            </tr>
                        @endforelse



                    </tbody>
                </table>
                {{ $projects->links('pagination::bootstrap-5') }}
            </div>


        </div>
    </main>
@endsection
