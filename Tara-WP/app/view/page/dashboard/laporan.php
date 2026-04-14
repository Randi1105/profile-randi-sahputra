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
                                Laporan Penilaian Karyawan
                            </h2>
                            <?php if (isset($_POST['cek'])) : ?>
                            <select class="d-none">
                                <h5> Tahap <?= $_POST['semester'] ?> Periode <?= $_POST['periode'] ?></h5>
                            </select>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <?php if (isset($_POST['cek'])) : ?>
                                    <a href="?r=Laporan&semester=<?= $_POST['semester'] ?>&periode=<?= $_POST['periode'] ?>"
                                        target="_blank" class="btn btn-primary">
                                        Cetak Laporan
                                    </a>
                                    <a href="?p=Laporan" class="btn btn-secondary">Reset</a>
                                    <?php else : ?>
                                    <form method="post" class="needs-validation" novalidate>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-check-label d-none">Tahap</label>
                                                <select class="form-control d-none" name="semester" required>
                                                    <option value="" disabled selected>Pilih</option>
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
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover text-center border-dark">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" class="align-middle">No</th>
                                                    <th rowspan="2" class="align-middle">Nama Karyawan</th>
                                                    <?php foreach ($queryKompetensi as $row) : ?>
                                                    <?php $rowIndikator = mysqli_num_rows(
                                                                $crud->read(
                                                                    "kriteria",
                                                                    "WHERE kode_kompetensi = '$row[kode_kompetensi]'"
                                                                )
                                                            ) ?>
                                                    <th colspan="<?= $rowIndikator ?>"><?= $row['kode_kompetensi'] ?>
                                                    </th>
                                                    <?php endforeach ?>
                                                    <th rowspan="2" class="align-middle">Rata-rata</th>
                                                    <th rowspan="2" class="align-middle">Keterangan</th>
                                                </tr>
                                                <tr>
                                                    <?php foreach ($queryKriteria as $row) : ?>
                                                    <th><?= $row['kode_kriteria'] ?></th>
                                                    <?php endforeach ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($queryGuru as $row) : ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
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
                                                    <?php if ($total_nilai == 0) : ?>
                                                    <th>-</th>
                                                    <th>-</th>
                                                    <?php else : ?>
                                                    <?php $rata = $total_nilai / mysqli_num_rows($queryIndikator) ?>
                                                    <?php if ($rata == 5) {
                                                                    # code...
                                                                    $ket = "Sangat Baik";
                                                                } elseif ($rata >= 4 and $rata < 5) {
                                                                    # code...
                                                                    $ket = "Baik";
                                                                } elseif ($rata >= 3 and $rata < 4) {
                                                                    # code...
                                                                    $ket = "Cukup Baik";
                                                                } elseif ($rata >= 2 and $rata < 3) {
                                                                    # code...
                                                                    $ket = "Kurang Baik";
                                                                } elseif ($rata >= 1 and $rata < 2) {
                                                                    # code...
                                                                    $ket = "Sangat Kurang Baik";
                                                                } else {
                                                                    # code...
                                                                    $ket = "-";
                                                                } ?>
                                                    <th><?= round($rata, 2) ?></th>
                                                    <th><?= $ket ?></th>
                                                    <?php endif ?>
                                                </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
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