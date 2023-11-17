@extends('layouts.admin')

@section('content')
    <main>
        <div class="container-fluid mt-4">

            <h2 class="fs-4 text-secondary my-4">
                {{ __('Technology lists') }}
            </h2>

            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>Success!</strong> {{ session('message') }}
                </div>
            @endif

            <div class="comic-list mt-3">
                <button class="btn btn-primary">
                    <a class="nav-link" href="{{ route('admin.technology.create') }}">New technology</a>
                </button>
                <table class="table my-4 border">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($technologies as $technology)
                            <tr class="table-primary">
                                <th scope="row">{{ $technology->id }}</th>
                                <td>{{ $technology->name }}</td>
                                <td>
                                    <a href="{{ route('admin.technology.show', $technology->slug) }}"
                                        class="btn btn-primary">View</a>
                                    <a href="{{ route('admin.technology.edit', $technology->slug) }}"
                                        class="btn btn-secondary">Edit</a>


                                    <!-- Modal trigger button -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#modalId-{{ $technology->id }}">
                                        Delete
                                    </button>

                                    <!-- Modal Body -->
                                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                    <div class="modal fade" id="modalId-{{ $technology->id }}" tabindex="-1"
                                        data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                        aria-labelledby="modalTitle-{{ $technology->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalTitleId-{{ $technology->id }}">
                                                        {{ $technology->id }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Warning! Are you sure to delete this technology?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">No!</button>
                                                    <form
                                                        action="{{ route('admin.technology.destroy', $technology->slug) }}"
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
                {{ $technologies->links('pagination::bootstrap-5') }}
            </div>


        </div>
    </main>
@endsection
