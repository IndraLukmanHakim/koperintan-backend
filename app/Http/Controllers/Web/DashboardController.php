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
            "Dalam Proses",
            "Pengiriman",
            "Gagal",
            "Selesai",
        ];

        $transaksi = [
            "menunggu" => Transaction::where('status', "Dalam Proses")->count(),
            "pengiriman" => Transaction::where('status', "Pengiriman")->count(),
            "selesai" => Transaction::where('status', "Selesai")->count(),
        ];
        return view('dashboard', compact('transaksi'));
    }
}
