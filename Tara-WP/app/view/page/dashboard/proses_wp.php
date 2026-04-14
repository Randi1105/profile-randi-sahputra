<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Head -->
    <?php include 'app/view/layout/head.php' ?>
    <!-- \Head -->
</head>

<body>
    <!-- Controller -->
    <?php include 'app/controller/dashboard/metode_wp.php' ?>
    <!-- \Controller -->

    <div class="container-scroller">
        <!-- Nav -->
        <?php include 'app/view/layout/nav.php' ?>
        <!-- \Nav -->

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- Sidebar -->
            <?php include 'app/view/layout/sidebar.php' ?>
            <!-- \Sidebar -->

            <!-- Main -->
            <div class="main-panel">
                <!-- Content -->
                <div class="content-wrapper">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h2 class="font-weight-bold">
                                Proses Perhitungan Metode Weighted Product
                            </h2>
                            <?php if (isset($_POST['cek'])) : ?>
                            <h5 class="d-none">Tahap <?= $_POST['semester'] ?> Periode <?= $_POST['periode'] ?></h5>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <?php if (isset($_POST['cek'])) : ?>
                                    <a href="?p=ProsesWP" class="btn btn-secondary">Reset</a>
                                    <?php else : ?>
                                    <form method="post" class="needs-validation" novalidate>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-check-label d-none">Semester</label>
                                                <select class="form-control d-none" name="semester" required>
                                                    <option value="1" selected>Semester 1</option>
                                                    <option value="2">Semester 2</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-check-label d-none">Periode</label>
                                                <select class="form-control d-none" name="periode" required>
                                                    <option value="" disabled selected>Pilih</option>
                                                    <option value="2020/2021">Periode 2020/2021</option>
                                                    <option value="2021/2022">Periode 2021/2022</option>
                                                    <option value="2022/2023">Periode 2022/2023</option>
                                                    <option value="2023/2024">Periode 2023/2024</option>
                                                    <option value="2024/2025" selected>Periode 2024/2025</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" name="cek" class="btn btn-success">Cek
                                                    Data</button>
                                            </div>
                                        </div>
                                    </form>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <?php if (isset($_POST['cek'])) : ?>
                        <?php if (mysqli_num_rows($cekData) >= mysqli_num_rows($queryKriteria)) : ?>
                        <div class="col-md-12 grid-margin stretch-card mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Indikator Penilaian</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover text-center border-dark">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" class="align-middle">No</th>
                                                    <th rowspan="2" class="align-middle">NIP Karyawan</th>
                                                    <th rowspan="2" class="align-middle">Nama Karyawan</th>
                                                    <?php foreach ($queryKompetensi as $row) : ?>
                                                    <?php $rowIndikator = mysqli_num_rows(
                                                                    $crud->read(
                                                                        "kriteria",
                                                                        "WHERE kode_kompetensi = '$row[kode_kompetensi]'"
                                                                    )
                                                                ) ?>
                                                    <th colspan="<?= $rowIndikator ?>"><?= $row['nama_kompetensi'] ?>
                                                    </th>
                                                    <?php endforeach ?>
                                                </tr>
                                                <tr>
                                                    <?php foreach ($queryKriteria as $row) : ?>
                                                    <th><?= $row['kode_kriteria'] ?></th>
                                                    <?php endforeach ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1 ?>
                                                <?php foreach ($queryGuru as $row) : ?>
                                                <tr>
                                                    <th><?= $no++ ?></th>
                                                    <td><?= $row['nip'] ?></td>
                                                    <td><?= $row['nama_pengguna'] ?></td>
                                                    <?php $total_nilai = 0; ?>
                                                    <?php foreach ($queryKriteria as $rowi) : ?>
                                                    <?php $queryPenilaian =  $crud->read(
                                                                        "penilaian",
                                                                        "INNER JOIN pengguna ON penilaian.id_pengguna = pengguna.id_pengguna
                                                                         WHERE 
                                                                         penilaian.id_pengguna = '$row[id_pengguna]' AND
                                                                         penilaian.kode_kriteria = '$rowi[kode_kriteria]' AND
                                                                         penilaian.semester = '$semester' AND 
                                                                         penilaian.periode = '$periode'"
                                                                    ); ?>
                                                    <?php $rowPenilaian = mysqli_num_rows($queryPenilaian) ?>
                                                    <?php if ($rowPenilaian > 0) : ?>
                                                    <?php foreach ($queryPenilaian as $rowp) : ?>
                                                    <td><?= $rowp['nilai'] ?></td>
                                                    <?php endforeach ?>
                                                    <?php else : ?>
                                                    <td>-</td>
                                                    <?php endif ?>
                                                    <?php endforeach ?>
                                                </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 grid-margin stretch-card mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Vektor S</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <?php foreach ($queryKompetensi as $rowK) : ?>
                                        <div class="col-md-6 mb-3">
                                            <h5><?= $rowK['nama_kompetensi'] ?></h5>
                                            <hr>
                                            <?php $so = 0 ?>
                                            <?php foreach ($queryGuru as $rowG) : $so++ ?>
                                            <?php $queryPenilaian_S =  $crud->read(
                                                                "penilaian",
                                                                "INNER JOIN pengguna ON penilaian.id_pengguna = pengguna.id_pengguna
                                                                        INNER JOIN kriteria ON penilaian.kode_kriteria = kriteria.kode_kriteria
                                                                         WHERE 
                                                                         penilaian.id_pengguna = '$rowG[id_pengguna]' AND
                                                                         penilaian.kode_kompetensi = '$rowK[kode_kompetensi]' AND
                                                                         penilaian.semester = '$semester' AND 
                                                                         penilaian.periode = '$periode'"
                                                            ); ?>
                                            <p>
                                                <b>S<?= $so ?></b> :
                                                <?php $no_so = 0 ?>
                                                <?php foreach ($queryPenilaian_S as $rowP) : $no_so++ ?>
                                                <?= $rowP['nilai'] ?><sup><?= $rowP['bobot_kriteria'] / $total_bobot ?></sup>
                                                <?= $no_so < mysqli_num_rows($queryPenilaian_S) ? 'X' : '' ?>
                                                <?php endforeach ?>
                                                = <b>
                                                    <?= round($wp->VektorS_Kometensi($rowG['id_pengguna'], $rowK['kode_kompetensi'], $semester, $periode), 5) ?></b>
                                            </p>
                                            <?php endforeach ?>
                                            <hr>
                                        </div>
                                        <?php endforeach ?>
                                    </div>
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover text-center border-dark">
                                                <thead>
                                                    <tr>
                                                        <th class="align-middle">Kode</th>
                                                        <th class="align-middle">NIP Karyawan</th>
                                                        <th class="align-middle">Nama Karyawan</th>
                                                        <?php foreach ($queryKompetensi as $row) : ?>
                                                        <th><?= $row['nama_kompetensi'] ?></th>
                                                        <?php endforeach ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1 ?>
                                                    <?php foreach ($queryGuru as $row) : ?>
                                                    <?php $cekGuru = mysqli_num_rows($crud->read("penilaian", "WHERE id_pengguna = '$row[id_pengguna]' AND semester = '$semester' AND periode = '$periode'")); ?>
                                                    <tr>
                                                        <th>S<?= $no++ ?></th>
                                                        <td><?= $row['nip'] ?></td>
                                                        <td><?= $row['nama_pengguna'] ?></td>
                                                        <?php foreach ($queryKompetensi as $rowk) : ?>
                                                        <td><?= $cekGuru >= 15 ? round($wp->VektorS_Kometensi($row['id_pengguna'], $rowk['kode_kompetensi'], $semester, $periode), 5) : '-' ?>
                                                        </td>
                                                        <?php endforeach ?>
                                                    </tr>
                                                    <?php endforeach ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 grid-margin stretch-card mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Vektor V</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <?php $so = 0 ?>
                                        <?php foreach ($queryGuru as $rowG) : $so++ ?>
                                        <p>
                                            <b>V<?= $so ?></b> : (
                                            <?php $no_so = 0 ?>
                                            <?php foreach ($queryKompetensi as $rowK) : $no_so++ ?>
                                            <?= round($wp->VektorS_Kometensi($rowG['id_pengguna'], $rowK['kode_kompetensi'], $semester, $periode), 5) ?>
                                            <?= $no_so < mysqli_num_rows($queryKompetensi) ? '+' : '' ?>
                                            <?php endforeach ?>
                                            ) / 5
                                            =
                                            <b><?= round($wp->VektorV_Kompetensi($rowG['id_pengguna'], $semester, $periode), 5) ?></b>
                                        </p>
                                        <hr>
                                        <?php endforeach ?>
                                    </div>
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover text-center border-dark">
                                                <thead>
                                                    <tr>
                                                        <th class="align-middle">Kode</th>
                                                        <th class="align-middle">NIP Karyawan</th>
                                                        <th class="align-middle">Nama Karyawan</th>
                                                        <th class="align-middle">Vektor V</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1 ?>
                                                    <?php foreach ($queryGuru as $row) : ?>
                                                    <?php $cekGuru = mysqli_num_rows($crud->read("penilaian", "WHERE id_pengguna = '$row[id_pengguna]' AND semester = '$semester' AND periode = '$periode'")); ?>
                                                    <tr>
                                                        <th>V<?= $no++ ?></th>
                                                        <td><?= $row['nip'] ?></td>
                                                        <td><?= $row['nama_pengguna'] ?></td>
                                                        <td><?= $cekGuru >= 15 ? round($wp->VektorV_Kompetensi($row['id_pengguna'], $semester, $periode), 5) : '-' ?>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 grid-margin stretch-card mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Ranking dan Keputusan</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover text-center border-dark">
                                            <thead>
                                                <tr>
                                                    <th class="align-middle">Ranking</th>
                                                    <th class="align-middle">NIP Karyawan</th>
                                                    <th class="align-middle">Nama Karyawan</th>
                                                    <th class="align-middle">Total Nilai</th>
                                                    <th>Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1 ?>
                                                <?php foreach ($dataHasil as $row) : ?>
                                                <?php $cekGuru = mysqli_num_rows($crud->read("penilaian", "WHERE id_pengguna = '$row[id]' AND semester = '$semester' AND periode = '$periode'")); ?>
                                                <tr>
                                                    <th><?= $no++ ?></th>
                                                    <td><?= $row['nip'] ?></td>
                                                    <td><?= $row['nama'] ?></td>
                                                    <td><?= $cekGuru >= 15 ? $row['total_nilai'] : '-' ?></td>
                                                    <th><?= $cekGuru >= 15 ? $row['keputusan'] : '-' ?></th>
                                                </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php else : ?>
                        <div class="col-md-12 grid-margin stretch-card mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4>Belum ada penilaian atau penilaian belum cukup</h4>
                                </div>
                            </div>
                        </div>
                        <?php endif ?>
                        <?php endif ?>
                    </div>
                </div>
                <!-- \Content -->

                <!-- Footer -->
                <?php include 'app/view/layout/footer.php' ?>
                <!-- \Footer -->
            </div>
            <!-- \Main -->
        </div>
    </div>

    <!-- Script -->
    <?php include 'app/view/layout/script.php' ?>
    <!-- \Script -->
</body>

</html>