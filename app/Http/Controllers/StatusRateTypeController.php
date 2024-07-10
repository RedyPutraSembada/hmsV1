<?php

namespace App\Http\Controllers;

use App\Models\StatusRateType;
use Illuminate\Http\Request;

class StatusRateTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Status Rate Type";
        $statusRooms = StatusRateType::all();
        return view('pages.status-rate-type.index', ['title' => $title, 'statusRooms' => $statusRooms]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Status Rate Type";
        return view('pages.status-rate-type.create', ['title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        StatusRateType::create($data);
        return redirect(route('status-rate-type.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(StatusRateType $statusRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($statusRoom)
    {
        $title = "Edit Status Rate Type";
        $statusRoom = StatusRateType::findOrFail($statusRoom);
        return view('pages.status-rate-type.edit', ['title' => $title, 'statusRoom' => $statusRoom]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $statusRoom)
    {
        $statusRoom = StatusRateType::findOrFail($statusRoom);
        // dd($request->file('image'), $statusRoom);
        $data = $request->validate([
            'name' => 'required',
        ]);
        $statusRoom->update($data);
        return redirect(route('status-rate-type.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($statusRoom)
    {
        $statusRoom = StatusRateType::findOrFail($statusRoom);
        StatusRateType::destroy($statusRoom->id);
        return redirect(route('status-rate-type.index'));
    }
}
