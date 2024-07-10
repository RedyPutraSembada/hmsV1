<?php

namespace App\Http\Controllers;

use App\Models\Accupation;
use App\Models\AdditionalItem;
use App\Models\DetilTransactionRoomItem;
use App\Models\Guest;
use App\Models\PriceRateType;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\SourceTravelAgent;
use App\Models\StatusRoom;
use App\Models\TotalPayment;
use App\Models\TransactionRoom;
use App\Models\TransactionSewaRoom;
use App\Models\TravelAgent;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "List Reservation";
        $transactionRooms = TransactionRoom::with('PriceRateType', 'Guest', 'TotalPayment', 'TransactionSewaRoom')->where('status_transaction', 2)->get();
        return view('pages.reservation.index', ['title' => $title, 'transactionRooms' => $transactionRooms]);
    }

    public function getRoomAmenities($id)
    {
        $room = Room::with('DetilRoomAmanities.AdditionalItem')->findOrFail($id);
        $amenities = $room->DetilRoomAmanities->map(function($item) {
            return [
                'name' => $item->AdditionalItem->name,
                'qty' => $item->qty_item
            ];
        });
        return response()->json($amenities);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Reservation Create";
        $room = Room::with('StatusRoom', 'RoomType')->where('id_status_room', 2)->get();
        $guests = Guest::all();
        $occupations = Accupation::all();
        $travelAgents = TravelAgent::all();
        $sourceTravelAgents = SourceTravelAgent::with('TravelAgent')->get();
        $additionalItems = AdditionalItem::all();
        $roomTypes = RoomType::all();

        if (request('search') !== null) {
            $guests = Guest::where('full_name', 'like', '%' . request('search') . '%')->get();
        }

        return view('pages.reservation.create', ['title' => $title, 'rooms' => $room ,'occupations' => $occupations, 'travelAgents' => $travelAgents, 'sourceTravelAgents' => $sourceTravelAgents, 'additionalItems' => $additionalItems, 'guests' => $guests, 'roomTypes' => $roomTypes]);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transactionRoom = TransactionRoom::with('Room')->findOrFail($id);
        $room = Room::findOrFail($transactionRoom->Room->id);
        $totalPayments = TotalPayment::where('id_transaction', $id)->first();
        $transactionSewaRooms = TransactionSewaRoom::where('id_transaction_room', $id)->first();
        $totalPayment = TotalPayment::findOrFail($totalPayments->id);
        $transactionSewaRoom = TransactionSewaRoom::findOrFail($transactionSewaRooms->id);
        $detilTransactionRoomItem = DetilTransactionRoomItem::where('id_transaction_room', $id)->get();
        if (count($detilTransactionRoomItem) != 0) {
            foreach ($detilTransactionRoomItem as $key => $value) {
                $additionalItem = AdditionalItem::findOrFail($value->id_additional_item);
                $additionalItem->update(["qty" => $additionalItem->qty + $value->qty_item]);
            }
        }
        $transactionRoom->update(['status_transaction' => 0]);
        $room->update(['id_status_room' => 4]);
        $transactionSewaRoom->update(["status_sewa" => 0]);
        Alert::success('Success', 'Transaksi Berhasil Di Hapus');
        return redirect()->back();
    }

    public function cancel($id)
    {
        $transactionRoom = TransactionRoom::with('Room')->findOrFail($id);
        $room = Room::findOrFail($transactionRoom->Room->id);
        $totalPayments = TotalPayment::where('id_transaction', $id)->first();
        $transactionSewaRooms = TransactionSewaRoom::where('id_transaction_room', $id)->first();
        $totalPayment = TotalPayment::findOrFail($totalPayments->id);
        $transactionSewaRoom = TransactionSewaRoom::findOrFail($transactionSewaRooms->id);
        $detilTransactionRoomItem = DetilTransactionRoomItem::where('id_transaction_room', $id)->get();
        if (count($detilTransactionRoomItem) != 0) {
            foreach ($detilTransactionRoomItem as $key => $value) {
                $additionalItem = AdditionalItem::findOrFail($value->id_additional_item);
                $additionalItem->update(["qty" => $additionalItem->qty + $value->qty_item]);
            }
        }
        $transactionRoom->update(['status_transaction' => 5]);
        $room->update(['id_status_room' => 4]);
        $transactionSewaRoom->update(["status_sewa" => 5]);
        Alert::success('Success', 'Transaksi Berhasil Di Batalkan');
        return redirect()->back();
    }

    public function getDataWhereRoom($id){
        $room = Room::with('StatusRoom', 'RoomType')->findOrFail($id);
        $rateTypes = PriceRateType::where('id_room_type', $id)->get();

        $data = [
            'room' => $room,
            'rateTypes' => $rateTypes,
        ];

        return response()->json($data);
    }

    public function getDataWhereTypeRoom($id) {
        $typeRoom = RoomType::with('PriceRateType', 'Breakfast')->findOrFail($id);
        $room = Room::where('id_room_type', $typeRoom->id)->where('id_status_room', 2)->get();
        $statusReady = "";
        if (count($room) > 0) {
            $statusReady = "Ready Room";
        } else {
            $statusReady = "Empty Room";
        }

        $data = [
            'typeRoom' => $typeRoom,
            'totalRoom' => count($room),
            'statusready' => $statusReady,
        ];

        return response()->json($data);
    }

    public function PayTransaction(Request $request, $id) {
        $transactionRoom = TransactionRoom::with('PriceRateType', 'Guest', 'TotalPayment', 'TransactionSewaRoom')->findOrFail($id);
        $transactionSewaRoom = TransactionSewaRoom::where('id_transaction_room', $transactionRoom->id)->first();
        $totalPayment = TotalPayment::findOrFail($transactionRoom->TotalPayment->id);
        $total_di_bayar = (int)$request->input('total_di_bayar');
        $payment_paid = (float)$totalPayment->payment_paid;
        $total_payment_transaction = (float)$totalPayment->total_payment_transaction;

        // Cek apakah payment_paid kurang dari total_payment_transaction
        if ($payment_paid < $total_payment_transaction) {
            // Tambahkan total_di_bayar ke payment_paid
            $payment_paid += $total_di_bayar;
            $totalPayment->update(['payment_paid' => $payment_paid]);
        }

        // Update status transaksi dan sewa
        $transactionRoom->update(['status_transaction' => 7]);
        $transactionSewaRoom->update(['status_sewa'=> 1]);

        // Set title untuk view
        $title = "Input Data Registrasion";

        // Menampilkan alert sukses
        Alert::success('Success', 'Transaksi Berhasil Registrasi Silahkan Lengkapi Data');

        // Mengembalikan view dengan data terbaru
        return view('pages.registrasion.create', ['title' => $title, 'transactionRoom' => $transactionRoom]);
    }
    public function Registrasion (Request $request, $id) {
        $transactionRoom = TransactionRoom::with('PriceRateType', 'Guest', 'TotalPayment', 'TransactionSewaRoom')->findOrFail($id);

        // Update data guest jika ada perubahan
        $guest = Guest::findOrFail($transactionRoom->Guest->id);
        $guest->nationality = $request->input('nationality');
        $guest->birth_date = $request->input('birth_date');
        $guest->save();

        // Update data deposit ke total payment jika ada
        if (!is_null($request->input('deposit'))) {
            $totalPayment = TotalPayment::findOrFail($transactionRoom->TotalPayment->id);
            $totalPayment->deposit = $request->input('deposit');
            $totalPayment->save();
        }

        // Update data lainnya ke transaction room
        $transactionRoom->purpose_of_visit = $request->input('purpose_of_visit');
        $transactionRoom->last_place_of_lodging = $request->input('last_place_of_lodging');
        $transactionRoom->next_destination = $request->input('next_destination');
        $transactionRoom->clerk = $request->input('clerk');
        $transactionRoom->date_of_issued = $request->input('date_of_issued');
        $transactionRoom->date_of_landing = $request->input('date_of_landing');
        $transactionRoom->passport_no = $request->input('passport_no'); // Update passport di TransactionRoom
        $transactionRoom->status_transaction = 1; // update status transaction menjadi checkin
        $transactionRoom->save();

        // Tampilkan pesan sukses
        Alert::success('Success', 'Data Registrasi berhasil diperbarui');

        // Redirect atau kembali ke halaman yang sesuai
        return redirect()->route('registrasion.index');
    }

    public function RegistrasionIndex() {
        $title = "List Chekin";
        $transactionRooms = TransactionRoom::with('PriceRateType', 'Guest', 'TotalPayment', 'TransactionSewaRoom')->where('status_transaction', 1)->get();
        return view('pages.registrasion.index', ['title' => $title, 'transactionRooms' => $transactionRooms]);
    }

    public function Departure() {
        $title = "List For Chek-out";
        $statusRooms = StatusRoom::all();
        $transactionRooms = TransactionRoom::with('PriceRateType', 'Guest', 'TotalPayment', 'TransactionSewaRoom')->where('status_transaction', 1)->get();
        return view('pages.departure.index', ['title' => $title, 'transactionRooms' => $transactionRooms, 'statusRooms' => $statusRooms]);
    }
}
