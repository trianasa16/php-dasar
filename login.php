<?php
    session_start();

    if (isset($_COOKIE['remember'])) {
        if($_COOKIE['remember'] == 'true') {
            $_SESSION['login'] = true;
        }
    }

    if (isset($_SESSION['login'])) {
        if ($_SESSION['login'] == true) {
            header("Location: mahasiswa.php");
            exit;
        }
    }

    $email = 'trianasiti03@gmail.com';
    $password = 'trianasa16';

    if (isset($_POST['email']) && isset($_POST['password'])) {
        if ($_POST['email'] != $email) {
            echo "email yang dimasukan tidak terdaftar";
            exit;
        }
        if ($_POST['password'] != $password) {
            echo "password yang dimasukan salah";
            exit;
        }
        if ($_POST['email'] == $email && $_POST['password'] == $password) {
            if (isset($_POST['remember'])) {
                setcookie('remember', 'true', time() + 20);
            }

            $_SESSION['login'] = true;
            header("Location: mahasiswa.php");
            exit;    
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #fbc2eb, #a6c1ee);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            border-radius: 15px;
        }
        h1 {
            color: #333;
        }
        .btn-primary {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-5 bg-light">
                    <h1 class="text-center mb-4">LOGIN</h1>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember">
                            <label class="form-check-label" for="exampleCheck1">Simpan password</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
