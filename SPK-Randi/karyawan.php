<?php
require_once 'conn.php';

$page = "karyawan";
$no = 0;
$query = mysqli_query($con, "SELECT * FROM karyawan");

if (isset($_POST['submit'])) {
    $idkaryawan = $_POST['idkaryawan'];
    $checkQuery = mysqli_query($con, "SELECT * FROM karyawan WHERE idkaryawan = '$idkaryawan'");
    if (mysqli_num_rows($checkQuery) > 0) {
        echo "<script> alert('ID Karyawan sudah ada!') </script>";
    } else {
        $query = mysqli_query($con, "INSERT INTO karyawan (idkaryawan, nama, posisi, jabatan, tgljoin, jk)
                                     VALUES
                                     ('$_POST[idkaryawan]', '$_POST[nama]', '$_POST[posisi]', '$_POST[jabatan]', 
                                      '$_POST[tgljoin]', '$_POST[jk]')");

        if ($query) {
            header("Location: karyawan.php");
        } else {
            echo "<script> alert('GAGAL') </script>";
        }
    }
}

if (isset($_POST['edit'])) {
    $idkaryawan = $_POST['idkaryawan'];
    $originalIdkaryawan = $_POST['originalIdkaryawan'];

    if ($idkaryawan != $originalIdkaryawan) {
        $checkQuery = mysqli_query($con, "SELECT * FROM karyawan WHERE idkaryawan = '$idkaryawan'");
        if (mysqli_num_rows($checkQuery) > 0) {
            echo "<script> alert('ID Karyawan sudah ada!') </script>";
        } else {
            $query = mysqli_query($con, "UPDATE karyawan SET 
                                         idkaryawan = '$idkaryawan',
                                         nama = '$_POST[nama]', posisi = '$_POST[posisi]', jabatan = '$_POST[jabatan]', 
                                         tgljoin = '$_POST[tgljoin]', jk = '$_POST[jk]'
                                         WHERE idkaryawan = '$originalIdkaryawan'");

            $queryP = mysqli_query($con, "UPDATE penilaian SET 
                                         idkaryawan = '$idkaryawan',
                                         nama = '$_POST[nama]'
                                         WHERE idkaryawan = '$originalIdkaryawan'");

            $querySP = mysqli_query($con, "UPDATE subnilai SET 
                                         idkaryawan = '$idkaryawan',
                                         nama = '$_POST[nama]'
                                         WHERE idkaryawan = '$originalIdkaryawan'");

            if ($query && $queryP && $querySP) {
                header("Location: karyawan.php");
            } else {
                echo "<script> alert('GAGAL') </script>";
            }
        }
    } else {
        $query = mysqli_query($con, "UPDATE karyawan SET 
                                     nama = '$_POST[nama]', posisi = '$_POST[posisi]', jabatan = '$_POST[jabatan]', 
                                     tgljoin = '$_POST[tgljoin]', jk = '$_POST[jk]'
                                     WHERE idkaryawan = '$originalIdkaryawan'");

        $queryP = mysqli_query($con, "UPDATE penilaian SET 
                                     nama = '$_POST[nama]'
                                     WHERE idkaryawan = '$originalIdkaryawan'");

        $querySP = mysqli_query($con, "UPDATE subnilai SET 
                                     nama = '$_POST[nama]'
                                     WHERE idkaryawan = '$originalIdkaryawan'");

        if ($query && $queryP && $querySP) {
            header("Location: karyawan.php");
        } else {
            echo "<script> alert('GAGAL') </script>";
        }
    }
}

if (isset($_POST['hapus'])) {
    $query   = mysqli_query($con, "DELETE FROM karyawan WHERE idkaryawan = '$_POST[idkaryawan]'");
    $queryP  = mysqli_query($con, "DELETE FROM penilaian WHERE idkaryawan = '$_POST[idkaryawan]'");
    $querySP = mysqli_query($con, "DELETE FROM subnilai WHERE idkaryawan = '$_POST[idkaryawan]'");

    if ($query && $queryP && $querySP) {
        header("Location: karyawan.php");
    } else {
        echo "<script> alert('GAGAL') </script>";
    }
}
?>

<?php require_once 'layout/sidebar.php' ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card shadow-lg">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-12">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="card-title fw-bolder mt-2">Data Karyawan</h5>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                                        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                        <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                                    </svg>
                                </button>

                                <!-- Tambah -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="" method="post">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label class="form-label">ID Karyawan</label>
                                                        <input type="text" class="form-control" name="idkaryawan" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Nama</label>
                                                        <input type="text" class="form-control" name="nama" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Posisi</label>
                                                        <select class="form-select" name="posisi" aria-label="Default select example" required>
                                                            <option selected disabled>Pilih</option>
                                                            <option value="Operasional">Operasional</option>
                                                            <option value="Customer Service">Customer Service</option>
                                                            <option value="Accounting">Accounting</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Level Jabatan</label>
                                                        <input type="text" class="form-control" name="jabatan" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Join Bekerja</label>
                                                        <input type="date" class="form-control" name="tgljoin" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Jenis Kelamin</label>
                                                        <select class="form-select" name="jk" aria-label="Default select example" required>
                                                            <option selected disabled>Pilih</option>
                                                            <option value="Laki-laki">Laki-laki</option>
                                                            <option value="Perempuan">Perempuan</option>
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Tambah -->
                            </div>
                            <table class="table table-responsive text-center">
                                <thead>
                                    <tr>
                                        <th class="fw-bolder">No</th>
                                        <th class="fw-bolder">ID Karyawan</th>
                                        <th class="fw-bolder">Nama</th>
                                        <th class="fw-bolder">Posisi</th>
                                        <th class="fw-bolder">Level Jabatan</th>
                                        <th class="fw-bolder">Join Bekerja</th>
                                        <th class="fw-bolder">Jenis Kelamin</th>
                                        <th class="fw-bolder">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($query as $data) : $no++ ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $data['idkaryawan'] ?></td>
                                            <td><?= $data['nama'] ?></td>
                                            <td><?= $data['posisi'] ?></td>
                                            <td><?= $data['jabatan'] ?></td>
                                            <td><?= $data['tgljoin'] ?></td>
                                            <td><?= $data['jk'] ?></td>
                                            <td>
                                                <a href="" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $no ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                        <path d="M12.854.146a.5.5 0 0 1 .638-.057l.07.057 2.343 2.343a.5.5 0 0 1 .057.638l-.057.07-10 10a.5.5 0 0 1-.196.12l-2.416.805a.25.25 0 0 1-.316-.316l.805-2.416a.5.5 0 0 1 .12-.196l10-10zM11.207 2.5 3.5 10.207V12.5h2.293l7.707-7.707-2.293-2.293z" />
                                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h10a1.5 1.5 0 0 0 1.493-1.355L14 13.5V3.5a1.5 1.5 0 0 0-1.355-1.493L12.5 2H3.5a1.5 1.5 0 0 0-1.493 1.355L2 3.5v10a1.5 1.5 0 0 0 1.355 1.493L3.5 15H12V3H3v10h8.5v-9H2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5A1.5 1.5 0 0 0 14 2H2.5A1.5 1.5 0 0 0 1 3.5v10a1.5 1.5 0 0 0 1.355 1.493L3.5 15H2.5a1.5 1.5 0 0 1-1.355-1.493L1 13.5v-10A1.5 1.5 0 0 1 2.5 2H12.5a.5.5 0 0 1 .493.5v10a1.5 1.5 0 0 0 1.355 1.493L14 14h-1a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2H12zM10.5 12h-7a1 1 0 0 1-.117-1.993L3.5 10h7a1 1 0 0 1 .117 1.993L10.5 12h-7zM2.5 3h10a.5.5 0 0 0 .5-.5v-.5A1.5 1.5 0 0 0 11.5 0h-10A1.5 1.5 0 0 0 0 1.5v.5a.5.5 0 0 0 .5.5h2zM11 6.5a.5.5 0 0 1 .5-.5h2A1.5 1.5 0 0 1 15 7.5v6A1.5 1.5 0 0 1 13.5 15h-10A1.5 1.5 0 0 1 2 13.5v-10A1.5 1.5 0 0 1 3.5 2h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5v-6a.5.5 0 0 1 .5-.5z" />
                                                    </svg>
                                                </a>
                                                <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $no ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                        <path d="M11 1.5v1H5v-1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1z" />
                                                        <path d="M14.5 3a1 1 0 0 1-1 1H2.5a1 1 0 0 1-1-1H1v1a1 1 0 0 1-1 1v9a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V5a1 1 0 0 1-1-1V3h-1z" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="editModal<?= $no ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="" method="post">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="editModalLabel">Edit Data</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="originalIdkaryawan" value="<?= $data['idkaryawan'] ?>">
                                                            <div class="mb-3">
                                                                <label class="form-label">ID Karyawan</label>
                                                                <input type="text" class="form-control" name="idkaryawan" value="<?= $data['idkaryawan'] ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Nama</label>
                                                                <input type="text" class="form-control" name="nama" value="<?= $data['nama'] ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Posisi</label>
                                                                <select class="form-select" name="posisi" aria-label="Default select example" required>
                                                                    <option selected><?= $data['posisi'] ?></option>
                                                                    <option value="Operasional">Operasional</option>
                                                                    <option value="Customer Service">Customer Service</option>
                                                                    <option value="Accounting">Accounting</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Level Jabatan</label>
                                                                <input type="text" class="form-control" name="jabatan" value="<?= $data['jabatan'] ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Join Bekerja</label>
                                                                <input type="date" class="form-control" name="tgljoin" value="<?= $data['tgljoin'] ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Jenis Kelamin</label>
                                                                <select class="form-select" name="jk" aria-label="Default select example" required>
                                                                    <option selected><?= $data['jk'] ?></option>
                                                                    <option value="Laki-laki">Laki-laki</option>
                                                                    <option value="Perempuan">Perempuan</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name="edit" class="btn btn-success">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal Edit -->

                                        <!-- Modal Hapus -->
                                        <div class="modal fade" id="hapusModal<?= $no ?>" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="" method="post">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="hapusModalLabel">Hapus Data</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="idkaryawan" value="<?= $data['idkaryawan'] ?>">
                                                            <p>Yakin Ingin Menghapus Data?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name="hapus" class="btn btn-danger">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal Hapus -->
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'layout/footer.php' ?>
