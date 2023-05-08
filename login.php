<?php require("login.class.php"); ?>
<?php 
if(isset($_POST['submit'])){
    $user = new LoginUser($_POST['email'], $_POST['password']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
<link rel="stylesheet" href="Login1.css">
<title>login page</title>
</head>
<body>
<form method="post" >
    <h2>login form </h2>
    <div class="mail">
    <label for="m-email">E-mail :</label><br>
    <input type="email" id="m-email" placeholder="Enter your E-mail " required name="email">
    </div>
    <br>
    <div class="pass">
    <label for="m-password">Password :</label><br>
    <input type="password" id="m-password" placeholder="Enter your Password" required name="password">
    </div>
    <br>
    <div class="btn">
    <input type="submit" name="submit" value="Submit">
    </div>
    <p class="acc">Do not Have an account ? </p>
    <a class="log_btn" href="Register.php" target="_blank" title="click to Sign-up">Sign up</a>
    <br>
    <br>
    <p class="error"><?php echo isset($user) ? $user->error : "";?></p>
    <p class="success"><?php echo isset($user) ? $user->success : "";?></p>
</form>
</body>
</html>
