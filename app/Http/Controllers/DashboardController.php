<?php

namespace App\Http\Controllers;
use App\Models\TotalPayment;
use App\Models\Guest;
use App\Models\TransactionRoom;
use App\Models\Room;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the total of total_payment_transaction from TotalPayment table
        $title = 'Dashboard';
         // Get the total of total_payment_transaction from TotalPayment table
         $totalPayments = TotalPayment::all();
         $totalPaymentAmount = $totalPayments->sum('payment_paid');

         $totaltransaction = TransactionRoom::latest()->value('id');
         $totalguest = Guest::latest()->value('id');
         $totalroom = Room::latest()->value('id');
         
 
         // Format the total amount with periods and commas
         $formattedTotalAmount = number_format($totalPaymentAmount, 2, '.', ',');
         $displayTotalAmount = $totalPaymentAmount == round($totalPaymentAmount) ? number_format($totalPaymentAmount, 0, '.', ',') : $formattedTotalAmount;

        // Pass the totalTransactionAmount to the view
        return view('pages.dashboard.index', ['title' => $title, 'displayTotalAmount' => $displayTotalAmount, 'totaltransaction' => $totaltransaction, 'totalguest' => $totalguest, 'totalroom' => $totalroom]);
    }
}
