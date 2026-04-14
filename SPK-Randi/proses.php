require_once 'conn.php';
$conn = $con;

$page = "proses";

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
                                <h5 class="card-title fw-bolder mt-2">Proses Perhitungan Metode SMART</h5>

                            </div>
                            <div class="row p-2">
                                <div class="col-sm-12 shadow p-3 me-3">
                                    <h2>Nilai Maksimum dan Minimum</h2>
                                    <table class="table table-responsive text-center table-bordered">
                                        <tr>
                                            <th>Kriteria</th>
                                            <th>Max</th>
                                            <th>Min</th>
                                        </tr>
                                        <?php foreach (['C1', 'C2', 'C3', 'C4', 'C5'] as $criteria): ?>
                                            <tr>
                                                <td><?php echo $criteria; ?></td>
                                                <td><?php echo $max[$criteria]; ?></td>
                                                <td><?php echo $min[$criteria]; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </div>
                            </div>
                            <div class="row p-2">
                                <div class="col-sm-12 shadow p-3 me-3">
                                    <h2>Nilai Utiliti</h2>
                                    <table class="table table-responsive text-center table-bordered">
                                        <tr>
                                            <th>Nama</th>
                                            <th>C1 Utiliti</th>
                                            <th>C2 Utiliti</th>
                                            <th>C3 Utiliti</th>
                                            <th>C4 Utiliti</th>
                                            <th>C5 Utiliti</th>
                                        </tr>
                                        <?php foreach ($subnilai as $nilai): ?>
                                            <tr>
                                                <td><?php echo $nilai['nama']; ?></td>
                                                <td><?php echo round($nilai['C1_util'], 3); ?></td>
                                                <td><?php echo round($nilai['C2_util'], 3); ?></td>
                                                <td><?php echo round($nilai['C3_util'], 3); ?></td>
                                                <td><?php echo round($nilai['C4_util'], 3); ?></td>
                                                <td><?php echo round($nilai['C5_util'], 3); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </div>
                                <div class="col-sm-12 shadow p-3">
                                    <h2>Skor Akhir</h2>
                                    <table class="table table-responsive text-center table-bordered">
                                        <tr>
                                            <th>Nama</th>
                                            <th>Skor Akhir</th>
                                        </tr>
                                        <?php foreach ($subnilai as $nilai): ?>
                                            <tr>
                                                <td><?php echo $nilai['nama']; ?></td>
                                                <td><?php echo round($nilai['skor'], 5); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </table>

                                    <br>

                                    <?php
                                    // Mengurutkan berdasarkan skor akhir
                                    usort($subnilai, function ($a, $b) {
                                        return $b['skor'] <=> $a['skor'];
                                    });
                                    ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'layout/footer.php' ?>