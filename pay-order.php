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

            <form action="pay.php" method="POST" class="users-form">
            <p class="users-text">Pay your order</p>
            <div class="search">
                <div class="input-group">
                    <input type="text" placeholder="Order no." name="no_order" value=<?php echo $_SESSION['no_order'] ?>>
                </div>
            </div>
            <div class="button-group">
                <button name="submit-order" class="btn-bot">Pay Now</button>
            </div>
        </form>
    </div>
</body>
</html>