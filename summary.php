<?php
include 'db.php';
$result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Summary</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">

    <h1> Product Summary</h1>

    <ul>
        <?php while ($row = $result->fetch_assoc()): ?>
            <li>
                <strong><?= htmlspecialchars($row['name']) ?></strong>
                — 
                <span class="<?= $row['quantity'] == 0 ? 'low-stock' : ($row['quantity'] <= 5 ? 'medium-stock' : 'high-stock') ?>">
                    <?= $row['quantity'] ?> in stock
                </span>
            </li>
        <?php endwhile; ?>
    </ul>

    <div class="nav-links">
        <a href="index.php" class="btn btn-secondary"> Back to Inventory</a>
    </div>

</div>
</body>
</html>