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
                            <p class="mb-0 d-flex justify-content-start">{{ $title }}</p>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-success btn-sm" style="margin-right: 5px" id="hitung">Hitung</button>
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
                                        <label for="example-text-input" class="form-control-label">Room Name</label>
                                        <input class="form-control" type="text" disabled value="{{ $room->name }}">
                                        <input type="hidden" name="id_room" value="{{ $room->id }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Type Room</label>
                                        <input class="form-control" type="text" disabled value="{{ $room->RoomType->name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Status Room</label>
                                        <input class="form-control" type="text" disabled value="{{ $room->StatusRoom->name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Rate Type</label>
                                        <select class="form-select" name="id_price_rate_type">
                                            <option value="">select rate type</option>
                                            @foreach ($priceRateTypes as $priceRateType)
                                                @if(old('id_price_rate_type') == $priceRateType->id)
                                                    <option value="{{ $priceRateType->id }}" selected>{{ $priceRateType->type_day}} || {{  $priceRateType->price }}</option>
                                                @else
                                                    <option value="{{ $priceRateType->id }}">{{ $priceRateType->type_day}} || {{  $priceRateType->price }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('id_price_rate_type')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
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
                                            <input class="form-control @error('full_name') is-invalid @enderror" type="text" name="full_name" value="{{ old('full_name') }}">
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
                                            <select class="form-select @error('guest_type') is-invalid @enderror" aria-label="Default select example" name="guest_type">
                                                <option value="" {{ old('guest_type') == '' ? 'selected' : '' }}>guest type</option>
                                                <option value="Regular" {{ old('guest_type') == 'Regular' ? 'selected' : '' }}>Regular</option>
                                                <option value="Repeat" {{ old('guest_type') == 'Repeat' ? 'selected' : '' }}>Repeat</option>
                                                <option value="VIP" {{ old('guest_type') == 'VIP' ? 'selected' : '' }}>VIP</option>
                                            </select>
                                            @error('guest_type')
                                                <p><small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select class="form-select @error('gender') is-invalid @enderror" aria-label="Default select example" name="gender">
                                                <option value="" {{ old('gender') == '' ? 'selected' : '' }}>guest type</option>
                                                <option value="Man" {{ old('gender') == 'Man' ? 'selected' : '' }}>Man</option>
                                                <option value="Woman" {{ old('gender') == 'Woman' ? 'selected' : '' }}>Woman</option>
                                                <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                            @error('gender')
                                                <p><small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Occupation</label>
                                            <select class="form-select @error('id_occupation') is-invalid @enderror" name="id_occupation">
                                                <option value="">select occupations</option>
                                                @foreach ($occupations as $occupation)
                                                    @if(old('id_occupation') == $occupation->id)
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
                                            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}">
                                            @error('email')
                                                <p><small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Phone Number</label>
                                            <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" value="{{ old('phone') }}">
                                            @error('phone')
                                                <p><small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Postal</label>
                                            <input class="form-control @error('postal') is-invalid @enderror" type="text" name="postal" value="{{ old('postal') }}">
                                            @error('postal')
                                                <p><small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Country</label>
                                            <input class="form-control @error('country') is-invalid @enderror" type="text" name="country" value="{{ old('country') }}">
                                            @error('country')
                                                <p><small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Identity Card type</label>
                                            <select class="form-select @error('identity_card_type') is-invalid @enderror" aria-label="Default select example" name="identity_card_type" id="identity_card_type">
                                                <option value="" {{ old('identity_card_type') == '' ? 'selected' : '' }}>guest type</option>
                                                <option value="KTP" {{ old('identity_card_type') == 'KTP' ? 'selected' : '' }}>KTP</option>
                                                <option value="SIM" {{ old('identity_card_type') == 'SIM' ? 'selected' : '' }}>SIM</option>
                                                <option value="Passport" {{ old('identity_card_type') == 'Passport' ? 'selected' : '' }}>Passport</option>
                                            </select>
                                            @error('identity_card_type')
                                                <p><small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Identity Card Number</label>
                                            <input class="form-control @error('identity_card_number') is-invalid @enderror" type="text" name="identity_card_number" value="{{ old('identity_card_number') }}">
                                            @error('identity_card_number')
                                                <p><small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Exp Identity Card</label>
                                            <input class="form-control @error('exp_identity_card') is-invalid @enderror" type="date" name="exp_identity_card" value="{{ old('exp_identity_card') }}">
                                            @error('exp_identity_card')
                                                <p><small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Nationalityr</label>
                                            <input class="form-control @error('nationality') is-invalid @enderror" type="text" name="nationality" value="{{ old('nationality') }}">
                                            @error('nationality')
                                                <p><small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">State</label>
                                            <input class="form-control @error('state') is-invalid @enderror" type="text" name="state" value="{{ old('state') }}">
                                            @error('state')
                                                <p><small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">City</label>
                                            <input class="form-control @error('city') is-invalid @enderror" type="text" name="city" value="{{ old('city') }}">
                                            @error('city')
                                                <p><small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Birth Date</label>
                                            <input class="form-control @error('birth_date') is-invalid @enderror" type="date" name="birth_date" value="{{ old('birth_date') }}">
                                            @error('birth_date')
                                                <p><small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">City Birth</label>
                                            <input class="form-control @error('city_birth') is-invalid @enderror" type="text" name="city_birth" value="{{ old('city_birth') }}">
                                            @error('city_birth')
                                                <p><small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">State Birth</label>
                                            <input class="form-control @error('state_birth') is-invalid @enderror" type="text" name="state_birth" value="{{ old('state_birth') }}">
                                            @error('state_birth')
                                                <p><small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Country Birth</label>
                                            <input class="form-control @error('country_birth') is-invalid @enderror" type="text" name="country_birth" value="{{ old('country_birth') }}">
                                            @error('country_birth')
                                                <p><small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" rows="3" name="address">{{ old('address') }}</textarea>
                                            @error('address')
                                                <p><small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        {{--  ? Select Guest  --}}
                        <div class="tab-content mt-2">
                            <div class="tab-pane fade" id="profile">
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <select class="form-select" id="dropdown-search" aria-label="Default select example" name="id_guest" style="width: 100%; height: 25px;">
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
                                            <select class="form-select @error('type_transaction') is-invalid @enderror" aria-label="Default select example" name="type_transaction" id="type_transaction">
                                                <option value="" selected>Select Setlement</option>
                                                <option value="Cash">Cash</option>
                                                <option value="Credit">Credit</option>
                                                <option value="Partial Credit">Partial Credit</option>
                                            </select>
                                            @error('type_transaction')
                                                <p><small class="text-danger">{{ $message }}</small>
                                            @enderror
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
                                            <input class="form-control @error('folio_number') is-invalid @enderror" type="text" id="folio_number" name="folio_number" value="{{ old('folio_number') }}" readonly>
                                            @error('folio_number')
                                                <p><small class="text-danger">{{ $message }}</small>
                                            @enderror
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
                                            <label for="example-text-input" class="form-control-label">Arrival</label>
                                            <input class="form-control @error('arrival') is-invalid @enderror" type="date" name="arrival" value="{{ old('arrival') }}">
                                            @error('arrival')
                                                <p><small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Departure</label>
                                            <input class="form-control @error('departure') is-invalid @enderror" type="date" name="departure" value="{{ old('departure') }}">
                                            @error('departure')
                                                <p><small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Orang Dewasa</label>
                                            <input class="form-control @error('total_orang_dewasa') is-invalid @enderror" type="number" name="total_orang_dewasa" value="{{ old('total_orang_dewasa') }}">
                                            @error('total_orang_dewasa')
                                                <p><small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Anak</label>
                                            <input class="form-control @error('total_anak') is-invalid @enderror" type="number" name="total_anak" value="{{ old('total_anak') }}">
                                            @error('total_anak')
                                                <p><small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Bayi</label>
                                            <input class="form-control @error('total_bayi') is-invalid @enderror" type="number" name="total_bayi" value="{{ old('total_bayi') }}">
                                            @error('total_bayi')
                                                <p><small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="notes" class="form-label">Notes</label>
                                            <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" rows="3" name="notes">{{ old('notes') }}</textarea>
                                            @error('notes')
                                                <p><small class="text-danger">{{ $message }}</small>
                                            @enderror
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
                                            @error('id_travel_agent')
                                                <p><small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Source Travel Agent</label>
                                            <select class="form-select" name="id_source_travel_agent" id="id_source_travel_agent">
                                                <option value="">select source travel agents</option>
                                                {{--  @foreach ($sourceTravelAgents as $sourceTravelAgentss)
                                                    @if(old('id_source_travel_agent') == $sourceTravelAgentss->id)
                                                        <option value="{{ $sourceTravelAgentss->id }}" selected>{{ $sourceTravelAgentss->TravelAgent->name }} || {{ $sourceTravelAgentss->name }}</option>
                                                    @else
                                                        <option value="{{ $sourceTravelAgentss->id }}">{{ $sourceTravelAgentss->TravelAgent->name }} || {{ $sourceTravelAgentss->name }}</option>
                                                    @endif
                                                @endforeach  --}}
                                            </select>
                                            @error('id_source_travel_agent')
                                                <p><small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--  Add Item  --}}
                        <div class="card mt-3">
                            <div class="card-body">
                                <h4>Add Items</h4>
                                <div class="row">
                                    <div class="table-responsive">
                                        <form id="myForm">
                                            <table class="table" id="table_amanities">
                                                <tr>
                                                    <th width="100px"></th>
                                                    <th width="100px"></th>
                                                    <th></th>
                                                </tr>
                                                <tr>
                                                    <td><input class="btn btn-danger" name="remove" id="remove" value="Remove" type="button"></input>
                                                    </td><td><label for="example-text-input" class="form-control-label">Add Amanities :</label></td>
                                                    <td><select class="form-select idi" aria-label="Default select example" id="id_additional_item" name="id_additional_item[]">
                                                        <option value="" selected>amanities</option>
                                                        @foreach ($additionalItems as $additionalItem)
                                                        <option value="{{ $additionalItem->id }}">{{ $additionalItem->name }}</option>
                                                        @endforeach
                                                    </select></td>
                                                    <td><input class="form-control qi" type="number" placeholder="Qty Items" name="qty_item[]"></td>
                                                    <td><input class="form-control td" type="number" placeholder="Total Days" name="total_days[]"></td>
                                                </tr>
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
                                        <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" rows="3" name="notes">{{ old('notes') }}</textarea>
                                        @error('notes')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
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
                                <div class="modal-body">
                                    <div class="modalbodyy">

                                    </div>
                                    <div class="form-group p-2">
                                        <label for="example-text-input" class="form-control-label"><h4>Payment Paid : </h4></label>
                                        <input class="form-control @error('payment_paid_modal') is-invalid @enderror" type="number" name="payment_paid_modal" id="payment_paid_modal" value="{{ old('payment_paid_modal') }}">
                                        <div class="pt-2" id="sisa_pembayaran"></div>
                                        <label for="example-text-input" class="form-control-label" id="status"></label>
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
        $(document).ready(function() {
            $('#dropdown-search').select2();
        });
    </script>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
            });

            var amanities = '<tr><td><input class="btn btn-danger" name="remove" id="remove" value="Remove" type="button"></input></td><td><label for="example-text-input" class="form-control-label">Add Amanities :</label></td><td><select class="form-select idi" aria-label="Default select example" id="id_additional_item" name="id_additional_item[]"><option value="" selected>amanities</option>@foreach ($additionalItems as $additionalItem)<option value="{{ $additionalItem->id }}">{{ $additionalItem->name }}</option>@endforeach</select><td><input class="form-control qi" type="number" placeholder="Qty Items" name="qty_item[]"></td></td><td><input class="form-control td" type="number" placeholder="Total Days" name="total_days[]"></td></tr>';
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

        function hitung() {
            $("#hasilHitung").modal('show');
            console.log(jQuary(''))
        }
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

                success:function(result){
                    console.log(result);

                        $("#hasilHitung").modal('show');
                        $("#folio_number").val(result.folioNumber);
                        $(".modalbodyy").html(`
                        <p>Name Room : `+result.room.name+`</p>
                        <p>Code Room : `+result.room.kode_room+`</p>
                        <p>Type Room : `+result.room.room_type.name+` | Price Type Room : `+result.priceRateTypes.price+`</p>
                        <p>Total Day : `+result.total_day_stay+` | Total Price Room : `+result.jmlhPriceRoom+`</p>
                        <p>Extra Adult : `+result.ExtraAdult+` : `+ result.jmlhAdult +` | Extra Child : `+result.ExtraChild+` : `+ result.jmlhChild +`</p>
                        <hr>
                        <h4>Add Amanities</h4>
                        <ul>
                            `+ result.dataAdditionalItems.map(function(item) {
                                return `<li>Name : `+ item.nameItem +` Price Item : `+ item.priceItem +` Qty Order : `+ item.qtyOrder +` Total Day : `+ item.totalDays +` Price : `+ item.TotalPrice +` </li>`;
                            }).join(``) +`
                        </ul><input type="hidden" id="total_payment_transaction_modal" name="total_payment_transaction_modal" value="`+ result.masterPrice +`">
                        <hr>
                        <h4>Total Transaction : `+ result.masterPrice +`</h4>

                        `);
                }
            });

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
                    total_paid = total_hasil_transaction + " Unpaid";
                    htmll =  `<h4 class="text-warning">Status : ` + total_paid + `</h4>`;
                }
                $("#status").html(htmll);
                $("#payment_paid").val(payment_paid);
                $("#total_payment_transaction").val(total_tagihan);

                $('#saveTagihan').show();
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
                    success:function(result){
                        updateSelectWithData(result)

                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                })

                function updateSelectWithData(data) {
                    // Kosongkan elemen select
                    $('#id_source_travel_agent').empty();

                    // Tambahkan opsi baru berdasarkan data dari respons
                    $.each(data, function(index, item) {
                        $('#id_source_travel_agent').append($('<option>', {
                            value: item.id,
                            text: item.name
                        }));
                    });
                }
            });
        });

    </script>
@endsection
