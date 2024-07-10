<?php

namespace App\Http\Controllers;

use App\Models\AdditionalItem;
use App\Models\DetilRoomAmanities;
use App\Models\Floor;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\StatusRoom;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Room";
        $rooms = Room::with('RoomType', 'StatusRoom', 'DetilRoomAmanities')->get();
        return view('pages.room.index', ["title" => $title, "rooms" => $rooms]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Room";
        $roomTypes = RoomType::all();
        $statusRooms = StatusRoom::all();
        $floors = Floor::all();
        $additionalItems = AdditionalItem::all();
        return view('pages.room.create', ["title" => $title, "roomTypes" => $roomTypes, "statusRooms" => $statusRooms, "floors" => $floors, "additionalItems" => $additionalItems]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'id_status_room' => 'required',
            'id_room_type' => 'required',
            'id_floor' => 'required',
            'kode_room' => 'required',
            'status_sewa' => 'required',
        ]);

        $additionalItemIds = $request->id_additional_item;
        if (count($additionalItemIds) !== count(array_unique($additionalItemIds))) {
            Alert::warning('Warning!', 'Duplicate same items are not allowed.');
            return redirect()->back()->withInput();
        }


        $room = null; // Inisialisasi variabel $room di sini

        if ($request->id_additional_item[0] != null) {
            for ($i=0; $i < count($request->id_additional_item); $i++) {
                $dataItem = AdditionalItem::findOrFail($request->id_additional_item[$i]);
                $qtyItemRoom = $request->qty_item[$i] ?? null; // Jika null, digunakan null
                if ($qtyItemRoom === null) {
                    Alert::warning('Warning!', 'Qty Item cannot be empty.');
                    return redirect()->back()->withInput();
                }
                if ($dataItem->qty < $qtyItemRoom) {
                    Alert::warning('Warning!', 'Gagal Qty Tidak Mencukupi');
                    return redirect()->back()->withInput();
                }

                $qtyItem = [
                    "qty" => $dataItem->qty - $qtyItemRoom
                ];
                $dataItem->update($qtyItem);

                if (!$room) {
                    $room = Room::create($data); // Buat variabel $room jika belum ada
                }

                $data = [
                    "id_room" => $room->id,
                    "id_additional_item" => $request->id_additional_item[$i],
                    "qty_item" => $request->qty_item[$i],
                ];
                try {
                    DetilRoomAmanities::create($data);
                } catch (\Throwable $e) {
                    dd($e);
                }
            }
        } else {
            $room = Room::create($data); // Buat variabel $room jika tidak ada additional item
        }

        Alert::success('Success!', 'Data Room Berhasil Di Buat');
        return redirect(route('room.index'));
    }



    

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        $title = "Edit Room";
        $roomTypes = RoomType::all();
        $statusRooms = StatusRoom::all();
        $floors = Floor::all();
        $additionalItems = AdditionalItem::all();
        $room = Room::with('DetilRoomAmanities')->findOrFail($room->id);
        return view('pages.room.edit', ["title" => $title, "room" => $room, "roomTypes" => $roomTypes, "statusRooms" => $statusRooms, "floors" => $floors, "additionalItems" => $additionalItems]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $room = Room::findOrFail($room->id);
        $data = $request->validate([
            'name' => 'required',
            'id_status_room' => 'required',
            'id_room_type' => 'required',
            'id_floor' => 'required',
            'kode_room' => 'required',
            'status_sewa' => 'required',
        ]);

        
        // Check for duplicate items in the request
        $additionalItemIds = $request->id_additional_item;
        if (count($additionalItemIds) !== count(array_unique($additionalItemIds))) {
            Alert::warning('Warning!', 'Duplicate same items are not allowed.');
            return redirect()->back();
        }

        $existingDetilRoomAmanities = DetilRoomAmanities::where('id_room', $room->id)->get();
        $requestDetilRoomAmanities = $request->id_detil_room_amanities ?? [];

        // Process each existing detil room amanities
        foreach ($existingDetilRoomAmanities as $existingAmanity) {
            // Find corresponding request item
            $key = array_search($existingAmanity->id, $requestDetilRoomAmanities);
            
            if ($key !== false) {
                $newItemId = $request->id_additional_item[$key];
                $newQty = $request->qty_item[$key];
                
                if ($existingAmanity->id_additional_item == $newItemId) {
                    // Same item, just update quantity
                    if ($existingAmanity->qty_item != $newQty) {
                        $difference = $newQty - $existingAmanity->qty_item;
                        $additionalItem = AdditionalItem::findOrFail($newItemId);

                        if ($additionalItem->qty >= $difference) {
                            $additionalItem->qty -= $difference;
                            $additionalItem->save();
                            
                            $existingAmanity->qty_item = $newQty;
                            $existingAmanity->save();
                        } else {
                            Alert::warning('Warning!', 'Insufficient quantity for ' . $additionalItem->name);
                            return redirect()->back();
                        }
                    }
                } else {
                    // Different item, update item and quantity
                    $oldItem = AdditionalItem::findOrFail($existingAmanity->id_additional_item);
                    $oldItem->qty += $existingAmanity->qty_item;
                    $oldItem->save();
                    
                    $newItem = AdditionalItem::findOrFail($newItemId);
                    if ($newItem->qty >= $newQty) {
                        $newItem->qty -= $newQty;
                        $newItem->save();
                        
                        $existingAmanity->id_additional_item = $newItemId;
                        $existingAmanity->qty_item = $newQty;
                        $existingAmanity->save();
                    } else {
                        Alert::warning('Warning!', 'Insufficient quantity for ' . $newItem->name);
                        return redirect()->back();
                    }
                }
            } else {
                // Amanity was removed
                $additionalItem = AdditionalItem::findOrFail($existingAmanity->id_additional_item);
                $additionalItem->qty += $existingAmanity->qty_item;
                $additionalItem->save();
                
                $existingAmanity->delete();
            }
        }

         // Process new detil room amanities
        if (is_array($request->id_additional_item)) {
            foreach ($request->id_additional_item as $key => $itemId) {
                $newQty = $request->qty_item[$key] ?? null;
                
                if (!isset($request->id_detil_room_amanities[$key]) || empty($request->id_detil_room_amanities[$key])) {
                    if ($newQty === null) {
                        Alert::warning('Warning!', 'Qty cannot be empty.');
                        return redirect()->back();
                    }

                    $additionalItem = AdditionalItem::findOrFail($itemId);

                    if ($additionalItem->qty >= $newQty) {
                        $additionalItem->qty -= $newQty;
                        $additionalItem->save();

                        DetilRoomAmanities::create([
                            'id_room' => $room->id,
                            'id_additional_item' => $itemId,
                            'qty_item' => $newQty
                        ]);
                    } else {
                        Alert::warning('Warning!', 'Insufficient quantity for ' . $additionalItem->name);
                        return redirect()->back();
                    }
                }
            }
        }
        $room->update($data);
        return redirect(route('room.index'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room = Room::findOrFail($room->id);
        Room::destroy($room->id);
        return redirect(route('room.index'));
    }
}
