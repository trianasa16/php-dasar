<?php

session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
        header("Location: login.php");
        exit;
    }

$mysqli = new mysqli('localhost', 'root', '', 'tedc');

if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];
    $result = $mysqli->query("SELECT * FROM students WHERE nim = '$nim'");
    $mahasiswa = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nama = $_POST['nama'];
        $program_studi = $_POST['program_studi'];

        $stmt = $mysqli->prepare("UPDATE students SET nama = ?, program_studi = ? WHERE nim = ?");
        $stmt->bind_param('sss', $nama, $program_studi, $nim);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = 'Data berhasil diedit!';
            header('Location: mahasiswa.php');
            exit();
        } else {
            $_SESSION['error_message'] = 'Data tidak bisa diedit: ' . $stmt->error;
        }

        $stmt->close();
    }

    $study_program = $mysqli->query("SELECT * FROM study_program");
} else {
    echo "<script>alert('NIM tidak ditemukan!'); window.location.href='mahasiswa.php';</script>";
    exit;
}

$query_study_program = "SELECT * FROM study_program";
$result_study_program = $mysqli->query($query_study_program);

if (!$result_study_program) {
    die("Query gagal: " . mysqli_error($conn));
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-3" align="center">Edit Mahasiswa</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" value="<?= $mahasiswa['nim']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $mahasiswa['nama']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="program_studi" class="form-label">Program Studi</label>
                <select class="form-select" id="program_studi" name="program_studi" required>
                    <option value="">Pilih Program Studi</option>
                    <?php while ($row = $study_program->fetch_assoc()) { ?>
                        <option value="<?= $row['id']; ?>" <?= isset ($mahasiswa['program_studi']) && $mahasiswa['program_studi'] == $row['id'] ? 'selected' : ''; ?>>
                            <?= $row['name']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="mahasiswa.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

