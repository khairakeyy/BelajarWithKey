<?php
include 'koneksi.php';

$query = "SELECT * FROM film";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Film</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Daftar Film</h2>
    <table>
        <tr>
            <th>ID Film</th>
            <th>Judul</th>
            <th>Sutradara</th>
            <th>Tahun Rilis</th>
        </tr>
        <?php while ($film = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $film['id_film']; ?></td>
            <td><?= $film['judul']; ?></td>
            <td><?= $film['sutradara']; ?></td>
            <td><?= $film['tahun_rilis']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
