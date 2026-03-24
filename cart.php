<?php 

include 'db.php'; 


if (isset($_GET['action']) && $_GET['action'] == 'clear') {
    if (session_status() === PHP_SESSION_NONE) session_start();
    unset($_SESSION['cart']);
    header("Location: cart.php?msg=cleared");
    exit();
}

if (isset($_GET['remove_id'])) {
    if (session_status() === PHP_SESSION_NONE) session_start();
    $id = $_GET['remove_id'];
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $id) {
            unset($_SESSION['cart'][$key]);
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']); 
    header("Location: cart.php");
    exit();
}

include 'header.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart - The Grocery</title>
    <link rel="stylesheet" href="style/cart.css">

    <script>
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('msg') === 'cleared') {
                alert("Your cart is now empty!");
            }
        };
    </script>
</head>
<body>

    <main class="container">
        <h1>Shopping Cart 🛒</h1>

        <?php if (!empty($_SESSION['cart'])): ?>
            
            <div style="text-align: right; margin-bottom: 20px;">
                <a href="cart.php?action=clear" class="btn-empty" onclick="return confirm('Are you sure you want to empty your cart?')">
                    Empty Cart 🗑️
                </a>
            </div>

            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total = 0;
                    foreach ($_SESSION['cart'] as $item): 
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td>$<?php echo number_format($item['price'], 2); ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>$<?php echo number_format($subtotal, 2); ?></td>
                        <td>
                            <a href="cart.php?remove_id=<?php echo $item['id']; ?>" class="btn-remove">❌ Remove</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="total-section">
                <strong>Total Amount: $<?php echo number_format($total, 2); ?></strong>
            </div>
            
            <div style="text-align:right; margin-top: 30px;">
                <a href="checkout.php" class="btn-buy" style="padding: 15px 40px; border-radius: 8px;">
                    Proceed to Checkout
                </a>
            </div>

        <?php else: ?>
            <div style="text-align: center; padding: 50px;">
                <h2>Your cart is empty.</h2>
                <p>Looks like you haven't added anything yet.</p>
                <br>
                <a href="index.php" class="btn-buy" style="padding: 10px 20px; border-radius: 5px;">Start Shopping</a>
            </div>
        <?php endif; ?>
    </main>

    <footer class="glass-footer">
        <p>&copy; 2026 The Grocery - Quality You Can Trust</p>
    </footer>

</body>
</html>