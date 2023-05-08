<?php
$trips = [];
$json_file = 'database.json';
if (file_exists($json_file)) {
    $trips = json_decode(file_get_contents($json_file), true);
}
?>
<?php
session_start();
if(!isset($_SESSION['user'])){
    header("location: login.php"); exit;
}
if (isset($_GET['logout'])) {
    unset($_SESSION['user']);
    header("location: login.php"); exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>trips List</title>
    <link rel="stylesheet" href="customer1.css">
</head>
<body>
  <div class="container">
    <h1>trips List</h1>
    <h2>Welcome <?php echo $_SESSION['user']; ?></h2>
    <a class="log" href="?logout">log-out</a>
    <a class="cart" href="http://localhost/itweb2/cart.php">cart</a>
    <table>
        <tr>
            <th>Photo</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
        </tr>
    <?php 
    foreach ($trips as $trip) { 
        echo '<tr>';
            echo '<td>';
               echo '<img src="' .$trip['photo'].'" width="100" height="100">';
            echo '</td>';
            echo '<td>'  .$trip['name']. '</td>';
            echo '<td>' .$trip['price'].'</td>';
            echo '<td>' .$trip['description']. '</td>';
            echo '<td>';  
                echo '<form method="post" action="add_cart_trips.php">'; 
                echo '<label for="quantity">Quantity:</label>'; 
                echo '<input type="number" name="quantity" id="quantity" min="1" value="1">'; 
                echo '<input type="hidden" name="product_id" value="' . $trip['id'] . '">'; 
                echo '<button type="submit" name="add_to_cart">Add to Cart</button>'; 
                echo '</form>'; 
            echo '</td>'; 
        echo '</tr>';
     } ?>
    </table>
    <?php

$data = file_get_contents('database.json');


$trips = json_decode($data, true);


$results = [];


if (isset($_GET['q'])) {
  
  $query = $_GET['q'];

  if (!empty($query)) {
   
    $results = array_filter($trips, function($trip) use ($query) {
      return stripos($trip['name'], $query) !== false;
    });
  } else {
 
    $results = [];
  }
}
?>


<form action="" method="get">
  <label for="search">Search trips:</label>
  <input type="text" name="q" id="search" value="<?php echo isset($_GET['q']) ? $_GET['q'] : ''; ?>">
  <button type="submit">Search</button>
</form>



<?php if (isset($results) && count($results) > 0): ?>
  <h2>Search Results</h2>
  <ul>
    <?php foreach ($results as $trip): ?>
      <li><?php echo $trip['name']; ?></li>
      <li><?php echo $trip['description']; ?></li>
      <li><img src="<?php echo $trip['photo']; ?>" width="100" height="100"></li> 
    <?php endforeach; ?>
  </ul>
<?php else: ?>
  <?php if (isset($_GET['q'])): ?>
    <p>No results found.</p>
  <?php endif; ?>
<?php endif; ?>
</div>