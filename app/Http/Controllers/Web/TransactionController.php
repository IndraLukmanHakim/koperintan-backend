<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    if ($request->status == "Selesai") {
      User::find($transaction->user->id)->update([
        'point' => $transaction->user->point + $transaction->total_point
      ]);

      return response()->json('selesai');
    }

    return true;
  }

  public function detail(Transaction $transaction)
  {
    $html = "
          <table class='table table-borderless'>
            <thead>
              <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
              </tr>
            </thead>
            <tbody>
        ";
    foreach ($transaction->items as $item) {
      $html .= "
              <tr>
                <td>" . $item->product->name . "</td>" .
        "<td>Rp. " . number_format($item->product->price, 0, ',', '.') . "</td>" .
        "<td>" . $item->quantity . "</td>" .
        "<td>Rp. " . number_format($item->quantity * $item->product->price, 0, ',', '.') . "</td>
              </tr>
            ";
    }
    $html .= "
            </tbody>
            <tfoot>
              <tr>
                <td colspan='3'><strong>Total Harga</strong></td>
                <td><strong>Rp. " . number_format($transaction->total_price, 0, ',', '.') . "</strong></td>
              </tr>
            </tfoot>
          </table>
        ";

    return response()->json($html);
  }

  public function invoice(Transaction $transaction)
  {
    $pdf = app('dompdf.wrapper');
    $pdf->loadView('pdf.invoice', compact('transaction'));
    $namaFile = "invoice-" . $transaction->id . date_format($transaction->created_at, 'dmY') . ".pdf";
    return $pdf->download($namaFile);
    return $pdf->stream();
  }
}
