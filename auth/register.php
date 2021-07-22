<?php
    include ('../backend/function.php');

    if (isset($_POST['register'])) {
        
        if (register($_POST) > 0) {
            echo "<script>alert('Register Success!!')</script>";
        }else{
            echo mysqli_error($db);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>PHPtest</title>
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="users-form">
            <p class="users-text">Register</p>
            <div class="input-group">
                <input type="text" placeholder="Name" name="name">
            </div>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email">
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password">
            </div>
            <div class="input-group">
                <button name="register" class="btn">Register</button>
            </div>
            <a href="login.php">Login</a>
        </form>
    </div>
</body>
</html>