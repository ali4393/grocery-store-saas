<?php 
)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


include 'db.php'; 


$search = "";
if(isset($_GET['search'])){
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $query = "SELECT * FROM products WHERE name LIKE '%$search%'";
} else {
    $query = "SELECT * FROM products";
}
$result = mysqli_query($conn, $query);


include 'header.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Grocery - Fresh Items</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>

    <section class="search-section">
        <h1>Freshness Delivered to Your Door</h1>
        <form action="index.php" method="GET">
            <input type="text" name="search" placeholder="Search groceries..." value="<?php echo htmlspecialchars($search); ?>">
        </form>
    </section>

    <main class="container">
        <div class="product-grid">
            <?php 
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) { 
            ?>
                <div class="product-card">
                    <img src="assets/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                    <h3><?php echo $row['name']; ?></h3>
                    <p class="price">$<?php echo number_format($row['price'], 2); ?> / kg</p>
                    
                    <div class="actions">
                        <form action="cart_logic.php" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="add_to_cart" class="btn-cart">Add to Cart</button>
                        </form>
                        <a href="direct_buy.php?id=<?php echo $row['id']; ?>" class="btn-buy">Buy Now</a>
                    </div>
                </div>
            <?php 
                } 
            } else {
                echo "<p class='no-products'>No items found matching your search.</p>";
            }
            ?>
        </div>
    </main>

    <footer class="glass-footer">
        <p>&copy; 2026 The Grocery - Quality You Can Trust</p>
    </footer>

</body>
</html>
