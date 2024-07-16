<?php
include 'config.php';
$result = $conn->query("SELECT * FROM items");
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Dashboard</title>
</head>
<body>
<div class="container">
    <h1>Barang</h1>
    <button onclick="location.href='add.php'">Tambah Barang</button>
    <table>
        <tr>
            <th>Foto</th>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><img src="uploads/<?php echo $row['photo']; ?>" alt="Foto Barang"></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td>
                <button onclick="location.href='edit.php?id=<?php echo $row['id']; ?>'">Edit</button>
                <button onclick="location.href='delete.php?id=<?php echo $row['id']; ?>'">Hapus</button>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>

<?php $conn->close(); ?>
