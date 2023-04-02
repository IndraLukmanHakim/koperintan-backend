<!DOCTYPE html>
<html lang="en" dir="ltr" data-theme="light">
<head>
	<!-- BEGIN Import Analytics Scripts -->
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&amp;family=Roboto+Mono&amp;display=swap" rel="stylesheet">
	<link href="/dashboard_assets/assets/build/styles/ltr-core.css" rel="stylesheet">
	<link href="/dashboard_assets/assets/build/styles/ltr-vendor.css" rel="stylesheet">
	<link href="/logo.png" rel="shortcut icon" type="image/x-icon">
	<title>@yield("title") | KOPERINTAN</title>

	{{-- style scrollbar --}}
	<style>
		::-webkit-scrollbar {
			width: 10px;
		}
		::-webkit-scrollbar-track {
			background: #f1f1f1;
		}
		::-webkit-scrollbar-thumb {
			background: #00BCD4;
		}
		::-webkit-scrollbar-thumb:hover {
			background: #555;
		}
	</style>

	@yield('css')
</head>

<body class="preload-active aside-active aside-mobile-minimized aside-desktop-maximized">
	<!-- BEGIN Preload -->
	<div class="preload">
		<div class="preload-dialog">
			<!-- BEGIN Spinner -->
			<div class="spinner-border text-primary preload-spinner"></div>
			<!-- END Spinner -->
		</div>
	</div>
	<!-- END Preload -->
	<!-- BEGIN Page Holder -->
	<div class="holder">
		<!-- BEGIN Aside -->
		<div class="aside">
			<div class="aside-header">
				<h3 class="aside-title">KOPERINTAN</h3>
				<div class="aside-addon">
					<button class="btn btn-label-primary btn-icon btn-lg" data-toggle="aside">
						<i class="fa fa-times aside-icon-minimize"></i>
						<i class="fa fa-thumbtack aside-icon-maximize"></i>
					</button>
				</div>
			</div>
			<div class="aside-body" data-simplebar data-simplebar-direction="ltr">
				<!-- BEGIN Menu -->
				<div class="menu">
					<div class="menu-item">
						<a href="/" data-menu-path="/index.html" class="menu-item-link">
							<div class="menu-item-icon">
								<i class="fa fa-desktop"></i>
							</div>
							<span class="menu-item-text">Dashboard</span>
						</a>
					</div>
					<!-- BEGIN Menu Section -->
					<div class="menu-section">
						<div class="menu-section-icon">
							<i class="fa fa-ellipsis-h"></i>
						</div>
						<h2 class="menu-section-text">Halaman</h2>
					</div>
					<!-- END Menu Section -->
					<div class="menu-item">
						<a href="/user" data-menu-path="/user" class="menu-item-link">
							<div class="menu-item-icon">
								<i class="fa fa-user"></i>
							</div>
							<span class="menu-item-text">Kelola User</span>
						</a>
					</div>
					{{-- <div class="menu-item">
						<a href="/produk" data-menu-path="/produk" class="menu-item-link">
							<div class="menu-item-icon">
								<i class="fa fa-box"></i>
							</div>
							<span class="menu-item-text">Kelola Produk</span>
						</a>
					</div> --}}
					<div class="menu-item">
						<button class="menu-item-link menu-item-toggle">
							<div class="menu-item-icon">
								<i class="fa fa-box"></i>
							</div>
							<span class="menu-item-text">Produk</span>
							<div class="menu-item-addon">
								<i class="menu-item-caret caret"></i>
							</div>
						</button>
						<!-- BEGIN Menu Submenu -->
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="/produk" data-menu-path="/produk" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Kelola Produk</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="/produk/gallery" data-menu-path="/produk/gallery" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Gallery Produk</span>
								</a>
							</div>
						</div>
						<!-- END Menu Submenu -->
					</div>
					<div class="menu-item">
						<a href="/transaksi" data-menu-path="/transaksi" class="menu-item-link">
							<div class="menu-item-icon">
								<i class="fa fa-money-bill"></i>
							</div>
							<span class="menu-item-text">Kelola Transaksi</span>
						</a>
					</div>
				</div>
				<!-- END Menu -->
			</div>
		</div>
		<!-- END Aside -->
		<!-- BEGIN Page Wrapper -->
		<div class="wrapper ">
			<!-- BEGIN Header -->
			<div class="header">
				<!-- BEGIN Header Holder -->
				<div class="header-holder header-holder-desktop">
					<div class="header-container container-fluid g-4">
						<h4 class="header-title">@yield("title")</h4>
						<i class="header-divider"></i>
						<div class="header-wrap header-wrap-block justify-content-start">
							<!-- BEGIN Breadcrumb -->
							<div class="breadcrumb breadcrumb-transparent mb-0">
								<a href="/" class="breadcrumb-item">
									<div class="breadcrumb-icon">
										<i data-feather="home"></i>
									</div>
									<span class="breadcrumb-text">Dashboard</span>
								</a>
								@yield('breadcrumb')
							</div>
							<!-- END Breadcrumb -->
						</div>
						<div class="header-wrap">
							<!-- BEGIN Dropdown -->
							<div class="dropdown">
								<button class="btn btn-flat-primary widget13" data-bs-toggle="dropdown">
									<div class="widget13-text">Hi <strong>{{ Auth::user()->name }}</strong>
									</div>
									<!-- BEGIN Avatar -->
									<div class="avatar avatar-info widget13-avatar">
										<div class="avatar-display">
											<i class="fa fa-user-alt"></i>
										</div>
									</div>
									<!-- END Avatar -->
								</button>
								<div class="dropdown-menu dropdown-menu-wide dropdown-menu-end dropdown-menu-animated overflow-hidden py-0">
									<!-- BEGIN Portlet -->
									<div class="portlet border-0">
										<div class="portlet-header bg-primary rounded-0">
											<!-- BEGIN Rich List Item -->
											<div class="rich-list-item w-100 p-0">
												<div class="rich-list-prepend">
													<!-- BEGIN Avatar -->
													<div class="avatar avatar-label-light avatar-circle">
														<div class="avatar-display">
															<i class="fa fa-user-alt"></i>
														</div>
													</div>
													<!-- END Avatar -->
												</div>
												<div class="rich-list-content">
													<h3 class="rich-list-title text-white thumbnail-fullname">{{ Auth::user()->name }}</h3>
													<span class="rich-list-subtitle text-white thumbnail-email">{{ Auth::user()->email }}</span>
												</div>
											</div>
											<!-- END Rich List Item -->
										</div>
										<div class="portlet-footer portlet-footer-bordered rounded-0">
											<form action="/logout" method="post">
												@csrf
												<button type="button" class="btn btn-label-danger logout-trigger btn-logout">Keluar</button>
											</form>
										</div>
									</div>
									<!-- END Portlet -->
								</div>
							</div>
							<!-- END Dropdown -->
						</div>
					</div>
				</div>
				<!-- END Header Holder -->
				<!-- BEGIN Mobile Sticky Header -->
				<div class="sticky-header" id="sticky-header-mobile">
					<!-- BEGIN Header Holder -->
					<div class="header-holder header-holder-mobile">
						<div class="header-container container-fluid g-4">
							<div class="header-wrap">
								<button class="btn btn-flat-primary btn-icon" data-toggle="aside">
									<i class="fa fa-bars"></i>
								</button>
							</div>
							<div class="header-wrap header-wrap-block justify-content-start px-3">
								<h4 class="header-brand">KOPERINTAN</h4>
							</div>
							<div class="header-wrap hstack gap-2">
								<!-- BEGIN Dropdown -->
								<div class="dropdown">
									<button class="btn btn-flat-primary widget13" data-bs-toggle="dropdown">
										<div class="widget13-text">Hi <strong>{{ Auth::user()->name }}</strong>
										</div>
										<!-- BEGIN Avatar -->
										<div class="avatar avatar-info widget13-avatar">
											<div class="avatar-display">
												<i class="fa fa-user-alt"></i>
											</div>
										</div>
										<!-- END Avatar -->
									</button>
									<div class="dropdown-menu dropdown-menu-wide dropdown-menu-end dropdown-menu-animated overflow-hidden py-0">
										<!-- BEGIN Portlet -->
										<div class="portlet border-0">
											<div class="portlet-header bg-primary rounded-0">
												<!-- BEGIN Rich List Item -->
												<div class="rich-list-item w-100 p-0">
													<div class="rich-list-prepend">
														<!-- BEGIN Avatar -->
														<div class="avatar avatar-label-light avatar-circle">
															<div class="avatar-display">
																<i class="fa fa-user-alt"></i>
															</div>
														</div>
														<!-- END Avatar -->
													</div>
													<div class="rich-list-content">
														<h3 class="rich-list-title text-white thumbnail-fullname">{{ Auth::user()->name }}</h3>
														<span class="rich-list-subtitle text-white thumbnail-email">{{ Auth::user()->email }}</span>
													</div>
												</div>
												<!-- END Rich List Item -->
											</div>
											<div class="portlet-footer portlet-footer-bordered rounded-0">
												<form action="/logout" method="post">
													@csrf
													<button type="button" class="btn btn-label-danger logout-trigger btn-logout">Keluar</button>
												</form>
											</div>
										</div>
									</div>
								</div>
								<!-- END Dropdown -->
							</div>
						</div>
					</div>
					<!-- END Header Holder -->
				</div>
				<!-- END Mobile Sticky Header -->
				<!-- BEGIN Header Holder -->
				<div class="header-holder header-holder-mobile">
					<div class="header-container container-fluid g-4">
						<div class="header-wrap header-wrap-block justify-content-start w-100">
							<!-- BEGIN Breadcrumb -->
							<div class="breadcrumb breadcrumb-transparent mb-0">
								<a href="/" class="breadcrumb-item">
									<div class="breadcrumb-icon">
										<i data-feather="home"></i>
									</div>
									<span class="breadcrumb-text">Dashboard</span>
								</a>
								@yield('breadcrumb')
							</div>
							<!-- END Breadcrumb -->
						</div>
					</div>
				</div>
				<!-- END Header Holder -->
			</div>
			<!-- END Header -->
			<!-- BEGIN Page Content -->
      <div class="content">
        <div class="container-fluid g-4">
          @yield("content")
        </div>
      </div>
      <!-- END Page Content -->
			<!-- BEGIN Footer -->
			<div class="footer">
				<div class="container-fluid g-4">
					<div class="row g-3">
						<div class="col-sm-12 text-center text-sm-start">
							<p class="mb-0"><i class="far fa-copyright"></i> <span id="copyright-year"></span> Jasa Raharja Kalimantan Timur. All rights reserved</p>
						</div>
					</div>
				</div>
			</div>
			<!-- END Footer -->
		</div>
		<!-- END Page Wrapper -->
	</div>
	<!-- END Page Holder -->
  
	<script type="text/javascript" src="/dashboard_assets/assets/build/scripts/mandatory.js"></script>
	<script type="text/javascript" src="/dashboard_assets/assets/build/scripts/core.js"></script>
	<script type="text/javascript" src="/dashboard_assets/assets/build/scripts/vendor.js"></script>
	<script type="text/javascript" src="/dashboard_assets/assets/app/utilities/sticky-header.js"></script>
	<script type="text/javascript" src="/dashboard_assets/assets/app/utilities/copyright-year.js"></script>
	<script type="text/javascript" src="/dashboard_assets/assets/app/utilities/theme-switcher.js"></script>
	<script type="text/javascript" src="/dashboard_assets/assets/app/utilities/tooltip-popover.js"></script>
	<script type="text/javascript" src="/dashboard_assets/assets/app/utilities/dropdown-scrollbar.js"></script>
	<script type="text/javascript" src="/dashboard_assets/assets/app/utilities/fullscreen-trigger.js"></script>
	<script type="text/javascript" src="/dashboard_assets/assets/app/pages/home.js"></script>
	<script type="text/javascript" src="/dashboard_assets/assets/app/pages/elements/toastr.js"></script>
	<script type="text/javascript" src="/dashboard_assets/assets/app/pages/elements/sweet-alert.js"></script>

	<script>
		$('.btn-logout').on('click', function(e) {
			e.preventDefault();
			Swal.fire({
				title: 'Apakah anda yakin?',
				text: "Anda akan keluar dari sistem",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, keluar!',
				cancelButtonText: 'Tidak',
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = "/logout";
				}
			})
		})
		
	</script>

	<script>
		toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": true,
    "onclick": null,
    "showDuration": 300,
    "hideDuration": 1000,
    "timeOut": 5000,
    "extendedTimeOut": 1000,
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut",
    "tapToDismiss": true,
  }
	</script>

	@yield('script')
</body>

</html>
