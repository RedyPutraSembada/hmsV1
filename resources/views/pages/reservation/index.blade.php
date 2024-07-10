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
                        <a href="{{ route('reservation.create') }}" class="btn btn-primary btn-sm ms-auto">Create Reservation</a>
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
                                        <p class="align-middle text-center text-sm">{{ $transactionRoom->status_transaction == 2 ? "Booking" : '-'}}</p>
                                    </td>
                                    <td class="align-middle text-center">

                                    @if ($transactionRoom->status_transaction == 2)
                                    <div class="row justify-content-center">
                                        <div class="col-md">
                                            <div class="button-container">
                                                <a href="javascript:void(0)"
                                                    id="show-user"
                                                    data-url="{{ route('checkin.booking', $transactionRoom->id) }}"
                                                    class="custom-button mt-2">Registration
                                                </a>
                                            </div>
                                        </div>
                                        <div class="button-container">
                                            <form onsubmit="return confirm('Apakah yakin untuk membatalkan data reservation tersebut??');" action="/front-office/reservation/cancel/{{ $transactionRoom->id }}" method="GET">
                                                <button class="custom-button-cancel mt-2">Cancel</button>
                                            </form>
                                        </div>
                                    </div>

                                    @else
                                    <span class="badge bg-primary">have checked in</span>
                                    @endif
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="userShowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-center">
                                        <h5 class="modal-title" id="exampleModalLabel">Pay the remainder of the Reservation</h5>
                                    </div>
                                    <form method="POST" action="/front-office/reservation/pay-transaction/{{ $transactionRoom->id }}">
                                        @csrf
                                        <div class="modal-body">
                                            {{--  <div class="form-group">
                                                <label for="status_transactions">Status Transactions</label>
                                                <select name="status_transactions" id="status_transactions" class="form-control">
                                                    <option value="Reservation">Reservation</option>
                                                    <option value="2">2</option>
                                                </select>
                                            </div>  --}}
                                            <div class="form-group">
                                                <p><strong>Payment Paid Rp:</strong> <span id="payment_paid" class="text-success"></span></p>
                                            </div>
                                            <div class="form-group">
                                                <p><strong>Total Payment Transaction Rp:</strong> <span id="total_payment_transaction" class="text-primary"></span></p>
                                            </div>
                                            <div class="form-group">
                                                <p><strong>Total Payment Unpaid Rp:</strong> <span id="payment_unpaid" class="text-warning"></span></p>
                                            </div>
                                            <input type="hidden" name="total_di_bayar" id="total_di_bayar">
                                            <div id="colum_input" class="form-group">
                                                <!-- Additional input fields can be added here -->
                                            </div>
                                            <div id="paid" class="form-group">
                                                <!-- Additional paid information can be added here -->
                                            </div>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-center">
                                            {{--  href="{{ $transactionRoom ? route('booking.pay', $transactionRoom->id) : '#' }}"  --}}
                                            <button type="submit" id="chekin" style="display: none" class="btn btn-success btn-block mr-2">
                                                Registration
                                            </button>
                                        </form>
                                        <button class="btn btn-primary" style="display: none" id="pay">Pay</button>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            {{--  @endif  --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</main>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
{{--  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>  --}}
<script type="text/javascript">

    $(document).ready(function () {
        let masterUnpaid;
        let masterTotalPayment;
        let masterPaymentPaid;
        let totalPaid;

        $('body').on('click', '#show-user', function () {
          var userURL = $(this).data('url');
            $.get(userURL, function (data) {
                let unpaid = data.total_payment_transaction - data.payment_paid;
                masterUnpaid = unpaid;
                masterTotalPayment = data.total_payment_transaction;
                masterPaymentPaid = data.payment_paid;
                $('#userShowModal').modal('show');
                $('#payment_paid').text(data.payment_paid);
                $('#total_payment_transaction').text(data.total_payment_transaction);
                if(unpaid > 0) {
                    $('#payment_unpaid').text(unpaid);
                    $('#colum_input').html(`
                        <label class="form-control-label">Pay The Bill :</label>
                        <input class="form-control" type="number" name="total_paid" id="total_paid">
                    `);
                    $('#pay').show();
                } else {
                    $('#payment_unpaid').text(0);
                    $('#chekin').show();
                }
            })
        });

        $('#pay').click(function () {
            let total = masterTotalPayment - masterPaymentPaid;
            totalPaid = $('#total_paid').val();
            let totalp = parseInt(totalPaid) + parseInt(masterPaymentPaid);
            $('#total_di_bayar').val(totalp);
            let jumlah = total - totalPaid;
            if (jumlah > 0 ) {
                $('#paid').html(`
                    <label class="form-control-label text-warning">Unpaid : `+ jumlah +`</label>
                `);
            } else {
                $('#paid').html(`
                    <label class="form-control-label text-success">Paid Off</label>
                `);
            }
            $('#chekin').show();
        });

    });

</script>
{{--  <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('#show-user').forEach(button => {
            button.addEventListener('click', function () {
                const url = this.getAttribute('data-url');

                Swal.fire({
                    title: 'Pilih Opsi',
                    input: 'select',
                    inputOptions: {
                        'option1': 'Option 1',
                        'option2': 'Option 2'
                    },
                    inputPlaceholder: 'Pilih salah satu',
                    showCancelButton: true,
                    inputValidator: (value) => {
                        return new Promise((resolve) => {
                            if (value) {
                                resolve()
                            } else {
                                resolve('Anda harus memilih salah satu opsi!')
                            }
                        })
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Lakukan sesuatu dengan pilihan yang dipilih
                        // Misalnya, arahkan ke URL dengan opsi yang dipilih sebagai parameter
                        window.location.href = `${url}?selected_option=${result.value}`;
                    }
                });
            });
        });
    });
    </script>  --}}
<script type="text/javascript">
    function confirmCheckIn() {
        // Display a confirmation dialog
        var confirmation = confirm('Are you sure you want to check in?');

        // If the user clicks "OK", the link will be followed
        return confirmation;
    }
</script>
@endsection
