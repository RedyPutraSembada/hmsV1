@extends('layouts.app')

@section('content')
    <div class="main-content position-relative max-height-vh-100 h-100">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('room.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex align-items-center">
                                    <p class="mb-0">Front Desk <i class="bi bi-chevron-right"></i> {{ $title }}</p>
                                    <button class="btn btn-primary btn-sm ms-auto" type="submit">Save</button>
                                </div>
                            </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Name Room</label>
                                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}">
                                        @error('name')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Capacity</label>
                                        <input class="form-control @error('capacity') is-invalid @enderror" type="number" name="capacity" value="{{ old('capacity') }}">
                                        @error('capacity')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Room Type</label>
                                        <select class="form-select" name="id_room_type">
                                            <option value="">room type</option>
                                            @foreach ($roomTypes as $roomType)
                                                @if(old('id_room_type') == $roomType->id)
                                                    <option value="{{ $roomType->id }}" selected>{{ $roomType->name }}</option>
                                                @else
                                                    <option value="{{ $roomType->id }}">{{ $roomType->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('id_room_type')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status Room</label>
                                        <select class="form-select" name="id_status_room">
                                            <option value="">status room</option>
                                            @foreach ($statusRooms as $statusRoom)
                                                @if(old('id_status_room') == $statusRoom->id)
                                                    <option value="{{ $statusRoom->id }}" selected>{{ $statusRoom->name }}</option>
                                                @else
                                                    <option value="{{ $statusRoom->id }}">{{ $statusRoom->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('id_status_room')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Kode Room</label>
                                        <input class="form-control @error('kode_room') is-invalid @enderror" type="text" name="kode_room" value="{{ old('kode_room') }}">
                                        @error('kode_room')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Floor</label>
                                        <input class="form-control @error('floor') is-invalid @enderror" type="number" name="floor" value="{{ old('floor') }}">
                                        @error('floor')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Active</label>
                                        <select class="form-select" aria-label="Default select example" name="status_sewa">
                                            <option value="">status room</option>
                                            <option value="0">Non-Active</option>
                                            <option value="1">Active</option>
                                        </select>
                                        @error('status_sewa')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection
