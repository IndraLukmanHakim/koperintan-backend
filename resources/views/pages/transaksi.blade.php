@extends('layouts.base')
@section('title', 'Kelola Transaksi')
@section("content")

<div class="row">
  <div class="col-md-12">
    <div class="card">
      {{-- card header with button export --}}
      <div class="card-header bg-white">
        <h4 class="card-title">Transaksi List</h4>
        <div class="card-tools">
          <form action="{{ url('transaksi/export') }}" method="GET">
            @csrf
            <button type="submit" class="btn btn-sm btn-info">
              <i class="fa fa-download"></i> Export
            </button>
          </form>
        </div>
      </div>
      {{-- <div class="card-header bg-white">
        <h4 class="card-title">Transaksi List</h4>
      </div> --}}
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover" id="table-1">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nopol</th>
                    <th>No Telepon</th>
                    <th>Alamat</th>
                    <th>Item</th>
                    <th>Total Harga</th>
                    <th>Poin</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($transactions as $transaction)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaction->user->name }}</td>
                    <td>{{ $transaction->user->nopol }}</td>
                    <td>{{ $transaction->user->phone }}</td>
                    <td>{{ $transaction->address }}</td>
                    <td>
                      {{-- looping item using ul none --}}
                      <ul class="list-unstyled">
                        @foreach ($transaction->items as $item)
                          <li>{{ $item->quantity }} {{ $item->product->name }}</li>
                        @endforeach
                      </ul>
                    </td>
                    <td>Rp. {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                    <td>{{ $transaction->total_point }}</td>
                    <td>
                      <select name="status" class="form-control select-status" data-id="{{ $transaction->id }}" @if($transaction->status == "Selesai") disabled @endif>
                        @foreach ($status as $s)
                          <option value="{{ $s }}" {{ $transaction->status == $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                      </select>
                    </td>
                    <td >
                      {{-- <button type="button" class="btn btn-sm btn-primary btn-show" data-id="{{ $transaction->id }}">
                        <i class="fa fa-eye"></i>
                      </button> --}}
                      <form class="d-inline" action="/transaksi/invoice/{{ $transaction->id }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger btn-invoice" data-id="{{ $transaction->id }}">
                          <i class="fa fa-download"></i>
                        </button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Transaction</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body modal-detail-body">
          {{--  --}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
        </div>
    </div>
  </div>
</div>

@endsection
@section("script")
  <script>
    $(document).ready(function () {
      $('#table-1').DataTable({});

      $("#table-1").on('change', 'tbody tr td .select-status',function () {
        let id = $(this).data("id");
        let status = $(this).val();
        $.ajax({
          url: "{{ url('transaksi/update-status') }}" + "/" + id,
          type: "POST",
          data: {
            id: id,
            status: status,
            _token: "{{ csrf_token() }}",
          },
          success: function (response) {
            console.log(response);
            Swal.fire({
              title: 'Sukses',
              text: "Status berhasil diubah",
              icon: 'success',
              showConfirmButton: false,
              timer: 1500
            });
            if (response == 'selesai') {
              $('.select-status').attr('disabled', 'disabled');
            }
          },
        });
      });

      $("#table-1").on('click', 'tbody tr td .btn-show',function () {
        let id = $(this).data("id");
        $.ajax({
          url: "{{ url('transaksi/detail') }}" + "/" + id,
          type: "GET",
          success: function (data) {
            console.log(data);
            $(".modal-detail-body").html(data);
            $("#detail-modal").modal("show");
          },
        });
      });
    });
  </script>
  @if (session('success'))
  <script>
    Swal.fire({
      title: 'Sukses',
      text: "{{ session('success') }}",
      icon: 'success',
      showConfirmButton: true,
    });
  </script>
  @endif

  @if ($errors->any())
  <script>
    Swal.fire({
      title: 'Gagal',
      text: "Data gagal disimpan",
      icon: 'error',
      showConfirmButton: true,
    });
  </script>
  @endif
@endsection