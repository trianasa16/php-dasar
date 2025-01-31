<?php

session_start();

if (!isset($_SESSION['login'])) {
    if ($_SESSION['login'] != true) {
        header("Location: login.php");
        exit;
    }
}

$mysqli = new mysqli('localhost', 'root', '', 'tedc');

$result = $mysqli->query("SELECT students.nim, students.nama, study_program.name 
                         FROM students 
                         LEFT JOIN study_program ON students.program_studi = study_program.id;
                         ");

$mahasiswa = [];
while ($row = $result->fetch_assoc()) {
    array_push($mahasiswa, $row);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-3 text-center">Daftar Mahasiswa Politeknik TEDC Bandung</h2>
        <?php
        if (isset($_SESSION['success_message'])) {
            echo "<div class='alert alert-success' role='alert'>{$_SESSION['success_message']}</div>";
            unset($_SESSION['success_message']);
        }

        if (isset($_SESSION['error_message'])) {
            echo "<div class='alert alert-danger' role='alert'>{$_SESSION['error_message']}</div>";
            unset($_SESSION['error_message']);
        }
        ?>
        <a href="tambah.php" class="btn btn-success mb-3">Tambah Mahasiswa</a>
        <table class="table table-hover table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Program Studi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($mahasiswa as $value) { ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $value['nim']; ?></td>
                        <td><?= $value['nama']; ?></td>
                        <td><?= $value['name'] === null ? 'NULL' : $value['name']; ?></td>
                        <td>
                            <a href="edit_mahasiswa.php?nim=<?= $value['nim']; ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Edit</a>
                            <a href="hapus_mahasiswa.php?nim=<?= $value['nim']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                <i class="bi bi-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
unset($_SESSION['success']);
unset($_SESSION['message']);

?>