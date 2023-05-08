<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="cart.css">
</head>
<body>
    <section id="bloghome" class="mt5">
        <h2 class="shopping cart">Shopping Cart</h2>
        <a href="customar.php" class="logo">Back</a>
        <hr>
    </section>
    
    <section id="cart-container" class="container">
        <table width="100%">
            <thead>
                <tr class="dddd">
                    <td>Remove</td>
                    <td>Image</td>
                    <td>ID</td>
                    <td>Trip Name</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
            </thead>

            <tbody>
            <?php
            
            session_start();

           
            $total_price = 0;

         
            if (!empty($_SESSION['cart'])) {
                
                $data = file_get_contents('database.json');
                $products = json_decode($data, true);

               
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

                        echo '<tr>';
                        echo '<td><a class="remove" href="remove_cart_trip.php?product_id=' . $product['id'] . '">Remove</a></td>';
                        echo '<td><img class="tripname" src="' . $product['photo'] . '" alt="' . $product['name'] . ' "width="100px" height="100px"></td>';
                        echo '<td><h5>' . $product['id'] . '</h5></td>';
                        echo '<td><h5>' . $product['name'] . '</h5></td>';
                        echo '<td><h5>' . $product['price'] . ' L.E</h5></td>';
                        echo '<td>';
                        
                        echo '<form method="post" action="update_cart.php">';
                        echo '<input type="hidden" name="product_id" value="' . $product_id . '">';
                        echo '<input type="number" name="quantity" value="' . $quantity . '">';
                        echo '<button type="submit">Update</button>';
                        echo '</form>';
                        echo '</td>';
                        echo '<td><h5>' . $item_price . ' L.E</h5></td>';
                        echo '</tr>';
                    }
                }
            } else {
           
                echo '<tr><td colspan="7">Your cart is empty.</td></tr>';
            }
            ?>

            </tbody>
        </table>
    </section>
    <?php
        
        if (isset($_SESSION['order_message'])) {
            echo '<p>' . $_SESSION['order_message'] . '</p>';
            unset($_SESSION['order_message']);
        }
    ?>
    <section>
        <div class="box"></div>
        <div class="cart-total">
            <div>
                <h5>CART TOTAL</h5>
            </div>
            <div class="cart-total">
                <h6>Total</h6>
                <p><?php echo $total_price; ?> L.E</p>
            </div>
            <div>
                <h6>User Id</h6>
                <p><?php echo $_SESSION['user_id']; ?></p>
            </div>
            <div>
                <a class="checkout" href="checkout.php">Checkout</a>
            </div>
        </div>
    </section>
</body>
</html>