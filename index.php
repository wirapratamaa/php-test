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
    prepaidOrder();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Prepaid</title>
</head>
<body>
    <div class="container">
            <div class="menu">
                <?php menu() ?>
            </div>

            <form action="" method="POST" class="users-form">
            <p class="users-text">Prepaid Balance</p>
            <div class="input-group">
                <input type="text" placeholder="Mobile Number" name="mobile_no" required>
            </div>
            <div class="input-group">
                <select name="pre_value" id="pre_value">
                    <option value="10000">Rp 10.000</option>
                    <option value="50000">Rp 50.000</option>
                    <option value="100000">Rp 100.000</option>
                </select>
            </div>
            <div class="button-group">
                <button name="prepaid-order" class="btn-bot">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>