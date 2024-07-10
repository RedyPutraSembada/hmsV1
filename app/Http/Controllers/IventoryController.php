<?php

namespace App\Http\Controllers;

use App\Models\AdditionalItem;
use App\Models\DetilRoomAmanities;
use App\Models\Floor;
use App\Models\Iventory;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\StatusRoom;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class IventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statusRooms = StatusRoom::where('operation', 1)->get();
        $title = "Iventory";
        $rooms = Room::with('RoomType', 'StatusRoom', 'DetilRoomAmanities')->get();
        return view('pages.iventory.index', ["title" => $title, "rooms" => $rooms, "statusRooms" => $statusRooms]);
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
        $room = Room::create($data);

        if ($request->id_additional_item[0] != null) {
            for ($i=0; $i < count($request->id_additional_item); $i++) {
                $dataItem = AdditionalItem::findOrFail($request->id_additional_item[$i]);
                $qtyItemRoom = $request->qty_item[$i];
                if ($dataItem->qty < $qtyItemRoom) {
                    Alert::warning('Warning!', 'Gagal Qty Tidak Mencukupi');
                    return redirect()->back();
                }
                $qtyItem = [
                    "qty" => $dataItem->qty - $qtyItemRoom
                ];
                $dataItem->update($qtyItem);
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
    public function update(Request $request, $id)
    {
        // dd($request, $id);
        // Validasi request
        $request->validate([
            'status' => 'required|string',
        ]);

        // Cari room berdasarkan ID
        $room = Room::find($id);
        if (!$room) {
            return response()->json(['message' => 'Room not found'], 404);
        }

        // Update status room
        $room->id_status_room = $request->status;
        $room->save();

        // Kembalikan response sukses
        return response()->json(['message' => 'Room status updated successfully']);
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
