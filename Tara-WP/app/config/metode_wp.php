<?php

class WP extends CRUD
{
    public function Indikator($nilai)
    {
        # code...
        if ($nilai == 5) {
            # code...
            $ket = "Sangat Bagus";
        } elseif ($nilai == 4) {
            # code...
            $ket = "Bagus";
        } elseif ($nilai == 3) {
            # code...
            $ket = "Cukup Bagus";
        } elseif ($nilai == 2) {
            # code...
            $ket = "Kurang Bagus";
        } elseif ($nilai == 1) {
            # code...
            $ket = "Tidak Bagus";
        } else {
            # code...
            $ket = "-";
        }

        return $ket;
    }

    public function VektorS_Kometensi($id_guru, $kode_kompetensi, $semester, $periode): float|int
    {
        # code...
        $queryKriteria = $this->read(
            "kriteria",
            "WHERE kode_kompetensi = '$kode_kompetensi'
             ORDER BY LENGTH(kode_kriteria) ASC"
        );

        $queryNilai = $this->read(
            "penilaian",
            "WHERE id_pengguna = '$id_guru' AND kode_kompetensi = '$kode_kompetensi' AND semester = '$semester' AND periode = '$periode'
             ORDER BY LENGTH(kode_kriteria) ASC"
        );

        foreach ($queryKriteria as $row) {
            # code...
            $nilai_bobot[] = $row['bobot_kriteria'];
        }

        $i = 0;
        $nilai_guru = [];
        foreach ($queryNilai as $row) {
            # code...
            $nilai_guru[] = pow($row['nilai'], ($nilai_bobot[$i] / array_sum($nilai_bobot)));
            $i++;
        }

        if ($nilai_guru == NULL) {
            # code...
            $result = 0;
        } else {
            # code...
            $result = Fungsi::perkalianArray($nilai_guru);
        }

        return $result;
    }

    public function VektorV_Kompetensi($id_guru, $semester, $periode)
    {
        # code...
        $queryKompetensi = $this->read(
            "kompetensi",
            "ORDER BY LENGTH(kode_kompetensi) ASC"
        );

        $jumlah_kompetensi = mysqli_num_rows($queryKompetensi);

        foreach ($queryKompetensi as $row) {
            # code...
            $nilai_guru[] = $this->VektorS_Kometensi($id_guru, $row['kode_kompetensi'], $semester, $periode);
        }

        $result = array_sum($nilai_guru) / $jumlah_kompetensi;

        return $result;
    }

    public function VektorS($id_guru, $semester, $periode)
    {
        # code...
        $queryKriteria = $this->read(
            "kriteria",
            "ORDER BY LENGTH(kode_kriteria) ASC"
        );

        $queryNilai = $this->read(
            "penilaian",
            "WHERE id_pengguna = '$id_guru' AND semester = '$semester' AND periode = '$periode'
             ORDER BY LENGTH(kode_kriteria) ASC"
        );

        foreach ($queryKriteria as $row) {
            # code...
            $nilai_bobot[] = $row['bobot_kriteria'];
        }

        $i = 0;
        foreach ($queryNilai as $row) {
            # code...
            $nilai_guru[] = pow($row['nilai'], $nilai_bobot[$i] / array_sum($nilai_bobot));
            $i++;
        }

        $result = Fungsi::perkalianArray($nilai_guru);

        return $result;
    }

    public function VektorV($id_guru, $semester, $periode)
    {
        # code...
        $vektorS = $this->VektorS($id_guru, $semester, $periode);

        $queryGuru = $this->readGroup(
            "penilaian",
            "id_pengguna",
            "GROUP BY id_pengguna
             ORDER BY id_pengguna ASC"
        );

        foreach ($queryGuru as $row) {
            # code...
            $nilai_guru[] = $this->VektorS($row['id_pengguna'], $semester, $periode);
        }

        $result = $vektorS / array_sum($nilai_guru);

        return $result;
    }

    public function Keputusan($total_nilai)
    {
        # code...
        if ($total_nilai >= 5) {
            # code...
            $ket = "Sangat Bagus";
        } elseif ($total_nilai >= 4 and $total_nilai < 5) {
            # code...
            $ket = "Bagus";
        } elseif ($total_nilai >= 3 and $total_nilai < 4) {
            # code...
            $ket = "Cukup Bagus";
        } elseif ($total_nilai >= 2 and $total_nilai < 3) {
            # code...
            $ket = "Kurang Bagus";
        } elseif ($total_nilai < 2) {
            # code...
            $ket = "Tidak Bagus";
        } else {
            # code...
            $ket = "-";
        }

        return $ket;
    }
}
