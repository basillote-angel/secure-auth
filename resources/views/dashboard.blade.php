<x-app-layout>
    @php $name = auth()->user()->name ?? 'User'; @endphp

    <div class="mb-3 d-flex align-items-center justify-content-between">
        <div id="greet" class="greeting d-inline-flex align-items-center">
            <i class="bi bi-hand-thumbs-up-fill me-2"></i>
            <span class="fw-semibold">Welcome back, {{ $name }}! Ready to reunite items with their owners?</span>
            <button class="close-btn ms-2" type="button" onclick="document.getElementById('greet').remove()" aria-label="Dismiss">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="small text-muted d-none d-md-inline">{{ now()->format('M d, Y') }}</div>
    </div>

    <div class="row g-3">
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small">Items Reported</div>
                            <div class="fs-4 fw-semibold">0</div>
                        </div>
                        <i class="bi bi-box-seam fs-2 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small">Items Found</div>
                            <div class="fs-4 fw-semibold">0</div>
                        </div>
                        <i class="bi bi-check2-circle fs-2 text-success"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small">Pending Claims</div>
                            <div class="fs-4 fw-semibold">0</div>
                        </div>
                        <i class="bi bi-hourglass-split fs-2 text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small">Profile Completeness</div>
                            <div class="fs-4 fw-semibold">-</div>
                        </div>
                        <i class="bi bi-person-badge fs-2 text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-1">
        <div class="col-12 col-xl-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h5 class="m-0">Recent Activity</h5>
                        <a href="#" class="small link-accent">View all</a>
                    </div>
                    <div class="text-muted small">No recent activity.</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="m-0 mb-2">Quick Actions</h5>
                    <div class="d-grid gap-2">
                        <a class="btn btn-primary" href="#"><i class="bi bi-plus-circle me-1"></i> Report Lost Item</a>
                        <a class="btn btn-outline-dark" href="#"><i class="bi bi-search me-1"></i> Browse Found Items</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
