<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Transaksi</title>

    <link rel="icon" href="logo_nota.jpeg" type="image/x-icon">

    <style>
        * {
            font-family: 'Times New Roman', Times, serif;
        }

        table, th, td {
            border: 0px solid black;
            border-collapse: collapse;
            font-size: 14px;
            line-height: 1.5;
        }

        table {
            width: 100%;
        }

        p {
            font-size: 14px;
            margin: 0;
        }
    </style>
</head>

<body style="margin: 3rem 1rem">
    <img src="logo_nota.jpeg" alt="logo" width="20%" style="position: absolute; top: 0">
    <h3 style="text-decoration: underline; text-align: center">INVOICE TRANSAKSI</h3>

    <p style="text-align: right; font-size: 12px; margin: 16px 0;">Balikpapan, {{ Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>

    {{-- Nama pembeli, tanggal checkout --}}
    <p><strong>Nama Pembeli :</strong> {{ $transaction->user->name }}</p>
    <p><strong>Tanggal Checkout :</strong> {{ $transaction->created_at->translatedFormat('d F Y') }}</p>

    <table align="justify" style="margin-top: 32px">
      <thead>
        <tr>
          <td><strong>Nama Produk</strong></td>
          <td><strong>Harga</strong></td>
          <td><strong>Jumlah</strong></td>
          <td><strong>Total Harga</strong></td>
        </tr>
      </thead>
      <tbody>
        <tr align="justify">
          <td>AWdawd</td>
          <td>Rp. 10.000</td>
          <td>2</td>
          <td>Rp. 20.000</td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3"><strong>Total Harga</strong></td>
          <td><strong>Rp. 20.000</strong></td>
        </tr>
      </tfoot>
    </table>

    <p style="margin-top: 32px; font-size: 12px; text-align: center">Terima kasih telah berbelanja di Toko Kami</p>
    
</body>
</html>