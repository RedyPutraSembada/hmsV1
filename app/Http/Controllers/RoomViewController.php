<?php

namespace App\Http\Controllers;

use App\Models\Accupation;
use App\Models\AdditionalItem;
use App\Models\DetilRoomAmanities;
use App\Models\DetilTransactionRoomItem;
use App\Models\Guest;
use App\Models\PriceRateType;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\SourceTravelAgent;
use App\Models\TotalPayment;
use App\Models\TransactionRoom;
use App\Models\TransactionSewaRoom;
use App\Models\TravelAgent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RoomViewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Room View";
        $transactionRoom = TransactionRoom::with('TransactionSewaRoom')->where('status_transaction', '!=', 0)->first();
        $rooms = Room::with('StatusRoom', 'RoomType', 'TransactionRoom', 'Floor')->get();
        return view('pages.room-view.index', ['title' => $title, 'rooms' => $rooms, 'transactionRoom' => $transactionRoom]);
    }


    public function checkIn(string $id) {
        $title = "Check In";
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

        return view('pages.check-in.create', ['title' => $title, 'id' => $id, 'room' => $room, 'priceRateTypes' => $priceRateTypes, 'occupations' => $occupations, 'travelAgents' => $travelAgents, 'sourceTravelAgents' => $sourceTravelAgents, 'additionalItems' => $additionalItems, 'guests' => $guests,]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request){
        $noOfRoom = $request->input('no_of_room');
        $typeRoom = RoomType::with('PriceRateType', 'Breakfast')->findOrFail($request->input('type_room'));
        $rooms = Room::where('id_room_type', $typeRoom->id)
                ->where('id_status_room', 2)
                ->take($noOfRoom) // Menambahkan pengkondisian jumlah kamar yang diinginkan
                ->get();
        if ($rooms->count() < $noOfRoom) {
            Alert::error('Gagal', 'Jumlah kamar yang tersedia tidak mencukupi untuk pemesanan');
            return back(); // Atau redirect ke halaman sebelumnya
        } else {
            $dataRoom = $request->validate([
                'id_price_rate_type' => "required",
            ]);

            if ($request->input('id_guest') == null) {
                $dataguest = $request->validate([
                    'full_name' => 'required',
                    'email' => 'required|email|unique:guests,email',
                    'phone' => 'required|unique:guests,phone',
                    'address' => 'required',
                    'gender' => 'required',
                    'guest_type' => 'required',
                    'id_occupation' => 'required',
                ]);
                $dataguest['identity_card_type'] = $dataguest['identity_card_type'] ?? 0;
                $dataguest['identity_card_number'] = $dataguest['identity_card_number'] ?? 0;
                $dataguest['exp_identity_card'] = $dataguest['exp_identity_card'] ?? null;
                $dataguest['nationality'] = $dataguest['nationality'] ?? "-";
                $dataguest['state'] = $dataguest['state'] ?? "-";
                $dataguest['city'] = $dataguest['city'] ?? "-";
                $dataguest['postal'] = $dataguest['postal'] ?? "-";
                $dataguest['country'] = $dataguest['country'] ?? "-";
                $dataguest['birth_date'] = $dataguest['birth_date'] ?? '1900-01-01';
                $dataguest['city_birth'] = $dataguest['city_birth'] ?? "-";
                $dataguest['state_birth'] = $dataguest['state_birth'] ?? "-";
                $dataguest['country_birth'] = $dataguest['country_birth'] ?? "-";
                $dataguest['image'] = $dataguest['image'] ?? "-";
                $dataguest['remember_token'] = $dataguest['remember_token'] ?? "-";

                // Insert data Guest
                $dataguest['role_id'] = 2; // 2 adalah guest
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
                "eta" => "nullable",
                "etd" => "nullable",
                "total_orang_dewasa" => "nullable",
                "total_anak" => "nullable",
                "total_bayi" => "nullable",
                "notes" => "required"
            ]);
            //! di stay information status_sewa di masukan annti saat proses otomatis on

            $otherInformation = $request->validate([
                "no_of_person" => "required|numeric",
                "no_of_room" => "required|numeric",
                "booked_by" => "required|string",
                "tlp_by" => "nullable|numeric",
                "fax_by" => "nullable|numeric",
                "taken_by" => "required|string",
                "taken_time" => "required|date_format:Y-m-d\TH:i",
                "corfirmation_by" => "nullable|string",
                "confirmation_time" => "nullable|date_format:Y-m-d\TH:i",
                "input_by" => "required|string",
                "input_time" => "required|date_format:Y-m-d\TH:i",
                "checked_by" => "nullable|string",
                "checked_time" => "nullable|date_format:Y-m-d\TH:i",
            ]);

            $marketCode = $request->validate([
                "market_code" => "required",
                "arrival_flight_no" => "nullable",
                "departure_flight_no" => "nullable",
            ]);

            // ! Setelah semua validasi selesai

            //? update status Room
            // $room = Room::findOrFail($request->input("id_room"));
            // $statusBreakfast = false;
            // $priceBreakFast = 0;
            // if ($room->RoomType->Breakfast) {
            //     $statusBreakfast = 1;
            //     $priceBreakFast = $room->RoomType->Breakfast->total_price;
            // } else {
            //     $statusBreakfast = 0;
            //     $priceBreakFast = 0;
            // }
            // $datastatus = [
            //     'id_status_room' => 1
            // ];
            // $room->update($datastatus);

            //? Update status Room
            $roomsJSON = [];
            foreach ($rooms as $room) {
                $room->id_status_room = 4;
                $room->save();
                $roomsJSON[] = $room->id; // Tampung id kamar yang di-update
            }
            $roomsJSON = json_encode($roomsJSON);
            //? End Update Status Room

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
                    "id_room" => $roomsJSON,
                    "id_price_rate_type" => $dataRoom["id_price_rate_type"],
                    "id_source_travel_agent" => 0,
                    "status_transaction" => 2,
                    "status_breakfast" => null,
                    "price_breakfast" => null,
                    "market_code" => $marketCode["market_code"],
                    "arrival_flight_no" => $marketCode["arrival_flight_no"],
                    "departure_flight_no" => $marketCode["departure_flight_no"],
                    "eta" => $stayInformation["eta"],
                    "etd" => $stayInformation["etd"],
                    "no_of_person" => $otherInformation["no_of_person"],
                    "no_of_room" => $otherInformation["no_of_room"],
                    "booked_by" => $otherInformation["booked_by"],
                    "tlp_by" => $otherInformation["tlp_by"],
                    "fax_by" => $otherInformation["fax_by"],
                    "taken_by" => $otherInformation["taken_by"],
                    "taken_time" => $otherInformation["taken_time"],
                    "corfirmation_by" => $otherInformation["corfirmation_by"],
                    "confirmation_time" => $otherInformation["confirmation_time"],
                    "input_by" => $otherInformation["input_by"],
                    "input_time" => $otherInformation["input_time"],
                    "checked_by" => $otherInformation["checked_by"],
                    "checked_time" => $otherInformation["checked_time"],
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
                    "id_room" => $roomsJSON,
                    "id_price_rate_type" => $dataRoom["id_price_rate_type"],
                    "id_source_travel_agent" => 0,
                    "status_transaction" => 2,
                    "status_breakfast" => null,
                    "price_breakfast" => null,
                    "market_code" => $marketCode["market_code"],
                    "arrival_flight_no" => $marketCode["arrival_flight_no"],
                    "departure_flight_no" => $marketCode["departure_flight_no"],
                    "eta" => $stayInformation["eta"],
                    "etd" => $stayInformation["etd"],
                    "no_of_person" => $otherInformation["no_of_person"],
                    "no_of_room" => $otherInformation["no_of_room"],
                    "booked_by" => $otherInformation["booked_by"],
                    "tlp_by" => $otherInformation["tlp_by"],
                    "fax_by" => $otherInformation["fax_by"],
                    "taken_by" => $otherInformation["taken_by"],
                    "taken_time" => $otherInformation["taken_time"],
                    "corfirmation_by" => $otherInformation["corfirmation_by"],
                    "confirmation_time" => $otherInformation["confirmation_time"],
                    "input_by" => $otherInformation["input_by"],
                    "input_time" => $otherInformation["input_time"],
                    "checked_by" => $otherInformation["checked_by"],
                    "checked_time" => $otherInformation["checked_time"],
                ];
                $transactionRoom = TransactionRoom::create($dataTransaction);
            }
            $TotalPayment = [
                'id_transaction' => $transactionRoom->id,
                'payment_paid' => $request->payment_paid,
                'total_payment_transaction' => $request->total_payment_transaction,
                'deposit' => null,
            ];
            TotalPayment::create($TotalPayment);

            $dataTransactionRoom = [
                "id_transaction_room" => $transactionRoom->id,
                "arrival" => $stayInformation["arrival"],
                "departure" => $stayInformation["departure"],
                "total_orang_dewasa" => $stayInformation["total_orang_dewasa"],
                "total_anak" => $stayInformation["total_anak"],
                "total_bayi" => $stayInformation["total_bayi"],
                "status_sewa" => 1
            ];
            TransactionSewaRoom::create($dataTransactionRoom);

            Alert::success('Success', 'Data Berhasil Booking');
            return redirect(route('reservation.index'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function hitungOld(Request $request)
    {

        // //! di stay information status_sewa di masukan annti saat proses otomatis on

        // $busineesSourceSetting = $request->validate([
        //     "id_travel_agent" => "required",
        //     "id_source_travel_agent" => "nullable",
        // ]);


        //! PROSES PERHITUNGAN TRANSACTION
        $masterPrice = 0;
        $priceTotaladult = 0;
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
        $priceTotaladult += $jmlhAdult;
        // dd($jmlhAdult);

        $masterPrice += $jmlhAdult;


        $jmlhChild *= $priceRateTypes->extra_child;
        //! PRICE EXTRA CHILD
        $jmlhChild *= $total_day_stay;
        $priceTotaladult += $jmlhChild;

        $masterPrice += $jmlhChild;

        $jmlhPriceRoom = $priceRateTypes->price * $total_day_stay;

        $masterPrice += $jmlhPriceRoom;
        // dd($masterPrice);

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
        function generateNextCodeOld($lastCode) {
            $lastNumber = (int)substr($lastCode, 1);
            $nextNumber = $lastNumber + 1;
            $nextCode = sprintf('T%06d', $nextNumber);

            return $nextCode;
        }

        $newCode = generateNextCodeOld($lastCode);
        // dd($priceTotaladult);

        return response()->json(
            [
                "room" => $Room,
                "jmlhPriceRoom" => $jmlhPriceRoom,
                "priceAdultChild" => $priceTotaladult,
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

    public function hitung(Request $request)
    {
        $noOfRoom = (int)$request->no_of_room;
        // //! di stay information status_sewa di masukan annti saat proses otomatis on

        //! PROSES PERHITUNGAN TRANSACTION
        $masterPrice = 0;
        $priceTotaladult = 0;
        $market_code = true;
        $total_orang_dewasa = $request->total_orang_dewasa;
        $total_anak = $request->total_anak;
        $total_bayi = $request->total_bayi;
        $typeRoom = RoomType::findOrFail($request->type_room);
        $RoomTypeBaseAdult = $typeRoom->base_adult;
        $RoomTypeBaseChild = $typeRoom->base_child;
        $priceRateTypes = PriceRateType::with('RoomType')->findOrFail($request->id_price_rate_type);
        $arrival = $request->arrival;
        $departure = $request->departure;
        // return response()->json([$arrival, $departure]);

        // ? Perhitungan
        $start_date = Carbon::createFromFormat('Y-m-d', $arrival);
        $end_date = Carbon::createFromFormat('Y-m-d', $departure);

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
        $priceTotaladult += $jmlhAdult;

        $masterPrice += $jmlhAdult;


        $jmlhChild *= $priceRateTypes->extra_child;
        //! PRICE EXTRA CHILD
        $jmlhChild *= $total_day_stay;
        $priceTotaladult += $jmlhChild;

        $masterPrice += $jmlhChild;

        $jmlhPriceRoom = $priceRateTypes->price * $total_day_stay;

        $masterPrice += $jmlhPriceRoom; // Tambahkan harga satu kamar ke total
        $masterPrice = $masterPrice * $noOfRoom; // Kalikan total dengan jumlah kamar

        $transaction = TransactionRoom::all();
        $lastTransaction = $transaction->last(); // Ambil record terakhir

        $lastCode = $lastTransaction ? $lastTransaction->folio_number : 'T000000';

        //? cek market code nya itu oersonal atau bukan
        if ($request->market_code == "Personal") {
            $market_code = true;
        } else {
            $market_code = false;
        }

        // Fungsi untuk menghasilkan kode berikutnya
        function generateNextCode($lastCode) {
            $lastNumber = (int)substr($lastCode, 1);
            $nextNumber = $lastNumber + 1;
            $nextCode = sprintf('T%06d', $nextNumber);

            return $nextCode;
        }

        $newCode = generateNextCode($lastCode);
        // dd($priceTotaladult);

        return response()->json(
            [
                "priceAdultChild" => $priceTotaladult,
                "ExtraAdult" => $total_orang_dewasa,
                "ExtraChild" => $total_anak,
                "priceRateTypes" => $priceRateTypes,
                "total_day_stay" => $total_day_stay,
                "masterPrice" => $masterPrice,
                "typeRoom" => $typeRoom,
                "folioNumber" => $newCode,
                "statusMarketCode" => $market_code,
                "countRoom" => $noOfRoom,
            ]
        );
    }

    public function getTravelAgent($id){
        $sourceTravelAgents = SourceTravelAgent::where('id_travel_agent', $id)->get();
        return response()->json($sourceTravelAgents);
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
        //
    }
}
