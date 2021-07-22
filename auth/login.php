<?php
    session_start();
    if (isset($_SESSION['login'])) {
        header("Location: index.php");
    }
    
    include ('../backend/function.php');
    login();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="users-form">
            <p class="users-text">Login</p>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email"  required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" >
            </div>
            <div class="input-group">
                <button name="login" class="btn">Login</button>
            </div>
            <a href="register.php">Register</a>
        </form>
    </div>
</body>
</html>