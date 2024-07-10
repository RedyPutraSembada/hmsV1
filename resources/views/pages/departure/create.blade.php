@php
    use App\Models\Room;
@endphp
@extends('layouts.app')

@section('content')
    <div class="main-content position-relative max-height-vh-100 h-100">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('registrasion.submit', ['id' => $transactionRoom->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex align-items-center">
                                    <p class="mb-0">Registrasi <i class="bi bi-chevron-right"></i> {{ $title }}</p>
                                    <button class="btn btn-primary btn-sm ms-auto" type="submit">Save</button>
                                </div>
                            </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-md-12 d-flex">
                                    <div class="flex-shrink-0 me-3" style="width: 25%;"><p class="text-bold">Full Name</p></div>
                                    <div class="flex-shrink-0 me-3"><p>:</p></div>
                                    <div class="flex-grow-1 text-start"><p>{{ $transactionRoom->Guest->full_name }}</p></div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12 d-flex">
                                    <div class="flex-shrink-0 me-3" style="width: 25%;"><p class="text-bold">Occupation</p></div>
                                    <div class="flex-shrink-0 me-3"><p>:</p></div>
                                    <div class="flex-grow-1 text-start"><p>{{ $transactionRoom->Guest->Accupation->name }}</p></div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12 d-flex">
                                    <div class="flex-shrink-0 me-3" style="width: 25%;"><p class="text-bold">Gender</p></div>
                                    <div class="flex-shrink-0 me-3"><p>:</p></div>
                                    <div class="flex-grow-1 text-start"><p>{{ $transactionRoom->Guest->gender }}</p></div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12 d-flex">
                                    <div class="flex-shrink-0 me-3" style="width: 25%;"><p class="text-bold">Arrival</p></div>
                                    <div class="flex-shrink-0 me-3"><p>:</p></div>
                                    <div class="flex-grow-1 text-start"><p>{{ $transactionRoom->arrival }}</p></div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12 d-flex">
                                    <div class="flex-shrink-0 me-3" style="width: 25%;"><p class="text-bold">Departure</p></div>
                                    <div class="flex-shrink-0 me-3"><p>:</p></div>
                                    <div class="flex-grow-1 text-start"><p>{{ $transactionRoom->departure }}</p></div>
                                </div>
                            </div>
                            @php
                                $roomIds = json_decode($transactionRoom->id_room, true);
                                $rooms = Room::whereIn('id', $roomIds)->get();
                            @endphp
                            <div class="row mb-2">
                                <div class="col-md-12 d-flex">
                                    <div class="flex-shrink-0 me-3" style="width: 25%;"><p class="text-bold">Room No</p></div>
                                    <div class="flex-shrink-0 me-3"><p>:</p></div>
                                    <div class="flex-grow-1 text-start">
                                        <ul>
                                            @foreach ($rooms as $room)
                                                <li>{{ $room->name }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12 d-flex">
                                    <div class="flex-shrink-0 me-3" style="width: 25%;"><p class="text-bold">Room Type</p></div>
                                    <div class="flex-shrink-0 me-3"><p>:</p></div>
                                    <div class="flex-grow-1 text-start"><p>{{ $transactionRoom->PriceRateType->RoomType->name }}</p></div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12 d-flex">
                                    <div class="flex-shrink-0 me-3" style="width: 25%;"><p class="text-bold">Address</p></div>
                                    <div class="flex-shrink-0 me-3"><p>:</p></div>
                                    <div class="flex-grow-1 text-start"><p>{{ $transactionRoom->Guest->address }}</p></div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12 d-flex">
                                    <div class="flex-shrink-0 me-3" style="width: 25%;"><p class="text-bold">Checked By</p></div>
                                    <div class="flex-shrink-0 me-3"><p>:</p></div>
                                    <div class="flex-grow-1 text-start"><p>{{ $transactionRoom->checked_by }}</p></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nationality</label>
                                        <input class="form-control" type="text" name="nationality" value="{{ old('nationality', $transactionRoom->Guest->nationality ?? '') }}">
                                        @error('nationality')
                                            <p><small class="text-danger">{{ $message }}</small></p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Birth Date</label>
                                        @php
                                            $birthDateValue = $transactionRoom->Guest->birth_date ?? '1900-01-01';
                                            // Jika nilai birth_date adalah '1900-01-01', ubah menjadi null
                                            $birthDateValue = ($birthDateValue === '1900-01-01') ? null : $birthDateValue;
                                        @endphp
                                        <input class="form-control" type="date" name="birth_date" value="{{ old('birth_date', $birthDateValue) }}">
                                        @error('birth_date')
                                            <p><small class="text-danger">{{ $message }}</small></p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Passport No. (NEW)</label>
                                        <input class="form-control " type="text" name="passport_no" value="{{ old('passport_no') }}">
                                        @error('passport_no')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Date Of Issued (New)</label>
                                        <input class="form-control  " type="date" name="date_of_issued" value="{{ old('date_of_issued') }}">
                                        @error('date_of_issued')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Date Of Landing (New)</label>
                                        <input class="form-control  " type="date" name="date_of_landing" value="{{ old('date_of_landing') }}">
                                        @error('date_of_landing')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Purpose OF Visit (New)</label>
                                        <input class="form-control " type="text" name="purpose_of_visit" value="{{ old('purpose_of_visit') }}">
                                        @error('purpose_of_visit')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Last Place Of Lodging (New)</label>
                                        <input class="form-control " type="text" name="last_place_of_lodging" value="{{ old('last_place_of_lodging') }}">
                                        @error('last_place_of_lodging')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Next Destination (New)</label>
                                        <input class="form-control " type="text" name="next_destination" value="{{ old('next_destination') }}">
                                        @error('next_destination')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Deposit (New) Sudah ada di total Payment</label>
                                        <input class="form-control " type="number" name="deposit" value="{{ old('deposit') }}">
                                        @error('deposit')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Clerk (New)</label>
                                        <input class="form-control " type="text" name="clerk" value="{{ old('clerk') }}">
                                        @error('clerk')
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');

            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Menghentikan pengiriman formulir standar

                // Array untuk menyimpan pesan kesalahan
                let errors = [];

                // Validasi setiap input
                const nationality = document.querySelector('input[name="nationality"]').value.trim();
                const birthDate = document.querySelector('input[name="birth_date"]').value.trim();
                const passportNo = document.querySelector('input[name="passport_no"]').value.trim();
                const dateOfIssued = document.querySelector('input[name="date_of_issued"]').value.trim();
                const dateOfLanding = document.querySelector('input[name="date_of_landing"]').value.trim();
                const purposeOfVisit = document.querySelector('input[name="purpose_of_visit"]').value.trim();
                const lastPlaceOfLodging = document.querySelector('input[name="last_place_of_lodging"]').value.trim();
                const nextDestination = document.querySelector('input[name="next_destination"]').value.trim();
                const deposit = document.querySelector('input[name="deposit"]').value.trim();
                const clerk = document.querySelector('input[name="clerk"]').value.trim();

                // Contoh validasi untuk nationality
                if (nationality === '') {
                    errors.push('Nationality cannot be empty!');
                }

                // Contoh validasi untuk birth date
                if (birthDate === '') {
                    errors.push('Birth Date cannot be empty!');
                }

                // Contoh validasi untuk passport number
                if (passportNo === '') {
                    errors.push('Passport number cannot be empty!');
                }

                // Validasi untuk date of issued
                if (dateOfIssued === '') {
                    errors.push('Date of Issued cannot be empty!');
                }

                // Validasi untuk date of landing
                if (dateOfLanding === '') {
                    errors.push('Date of Landing cannot be empty!');
                }

                // Validasi untuk purpose of visit
                if (purposeOfVisit === '') {
                    errors.push('Purpose of Visit cannot be empty!');
                }

                // Validasi untuk last place of lodging
                if (lastPlaceOfLodging === '') {
                    errors.push('Last Place of Lodging cannot be empty!');
                }

                // Validasi untuk next destination
                //if (nextDestination === '') {
                  //  errors.push('Next Destination cannot be empty!');
                //}

                // Validasi untuk deposit
                //if (deposit === '') {
                //    errors.push('Deposit cannot be empty!');
                //}

                // Validasi untuk clerk
                if (clerk === '') {
                    errors.push('Clerk cannot be empty!');
                }

                // Jika terdapat kesalahan, tampilkan SweetAlert dengan pesan kesalahan
                if (errors.length > 0) {
                    let errorMessage = '<ul>';
                    errors.forEach(error => {
                        errorMessage += `<li>${error}</li>`;
                    });
                    errorMessage += '</ul>';

                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error!',
                        html: errorMessage
                    });

                    return false; // Menghentikan pengiriman formulir jika ada kesalahan
                }

                // Jika semua validasi sukses, lanjutkan pengiriman formulir
                form.submit();
            });
        });
    </script>
@endsection
