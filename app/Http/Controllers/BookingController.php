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
use App\Models\TotalPayment;
use App\Models\TravelAgent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BookingController extends Controller
{
    public function booking(string $id) {
        $title = "Booking";
        $room = Room::with('StatusRoom', 'RoomType')->findOrFail($id);
        $guests = Guest::all();
        $priceRateTypes = PriceRateType::where('id_room_type' ,$room->RoomType->id)->get();
        $occupations = Accupation::all();
        $travelAgents = TravelAgent::all();
        $sourceTravelAgents = SourceTravelAgent::with('TravelAgent')->get();
        $additionalItems = AdditionalItem::all();

        if (request('search') !== null) {
            $guests = Guest::where('full_name', 'like', '%' . request('search') . '%')->get();
        }

        return view('pages.booking.create', ['title' => $title, 'id' => $id, 'room' => $room, 'priceRateTypes' => $priceRateTypes, 'occupations' => $occupations, 'travelAgents' => $travelAgents, 'sourceTravelAgents' => $sourceTravelAgents, 'additionalItems' => $additionalItems, 'guests' => $guests,]);
    }

    public function store(Request $request){
        $detilTransactionItem = $request->validate([
            "id_transaction_room" => "nullable",
            "id_additional_item" => "nullable",
            "qty_item" => "nullable",
            "total_price" => "nullable",
        ]);

        $dataRoom = $request->validate([
            'id_room' => "required",
            'id_price_rate_type' => "required",
        ]);

        if ($request->input('id_guest') == null) {
            $dataguest = $request->validate([
                'full_name' => 'required',
                'email' => 'required|email|unique:guests,email',
                'phone' => 'required|unique:guests,phone',
                'identity_card_type' => 'required',
                'identity_card_number' => 'required',
                'exp_identity_card' => 'required',
                'nationality' => 'required',
                'state' => 'required',
                'address' => 'required',
                'city' => 'required',
                'postal' => 'required',
                'country' => 'required',
                'birth_date' => 'required',
                'city_birth' => 'required',
                'state_birth' => 'required',
                'country_birth' => 'required',
                'gender' => 'required',
                'guest_type' => 'required',
                'id_occupation' => 'required',
            ]);
            if ($request->file('image') != null) {
                $dataguest['image'] = $request->file('image')->store('images/guest', 'public');
            }
            //? Insert data Guest
            $guest  = Guest::create($dataguest);
        } else {
            $guest = Guest::findOrFail($request->input('id_guest'));
            $data = [
                "guest_type" => "Repeat"
            ];
            $guest->update($data);
        }

        $stlementOption = $request->validate([
            "type_transaction" => "required",
            "card_number" => "nullable",
            "exp_card" => "nullable",
            "folio_number" => "required",
        ]);

        // dd($request);
        $stayInformation = $request->validate([
            "arrival" => "required",
            "departure" => "required",
            "total_orang_dewasa" => "nullable",
            "total_anak" => "nullable",
            "total_bayi" => "nullable",
            "notes" => "required"
        ]);
        //! di stay information status_sewa di masukan annti saat proses otomatis on

        $busineesSourceSetting = $request->validate([
            "id_travel_agent" => "required",
            "id_source_travel_agent" => "nullable",
        ]);

        //? update status Room
        $room = Room::findOrFail($request->input("id_room"));
        $datastatus = [
            'id_status_room' => 1
        ];
        $room->update($datastatus);

        //? update status room menjadi terisi
        $room = Room::findOrFail($dataRoom["id_room"]);
        $statusBreakfast = false;
        $priceBreakFast = 0;
        if ($room->RoomType->Breakfast) {
            $statusBreakfast = 1;
            $priceBreakFast = $room->RoomType->Breakfast->total_price;
        } else {
            $statusBreakfast = 0;
            $priceBreakFast = 0;
        }
        $datastatus = [
            'id_status_room' => 1
        ];
        $room->update($data);

        //? Insert Data TransactionRoom
        if ($request->input('id_guest') == null) {
            $dataTransaction = [
                "id_guest" => $guest->id,
                "type_transaction" => $stlementOption["type_transaction"],
                "card_number" => $stlementOption["card_number"],
                "exp_card" => $stlementOption["exp_card"],
                "folio_number" => $stlementOption["folio_number"],
                "notes" => $stayInformation["notes"],
                "arrival" => $stayInformation["arrival"],
                "departure" => $stayInformation["departure"],
                "id_room" => $dataRoom["id_room"],
                "id_price_rate_type" => $dataRoom["id_price_rate_type"],
                "id_travel_agent" => $busineesSourceSetting["id_travel_agent"],
                "id_source_travel_agent" => $busineesSourceSetting["id_source_travel_agent"],
                "status_transaction" => 2,
                "status_breakfast" => $statusBreakfast,
                "price_breakfast" => $priceBreakFast,
            ];
            $transactionRoom = TransactionRoom::create($dataTransaction);
        } else {
            $dataTransaction = [
                "id_guest" => $guest->id,
                "type_transaction" => $stlementOption["type_transaction"],
                "card_number" => $stlementOption["card_number"],
                "exp_card" => $stlementOption["exp_card"],
                "folio_number" => $stlementOption["folio_number"],
                "notes" => $stayInformation["notes"],
                "arrival" => $stayInformation["arrival"],
                "departure" => $stayInformation["departure"],
                "id_room" => $dataRoom["id_room"],
                "id_price_rate_type" => $dataRoom["id_price_rate_type"],
                "id_travel_agent" => $busineesSourceSetting["id_travel_agent"],
                "id_source_travel_agent" => $busineesSourceSetting["id_source_travel_agent"],
                "status_transaction" => 2,
                "status_breakfast" => $statusBreakfast,
                "price_breakfast" => $priceBreakFast,
            ];
            $transactionRoom = TransactionRoom::create($dataTransaction);
        }


        $TotalPayment = [
            'id_transaction' => $transactionRoom->id,
            'payment_paid' => $request->payment_paid,
            'total_payment_transaction' => $request->total_payment_transaction
        ];

        $dataTotalPayment = TotalPayment::create($TotalPayment);

        $dataTransactionRoom = [
            "id_transaction_room" => $transactionRoom->id,
            "arrival" => $stayInformation["arrival"],
            "departure" => $stayInformation["departure"],
            "total_orang_dewasa" => $stayInformation["total_orang_dewasa"],
            "total_anak" => $stayInformation["total_anak"],
            "total_bayi" => $stayInformation["total_bayi"],
            "status_sewa" => 2
        ];

        $transactionSewaRoom = TransactionSewaRoom::create($dataTransactionRoom);

        if($request->id_additional_item[0] != null)
        {
            for ($i=0; $i < count($request->id_additional_item); $i++) {

                $addItem = AdditionalItem::findOrFail($request->id_additional_item[$i]);

                $total_price = ($addItem->price * $request->qty_item[$i]) * $request->total_days[$i];
                $data = [
                    "id_transaction_room" => $transactionRoom->id,
                    "id_additional_item" => $request->id_additional_item[$i],
                    "qty_item" => $request->qty_item[$i],
                    "total_days" => $request->total_days[$i],
                    "total_price" => $total_price
                ];

                DetilTransactionRoomItem::create($data);
            }
        }


        Alert::success('Success', 'Data Berhasil Booking');
        return redirect(route('reservation.index'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function hitung(Request $request)
    {

        // //! di stay information status_sewa di masukan annti saat proses otomatis on

        // $busineesSourceSetting = $request->validate([
        //     "id_travel_agent" => "required",
        //     "id_source_travel_agent" => "nullable",
        // ]);


        //! PROSES PERHITUNGAN TRANSACTION
        $masterPrice = 0;
        $Room = Room::with('RoomType', 'StatusRoom', 'Floor')->findOrFail($request->id_room);
        $total_orang_dewasa = $request->total_orang_dewasa;
        $total_anak = $request->total_anak;
        $total_bayi = $request->total_bayi;
        if ($request->has('id_additional_item')) {
            $idAdditionalItems = explode(',', $request->id_additional_item);
        } else {
            $idAdditionalItems = $request->id_additional_item;
        }
        $qtyItems = explode(',', $request->qty_items);
        $totalItemDays = explode(',', $request->total_days);
        $RoomTypeBaseAdult = $Room->RoomType->base_adult;
        $RoomTypeBaseChild = $Room->RoomType->base_child;
        $priceRateTypes = PriceRateType::findOrFail($request->id_price_rate_type);
        $arrival = $request->arrival;
        $departure = $request->departure;

        // ? Perhitungan
        $start_date = \Carbon\Carbon::createFromFormat('Y-m-d', $arrival);
        $end_date = \Carbon\Carbon::createFromFormat('Y-m-d', $departure);

        $total_day_stay = $start_date->diffInDays($end_date);

        $jmlhAdult = $RoomTypeBaseAdult - $total_orang_dewasa;
        $jmlhChild = $RoomTypeBaseChild - $total_anak;

        if ($jmlhAdult < 0) {
            $jmlhAdult = abs($jmlhAdult);
        } else {
            $jmlhAdult = 0;
        }

        if ($jmlhChild < 0) {
            $jmlhChild = abs($jmlhChild);
        } else {
            $jmlhChild = 0;
        }
        $jmlhAdult *= $priceRateTypes->extra_adult;

        //! PRICE EXTRA ADULT
        $jmlhAdult *= $total_day_stay;

        $masterPrice += $jmlhAdult;


        $jmlhChild *= $priceRateTypes->extra_child;
        //! PRICE EXTRA CHILD
        $jmlhChild *= $total_day_stay;

        $masterPrice += $jmlhChild;

        $jmlhPriceRoom = $priceRateTypes->price * $total_day_stay;

        $masterPrice += $jmlhPriceRoom;

        $dataAdditionalItems = [];
        if ($idAdditionalItems[0] != '') {
            foreach ($idAdditionalItems as $key => $value) {
                $additionalItem = AdditionalItem::findOrFail($value);
                $price = ($additionalItem->price * $qtyItems[$key]) * $totalItemDays[$key];
                    $masterPrice += $price;
                    $totalQty = $additionalItem->qty - $qtyItems[$key];
                    if ($totalQty < 0) {
                        Alert::warning('Warning!', 'Gagal Qty Tidak Mencukupi');
                        return response()->json(
                            [
                                "error" => true,
                                "message" => "Qty Tidak mencukupi"
                            ]
                        );
                    } else {
                        $dataForDetilTransactionItem = [
                            "nameItem" => $additionalItem->name,
                            "priceItem" => $additionalItem->price,
                            "qtyOrder" => $qtyItems[$key],
                            "totalDays" => $totalItemDays[$key],
                            "TotalPrice" => $price
                        ];
                        array_push($dataAdditionalItems, $dataForDetilTransactionItem);
                    }
            }
        }

        //* Membuat folio number
        // $transaction = TransactionRoom::all();
        // $totalTransaction = count($transaction);
        // $folioNumber = 'T' . str_pad($totalTransaction + 1, 6, '0', STR_PAD_LEFT);

        $transaction = TransactionRoom::all();
        $lastTransaction = $transaction->last(); // Ambil record terakhir

        $lastCode = $lastTransaction ? $lastTransaction->folio_number : 'T000000';

        // Fungsi untuk menghasilkan kode berikutnya
        function generateNextCode($lastCode) {
            $lastNumber = (int)substr($lastCode, 1);
            $nextNumber = $lastNumber + 1;
            $nextCode = sprintf('T%06d', $nextNumber);

            return $nextCode;
        }

        $newCode = generateNextCode($lastCode);


        return response()->json(
            [
                "room" => $Room,
                "jmlhPriceRoom" => $jmlhPriceRoom,
                "ExtraAdult" => $total_orang_dewasa,
                "ExtraChild" => $total_anak,
                "priceRateTypes" => $priceRateTypes,
                "total_day_stay" => $total_day_stay,
                "jmlhAdult" => $jmlhAdult,
                "jmlhChild" => $jmlhChild,
                "idAdditionalItems" => $idAdditionalItems,
                "qtyItems" => $qtyItems,
                "totalDays" => $totalItemDays,
                "dataAdditionalItems" => $dataAdditionalItems,
                "masterPrice" => $masterPrice,
                "folioNumber" => $newCode,
            ]
        );
    }

    public function getTravelAgent($id){
        $sourceTravelAgents = SourceTravelAgent::where('id_travel_agent', $id)->get();
        return response()->json($sourceTravelAgents);
    }
}
