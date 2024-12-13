<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konversi Satuan Suhu</title>
</head>
<body>
    <h2>Konversi Satuan Suhu</h2>
    <form method="post">
        <label for="konversi">Konversi:</label>
        <select name="konversi" id="konversi">
            <option value="Reamur" <?php if (isset($_POST['konversi']) && $_POST['konversi'] == 'Reamur') echo 'selected'; ?>>Reamur</option>
            <option value="Fahrenheit" <?php if (isset($_POST['konversi']) && $_POST['konversi'] == 'Fahrenheit') echo 'selected'; ?>>Fahrenheit</option>
        </select>
        <br><br>
        <label for="suhu">Suhu:</label>
        <input type="number" name="suhu" id="suhu" value="<?php if (isset($_POST['suhu'])) echo $_POST['suhu']; ?>">
        <br><br>
        <button type="submit">Hitung</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $konversi = $_POST['konversi'];
        $suhu = isset($_POST['suhu']) ? floatval($_POST['suhu']) : 0;

        $hasil = 0;
        if ($konversi == 'Reamur') {
            // Reamur ke Celcius
            $hasil = ($suhu * 5) / 4;
            echo "<p>Hasil konversi ke Celcius adalah $hasil</p>";
        } elseif ($konversi == 'Fahrenheit') {
            // Fahrenheit ke Celcius
            $hasil = ($suhu - 32) * 5 / 9;
            echo "<p>Hasil konversi ke Celcius adalah $hasil</p>";
        }
    }
    ?>
</body>
</html>