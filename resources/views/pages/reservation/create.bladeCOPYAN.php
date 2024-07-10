@extends('layouts.app')

@section('content')
    <div class="main-content position-relative max-height-vh-100 h-100">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <form action="/front-office/room-view/store" method="POST" enctype="multipart/form-data" id="AddPost">
                        @csrf
                        <div class="card-header pb-0">
                            <p class="mb-0 d-flex justify-content-start">Front Desk <i class="bi bi-chevron-right"></i> {{ $title }}</p>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-success btn-sm" style="margin-right: 5px" id="hitung" form="AddPost">create reservation</button>
                                <button class="btn btn-primary btn-sm" type="submit" id="buttonSave" style="display: none">Save</button>
                            </div>
                            <div class="alertt">
                            </div>
                        </div>
                        <div class="card-body">
                            <h4>Room Data</h4>
                            <input type="hidden" name="payment_paid" id="payment_paid">
                            <input type="hidden" name="total_payment_transaction" id="total_payment_transaction">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Room</label>
                                        <select class="form-select" name="id_room" id="id_room">
                                            <option value="">Select Room</option>
                                            @foreach ($rooms as $room)
                                                <option value="{{ $room->id }}" {{ old('id_room') == $room->id ? 'selected' : '' }}>{{ $room->name }} : {{  $room->kode_room }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Type Room</label>
                                        <input class="form-control" type="text" name="type_room" id="type_room" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Status Room</label>
                                        <input class="form-control" type="text" name="status_room" id="status_room" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Rate Type</label>
                                        <select class="form-select" name="id_price_rate_type" id="id_price_rate_type">
                                            <option value="">select rate type</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>

                        {{--  Data Guest  --}}
                        <div class="card mt-3">
                            <div class="card-body">
                                <h4>Guest Infomation</h4>
                        <ul class="nav nav-tabs" id="myTabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home">Insert Guest</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile">Select Guest</a>
                            </li>
                        </ul>

                        {{-- ? Insert Guest  --}}
                        <div class="tab-content mt-2">
                            <div class="tab-pane fade show active" id="home">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Full Name</label>
                                            <input class="form-control  " type="text" name="full_name" value="{{ old('full_name') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Image</label>
                                            <input class="form-control" type="file" name="image">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Guest Type</label>
                                            <select class="form-select" aria-label="Default select example" name="guest_type">
                                                <option value="" {{ old('guest_type') == '' ? 'selected' : '' }}>guest type</option>
                                                <option value="Regular" {{ old('guest_type') == 'Regular' ? 'selected' : '' }}>Regular</option>
                                                <option value="Repeat" {{ old('guest_type') == 'Repeat' ? 'selected' : '' }}>Repeat</option>
                                                <option value="VIP" {{ old('guest_type') == 'VIP' ? 'selected' : '' }}>VIP</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select class="form-select " aria-label="Default select example" name="gender">
                                                <option value="" {{ old('gender') == '' ? 'selected' : '' }}>guest type</option>
                                                <option value="Man" {{ old('gender') == 'Man' ? 'selected' : '' }}>Man</option>
                                                <option value="Woman" {{ old('gender') == 'Woman' ? 'selected' : '' }}>Woman</option>
                                                <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Occupation</label>
                                            <select class="form-select " name="id_occupation">
                                                <option value="">select occupations</option>
                                                @foreach ($occupations as $occupation)
                                                    @if(old('id_occupation') == $occupation->id)
                                                        <option value="{{ $occupation->id }}" selected>{{ $occupation->name }}</option>
                                                    @else
                                                        <option value="{{ $occupation->id }}">{{ $occupation->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Email</label>
                                            <input class="form-control" type="email" name="email" value="{{ old('email') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Phone Number</label>
                                            <input class="form-control" type="text" name="phone" value="{{ old('phone') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Postal</label>
                                            <input class="form-control" type="text" name="postal" value="{{ old('postal') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Country</label>
                                            <input class="form-control " type="text" name="country" value="{{ old('country') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Identity Card type</label>
                                            <select class="form-select " aria-label="Default select example" name="identity_card_type" id="identity_card_type">
                                                <option value="" {{ old('identity_card_type') == '' ? 'selected' : '' }}>guest type</option>
                                                <option value="KTP" {{ old('identity_card_type') == 'KTP' ? 'selected' : '' }}>KTP</option>
                                                <option value="SIM" {{ old('identity_card_type') == 'SIM' ? 'selected' : '' }}>SIM</option>
                                                <option value="Passport" {{ old('identity_card_type') == 'Passport' ? 'selected' : '' }}>Passport</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Identity Card Number</label>
                                            <input class="form-control " type="text" name="identity_card_number" value="{{ old('identity_card_number') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Exp Identity Card</label>
                                            <input class="form-control " type="date" name="exp_identity_card" id="exp_identity_card" value="{{ old('exp_identity_card') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-1" style="margin-top: 2.4%">
                                        <div class="form-group form-check">
                                                <label for="example-text-input" class="form-control-label">lasts forever</label>
                                                <input class="form-check-input" type="checkbox" name="exp_identity_card_forever" value="{{ old('exp_identity_card_forever') }}" id="exp_identity_card_forever">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Nationalityr</label>
                                            <input class="form-control " type="text" name="nationality" value="{{ old('nationality') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">State</label>
                                            <input class="form-control " type="text" name="state" value="{{ old('state') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">City</label>
                                            <input class="form-control " type="text" name="city" value="{{ old('city') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Birth Date</label>
                                            <input class="form-control  " type="date" name="birth_date" value="{{ old('birth_date') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">City Birth</label>
                                            <input class="form-control  " type="text" name="city_birth" value="{{ old('city_birth') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">State Birth</label>
                                            <input class="form-control  " type="text" name="state_birth" value="{{ old('state_birth') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Country Birth</label>
                                            <input class="form-control  " type="text" name="country_birth" value="{{ old('country_birth') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea class="form-control  " id="address" rows="3" name="address">{{ old('address') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--  ? Select Guest  --}}
                        <div class="tab-content mt-2">
                            <div class="tab-pane fade" id="profile">
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <select class="form-select" id="dropdown-search" aria-label="Default select example" name="id_guest" onchange="id_guestChanged()" style="width: 100%; height: 25px;">
                                        <option value="" selected>PiliH Guest</option>
                                        @foreach ($guests as $guest)
                                        <option value="{{ $guest->id }}">{{ $guest->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{--  <div class="form-group">
                                    <select class="form-select" id="myDropdown" style="width: 200px;">
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                    </select>
                                </div>  --}}
                            </div>
                        </div>
                    </div>

                        {{--  Setlement Option  --}}
                        <div class="card mt-3">
                            <div class="card-body">
                                <h4>Setlement Option</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select</label>
                                            <select class="form-select " aria-label="Default select example" name="type_transaction" id="type_transaction">
                                                <option value="" selected>Select Setlement</option>
                                                <option value="Cash">Cash</option>
                                                <option value="Credit">Credit</option>
                                                <option value="Partial Credit">Partial Credit</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Card Number</label>
                                            <input class="form-control" type="text" id="card_number" name="card_number" value="{{ old('card_number') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Exp Card</label>
                                            <input class="form-control" type="date" id="exp_card" name="exp_card" value="{{ old('exp_card') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Folio Number</label>
                                            <input class="form-control " type="text" id="folio_number" name="folio_number" value="{{ old('folio_number') }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--  Stay Information  --}}
                        <div class="card mt-3">
                            <div class="card-body">
                                <h4>Stay Information</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Check in</label>
                                            <input class="form-control  " type="date" name="arrival" value="{{ old('arrival') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Check out</label>
                                            <input class="form-control " type="date" name="departure" value="{{ old('departure') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Adults</label>
                                            <input class="form-control " type="number" name="total_orang_dewasa" value="{{ old('total_orang_dewasa') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Childs</label>
                                            <input class="form-control " type="number" name="total_anak" value="{{ old('total_anak') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">baby</label>
                                            <input class="form-control " type="number" name="total_bayi" value="{{ old('total_bayi') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="notes" class="form-label">Notes</label>
                                            <textarea class="form-control " id="notes" rows="3" name="notes">{{ old('notes') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--  Businees Source Setting  --}}
                        <div class="card mt-3">
                            <div class="card-body">
                                <h4>Businees Source Setting</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Market Place</label>
                                            <select class="form-select" name="id_travel_agent" id="id_travel_agent">
                                                <option value="">select travel agents</option>
                                                @foreach ($travelAgents as $travelAgents)
                                                    @if(old('id_travel_agent') == $travelAgents->id)
                                                        <option value="{{ $travelAgents->id }}" selected>{{ $travelAgents->name }}</option>
                                                    @else
                                                        <option value="{{ $travelAgents->id }}">{{ $travelAgents->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Source Travel Agent</label>
                                            <select class="form-select" name="id_source_travel_agent" id="id_source_travel_agent">
                                                <option value="">select source travel agents</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        {{--  Add Item  --}}
                        <div class="card mt-3">
                            <div class="card-body">
                                <h4 class="mb-0">Bonus Amanities</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped mt-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center text-uppercase text-secondary font-weight-bolder">Name Amenities</th>
                                                <th class="text-center text-uppercase text-secondary font-weight-bolder">Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody id="amenitiesTableBody">
                                            <!-- Tabel akan diperbarui dengan data yang sesuai -->
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row">
                                    <div class="table-responsive">
                                        <h4 class="mb-0">Add dditional items</h4>
                                        <form id="myForm">
                                            <table class="table" id="table_amanities">
                                                <thead class="" >
                                                    <tr>
                                                        <th width="100px"></th>
                                                        <th width="200px"></th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <button class="btn btn-danger" name="remove" id="remove" type="button">Remove</button>
                                                        </td>
                                                        <td>
                                                            <select class="form-select idi" aria-label="Default select example" id="id_additional_item" name="id_additional_item[]">
                                                                <option value="" selected>Select Amanities</option>
                                                                @foreach ($additionalItems as $additionalItem)
                                                                    <option value="{{ $additionalItem->id }}">{{ $additionalItem->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input class="form-control qi" type="number" placeholder="Qty Items" name="qty_item[]">
                                                        </td>
                                                        <td>
                                                            <input class="form-control td" type="number" placeholder="Total Days" name="total_days[]">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </form>
                                        <div class="text-end">
                                            <input type="button" name="addAmanities" id="addAmanities" value="Add" class="btn btn-success">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--  <div class="card mt-3">
                            <div class="card-body">
                                <h4>Notes</h4>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="notes" class="form-label">Notes</label>
                                        <textarea class="form-control  " id="notes" rows="3" name="notes">{{ old('notes') }}</textarea>


                                    </div>
                                </div>
                            </div>
                        </div>  --}}

                        {{-- ? Modal  --}}
                        <div class="modal fade" id="hasilHitung" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="hasilHitungLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="hasilHitungLabel">Transaction</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body px-0">
                                    <div style="overflow-y: hidden; height: calc(100vh - 15rem);">
                                    <div class="px-2" style="overflow-y: auto; height: 100%;">
                                    <div class="modalbodyy">

                                    </div>
                                    <div class="form-group p-2">
                                        <label for="example-text-input" class="form-control-label"><h4>Payment Paid : </h4></label>
                                        <input class="form-control " type="number" name="payment_paid_modal" id="payment_paid_modal" value="{{ old('payment_paid_modal') }}">
                                        <div class="pt-2" id="sisa_pembayaran"></div>
                                        <label for="example-text-input" class="form-control-label" id="status"></label>
                                    </div>
                                </div>
                            </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" id="bayarTagihan">Pay</button>
                                    <button type="submit" class="btn btn-primary" id="saveTagihan" style="display: none">Save</button>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('#id_room').on('change', function() {
            var roomId = $(this).val();
            if (roomId) {
                $.ajax({
                    url: '/get-room-amenities/' + roomId,
                    method: 'GET',
                    success: function(data) {
                        var amenitiesTableBody = $('#amenitiesTableBody');
                        amenitiesTableBody.empty();
                        if (data.length > 0) {
                            data.forEach(function(amenity) {
                                amenitiesTableBody.append(
                                    '<tr>' +
                                        '<td class="align-middle text-center text-sm">' + amenity.name + '</td>' +
                                        '<td class="align-middle text-center text-sm">' + amenity.qty + '</td>' +
                                    '</tr>'
                                );
                            });
                        } else {
                            amenitiesTableBody.append(
                                '<tr>' +
                                    '<td colspan="2" class="text-center">No amenities available</td>' +
                                '</tr>'
                            );
                        }
                    }
                });
            } else {
                $('#amenitiesTableBody').empty();
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#dropdown-search').select2();
        });
    </script>
    <script>
        document.getElementById('hitung').addEventListener('click', function() {
        // Cari form terdekat dari tombol
        var form = this.closest('form');

        // Ambil nilai dari field yang diperlukan
        const id_room = document.querySelector('select[name="id_room"]').value.trim();
        const type_transaction = document.querySelector('select[name="type_transaction"]').value.trim();
        const full_name = document.querySelector('[name="full_name"]').value.trim();
        const guest_type = document.querySelector('select[name="guest_type"]').value.trim();
        const gender = document.querySelector('select[name="gender"]').value.trim();
        const id_occupation = document.querySelector('select[name="id_occupation"]').value.trim();
        const email = document.querySelector('[name="email"]').value.trim();
        const phone = document.querySelector('[name="phone"]').value.trim();
        const postal = document.querySelector('[name="postal"]').value.trim();
        const country = document.querySelector('[name="country"]').value.trim();
        const identity_card_type = document.querySelector('select[name="identity_card_type"]').value.trim();
        const identity_card_number = document.querySelector('[name="identity_card_number"]').value.trim();
        const nationality = document.querySelector('[name="nationality"]').value.trim();
        const state = document.querySelector('[name="state"]').value.trim();
        const city = document.querySelector('[name="city"]').value.trim();
        const birth_date = document.querySelector('[name="birth_date"]').value.trim();
        const city_birth = document.querySelector('[name="city_birth"]').value.trim();
        const state_birth = document.querySelector('[name="state_birth"]').value.trim();
        const country_birth = document.querySelector('[name="country_birth"]').value.trim();
        const address = document.querySelector('[name="address"]').value.trim();
        const arrival = document.querySelector('[name="arrival"]').value.trim();
        const departure = document.querySelector('[name="departure"]').value.trim();
        const total_orang_dewasa = document.querySelector('[name="total_orang_dewasa"]').value.trim();
        const notes = document.querySelector('[name="notes"]').value.trim();
        const id_travel_agent = document.querySelector('select[name="id_travel_agent"]').value.trim();
        const id_source_travel_agent = document.querySelector('select[name="id_source_travel_agent"]').value.trim();
        var expIdentityCardForeverCheckbox = document.getElementById('exp_identity_card_forever');

        const id_guest = document.getElementById('dropdown-search').value;
        const expIdentityCard = document.querySelector('input[name="exp_identity_card"]').value.trim();

        let errorMessages = '';

        // Pengecekan setiap nilai
        if (!id_room) {
            errorMessages += 'Please select Room.\n';
            document.getElementsByName('id_room')[0].classList.add('is-invalid');
        }
        if (!full_name && (!id_guest)) {
            errorMessages += 'Please fill out Full name fields.\n';
            document.getElementsByName('full_name')[0].classList.add('is-invalid');
        }
        if (!id_guest && (!guest_type)) {
            errorMessages += 'Please select Guest type.\n';
            document.getElementsByName('guest_type')[0].classList.add('is-invalid');
        }
        if (!id_guest && (!gender)) {
            errorMessages += 'Please select Gender.\n';
            document.getElementsByName('gender')[0].classList.add('is-invalid');
        }
        if (!id_guest && (!id_occupation)) {
            errorMessages += 'Please select Occupation.\n';
            document.getElementsByName('id_occupation')[0].classList.add('is-invalid');
        }
        if (!id_guest && (!email)) {
            errorMessages += 'Please fill out email fields.\n';
            document.getElementsByName('email')[0].classList.add('is-invalid');
        }
        if (!id_guest && (!phone)) {
            errorMessages += 'Please fill out Phone fields.\n';
            document.getElementsByName('phone')[0].classList.add('is-invalid');
        }
        if (!id_guest && (!postal)) {
            errorMessages += 'Please fill out Postal fields.\n';
            document.getElementsByName('postal')[0].classList.add('is-invalid');
        }
        if (!id_guest && (!country)) {
            errorMessages += 'Please fill out Country fields.\n';
            document.getElementsByName('country')[0].classList.add('is-invalid');
        }
        if (!id_guest && (!identity_card_type)) {
            errorMessages += 'Please select Identity card type.\n';
            document.getElementsByName('identity_card_type')[0].classList.add('is-invalid');
        }
        if (!id_guest && (!identity_card_number)) {
            errorMessages += 'Please Fill out Identity card number.\n';
            document.getElementsByName('identity_card_number')[0].classList.add('is-invalid');
        }
        if (!id_guest && (!state)) {
            errorMessages += 'Please select Identity card type.\n';
            document.getElementsByName('state')[0].classList.add('is-invalid');
        }
        if (!id_guest && (!nationality)) {
            errorMessages += 'Please fill out Nationality fields.\n';
            document.getElementsByName('nationality')[0].classList.add('is-invalid');
        }
        if (!id_guest && (!city_birth)) {
            errorMessages += 'Please fill out City birth fields.\n';
            document.getElementsByName('city_birth')[0].classList.add('is-invalid');
        }
        if (!id_guest && (!city)) {
            errorMessages += 'Please fill out City fields..\n';
            document.getElementsByName('city')[0].classList.add('is-invalid');
        }
        if (!id_guest && (!state_birth)) {
            errorMessages += 'lease fill out State birth fields.\n';
            document.getElementsByName('state_birth')[0].classList.add('is-invalid');
        }
        if (!id_guest && (!country_birth)) {
            errorMessages += 'Please fill out Country birth fields.\n';
            document.getElementsByName('country_birth')[0].classList.add('is-invalid');
        }
        if (!id_guest && (!address)) {
            errorMessages += 'Please fill out address fields.\n';
            document.getElementsByName('address')[0].classList.add('is-invalid');
        }
        if (!id_guest && (!identity_card_number)) {
            errorMessages += 'Please select Identity card type.\n';
            document.getElementsByName('identity_card_number')[0].classList.add('is-invalid');
        }
        if (!arrival) {
            errorMessages += 'Please select Check in date.\n';
            document.getElementsByName('arrival')[0].classList.add('is-invalid');
        }
        if (!departure) {
            errorMessages += 'Please select Check out date.\n';
            document.getElementsByName('departure')[0].classList.add('is-invalid');
        }
        if (!id_travel_agent) {
            errorMessages += 'Please select Travel agent.\n';
            document.getElementsByName('identity_card_number')[0].classList.add('is-invalid');
        }
        if (!id_source_travel_agent) {
            errorMessages += 'Please select source Travel agent.\n';
            document.getElementsByName('id_source_travel_agent')[0].classList.add('is-invalid');
        }
        if (!type_transaction) {
            errorMessages += 'Please select type transaction.\n';
            document.getElementsByName('type_transaction')[0].classList.add('is-invalid');
        }
        if (!total_orang_dewasa) {
            errorMessages += 'Please fill out Adults fields.\n';
            document.getElementsByName('total_orang_dewasa')[0].classList.add('is-invalid');
        }

        if (errorMessages !== '') {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: errorMessages,
            heightAuto: false
        });
        // Hentikan aksi default jika ada kesalahan
        event.preventDefault();
        } else {
            // Tampilkan modal jika tidak ada kesalahan
            $('#hasilHitung').modal('show');
        }
    });

        document.getElementById('saveTagihan').addEventListener('click', function() {
        var form = document.getElementById('AddPost');
        var errorMessages = ''; // Validasi ulang atau gunakan variabel global jika diperlukan

        // Jika tidak ada kesalahan, submit form
        if (errorMessages === '') {
            form.submit();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: errorMessages,
                heightAuto: false
            });
        }
    });
    </script>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
            });

            var amanities = '<tr><td><input class="btn btn-danger" name="remove" id="remove" value="Remove" type="button"></input></td><td><select class="form-select idi" aria-label="Default select example" id="id_additional_item" name="id_additional_item[]"><option value="" selected>amanities</option>@foreach ($additionalItems as $additionalItem)<option value="{{ $additionalItem->id }}">{{ $additionalItem->name }}</option>@endforeach</select><td><input class="form-control qi" type="number" placeholder="Qty Items" name="qty_item[]"></td></td><td><input class="form-control td" type="number" placeholder="Total Days" name="total_days[]"></td></tr>';
            var max = 10;
            var x = 0;

            $("#addAmanities").click(function(){
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
    <script>

        $("#hitung").on('click', function (event) {
            event.preventDefault();

            let id_additional_item = $('.idi').map(function() {
                return $(this).val();
            }).get();

            let qty_items = $('.qi').map(function() {
                return $(this).val();
            }).get();

            let total_days = $('.td').map(function() {
                return $(this).val();
            }).get();

            let formData = new FormData($("#AddPost")[0]);
            formData.append("id_additional_item", id_additional_item !== null ? id_additional_item : '');
            formData.append("qty_items", qty_items);
            formData.append("total_days", total_days);

            jQuery.ajax({
                url: "/front-office/room-view/hitung",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,

                success: function(result) {
                console.log(result);

                const formatRupiah = (angka) => {
                    var number_string = angka.toString(),
                        sisa = number_string.length % 3,
                        rupiah = number_string.substr(0, sisa),
                        ribuan = number_string.substr(sisa).match(/\d{3}/g);

                    if (ribuan) {
                        separator = sisa ? '.' : '';
                        rupiah += separator + ribuan.join('.');
                    }

                    return 'Rp: ' + rupiah;
                }

                $("#folio_number").val(result.folioNumber);

                // Membuat variabel untuk menampung konten tabel
                let tableContent = `
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Name Room</td>
                            <td>${result.room.name}</td>
                        </tr>
                        <tr>
                            <td>Code Room</td>
                            <td>${result.room.kode_room}</td>
                        </tr>
                        <tr>
                            <td>Type Room</td>
                            <td>${result.room.room_type.name}</td>
                        </tr>
                        <tr>
                            <td>Price Type Room</td>
                            <td>${formatRupiah(result.priceRateTypes.price)}</td>
                        </tr>
                        <tr>
                            <td>Total Day</td>
                            <td>${result.total_day_stay}</td>
                        </tr>
                        <tr>
                            <td>Total Price Room</td>
                            <td>${formatRupiah(result.jmlhPriceRoom)}</td>
                        </tr>
                        <tr>
                            <td>Extra Adult</td>
                            <td>${result.ExtraAdult ?  result.ExtraAdult : 0}</td>
                        </tr>
                        <tr>
                            <td>Extra Child</td>
                            <td>${result.ExtraChild ? result.ExtraChild : 0}</td>
                        </tr>
                        <tr>
                            <td>Price Adult & Child</td>
                            <td>${result.priceAdultChild ? formatRupiah(result.priceAdultChild) : 0}</td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <h4>Add Amenities</h4>
                <ul class="list-group">
            `;

                // Menambahkan baris untuk setiap item tambahan
                result.dataAdditionalItems.forEach(item => {
                    tableContent += `
                        <li class="list-group-item">
                            <strong>Name:</strong> ${item.nameItem}<br>
                            <strong>Price:</strong> ${formatRupiah(item.priceItem)}<br>
                            <strong>Qty Order:</strong> ${item.qtyOrder}<br>
                            <strong>Total Day:</strong> ${item.totalDays}<br>
                            <strong>Total Price Amanities:</strong> ${formatRupiah(item.TotalPrice)}
                        </li>
                    `;
                });

                // Menutup tabel tambahan
                tableContent += `
                    </ul>
                    <input type="hidden" id="total_payment_transaction_modal" name="total_payment_transaction_modal" value="${result.masterPrice}">
                    <hr>
                    <h4>Total Transaction ${formatRupiah(result.masterPrice)}</h4>
                `;

                // Mengganti isi modal body dengan konten tabel yang telah dibuat
                $(".modalbodyy").html(tableContent);
            }

            });

            function formatRupiahNew(angka, prefix) {
                var number_string = angka.toString().replace(/[^,\d]/g, ''),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
            }

            $('#bayarTagihan').click(function() {
                // Set tombol Save menjadi terklik

                {{--  sisa_pembayaran  --}}
                var payment_paid = $("#payment_paid_modal").val();
                var total_tagihan = $("#total_payment_transaction_modal").val();
                let total_hasil_transaction = total_tagihan - payment_paid;
                let total_paid = "";
                let htmll = "";
                if(total_hasil_transaction == 0) {
                    total_paid = "Paid Off";
                    htmll =  `<h4 class="text-success">Status : ` + total_paid + `</h4>`;
                } else {
                    total_paid = formatRupiahNew(total_hasil_transaction, "Rp ") + " Unpaid";
                    htmll =  `<h4 class="text-warning">Status : ` + total_paid + `</h4>`;
                }
                $("#status").html(htmll);
                $("#payment_paid").val(payment_paid);
                $("#total_payment_transaction").val(total_tagihan);

                $('#saveTagihan').show();
                $('#bayarTagihan').hide();
            });

            $('#saveTagihan').click(function() {
                $('#buttonSave').click();
                $('#buttonSave').hide();
            });
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#type_transaction').change(function() {
                var selectedValue = $(this).val();

                if (selectedValue === 'Cash') {
                    $('#card_number').attr('readonly', true);
                    $('#exp_card').attr('readonly', true);
                } else {
                    $('#card_number').attr('readonly', false);
                    $('#exp_card').attr('readonly', false);
                }

            });

            $('#exp_identity_card_forever').change(function(){
                if (!this.checked) {
                    $('#exp_identity_card').prop('readonly', false);
                } else {
                    $('#exp_identity_card').prop('readonly', true);
                }
            });



            $('#id_room').change(function() {
                var idRoom = $(this).val();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                jQuery.ajax({
                    url: "/front-office/reservation/getDataWhereRoom/" + idRoom,
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success:function(result){
                        console.log(result);
                        $("#type_room").val(result.room.room_type.name);
                        $("#status_room").val(result.room.status_room.name);


                        // Clear the id_price_rate_type select element
                        $('#id_price_rate_type').empty();
                        $('#id_price_rate_type').append($('<option>', {
                            value: '',
                            text: 'select rate type'
                        }));

                        // Populate the id_price_rate_type select element with new options
                        $.each(result.rateTypes, function(index, item) {
                            $('#id_price_rate_type').append($('<option>', {
                                value: item.id,
                                text: item.price
                            }));
                        });
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
        });

    </script>
    <script>
        $('#id_travel_agent').change(function(event) {
    event.preventDefault();

    var id = $(this).val();
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    jQuery.ajax({
        url: "/front-office/room-view/getTravelAgent/" + id,
        type: "GET",
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: function(result) {
            updateSelectWithData(result);
        },
        error: function(error) {
            console.error('Error:', error);

        }
    });

    function updateSelectWithData(data) {
        // Kosongkan elemen select
        $('#id_source_travel_agent').empty();

        // Tambahkan opsi default
        $('#id_source_travel_agent').append($('<option>', {
            value: '',
            text: 'select source travel agents'
        }));

        // Tambahkan opsi baru berdasarkan data dari respons
        $.each(data, function(index, item) {
            $('#id_source_travel_agent').append($('<option>', {
                value: item.id,
                text: item.name
            }));
        });
    }
});


    </script>
@endsection
