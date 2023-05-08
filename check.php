<?php

session_start();


$data1 = file_get_contents('products.json');
$trips1 = json_decode($data1, true);


$trips = array_merge($products1);


$total_price = 0;


if (!empty($_SESSION['cart'])) {
    $cart_items = array();
    foreach ($_SESSION['cart'] as $trip_id => $quantity) {
    
        $trip = null;
        foreach ($trips as $t) {
            if ($p['id'] == $trip_id) {
                $trip = $t;
                break;
            }
        }

        
        if ($trip) {
            $item_price = $trip['price'] * $quantity;
            $total_price += $item_price;
            $cart_items[] = array(
                'id' => $trip_id,
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