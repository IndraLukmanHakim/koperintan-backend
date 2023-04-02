@extends('layouts.base')
@section('title', 'Kelola Produk Gallery')
@section("content")

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header bg-white">
        <h2 class="card-title">Tambah Gallery {{ $product->name }}</h2>
      </div>
      <div class="card-body">
        <form action="/produk/gallery/create/{{ $product->id }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group d-flex gap-3">
            <input type="file" name="images[]" id="images" class="form-control" multiple required>
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="col-md-12 mt-3">
    <div class="card">
      <div class="card-header bg-white">
        <h4 class="card-title">Gallery {{ $product->name }}</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped" id="table-1">
            <thead>
              <tr>
                <th class="text-center" width="5%">No</th>
                <th>Image</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($product->galleries as $gallery)
              <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>
                  <img src="{{ $gallery->url }}" alt="" width="200px">
                </td>
                <td>
                  <form action="/produk/gallery/delete/{{ $gallery->id }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-hapus">Hapus</button>
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

@endsection
@section("script")
  <script>
    $(document).ready(function () {
      $('#table-1').DataTable({});

      $("#table-1").on('click', 'tbody tr td .btn-hapus',function (e) {
        e.preventDefault();
        let id = $(this).data("id");
        let form = $(this).closest('form');
        Swal.fire({
          title: 'Konfirmasi Hapus',
          text: "Apakah anda yakin ingin menghapus data ini?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Hapus',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit();
          }
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