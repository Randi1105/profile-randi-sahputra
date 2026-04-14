<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Head -->
    <?php include 'app/view/layout/head.php' ?>
    <!-- \Head -->
</head>

<body>
    <!-- Controller -->
    <?php include 'app/controller/dashboard/spk_psi.php' ?>
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
                    <?php if (isset($_POST['proses'])): ?>
                    <?php if (mysqli_num_rows($queryNilai) < 1): ?>
                    <div class="card">
                        <div class="card-header">
                            <a href="?p=PSI" class="btn btn-secondary">Reset</a>
                        </div>
                        <div class="card-body">
                            <h4 class="text-center text-muted">Data pada periode <?= $periode ?> ini belum ada penilaian
                                !!!</h4>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="row">
                        <div class="col-xl-12 col-sm-12 col-12 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="fw-bolder">Periode Penilaian <?= $periode ?></h4>
                                    <a href="?p=PSI" class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12 col-12 mb-3">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4>Sub Penilaian</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover text-center align-middle">
                                            <thead>
                                                <tr>
                                                    <th>Kode Penilaian</th>
                                                    <th>ID Karyawan</th>
                                                    <th>Nama Karyawan</th>
                                                    <?php foreach ($queryKriteria as $rowk): ?>
                                                    <th><?= $rowk['kode_kriteria'] ?></th>
                                                    <?php endforeach ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($queryNilai as $row): ?>
                                                <tr>
                                                    <td><?= $row['id_nilai'] ?></td>
                                                    <td><?= $row['id_karyawan'] ?></td>
                                                    <td><?= $row['nama_karyawan'] ?></td>
                                                    <?php foreach ($queryKriteria as $rowk): ?>
                                                    <td><?= $row[$rowk['kode_kriteria']] ?></td>
                                                    <?php endforeach ?>
                                                </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-sm-6 col-6 mb-3">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4>Normaliasi</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover text-center align-middle">
                                            <thead>
                                                <tr>
                                                    <th>Nama Karyawan</th>
                                                    <?php foreach ($queryKriteria as $rowk): ?>
                                                    <th><?= $rowk['kode_kriteria'] ?></th>
                                                    <?php endforeach ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($queryNilai as $row): ?>
                                                <tr>
                                                    <td><?= $row['nama_karyawan'] ?></td>
                                                    <?php foreach ($queryKriteria as $rowk): ?>
                                                    <td><?= round($spk->Normalisasi($row[$rowk['kode_kriteria']], $rowk), 3) ?>
                                                    </td>
                                                    <?php endforeach ?>
                                                </tr>
                                                <?php endforeach ?>
                                                <tr>
                                                    <th>Total Nilai</th>
                                                    <?php foreach ($queryKriteria as $rowk): ?>
                                                    <th><?= round($spk->SumNormalisasi($rowk), 3) ?></th>
                                                    <?php endforeach ?>
                                                </tr>
                                                <tr>
                                                    <th>Nilai Mean</th>
                                                    <?php foreach ($queryKriteria as $rowk): ?>
                                                    <th><?= round($spk->Mean($rowk), 3) ?></th>
                                                    <?php endforeach ?>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-sm-6 col-6 mb-3">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4>Variasi Preferensi</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover text-center align-middle">
                                            <thead>
                                                <tr>
                                                    <th>Nama Karyawan</th>
                                                    <?php foreach ($queryKriteria as $rowk): ?>
                                                    <th><?= $rowk['kode_kriteria'] ?></th>
                                                    <?php endforeach ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($queryNilai as $row): ?>
                                                <tr>
                                                    <td><?= $row['nama_karyawan'] ?></td>
                                                    <?php foreach ($queryKriteria as $rowk): ?>
                                                    <td><?= round($spk->VariasiPreferensi($row[$rowk['kode_kriteria']], $rowk), 3) ?>
                                                    </td>
                                                    <?php endforeach ?>
                                                </tr>
                                                <?php endforeach ?>
                                                <tr>
                                                    <th>Total Nilai Variasi</th>
                                                    <?php foreach ($queryKriteria as $rowk): ?>
                                                    <th><?= round($spk->SumVariasi($rowk), 3) ?></th>
                                                    <?php endforeach ?>
                                                </tr>
                                                <tr>
                                                    <th>Nilai Deviasi</th>
                                                    <?php foreach ($queryKriteria as $rowk): ?>
                                                    <th><?= round($spk->Deviasi($rowk), 3) ?></th>
                                                    <?php endforeach ?>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12 col-12 mb-3">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4>Pembobotan Kriteria</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover text-center align-middle">
                                            <thead>
                                                <tr>
                                                    <th>Kode Kriteria</th>
                                                    <th>Nama Kriteria</th>
                                                    <th>Jenis Kriteria</th>
                                                    <th>Bobot Kriteria</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($queryKriteria as $row): ?>
                                                <?php $bobot[] = $spk->PembobotanKriteria($row) ?>
                                                <tr>
                                                    <td><?= $row['kode_kriteria'] ?></td>
                                                    <td><?= $row['nama_kriteria'] ?></td>
                                                    <td><?= $row['jenis_kriteria'] ?></td>
                                                    <td><?= round($spk->PembobotanKriteria($row), 4) ?>
                                                    </td>
                                                </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12 col-12 mb-3">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4>Preferensi Vektor</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover text-center align-middle">
                                            <thead>
                                                <tr>
                                                    <th>Kode Penilaian</th>
                                                    <th>ID Karyawan</th>
                                                    <th>Nama Karyawan</th>
                                                    <th>Total Nilai</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($queryNilai as $row): ?>
                                                <tr>
                                                    <td><?= $row['id_nilai'] ?></td>
                                                    <td><?= $row['id_karyawan'] ?></td>
                                                    <td><?= $row['nama_karyawan'] ?></td>
                                                    <td><?= round($spk->PreferensiVektor($row, $bobot), 5) ?></td>
                                                </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12 col-12 mb-3">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4>Perangkingan</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover text-center align-middle">
                                            <thead>
                                                <tr>
                                                    <th>Ranking</th>
                                                    <th>Kode Penilaian</th>
                                                    <th>ID Karyawan</th>
                                                    <th>Nama Karyawan</th>
                                                    <th>Total Nilai</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($dataHasil as $row): ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $row['id'] ?></td>
                                                    <td><?= $row['id_karyawan'] ?></td>
                                                    <td><?= $row['nama'] ?></td>
                                                    <td><?= $row['total'] ?></td>
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
                    <?php else: ?>
                    <div class="row gx-3">
                        <div class="col-xl-12 col-sm-12 col-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <form method="post" class="needs-validation" novalidate>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label">Periode Penilaian</label>
                                                <div class="d-flex">
                                                    <select name="periode" class="form-control me-2" required>
                                                        <option value="" disabled selected>Pilih</option>
                                                        <?php for ($i = 2020; $i <= date('Y'); $i++): ?>
                                                        <option value="<?= $i ?>"><?= $i ?></option>
                                                        <?php endfor ?>
                                                    </select>
                                                    <button type="submit" class="btn btn-success"
                                                        name="proses">Proses</button>
                                                </div>
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