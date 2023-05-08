<?php
// Load products from JSON file
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
    <meta charset="UTF-8">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <h1>trips List</h1>
    <h2>Welcome <?php echo $_SESSION['user']; ?></h2>
    <a class="log" href="?logout">log out</a>
    <table border="1">
        <tr>
            <th>Photo</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>id</th>
        </tr>
    <?php foreach ($trips as $trip) { ?>
        <tr>
            <td>
                <img src="<?php echo $trip['photo']; ?>" width="100" height="100">
            </td>
            <td><?php echo $trip['name']; ?></td>
            <td><?php echo $trip['price']; ?></td>
            <td><?php echo $trip['description']; ?></td>
            <td><?php echo $trip['id'];?></td>
            <td>
                <form method="post" action="delete.php">
                    <input type="hidden" name="name" value="<?php echo $trip['name']; ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    <?php } ?>
    </table>
    <form method="post" action="add.php" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <br>
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" required>
        <br>
        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea>
        <br>
        <label for="photo">Photo:</label>
        <input type="file" name="photo" id="photo"required>
        <br>
        <label for="id">id:</label>
        <input type="number" name="id" id="id"required> 
        <br>
        <label for="quantity">quantity:</label>
        <input type="number" name="quantity" id="quantity"required> 
        <br>
        <input type="submit" value="Add trip">
        <br>
        <br>
    </form>
</body>
</html>