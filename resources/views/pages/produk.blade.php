@extends('layouts.base')
@section('title', 'Kelola Produk')
@section("content")

<div class="row">
  <div class="col-md-12 mb-3">
    <div class="card">
      <div class="card-header bg-white">
        <h4>Tambah Produk</h4>
      </div>
      <div class="card-body">
        <form action="/produk/create" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-3 mb-4">
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
            <div class="col-md-3 mb-4">
              <div class="input-group">
                <span class="input-group-text">Rp</span>
                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Harga" value="{{ old('price') }}">
                @error('price')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-md-3 mb-4">
              <div class="form-floating">
                <input type="text" class="form-control @error('tags') is-invalid @enderror" id="tags" name="tags" placeholder="Tags" value="{{ old('tags') }}">
                <label for="tags">Tags</label>
                @error('tags')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-md-3 mb-4">
              <div class="form-floating">
                <select class="form-select @error('categories_id') is-invalid @enderror" id="categories_id" name="categories_id">
                  @foreach ($categories as $category)
                  <option value="{{ $category->id }}" {{ old('categories_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                  @endforeach
                </select>
                <label for="categories_id">Kategori</label>
                @error('categories_id')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-md-12 mb-4">
              <div class="form-floating">
                <input class="form-control @error('photos') is-invalid @enderror" type="file" id="photos" name="photos[]" multiple accept="image/png, image/jpeg, image/jpg">
                <label for="photos">Pilih Foto</label>
                @error('photos')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-md-12 mb-4">
              <div class="form-floating">
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Deskripsi" style="height: 100px">{{ old('description') }}</textarea>
                <label for="description">Deskripsi</label>
                @error('description')
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
                    <th>Kategory</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($products as $product)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>
                      Rp. {{ number_format($product->price, 0, ',', '.') }}
                    </td>
                    <td>
                      <button type="button" class="btn btn-sm btn-primary btn-edit" data-id="{{ $product->id }}">
                        <i class="fa fa-edit"></i>
                      </button>
                      <button type="button" class="btn btn-sm btn-danger btn-hapus" data-id="{{ $product->id }}">
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
        <h5 class="modal-title">Edit Produk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/produk/update" method="POST">
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
      $('#table-1').DataTable({});

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
              url: "{{ url('produk/delete') }}" + "/" + id,
              type: "POST",
              data: {
                id: id,
                _token: "{{ csrf_token() }}"
              },
              success: function (response) {
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
            });
          }
        });
      });

      $("#table-1").on('click', 'tbody tr td .btn-edit',function () {
        let id = $(this).data("id");
        $.ajax({
          url: "/produk/get/" + id,
          type: "GET",
          success: function (data) {
            $(".modal-edit-body").html(data);
            $("#edit-modal").modal("show");
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