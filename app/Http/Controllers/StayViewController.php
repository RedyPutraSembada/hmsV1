<?php

namespace App\Http\Controllers;

use App\Models\StayView;
use App\Models\TransactionRoom;
use Illuminate\Http\Request;

class StayViewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd("hello");
        // $isiarray = [
        //     'title' => 'Sesi ' . $value->sesi_no . ' ' . $value->topik,
        //     'url' => '/courses/schedule/' . $value->id_jadwal . '#sesi' . $value->sesi_no,
        //     'start' => $start,
        //     'end' => $end,
        // ];
        $title = "Stay View";
        // $roles = Role::all();
        return view('pages.stay-view.index', ['title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(StayView $stayView)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StayView $stayView)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StayView $stayView)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StayView $stayView)
    {
        //
    }

    public function getStayView() {
        $TransactionRooms = TransactionRoom::with('Guest', 'Room', 'PriceRateType', 'TravelAgent', 'SourceTravelAgent', 'TotalPayment')->where('status_transaction', "!=", 0)->get();
        $data = [];
        $isiarray = [];
        foreach ($TransactionRooms as $key => $value) {
            $isiarray = [
                    'title' => $value->Guest->full_name . ' Check In ' . $value->Room->name,
                    'url' => '/front-office/room-view',
                    'description' => 'HEllloooooo',
                    'start' => date('Y-m-d 10:00:00', strtotime($value->arrival)),
                    'end' => date('Y-m-d 10:00:00', strtotime($value->departure)),
                ];
            array_push($data, $isiarray);
        }
        $encoded = json_encode($data);

        echo $encoded;
    }
}
