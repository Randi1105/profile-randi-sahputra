<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Head -->
    <?php include 'app/view/layout/head.php' ?>
    <!-- \Head -->
</head>

<body>
    <!-- Controller -->
    <?php include 'app/controller/dashboard/data_nilai.php' ?>
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
                    <!-- Row start -->
                    <div class="row gx-3">
                        <div class="col-xl-12 col-sm-12 col-12">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <button class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#tambahModal">
                                        Tambah Data
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover text-center align-middle">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Penilaian</th>
                                                    <th>Id Karyawan</th>
                                                    <th>Nama Karyawan</th>
                                                    <?php foreach ($queryKriteria as $rowk) : ?>
                                                    <th><?= $rowk['nama_kriteria'] ?></th>
                                                    <?php endforeach ?>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($queryNilai as $row) : ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $row['id_nilai'] ?></td>
                                                    <td><?= $row['id_karyawan'] ?></td>
                                                    <td><?= $row['nama_karyawan'] ?></td>
                                                    <?php foreach ($queryKriteria as $rowk) : ?>
                                                    <?php if ($rowk['tipe_kriteria'] == "Pilihan") : ?>
                                                    <?php $kode = $rowk['kode_kriteria'] ?>
                                                    <?php $dataNilaiSub = mysqli_fetch_array($crud->read("sub_kriteria", "WHERE kode_kriteria = '$kode' AND nilai_sub = '$row[$kode]'")) ?>
                                                    <td><?= $dataNilaiSub['nama_sub'] ?></td>
                                                    <?php else : ?>
                                                    <td><?= $row[$rowk['kode_kriteria']] ?></td>
                                                    <?php endif ?>
                                                    <?php endforeach ?>
                                                    <td>
                                                        <button type="button" class="btn btn-warning"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editModal<?= $no ?>">
                                                            Edit
                                                        </button>
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#hapusModal<?= $no ?>">
                                                            Hapus
                                                        </button>
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
                    <!-- Row end -->
                </div>
                <!-- \Body -->

                <!-- Form Tambah Data -->
                <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Form Tambah Data</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">ID Karyawan || Nama Karyawan</label>
                                            <select name="id_karyawan" class="form-control" required>
                                                <option value="" disabled selected>Pilih</option>
                                                <?php foreach ($queryKaryawan as $rows) : ?>
                                                <option value="<?= $rows['id_karyawan'] ?>"><?= $rows['id_karyawan'] ?>
                                                    || <?= $rows['nama_karyawan'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Periode Penilaian</label>
                                            <select name="periode" class="form-control" required>
                                                <option value="" disabled selected>Pilih</option>
                                                <?php for ($i = 2020; $i <= date('Y'); $i++) : ?>
                                                <option value="<?= $i ?>"><?= $i ?></option>
                                                <?php endfor ?>
                                            </select>
                                        </div>
                                        <?php foreach ($queryKriteria as $rowk) : ?>
                                        <?php $kode = $rowk['kode_kriteria'] ?>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label"><?= $rowk['nama_kriteria'] ?></label>
                                            <?php if ($rowk['tipe_kriteria'] == "Pilihan") : ?>
                                            <select name="<?= $kode ?>" class="form-control" required>
                                                <option value="" disabled selected>Pilih</option>
                                                <?php $queryCekSub = $crud->read("sub_kriteria", "WHERE kode_kriteria = '$kode' ORDER BY nilai_sub DESC") ?>
                                                <?php foreach ($queryCekSub as $rowsk) : ?>
                                                <option value="<?= $rowsk['nilai_sub'] ?>"><?= $rowsk['nama_sub'] ?>
                                                    (Skala : <?= $rowsk['nilai_sub'] ?>)
                                                </option>
                                                <?php endforeach ?>
                                            </select>
                                            <?php else : ?>
                                            <input type="number" class="form-control" step="any" name="<?= $kode ?>"
                                                required>
                                            <?php endif ?>
                                        </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="tambah" class="btn btn-success">Tambah Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- \Form Tambah Data -->

                <?php $no = 1 ?>
                <?php foreach ($queryNilai as $data) : $no++ ?>
                <!-- Form Edit Data -->
                <div class="modal fade" id="editModal<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Form Edit Data</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Kode Penilaian</label>
                                            <input type="text" class="form-control" name="id_nilai"
                                                value="<?= $data['id_nilai'] ?>" readonly>
                                        </div>
                                        <?php foreach ($queryKriteria as $rowk) : ?>
                                        <?php $kode = $rowk['kode_kriteria'] ?>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label"><?= $rowk['nama_kriteria'] ?></label>
                                            <?php if ($rowk['tipe_kriteria'] == "Pilihan") : ?>
                                            <select name="<?= $kode ?>" class="form-control" required>
                                                <option value="" disabled selected>Pilih</option>
                                                <?php $queryCekSub = $crud->read("sub_kriteria", "WHERE kode_kriteria = '$kode'") ?>
                                                <?php foreach ($queryCekSub as $rowsk) : ?>
                                                <option value="<?= $rowsk['nilai_sub'] ?>"
                                                    <?= $data[$kode] == $rowsk['nilai_sub'] ? 'selected' : '' ?>>
                                                    <?= $rowsk['nama_sub'] ?> (SKala : <?= $rowsk['nilai_sub'] ?>)
                                                </option>
                                                <?php endforeach ?>
                                            </select>
                                            <?php else : ?>
                                            <input type="number" class="form-control" step="any" name="<?= $kode ?>"
                                                value="<?= $data[$kode] ?>" required>
                                            <?php endif ?>
                                        </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="edit" class="btn btn-warning">Edit Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- \Form Edit Data -->

                <!-- Form Hapus Data -->
                <div class="modal fade" id="hapusModal<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Form Edit Data</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id_nilai" value="<?= $data['id_nilai'] ?>">
                                    <p>Yakin ingin hapus data dengan nama <b><?= $data['nama_karyawan'] ?></b> ?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="hapus" class="btn btn-danger">Hapus Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- \Form Hapus Data -->
                <?php endforeach ?>

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