require_once 'conn.php';
// Koneksi ke database (menggunakan variabel $con dari conn.php)
$conn = $con;

// Cek koneksi
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
                    <div class="col-sm-12" id="print-area">
                        <div class="card-body">

                            <?php
                            // Mengurutkan berdasarkan skor akhir
                            usort($subnilai, function ($a, $b) {
                                return $b['skor'] <=> $a['skor'];
                            });
                            ?>

                            <div class="col-sm-12 shadow p-3">
                                <div class="d-flex justify-content-between mb-3 text-center">
                                    <h8 class="card-title text-center fw-bolder mt-2">Head Office : PT. TIKI Jalur
                                        Nugraha Ekakurir
                                        JNE Express Padang Cabang Nipah beramalat di JL.Nipah
                                        No.42C.
                                        Berok Nipah, Kec. Padang Barat, Kota Padang, Sumatra Barat.
                                        Hasil Perankingan Karyawan Terbaik Pada JNE
                                        Cabang Padang Menggunakan Metode SMART
                                    </h8>
                                    <a href="cetak.php" target="_blank" class="btn btn-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                                            <path
                                                d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                                        </svg>
                                        Cetak
                                    </a>
                                </div>
                                <table class="table table-responsive text-center table-bordered">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Skor Akhir</th>
                                        <th>Peringkat</th>
                                    </tr>
                                    <?php $peringkat = 1; ?>
                                    <?php foreach ($subnilai as $nilai): ?>
                                    <tr>
                                        <td><?php echo $nilai['nama']; ?></td>
                                        <td><?php echo round($nilai['skor'], 5); ?></td>
                                        <td><?php echo $peringkat++; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'layout/footer.php' ?>