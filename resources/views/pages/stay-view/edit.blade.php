@extends('layouts.app')

@section('content')
    <div class="main-content position-relative max-height-vh-100 h-100">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('room.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
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
                                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name', $room->name) }}">
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
                                                @if(old('id_floor', $room->id_floor) == $floor->id)
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
                                            <option value="">Room Type</option>
                                            @foreach ($roomTypes as $roomType)
                                                @if(old('id_room_type', $room->id_room_type) == $roomType->id)
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
                                            <option value="">Open this select room type</option>
                                            @foreach ($statusRooms as $statusRoom)
                                                @if(old('id_status_room', $room->id_status_room) == $statusRoom->id)
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
                                        <input class="form-control @error('kode_room') is-invalid @enderror" type="text" name="kode_room" value="{{ old('kode_room', $room->kode_room) }}">
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
                                            @if ($room->status_sewa == 0)
                                            <option value="0" selected>Non-Active</option>
                                            <option value="1">Active</option>
                                            @elseif ($room->status_sewa == 1)
                                            <option value="0">Non-Active</option>
                                            <option value="1" selected>Active</option>
                                            @endif
                                        </select>
                                        @error('status_room')
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
                                        @if (count($room->DetilRoomAmanities) > 0)
                                            @foreach ($room->DetilRoomAmanities as $value)
                                                <tr>
                                                    <td><input class="btn btn-danger" name="remove" id="remove" value="Remove" type="button"></input>
                                                    </td><td><label for="example-text-input" class="form-control-label">Add Amanities :</label></td>
                                                    <td><select class="form-select" aria-label="Default select example" name="id_additional_item[]">
                                                        <option value="" selected>amanities</option>
                                                        @foreach ($additionalItems as $additionalItem)
                                                            @if ($additionalItem->id == $value->id_additional_item )
                                                                <option value="{{ $additionalItem->id }}" selected>{{ $additionalItem->name }} [Qty : {{ $additionalItem->qty }}]</option>
                                                                @else
                                                                <option value="{{ $additionalItem->id }}">{{ $additionalItem->name }} [Qty : {{ $additionalItem->qty }}]</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <td>
                                                        <input type="hidden" name="id_detil_room_amanities[]" value="{{ $value->id }}">
                                                        <input class="form-control" type="number" name="qty_item[]" id="tab1" value="{{ old('qty_item', $value->qty_item) }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <input type="hidden" name="id_detil_room_amanities[]" value="">
                                                <td><input class="btn btn-danger" name="remove" id="remove" value="Remove" type="button"></input>
                                                </td><td><label for="example-text-input" class="form-control-label">Add Amanities :</label></td>
                                                <td><select class="form-select" aria-label="Default select example" name="id_additional_item[]">
                                                    <option value="" selected>amanities</option>
                                                    @foreach ($additionalItems as $additionalItem)
                                                    <option value="{{ $additionalItem->id }}">{{ $additionalItem->name }} [Qty : {{ $additionalItem->qty }}]</option>
                                                    @endforeach
                                                </select>
                                                <td>
                                                    <input type="hidden" name="id_detil_room_amanities[]" value="">
                                                    <input class="form-control" type="number" name="qty_item[]" id="tab1"></td>
                                            </tr>
                                        @endif
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
            var amanities = '<tr><td><input class="btn btn-danger" name="remove" id="remove" value="Remove" type="button"></input></td><td><label for="example-text-input" class="form-control-label">Add Amanities :</label></td><td><select class="form-select" aria-label="Default select example" name="id_additional_item[]"><option value="" selected>amanities</option>@foreach ($additionalItems as $additionalItem)<option value="{{ $additionalItem->id }}">{{ $additionalItem->name }} [Qty : {{ $additionalItem->qty }}]</option>@endforeach</select><td><input type="hidden" name="id_detil_room_amanities[]" value=""><input class="form-control" type="number" name="qty_item[]" id="tab1"></td></tr>';
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
