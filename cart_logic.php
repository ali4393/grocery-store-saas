<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'db.php';

if (isset($_POST['add_to_cart'])) {
   
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);

    n
    $sql = "SELECT * FROM products WHERE id = '$product_id' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);

        $cart_item = [
            'id'       => $product['id'],
            'name'     => $product['name'],
            'price'    => $product['price'],
            'image'    => $product['image'],
            'quantity' => 1
        ];

        
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $found = false;
            
            
            foreach ($_SESSION['cart'] as &$item) {
                if ($item['id'] == $product_id) {
                    $item['quantity'] += 1;
                    $found = true;
                    break;
                }
            }
            unset($item); 

            if (!$found) {
                $_SESSION['cart'][] = $cart_item;
            }
        } else {
            
            $_SESSION['cart'] = array($cart_item);
        }

        
        header("Location: index.php?status=success");
        exit();
    } else {
        
        header("Location: index.php?status=error");
        exit();
    }
} else {
    
    header("Location: index.php");
    exit();
}
?>