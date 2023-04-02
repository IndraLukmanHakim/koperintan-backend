<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
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

        $transaksi = [
            "menunggu" => Transaction::where('status', "Pending")->count(),
            "pengiriman" => Transaction::where('status', "Shipping")->count(),
            "selesai" => Transaction::where('status', "Selesai")->count(),
        ];
        return view('dashboard', compact('transaksi'));
    }
}
