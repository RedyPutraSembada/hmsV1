<?php

namespace App\Http\Controllers;

use App\Models\PriceRateType;
use App\Models\RoomType;
use App\Models\StatusRateType;
use Illuminate\Http\Request;

class PriceRateTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Price Rate Type";
        $priceRateTypes = PriceRateType::with('RoomType', 'StatusRateType')->get();
        return view('pages.price-rate-type.index', ['title' => $title, 'priceRateTypes' => $priceRateTypes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Price Rate Type";
        $roomTypes = RoomType::all();
        $statusRateTypes = StatusRateType::all();
        return view('pages.price-rate-type.create', ['title' => $title, 'roomTypes' => $roomTypes, 'statusRateTypes' => $statusRateTypes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'price' => 'required',
            'extra_adult' => 'required',
            'extra_child' => 'required',
            'type_day' => 'required',
            'id_room_type' => 'required',
            'id_status_rate_type' => 'required',
        ]);
        PriceRateType::create($data);
        return redirect(route('price-rate-type.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(PriceRateType $priceRateType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PriceRateType $priceRateType)
    {
        $title = "Edit Price Rate Type";
        $roomTypes = RoomType::all();
        $statusRateTypes = StatusRateType::all();
        return view('pages.price-rate-type.edit', ['title' => $title, 'roomTypes' => $roomTypes, 'priceRateType' => $priceRateType, 'statusRateTypes' => $statusRateTypes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PriceRateType $priceRateType)
    {
        $priceRateType = PriceRateType::findOrFail($priceRateType->id);
        // dd($request->file('image'), $roomType);
        $data = $request->validate([
            'price' => 'required',
            'extra_adult' => 'required',
            'extra_child' => 'required',
            'type_day' => 'required',
            'id_room_type' => 'required',
            'id_status_rate_type' => 'required',
        ]);
        $priceRateType->update($data);
        return redirect(route('price-rate-type.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PriceRateType $priceRateType)
    {
        $priceRateType = PriceRateType::findOrFail($priceRateType->id);
        PriceRateType::destroy($priceRateType->id);
        return redirect(route('price-rate-type.index'));
    }
}
