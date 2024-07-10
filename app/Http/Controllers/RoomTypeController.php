<?php

namespace App\Http\Controllers;

use App\Models\Breakfast;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Room Type";
        $roomTypes = RoomType::with('Breakfast')->get();
        return view('pages.room-type.index', ['title' => $title, 'roomTypes' => $roomTypes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Room Type";
        $breakfasts = Breakfast::all();
        return view('pages.room-type.create', ['title' => $title, 'breakfasts' => $breakfasts]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'base_adult' => 'required',
            'base_child' => 'required',
            'breakfast_id' => 'required'
        ]);
        RoomType::create($data);
        return redirect(route('room-type.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomType $roomType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoomType $roomType)
    {
        $title = "Edit Room Type";
        $breakfasts = Breakfast::all();
        return view('pages.room-type.edit', ['title' => $title, 'roomType' => $roomType, "breakfasts" => $breakfasts]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoomType $roomType)
    {
        $roomType = RoomType::findOrFail($roomType->id);
        // dd($request->file('image'), $roomType);
        $data = $request->validate([
            'name' => 'required',
            'base_adult' => 'required',
            'base_child' => 'required',
            'breakfast_id' => 'required',
        ]);
        $roomType->update($data);
        return redirect(route('room-type.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomType $roomType)
    {
        $roomType = RoomType::findOrFail($roomType->id);
        RoomType::destroy($roomType->id);
        return redirect(route('room-type.index'));
    }
}
