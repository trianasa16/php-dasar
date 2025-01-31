<?php

session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
        header("Location: login.php");
        exit;
    }

$mysqli = new mysqli('localhost', 'root', '', 'tedc');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $program_studi = $_POST['program_studi'];

    $stmt = $mysqli->prepare("INSERT INTO students (nim, nama, program_studi) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $nim, $nama, $program_studi);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = 'Data berhasil ditambahkan!';
        header('Location: mahasiswa.php');
        close();
    } else {
        $_SESSION['error_message'] = 'Data tidak bisa ditambahkan: ' . $stmt->error;
    }


    $stmt->exit();
}

$study_program = $mysqli->query("SELECT * FROM study_program");
if (!$study_program) {
    die("Query error: " . $mysqli->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-3" align="center">Tambah Mahasiswa</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="program_studi" class="form-label">Program Studi</label>
                <select class="form-select" id="program_studi" name="program_studi" required>
                    <option value="">Pilih Program Studi</option>
                    <?php 
                    $study_program = $mysqli->query("SELECT * FROM study_program");
                    if (!$study_program) {
                    die("Query error: " . $mysqli->error);
                    }

    while ($row = $study_program->fetch_assoc()) { ?>
        <option value="<?= $row['id']; ?>">
            <?= $row['name']; ?>
        </option>
    <?php } ?>
</select>
                </select>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="Mahasiswa.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
unset($_SESSION['success']);
?>