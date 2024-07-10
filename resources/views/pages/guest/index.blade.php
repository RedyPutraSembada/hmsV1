@extends('layouts.app')

@section('content')
<main class="main-content position-relative border-radius-lg ">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <h6>Master Data <i class="bi bi-chevron-right"></i> {{ $title }}</h6>
                        <a href="{{ route('guest.create') }}" class="btn btn-primary btn-sm ms-auto">Create</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Images Guest</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Guest Type</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Full Name</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Gender</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Occupation</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Email</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Phone Number</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Identity Card type</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Identity Card Number</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Nationality</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">State</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($guests as $guest)
                        <tr>
                            <td>
                                <div class="d-flex px-5 py-1">
                                    <img src="{{ asset('storage/' . $guest->image) }}" class="avatar avatar-sm me-3" alt="image">
                                </div>
                            </td>
                            <td>
                                <p class="align-middle text-center text-sm mt-0 mb-0">{{ $guest->guest_type}}</p>
                            </td>
                            <td>
                                <p class="align-middle text-center text-sm mt-0 mb-0">{{ $guest->full_name}}</p>
                            </td>
                            <td>
                                <p class="align-middle text-center text-sm mt-0 mb-0">{{ $guest->gender}}</p>
                            </td>
                            <td>
                                <p class="align-middle text-center text-sm mt-0 mb-0">{{ $guest->Accupation->name}}</p>
                            </td>
                            <td>
                                <p class="align-middle text-center text-sm mt-0 mb-0">{{ $guest->email}}</p>
                            </td>
                            <td>
                                <p class="align-middle text-center text-sm mt-0 mb-0">{{ $guest->phone}}</p>
                            </td>
                            <td>
                                <p class="align-middle text-center text-sm mt-0 mb-0">{{ $guest->identity_card_type}}</p>
                            </td>
                            <td>
                                <p class="align-middle text-center text-sm mt-0 mb-0">{{ $guest->identity_card_number}}</p>
                            </td>
                            <td>
                                <p class="align-middle text-center text-sm mt-0 mb-0">{{ $guest->nationality}}</p>
                            </td>
                            <td>
                                <p class="align-middle text-center text-sm mt-0 mb-0">{{ $guest->state}}</p>
                            </td>
                            <td class="align-middle text-center">
                                <div class="row justify-content-center">
                                    <div class="col-md">
                                        <div class="button-container">
                                            <a href="{{ route('guest.edit', $guest->id) }}" class="custom-button mt-2">
                                                Edit
                                            </a>
                                        </div>
                                        <div class="button-container">
                                            <form onsubmit="return confirm('Apakah yakin untuk s data tersebut??');" action="{{ route('guest.destroy', $guest->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="custom-button-delete mt-2 mb-4">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
