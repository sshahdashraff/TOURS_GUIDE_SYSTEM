<?php
require_once('register.class.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = trim($_POST["username"]);
  $email = trim($_POST["email"]);
  $id = trim($_POST["id"]);
  $phonenumber = trim($_POST["phonenumber"]);
  $password = trim($_POST["password"]);
  $confirm_password = trim($_POST['confirm_password']);
  $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
  $terms_agreed = isset($_POST['terms_agreed']) ? true : false;

  $register = new Registeruser($username, $email, $id, $phonenumber, $password, $confirm_password, $gender, $terms_agreed);

  if (!empty($register->error)) {
    echo "<div class=amr>" . $register->error . "</div>";
  } else {
    echo "<div style='color:green'>" . $register->success . "</div>";
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Registration form</title>
    <link rel="stylesheet" href="register3.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="container">
        <div class="title">Registration</div>
        <form action="#" method="post">
            <div class="User-details">
                <div class="input-box">
                    <span class="details">Username</span>
                    <input type="text" placeholder="Enter Your Username" required name="username">
                </div>
                <div class="input-box">
                    <span class="details">Email</span>
                    <input type="email" placeholder="Enter Your Email " required name="email">
                </div>
                <div class="input-box">
                    <span class="details">ID</span>
                    <input type="text" placeholder="Enter Your ID" required name="id">
                </div>
                <div class="input-box">
                    <span class="details">Phonenumber</span>
                    <input type="tel" placeholder="Enter Your Phonenumber " required name="phonenumber">
                </div>
                <div class="input-box">
                    <span class="details">Password</span>
                    <input type="password" minlength="8" placeholder="Enter Your Password " required name="password" pattern="(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[~!@#$%^&*(_=)\|/*-+'?:]).{8,}">
                </div>
                <div class="input-box">
                    <span class="details">Confirm Password</span>
                    <input type="password" minlength="8" placeholder="Confirm Your Password " required name="confirm_password" pattern="(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[~!@#$%^&*(_=)\|/*-+'?:]).{8,}">
                </div>
            </div>

            <div class="gender-details">
                <input type="radio" name="gender" id="dot-1" value="Male">
                <input type="radio" name="gender" id="dot-2" value="Female">
                
                <span class="gender-title"> Gender</span>
                <div class="category">
                    <label for="dot-1">
                        <span class="dot one"></span>
                        <span class="gender">Male</span>
                    </label>
                    <label for="dot-2">
                        <span class="dot two"></span>
                        <span class="gender">Female</span>
                    </label>
                    
                </div>
                <div class="check">
                    <input type="checkbox" name="terms_agreed" required> I agree to all the terms and conditions
                </div>
            </div>
            <div class="button">
                <input type="submit" value="Register" name="submit" onclick="return confirmpassword(password.password2)" title="sign_up">
            </div>
            <p class="error"><?php echo @$user->error?></p>
            <p class="succes"><?php echo @$user->succes?></p>
        </form>
        <p class="acc">Have an account ? <a class="log_btn" href="login.php" target="_blank" title="click to login">Login</a></p>
    </div>
    <script> 
    function confirmpassword(input){ 
            var password = document.getElementById("password").value; 
            var confirmpassword = document.getElementById("password2").value; 
            if (confirmpassword != password){ 
                alert("Password didn't match"); 
                return false; 
            } 
            else{ 
                 return true; 
             } 
 
        }
</script>
</body>
</html>