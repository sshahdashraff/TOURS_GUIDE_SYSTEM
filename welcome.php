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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="homee.css">
    <title>Welcome</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <header>
            <h2>Welcome <?php echo $_SESSION['user']; ?></h2>
            <a class="Logo" href="welcome.html">home</a>
        <nav class="navigation">
            <a href="http://localhost/itweb/contact%20us.php" target="_blank" title="click to send complaint">contact us</a>
            <a href="?logout" title="click to log-out">log out</a>
        </nav>
    </header>

    <section class="main">
        <div>
            <h1>To Go Tours ,welcome.</h1>
            <h3>We offer trips with the best quality <br>
                to our dear clients.
            </h3>
            <a href="#trips" class="main-btn" title="click to see trips">veiw trips</a><br>
            <a href="customar.php" class="sec-btn" title="click to book trip">booking</a>
        </div class="page">
    </section>
    <section class="cards" id="trips">
        <h2 class="title">trips</h2>
        <div class="content">
            <div class="card">
                <div class="info">
                    <h3>Sharm El-sheikh</h3>
                    <a href="Sharm El-sheikh.html" target="_blank" title="Sharm El-sheikh trips">
                    <img src="./imagess/Sharm El-sheikh.jpeg" alt="Sharm El-sheikh">
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="info">
                    <h3>Aswan</h3>
                    <a href="Aswan.html" target="_blank" title="Aswan trips">
                    <img src="./imagess/Aswan.jpg" alt="Aswan">
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="info">
                    <h3>Noarthcoast</h3>
                    <a href="noarthcoast.html" target="_blank" title="Noarthcoast trips">
                    <img src="./imagess/Sahel.jpeg" alt="Sahel">
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="info">
                    <h3>Siwa</h3>
                    <a href="Siwa.html" target="_blank" title="Siwa trips">
                    <img src="./imagess/Siwa.jpeg" alt="Siwa">
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="info">
                    <h3>Dahab</h3>
                    <a href="Dahab.html" target="_blank" title="Dahab trips">
                    <img src="./imagess/Dahab.jpeg" alt="Dahab">
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="info">
                    <h3>Saint catherine</h3>
                    <a href="saint-catherine.html" target="_blank" title="saint-catherine">
                    <img src="./imagess\saint catherine.jpg" alt="Hurghada">
                    </a>
                </div>
            </div>
        </div>
    </section>

</body>
</html>