<nav class="navbar bg-body-tertiary fixed-top border-bottom">
  <div class="container-fluid px-3 px-md-4">
    <div class="d-flex align-items-center">
      <button class="navbar-toggler me-3 shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
        aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand fw-bold text-dark m-0" href="/">Rental Motor Jaya</a>
    </div>

    <div class="d-flex align-items-center gap-3 ms-auto">
      <span class="text-muted small d-none d-md-inline">
        Halo, <strong class="text-dark">{{ Auth::user()->name ?? 'Admin Testing' }}</strong>
      </span>
      <form method="POST" action="/logout" class="d-flex m-0">
        @csrf
        <button class="btn btn-outline-danger btn-sm fw-bold px-3" type="submit">
          Logout
        </button>
      </form>
    </div>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header border-bottom bg-light">
        <div class="d-flex flex-column">
          <h5 class="offcanvas-title fw-bold text-dark mb-1" id="offcanvasNavbarLabel">Menu Utama</h5>
          <span class="text-muted small d-md-none">
            Login sebagai: <strong>{{ Auth::user()->name ?? 'Admin Testing' }}</strong>
          </span>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/customer">Customer</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/kategori">Kategori</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/motor">Motor</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/transaksi">Transaksi</a>
          </li>
        </ul>
        <form class="d-flex mt-3" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </div>
</nav>