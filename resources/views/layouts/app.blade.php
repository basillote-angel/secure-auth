<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>{{ config('app.name', 'Laravel') }}</title>

		<link rel="icon" type="image/png" href="/assets/img/navistfind_icon.png" sizes="32x32">
		<link rel="shortcut icon" href="/assets/img/navistfind_icon.png">
		<link rel="apple-touch-icon" href="/assets/img/navistfind_icon.png">

		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
		<link href="/assets/css/theme.css" rel="stylesheet">
		@stack('head')
	</head>
	<body class="d-flex flex-column brand-bg">
		@include('layouts.navigation')

		<main class="flex-grow-1 py-4">
			<div class="container">
				@if (session('status'))
					<div class="alert alert-success d-flex align-items-center" role="alert">
						<i class="bi bi-check-circle-fill me-2"></i>
						<div>{{ session('status') }}</div>
					</div>
				@endif

				{{ $slot }}
			</div>
		</main>

		<footer class="py-4 border-top bg-white">
			<div class="container d-flex justify-content-between small text-muted">
				<div><i class="bi bi-box-seam-fill me-1"></i> Lost &amp; Found</div>
				<div>Secure Auth • {{ date('Y') }}</div>
			</div>
		</footer>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
		@stack('scripts')
	</body>
</html>
