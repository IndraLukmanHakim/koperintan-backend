@extends('layouts.base')
@section('title', 'Dashboard')
@section("content")

<div class="row">
  <div class="col-12">
    <!-- BEGIN Portlet -->
    <div class="portlet">
      <!-- BEGIN Widget -->
      <div class="widget10 widget10-vertical-md">
        <div class="widget10-item">
          <div class="widget10-content">
            <h2 class="widget10-title">{{ $transaksi["menunggu"] }}</h2>
            <span class="widget10-subtitle">Transaksi Menunggu</span>
          </div>
          <div class="widget10-addon">
            <!-- BEGIN Avatar -->
            <div class="avatar avatar-label-info avatar-circle widget8-avatar m-0">
              <div class="avatar-display">
                <i class="fa fa-boxes"></i>
              </div>
            </div>
            <!-- END Avatar -->
          </div>
        </div>
        <div class="widget10-item">
          <div class="widget10-content">
            <h2 class="widget10-title">{{ $transaksi["pengiriman"] }}</h2>
            <span class="widget10-subtitle">Transaksi Pengiriman</span>
          </div>
          <div class="widget10-addon">
            <!-- BEGIN Avatar -->
            <div class="avatar avatar-label-primary avatar-circle widget8-avatar m-0">
              <div class="avatar-display">
                <i class="fa fa-truck"></i>
              </div>
            </div>
            <!-- END Avatar -->
          </div>
        </div>
        <div class="widget10-item">
          <div class="widget10-content">
            <h2 class="widget10-title">{{ $transaksi["selesai"] }}</h2>
            <span class="widget10-subtitle">Transaksi Selesai</span>
          </div>
          <div class="widget10-addon">
            <!-- BEGIN Avatar -->
            <div class="avatar avatar-label-success avatar-circle widget8-avatar m-0">
              <div class="avatar-display">
                <i class="fa fa-check"></i>
              </div>
            </div>
            <!-- END Avatar -->
          </div>
        </div>
        {{-- <div class="widget10-item">
          <div class="widget10-content">
            <h2 class="widget10-title">5,726</h2>
            <span class="widget10-subtitle">Unique visits</span>
          </div>
          <div class="widget10-addon">
            <!-- BEGIN Avatar -->
            <div class="avatar avatar-label-danger avatar-circle widget8-avatar m-0">
              <div class="avatar-display">
                <i class="fa fa-link"></i>
              </div>
            </div>
            <!-- END Avatar -->
          </div>
        </div> --}}
      </div>
      <!-- END Widget -->
    </div>
    <!-- END Portlet -->
  </div>
</div>

@endsection