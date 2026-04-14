<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Head -->
    <?php include 'app/view/layout/head.php' ?>
    <!-- \Head -->
</head>

<body>
    <!-- Controller -->
    <?php include 'app/controller/dashboard/data_kriteria.php' ?>
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
                                Data Kriteria
                            </h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-header">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahModal">
                                        Tambah Data
                                    </button>

                                    <!-- Form Tambah Data -->
                                    <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <form method="post" class="needs-validation p-3" novalidate>
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-3">
                                                                <label class="form-check-label">Kode Kompetensi</label>
                                                                <select class="form-control" name="kode_kompetensi" required>
                                                                    <option value="" disabled selected>Pilih</option>
                                                                    <?php foreach ($queryKompetensi as $rowk) : ?>
                                                                        <option value="<?= $rowk['kode_kompetensi'] ?>"><?= $rowk['kode_kompetensi'] ?> (<?= $rowk['nama_kompetensi'] ?>)</option>
                                                                    <?php endforeach ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                <label class="form-check-label">Kode Kriteria</label>
                                                                <input type="text" class="form-control" name="kode_kriteria" required>
                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                <label class="form-check-label">Nama Kriteria</label>
                                                                <input type="text" class="form-control" name="nama_kriteria" required>
                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                <label class="form-check-label">Bobot Kriteria</label>
                                                                <input type="text" class="form-control" name="bobot_kriteria" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="tambah" class="btn btn-success">Tambah</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- \Form Tambah Data -->
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover text-center align-middle border-dark">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Kompetensi</th>
                                                    <th>Kode Kriteria</th>
                                                    <th>Nama Kriteria</th>
                                                    <th>Bobot</th>
                                                    <th>Relatif</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($queryKriteria as $row) : ?>
                                                    <?php $total_relatif += ($row['bobot_kriteria'] / $total_bobot)  ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $row['kode_kompetensi'] ?></td>
                                                        <td><?= $row['kode_kriteria'] ?></td>
                                                        <td><?= $row['nama_kriteria'] ?></td>
                                                        <td><?= $row['bobot_kriteria'] ?></td>
                                                        <td><?= $row['bobot_kriteria'] / $total_bobot ?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal<?= $no ?>">
                                                                Edit
                                                            </button>
                                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusModal<?= $no ?>">
                                                                Hapus
                                                            </button>
                                                        </td>
                                                    </tr>

                                                    <!-- Form Edit Data -->
                                                    <div class="modal fade" id="editModal<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <form method="post" class="needs-validation p-3" novalidate>
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12 mb-3">
                                                                                <label class="form-check-label">Kode Kompetensi</label>
                                                                                <select class="form-control" name="kode_kompetensi" required>
                                                                                    <option value="" disabled selected>Pilih</option>
                                                                                    <?php foreach ($queryKompetensi as $rowk) : ?>
                                                                                        <?php if ($row['kode_kompetensi'] == $rowk['kode_kompetensi']) : ?>
                                                                                            <option value="<?= $rowk['kode_kompetensi'] ?>" selected><?= $rowk['kode_kompetensi'] ?> (<?= $rowk['nama_kompetensi'] ?>)</option>
                                                                                        <?php else : ?>
                                                                                            <option value="<?= $rowk['kode_kompetensi'] ?>"><?= $rowk['kode_kompetensi'] ?> (<?= $rowk['nama_kompetensi'] ?>)</option>
                                                                                        <?php endif ?>
                                                                                    <?php endforeach ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-12 mb-3">
                                                                                <label class="form-check-label">Kode Kriteria</label>
                                                                                <input type="text" class="form-control" name="kode_kriteria" value="<?= $row['kode_kriteria'] ?>" readonly>
                                                                            </div>
                                                                            <div class="col-md-12 mb-3">
                                                                                <label class="form-check-label">Nama Kriteria</label>
                                                                                <input type="text" class="form-control" name="nama_kriteria" value="<?= $row['nama_kriteria'] ?>" required>
                                                                            </div>
                                                                            <div class="col-md-12 mb-3">
                                                                                <label class="form-check-label">Bobot Kriteria</label>
                                                                                <input type="number" class="form-control" name="bobot_kriteria" value="<?= $row['bobot_kriteria'] ?>" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" name="edit" class="btn btn-warning">Edit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- \Form Edit Data -->

                                                    <!-- Form Hapus Data -->
                                                    <div class="modal fade" id="hapusModal<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <form method="post" class="needs-validation p-3" novalidate>
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <input type="hidden" name="kode_kriteria" value="<?= $row['kode_kriteria'] ?>">
                                                                            <div class="col-md-12 mb-3">
                                                                                <p>Yakin Ingin Hapus data dengan nama <b><?= $row['nama_kriteria'] ?></b> ?</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- \Form Hapus Data -->
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