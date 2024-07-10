@extends('layouts.app')

@section('content')
    <div class="main-content position-relative max-height-vh-100 h-100">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-12">
                    <form id="edit_guest" action="{{ route('guest.update', $guest->id) }}" method="POST" enctype="multipart/form-data">
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
                                        <label for="example-text-input" class="form-control-label">Full Name</label>
                                        <input class="form-control @error('full_name') is-invalid @enderror" type="text" name="full_name" value="{{ old('full_name', $guest->full_name) }}">
                                        @error('full_name')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
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
                                            <option value="">guest type</option>
                                            @if ($guest->guest_type == "Regular")
                                            <option value="Regular" selected>Regular</option>
                                            <option value="Repeat">Repeat</option>
                                            <option value="VIP">VIP</option>
                                            @elseif ($guest->guest_type == "Repeat")
                                            <option value="Regular">Regular</option>
                                            <option value="Repeat" selected>Repeat</option>
                                            <option value="VIP">VIP</option>
                                            @elseif ($guest->guest_type == "VIP")
                                            <option value="Regular">Regular</option>
                                            <option value="Repeat">Repeat</option>
                                            <option value="VIP" selected>VIP</option>
                                            @endif
                                        </select>
                                        @error('guest_type')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select class="form-select" aria-label="Default select example" name="gender">
                                            <option value="">guest type</option>
                                            @if ($guest->gender == "Man")
                                            <option value="Man" selected>Man</option>
                                            <option value="Woman">Woman</option>
                                            <option value="Other">Other</option>
                                            @elseif ($guest->gender == "Woman")
                                            <option value="Man">Man</option>
                                            <option value="Woman" selected>Woman</option>
                                            <option value="Other">Other</option>
                                            @elseif ($guest->gender == "Other")
                                            <option value="Man">Man</option>
                                            <option value="Woman">Woman</option>
                                            <option value="Other" selected>Other</option>
                                            @endif
                                        </select>
                                        @error('gender')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Occupation</label>
                                        <select class="form-select" name="id_occupation">
                                            <option value="">select occupations</option>
                                            @foreach ($occupations as $occupation)
                                                @if(old('id_occupation', $guest->id_occupation) == $occupation->id)
                                                    <option value="{{ $occupation->id }}" selected>{{ $occupation->name }}</option>
                                                @else
                                                    <option value="{{ $occupation->id }}">{{ $occupation->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('id_occupation')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Email</label>
                                        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email', $guest->email) }}">
                                        @error('email')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Phone Number</label>
                                        <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" value="{{ old('phone', $guest->phone) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Postal</label>
                                        <input class="form-control @error('postal') is-invalid @enderror" type="text" name="postal" value="{{ old('postal', $guest->postal) }}">
                                        @error('postal')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Country</label>
                                        <input class="form-control @error('country') is-invalid @enderror" type="text" name="country" value="{{ old('country', $guest->country) }}">
                                        @error('country')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Identity Card type</label>
                                        <select class="form-select" aria-label="Default select example" name="identity_card_type">
                                            <option value="">guest type</option>
                                            @if ($guest->identity_card_type == "KTP")
                                            <option value="KTP" selected>KTP</option>
                                            <option value="SIM">SIM</option>
                                            <option value="Passport">Passport</option>
                                            @elseif ($guest->identity_card_type == "SIM")
                                            <option value="KTP">KTP</option>
                                            <option value="SIM" selected>SIM</option>
                                            <option value="Passport">Passport</option>
                                            @elseif ($guest->identity_card_type == "Passport")
                                            <option value="KTP">KTP</option>
                                            <option value="SIM">SIM</option>
                                            <option value="Passport" selected>Passport</option>
                                            @endif
                                        </select>
                                        @error('identity_card_type')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Identity Card Number</label>
                                        <input class="form-control @error('identity_card_number') is-invalid @enderror" type="text" name="identity_card_number" value="{{ old('identity_card_number', $guest->identity_card_number) }}">
                                        @error('identity_card_number')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Exp Identity Card</label>
                                        <input class="form-control @error('exp_identity_card') is-invalid @enderror" type="date" name="exp_identity_card" id="exp_identity_card" value="{{ old('exp_identity_card', $guest->exp_identity_card) }}">
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
                                        <input class="form-control @error('nationality') is-invalid @enderror" type="text" name="nationality" value="{{ old('nationality',$guest->nationality) }}">
                                        @error('nationality')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">State</label>
                                        <input class="form-control @error('state') is-invalid @enderror" type="text" name="state" value="{{ old('state', $guest->state) }}">
                                        @error('state')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">City</label>
                                        <input class="form-control @error('city') is-invalid @enderror" type="text" name="city" value="{{ old('city', $guest->city) }}">
                                        @error('city')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Birth Date</label>
                                        <input class="form-control @error('birth_date') is-invalid @enderror" type="date" name="birth_date" value="{{ old('birth_date', $guest->birth_date) }}">
                                        @error('birth_date')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">City Birth</label>
                                        <input class="form-control @error('city_birth') is-invalid @enderror" type="text" name="city_birth" value="{{ old('city_birth', $guest->city_birth) }}">
                                        @error('city_birth')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">State Birth</label>
                                        <input class="form-control @error('state_birth') is-invalid @enderror" type="text" name="state_birth" value="{{ old('state_birth', $guest->state_birth) }}">
                                        @error('state_birth')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Country Birth</label>
                                        <input class="form-control @error('country_birth') is-invalid @enderror" type="text" name="country_birth" value="{{ old('country_birth', $guest->country_birth) }}">
                                        @error('country_birth')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" rows="3" name="address">{{ old('address', $guest->address) }}</textarea>
                                        @error('address')
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
    <script>
        // Function to set readonly attribute based on checkbox state
        function setReadonly() {
            var expIdentityCardInput = document.getElementById('exp_identity_card');
            var expIdentityCardForeverCheckbox = document.getElementById('exp_identity_card_forever');
    
            // If checkbox is checked, make input readonly
            if (expIdentityCardForeverCheckbox.checked) {
                expIdentityCardInput.setAttribute('readonly', 'true');
            } else {
                expIdentityCardInput.removeAttribute('readonly');
            }
        }
    
        // Event listener for checkbox change
        document.getElementById('exp_identity_card_forever').addEventListener('change', setReadonly);
    
        // Initial call to setReadonly to set initial state based on checkbox state
        setReadonly();
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            econst form = document.getElementById('edit_guest');
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                const fullName = document.querySelector('input[name="full_name"]').value.trim();
                const guestType = document.querySelector('select[name="guest_type"]').value.trim();
                const gender = document.querySelector('select[name="gender"]').value.trim();
                const occupation = document.querySelector('select[name="id_occupation"]').value.trim();
                const email = document.querySelector('input[name="email"]').value.trim();
                const phone = document.querySelector('input[name="phone"]').value.trim();
                const postal = document.querySelector('input[name="postal"]').value.trim();
                const country = document.querySelector('input[name="country"]').value.trim();
                const identityCardType = document.querySelector('select[name="identity_card_type"]').value.trim();
                const identityCardNumber = document.querySelector('input[name="identity_card_number"]').value.trim();
                const expIdentityCard = document.querySelector('input[name="exp_identity_card"]').value.trim();
                const nationality = document.querySelector('input[name="nationality"]').value.trim();
                const state = document.querySelector('input[name="state"]').value.trim();
                const city = document.querySelector('input[name="city"]').value.trim();
                const birthDate = document.querySelector('input[name="birth_date"]').value.trim();
                const cityBirth = document.querySelector('input[name="city_birth"]').value.trim();
                const stateBirth = document.querySelector('input[name="state_birth"]').value.trim();
                const countryBirth = document.querySelector('input[name="country_birth"]').value.trim();
                const address = document.querySelector('textarea[name="address"]').value.trim();
                var expIdentityCardForeverCheckbox = document.getElementById('exp_identity_card_forever');

                let errorMessages = '';
                
                if (fullName === '') {
                    errorMessages += 'Full Name is required.\n';
                    document.getElementsByName('full_name')[0].classList.add('is-invalid');
                }
                if (guestType === '') {
                    errorMessages += 'Guest Type is required.\n';
                    document.getElementsByName('guest_type')[0].classList.add('is-invalid');
                }
                if (gender === '') {
                    errorMessages += 'Gender is required.\n';
                    document.getElementsByName('gender')[0].classList.add('is-invalid');
                }
                if (occupation === '') {
                    errorMessages += 'Occupation is required.\n';
                    document.getElementsByName('id_occupation')[0].classList.add('is-invalid');
                }
                if (email === '') {
                    errorMessages += 'Email is required.\n';
                    document.getElementsByName('email')[0].classList.add('is-invalid');
                }
                if (phone === '') {
                    errorMessages += 'Phone Number is required.\n';
                    document.getElementsByName('phone')[0].classList.add('is-invalid');
                }
                if (postal === '') {
                    errorMessages += 'Postal is required.\n';
                    document.getElementsByName('postal')[0].classList.add('is-invalid');
                }
                if (country === '') {
                    errorMessages += 'Country is required.\n';
                    document.getElementsByName('country')[0].classList.add('is-invalid');
                }
                if (identityCardType === '') {
                    errorMessages += 'Identity Card Type is required.\n';
                    document.getElementsByName('identity_card_type')[0].classList.add('is-invalid');
                }
                if (identityCardNumber === '') {
                    errorMessages += 'Identity Card Number is required.\n';
                    document.getElementsByName('identity_card_number')[0].classList.add('is-invalid');
                }
                if (!expIdentityCardForeverCheckbox.checked) {
                    // Perform validation only if the checkbox is not checked
                    if (expIdentityCard === '') {
                        errorMessages += 'Exp Identity Card is required.\n';
                        document.getElementById('exp_identity_card').classList.add('is-invalid');
                    }
                }
                if (nationality === '') {
                    errorMessages += 'Nationality is required.\n';
                    document.getElementsByName('nationality')[0].classList.add('is-invalid');
                }
                if (state === '') {
                    errorMessages += 'State is required.\n';
                    document.getElementsByName('state')[0].classList.add('is-invalid');
                }
                if (city === '') {
                    errorMessages += 'City is required.\n';
                    document.getElementsByName('city')[0].classList.add('is-invalid');
                }
                if (birthDate === '') {
                    errorMessages += 'Birth Date is required.\n';
                    document.getElementsByName('birth_date')[0].classList.add('is-invalid');
                }
                if (cityBirth === '') {
                    errorMessages += 'City Birth is required.\n';
                    document.getElementsByName('city_birth')[0].classList.add('is-invalid');
                }
                if (stateBirth === '') {
                    errorMessages += 'State Birth is required.\n';
                    document.getElementsByName('state_birth')[0].classList.add('is-invalid');
                }
                if (countryBirth === '') {
                    errorMessages += 'Country Birth is required.\n';
                    document.getElementsByName('country_birth')[0].classList.add('is-invalid');
                }
                if (address === '') {
                    errorMessages += 'Address is required.\n';
                    document.getElementsByName('address')[0].classList.add('is-invalid');
                }
                
                if (errorMessages !== '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: errorMessages,
                        heightAuto: false
                    });
                } else {
                    form.submit();
                }
            });
        });
    </script>
    
@endsection
