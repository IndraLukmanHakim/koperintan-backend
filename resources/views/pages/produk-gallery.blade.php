@extends('layouts.base')
@section('title', 'Kelola Produk Gallery')
@section("content")

<div class="row">
  @foreach ($products as $product)
  <div class="col-md-4">
    <div class="portlet">
      <div class="portlet-header portlet-header-bordered">
        <h3 class="portlet-title">{{ $product->name }}</h3>
        <div class="portlet-addon">
          <a href="/produk/gallery/{{ $product->id }}" class="btn btn-label-info" data-toggle="portlet" data-target="parent" data-behavior="toggleCollapse">
            <i class="fas fa-cog"></i>
            Kelola
          </a>
        </div>
      </div>
      <div class="portlet-body">
        <p>{{ $product->description }}</p>
        <!-- BEGIN Carousel -->
        <div class="carousel slick-item">
          @foreach ($product->galleries as $gallery)
          <div class="carousel-item">
            <!-- BEGIN Card -->
            <div class="card">
              <img src="{{ $gallery->url }}" class="card-img" style="max-height: 300px; object-fit:contain">
            </div>
            <!-- END Card -->
          </div>
          @endforeach
        </div>
        <!-- END Carousel -->
      </div>
    </div>
  </div>
  @endforeach
</div>

@endsection
@section("script")
<script>
  $(document).ready(function() {
    $('.carousel').slick({
      dots: true,
      infinite: true,
      speed: 300,
      slidesToShow: 1,
      adaptiveHeight: false
    });
  });
</script>
<script type="text/javascript" src="/dashboard_assets/assets/app/pages/elements/carousel.js"></script>

@endsection