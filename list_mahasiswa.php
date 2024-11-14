<?php
// array data mahasiswa
$data = [
    [1, "D212111001", "Aliftia Radianti"],
    [2, "D212111002", "Cahya Julianti"],
    [3, "D212111007", "Ikhlas Wandana"],
    [4, "D212111014", "Rizaldy Muhamad Sopyan"],
    [5, "D212111021", "Triana Siti Aryani"],
    [6, "D212111023", "Ajeng Aprilyani"],
    [7, "D212111025", "Aspiya Huwaida"],
    [8, "D212111026", "Aura Maliya"],
    [9, "D212111030", "Muhammad Reza"],
    [10, "D212111032", "Wawan Jefriansyah"]
];

// menampilkan tabel
echo "<table border='1' cellpadding='8' cellspacing='0'>
        <tr><th>No</th><th>NIM</th><th>Nama</th></tr>";

foreach ($data as $row) {
    echo "<tr>
            <td>{$row[0]}</td>
            <td>{$row[1]}</td>
            <td>{$row[2]}</td>
          </tr>";
}
echo "</table>";
?>