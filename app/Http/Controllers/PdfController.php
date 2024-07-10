<?php

namespace App\Http\Controllers;


use App\Models\Accupation;
use App\Models\AdditionalItem;
use App\Models\DetilRoomAmanities;
use App\Models\DetilTransactionRoomItem;
use App\Models\Guest;
use App\Models\PriceRateType;
use App\Models\Room;
use App\Models\SourceTravelAgent;
use App\Models\TransactionRoom;
use App\Models\TransactionSewaRoom;
use App\Models\TravelAgent;
use App\Models\ProductBuying;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\StatusRoom;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\TotalPayment;
use App\Models\TransactionPos;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;


class PdfController extends Controller
{
    /**
     * Display a listing of the resource.
     */




    public function MasterBill($id) {
        $TransactionRooms = TransactionRoom::with([
            'TransactionSewaRoom',
            'TransactionPos',
            'Guest',
            'PriceRateType',
            'TravelAgent',
            'SourceTravelAgent',
            'TotalPayment',
            'DetilTransactionRoomItem'
        ])->findOrFail($id);
        // dd($TransactionRooms->TransactionPos[0]->ProductBuying);
        $transactionPos = TransactionPos::with(['ProductBuying' => function ($query) use ($id) {
            $query->where('id_transaction_pos', $id);
        }])->where('id_transaction', $id)->get();
        try {
            $products = ProductBuying::where('id_transaction_pos', $id)->get();
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle the exception
            if ($e->getCode() === '42S22') {
                // Column not found, so skip this part or handle it accordingly
                $products = collect(); // Empty collection
            } else {
                // Other database exception occurred, handle it accordingly
                throw $e;
            }
        }

        $totalPrices = [];
        foreach ($products as $product) {
            $totalPrices[] = $product->total_price;
        }
        $totalSum = array_sum($totalPrices);

        $arrival = Carbon::parse($TransactionRooms->arrival)->format('l j, F, Y');
        $departure = Carbon::parse($TransactionRooms->departure)->format('l j, F, Y');
        $totalAdults = $TransactionRooms->TransactionSewaRoom->total_orang_dewasa;
        $totalChildren = $TransactionRooms->TransactionSewaRoom->total_anak;

        if ($totalChildren !== null) {
            $Guests = "$totalAdults Adults, $totalChildren Children";
        } else {
            $Guests = "$totalAdults Adults";
        }

        $checkInDate = Carbon::parse($TransactionRooms->arrival);
        $checkOutDate = Carbon::parse($TransactionRooms->departure);

        $totalhari = $checkInDate->diffInDays($checkOutDate);

        $totalprice = $totalSum + $TransactionRooms->TotalPayment->total_payment_transaction;

        return view('pages.pdf.transactionRooms', compact('TransactionRooms', 'arrival', 'departure', 'Guests', 'totalhari', 'transactionPos' ,'totalprice'));
    }

    public function Receipt($id) {
        $TransactionRooms = TransactionRoom::with([
            'TransactionSewaRoom',
            'TransactionPos',
            'Guest',
            'PriceRateType',
            'TravelAgent',
            'SourceTravelAgent',
            'TotalPayment',
            'DetilTransactionRoomItem'
        ])->findOrFail($id);
        // dd($TransactionRooms->TransactionPos[0]->ProductBuying);
        $transactionPos = TransactionPos::with(['ProductBuying' => function ($query) use ($id) {
            $query->where('id_transaction_pos', $id);
        }])->where('id_transaction', $id)->get();
        try {
            $products = ProductBuying::where('id_transaction_pos', $id)->get();
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle the exception
            if ($e->getCode() === '42S22') {
                // Column not found, so skip this part or handle it accordingly
                $products = collect(); // Empty collection
            } else {
                // Other database exception occurred, handle it accordingly
                throw $e;
            }
        }

        $totalPrices = [];
        foreach ($products as $product) {
            $totalPrices[] = $product->total_price;
        }
        $totalSum = array_sum($totalPrices);

        $arrival = Carbon::parse($TransactionRooms->arrival)->format('l j, F, Y');
        $departure = Carbon::parse($TransactionRooms->departure)->format('l j, F, Y');
        $totalAdults = $TransactionRooms->TransactionSewaRoom->total_orang_dewasa;
        $totalChildren = $TransactionRooms->TransactionSewaRoom->total_anak;

        if ($totalChildren !== null) {
            $Guests = "$totalAdults Adults, $totalChildren Children";
        } else {
            $Guests = "$totalAdults Adults";
        }

        $checkInDate = Carbon::parse($TransactionRooms->arrival);
        $checkOutDate = Carbon::parse($TransactionRooms->departure);

        $totalhari = $checkInDate->diffInDays($checkOutDate);

        $totalprice = $totalSum + $TransactionRooms->TotalPayment->total_payment_transaction;

        return view('pages.pdf.transactionRoomsReceipt', compact('TransactionRooms', 'arrival', 'departure', 'Guests', 'totalhari', 'transactionPos' ,'totalprice'));
    }

    public function Bill($id) {
        $TransactionRooms = TransactionRoom::with([
            'TransactionSewaRoom',
            'TransactionPos',
            'Guest',
            'PriceRateType',
            'TravelAgent',
            'SourceTravelAgent',
            'TotalPayment',
            'DetilTransactionRoomItem'
        ])->findOrFail($id);
        // dd($TransactionRooms->TransactionPos[0]->ProductBuying);
        $transactionPos = TransactionPos::with(['ProductBuying' => function ($query) use ($id) {
            $query->where('id_transaction_pos', $id);
        }])->where('id_transaction', $id)->get();
        try {
            $products = ProductBuying::where('id_transaction_pos', $id)->get();
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle the exception
            if ($e->getCode() === '42S22') {
                // Column not found, so skip this part or handle it accordingly
                $products = collect(); // Empty collection
            } else {
                // Other database exception occurred, handle it accordingly
                throw $e;
            }
        }

        $totalPrices = [];
        foreach ($products as $product) {
            $totalPrices[] = $product->total_price;
        }
        $totalSum = array_sum($totalPrices);

        $arrival = Carbon::parse($TransactionRooms->arrival)->format('l j, F, Y');
        $departure = Carbon::parse($TransactionRooms->departure)->format('l j, F, Y');
        $totalAdults = $TransactionRooms->TransactionSewaRoom->total_orang_dewasa;
        $totalChildren = $TransactionRooms->TransactionSewaRoom->total_anak;

        if ($totalChildren !== null) {
            $Guests = "$totalAdults Adults, $totalChildren Children";
        } else {
            $Guests = "$totalAdults Adults";
        }

        $checkInDate = Carbon::parse($TransactionRooms->arrival);
        $checkOutDate = Carbon::parse($TransactionRooms->departure);

        $totalhari = $checkInDate->diffInDays($checkOutDate);

        $totalprice = $totalSum + $TransactionRooms->TotalPayment->total_payment_transaction;

        return view('pages.pdf.transactionRoomsBill', compact('TransactionRooms', 'arrival', 'departure', 'Guests', 'totalhari', 'transactionPos' ,'totalprice'));
    }

    public function MakePdfMasterBill($id) {
        ini_set('max_execution_time', 300);
        $TransactionRooms = TransactionRoom::with([
            'TransactionSewaRoom',
            'TransactionPos',
            'Guest',
            'Room',
            'PriceRateType',
            'TravelAgent',
            'SourceTravelAgent',
            'TotalPayment',
            'DetilTransactionRoomItem'
        ])->findOrFail($id);
        $transactionPos = TransactionPos::with(['ProductBuying' => function ($query) use ($id) {
            $query->where('id_transaction_pos', $id);
        }])->where('id_transaction', $id)->get();
        $products = ProductBuying::where('id_transaction_pos', $id)->get();
        $totalPrices = [];
        foreach ($products as $product) {
            $totalPrices[] = $product->total_price;
        }
        $totalSum = array_sum($totalPrices);

        $arrival = Carbon::parse($TransactionRooms->arrival)->format('l j, F, Y');
        $departure = Carbon::parse($TransactionRooms->departure)->format('l j, F, Y');
        $totalAdults = $TransactionRooms->TransactionSewaRoom->total_orang_dewasa;
        $totalChildren = $TransactionRooms->TransactionSewaRoom->total_anak;

        if ($totalChildren !== null) {
            $Guests = "$totalAdults Adults, $totalChildren Children";
        } else {
            $Guests = "$totalAdults Adults";
        }

        $checkInDate = Carbon::parse($TransactionRooms->arrival);
        $checkOutDate = Carbon::parse($TransactionRooms->departure);

        $totalhari = $checkInDate->diffInDays($checkOutDate);

        $totalprice = $totalSum + $TransactionRooms->TotalPayment->total_payment_transaction;
        $data = ['TransactionRooms' => $TransactionRooms,
                'arrival' => $arrival,
                'departure' => $departure,
                'Guests' => $Guests,
                'totalhari' => $totalhari,
                'transactionPos' => $transactionPos,
                'totalprice' => $totalprice
        ];
        $dateInv = Carbon::parse($TransactionRooms->arrival)->format('dmY');
        $pdf = Pdf::loadView('pages.pdf.PdfTransactionRooms', $data);
        return $pdf->download('INV'.'_'.'MB'.'_'.$TransactionRooms->id.'_'.$dateInv.'_'.$TransactionRooms->folio_number.'.pdf');
    }

    public function MakePdfReceipt($id) {
        ini_set('max_execution_time', 300);
        $TransactionRooms = TransactionRoom::with([
            'TransactionSewaRoom',
            'TransactionPos',
            'Guest',
            'PriceRateType',
            'TravelAgent',
            'SourceTravelAgent',
            'TotalPayment',
            'DetilTransactionRoomItem'
        ])->findOrFail($id);
        // dd($TransactionRooms->TransactionPos[0]->ProductBuying);
        $transactionPos = TransactionPos::with(['ProductBuying' => function ($query) use ($id) {
            $query->where('id_transaction_pos', $id);
        }])->where('id_transaction', $id)->get();
        try {
            $products = ProductBuying::where('id_transaction_pos', $id)->get();
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle the exception
            if ($e->getCode() === '42S22') {
                // Column not found, so skip this part or handle it accordingly
                $products = collect(); // Empty collection
            } else {
                // Other database exception occurred, handle it accordingly
                throw $e;
            }
        }

        $totalPrices = [];
        foreach ($products as $product) {
            $totalPrices[] = $product->total_price;
        }
        $totalSum = array_sum($totalPrices);

        $arrival = Carbon::parse($TransactionRooms->arrival)->format('l j, F, Y');
        $departure = Carbon::parse($TransactionRooms->departure)->format('l j, F, Y');
        $totalAdults = $TransactionRooms->TransactionSewaRoom->total_orang_dewasa;
        $totalChildren = $TransactionRooms->TransactionSewaRoom->total_anak;

        if ($totalChildren !== null) {
            $Guests = "$totalAdults Adults, $totalChildren Children";
        } else {
            $Guests = "$totalAdults Adults";
        }

        $checkInDate = Carbon::parse($TransactionRooms->arrival);
        $checkOutDate = Carbon::parse($TransactionRooms->departure);

        $totalhari = $checkInDate->diffInDays($checkOutDate);

        $totalprice = $totalSum + $TransactionRooms->TotalPayment->total_payment_transaction;

        $dateInv = Carbon::parse($TransactionRooms->arrival)->format('dmY');
        $pdf = Pdf::loadView('pages.pdf.PdfReceiptRooms', compact('TransactionRooms', 'arrival', 'departure', 'Guests', 'totalhari', 'transactionPos' ,'totalprice'));
        return $pdf->download('INV'.'_'.'R'.'_'.$TransactionRooms->id.'_'.$dateInv.'_'.$TransactionRooms->folio_number.'.pdf');
    }

    public function MakePdfBill($id) {
        ini_set('max_execution_time', 300);
        $TransactionRooms = TransactionRoom::with([
            'TransactionSewaRoom',
            'TransactionPos',
            'Guest',
            'PriceRateType',
            'TravelAgent',
            'SourceTravelAgent',
            'TotalPayment',
            'DetilTransactionRoomItem'
        ])->findOrFail($id);
        // dd($TransactionRooms->TransactionPos[0]->ProductBuying);
        $transactionPos = TransactionPos::with(['ProductBuying' => function ($query) use ($id) {
            $query->where('id_transaction_pos', $id);
        }])->where('id_transaction', $id)->get();
        try {
            $products = ProductBuying::where('id_transaction_pos', $id)->get();
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle the exception
            if ($e->getCode() === '42S22') {
                // Column not found, so skip this part or handle it accordingly
                $products = collect(); // Empty collection
            } else {
                // Other database exception occurred, handle it accordingly
                throw $e;
            }
        }

        $totalPrices = [];
        foreach ($products as $product) {
            $totalPrices[] = $product->total_price;
        }
        $totalSum = array_sum($totalPrices);

        $arrival = Carbon::parse($TransactionRooms->arrival)->format('l j, F, Y');
        $departure = Carbon::parse($TransactionRooms->departure)->format('l j, F, Y');
        $totalAdults = $TransactionRooms->TransactionSewaRoom->total_orang_dewasa;
        $totalChildren = $TransactionRooms->TransactionSewaRoom->total_anak;

        if ($totalChildren !== null) {
            $Guests = "$totalAdults Adults, $totalChildren Children";
        } else {
            $Guests = "$totalAdults Adults";
        }

        $checkInDate = Carbon::parse($TransactionRooms->arrival);
        $checkOutDate = Carbon::parse($TransactionRooms->departure);

        $totalhari = $checkInDate->diffInDays($checkOutDate);

        $totalprice = $totalSum + $TransactionRooms->TotalPayment->total_payment_transaction;

        $dateInv = Carbon::parse($TransactionRooms->arrival)->format('dmY');
        $pdf = Pdf::loadView('pages.pdf.PdfBillRooms', compact('TransactionRooms', 'arrival', 'departure', 'Guests', 'totalhari', 'transactionPos' ,'totalprice'));
        return $pdf->download('INV'.'_'.'B'.'_'.$TransactionRooms->id.'_'.$dateInv.'_'.$TransactionRooms->folio_number.'.pdf');
    }


    public function getTotalPayment($id) {
        $transactionroom = TransactionRoom::with('TotalPayment', 'TransactionPos')->findOrFail($id);
        $transactionPos = TransactionPos::with('ProductBuying')->where('id_transaction', $transactionroom->id)->get();
        return response()->json([$transactionroom, $transactionPos]);
    }


}
