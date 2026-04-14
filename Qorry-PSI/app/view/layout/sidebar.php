<nav id="sidebar" class="sidebar-wrapper">
    <!-- Sidebar profile starts -->
    <div class="sidebar-profile">
        <img src="assets/imgs/pengguna/<?= $dataPengguna['foto_pengguna'] ?>" class="profile-user mb-3" alt="" />
        <div class="text-center">
            <h5 class="profile-name m-0 text-nowrap text-truncate">
                <?= $dataPengguna['nama_pengguna'] ?>
            </h5>
        </div>
        <div class="d-flex align-items-center mt-lg-3 gap-2">
            <a href="https://www.facebook.com/profile.php?id=588361737894378&_rdc=2&_rdr"
                class="icon-box md grd-success-light rounded-2">
                <i class="bi bi-facebook fs-5 text-primary"></i>
            </a>
            <a href="https://www.instagram.com/explore/locations/1013913417/smpn-3-padang-panjang/"
                class="icon-box md grd-info-light rounded-2">
                <i class="bi bi-instagram fs-5 text-danger"></i>
            </a>
            <a href="https://wa.me/6282246820856" class="icon-box md grd-info-light rounded-2">
                <i class="bi bi-whatsapp fs-5 text-success"></i>
            </a>
        </div>
    </div>
    <!-- Sidebar profile ends -->
    <div class="sidebarMenuScroll">
        <!-- Sidebar menu starts -->
        <ul class="sidebar-menu">
            <li class="<?= $page == "Dashboard" ? 'active current-page' : '' ?>">
                <a href="?p=Dashboard">
                    <i class="bi bi-house"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>
            <?php if ($dataPengguna['jabatan'] == "Admin"): ?>
            <li class="<?= $page == "Pengguna" ? 'active current-page' : '' ?>">
                <a href="?p=Pengguna">
                    <i class="bi bi-person"></i>
                    <span class="menu-text">Data Pengguna</span>
                </a>
            </li>
            <li class="<?= $page == "Karyawan" ? 'active current-page' : '' ?>">
                <a href="?p=Karyawan">
                    <i class="bi bi-people"></i>
                    <span class="menu-text">Data Karyawan</span>
                </a>
            </li>
            <li class="<?= $page == "Nilai" ? 'active current-page' : '' ?>">
                <a href="?p=Nilai">
                    <i class="bi bi-bar-chart"></i>
                    <span class="menu-text">Data Penilaian Karyawan</span>
                </a>
            </li>
            <li class="treeview <?= ($page == "Kriteria" or $page == "PSI" or $page == "Sub") ? 'active' : '' ?>">
                <a href="#!">
                    <i class="bi bi-gear"></i>
                    <span class="menu-text">SPK</span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="?p=Kriteria"
                            class="<?= ($page == "Kriteria" or $page == "Sub") ? 'active-sub' : '' ?>">Kriteria
                            Penilaian</a>
                    </li>
                    <li>
                        <a href="?p=PSI" class="<?= $page == "PSI" ? 'active-sub' : '' ?>">Metode PSI</a>
                    </li>
                </ul>
            </li>
            <?php endif ?>
            <li class="<?= $page == "Laporan" ? 'active current-page' : '' ?>">
                <a href="?p=Laporan">
                    <i class="bi bi-pie-chart"></i>
                    <span class="menu-text">Laporan</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- Sidebar menu ends -->
</nav>