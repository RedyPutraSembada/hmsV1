@extends('layouts.app')

@section('content')
    <div class="main-content position-relative max-height-vh-100 h-100">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('price-rate-type.update', $priceRateType->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex align-items-center">
                                    <p class="mb-0">Master Data <i class="bi bi-chevron-right"></i> {{ $title }}</p>
                                    <button class="btn btn-primary btn-sm ms-auto" type="submit">Save</button>
                                </div>
                            </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Price</label>
                                        <input class="form-control @error('price') is-invalid @enderror" type="number" name="price" value="{{ old('price', $priceRateType->price) }}">
                                        @error('price')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Extra Adult</label>
                                        <input class="form-control @error('extra_adult') is-invalid @enderror" type="number" name="extra_adult" value="{{ old('extra_adult', $priceRateType->extra_adult) }}">
                                        @error('extra_adult')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Extra Child</label>
                                        <input class="form-control @error('extra_child') is-invalid @enderror" type="number" name="extra_child" value="{{ old('extra_child', $priceRateType->extra_child) }}">
                                        @error('extra_child')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Room Type</label>
                                        <select class="form-select" aria-label="Default select example" name="id_room_type">
                                            <option value="" selected>Open this select room type</option>
                                            @foreach ($roomTypes as $roomType)
                                                @if(old('id_room_type', $priceRateType->id_room_type) == $roomType->id)
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
                                        <label>Type Day</label>
                                        <select class="form-select" aria-label="Default select example" name="type_day">
                                            <option value="" selected>Open this select menu</option>
                                            @if ($priceRateType->type_day == "Daily")
                                                <option value="Daily" selected>Daily</option>
                                                <option value="Weekend">Weekend</option>
                                                <option value="Weekday">Weekday</option>
                                            @elseif ($priceRateType->type_day == "Weekend")
                                                <option value="Daily">Daily</option>
                                                <option value="Weekend" selected>Weekend</option>
                                                <option value="Weekday">Weekday</option>
                                            @elseif ($priceRateType->type_day == "Weekday")
                                                <option value="Daily">Daily</option>
                                                <option value="Weekend">Weekend</option>
                                                <option value="Weekday" selected>Weekday</option>
                                            @endif
                                        </select>
                                        @error('type_day')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status Rate Type</label>
                                        <select class="form-select" aria-label="Default select example" name="id_status_rate_type">
                                            <option value="">Open this select type day</option>
                                            @foreach ($statusRateTypes as $statusRateType)
                                            @if ($statusRateType->id == $priceRateType->id_status_rate_type)
                                                <option value="{{ $statusRateType->id }}" selected>{{ $statusRateType->name }}</option>
                                            @else
                                                <option value="{{ $statusRateType->id }}">{{ $statusRateType->name }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        @error('id_status_rate_type')
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
