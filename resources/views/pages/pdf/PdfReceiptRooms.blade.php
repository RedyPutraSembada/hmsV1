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
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
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
        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }
        .order-details tbody tr td:nth-child(3) {
            width: 20%;
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
    <div style="display: flex; align-items: center; justify-content: center;">
        <img src="{{ asset('assets/assets/img/Logo-Pw.png') }}" alt="main_logo" style="width: auto; max-height: 100px; margin-bottom: -10px;">
        <h1 style="margin-left: -30px; text-align: center; flex: 1;">PUSPA WISATA Hotel</h1>
    </div>
    <p class="text-center"><img src="https://firebasestorage.googleapis.com/v0/b/hms-project-655bb.appspot.com/o/pngtreevector-location-icon-4231903-12x.png?alt=media&token=6c131f31-4cfd-4346-b966-6b6d0276f630" alt=""> Kec. Serpong, Kota Tangerang Selatan <img src="https://firebasestorage.googleapis.com/v0/b/hms-project-655bb.appspot.com/o/pngimg-12x.png?alt=media&token=ea9d133b-a639-4b5b-af93-f4bda54cfcb0" alt=""> (021) 29660971 <img src="https://firebasestorage.googleapis.com/v0/b/hms-project-655bb.appspot.com/o/mail.png?alt=media&token=bd006352-a0bd-4d7e-8851-37e5abd94291" alt=""> puspawisatapgri@gmail.com <img src="https://firebasestorage.googleapis.com/v0/b/hms-project-655bb.appspot.com/o/rectangle-12x.png?alt=media&token=a32ab212-89aa-48ef-bd97-06421075dc62" alt=""> https://puspawisatapgri.sch.id</p>
      <hr>
      <table class="order-header no-border">
          <tr class="no-border">
              <td width="50%" class="text-start company-data no-border">
                  <span><b>Paid By</b></span> <br>
                  <span>{{ $TransactionRooms->Guest->full_name }}</span> <br>
                  <span>{{ $TransactionRooms->Guest->email }}</span> <br>
                  <span>{{ $TransactionRooms->Guest->phone }}</span> <br>
              </td>
              <td width="50%" class="text-end company-data no-border">
                <h2 class="text-end">RECEIPT</h2>
                  <span></span> <br>
                  <span></span> <br>
                  <span></span> <br>
            </td>
          </tr>
      </table>




    <table class="order-details">
      <tbody>
        <tr class="no-border">
          <td class="text-start no-border">
              <span><b>Booking Details</b></span> <br>
              <span>Check-in</span> <br>
              <span>Check-out</span> <br>
              <span>Guests</span> <br>
              <span>Unit</span> <br>
          </td>
          <td class="no-border">
              <span></span> <br>
              <span>{{ $arrival }}</span> <br>
              <span>{{ $departure }}</span> <br>
              <span>{{ $Guests }}</span> <br>
              <span>{{ $TransactionRooms->PriceRateType->RoomType->name }} Room</span> <br>
          </td>
          <td class="text-start no-border">
              <span></span> <br>
              <span></span> <br>
              <span>Receipt #</span> <br>
              <span>Booking #</span> <br>
              <span></span> <br>
          </td>
          <td class="text-end no-border">
            <span></span> <br>
            <span></span> <br>
            <span>{{ $TransactionRooms->folio_number }}</span> <br>
            <span>0000011</span> <br>
            <span>{{ Carbon::now()->format('l j, F, Y') }}</span> <br>
          </td>
        </tr>
      </tbody>
  </table>

    @php
        $adult = $TransactionRooms->TransactionSewaRoom->total_orang_dewasa;
        $child = $TransactionRooms->TransactionSewaRoom->total_anak;
        $baseChild = $TransactionRooms->PriceRateType->RoomType->base_child;
        $baseAdult = $TransactionRooms->PriceRateType->RoomType->base_adult;
        $extraAdult = $TransactionRooms->PriceRateType->extra_adult;
        $extraChild = $TransactionRooms->PriceRateType->extra_child;
        $jml1Adult = $adult - $baseAdult;
        $jml1Child = $child - $baseChild;
        $totalPembayaran = 0;
    @endphp
      <table class="order-details">
        <thead>
            <tr class="bg-yellow no-border">
                <th width="50%" colspan="2" class="no-border">Description</th>
                <th width="50%" colspan="2" class="no-border text-end">Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2" class="text-start">
                    @php
                        $totalPaymentTransaction = $TransactionRooms->TotalPayment->total_payment_transaction;
                        $PaymentPaid = $TransactionRooms->TotalPayment->payment_paid;
                        $totalPayment = $totalPaymentTransaction - $PaymentPaid;
                    @endphp
                    <span>{{ $totalhari }} x Nights</span> <br>
                    @if ($TransactionRooms->DetilTransactionRoomItem && $TransactionRooms->DetilTransactionRoomItem->AdditionalItem)
                        <span>{{ $TransactionRooms->DetilTransactionRoomItem->AdditionalItem->name }} x {{ $TransactionRooms->DetilTransactionRoomItem->qty_item }}</span> <br>
                    @endif
                    @if ($jml1Adult > 0)
                        <span>Adult + {{ $jml1Adult }}</span> <br>
                    @endif
                    @if ($jml1Child > 0)
                        <span>Child + {{ $jml1Child }}</span> <br>
                    @endif
                    <span>Total Payment Room</span> <br>
                    <span>Total Payment Room Paid</span> <br>

                    <hr>
                    {{--  @foreach ($TransactionRooms->TransactionPos as $transaction)
                        @foreach ($transaction->ProductBuying as $value)
                                <span>{{ $value->Product->name }} x {{ $value->qty }}</span> <br>
                        @endforeach
                    @endforeach
                    <hr>  --}}
                    <span>Deposit </span> <br>
                    {{--  <hr>  --}}
                </td>
                <td colspan="2" class="text-end">
                    {{--  @dd($TransactionRooms->TransactionSewaRoom)  --}}
                    <span>Rp. {{ number_format($TransactionRooms->PriceRateType->price * $totalhari, 0, ',', '.') }}</span> <br>
                    @if ($TransactionRooms->DetilTransactionRoomItem)
                        <span>Rp. {{ number_format($TransactionRooms->DetilTransactionRoomItem->total_price * $totalhari, 0, ',', '.') }}</span> <br>
                    @endif
                    @if ($jml1Adult > 0)
                        <span>RP. {{ number_format($jml1Adult * $extraAdult * $totalhari, 0, ',', '.') }}</span> <br>
                    @endif
                    @if ($jml1Child > 0)
                        <span>RP. {{ number_format($jml1Child * $extraChild * $totalhari, 0, ',', '.') }}</span> <br>
                    @endif
                    <span>RP. {{ number_format($totalPaymentTransaction, 0, ',', '.') }}</span><br>
                    <span>RP. {{ number_format($PaymentPaid, 0, ',', '.') }}</span><br>

                    <hr>
                    {{--  @php
                        $totalPriceDetil = !empty($TransactionRooms->DetilTransactionRoomItem->total_price) ? $TransactionRooms->DetilTransactionRoomItem->total_price : 0;
                        $totalPembayaran = ($TransactionRooms->PriceRateType->price * $totalhari) + ($totalPriceDetil * $totalhari) + ($jml1Adult * $extraAdult * $totalhari) + ($jml1Child * $extraChild * $totalhari);
                        $totalPriceProduct = 0;
                        @endphp
                    @foreach ($TransactionRooms->TransactionPos as $transaction)
                        @foreach ($transaction->ProductBuying as $value)
                            <span>Rp. {{ number_format($value->total_price, 0, ',', '.') }}</span> <br>
                            @php
                                $totalPriceProduct += $value->total_price;
                                $totalPembayaran += $value->total_price;
                            @endphp
                        @endforeach
                    @endforeach
                    <hr>  --}}
                    <span>RP. {{ number_format($TransactionRooms->TotalPayment->deposit, 0, ',', '.') }}</span> <br>
                    {{--  <hr>  --}}
                </td>
            </tr>

            <tr class="bg-blue">
                {{--  @php
                    $totalAmount = $TransactionRooms->TotalPayment->deposit - $totalPembayaran + $totalPayment;
                @endphp  --}}
                <td colspan="4" class="text-end total-heading">
                    {{--  Total Amount: Rp {{ number_format($totalAmount, 0, ',', '.') }}
                    @if($totalAmount > 0)
                        <br> Paid by deposit
                    @endif  --}}
                </td>
              {{--  <td colspan="4" class="text-end total-heading">Total Amount: Rp {{ number_format($totalPembayaran - $TransactionRooms->TotalPayment->deposit, 0, ',', '.') }}</td>  --}}
            </tr>
        </tbody>
    </table>

    <br>
    <p class="text-center">
        Thank your for Stay at the Puspa Wisata hotel
    </p>

</body>
</html>
