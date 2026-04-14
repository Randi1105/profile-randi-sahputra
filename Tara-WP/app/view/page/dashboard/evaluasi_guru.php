<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Head -->
    <?php include 'app/view/layout/head.php' ?>
    <!-- \Head -->
</head>

<body>
    <!-- Controller -->
    <?php include 'app/controller/dashboard/evaluasi_guru.php' ?>
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
                                Hasil Penilaian Menggunakan Metode Weighted Product
                            </h2>
                            <?php if (isset($_POST['cek'])) : ?>
                                <h5>Semester <?= $semester ?> Periode <?= $periode ?></h5>
                            <?php endif ?>
                        </div>
                    </div>
                    <?php if (isset($_POST['cek'])) : ?>
                        <div class="row">
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-header">
                                        <a href="?p=Evaluasi" class="btn btn-secondary">Reset</a>
                                    </div>
                                    <div class="card-body">
                                        <?php if (mysqli_num_rows($queryCekPenilaian) == $jumlah_indikator) :  ?>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover text-center align-middle border-dark">
                                                    <thead>
                                                        <tr>
                                                            <th>Kompetensi</th>
                                                            <th>Kriteria</th>
                                                            <th>Nilai</th>
                                                            <th>Keterangan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($queryKompetensi as $rKompetensi) : $no++ ?>
                                                            <?php $queryKriteria = $crud->read("kriteria", "WHERE kode_kompetensi = '$rKompetensi[kode_kompetensi]'") ?>
                                                            <?php $rowKriteria = mysqli_num_rows($queryKriteria) + 1 ?>
                                                            <tr>
                                                                <th rowspan="<?= $rowKriteria ?>"><?= $rKompetensi['nama_kompetensi'] ?></th>
                                                            </tr>
                                                            <?php foreach ($queryKriteria as $rKriteria) : ?>
                                                                <?php $dataPenilaian = mysqli_fetch_array(
                                                                    $crud->read(
                                                                        "penilaian",
                                                                        "INNER JOIN pengguna ON penilaian.id_pengguna = pengguna.id_pengguna
                                                                         INNER JOIN kriteria ON penilaian.kode_kriteria = kriteria.kode_kriteria
                                                                         INNER JOIN kompetensi ON penilaian.kode_kompetensi = kompetensi.kode_kompetensi
                                                                         WHERE 
                                                                         penilaian.id_pengguna = '$id_guru' AND
                                                                         penilaian.kode_kriteria = '$rKriteria[kode_kriteria]' AND
                                                                         penilaian.semester = '$semester' AND 
                                                                         penilaian.periode = '$periode'
                                                                         ORDER BY LENGTH(kriteria.kode_kriteria) ASC"
                                                                    )
                                                                ); ?>
                                                                <tr>
                                                                    <td><?= $rKriteria['nama_kriteria'] ?></td>
                                                                    <td><?= $dataPenilaian['nilai'] ?></td>
                                                                    <td><?= $wp->Indikator($dataPenilaian['nilai']) ?></td>
                                                                </tr>
                                                            <?php endforeach ?>
                                                        <?php endforeach ?>
                                                        <tr>
                                                            <th colspan="2">Hasil Perhitungan Metode Weighted Product</th>
                                                            <th><?= round($wp->VektorV_Kompetensi($id_guru, $semester, $periode), 5) ?></th>
                                                            <th><?= $wp->Keputusan($wp->VektorV_Kompetensi($id_guru, $semester, $periode)) ?></th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php else : ?>
                                            <h2>Belum ada penilaian</h2>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="row">
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="post" class="needs-validation" novalidate>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-check-label d-none">Semester</label>
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
                                                    <button type="submit" name="cek" class="btn btn-success">Cek Data</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
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