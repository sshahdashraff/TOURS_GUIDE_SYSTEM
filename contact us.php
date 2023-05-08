<?php require("contactusscript.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="contact us .css">
    <title>contact form</title>
</head>
<body>
    <form method="post">
        <h2>Contact form :</h2>
        <div class="name-1">
        <label for="m-Name">Name :</label><br>
        <input type="text" id="m-Name" placeholder="Enter your Name" required name="name">
        </div>
        <br>
        <div class="email-1">
        <label for="m-email">E-mail address :</label><br>
        <input type="email" id="m-email" placeholder="E-mail" required name="email">
        </div>
        <br>
        <div class="message-1">
            <label for="m-message">message :</label><br>
            <textarea id="m-message" class="message-2" placeholder="Leave a message" required name="subject"></textarea>
        </div>
        <br>
        <div class="btn">
        <input type="submit" value="Submit" name="submit">
        </div>
        <br>
    </form>
</body>
</html>