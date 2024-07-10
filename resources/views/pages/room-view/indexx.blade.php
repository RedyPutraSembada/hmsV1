@extends('layouts.app')

@section('content')
<main class="main-content position-relative border-radius-lg ">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <h6>{{ $title }}</h6>
                        <a href="{{ route('reservation.create') }}" class="btn btn-primary btn-sm ms-auto">Create Reservation</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name Room</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name Guest</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Capacity</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Room Type</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Room</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Floor</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Room</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Active</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">List Item</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($rooms as $room)
                            @if ($latestTransaction = $room->TransactionRoom->where('status_transaction', '!=', 0)->last())
                                @php
                                    $statusTransaction = $room->TransactionRoom->last() == null ? 0 : $room->TransactionRoom->last()->status_transaction;
                                @endphp
                                <tr>
                                    <td>
                                        <p class="align-middle text-center text-sm">{{ $room->name}}</p>
                                    </td>
                                    {{--  @dd($room->TransactionRoom[0]->Guest->full_name)  --}}
                                    <td>
                                        <p class="align-middle text-center text-sm">
                                        @if ($latestTransaction = $room->TransactionRoom->where('status_transaction', '!=', 0)->last())
                                            {{ $latestTransaction->Guest->full_name }}
                                        @else
                                        - -
                                        @endif

                                        </p>
                                    </td>

                                    <td>
                                        <p class="align-middle text-center text-sm">
                                            <ul>
                                                <li>Adult : {{ $room->RoomType->base_adult }}</li>
                                                <li>Child : {{ $room->RoomType->base_child }}</li>
                                            </ul>
                                        </p>
                                    </td>
                                    <td>
                                        <p class="align-middle text-center text-sm">{{ $room->RoomType->name}}</p>
                                    </td>
                                    <td>
                                        <p class="align-middle text-center text-sm">{{ $room->StatusRoom->name}}</p>
                                    </td>
                                    <td>
                                        <p class="align-middle text-center text-sm">{{ $room->Floor->name}}</p>
                                    </td>
                                    <td>
                                        <p class="align-middle text-center text-sm">{{ $room->kode_room}}</p>
                                    </td>
                                    <td>
                                        <p class="align-middle text-center text-sm">{{ $room->status_sewa == 0 ? "Non-Active" : "Active"}}</p>
                                    </td>
                                    <td>
                                        <ul>
                                            @if (count($room->DetilRoomAmanities) > 0)
                                                @foreach ($room->DetilRoomAmanities as $value)
                                                    <li>{{ $value->AdditionalItem->name }} : {{ $value->qty_item }}</li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </td>
                                    <td class="align-middle text-center">

                                    @if ($statusTransaction == 2)
                                    <div>
                                        <a href="javascript:void(0)"
                                        id="show-user"
                                        data-url="{{ route('checkin.booking', $latestTransaction->id) }}"
                                        class="btn btn-success">Check In</a>
                                        <div>
                                            <form onsubmit="return confirm('Apakah yakin untuk menghapus data tersebut??');" action="{{ route('room.destroy', $room->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                    @elseif (statusTransaction == 0)
                                        <div class="container mt-4">
                                            <!-- Green Buttons -->
                                            <a href="{{ route('check-in', $room->id) }}" class="btn btn-success btn-block mr-2  ">
                                            Check In
                                            </a>
                                            <a href="{{ route('booking', $room->id) }}" class="btn btn-primary btn-block mr-2">
                                                Booking
                                            </a>
                                        </div>
                                    @elseif (statusTransaction == 0)
                                        <span class="badge bg-primary">have checked in</span>
                                    @endif
                                    <div class="container mt-2">
                                    </div>

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
                                    <form method="POST" action="/front-office/reservation/pay-transaction/{{ $latestTransaction->id }}">
                                        @csrf
                                        <div class="modal-body">
                                            <p><strong>Payment Paid Rp:</strong> <span id="payment_paid"></span></p>
                                            <p><strong>Total Payment Transaction Rp:</strong> <span id="total_payment_transaction"></span></p>
                                            <p><strong>Total Payment Unpaid Rp:</strong> <span id="payment_unpaid" class="text-warning"></span></p>
                                            <input type="hidden" name="total_di_bayar" id="total_di_bayar">
                                            <div id="colum_input" class="form-group">
                                            </div>
                                            <div id="paid" class="form-group">
                                            </div>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-center">
                                            {{--  href="{{ $latestTransaction ? route('booking.pay', $latestTransaction->id) : '#' }}"  --}}
                                            <button type="submit" id="chekin" style="display: none" class="btn btn-success btn-block mr-2">
                                                Check In
                                            </button>
                                        </form>
                                        <button class="btn btn-primary" style="display: none" id="pay">Pay</button>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</main>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
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

        {{--  $('#chekin').click(function () {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            let id_transaction = $('#id_transaction').val();
            let total = parseInt(totalPaid) + parseInt(masterPaymentPaid);
            jQuery.ajax({
                url: "/front-office/reservation/pay-transaction/" + id_transaction,
                type: "POST",
                data: {
                    '_token': csrfToken, // Sertakan token CSRF di sini
                    'total': total
                },

                success:function(result){
                    console.log(result);
                },
                error:function(error){
                    console.log("Error:", error);
                }
            });
        });  --}}

    });

</script>
<script type="text/javascript">
    function confirmCheckIn() {
        // Display a confirmation dialog
        var confirmation = confirm('Are you sure you want to check in?');

        // If the user clicks "OK", the link will be followed
        return confirmation;
    }
</script>
@endsection
