<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Head -->
    <?php include 'app/view/layout/head.php' ?>
    <!-- \Head -->
</head>

<body>
    <!-- Controller -->
    <?php include 'app/controller/dashboard/laporan.php' ?>
    <!-- \Controller -->

    <div class="page-wrapper">
        <!-- Navbar -->
        <?php include 'app/view/layout/navbar.php' ?>
        <!-- \Navbar -->

        <div class="main-container">
            <!-- Sidebar -->
            <?php include 'app/view/layout/sidebar.php' ?>
            <!-- \Sidebar -->

            <!-- Content -->
            <div class="app-container">
                <!-- Panel -->
                <div class="app-hero-header mb-4">
                    <div class="d-flex align-items-center mb-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <i class="bi bi-house lh-1"></i>
                                <a href="index.html" class="text-decoration-none"><?= $dataPage['panel'] ?></a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page"><?= $dataPage['page'] ?></li>
                        </ol>
                    </div>
                    <h3 class="fw-bolder text-white my-3"><?= $dataPage['page'] ?></h3>
                </div>
                <!-- Panel -->

                <!-- Body -->
                <div class="app-body">
                    <?php if (isset($_POST['cek'])) : ?>
                    <?php if (mysqli_num_rows($queryNilai) < 1) : ?>
                    <div class="card">
                        <div class="card-header">
                            <a href="?p=Laporan" class="btn btn-secondary">Reset</a>
                        </div>
                        <div class="card-body">
                            <h4 class="text-center text-muted">Data pada periode <?= $periode ?> ini belum ada penilaian
                                !!!</h4>
                        </div>
                    </div>
                    <?php else : ?>
                    <div class="row">
                        <div class="col-xl-12 col-sm-12 col-12 mb-3">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="fw-bolder mb-3">Periode Penilaian <?= $periode ?>
                                        Penentuan Karyawan Terbaik</h4>
                                    <div class="d-flex">
                                        <a href="?r=Laporan&periode=<?= $periode ?>&keputusan=<?= $keputusan ?>"
                                            target="_blank" class="btn btn-primary me-2">Cetak</a>
                                        <a href="?p=Laporan" class="btn btn-secondary">Reset</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover text-center align-middle">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Penilaian</th>
                                                    <th>ID Karyawan</th>
                                                    <th>Nama Karyawan</th>
                                                    <th>Total Nilai</th>
                                                    <th>Keputusan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($dataHasil as $row) : $no++ ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $row['id_nilai'] ?></td>
                                                    <td><?= $row['id_karyawan'] ?></td>
                                                    <td><?= $row['nama'] ?></td>
                                                    <td><?= $row['total'] ?></td>
                                                    <td><?= $spk->Keputusan($no) ?></td>
                                                </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif ?>
                    <?php else : ?>
                    <div class="row gx-3">
                        <div class="col-xl-12 col-sm-12 col-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <form method="post" class="needs-validation" novalidate>
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Periode Penilaian</label>
                                                <select name="periode" class="form-control me-2" required>
                                                    <option value="" disabled selected>Pilih</option>
                                                    <?php for ($i = 2020; $i <= date('Y'); $i++) : ?>
                                                    <option value="<?= $i ?>"><?= $i ?></option>
                                                    <?php endfor ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="submit" class="btn btn-success" name="cek">Cek</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif ?>
                </div>
                <!-- \Body -->

                <!-- Footer -->
                <?php include 'app/view/layout/sidebar.php' ?>
                <!-- Footer -->

            </div>
            <!-- \Content -->
        </div>
    </div>

    <!-- Script -->
    <?php include 'app/view/layout/script.php' ?>
    <!-- \Script -->
</body>

</html>