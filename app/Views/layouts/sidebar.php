<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="<?= base_url('') ?>">
            <i class="fa-solid fa-boxes-stacked"></i>
            <span class="ms-1 font-weight-bold"> Manajemen Stok</span>
        </a>
    </div>
    <?php $segment = service('uri')->getSegment(1); ?>
    <?php $segment2 = service('uri')->getSegment(2); ?>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <?php if(in_groups('admin')) : ?>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Master</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($segment == "admin" AND $segment2 == "home" ) ? "active" : "" ?>"
                    href="<?= base_url('admin/home') ?>">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Management Users</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= ($segment == "admin" AND $segment2 == "profile" ) ? "active" : "" ?>"
                    href="<?= base_url('admin/profile') ?>">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Registrasi Akun</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(in_groups('user')) : ?>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Master</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($segment == "user" AND $segment2 == "home" ) ? "active" : "" ?>"
                    href="<?= base_url('user/home') ?>">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= ($segment == "user" AND $segment2 == "list-product"  ) ? "active" : "" ?>"
                    href="<?= base_url('user/list-product') ?>">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-list text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">List Product</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Penjualan</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= ($segment == "user" AND $segment2 == "stock-out" ) ? "active" : "" ?>"
                    href="<?= base_url('user/stock-out') ?>">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-box text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Stok Keluar</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Pemasukan</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($segment == "user" AND $segment2 == "stock-in" ) ? "active" : "" ?>"
                    href="<?= base_url('user/stock-in') ?>">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-box-open text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Stok Masuk</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">laporan</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($segment == "user" AND $segment2 == "report-item" ) ? "active" : "" ?>"
                    href="<?= base_url('user/report-item') ?>">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-copy-04 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Laporan Barang</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
            </li>
            <?php endif; ?>
            <li class="nav-item">
                <a class="nav-link " href="<?= base_url('logout') ?>">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-button-power text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</aside>