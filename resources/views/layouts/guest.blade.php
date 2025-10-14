<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>{{ config('app.name', 'Laravel') }}</title>

		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
		<link href="/assets/css/theme.css" rel="stylesheet">
	</head>
	<body class="d-flex flex-column brand-bg">
		<nav class="navbar navbar-expand-lg bg-white shadow-sm">
			<div class="container">
				<a class="navbar-brand fw-semibold d-flex align-items-center" href="{{ url('/') }}">
					@if (file_exists(public_path('assets/img/logo.png')))
						<img src="/assets/img/logo.png" alt="Logo" class="brand-logo me-2" />
					@else
						<i class="bi bi-box-seam-fill me-2 brand-badge"></i>
					@endif
					Lost &amp; Found
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#guestNav" aria-controls="guestNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="guestNav">
					<ul class="navbar-nav ms-auto">
						<li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right me-1"></i>Login</a></li>
						<li class="nav-item"><a class="nav-link" href="{{ route('register') }}"><i class="bi bi-person-plus me-1"></i>Register</a></li>
					</ul>
				</div>
			</div>
		</nav>

		<main class="flex-grow-1 py-5">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-lg-10 col-xl-8">
						{{ $slot }}
					</div>
				</div>
			</div>
		</main>

		<footer class="py-4 border-top bg-white">
			<div class="container text-center text-muted small">
				<i class="bi bi-shield-lock me-1"></i> Secure Lost &amp; Found • {{ date('Y') }}
			</div>
		</footer>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	</body>
</html>
