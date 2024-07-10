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
                        <a href="{{ route('status-room.create') }}" class="btn btn-primary btn-sm ms-auto">Create</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Image</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Name</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Main Status</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Operation</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($statusRooms as $statusRoom)
                        <tr>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <img src="{{ asset('storage/' . $statusRoom->image) }}" class="avatar avatar-sm me-3" alt="image">
                                </div>
                            </td>
                            <td>
                                <p class="align-middle text-center text-sm">{{ $statusRoom->name}}</p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0">{{ $statusRoom->main_status}}</p>
                            </td>
                            <td class="align-middle text-center">
                                <p class="text-xs font-weight-bold mb-0">{{ $statusRoom->operation}}</p>
                            </td>
                            <td class="align-middle text-center">
                                <div class="row justify-content-center mb-2">
                                    <div class="col-md">
                                        <div class="button-container">
                                            <a href="{{ route('status-room.edit', $statusRoom->id) }}" class="custom-button mt-2">
                                                Edit
                                            </a>
                                        </div>
                                        <div class="button-container">
                                            <form onsubmit="return confirm('Apakah yakin untuk menghapus data tersebut??');" action="{{ route('status-room.destroy', $statusRoom->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="custom-button-delete mt-2">Delete</button>
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
