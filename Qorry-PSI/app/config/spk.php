<?php

class SPK extends CRUD
{
    public function Normalisasi($value, $kriteria)
    {
        $queryNilai = $this->read("nilai", "ORDER BY id_karyawan ASC");

        $nilai = [];
        while ($data = mysqli_fetch_assoc($queryNilai)) {
            $nilai[] = $data[$kriteria['kode_kriteria']];
        }

        if ($kriteria['jenis_kriteria'] == "Benefit") {
            return $value / max($nilai);
        } elseif ($kriteria['jenis_kriteria'] == "Cost") {
            return min($nilai) / $value;
        } else {
            return 0;
        }
    }

    public function SumNormalisasi($kriteria)
    {
        $queryNilai = $this->read("nilai", "ORDER BY id_karyawan ASC");

        $nilai = [];
        while ($data = mysqli_fetch_assoc($queryNilai)) {
            $nilai[] = $this->Normalisasi($data[$kriteria['kode_kriteria']], $kriteria);
        }

        return array_sum($nilai);
    }

    public function Mean($kriteria)
    {
        $ketetapan = 1;
        $jumlahKriteria = 5;

        return ($ketetapan / $jumlahKriteria) * $this->SumNormalisasi($kriteria);
    }

    public function VariasiPreferensi($value, $kriteria)
    {
        return pow($this->Normalisasi($value, $kriteria) - $this->Mean($kriteria), 2);
    }

    public function SumVariasi($kriteria)
    {
        $queryNilai = $this->read("nilai", "ORDER BY id_karyawan ASC");

        $nilai = [];
        while ($data = mysqli_fetch_assoc($queryNilai)) {
            $nilai[] = $this->VariasiPreferensi($data[$kriteria['kode_kriteria']], $kriteria);
        }

        return array_sum($nilai);
    }

    public function Deviasi($kriteria)
    {
        return 1 - $this->SumVariasi($kriteria);
    }

    public function PembobotanKriteria($kriteria)
    {
        $queryKriteria = $this->read("kriteria", "ORDER BY kode_kriteria ASC");
        $deviasi = $this->Deviasi($kriteria);

        $nilai = [];
        while ($data = mysqli_fetch_assoc($queryKriteria)) {
            $nilai[] = $this->Deviasi($data);
        }

        return $deviasi / array_sum($nilai);
    }

    public function PreferensiVektor($data, $bobot)
    {
        $queryKriteria = $this->read("kriteria", "ORDER BY kode_kriteria ASC");
        $result = 0;
        $no = 0;

        while ($row = mysqli_fetch_assoc($queryKriteria)) {
            $result += $this->Normalisasi($data[$row['kode_kriteria']], $row) * $bobot[$no++];
        }

        return $result;
    }

    public function Keputusan($ranking)
    {
        $queryNilai = $this->read("nilai", "ORDER BY id_karyawan ASC");

        if ($ranking <= round(0.1 * mysqli_num_rows($queryNilai))) { // 10% terbaik
            return "Karyawan Terbaik";
        } elseif ($ranking <= round(0.4 * mysqli_num_rows($queryNilai))) { // 40% selanjutnya
            return "Karyawan Baik";
        } else {
            return "Perlu Peningkatan";
        }
    }
}