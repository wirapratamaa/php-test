<?php
session_start();
include ('backend/function.php');
global $db;
date_default_timezone_set("Asia/Jakarta");
$start = mktime(9,00,00);
$end = mktime(17,00,00);
$currentTime= time();
$timestamp = date("Y-m-d H:i:s");
$no_order = $_SESSION['no_order'];
$sql = mysqli_query($db, "SELECT * FROM transactions WHERE no_order='$no_order'");
$result = mysqli_num_rows($sql);
if (isset($_POST['submit-order'])) {
    if ($result>0) {
        $row = mysqli_fetch_assoc($sql);
        $status = 'paid';
        $failed = 'failed';
        
        if ($row['types']=='1') {
            // add time range between 9AM - 5PM
            if ($currentTime>=$start && $currentTime<=$end) {
                $rand = rand(0,9);

                // 90% success rate  
                if ($rand == 0) {
                    $query = mysqli_query($db, "UPDATE transactions SET status='$failed'  WHERE no_order='$no_order'");
                    echo "<script>window.location.href='order-history.php';alert('Balance transaction failed');</script>";
                }else{
                    $query = mysqli_query($db, "UPDATE transactions SET status='$status', paid_at='$timestamp' WHERE no_order='$no_order'");
                    echo "<script>window.location.href='order-history.php';alert('Balance is successfully paid');</script>";
                }
            }else {
                //  otherwise 40% success rate
                $rand = rand(0,9);
                $number = array(1,2,3,4);
                if (in_array($rand,$number) ) {
                    $query = mysqli_query($db, "UPDATE transactions SET status='$status', paid_at='$timestamp' WHERE no_order='$no_order'");
                    echo "<script>window.location.href='order-history.php';alert('Balance is successfully paid');</script>";
                }else{
                    $query = mysqli_query($db, "UPDATE transactions SET status='$failed' WHERE no_order='$no_order'");
                    echo "<script>window.location.href='order-history.php';alert('Balance transaction failed');</script>";
                }
            }

        }else {
            $alphaNum = generateRandomString(8);
            $query = mysqli_query($db, "UPDATE transactions SET status='$status', shipping_code='$alphaNum', paid_at='$timestamp' WHERE no_order='$no_order'");
            echo "<script>window.location.href='order-history.php';alert('Product is successfully paid');</script>";
        }
    }
}
function generateRandomString($length) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>