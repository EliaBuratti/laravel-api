@extends('layouts.admin')

@section('content')
    <main>
        <div class="container-fluid mt-4">

            <h2 class="fs-4 text-secondary my-4">
                {{ __('Lead lists') }}
            </h2>

            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>Success!</strong> {{ session('message') }}
                </div>
            @endif

            <div class="comic-list mt-3">
                <table class="table my-4 border">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mails as $mail)
                            <tr class="table-primary">
                                <th scope="row">{{ $mail->id }}</th>
                                <td>{{ $mail->name }}</td>
                                <td class="d-flex align-items-center ">
                                    <div class="eb_show-message">
                                        <!-- Modal trigger button -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modalId-{{ $mail->id }}">
                                            Show
                                        </button>


                                        {{-- modal test --}}
                                        <div class="modal fade" id="modalId-{{ $mail->id }}" tabindex="-1"
                                            data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                            aria-labelledby="modalTitle-{{ $mail->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTitleId-{{ $mail->id }}">
                                                            Email:
                                                            {{ $mail->email }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mt-3">
                                                            Subject: {{ $mail->object }}
                                                        </div>
                                                        <div class="mt-3">
                                                            Message:
                                                            <p class="mt-1">{{ $mail->message }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>

                                                        <button class="btn btn-primary"
                                                            data-bs-target="#exampleModalToggle2"
                                                            data-bs-toggle="modal">Response</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="exampleModalToggle2" aria-hidden="true"
                                            aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Response
                                                            to: {{ $mail->email }}
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.mail.store') }}" method="POST">
                                                            <input type="hidden" class="form-control" name="name"
                                                                id="name" aria-describedby="helpId"
                                                                value="{{ $mail->name }}">
                                                            <div class="mb-3">
                                                                <input type="text" class="form-control" name="object"
                                                                    id="object" aria-describedby="helpId"
                                                                    placeholder="Subject"
                                                                    value="RESPONSE CONTACT: {{ $mail->object }}">
                                                                <small id="helpId" class="form-text text-muted">Write an
                                                                    subject</small>
                                                                {{--           va controllata la modale con gli errori                                                      <div class="alert alert-danger" role="alert"
                                                                    v-if="errors.object">
                                                                    <strong>Errors!</strong>
                                                                    <span
                                                                        v-for="message in errors.object">{{ message }}</span>
                                                                </div> --}}

                                                            </div>
                                                            <input type="hidden" class="form-control" name="email"
                                                                id="email" value="{{ $mail->email }}">
                                                            <div class="mb-3">
                                                                <label for="message" class="form-label">Your
                                                                    Response</label>
                                                                <textarea class="form-control" name="message" id="message" rows="10" cols="50"></textarea>

                                                            </div>

                                                            <button type="submit"
                                                                class="btn btn-dark rounded-0">Send</button>
                                                            <form action="{{ route('admin.assistant', $mail->id) }}"
                                                                method="get">

                                                                <button type="submit" class="btn btn-info">Generate
                                                                    response</button>
                                                            </form>
                                                        </form>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary"
                                                            data-bs-target="#modalId-{{ $mail->id }}"
                                                            data-bs-toggle="modal">Go back</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- modal test end --}}

                                        <!-- Modal Body -->
                                        {{--                                         <div class="modal fade" id="modalId-{{ $mail->id }}" tabindex="-1"
                                            data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                            aria-labelledby="modalTitle-{{ $mail->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTitleId-{{ $mail->id }}">
                                                            {{ $mail->email }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ $mail->message }}


                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="mb-3">
                                                            <label for="response" class="form-label">Message</label>
                                                            <input type="text" class="form-control" name="response"
                                                                id="response" aria-describedby="response-message"
                                                                placeholder="Type your response here" />
                                                            <small id="response-message"
                                                                class="form-text text-muted">Respond to
                                                                {{ $mail->email }}</small>
                                                        </div>

                                                        <div class="content-lead">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>

                                                            <form action="{{ route('admin.assistant', $mail->id) }}"
                                                                method="get">

                                                                <button type="submit" class="btn btn-info">Generate
                                                                    response</button>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>

                                    <div class="eb_delete">
                                        <button type="button"
                                            class="btn btn-danger border-0 d-flex justify-content-between align-items-center p-2 rounded-3"
                                            data-bs-toggle="modal" data-bs-target="#modalId-delete-{{ $mail->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                <path
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                            </svg>
                                        </button>

                                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                        <div class="modal fade" id="modalId-delete-{{ $mail->id }}" tabindex="-1"
                                            data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                            aria-labelledby="modalTitleId-{{ $mail->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                                role="document">

                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title d-flex justify-content-center align-items-center gap-3 w-100"
                                                            id="modalTitleId-{{ $mail->id }}">
                                                            <i class="fa-solid fa-triangle-exclamation text-warning"></i>
                                                            Warning <i
                                                                class="fa-solid fa-triangle-exclamation text-warning"></i>
                                                        </h5>
                                                    </div>
                                                    {{-- /.modal-header --}}

                                                    <div class="modal-body">
                                                        Are you sure to delete? Irreversible action.
                                                    </div>
                                                    {{-- /.modal-body --}}

                                                    <div
                                                        class="modal-footer d-flex justify-content-center align-items-center gap-3">

                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>

                                                        <form action="{{ route('admin.mail.destroy', $mail->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Confirm</button>
                                                        </form>

                                                    </div>
                                                    {{-- /.modal-footer --}}

                                                </div>
                                                {{-- /.modal-content --}}

                                            </div>
                                            {{-- /.modal-dialog --}}
                                        </div>
                                        {{-- /.modal --}}




                                </td>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>Nothing to see.</td>
                            </tr>
                        @endforelse



                    </tbody>
                </table>
                {{ $mails->links('pagination::bootstrap-5') }}
            </div>


        </div>
    </main>
@endsection


{{-- @vite(['resources/js/ai-assistant.js'])
 --}}
