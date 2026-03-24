<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (empty($_SESSION['cart'])) {
    header("Location: index.php");
    exit();
}

$shop_name = "The Grocery";
$tax_rate = 0.05; 

include 'header.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice - <?php echo $shop_name; ?></title>
    <link rel="stylesheet" href="style/checkout.css">
</head>
<body>

    <div class="invoice-box">
        <div class="invoice-header">
            <h1><?php echo $shop_name; ?></h1>
            <p>Freshness Delivered | Customer Receipt</p>
            <p><strong>Date:</strong> <?php echo date("d-M-Y"); ?></p>
        </div>

        <table class="receipt-table">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $subtotal_all = 0;
                foreach ($_SESSION['cart'] as $item): 
                    $item_total = $item['price'] * $item['quantity'];
                    $subtotal_all += $item_total;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>$<?php echo number_format($item['price'], 2); ?></td>
                    <td>$<?php echo number_format($item_total, 2); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php 
            $tax_amount = $subtotal_all * $tax_rate;
            $final_total = $subtotal_all + $tax_amount;
        ?>

        <table class="summary-table">
            <tr>
                <td>Subtotal:</td>
                <td><strong>$<?php echo number_format($subtotal_all, 2); ?></strong></td>
            </tr>
            <tr>
                <td>Tax (5%):</td>
                <td><strong>$<?php echo number_format($tax_amount, 2); ?></strong></td>
            </tr>
            <tr class="total-row">
                <td>Grand Total:</td>
                <td style="color: #2e8b57; font-size: 1.4rem;">
                    $<?php echo number_format($final_total, 2); ?>
                </td>
            </tr>
        </table>

        <div style="margin-top: 30px; text-align: center;">
            <button onclick="window.print()" class="btn-print" style="cursor: pointer; border: none; width: 100%;">
                Print Receipt 🖨️
            </button>
        </div>
        
        <p style="text-align: center; font-size: 0.8rem; color: #777; margin-top: 20px;">
            Thank you for shopping with us!
        </p>
    </div>

</body>
</html>