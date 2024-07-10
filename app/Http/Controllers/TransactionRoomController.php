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


class TransactionRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Transaction";

        // Fetch rooms
        // $rooms = Room::with('StatusRoom', 'RoomType', 'TransactionRoom', 'Floor')->get();

        // Fetch status rooms separately
        $statusRooms = StatusRoom::all();

        $TransactionRooms = TransactionRoom::with('TransactionPos', 'Guest', 'Room', 'PriceRateType', 'TravelAgent', 'SourceTravelAgent', 'TotalPayment')->where('status_transaction', "!=", 0)->get();
        // $TotalPayments = TotalPayment::all();
        return view('pages.transaction.index', ['title' => $title, 'TransactionRooms' => $TransactionRooms, 'statusRooms' => $statusRooms]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function checkout(Request $request, $id)
    {
        $transactionRoom = TransactionRoom::findOrFail($id);
        // $transactionPos = TransactionPos::where('id_transaction', $id)->where('status_transaction', 0)->get();
        // foreach ($transactionPos as $transaction) {
        //     $transaction->status_transaction = 1;
        //     $transaction->save();
        // }


        // $room = Room::findOrFail($transactionRoom->Room->id);
        $totalPayment = TotalPayment::where('id_transaction', $id)->first();
        $transactionSewaRoom = TransactionSewaRoom::where('id_transaction_room', $id)->first();
        // $totalPayment = TotalPayment::findOrFail($totalPayments->id);
        // $transactionSewaRoom = TransactionSewaRoom::findOrFail($transactionSewaRooms->id);
        $detilTransactionRoomItem = DetilTransactionRoomItem::where('id_transaction_room', $id)->get();
        if (count($detilTransactionRoomItem) != 0) {
            foreach ($detilTransactionRoomItem as $key => $value) {
                $additionalItem = AdditionalItem::findOrFail($value->id_additional_item);
                $additionalItem->update(["qty" => $additionalItem->qty + $value->qty_item]);
            }
        }
        $transactionRoom->update(['status_transaction' => 6]); // Menjadi status Chekout
        $roomIds = json_decode($transactionRoom->id_room, true);
        $rooms = Room::whereIn('id', $roomIds)->get();
        foreach ($rooms as $room) {
            $room->update(['id_status_room' => $request->id_status_room]);
        }
        $totalPayment->update([
            "payment_paid" => $totalPayment->total_payment_transaction,
            "notes_from_fo" => $request->input('notes_from_fo'),
            "compensation" => $request->input('compensation')
        ]);
        $transactionSewaRoom->update(["status_sewa" => 0]);
        Alert::success('Success', 'Transaksi Berhasil Check-Out');
        return redirect()->back();
    }



    public function checkin_booking($id)
    {
        try {
            $transaction = TransactionRoom::findOrFail($id);

            // Get the related Room model
            $room = $transaction->room;

            // Find the latest TransactionRoom for the same id_room and update its status_transaction to 0
            $latestTransactionForSameRoom = TransactionRoom::where('id_room', $room->id)
                ->orderBy('created_at', 'desc')
                ->first();
            // $rooms = Room::where('id', $latestTransactionForSameRoom);
            if ($latestTransactionForSameRoom) {
                // Update the id_status_room field in Room
                $latestTransactionForSameRoom->update(['status_transaction' => 1]);
            }
            Alert::success('Success', 'Transaksi Berhasil Check-in');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::danger('Success', 'Transaksi gagal Check-in');
            return redirect()->back();
        }
    }
    public function checkinbooking($id)
    {
        try {
            $totalPayment = TotalPayment::findOrFail($id);

            // Update TotalPayment table: payment_paid = total_payment_transaction
            $totalPayment->payment_paid = $totalPayment->total_payment_transaction;
            $totalPayment->save();

            // Update TransactionRoom table: status_transaction = 0
            $transactionRoomId = $totalPayment->id; // Assuming you have a field named transaction_room_id in TotalPayment

            // Find the TransactionRoom record and update its status_transaction field
            $transactionRoom = TransactionRoom::findOrFail($transactionRoomId);
            $transactionRoom->status_transaction = 1;
            $transactionRoom->save();

            // Any additional logic or updates can be added here

            Alert::success('Success', 'Transaksi Berhasil Check-in');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::danger('Error', 'Transaksi gagal Check-in');
            return redirect()->back();
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $TotalPayments = TotalPayment::find($id);

        return response()->json($TotalPayments);
    }

    public function detail($id)
    {
        $TotalPayments = TotalPayment::find($id);

        return response()->json($TotalPayments);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransactionRoom $transactionRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransactionRoom $transactionRoom)
    {
        $transactionRoom = TransactionRoom::findOrFail($transactionRoom->id);
        $data = [
            'status_transaction' => '0'
        ];
        $transactionRoom->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransactionRoom $transactionRoom)
    {
        //
    }

    // In your controller
    public function GetDetail($roomId)
    {
        // Fetch the specific room based on the provided room ID
        $room = Room::with('StatusRoom', 'RoomType', 'TransactionRoom', 'Floor')->find($roomId);

        // Fetch status rooms separately
        $statusRooms = StatusRoom::all();

        // Fetch transaction rooms for the specific room
        $transactionRooms = TransactionRoom::with('TransactionPos')->where('room_id', $roomId)->get();

        // Pass the data to a view
        $view = View::make('your.modal.view', compact('room', 'statusRooms', 'transactionRooms'))->render();

        return response()->json(['html' => $view]);
    }


    public function MakePdf($id) {
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
        return $pdf->download('INV'.'_'.$TransactionRooms->id.'_'.$dateInv.'_'.$TransactionRooms->folio_number.'.pdf');
    }


    public function getTotalPayment($id) {
        $transactionroom = TransactionRoom::with('TotalPayment', 'TransactionPos')->findOrFail($id);
        $transactionPos = TransactionPos::with('ProductBuying')->where('id_transaction', $transactionroom->id)->get();
        return response()->json([$transactionroom, $transactionPos]);
    }


}
