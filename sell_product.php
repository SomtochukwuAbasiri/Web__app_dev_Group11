<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $conn->query("UPDATE products SET quantity = quantity - 1 WHERE id = $id AND quantity > 0");
}

header("Location: index.php");
exit;
?>