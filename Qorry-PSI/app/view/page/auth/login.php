<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Head -->
    <?php include 'app/view/layout/head.php' ?>
    <!-- \Head -->
</head>

<body>
    <!-- Controller -->
    <?php include 'app/controller/auth/login.php' ?>
    <!-- \Controller -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-sm-8 col-12">
                <form method="post" class="my-5 needs-validation" novalidate>
                    <div class="login-form rounded-4 p-4 mt-5 shadow-lg">
                        <h2 class="fw-light mb-4 fw-bolder text-uppercase text-center"><?= $dataProject['project'] ?></h2>
                        <div class="mb-3">
                            <label class="form-label" for="yEmail">Username</label>
                            <input type="text" id="yEmail" class="form-control border-0" placeholder="Masukan Username" required name="username">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="pwd">Password</label>
                            <input type="password" id="pwd" class="form-control border-0" placeholder="Masukan Password" required name="password">
                        </div>
                        <div class="d-grid py-3 mt-3">
                            <button type="submit" class="btn btn-lg btn-primary fw-bolder" name="login">
                                LOGIN
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script -->
    <?php include 'app/view/layout/script.php' ?>
    <!-- \Script -->
</body>

</html>