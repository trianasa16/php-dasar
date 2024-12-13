<?php
// koneksi database
$mysqli = new mysqli('localhost', 'root', '', 'tedc');

// query untuk mengambil data mahasiswa dengan program studi mereka
$result = $mysqli->query(
    "SELECT students.nim, students.nama, study_program.name 
     FROM students 
     INNER JOIN study_program ON students.study_program_id = study_program.id 
     WHERE study_program.id = 11;"
);

// inisialisasi array kosong untuk menyimpan data yang diambil
$mahasiswa = [];

// Ambil data dari hasil queri dan simpan dalam array
while ($row = $result->fetch_assoc()) {
    $mahasiswa[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>

    <!-- Include Bootstrap CSS for styling -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
        crossorigin="anonymous"
    >
</head>
<body>
    <!-- Judul halaman -->
    <h1 class="text-center">Data Mahasiswa KA 2021</h1>

    <div class="container">
        <!-- Tampilan tabel mahasiswa -->
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>NIM</th> 
                    <th>Nama</th> 
                    <th>Program Studi</th>
                </tr>
            </thead>
            <tbody>
                <!-- loop melalui array data mahasiswa dan menampilkan setiap baris -->
                <?php foreach ($mahasiswa as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nim']); ?></td> <!-- students ID -->
                        <td><?= htmlspecialchars($row['nama']); ?></td> <!-- students Name -->
                        <td><?= htmlspecialchars($row['name']); ?></td> <!-- Study Program Name -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>