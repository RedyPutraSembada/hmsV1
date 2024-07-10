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
                                        <label>Floor Room</label>
                                        <select class="form-select" name="id_floor">
                                            <option value="">floor room</option>
                                            @foreach ($floors as $floor)
                                                @if(old('id_floor') == $floor->id)
                                                    <option value="{{ $floor->id }}" selected>{{ $floor->name }}</option>
                                                @else
                                                    <option value="{{ $floor->id }}">{{ $floor->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('id_floor')
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
                                <div class="table-responsive">
                                    <table class="table" id="table_amanities">
                                        <tr>
                                            <th width="100px"></th>
                                            <th width="100px"></th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td><input class="btn btn-danger" name="remove" id="remove" value="Remove" type="button"></input>
                                            </td><td><label for="example-text-input" class="form-control-label">Add Amanities :</label></td>
                                            <td><select class="form-select" aria-label="Default select example" name="id_additional_item[]">
                                                <option value="" selected>amanities</option>
                                                @foreach ($additionalItems as $additionalItem)
                                                <option value="{{ $additionalItem->id }}">{{ $additionalItem->name }} [Qty : {{ $additionalItem->qty }}]</option>
                                                @endforeach
                                            </select>
                                            <td><input class="form-control" type="number" name="qty_item[]" id="tab1"></td>
                                        </tr>
                                    </table>
                                    <div class="text-end">
                                        <input type="button" name="addAmanities" id="addAmanities" value="Add" class="btn btn-success">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            var amanities = '<tr><td><input class="btn btn-danger" name="remove" id="remove" value="Remove" type="button"></input></td><td><label for="example-text-input" class="form-control-label">Add Amanities :</label></td><td><select class="form-select" aria-label="Default select example" name="id_additional_item[]"><option value="" selected>amanities</option>@foreach ($additionalItems as $additionalItem)<option value="{{ $additionalItem->id }}">{{ $additionalItem->name }} [Qty : {{ $additionalItem->qty }}]</option>@endforeach</select><td><input class="form-control" type="number" name="qty_item[]" id="tab1"></td></tr>';
            var max = 10;
            var x = 0;

            $("#addAmanities").click(function(){
                console.log('Hello');
                if(x <= max){
                    $("#table_amanities").append(amanities);
                    x++;
                }
            })

            $("#table_amanities").on('click', '#remove', function() {
                $(this).closest('tr').remove();
                x--;
            })
        })
    </script>
@endsection
