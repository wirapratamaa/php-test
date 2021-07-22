<?php 
    session_start();

    if (!isset($_SESSION['login'])) {
        header("Location: auth/login.php");
    }
    include ('backend/function.php');
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Order Detail</title>
</head>
<body>
    <div class="container">
            <div class="menu">
                <?php menu() ?>
            </div>
        <form action="/backend/search.php" method="POST" class="users-form">
            <p class="users-text">Order history</p>
            <div class="search">
                <div class="input-group">
                    <input type="text" placeholder="Search by Order no. " name="search_order" id="search">
                </div>
            </div>
        </form>
        <div class="order-details" id="order-details">
            <div class="order" id="order">
                <?php orderHistory() ?>
            </div>
        </div>
    </div>
    <script src="js/script.js"></script>
    
</body>
</html>