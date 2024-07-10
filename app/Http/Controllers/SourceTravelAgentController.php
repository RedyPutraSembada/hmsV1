<?php

namespace App\Http\Controllers;

use App\Models\SourceTravelAgent;
use App\Models\TravelAgent;
use Illuminate\Http\Request;

class SourceTravelAgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Source Travel Agent";
        $sourceTravelAgents = SourceTravelAgent::with('TravelAgent')->get();
        return view('pages.source-travel-agent.index', ['title' => $title, 'sourceTravelAgents' => $sourceTravelAgents]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Source Travel Agent";
        $travelAgents = TravelAgent::all();
        return view('pages.source-travel-agent.create', ['title' => $title, 'travelAgents' => $travelAgents]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'comission' => 'required',
            'name' => 'required',
            'id_travel_agent' => 'required',
        ]);
        SourceTravelAgent::create($data);
        return redirect(route('source-travel-agent.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(SourceTravelAgent $sourceTravelAgent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SourceTravelAgent $sourceTravelAgent)
    {
        $title = "Edit Source Travel Agent";
        $travelAgents = TravelAgent::all();
        return view('pages.source-travel-agent.edit', ['title' => $title, 'travelAgents' => $travelAgents, 'sourceTravelAgent' => $sourceTravelAgent]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SourceTravelAgent $sourceTravelAgent)
    {
        $sourceTravelAgent = SourceTravelAgent::findOrFail($sourceTravelAgent->id);
        // dd($request->file('image'), $roomType);
        $data = $request->validate([
            'comission' => 'required',
            'name' => 'required',
            'id_travel_agent' => 'required',
        ]);
        $sourceTravelAgent->update($data);
        return redirect(route('source-travel-agent.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SourceTravelAgent $sourceTravelAgent)
    {
        $sourceTravelAgent = SourceTravelAgent::findOrFail($sourceTravelAgent->id);
        SourceTravelAgent::destroy($sourceTravelAgent->id);
        return redirect(route('source-travel-agent.index'));
    }
}
