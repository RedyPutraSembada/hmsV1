@php
use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice #6</title>

    <style>
        html,
        body {
        height: 880px;
        width: 700px;
        /* to centre page on screen*/
        margin-left: auto;
        margin-right: auto;
        font-family: sans-serif;
        }
        h1,h2,h3,h4,h5,h6,p,span,label {
            font-family: sans-serif;
        }
        p {
          font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }
        table thead th {
            height: 28px;
            font-size: 16px;
            font-family: sans-serif;
        }
        table, th, td {
            border: 1px solid #ddd;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }
        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }
        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }

        .order-details tbody tr td:nth-child(3) {
            width: 10%;
        }

        .text-start {
            text-align: left;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }
        .no-border {
            border: 1px solid #fff !important;
        }
        .bg-yellow {
            background-color: #FFA800;
            color: #fff;
        }
        .bg-blue {
            background-color: #00aeff;
            color: #fff;
        }
        img {
          width: 1.5%;

        }
        hr {
          color: #FFA800;
        }
        @media print {
            .download-link {
                display: none !important;
            }
         }

         a.download-link {
            background-color: rgb(0, 170, 91);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
        }
        .button {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>


<body>
    <h1 class="text-center">PUSPA WISATA Hotel</h1>
    <h2 class="text-center">Transaction Report {{ $start_date }} to {{ $end_date }}</h2>

      <table cellspacing="0" cellpadding="3" class="order-details">
        <thead>
            <tr class="bg-yellow no-border text-center">
                <th class="text-center">Folio number</th>
                <th class="text-center">Name Room</th>
                <th class="text-center">Name Guest</th>
                <th class="text-center">Guest Type</th>
                <th class="text-center">Code Room</th>
                <th class="text-center">Room Type</th>
                <th class="text-center">Type Transaction</th>
                <th class="text-center">Check in</th>
                <th class="text-center">Check out</th>
                <th class="text-center">Total Payment</th>
                <th class="text-center">Status</th>
            </tr>
        </thead>
        @php
            $totalPayment = 0;
        @endphp
        <tbody>
            @foreach($TransactionRooms as $transaction)
            @php
            $checkInDate = Carbon::parse($transaction->arrival);
            $checkOutDate = Carbon::parse($transaction->departure);

                $totalhari = $checkInDate->diffInDays($checkOutDate);
                $adult = $transaction->TransactionSewaRoom->total_orang_dewasa;
                $child = $transaction->TransactionSewaRoom->total_anak;
                $baseChild = $transaction->Room->RoomType->base_child;
                $baseAdult = $transaction->Room->RoomType->base_adult;
                $extraAdult = $transaction->PriceRateType->extra_adult;
                $extraChild = $transaction->PriceRateType->extra_child;
                $jml1Adult = $adult - $baseAdult;
                $jml1Child = $child - $baseChild;
                $totalPembayaran = 0;
            @endphp
            @php
                $totalPembayaran += ($transaction->PriceRateType->price * $totalhari) + ($transaction->DetilTransactionRoomItem->total_price * $totalhari) + ($jml1Adult * $extraAdult * $totalhari) + ($jml1Child * $extraChild * $totalhari);
            @endphp
                @foreach ($transaction->TransactionPos as $transactionPos)
                    @foreach ($transactionPos->ProductBuying as $value)
                        {{--  @dd($value)  --}}
                        {{--  @foreach ($value->ProductBuying as $val )  --}}
                        {{--  <span>{{ $value->Product->name }} x {{ $value->qty }}</span> <br>  --}}
                        {{--  <span>Rp: {{ number_format($value->total_price, 0, ',', '.') }}</span> <br>  --}}
                        @php
                            $totalPembayaran += $value->total_price;
                        @endphp
                        {{--  @endforeach  --}}
                    @endforeach
                @endforeach
                @php
                    $totalPayment += $totalPembayaran - $transaction->Room->RoomType->Breakfast->total_price;
                @endphp
                <tr class="text-center">
                    <td>{{ $transaction->folio_number }}</td>
                    <td>{{ $transaction->Room->name }}</td>
                    <td>{{ $transaction->Guest->full_name }}</td>
                    <td>{{ $transaction->Guest->guest_type }}</td>
                    <td>{{ $transaction->Room->kode_room }}</td>
                    <td>{{ $transaction->Room->RoomType->name }}</td>
                    <td>{{ $transaction->type_transaction }}</td>
                    <td>{{ $transaction->arrival }}</td>
                    <td>{{ $transaction->departure }}</td>
                    <td>{{ number_format($totalPembayaran - $transaction->Room->RoomType->Breakfast->total_price, 0, ',', '.') }}</td>
                    <td>{{ $transaction->status_transaction == 5 ? "Cancel" : "Checkout" }}</td>
                </tr>
            @endforeach
            <tr class="bg-blue">
                <td colspan="11" class="text-end"><strong>Total Payment {{ 'Rp ' . number_format($totalPayment, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>


</body>
</html>
