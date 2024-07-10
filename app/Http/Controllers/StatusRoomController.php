<?php

namespace App\Http\Controllers;

use App\Models\StatusRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StatusRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Status Room";
        $statusRooms = StatusRoom::all();
        return view('pages.status-room.index', ['title' => $title, 'statusRooms' => $statusRooms]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Status Room";
        return view('pages.status-room.create', ['title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'main_status' => 'required',
            'operation' => 'required'
        ]);

        if ($request->file('image') != null) {
            $data['image'] = $request->file('image')->store('images/status-room', 'public');
        }
        StatusRoom::create($data);
        return redirect(route('status-room.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(StatusRoom $statusRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StatusRoom $statusRoom)
    {
        $title = "Edit Status Room";
        return view('pages.status-room.edit', ['title' => $title, 'statusRoom' => $statusRoom]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StatusRoom $statusRoom)
    {
        $statusRoom = StatusRoom::findOrFail($statusRoom->id);
        // dd($request->file('image'), $statusRoom);
        $data = $request->validate([
            'name' => 'required',
            'main_status' => 'required',
            'operation' => 'required'
        ]);

        if ($request->file('image')) {
            Storage::delete($statusRoom->image);
            $data['image'] = $request->file('image')->store('images/status-room', 'public');
        } else {
            $data['image'] = $statusRoom->image;
        }
        $statusRoom->update($data);
        return redirect(route('status-room.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StatusRoom $statusRoom)
    {
        $statusRoom = StatusRoom::findOrFail($statusRoom->id);
        if ($statusRoom->image != null) {
            Storage::delete($statusRoom->image);
        }
        StatusRoom::destroy($statusRoom->id);
        return redirect(route('status-room.index'));
    }
}
