<nav class="navbar navbar-expand-lg bg-white shadow-sm">
	<div class="container">
		<a class="navbar-brand fw-semibold d-flex align-items-center" href="{{ url('/') }}">
			@if (file_exists(public_path('assets/img/logo.png')))
				<img src="/assets/img/logo.png" alt="Logo" class="brand-logo me-2" />
			@else
				<i class="bi bi-box-seam-fill me-2 text-primary"></i>
			@endif
			Lost &amp; Found
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#appNav" aria-controls="appNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="appNav">
			<ul class="navbar-nav me-auto">
				<li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}"><i class="bi bi-house-door me-1"></i>Dashboard</a></li>
				{{-- Future: Items list, Report found, Report lost --}}
			</ul>
			<div class="d-flex align-items-center gap-3">
				<span class="text-muted small d-none d-md-inline">{{ Auth::user()->name ?? '' }}</span>
				<form method="POST" action="{{ route('logout') }}">
					@csrf
					<button class="btn btn-outline-dark btn-sm" type="submit">
						<i class="bi bi-box-arrow-right me-1"></i> Logout
					</button>
				</form>
			</div>
		</div>
	</div>
</nav>
