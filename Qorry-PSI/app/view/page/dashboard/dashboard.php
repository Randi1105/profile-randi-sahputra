<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Head -->
    <?php include 'app/view/layout/head.php' ?>
    <!-- \Head -->
</head>

<body>
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
                    <!-- Breadcrumb and Stats start -->
                    <div class="d-flex align-items-center mb-3">
                        <!-- Breadcrumb start -->
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <i class="bi bi-house lh-1"></i>
                                <a href="index.html" class="text-decoration-none">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page"><?= $dataPage['page'] ?></li>
                        </ol>
                        <!-- Breadcrumb end -->
                    </div>
                    <!-- Breadcrumb and stats end -->

                    <!-- Row start -->
                    <div class="row gx-3">
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="bg-transparent-light rounded-1 mb-3 position-relative">
                                <div class="p-3 text-white">
                                    <div class="mb-2">
                                        <i class="bi bi-person fs-1 lh-1"></i>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="m-0 fw-normal">Data User</h5>
                                        <h3 class="m-0">1 Data</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="bg-transparent-light rounded-1 mb-3 position-relative">
                                <div class="p-3 text-white">
                                    <div class="mb-2">
                                        <i class="bi bi-people fs-1 lh-1"></i>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="m-0 fw-normal">Data Karyawan</h5>
                                        <h3 class="m-0">30 Data</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="bg-transparent-light rounded-1 mb-3 position-relative">
                                <div class="p-3 text-white">
                                    <div class="mb-2">
                                        <i class="bi bi-bar-chart fs-1 lh-1"></i>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="m-0 fw-normal">Penilaian Karyawan</h5>
                                        <h3 class="m-0">30 Data</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="bg-transparent-light rounded-1 mb-3 position-relative">
                                <div class="p-3 text-white">
                                    <div class="mb-2">
                                        <i class="bi bi-pie-chart fs-1 lh-1"></i>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="m-0 fw-normal">Kriteria Penilaian</h5>
                                        <h3 class="m-0">5 Data</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row end -->
                </div>
                <!-- Panel -->

                <!-- Body -->
                <div class="app-body">
                    <!-- Row start -->
                    <div class="row gx-3">
                        <div class="col-xl-12 col-sm-12 col-12">
                            <div class="card mb-3">
                                <div class="card-body height-230">
                                    <div class="row align-items-end">
                                        <div class="col-sm-8 mb-5">
                                            <h3 class="mb-3">Selamat Datang,</h3>
                                            <p class="mb-5">
                                                Lorem ipsum dolor sit amet consectetur adipisicing
                                                elit. Itaque eos id consequatur fugit at nihil, quam
                                                doloribus quisquam iusto cupiditate ad consectetur
                                                vero, harum accusamus ducimus aliquam perferendis vel
                                                distinctio?
                                            </p>
                                        </div>
                                        <div class="col-sm-4">
                                            <img src=assets/imgs/sales.svg class="congrats-img"
                                                alt="Bootstrap Gallery" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row end -->
                </div>
                <!-- \Body -->

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