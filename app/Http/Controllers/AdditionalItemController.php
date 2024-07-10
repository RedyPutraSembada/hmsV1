<?php

namespace App\Http\Controllers;

use App\Models\AdditionalItem;
use Illuminate\Http\Request;

class AdditionalItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Additional Item";
        $additionalItems = AdditionalItem::all();
        return view('pages.additional-item.index', ['title' => $title, 'additionalItems' => $additionalItems]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Additional Item";
        return view('pages.additional-item.create', ['title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'qty' => 'required',
            'alias' => 'required',
            'type' => 'required',
            'description' => 'required',
        ]);
        AdditionalItem::create($data);
        return redirect(route('additional-item.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(AdditionalItem $additionalItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdditionalItem $additionalItem)
    {
        $title = "Edit Additional Item";
        return view('pages.additional-item.edit', ['title' => $title, 'additionalItem' => $additionalItem]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdditionalItem $additionalItem)
    {
        $additionalItem = AdditionalItem::findOrFail($additionalItem->id);
        // dd($request->file('image'), $additionalItem);
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'qty' => 'required',
            'alias' => 'required',
            'type' => 'required',
            'description' => 'required',
        ]);
        $additionalItem->update($data);
        return redirect(route('additional-item.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdditionalItem $additionalItem)
    {
        $additionalItem = AdditionalItem::findOrFail($additionalItem->id);
        AdditionalItem::destroy($additionalItem->id);
        return redirect(route('additional-item.index'));
    }
}
