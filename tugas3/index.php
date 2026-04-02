<?php
$mahasiswa = [
    [
        "nama" => "Adit Vertikal",
        "nim" => "20231001",
        "tugas" => 82,
        "uts" => 75,
        "uas" => 88
    ],
    [
        "nama" => "Hendwi mbg",
        "nim" => "20231002",
        "tugas" => 90,
        "uts" => 80,
        "uas" => 85
    ],
    [
        "nama" => "Azka Knalpot",
        "nim" => "20231003",
        "tugas" => 50,
        "uts" => 65,
        "uas" => 62
    ],
    [
        "nama" => "Pandia Roda",
        "nim" => "20231004",
        "tugas" => 40,
        "uts" => 55,
        "uas" => 50
    ],
    [
        "nama" => "Wildan Ban",
        "nim" => "20231005",
        "tugas" => 40,
        "uts" => 55,
        "uas" => 40
    ],
    [
        "nama" => "Panji Treding",
        "nim" => "20231006",
        "tugas" => 70,
        "uts" => 80,
        "uas" => 90
    ],
];


function hitungNilaiAkhir($tugas, $uts, $uas)
{
    return ($tugas * 0.2) + ($uts * 0.4) + ($uas * 0.4);
}

function tentukanGrade($nilaiAkhir)
{
    if ($nilaiAkhir > 85) {
        return "A";
    } elseif ($nilaiAkhir > 75) {
        return "AB";
    } elseif ($nilaiAkhir > 65) {
        return "B";
    } elseif ($nilaiAkhir > 60) {
        return "BC";
    } elseif ($nilaiAkhir > 50) {
        return "C";
    } elseif ($nilaiAkhir > 40) {
        return "D";
    } else {
        return "E";
    }
}


function statusKelulusan($grade)
{
    $hasil = ($grade !== "E" && $grade !== "D") ? "Lulus" : "Tidak Lulus";
    return $hasil;
}


$totalNilai = 0;
$nilaiTertinggi = null;
foreach ($mahasiswa as $index => $mhs) {
    $nilaiAkhir = hitungNilaiAkhir($mhs["tugas"], $mhs["uts"], $mhs["uas"]);
    $grade = tentukanGrade($nilaiAkhir);
    $status = statusKelulusan($grade);

    $mahasiswa[$index]["nilaiAkhir"] = round($nilaiAkhir, 2);
    $mahasiswa[$index]["grade"] = $grade;
    $mahasiswa[$index]["status"] = $status;

    $totalNilai += $nilaiAkhir;
    if ($nilaiTertinggi === null || $nilaiAkhir > $nilaiTertinggi) {
        $nilaiTertinggi = $nilaiAkhir;
    }
}

$rataRata = round($totalNilai / count($mahasiswa), 2);
$nilaiTertinggi = round($nilaiTertinggi, 2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar Mahasiswa</title>
    <style>
        body {
            /* margin: 20px; */
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            text-align: center;
        }

        table {
            margin-left: auto;
            margin-right: auto;
            border-collapse: collapse;
            width: 100%;
            max-width: 900px;
        }

        th,
        td {
            border: 1px solid #444;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #1089ff;
            color: white;
        }
        .foot {
            margin-top: 20px;
            text-align: center;
        }
        li {
            list-style-type: none;
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <h2>Data Mahasiswa</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Tugas</th>
                <th>UTS</th>
                <th>UAS</th>
                <th>Nilai Akhir</th>
                <th>Grade</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mahasiswa as $i => $mhs) : ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= $mhs["nama"] ?></td>
                    <td><?= $mhs["nim"] ?></td>
                    <td><?= $mhs["tugas"] ?></td>
                    <td><?= $mhs["uts"] ?></td>
                    <td><?= $mhs["uas"] ?></td>
                    <td><?= $mhs["nilaiAkhir"] ?></td>
                    <td><?= $mhs["grade"] ?></td>
                    <td><?= $mhs["status"] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="foot">
        <h3>Statistik Kelas Ringkasan Nilai Mahasiswa</h3>
        <ul>
            <li>Rata-rata kelas: <?= $rataRata ?></li>
            <li>Nilai tertinggi: <?= $nilaiTertinggi ?></li>
        </ul>
    </div>
</body>

</html>