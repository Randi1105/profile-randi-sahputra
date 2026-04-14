<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Head -->
    <?php include 'app/view/layout/head.php' ?>
    <!-- \Head -->
</head>

<body>
    <!-- Controller -->
    <?php include 'app/controller/dashboard/dashboard.php' ?>
    <!-- \Controller -->

    <div class="container-scroller">
        <!-- Nav -->
        <?php include 'app/view/layout/nav.php' ?>
        <!-- \Nav -->

        <div class="container-fluid page-body-wrapper">
            <!-- Sidebar -->
            <?php include 'app/view/layout/sidebar.php' ?>
            <!-- \Sidebar -->

            <!-- Main -->
            <div class="main-panel">
                <!-- Content -->
                <div class="content-wrapper">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h2 class="font-weight-bolder text-uppercase text-center">
                                OPTIMALISASI SUMBER DAYA MANUSIA DENGAN MERANCANG SISTEM PENDUKUNG KEPUTUSAN UNTUK PENILAIAN KINERJA PEGAWAI PADA KANWIL KEMENKUMHAM SUMATERA BARAT MENGGUNAKAN METODE WEIGHTED PRODUCT
                            </h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body dashboard-tabs p-0">
                                    <div class="tab-content py-0 px-0">
                                        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                            <div class="d-flex flex-wrap justify-content-xl-between">
                                                <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                    <i class="mdi mdi-account-multiple mr-3 icon-lg text-success"></i>
                                                    <div class="d-flex flex-column justify-content-around">
                                                        <small class="mb-1 text-muted font-weight-bold">Data Pengguna</small>
                                                        <h5 class="mr-2 mb-0"><?= mysqli_num_rows($queryPengguna) ?> Data</h5>
                                                    </div>
                                                </div>
                                                <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                    <i class="mdi mdi-account-box-multiple mr-3 icon-lg text-primary"></i>
                                                    <div class="d-flex flex-column justify-content-around">
                                                        <small class="mb-1 text-muted font-weight-bold">Data Karyawan</small>
                                                        <h5 class="mr-2 mb-0"><?= mysqli_num_rows($queryGuru) ?> Data</h5>
                                                    </div>
                                                </div>
                                                <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                    <i class="mdi mdi-chart-bar mr-3 icon-lg text-warning"></i>
                                                    <div class="d-flex flex-column justify-content-around">
                                                        <small class="mb-1 text-muted font-weight-bold">Kriteria Penilaian</small>
                                                        <h5 class="mr-2 mb-0"><?= mysqli_num_rows($queryKriteria) ?> Data</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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