@extends('layouts.base')
@section('title', 'Kelola Transaksi')
@section("content")

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover" id="table-1">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>No Telepon</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($transactions as $transaction)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaction->user->name }}</td>
                    <td>{{ $transaction->user->phone }}</td>
                    <td>Rp. {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                    <td>
                      <select name="status" class="form-control select-status" data-id="{{ $transaction->id }}">
                        @foreach ($status as $s)
                          <option value="{{ $s }}" {{ $transaction->status == $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                      </select>
                    </td>
                    <td>
                      <button type="button" class="btn btn-sm btn-primary btn-show" data-id="{{ $transaction->id }}">
                        <i class="fa fa-eye"></i>
                      </button>
                      <button type="button" class="btn btn-sm btn-danger btn-invoice" data-id="{{ $transaction->id }}">
                        <i class="fa fa-download"></i>
                      </button>
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
            _token: "{{ csrf_token() }}"
          },
          success: function (response) {
            Swal.fire({
              title: 'Sukses',
              text: "Status berhasil diubah",
              icon: 'success',
              showConfirmButton: false,
              timer: 1500
            });
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

      // $("#table-1").on('click', 'tbody tr td .btn-hapus',function () {
      //   let id = $(this).data("id");
      //   Swal.fire({
      //     title: 'Konfirmasi Hapus',
      //     text: "Apakah anda yakin ingin menghapus data ini?",
      //     icon: 'warning',
      //     showCancelButton: true,
      //     confirmButtonColor: '#3085d6',
      //     cancelButtonColor: '#d33',
      //     confirmButtonText: 'Hapus',
      //     cancelButtonText: 'Batal'
      //   }).then((result) => {
      //     if (result.value) {
      //       $.ajax({
      //         url: "{{ url('produk/delete') }}" + "/" + id,
      //         type: "POST",
      //         data: {
      //           id: id,
      //           _token: "{{ csrf_token() }}"
      //         },
      //         success: function (response) {
      //           Swal.fire({
      //             title: 'Sukses',
      //             text: "Data berhasil dihapus",
      //             icon: 'success',
      //             showConfirmButton: false,
      //             timer: 1500
      //           }).then(function () {
      //             location.reload();
      //           });
      //         },
      //       });
      //     }
      //   });
      // });

      // $("#table-1").on('click', 'tbody tr td .btn-edit',function () {
      //   let id = $(this).data("id");
      //   $.ajax({
      //     url: "/produk/get/" + id,
      //     type: "GET",
      //     success: function (data) {
      //       $(".modal-edit-body").html(data);
      //       $("#edit-modal").modal("show");
      //     },
      //   });
      // });
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