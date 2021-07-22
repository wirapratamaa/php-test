<?php 
    session_start();
    if (!isset($_SESSION['login'])) {
        header("Location: auth/login.php");
    }
    
    include ('backend/function.php');
    $requiredSessionVar = array('login','userid','name','email');
    foreach($_SESSION as $key => $value) {
        if(!in_array($key, $requiredSessionVar)) {
            unset($_SESSION[$key]);
        }
    }
    productOrder();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Product</title>
</head>
<body>
    <div class="container">
            <div class="menu">
                <?php menu() ?>
            </div>

            <form action="" method="POST" class="users-form">
            <p class="users-text">Product Page</p>
            <div class="input-group">
                <textarea rows="3" placeholder="Product" name="pname" value="2"></textarea>
            </div>
            <div class="input-group">
                <textarea rows="3" placeholder="Shipping Address" name="pshipping"></textarea>
            </div>
            <div class="input-group">
                <input type="text" placeholder="Price" name="pprice" required>
            </div>
            
            <div class="button-group">
                <button name="product-order" class="btn-bot">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>