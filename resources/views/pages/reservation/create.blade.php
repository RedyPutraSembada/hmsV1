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
                                {{--  <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Room (ini dibuat nullable dan string, dan jangan di tampilkan di halaman input ini)</label>
                                        <select class="form-select" name="id_room" id="id_room">
                                            <option value="">Select Room</option>
                                            @foreach ($rooms as $room)
                                                <option value="{{ $room->id }}" {{ old('id_room') == $room->id ? 'selected' : '' }}>{{ $room->name }} : {{  $room->kode_room }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>  --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Type Room</label>
                                        <select class="form-select" name="type_room" id="type_room">
                                            <option value="">Select Room</option>
                                            @foreach ($roomTypes as $roomType)
                                                <option value="{{ $roomType->id }}" {{ old('type_room') == $roomType->id ? 'selected' : '' }}>{{ $roomType->name }}</option>
                                            @endforeach
                                        </select>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">No. Of Room (new)</label>
                                        <input class="form-control" type="number" name="no_of_room" id="no_of_room">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">No. Of Person (new)</label>
                                        <input class="form-control" type="number" name="no_of_person" id="no_of_person">
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
                                    {{--  <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Image</label>
                                            <input class="form-control" type="file" name="image">
                                        </div>
                                    </div>  --}}
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
                                            <input class="form-control" type="email" name="email"  id="email" value="{{ old('email') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Phone Number</label>
                                            <input class="form-control" type="text" name="phone" id="phone" value="{{ old('phone') }}">
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
                            </div>
                        </div>
                    </div>

                    {{--  Businees Source Setting  --}}
                    <div class="card mt-3">
                        <div class="card-body">
                            <h4>Market Code</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Market (Update jadi String)</label>
                                        <select class="form-select" name="market_code" id="market_code">
                                            <option value="">select travel agents</option>
                                            <option value="Personal">Personal</option>
                                            <option value="Group">Group</option>
                                            <option value="Goverment">Goverment</option>
                                            <option value="Company C/A">Company C/A</option>
                                            <option value="Travel Agent">Travel Agent</option>
                                            <option value="Airlines">Airlines</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6"></div>
                                {{--  Flight NO  --}}
                                <div class="col-md-6">
                                    <div class="form-group" id="arrival_flight_no" hidden>
                                        <label for="example-text-input" class="form-control-label">Arrival Flight no (New)</label>
                                        <input class="form-control " type="text" name="arrival_flight_no" value="{{ old('arrival_flight_no') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" id="departure_flight_no" hidden>
                                        <label for="example-text-input" class="form-control-label">Departure Flight no (New)</label>
                                        <input class="form-control " type="text" name="departure_flight_no" value="{{ old('departure_flight_no') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                        {{--  Setlement Option  --}}
                        <div class="card mt-3">
                            <div class="card-body">
                                <h4>Method Of Payment</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select</label>
                                            <select class="form-select " aria-label="Default select example" name="type_transaction" id="type_transaction">
                                                <option value="" selected>Select Setlement</option>
                                                <option value="Credit Card">Credit Card</option>
                                                <option value="Cash">Cash</option>
                                                <option value="Guarantee Letter">Guarantee Letter</option>
                                                <option value="Voucher">Voucher</option>
                                                <option value="Other">Other</option>
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Arrival Date</label>
                                            <input class="form-control  " type="date" name="arrival" value="{{ old('arrival') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Departure Date</label>
                                            <input class="form-control " type="date" name="departure" value="{{ old('departure') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Arrival Time</label>
                                            <input class="form-control  " type="time" name="arrival_time" value="12:00" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Departure Time</label>
                                            <input class="form-control " type="time" name="departure_time" value="14:00" readonly>
                                        </div>
                                    </div>
                                    {{--  ETA & ETD  --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">ETA (New)</label>
                                            <input class="form-control " type="text" name="eta" value="{{ old('eta') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">ETD (New)</label>
                                            <input class="form-control " type="text" name="etd" value="{{ old('etd') }}">
                                        </div>
                                    </div>
                                    {{--  End ETA & ETD  --}}
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
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="notes" class="form-label">Remark</label>
                                            <textarea class="form-control " id="notes" rows="3" name="notes">{{ old('notes') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--  Other Information  --}}
                        <div class="card mt-3">
                            <div class="card-body">
                                <h4>Other Information</h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Booked By (new)</label>
                                            <input class="form-control  " type="text" name="booked_by" value="{{ old('booked_by') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Telephone No. (new)</label>
                                            <input class="form-control  " type="number" name="tlp_by" value="{{ old('tlp_by') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Fax No. (new)</label>
                                            <input class="form-control  " type="number" name="fax_by" value="{{ old('fax_by') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Taken By (new)</label>
                                            <input class="form-control  " type="text" name="taken_by" value="{{ old('taken_by') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Time (new)</label>
                                            <input class="form-control" type="datetime-local" name="taken_time" value="{{ old('taken_time') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Confirmation letter By (new)</label>
                                            <input class="form-control  " type="text" name="corfirmation_by" value="{{ old('corfirmation_by') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Time (new)</label>
                                            <input class="form-control" type="datetime-local" name="confirmation_time" value="{{ old('confirmation_time') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Input By (new)</label>
                                            <input class="form-control  " type="text" name="input_by" value="{{ old('input_by') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Time (new)</label>
                                            <input class="form-control" type="datetime-local" name="input_time" value="{{ old('input_time') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Checked By (new)</label>
                                            <input class="form-control  " type="text" name="checked_by" value="{{ old('checked_by') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Time (new)</label>
                                            <input class="form-control" type="datetime-local" name="checked_time" value="{{ old('checked_time') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

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
    {{--  ? Type Room  --}}
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
            // Mengambil nilai dari elemen-elemen form menggunakan [name=
            const typeRoom = document.querySelector('select[name="type_room"]').value.trim();
            const statusRoom = document.querySelector('[name="status_room"]').value.trim();
            const rateType = document.querySelector('select[name="id_price_rate_type"]').value.trim();
            const noOfRoom = document.querySelector('[name="no_of_room"]').value.trim();
            const noOfPerson = document.querySelector('[name="no_of_person"]').value.trim();
            const fullName = document.querySelector('[name="full_name"]').value.trim();
            const guestType = document.querySelector('select[name="guest_type"]').value.trim();
            const gender = document.querySelector('select[name="gender"]').value.trim();
            const occupation = document.querySelector('select[name="id_occupation"]').value.trim();
            const email = document.querySelector('[name="email"]').value.trim();
            const phone = document.querySelector('[name="phone"]').value.trim();
            const address = document.querySelector('[name="address"]').value.trim();
            const idGuest = document.querySelector('[name="id_guest"]').value.trim();
            const marketCode = document.querySelector('[name="market_code"]').value.trim();

            // Mengambil nilai arrival_flight_no
            const arrivalFlightNoElement = document.querySelector('input[name="arrival_flight_no"]');
            const arrivalFlightNo = arrivalFlightNoElement ? arrivalFlightNoElement.value.trim() : null;

            // Mengambil nilai departure_flight_no
            const departureFlightNoElement = document.querySelector('input[name="departure_flight_no"]');
            const departureFlightNo = departureFlightNoElement ? departureFlightNoElement.value.trim() : null;
            // new
            const type_transaction = document.querySelector('select[name="type_transaction"]').value.trim();
            const card_number = document.querySelector('[name="card_number"]').value.trim();
            const exp_card = document.querySelector('[name="exp_card"]').value.trim();
            const folio_number = document.querySelector('[name="folio_number"]').value.trim() ?? null;
            // Mengambil nilai dari elemen-elemen form tambahan
            const arrivalDate = document.querySelector('input[name="arrival"]').value.trim();
            const departureDate = document.querySelector('input[name="departure"]').value.trim();
            const eta = document.querySelector('input[name="eta"]').value.trim();
            const etd = document.querySelector('input[name="etd"]').value.trim();
            const adults = document.querySelector('input[name="total_orang_dewasa"]').value.trim();
            const childs = document.querySelector('input[name="total_anak"]').value.trim();
            const babies = document.querySelector('input[name="total_bayi"]').value.trim();
            const remarks = document.querySelector('[name="notes"]').value.trim();

            // Mengambil nilai dari elemen-elemen form tambahan yang baru ditambahkan
            const bookedBy = document.querySelector('[name="booked_by"]').value.trim();
            const tlpBy = document.querySelector('[name="tlp_by"]').value.trim();
            const faxBy = document.querySelector('[name="fax_by"]').value.trim();
            const takenBy = document.querySelector('[name="taken_by"]').value.trim();
            const takenTime = document.querySelector('[name="taken_time"]').value.trim();
            const confirmationBy = document.querySelector('[name="corfirmation_by"]').value.trim();
            const confirmationTime = document.querySelector('[name="confirmation_time"]').value.trim();
            const inputBy = document.querySelector('[name="input_by"]').value.trim();
            const inputTime = document.querySelector('[name="input_time"]').value.trim();
            const checkedBy = document.querySelector('[name="checked_by"]').value.trim();
            const checkedTime = document.querySelector('[name="checked_time"]').value.trim();

            let errorMessages = '';

            // Pengecekan setiap nilai
            if (!typeRoom) {
                errorMessages = 'Please select Type Room.\n';
            }

            if (!statusRoom) {
                errorMessages = 'Please fill out Status Room.\n';
            }

            if (!rateType) {
                errorMessages = 'Please select Rate Type.\n';
            }

            if (!noOfRoom) {
                errorMessages = 'Please fill out No. Of Room.\n';
            }

            if (!noOfPerson) {
                errorMessages = 'Please fill out No. Of Person.\n';
            }

            if (!fullName && (!idGuest)) {
                errorMessages = 'Please fill out Full Name or select Guest.\n';
            }

            if (!arrivalDate) {
                errorMessages = 'Please fill out Arrival Date.\n';
            }

            if (!departureDate) {
                errorMessages = 'Please fill out Departure Date.\n';
            }

            if (!eta) {
                errorMessages = 'Please fill out ETA.\n';
            }

            if (!etd) {
                errorMessages = 'Please fill out ETD.\n';
            }

            if (!adults) {
                errorMessages = 'Please fill out Adults.\n';
            }

            if (!childs) {
                errorMessages = 'Please fill out Childs.\n';
            }

            if (!babies) {
                errorMessages = 'Please fill out Babies.\n';
            }

            if (!bookedBy) {
                errorMessages = 'Please fill out Booked By.\n';
            }

            if (!tlpBy) {
                errorMessages = 'Please fill out Telephone No.\n';
            }

            if (!faxBy) {
                errorMessages = 'Please fill out Fax No.\n';
            }

            if (!takenBy) {
                errorMessages = 'Please fill out Taken By.\n';
            }

            if (!takenTime) {
                errorMessages = 'Please fill out Taken Time.\n';
            }

            if (!confirmationBy) {
                errorMessages = 'Please fill out Confirmation letter By.\n';
            }

            if (!confirmationTime) {
                errorMessages = 'Please fill out Confirmation Time.\n';
            }

            if (!inputBy) {
                errorMessages = 'Please fill out Input By.\n';
            }

            if (!inputTime) {
                errorMessages = 'Please fill out Input Time.\n';
            }

            if (!checkedBy) {
                errorMessages = 'Please fill out Checked By.\n';
            }

            if (!checkedTime) {
                errorMessages = 'Please fill out Checked Time.\n';
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

            let formData = new FormData($("#AddPost")[0]);
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
                                <td>Type Room</td>
                                <td>${result.typeRoom.name}</td>
                            </tr>
                            <tr>
                                <td>Price Type Room</td>
                                <td>${formatRupiah(result.priceRateTypes.price)}</td>
                            </tr>
                            <tr>
                                <td>Total Room</td>
                                <td>${result.countRoom}</td>
                            </tr>
                            <tr>
                                <td>Total Day</td>
                                <td>${result.total_day_stay}</td>
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
                // khusus untuk market codenya itu personal
                if (result.statusMarketCode) {
                    console.log(true);
                    // Menutup tabel tambahan
                    tableContent += `
                        <input type="hidden" id="total_payment_transaction_modal" name="total_payment_transaction_modal" value="${result.masterPrice}">
                        <hr>
                        <h4>Total Transaction ${formatRupiah(result.masterPrice)}</h4>
                    `;

                    // Mengganti isi modal body dengan konten tabel yang telah dibuat
                    $(".modalbodyy").html(tableContent);
                } else {
                    console.log(false);
                    // Menutup tabel tambahan
                    tableContent += `
                        <input type="hidden" id="total_payment_transaction_modal" name="total_payment_transaction_modal" value="${result.masterPrice}">
                        <hr>
                        <h4>Total Transaction ${formatRupiah(result.masterPrice)}</h4>
                    `;
                    $("#payment_paid_modal").val(result.masterPrice);
                    $("#total_payment_transaction").val(result.masterPrice);

                    $("#status").html(`<h4 class="text-success">Status : Paid Off</h4>`);
                    $("#payment_paid").val(result.masterPrice);

                    $('#saveTagihan').show();
                    $('#bayarTagihan').hide();

                    // Mengganti isi modal body dengan konten tabel yang telah dibuat
                    $(".modalbodyy").html(tableContent);
                }

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



            $('#type_room').change(function() {
                var idType = $(this).val();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                jQuery.ajax({
                    url: "/front-office/reservation/getDataWhereTypeRoom/" + idType,
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success:function(result){
                        {{--  console.log(result.typeRoom.price_rate_type);  --}}
                        {{--  $("#type_room").val(result.room.room_type.name);  --}}
                        $("#status_room").val(`${result.statusready} ${result.totalRoom}`);

                        // Clear the id_price_rate_type select element
                        $('#id_price_rate_type').empty();
                        $('#id_price_rate_type').append($('<option>', {
                            value: '',
                            text: 'select rate type'
                        }));

                        // Populate the id_price_rate_type select element with new options
                        $.each(result.typeRoom.price_rate_type, function(index, item) {
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
        $('#market_code').change(function(event) {
            event.preventDefault();

            var value = $(this).val();
            if (value === "Airlines") {
                $('#arrival_flight_no').attr('hidden', false);
                $('#departure_flight_no').attr('hidden', false);
            } else {
                $('#arrival_flight_no').attr('hidden', true);
                $('#departure_flight_no').attr('hidden', true);
            }

            {{--  var id = $(this).val();
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
            }  --}}
        });


    </script>
@endsection
