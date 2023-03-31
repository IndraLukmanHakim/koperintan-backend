@extends('layouts.base')
@section('title', 'Kelola User')
@section("content")

<div class="row">
  <div class="col-md-12 mb-3">
    <div class="card">
      <div class="card-header bg-white">
        <h4>Tambah User</h4>
      </div>
      <div class="card-body">
        {{-- form tambah user --}}
        <form action="/user/create" method="post">
          @csrf
          {{-- input nama, nopol, phone, password with validation error --}}
          <div class="row">
            <div class="col-md-6 mb-4">
              <div class="form-floating">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama" value="{{ old('name') }}">
                <label for="name">Nama</label>
                @error('name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 mb-4">
              <div class="form-floating">
                <input type="text" class="form-control @error('nopol') is-invalid @enderror" id="nopol" name="nopol" placeholder="Nomor Polisi" value="{{ old('nopol') }}">
                <label for="nopol">Nomor Polisi</label>
                @error('nopol')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 mb-4">
              <div class="form-floating">
                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Nomor Telepon" value="{{ old('phone') }}">
                <label for="phone">Nomor Telepon</label>
                @error('phone')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 mb-4">
              <div class="form-floating">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" value="{{ old('password') }}">
                <label for="password">Password</label>
                @error('password')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
      </div>
    </div>
  </div>
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
                    <th>Nomor Polisi</th>
                    <th>Point</th>
                    <th>Nomor Telepon</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $us)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $us->name }}</td>
                    <td>{{ $us->nopol }}</td>
                    <td>{{ $us->point }}</td>
                    <td>{{ $us->phone }}</td>
                    <td>
                      <button type="button" class="btn btn-sm btn-primary btn-edit" data-id="{{ $us->id }}">
                        <i class="fa fa-edit"></i>
                      </button>
                      <button type="button" class="btn btn-sm btn-danger btn-hapus" data-id="{{ $us->id }}">
                        <i class="fa fa-trash"></i>
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

<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/user/update" method="POST">
        @csrf
        <div class="modal-body modal-edit-body">
          {{--  --}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section("script")
<script>
  $(document).ready(function () {
    $("#table-1").DataTable();

    $("#table-1").on('click', 'tbody tr td .btn-hapus',function () {
      let id = $(this).data("id");
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
        if (result.value) {
          $.ajax({
            url: "{{ url('user/delete') }}" + "/" + id,
            type: "DELETE",
            data: {
              id: id,
              _token: "{{ csrf_token() }}"
            },
            success: function (response) {
              console.log(response);
              Swal.fire({
                title: 'Sukses',
                text: "Data berhasil dihapus",
                icon: 'success',
                showConfirmButton: false,
                timer: 1500
              }).then(function () {
                location.reload();
              });
            },
            error: function (xhr) {
              Swal.fire({
                title: 'Gagal',
                text: "Data gagal dihapus",
                icon: 'error',
                showConfirmButton: false,
                timer: 1500
              }).then(function () {
                location.reload();
              });
            }
          });
        }
      });
      
    });

    $("#table-1").on('click', 'tbody tr td .btn-edit',function () {
      let id = $(this).data("id");
      $.ajax({
        url: "/user/get/" + id,
        type: "GET",
        success: function (data) {
          $(".modal-edit-body").html(data);
          $("#edit-modal").modal("show");
        },
      });
    });
  });
</script>

{{-- if section success show swal --}}
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
@endsection