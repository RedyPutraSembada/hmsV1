<?php

namespace App\Http\Controllers;

use App\Models\Breakfast;
use Illuminate\Http\Request;

class BreakfastController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Breakfast";
        $breakfasts = Breakfast::all();
        return view('pages.breakfast.index', ['title' => $title, 'breakfasts' => $breakfasts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Breakfast";
        return view('pages.breakfast.create', ['title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'total_price' => 'required',
        ]);
        Breakfast::create($data);
        return redirect(route('breakfast.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Breakfast $breakfast)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Breakfast $breakfast)
    {
        $title = "Edit Breakfast";
        return view('pages.breakfast.edit', ['title' => $title, "breakfast" => $breakfast]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Breakfast $breakfast)
    {
        $breakfast = Breakfast::findOrFail($breakfast->id);
        $data = $request->validate([
            'name' => 'required',
            'total_price' => 'required',
        ]);
        $breakfast->update($data);
        return redirect(route('breakfast.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Breakfast $breakfast)
    {
        $breakfast = Breakfast::findOrFail($breakfast->id);
        Breakfast::destroy($breakfast->id);
        return redirect(route('breakfast.index'));
    }
}
