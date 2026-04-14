<!DOCTYPE html>
<html>
<head>
    <title>Perhitungan SMART</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

<h1>Perhitungan SMART</h1>

<?php
require_once 'conn.php';
$conn = $con;

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Ambil data subnilai
$sql = "SELECT * FROM subnilai";
$result = $conn->query($sql);
$subnilai = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
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

<h2>Nilai Maksimum dan Minimum</h2>
<table>
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

<br>

<?php
// Menghitung nilai utiliti
foreach ($subnilai as $key => $nilai) {
    foreach (['C1', 'C2', 'C3', 'C4', 'C5'] as $criteria) {
        if (in_array($criteria, ['C1', 'C4', 'C5'])) { // Benefit
            $subnilai[$key][$criteria . '_util'] = ($nilai[$criteria] - $min[$criteria]) / ($max[$criteria] - $min[$criteria]);
        } else { // Cost
            $subnilai[$key][$criteria . '_util'] = ($max[$criteria] - $nilai[$criteria]) / ($max[$criteria] - $min[$criteria]);
        }
    }
}
?>

<h2>Nilai Utiliti</h2>
<table>
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
        <td><?php echo $nilai['C1_util']; ?></td>
        <td><?php echo $nilai['C2_util']; ?></td>
        <td><?php echo $nilai['C3_util']; ?></td>
        <td><?php echo $nilai['C4_util']; ?></td>
        <td><?php echo $nilai['C5_util']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<br>

<?php
// Menghitung skor akhir
foreach ($subnilai as $key => $nilai) {
    $subnilai[$key]['skor'] = 0;
    foreach (['C1', 'C2', 'C3', 'C4', 'C5'] as $criteria) {
        $subnilai[$key]['skor'] += $nilai[$criteria . '_util'] * $bobot[$criteria];
    }
}
?>

<h2>Skor Akhir</h2>
<table>
    <tr>
        <th>Nama</th>
        <th>Skor Akhir</th>
    </tr>
    <?php foreach ($subnilai as $nilai): ?>
    <tr>
        <td><?php echo $nilai['nama']; ?></td>
        <td><?php echo $nilai['skor']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<br>

<?php
// Mengurutkan berdasarkan skor akhir
usort($subnilai, function($a, $b) {
    return $b['skor'] <=> $a['skor'];
});
?>

<h2>Peringkat Akhir</h2>
<table>
    <tr>
        <th>Nama</th>
        <th>Skor Akhir</th>
        <th>Peringkat</th>
    </tr>
    <?php $peringkat = 1; ?>
    <?php foreach ($subnilai as $nilai): ?>
    <tr>
        <td><?php echo $nilai['nama']; ?></td>
        <td><?php echo $nilai['skor']; ?></td>
        <td><?php echo $peringkat++; ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<?php $conn->close(); ?>

</body>
</html>
