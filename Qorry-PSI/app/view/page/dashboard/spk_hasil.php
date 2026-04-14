<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Head -->
    <?php include 'app/view/layout/head.php' ?>
    <!-- \Head -->
</head>

<body>
    <!-- Contoller -->
    <?php include 'app/controller/dashboard/spk_hasil.php' ?>
    <!-- \Controller -->

    <!-- Loading -->
    <?php include 'app/view/layout/loading.php' ?>
    <!-- \Loading -->

    <div class="page-wrapper">
        <!-- Sidebar -->
        <?php include 'app/view/layout/sidebar.php' ?>
        <!-- \Sidebar -->

        <div class="main-container">
            <!-- Navbar -->
            <?php include 'app/view/layout/navbar.php' ?>
            <!-- \Navbar -->

            <!-- Content -->
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-12">
                        <h2><?= $dataPage['page'] ?></h2>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="card">
                            <div class="row ps-4 pt-3 mb-1">
                                <div class="col-3">
                                    <select class="form-control" name="periode" required>
                                        <option value="" disabled selected>Periode</option>
                                        <?php for ($i = 2018; $i <= date('Y'); $i++) : ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php endfor ?>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <button type="button" class="btn btn-primary">Cek Data</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-center align-middle">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Karyawan</th>
                                                <th>Nama</th>
                                                <th>Total Nilai</th>
                                                <th>Keputusan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($queryHasil as $row) : $no++ ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $row['id_karyawan'] ?></td>
                                                <td><?= $row['nama_karyawan'] ?></td>
                                                <td><?= $row['total_nilai'] ?></td>
                                                <td></td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- \Content -->
        </div>
    </div>

    <!-- Script -->
    <?php include 'app/view/layout/script.php' ?>
    <!-- \Script -->
</body>

</html>