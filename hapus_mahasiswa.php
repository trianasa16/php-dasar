<?php

session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
        header("Location: login.php");
        exit;
    }

$mysqli = new mysqli('localhost', 'root', '', 'tedc');

if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];

    $stmt = $mysqli->prepare("DELETE FROM students WHERE nim = ?");
    $stmt->bind_param('s', $nim);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = 'Data berhasil dihapus!';
        header('Location: mahasiswa.php');
        exit();
    } else {
        $_SESSION['error_message'] = 'Data tidak bisa dihapus: ' . $stmt->error;
    }

    $stmt->close();
} else {
    echo "<script>alert('NIM tidak ditemukan!'); window.location.href='mahasiswa.php';</script>";
}
?>