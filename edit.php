<?php
include 'config.php';

$id = $_GET['id'];
$item = $conn->query("SELECT * FROM items WHERE id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    if (!empty($_FILES["photo"]["name"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);

        $photo = $_FILES["photo"]["name"];
        $sql = "UPDATE items SET name='$name', description='$description', price='$price', photo='$photo' WHERE id=$id";
    } else {
        $sql = "UPDATE items SET name='$name', description='$description', price='$price' WHERE id=$id";
    }

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
    <title>Edit Barang</title>
</head>
<body>
<div class="container">
    <h1>Edit Barang</h1>
    <form method="POST" enctype="multipart/form-data">
        <label>Nama:</label>
        <input type="text" name="name" value="<?php echo $item['name']; ?>" required>
        <label>Deskripsi:</label>
        <textarea name="description" required><?php echo $item['description']; ?></textarea>
        <label>Harga:</label>
        <input type="number" step="0.01" name="price" value="<?php echo $item['price']; ?>" required>
        <label>Foto:</label>
        <input type="file" name="photo">
        <button type="submit">Simpan</button>
    </form>
</div>
</body>
</html>
