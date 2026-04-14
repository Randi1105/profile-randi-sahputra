<?php
require_once 'conn.php';

$page = "sub";
$no = 0;
$query = mysqli_query(
    $con,
    "SELECT * FROM penilaian 
     INNER JOIN karyawan ON karyawan.idkaryawan = penilaian.idkaryawan
     ORDER BY penilaian.idkaryawan ASC"
);
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
                                <h5 class="card-title fw-bolder mt-2">Sub-kriteria Penilaian</h5>
                            </div>
                            <table class="table table-responsive text-center">
                                <thead>
                                    <tr>
                                        <th class="fw-bolder">NO</th>
                                        <th class="fw-bolder">Nama</th>
                                        <th class="fw-bolder">C1</th>
                                        <th class="fw-bolder">C2</th>
                                        <th class="fw-bolder">C3</th>
                                        <th class="fw-bolder">C4</th>
                                        <th class="fw-bolder">C5</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($query as $data) : $no++ ?>
                                    <tr>
                                        <th scope="row" class="fw-bolder"><?= $no ?></th>
                                        <td><?= $data['nama'] ?></td>
                                        <td><?= $data['C1'] ?></td>
                                        <td><?= $data['C2']  ?></td>
                                        <td><?= $data['C3'] ?></td>
                                        <td><?= $data['C4'] ?></td>
                                        <td><?= $data['C5'] ?></td>
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
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card shadow-lg">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-12">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="card-title fw-bolder mt-2">Parameter Kehadiran (C1)</h5>
                            </div>
                            <table class="table table-responsive text-center">
                                <thead>
                                    <tr>
                                        <th class="fw-bolder">NO</th>
                                        <th class="fw-bolder">Nama Parameter</th>
                                        <th class="fw-bolder">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>26 Hari</td>
                                        <td>90</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>24 - 25 Hari</td>
                                        <td>80</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>22 - 23 Hari</td>
                                        <td>70</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>20 - 21 Hari</td>
                                        <td>60</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Kecil dari Sama Dengan 19 Hari</td>
                                        <td>50</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card shadow-lg">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-12">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="card-title fw-bolder mt-2">Parameter Keterlambatan (C2)</h5>
                            </div>
                            <table class="table table-responsive text-center">
                                <thead>
                                    <tr>
                                        <th class="fw-bolder">NO</th>
                                        <th class="fw-bolder">Nama Parameter</th>
                                        <th class="fw-bolder">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2</td>
                                        <td>1 - 59 Menit</td>
                                        <td>80</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Besar Samadengan 60 Menit</td>
                                        <td>70</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card shadow-lg">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-12">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="card-title fw-bolder mt-2">Parameter Masa Kerja (C3)</h5>
                            </div>
                            <table class="table table-responsive text-center">
                                <thead>
                                    <tr>
                                        <th class="fw-bolder">NO</th>
                                        <th class="fw-bolder">Nama Parameter</th>
                                        <th class="fw-bolder">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Lebih Dari 10 Tahun</td>
                                        <td>90</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>5 Sampai 10 Tahun</td>
                                        <td>80</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Kecil Dari 5 Tahun</td>
                                        <td>70</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card shadow-lg">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-12">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="card-title fw-bolder mt-2">Parameter Kerapian (C4)</h5>
                            </div>
                            <table class="table table-responsive text-center">
                                <thead>
                                    <tr>
                                        <th class="fw-bolder">NO</th>
                                        <th class="fw-bolder">Nama Parameter</th>
                                        <th class="fw-bolder">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Sangat Rapi</td>
                                        <td>90</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Rapi</td>
                                        <td>80</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Cukup Rapi</td>
                                        <td>70</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Kurang Rapi</td>
                                        <td>60</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Tidak Rapi</td>
                                        <td>50</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card shadow-lg">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-12">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="card-title fw-bolder mt-2">Parameter Tanggung Jawab (C5)</h5>
                            </div>
                            <table class="table table-responsive text-center">
                                <thead>
                                    <tr>
                                        <th class="fw-bolder">NO</th>
                                        <th class="fw-bolder">Nama Parameter</th>
                                        <th class="fw-bolder">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Iya</td>
                                        <td>90</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Tidak</td>
                                        <td>50</td>
                                    </tr>
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