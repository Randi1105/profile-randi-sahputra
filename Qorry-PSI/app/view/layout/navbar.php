<div class="app-header d-flex align-items-center">
    <!-- Toggle buttons start -->
    <div class="d-flex col">
        <button class="toggle-sidebar" id="toggle-sidebar">
            <i class="bi bi-list lh-1 text-white"></i>
        </button>
        <button class="pin-sidebar" id="pin-sidebar">
            <i class="bi bi-list lh-1 text-white"></i>
        </button>
    </div>
    <!-- Toggle buttons end -->

    <!-- App brand starts -->
    <div class="app-brand py-2 col">
        <h2 class="text-white text-uppercase fw-bolder">
            PT. Honda Amanah Motor
        </h2>
    </div>
    <!-- App brand ends -->

    <!-- App header actions start -->
    <div class="header-actions col">
        <div class="dropdown ms-3">
            <a id="userSettings" class="dropdown-toggle d-flex py-2 align-items-center text-decoration-none" href="#!"
                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="assets/imgs/pengguna/<?= $dataPengguna['foto_pengguna'] ?>" class="rounded-circle img-3x"
                    alt="" />
                <div class="ms-2 text-truncate d-lg-block d-none text-white">
                    <span class="fw-bolder"><?= $dataPengguna['nama_pengguna'] ?></span>
                    <span class="d-flex small"><?= $dataPengguna['jabatan'] ?></span>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end shadow-lg">
                <div class="mx-3 mt-2 d-grid">
                    <a href="?p=Logout" class="btn btn-primary btn-sm">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- App header actions end -->
</div>