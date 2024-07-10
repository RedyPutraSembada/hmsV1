<?php

namespace App\Http\Controllers;

use App\Models\TransactionPos;
use Illuminate\Http\Request;

class TransactionPosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Transaction POS';
        $transactionPos = TransactionPos::with('Guest', 'TransactionRoom', 'ProductBuying')->get();
        // dd($transactionPos);
        // Group by id_transaction_pos and keep only the last entry of each group
        $uniqueTransactions = $transactionPos->sortBy('id')->unique('id_transaction_pos')->values();
        return view('pages.transaction-pos.index', ['title' => $title, 'transactionPos' => $transactionPos]);
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
    public function show(TransactionPos $transactionPos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransactionPos $transactionPos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransactionPos $transactionPos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransactionPos $transactionPos)
    {
        //
    }
}
