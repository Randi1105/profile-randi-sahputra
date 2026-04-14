<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Head -->
    <?php include 'app/view/layout/head.php' ?>
    <!-- \Head -->
</head>

<body>
    <!-- Controller -->
    <?php include 'app/controller/dashboard/data_pengguna.php' ?>
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
                                Data Pengguna
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
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-check-label">Username</label>
                                                                <input type="text" class="form-control" name="username" required>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-check-label">Pasword</label>
                                                                <input type="text" class="form-control" name="password" required>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-check-label">NIP</label>
                                                                <input type="text" class="form-control" name="nip" required>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-check-label">Nama Pengguna</label>
                                                                <input type="text" class="form-control" name="nama_pengguna" required>
                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                <label class="form-check-label">Jabatan</label>
                                                                <select class="form-control" name="jabatan" required>
                                                                    <option value="" disabled selected>Pilih</option>
                                                                    <option value="Kepala">Kepala</option>
                                                                    <option value="Operator">Operator</option>
                                                                    <option value="Karyawan">Karyawan</option>
                                                                </select>
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
                                                    <th>Username</th>
                                                    <th>Password</th>
                                                    <th>NIP</th>
                                                    <th>Nama</th>
                                                    <th>Jabatan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($queryPengguna as $row) : ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $row['username'] ?></td>
                                                        <td><?= $row['password'] ?></td>
                                                        <td><?= $row['nip'] ?></td>
                                                        <td><?= $row['nama_pengguna'] ?></td>
                                                        <td><?= $row['jabatan'] ?></td>
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
                                                                            <input type="hidden" name="id_pengguna" value="<?= $row['id_pengguna'] ?>">
                                                                            <div class="col-md-6 mb-3">
                                                                                <label class="form-check-label">Username</label>
                                                                                <input type="text" class="form-control" name="username" value="<?= $row['username'] ?>" required>
                                                                            </div>
                                                                            <div class="col-md-6 mb-3">
                                                                                <label class="form-check-label">Pasword</label>
                                                                                <input type="text" class="form-control" name="password" value="<?= $row['password'] ?>" required>
                                                                            </div>
                                                                            <div class="col-md-6 mb-3">
                                                                                <label class="form-check-label">NIP</label>
                                                                                <input type="text" class="form-control" name="nip" value="<?= $row['nip'] ?>" required>
                                                                            </div>
                                                                            <div class="col-md-6 mb-3">
                                                                                <label class="form-check-label">Nama Pengguna</label>
                                                                                <input type="text" class="form-control" name="nama_pengguna" value="<?= $row['nama_pengguna'] ?>" required>
                                                                            </div>
                                                                            <div class="col-md-12 mb-3">
                                                                                <label class="form-check-label">Jabatan</label>
                                                                                <select class="form-control" name="jabatan" required>
                                                                                    <option value="" disabled selected>Pilih</option>
                                                                                    <option value="Kepala" <?= $row['jabatan'] == "Kepala" ? 'selected' : '' ?>>Kepala</option>
                                                                                    <option value="Operator" <?= $row['jabatan'] == "Operator" ? 'selected' : '' ?>>Operator</option>
                                                                                    <option value="Karyawan" <?= $row['jabatan'] == "Karyawan" ? 'selected' : '' ?>>Karyawan</option>
                                                                                </select>
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
                                                                            <input type="hidden" name="id_pengguna" value="<?= $row['id_pengguna'] ?>">
                                                                            <div class="col-md-12 mb-3">
                                                                                <p>Yakin Ingin Hapus data dengan nama <b><?= $row['nama_pengguna'] ?></b> ?</p>
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