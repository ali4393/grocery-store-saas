<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$cart_count = 0;
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cart_count += $item['quantity'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>

<header class="navbar">
    <div class="logo">The Grocery</div>

    <div class="nav-links">
        <a href="index.php">Home</a>
        
        <a href="cart.php" class="cart-btn">
            Cart 🛒 
            <?php if($cart_count > 0): ?>
                <span class="badge"><?php echo $cart_count; ?></span>
            <?php endif; ?>
        </a>

        <a href="support.php">Support</a>
    </div>
</header>

<?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
    <div class="alert-success-popup">
        ✅ Item successfully added to your cart!
    </div>
<?php endif; ?>