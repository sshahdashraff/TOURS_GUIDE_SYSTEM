<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $id=$_POST['id'];
    $quantity=$_POST['quantity'];
      
  
    $target_dir = 'uploads/';
    $target_file = $target_dir . basename($_FILES['photo']['name']);
    move_uploaded_file($_FILES['photo']['tmp_name'], $target_file);
    $photo_url = basename($_FILES['photo']['name']);


    $trips = [];
    $json_file = 'database.json';
    if (file_exists($json_file)) {
        $trips = json_decode(file_get_contents($json_file), true);
    }

    $new_trip = [
        'name' => $name,
        'price' => $price,
        'description' => $description,
        'photo' => $photo_url, 
        'id'=>$id,
        'quantity'=>$quantity,
    ];
    $trips[] = $new_trip;

    
    file_put_contents($json_file, json_encode($trips), JSON_PRETTY_PRINT);


    header('Location: admin.php');
    exit;
}
?>