<?php 
    session_start();
    if (!isset($_SESSION['login'])) {
        header("Location: login.php");
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

        <form action="pay-now.php" method="POST" class="users-form">
                <p class="users-text">Success!</p>
                <?php handleOrder() ?>
            <div class="button-group">
                <button name="pay-now" class="btn-bot">Pay Now</button>
            </div>
        </form>
    </div>
</body>
</html>