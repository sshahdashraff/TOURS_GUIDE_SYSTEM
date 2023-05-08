<?php

session_start();


$data1 = file_get_contents('products.json');
$products1 = json_decode($data1, true);




$total_price = 0;


if (!empty($_SESSION['cart'])) {
    $cart_items = array();
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
      
        $product = null;
        foreach ($products as $p) {
            if ($p['id'] == $product_id) {
                $product = $p;
                break;
            }
        }

       
        if ($product) {
            $item_price = $product['price'] * $quantity;
            $total_price += $item_price;
            $cart_items[] = array(
                'id' => $product_id,
                'quantity' => $quantity,
                'total_item_price' => $item_price
            );
        }
    }
}


$user_id = $_SESSION['user_id'];


$order_data = array(
    'total_price' => $total_price,
    'user_id' => $user_id,
    'cart_items' => $cart_items
);


$orders_json = file_get_contents('orders.json');
$orders = json_decode('[' . rtrim($orders_json, "\n") . ']', true);


$orders[] = $order_data;

$orders_json = json_encode($orders);


if (file_put_contents('orders.json', $orders_json)) {
    
    $_SESSION['order_message'] = "Order placed successfully.";
} else {
    
    $_SESSION['order_message'] = "Failed to place order.";
}


unset($_SESSION['cart']);


header('Location: cart.php');
exit;
?>