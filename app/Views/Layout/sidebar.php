<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <h1 class="navbar-brand navbar-brand-autodark">
      <span name="htmlaundry" id="htmlaundry" class="h2 text-uppercase fw-bold" style="font-family: 'Arial', sans-serif; letter-spacing: 2px;">HTM Laundry</span>
    </h1>
    <hr class="my-2 bg-light">
    <div class="nav-item text-center">
      <div><?= user()->username; ?></div>
      <div class="text-muted"><?= user()->groups; ?></div>
    </div>
    <hr class="my-2 bg-light">
    <div class="collapse navbar-collapse" id="sidebar-menu">
      <!-- Sidebar -->
      <p class="nav-header ms-3 mt-0">Manajemen Data</p>
      <ul class="navbar-nav pt-lg-1">
        <?php if (in_groups('admin')) : ?>
          <li class="nav-item">
            <a class="nav-link text-white" href="/Web/pegawai">
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <!-- Home Icon -->
                <i class="fas fa-home"></i>
              </span>
              <span class="nav-link-title">
                Data Pegawai
              </span>
            </a>
          </li>
        <?php endif; ?>

        <li class="nav-item">
          <a class="nav-link text-white" href="/Web/pelanggan">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <!-- User Icon -->
              <i class="fas fa-users"></i>
            </span>
            <span class="nav-link-title">
              Data Pelanggan
            </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="/Web/jenislayanan">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <!-- Services Icon -->
              <i class="fas fa-concierge-bell"></i>
            </span>
            <span class="nav-link-title">
              Jenis Layanan
            </span>
          </a>
        </li>

        <hr class="my-2 bg-light">
        <p class="nav-header ms-3">Manajemen Transaksi</p>
        <li class="nav-item">
          <a class="nav-link text-white" href="/Web/transaksi">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <!-- Transactions Icon -->
              <i class="fas fa-exchange-alt"></i>
            </span>
            <span class="nav-link-title">
              Data Transaksi
            </span>
          </a>
        </li>

        <hr class="sidebar-divider my-2 bg-light">
        <li class="nav-item">
          <a class="nav-link text-white" href="<?= base_url('logout') ?>">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <!-- Logout Icon -->
              <i class="fas fa-sign-out-alt"></i>
            </span>
            <span class="nav-link-title">
              Logout
            </span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</aside>