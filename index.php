<?php
include 'db.php';

$search = isset($_GET['q']) ? $_GET['q'] : '';
$query = "SELECT * FROM products WHERE name LIKE ?";
$stmt = $conn->prepare($query);
$like = "%$search%";
$stmt->bind_param("s", $like);
$stmt->execute();
$results = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inventory</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">

    <h1>Product Inventory</h1>

    <form method="get">
        <input type="text" name="q" placeholder="Search product..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit"> Search</button>
    </form>

    <div class="nav-links">
        <a href="add_product.php" class="btn btn-secondary"> Add Product</a>
        <a href="summary.php" class="btn"> View Summary</a>
    </div>

    <table>
        <tr>
            <th>Product Name</th>
            <th>Stock Quantity</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $results->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td class="stock 
                <?= $row['quantity'] == 0 ? 'low-stock' : ($row['quantity'] <= 5 ? 'medium-stock' : 'high-stock') ?>">
                <?= $row['quantity'] ?>
            </td>
            <td>
                <?php if ($row['quantity'] > 0): ?>
                    <a href="sell_product.php?id=<?= $row['id'] ?>" class="btn">Sell</a>
                <?php else: ?>
                    <a class="btn btn-disabled">Out of Stock</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</div>
</body>
</html>