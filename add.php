<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);

    $photo = $_FILES["photo"]["name"];
    $sql = "INSERT INTO items (name, description, price, photo) VALUES ('$name', '$description', '$price', '$photo')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Tambah Barang</title>
</head>
<body>
<div class="container">
    <h1>Tambah Barang</h1>
    <form method="POST" enctype="multipart/form-data">
        <label>Nama:</label>
        <input type="text" name="name" required>
        <label>Deskripsi:</label>
        <textarea name="description" required></textarea>
        <label>Harga:</label>
        <input type="number" step="0.01" name="price" required>
        <label>Foto:</label>
        <input type="file" name="photo" required>
        <button type="submit">Simpan</button>
    </form>
</div>
</body>
</html>
