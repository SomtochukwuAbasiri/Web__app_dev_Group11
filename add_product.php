<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $quantity = (int)$_POST['quantity'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $stmt = $conn->prepare("UPDATE products SET quantity = quantity + ? WHERE name = ?");
        $stmt->bind_param("is", $quantity, $name);
    } else {
        $stmt = $conn->prepare("INSERT INTO products (name, quantity) VALUES (?, ?)");
        $stmt->bind_param("si", $name, $quantity);
    }

    $stmt->execute();
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">

    <h1> Add or Update Product</h1>

    <form method="post">
        <input type="text" name="name" placeholder="Product Name" required>
        <input type="number" name="quantity" placeholder="Quantity" required min="1">
        <button type="submit"> Submit</button>
    </form>

    <div class="nav-links">
        <a href="index.php" class="btn btn-secondary"> Back to Inventory</a>
    </div>

</div>
</body>
</html>

