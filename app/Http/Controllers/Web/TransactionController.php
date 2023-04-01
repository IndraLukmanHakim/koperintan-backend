<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $status = [
            "Pending",
            "Shipping",
            "Cancelled",
            "Failed",
            "Selesai"
        ];

        $transactions = Transaction::with('user', 'items', 'items.product')->get();
        return view('pages.transaksi', compact('transactions', 'status'));
    }

    public function updateStatus(Transaction $transaction, Request $request)
    {
        $transaction->status = $request->status;
        $transaction->save();

        return true;
    }
}
