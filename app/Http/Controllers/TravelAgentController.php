<?php

namespace App\Http\Controllers;

use App\Models\TravelAgent;
use Illuminate\Http\Request;

class TravelAgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Travel Agent";
        $travelAgents = TravelAgent::all();
        return view('pages.travel-agent.index', ['title' => $title, 'travelAgents' => $travelAgents]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Travel Agent";
        return view('pages.travel-agent.create', ['title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);
        TravelAgent::create($data);
        return redirect(route('travel-agent.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(TravelAgent $travelAgents)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TravelAgent $travelAgent)
    {
        $title = "Edit Travel Agent";
        return view('pages.travel-agent.edit', ['title' => $title, 'travelAgent' => $travelAgent]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TravelAgent $travelAgent)
    {
        $travelAgent = TravelAgent::findOrFail($travelAgent->id);
        // dd($request->file('image'), $travelAgents);
        $data = $request->validate([
            'name' => 'required',
        ]);
        $travelAgent->update($data);
        return redirect(route('travel-agent.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TravelAgent $travelAgent)
    {
        $travelAgent = TravelAgent::findOrFail($travelAgent->id);
        TravelAgent::destroy($travelAgent->id);
        return redirect(route('travel-agent.index'));
    }
}
