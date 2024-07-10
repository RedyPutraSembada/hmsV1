@php
    use App\Models\Room;
@endphp
@extends('layouts.app')

@section('content')
<main class="main-content position-relative border-radius-lg ">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <h6>Front Desk <i class="bi bi-chevron-right"></i> {{ $title }}</h6>
                    </div>
                </div>
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <!-- Form for selecting month and year -->
                        <form action="{{ route('past-transaction.download') }}" method="GET" class="row g-3">
                            @csrf
                            <div class="col-auto">
                                <label for="month" class="col-form-label">Start Date:</label>
                            </div>
                            <div class="col-auto">
                                <input type="date" id="start_date" name="start_date" class="form-control" required>
                            </div>
                            <div class="col-auto">
                                <label for="end_date">End Date:</label>
                            </div>
                            <div class="col-auto">
                                <input type="date" id="end_date" name="end_date" class="form-control" required>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">Download Report</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Name Room</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Name Guest</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Guest Type</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Room Type</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Type Transaction</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Arrival</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">departure</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($TransactionRooms as $transacrionRoom)
                        <tr>
                            <td>
                                <p class="align-middle text-center text-sm mt-0 mb-0">
                                    @php
                                        $roomIds = json_decode($transacrionRoom->id_room, true);
                                        $rooms = Room::whereIn('id', $roomIds)->get();
                                    @endphp
                                    <ul>
                                        @foreach ($rooms as $room)
                                            <li>{{ $room->name }}</li>
                                        @endforeach
                                    </ul>
                                </p>
                            </td>
                            {{--  @dd($transacrionRoom->TransactionRoom[0]->Guest->full_name)  --}}
                            <td>
                                <p class="align-middle text-center text-sm mt-0 mb-0">

                                    {{ $transacrionRoom->Guest->full_name }}
                                </p>
                            </td>
                            <td>
                                <p class="align-middle text-center text-sm mt-0 mb-0">

                                    {{ $transacrionRoom->Guest->guest_type }}

                                </p>
                            </td>
                            <td>
                                <p class="align-middle text-center text-sm mt-0 mb-0">

                                    {{ $transacrionRoom->PriceRateType->RoomType->name }}

                                </p>
                            </td>
                            <td>
                                <p class="align-middle text-center text-sm mt-0 mb-0">

                                    {{ $transacrionRoom->type_transaction }}

                                </p>
                            </td>
                            <td>
                                <p class="align-middle text-center text-sm mt-0 mb-0">

                                    {{ $transacrionRoom->arrival }}

                                </p>
                            </td>
                            <td>
                                <p class="align-middle text-center text-sm mt-0 mb-0">

                                    {{ $transacrionRoom->departure }}

                                </p>
                            </td>
                            <td class="align-middle text-center">
                                    <!-- Button to trigger modal -->

                                    <div class="row justify-content-center">
                                        {{--  <div class="button-container mb-1">
                                            <a class="custom-button-detail show_user_details mt-4"
                                            data-bs-toggle="modal"
                                            data-bs-target="#UserDetailsModal"
                                            data-full_name="{{ $transacrionRoom->Guest->full_name }}
                                            "
                                            data-guest_type="
                                            {{ $transacrionRoom->Guest->guest_type }}
                                            "
                                            data-kode_room="
                                            {{ $transacrionRoom->Room->kode_room }}
                                            "
                                            data-room_name="
                                            {{ $transacrionRoom->Room->name}}
                                            "
                                            data-room_type="{{ $type->name }}"
                                            data-floor="
                                            {{ $transacrionRoom->Room->Floor->name}}
                                            "
                                            data-type_transaction="
                                            {{ $transacrionRoom->type_transaction }}
                                            "
                                            data-arrival="
                                                {{ $transacrionRoom->arrival }}
                                            "
                                            data-departure="
                                                {{ $transacrionRoom->departure }}
                                            "
                                            data-folio="
                                                {{ $transacrionRoom->folio_number }}
                                            "
                                            data-notes="
                                                {{ $transacrionRoom->notes }}
                                            "
                                            data-url="{{ route('detail.transaction', $transacrionRoom->id) }}"
                                            class="btn btn-info"
                                            href="javascript:void(0)">
                                                Details
                                            </a>
                                        </div>  --}}
                                        <div class="button-container">
                                            <a href="/front-office/Transaction/MasterBill/{{ $transacrionRoom->id }}" target="_blank" class="custom-button-invoice">
                                                Master Bill
                                            </a>
                                        </div>
                                        <div class="button-container">
                                            <a href="/front-office/Transaction/Receipt/{{ $transacrionRoom->id }}" target="_blank" class="custom-button-invoice">
                                                Receipt
                                            </a>
                                        </div>
                                        <div class="button-container">
                                            <a href="/front-office/Transaction/Bill/{{ $transacrionRoom->id }}" target="_blank" class="custom-button-invoice">
                                                Bill
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Green Buttons -->


                                    {{--  <!-- Modal for Check Out -->
                                    <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="checkoutModalLabel">Select Status Room</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body" id="checkoutModalBody">
                                                    <form action="{{ route('checkout', $transacrionRoom->id) }}" method="post">
                                                        @csrf
                                                        <div id="totalPayment" class="text-start"></div>
                                                        <input type="hidden" name="id_total_payment" id="id_total_payment">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Status Room</label>
                                                                <select class="form-select" name="id_status_room">
                                                                    <option value="">Select room status</option>
                                                                    @foreach ($statusRooms as $statusRoom)
                                                                        @if ($statusRoom->main_status == 2 ||$statusRoom->main_status == 3 || $statusRoom->main_status == 4)
                                                                            <option value="{{ $statusRoom->id }}">{{ $statusRoom->name }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                                @error('id_status_room')
                                                                    <p><small class="text-danger">{{ $message }}</small></p>
                                                                @enderror

                                                            </div>
                                                            <div class="form-group">
                                                                <label for="notes_from_fo" class="form-label">Notes From Front Office</label>
                                                                <textarea class="form-control @error('notes_from_fo') is-invalid @enderror" id="notes_from_fo" rows="3" name="notes_from_fo">{{ old('notes_from_fo') }}</textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="compensation" class="form-label">Compensation</label>
                                                                <input class="form-control @error('compensation') is-invalid @enderror" type="number" name="compensation" value="{{ old('compensation') }}">
                                                            </div>
                                                            <button class="btn btn-primary btn-sm ms-auto" style="display: none" id="submit_button" type="submit">Save</button>
                                                        </div>
                                                    </form>
                                                    <button class="btn btn-success btn-sm ms-auto" style="display: none" id="pay_button">Pay</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>  --}}
                            </div>
                            </td>
                            <td>

                            </td>
                        </tr>

                @endforeach
                    </tbody>
                </table>

                <!-- Modal detail -->
                <div class="modal fade" id="UserDetailsModal" tabindex="-1" aria-labelledby="UserDetailsModalLabel" aria-hidden="true" data-bs-backdrop="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="UserDetailsModalLabel">Transaction Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Full Name</th>
                                            <td class="full_name"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Guest Type</th>
                                            <td class="guest_type"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Kode Room</th>
                                            <td class="kode_room"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Room Name</th>
                                            <td class="room_name"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Room Type</th>
                                            <td class="room_type"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Floor</th>
                                            <td class="floor"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Type Transaction</th>
                                            <td class="type_transaction"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Check in</th>
                                            <td class="arrival"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Check out</th>
                                            <td class="departure"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Folio</th>
                                            <td class="folio"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Notes</th>
                                            <td class="notes"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>
</main>
<!-- Jquery -->

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    let masterIdTotalPayment;
    let masterTotalPaymentTransaction;
    let masterPaymentPaid;
    let paymentPos = 0;
    {{--  front-office/Transaction/get-total-payment/  --}}
    function modalCheck(id) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        jQuery.ajax({
            url: "/front-office/Transaction/get-total-payment/" + id,
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success:function(result){
                masterIdTotalPayment = result.total_payment.id;
                masterTotalPaymentTransaction = result.total_payment.total_payment_transaction;
                result.transaction_pos.forEach((item, index) => {
                    if(item.status_transaction !== 1) {
                        paymentPos += (item.total_transaction - item.paid_transaction)
                    }
                })
                masterPaymentPaid = result.total_payment.payment_paid;
                $('#checkoutModal').modal('show');
                if (masterPaymentPaid != masterTotalPaymentTransaction) {
                    $('#totalPayment').html(`
                    <div class="modal-body">
                        <p><strong>Payment Paid Rp:</strong> <span>`+ masterPaymentPaid +`</span></p>
                        <p><strong>Total Payment Transaction Rp:</strong> <span>`+ masterTotalPaymentTransaction +`</span></p>
                        <p><strong>Total Payment Transaction POS Rp:</strong> <span>`+ paymentPos +`</span></p>
                        <p><strong>Total Payment Unpaid Rp:</strong> <span class="text-warning">`+ (masterTotalPaymentTransaction- masterPaymentPaid + paymentPos) +`</span></p>
                    </div>
                    `);
                    $('#id_total_payment').val(masterIdTotalPayment);
                    $('#submit_button').show();
                } else {
                    $('#id_total_payment').val(masterIdTotalPayment);
                    $('#submit_button').show();
                }
            },
            error: function(error) {
            console.error('Error:', error);
            }
        })
    }
</script>

<script>
    $(document).ready(function () {


        if(session('success')) {
            alert("{{ session('success') }}");
        }
    });
</script>
<script>
    //todo:slug generate
    $(document).on('click', '.show_user_details', function (e) {
        let full_name = $(this).data('full_name');
        let guest_type = $(this).data('guest_type');
        let kode_room = $(this).data('kode_room');
        let room_name = $(this).data('room_name');
        let room_type = $(this).data('room_type');
        let floor = $(this).data('floor');
        let type_transaction = $(this).data('type_transaction');
        let arrival = $(this).data('arrival');
        let departure = $(this).data('departure');
        let folio = $(this).data('folio');
        let notes = $(this).data('notes');


        $('.full_name').text(full_name);
        $('.guest_type').text(guest_type);
        $('.kode_room').text(kode_room);
        $('.room_name').text(room_name);
        $('.room_type').text(room_type);
        $('.floor').text(floor);
        $('.type_transaction').text(type_transaction);
        $('.arrival').text(arrival);
        $('.departure').text(departure);
        $('.folio').text(folio);
        $('.notes').text(notes);


    });

    $(document).ready(function () {

        $('body').on('click', '#show_user_details', function () {
          var userURL = $(this).data('url');
          $.get(userURL, function (data) {
              $('#userShowModal').modal('show');
              $('#payment_paid').text(data.payment_paid);
              $('#total_payment_transaction').text(data.total_payment_transaction);
          })
       });

    });
</script>
<script type="text/javascript">

    $(document).ready(function () {

        $('body').on('click', '#show_user_details', function () {
          var userURL = $(this).data('url');
          $.get(userURL, function (data) {
              $('#userShowModal').modal('show');
              $('#payment_paid').text(data.payment_paid);
              $('#total_payment_transaction').text(data.total_payment_transaction);
          })
       });

    });

</script>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            #('#checkoutButton').click(function() {
                console.log('hello');
            });
        });
    </script>
    <script>
        // Ajax request to load modal content
        {{--  $(document).on('click', '#checkoutButton', function () {
            console.log('Hello');
        });  --}}

        // Ajax request to handle form submission inside the modal
        $(document).on('submit', '#checkoutForm', function (e) {
            e.preventDefault();
            // Handle form submission (e.g., send Ajax request to update status)
            // ...

            // Close the modal
            $('#checkoutModal').modal('hide');
        });
    </script>

    <!-- <script>
    // Ajax request to load modal content
        $(document).on('click', '#buttonDetailModal', function () {
            $.ajax({
                url: '/get-checkout-modal', // Replace with your route for getting modal content
                method: 'GET',
                success: function (data) {
                    $('#detailModalBody').html(data);
                    $('#detailModal').modal('show'); // Show the modal after content is loaded
                }
            });
        });

        // Close the modal when clicking the button inside the modal
        $(document).on('click', '#closeModalButton', function () {
            // Add your logic here, e.g., form submission or other actions

            // Close the modal
            $('#detailModal').modal('hide');
        });
    </script> -->



@endsection
