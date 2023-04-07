<table>
  <thead>
  <tr>
      <th>Tanggal</th>
      <th>Nama Pembeli</th>
      <th>Nopol</th>
      <th>Barang yang Dibeli</th>
      <th>Nominal Transaksi</th>
      <th>Point Per Transaksi</th>
  </tr>
  </thead>
  <tbody>
  @foreach($transactions as $transaction)
    <tr>
      <td>{{ $transaction->created_at }}</td>
      <td>{{ $transaction->user->name }}</td>
      <td>{{ $transaction->user->nopol }}</td>
      <td>
        <ul style="list-style-type: none;">
        @foreach ($transaction->items as $item)
          <li>{{ $item->quantity }} {{ $item->product->name }}</li>
        @endforeach
        </ul>
      </td>
      <td>{{ $transaction->total_price }}</td>
      <td>{{ $transaction->total_point }}</td>
    </tr>
  @endforeach
  </tbody>
</table>