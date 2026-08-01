<footer class="mt-auto bg-white border-top py-4">
    <div class="container">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
            <!-- Brand & Copyright -->
            <div class="mb-3 mb-md-0 text-center text-md-start">
                <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                    <span class="fw-bold text-dark me-2">Rental Motor Jaya</span>
                    <span class="text-muted small">&copy; {{ date('Y') }} - Panel Admin. All rights reserved.</span>
                </div>
            </div>
            
            <!-- Quick links and Tech info -->
            <div class="d-flex align-items-center gap-3 justify-content-center flex-wrap">
                <a href="/motor" class="text-muted text-decoration-none small hover-primary transition-color">Kelola Motor</a>
                <span class="text-muted opacity-50">•</span>
                <a href="/customer" class="text-muted text-decoration-none small hover-primary transition-color">Pelanggan</a>
                <span class="text-muted opacity-50">•</span>
                <a href="/transaksi" class="text-muted text-decoration-none small hover-primary transition-color">Transaksi</a>
                <span class="badge bg-light text-secondary border px-2 py-1 font-monospace ms-2" style="font-size: 0.75rem;">v1.0.0</span>
            </div>
        </div>
    </div>
</footer>

<style>
    .hover-primary {
        transition: color 0.15s ease-in-out;
    }
    .hover-primary:hover {
        color: #0d9488 !important; /* Teal accent matching the dashboard */
    }
</style>