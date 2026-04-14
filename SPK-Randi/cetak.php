<?php
require_once 'conn.php';
// Koneksi ke database
require_once 'conn.php';
$conn = $con;

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Ambil data subnilai
$sql = "SELECT * FROM penilaian INNER JOIN karyawan ON karyawan.idkaryawan = penilaian.idkaryawan ORDER BY penilaian.idkaryawan ASC";
$result = $conn->query($sql);
$subnilai = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $subnilai[] = $row;
    }
}

// Ambil data bobot
$sql = "SELECT * FROM bobot";
$result = $conn->query($sql);
$bobot = $result->fetch_assoc();

// Menentukan nilai maksimum dan minimum untuk setiap kriteria
$max = ['C1' => 0, 'C2' => PHP_INT_MIN, 'C3' => PHP_INT_MIN, 'C4' => 0, 'C5' => 0];
$min = ['C1' => PHP_INT_MAX, 'C2' => PHP_INT_MAX, 'C3' => PHP_INT_MAX, 'C4' => PHP_INT_MAX, 'C5' => PHP_INT_MAX];

foreach ($subnilai as $nilai) {
    foreach (['C1', 'C2', 'C3', 'C4', 'C5'] as $criteria) {
        if ($nilai[$criteria] > $max[$criteria]) {
            $max[$criteria] = $nilai[$criteria];
        }
        if ($nilai[$criteria] < $min[$criteria]) {
            $min[$criteria] = $nilai[$criteria];
        }
    }
}
?>

<?php
// Menghitung nilai utiliti
foreach ($subnilai as $key => $nilai) {
    foreach (['C1', 'C2', 'C3', 'C4', 'C5'] as $criteria) {
        $subnilai[$key][$criteria . '_util'] = ($nilai[$criteria] - $min[$criteria]) / ($max[$criteria] - $min[$criteria]);
    }
}
?>

<?php
// Menghitung skor akhir
foreach ($subnilai as $key => $nilai) {
    $subnilai[$key]['skor'] = 0;
    foreach (['C1', 'C2', 'C3', 'C4', 'C5'] as $criteria) {
        $subnilai[$key]['skor'] += $nilai[$criteria . '_util'] * $bobot[$criteria];
    }
}

usort($subnilai, function ($a, $b) {
    return $b['skor'] <=> $a['skor'];
});
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/JNE logo SM.png" />
    <title>JNE Express</title>
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="assets/vendor/libs/apex-charts/apex-charts.css" />
</head>

<body style="font-family: 'Times New Roman', Times, serif !important; background-color: #fff !important; ">
    <img src="assets/img/logo.png" class="mx-auto d-block" width="200" height="100" alt="">
    <h5 class="text-center text-uppercase mt-5">Head Office : PT. HONDA AMANAH MOTOR beralamat di JL.Raya Padang
        Pariaman Simpang 3 Jam Pungguang Kasiak.
        Hasil Perankingan Karyawan Terbaik Pada PT.Honda Amanah Motor Menggunakan Metode PSI
    </h5>
    <div class="container-fluid">

        <div class="row justify-content-center text-center">
            <div class="col-12">
                <table class="table table-bordered mt-4">
                    <thead>
                        <th>Ranking</th>
                        <th>Nama</th>
                        <th>Total Nilai</th>
                    </thead>
                    <tbody>
                        <?php foreach ($subnilai as $nilai): $no++ ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?php echo $nilai['nama']; ?></td>
                            <td><?php echo round($nilai['skor'], 5); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <hr>
            <div class="col-12 mt-3" style="text-align: left;">
                <h3>Kesimpulan</h3>
                <p>
                    Berdasarkan hasil perhitungan metode SMART dapat disimpulkan bahwa karyawan dengan nama
                    <b><?= $subnilai[0]['nama'] ?></b> mendapati keputusan yang dimana karyawan tersebut menjadi
                    karyawan terbaik pada JNE Express Padang Cabang Nipah dengan total nilai
                    <b><?= $subnilai[0]['skor'] ?></b>
                </p>
            </div>
        </div>

    </div>
    <script>
    window.print()
    </script>
</body>

</html>