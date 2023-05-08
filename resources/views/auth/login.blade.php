<!DOCTYPE html>
<html lang="en" dir="ltr" data-theme="light">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&amp;family=Roboto+Mono&amp;display=swap" rel="stylesheet">
	<link href="/dashboard_assets/assets/build/styles/ltr-core.css" rel="stylesheet">
	<link href="/dashboard_assets/assets/build/styles/ltr-vendor.css" rel="stylesheet">
	<link href="/logo.png" rel="shortcut icon" type="image/x-icon">
	<title>Login | KOPERINTAN</title>
</head>

<body class="preload-active">
	<div class="preload">
		<div class="preload-dialog">
			<div class="spinner-border text-primary preload-spinner"></div>
		</div>
	</div>
	<div class="holder">
		<div class="wrapper ">
			<div class="content">
				<div class="container-fluid g-4">
					<div class="row g-0 align-items-center justify-content-center h-100" style="flex-direction: column">
						<img src="/logo.png" alt="Logo JR" class="img-fluid" style="width: 150px">
						<h3 class="text-center">KOPERINTAN</h3>

						<div class="col-sm-8 col-md-6 col-lg-4 col-xl-3">
							<div class="portlet">
								<div class="portlet-body">
									<div class="text-center mt-4 mb-5">
										{{--  --}}
									</div>
									<form class="d-grid gap-3" id="login-form" method="POST" action="/login">
										@csrf 
										<div class="validation-container">
											<div class="form-floating">
												<input class="form-control form-control-lg @error('nopol') is-invalid @enderror" type="text" id="nopol" name="nopol" placeholder="Please insert your nopol" value="@if(old('nopol')){{ old('nopol') }}@else{{ session('nopol') }}@endif">
												<label for="nopol">Nopol</label>
												@error('nopol')
													<div class="invalid-feedback">{{ $message }}</div>
												@enderror
											</div>
										</div>
										<div class="validation-container">
											<div class="form-floating">
												<input class="form-control form-control-lg @error('password') is-invalid @enderror" type="password" id="password" name="password" placeholder="Please insert your password" value="@if(session('password')){{ session('password') }}@endif">
												<label for="password">Password</label>
												@error('password')
													<div class="invalid-feedback">{{ $message }}</div>
												@enderror
											</div>
										</div>
										<div class="form-check mb-3">
											<input class="form-check-input" type="checkbox" id="remember" name="remember_me" checked>
											<label class="form-check-label" for="remember">Remember me</label>
										</div>
										@if (session('error'))
										<div class="alert alert-dismissible alert-outline-danger fade show">
											<div class="alert-content">
												{{ session('error') }}
											</div>
											<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
										</div>
										@endif
										<button type="submit" class="btn btn-label-primary btn-lg btn-widest" id="login-button">Login</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="/dashboard_assets/assets/build/scripts/mandatory.js"></script>
	<script type="text/javascript" src="/dashboard_assets/assets/build/scripts/core.js"></script>
	<script type="text/javascript" src="/dashboard_assets/assets/build/scripts/vendor.js"></script>
	<script type="text/javascript" src="/dashboard_assets/assets/app/utilities/sticky-header.js"></script>
	<script type="text/javascript" src="/dashboard_assets/assets/app/utilities/copyright-year.js"></script>
	<script type="text/javascript" src="/dashboard_assets/assets/app/utilities/theme-switcher.js"></script>
	<script type="text/javascript" src="/dashboard_assets/assets/app/utilities/tooltip-popover.js"></script>
	<script type="text/javascript" src="/dashboard_assets/assets/app/utilities/dropdown-scrollbar.js"></script>
	<script type="text/javascript" src="/dashboard_assets/assets/app/utilities/fullscreen-trigger.js"></script>
	<script type="text/javascript" src="/dashboard_assets/assets/app/pages/elements/sweet-alert.js"></script>

	@if(session('ubah_password'))
	<script>
		swal.fire({
			title: "Berhasil!",
			text: "{{ session('ubah_password') }}",
			icon: "success",
			confirmButtonColor: "#3085d6",
			confirmButtonText: "Ok",
		});
	</script>
	@endif

</body>
</html>