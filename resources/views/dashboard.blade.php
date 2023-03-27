@extends('layouts.base')
@section('title', 'Dashboard')
@section("content")

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <h1>aowdaiowdjaio</h1>
      </div>
    </div>
  </div>
</div>

@endsection

@section("script")
@if(session('success'))
<script>
  Swal.fire({
    title: "{{ session('success') }}",
    icon: "success",
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ok",
  })
</script>
@endif


<script>
  $(document).ready(function () {
    $("#btn-batal").click(function () {
      Swal.fire({
        title: "Apakah anda yakin ingin membatalkan peminjaman?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya",
        cancelButtonText: "Tidak",
      }).then((result) => {
        if (result.isConfirmed) {
          $("#form-batal").submit();
        }
      });
    });

    $("#btn-selesai").click(function () {
      Swal.fire({
        title: "Apakah anda yakin telah selesai melakukan peminjaman?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya",
        cancelButtonText: "Tidak",
      }).then((result) => {
        if (result.isConfirmed) {
          $("#form-selesai").submit();
        }
      });
    });

    $(".btn-admin-hapus").click(function () {
      Swal.fire({
        title: "Apakah anda yakin ingin menghapus data ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya",
        cancelButtonText: "Tidak",
      }).then((result) => {
        if (result.isConfirmed) {
          $(this).parent().submit();
        }
      });
    });
    
  });
</script>
@endsection