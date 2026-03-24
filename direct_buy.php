<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


include 'db.php';


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $product_id = mysqli_real_escape_string($conn, $_GET['id']);

    
    unset($_SESSION['cart']);

    n
    $query = "SELECT * FROM products WHERE id = '$product_id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);

        
        $_SESSION['cart'] = array([
            'id'       => $product['id'],
            'name'     => $product['name'],
            'price'    => $product['price'],
            'image'    => $product['image'],
            'quantity' => 1
        ]);

       
        header("Location: checkout.php");
        exit();
    } else {
        
        header("Location: index.php?error=product_not_found");
        exit();
    }
} else {
    
    header("Location: index.php");
    exit();
}
?>