<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Head -->
    <?php include 'app/view/layout/head.php' ?>
    <!-- \Head -->
</head>

<body>
    <!-- Controller -->
    <?php include 'app/controller/dashboard/data_indikator.php' ?>
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
                                Data Indikator
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
                                                                <label class="form-check-label">Kode Kriteria</label>
                                                                <select class="form-control" name="kode_kriteria" required>
                                                                    <option value="" disabled selected>Pilih</option>
                                                                    <?php foreach ($queryKriteria as $rowk) : ?>
                                                                        <option value="<?= $rowk['kode_kriteria'] ?>"><?= $rowk['kode_kriteria'] ?> (<?= $rowk['nama_kriteria'] ?>)</option>
                                                                    <?php endforeach ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                <label class="form-check-label">Kode Indikator</label>
                                                                <input type="text" class="form-control" name="kode_indikator" required>
                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                <label class="form-check-label">Nama Indikator</label>
                                                                <input type="text" class="form-control" name="nama_indikator" required>
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
                                                    <th>Kode Kriteria</th>
                                                    <th>Kode Indikator</th>
                                                    <th>Nama Indikator</th>
                                                    <th>Kategori</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($queryIndikator as $row) : ?>
                                                    <?php $total_kategori = mysqli_num_rows(
                                                        $crud->read(
                                                            "kategori",
                                                            "WHERE id_indikator = '$row[id_indikator]'"
                                                        )
                                                    ) ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $row['kode_kriteria'] ?></td>
                                                        <td><?= $row['kode_indikator'] ?></td>
                                                        <td><?= $row['nama_indikator'] ?></td>
                                                        <td>
                                                            <a href="?p=DataKategori&id=<?= $row['id_indikator'] ?>" class="btn btn-primary"><?= $total_kategori ?> Kategori</a>
                                                        </td>
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
                                                                        <input type="hidden" name="id_indikator" value="<?= $row['id_indikator'] ?>">
                                                                        <div class="row">
                                                                            <div class="col-md-12 mb-3">
                                                                                <label class="form-check-label">Kode Kriteria</label>
                                                                                <select class="form-control" name="kode_kriteria" required>
                                                                                    <option value="" disabled selected>Pilih</option>
                                                                                    <?php foreach ($queryKriteria as $rowk) : ?>
                                                                                        <?php if ($row['kode_kriteria'] == $rowk['kode_kriteria']) : ?>
                                                                                            <option value="<?= $rowk['kode_kriteria'] ?>" selected><?= $rowk['kode_kriteria'] ?> (<?= $rowk['nama_kriteria'] ?>)</option>
                                                                                        <?php else : ?>
                                                                                            <option value="<?= $rowk['kode_kriteria'] ?>"><?= $rowk['kode_kriteria'] ?> (<?= $rowk['nama_kriteria'] ?>)</option>
                                                                                        <?php endif ?>
                                                                                    <?php endforeach ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-12 mb-3">
                                                                                <label class="form-check-label">Kode Indikator</label>
                                                                                <input type="text" class="form-control" name="kode_indikator" value="<?= $row['kode_indikator'] ?>" required>
                                                                            </div>
                                                                            <div class="col-md-12 mb-3">
                                                                                <label class="form-check-label">Nama Indikator</label>
                                                                                <input type="text" class="form-control" name="nama_indikator" value="<?= $row['nama_indikator'] ?>" required>
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
                                                                            <input type="hidden" name="id_indikator" value="<?= $row['id_indikator'] ?>">
                                                                            <div class="col-md-12 mb-3">
                                                                                <p>Yakin Ingin Hapus data dengan nama <b><?= $row['nama_indikator'] ?></b> ?</p>
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