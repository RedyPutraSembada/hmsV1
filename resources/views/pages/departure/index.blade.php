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
                        {{--  <a href="{{ route('reservation.create') }}" class="btn btn-primary btn-sm ms-auto">Create Reservation</a>  --}}
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Name Room</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Name Guest</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Capacity</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Room Type</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Status Room</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($transactionRooms as $transactionRoom)
                                <tr>
                                    @php
                                        $roomIds = json_decode($transactionRoom->id_room, true);
                                        $rooms = Room::whereIn('id', $roomIds)->get();
                                    @endphp
                                    <td>
                                        <p class="align-middle text-center text-sm">
                                            <ul>
                                                @foreach ($rooms as $room)
                                                    <li>{{ $room->name }}</li>
                                                @endforeach
                                            </ul>
                                        </p>
                                    </td>
                                    <td>
                                        <p class="align-middle text-center text-sm">
                                            <p class="align-middle text-center text-sm">{{ $transactionRoom->Guest->full_name }}</p>
                                        </p>
                                    </td>

                                    <td>
                                        <p class="align-middle text-center text-sm">
                                            <ul>
                                                <li>Adult : {{ $transactionRoom->TransactionSewaRoom->total_orang_dewasa}}</li>
                                                <li>Child : {{ $transactionRoom->TransactionSewaRoom->total_anak}}</li>
                                            </ul>
                                        </p>
                                    </td>
                                    <td>
                                        <p class="align-middle text-center text-sm">{{ $transactionRoom->PriceRateType->RoomType->name}}</p>
                                    </td>
                                    <td>
                                        <p class="align-middle text-center text-sm">{{ $transactionRoom->status_transaction == 1 ? "Chek-in" : '-'}}</p>
                                    </td>
                                    <td class="align-middle text-center">

                                    {{--  @if ($transactionRoom->status_transaction == 2)  --}}
                                    <div class="row justify-content-center">
                                        <div class="col-md">
                                            <button type="button" class="custom-button-checkout mt-2" id="checkoutButton" onclick="modalCheck({{ $transactionRoom->id }})">
                                                Check Out
                                            </button>
                                        </div>
                                        {{--  <div class="button-container">
                                            <a href="/front-office/Transaction/Dwonload/{{ $transactionRoom->id }}" target="_blank" class="custom-button-invoice">
                                                Invoice
                                            </a>
                                        </div>  --}}
                                    </div>


                                    <!-- Modal for Check Out -->
                                    <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="checkoutModalLabel">Select Status Room</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body" id="checkoutModalBody">
                                                    <form action="{{ route('checkout', $transactionRoom->id) }}" method="post">
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
                                    </div>
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
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
    function number_format(number, decimals, dec_point, thousands_sep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + (Math.round(n * k) / k).toFixed(prec);
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
    {{--  front-office/Transaction/get-total-payment/  --}}
    function modalCheck(id) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        jQuery.ajax({
            url: "/front-office/Transaction/get-total-payment/" + id,
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(result) {
                var paid = 0;
                var hasil = 0;
                var discount = 0;
                var paymentPos = 0;
                var deposit = Math.floor(parseFloat(result[0].total_payment.deposit));

                result[1].forEach(function(res) {
                    paid += parseFloat(res.paid_transaction) || 0;
                    hasil += parseFloat(res.sub_total) || 0;
                });

                var hasill = deposit - (hasil - paid); // jika hasilnya (-) maka itu yang harus di bayar jika (+) maka masih terbayar oleh deposit

                // Determine the payment status for hasill
                var paymentStatusHasill = hasill >= 0 ? 'Paid' : 'Unpaid';
                var paymentClassHasill = hasill >= 0 ? 'text-success' : 'text-danger';

                var masterIdTotalPayment = result[0].total_payment.id;
                var masterTotalPaymentTransaction = parseFloat(result[0].total_payment.total_payment_transaction) || 0;
                var masterPaymentPaid = parseFloat(result[0].total_payment.payment_paid) || 0;

                result[0].transaction_pos.forEach(function(item) {
                    if (item.status_transaction !== 1) {
                        paymentPos += (parseFloat(item.total_transaction) || 0) - (parseFloat(item.paid_transaction) || 0);
                    }
                });

                // ini langkah perhitungan terakhir
                // jika hasilnya (-) maka itu yang harus di bayar jika (+) maka masih terbayar oleh deposit
                var total = hasill - (masterTotalPaymentTransaction - masterPaymentPaid);

                // Determine the payment status
                var paymentStatusTotal;
                var paymentClassTotal;
                if (total >= 0) {
                    paymentStatusTotal = 'Amount to be Refunded';
                    paymentClassTotal = 'text-success';
                } else {
                    paymentStatusTotal = 'Total Payment Unpaid';
                    paymentClassTotal = 'text-danger';
                }

                $('#checkoutModal').modal('show');
                // Generate the HTML content
                $('#totalPayment').html(`
                <div class="modal-body">
                    <p><strong>Payment Paid Rp:</strong> <span>${number_format(masterPaymentPaid, 0, ',', '.')}</span></p>
                    <p><strong>Total Payment Transaction Rp:</strong> <span>${number_format(masterTotalPaymentTransaction, 0, ',', '.')}</span></p>
                    <p><strong>Transaction POS Sub Total Rp:</strong> <span>${number_format(hasil, 0, ',', '.')}</span></p>
                    <p><strong>Transaction POS Paid Rp:</strong> <span>${number_format(paid, 0, ',', '.')}</span></p>
                    <p><strong>Deposit Rp:</strong> <span>${number_format(deposit, 0, ',', '.')}</span></p>
                    <p><strong>Total Payment Transaction POS Rp:</strong> <span>${number_format(hasill, 0, ',', '.')}</span> <span class="${paymentClassHasill}">(${paymentStatusHasill})</span></p>
                    <p><strong>${paymentStatusTotal} Rp:</strong> <span class="${paymentClassTotal}">${number_format(total, 0, ',', '.')}</span></p>
                </div>
                `);
                $('#id_total_payment').val(masterIdTotalPayment);
                $('#submit_button').show();

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
