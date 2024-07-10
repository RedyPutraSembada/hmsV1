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
                        <h6>POS <i class="bi bi-chevron-right"></i> {{ $title }}</h6>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Name Room</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Name Guest</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Name Product</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Qty</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Total Price</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Status Transaction</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactionPos as $transaction)
                        <tr>
                            <td>
                                <p class="align-middle text-center text-sm">

                                    @php
                                        $roomIds = json_decode($transaction->TransactionRoom->id_room, true);
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
                                <p class="align-middle text-center text-sm">

                                    {{$transaction->Guest->full_name }}
                                </p>
                            </td>
                            <td>
                                <p class="align-middle text-center text-sm">
                                    <ul>
                                        @foreach ($transaction->ProductBuying as $value)
                                            <li>{{ $value->Product->name }}</li>
                                        @endforeach
                                    </ul>
                                </p>
                            </td>
                            <td>
                                <p class="align-middle text-center text-sm">
                                    <ul>
                                        @foreach ($transaction->ProductBuying as $value)
                                            <li>{{ $value->qty }}</li>
                                        @endforeach
                                    </ul>
                                </p>
                            </td>
                            <td>
                                <p class="align-middle text-center text-sm">
                                    <ul>
                                        @foreach ($transaction->ProductBuying as $value)
                                            <li>{{ number_format($value->total_price, 0, ',', '.') }}</li>
                                        @endforeach
                                    </ul>
                            </td>
                            <td>
                                <p class="align-middle text-center text-sm">

                                    {{$transaction->status_transaction == 1 ? "Paid" : "Unpaid"}}

                                </p>
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

@endsection
