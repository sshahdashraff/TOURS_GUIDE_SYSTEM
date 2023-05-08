<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];

   
    $trips = [];
    $json_file = 'database.json';
    if (file_exists($json_file)) {
        $trips = json_decode(file_get_contents($json_file), true);
    }

    
    foreach ($trips as $index => $trip) {
        if ($trip['name'] === $name) {
            unset($trips[$index]);
            break;
        }
    }

  
    file_put_contents($json_file, json_encode($trips));

    header('Location: admin.php');
    exit;
}
?>