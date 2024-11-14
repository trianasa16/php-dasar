<?php
        // Data pribadi
        $nama = "Triana Siti";
        $jenis_kelamin = "P";
        $umur = 21;
        $berat = "50 kg";
        $tinggi = "150 cm"; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pribadi</title>
    <style>
        table {
            width: 300px;
            border-collapse: collapse;
            margin: 20px;
        }
        table, th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }
        td {
            width: 10%;
        }
        th {
            width: 2%;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td>Nama</td>
            <th>:</th>
            <td><?php echo $nama; ?></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <th>:</th>
            <td><?php echo $jenis_kelamin;?></td>
        </tr>
        <tr>
            <td>umur</td>
            <th>:</th>
            <td><?php echo $umur; ?></td>
        </tr>
        <tr>
            <td>Berat</td>
            <th>:</th>
            <td><?php echo $berat; ?></td>
        </tr>
        <tr>
            <td>Tinggi</td>
            <th>:</th>
            <td><?php echo $tinggi; ?></td>
        </tr>
    </table>
</body>
</html>