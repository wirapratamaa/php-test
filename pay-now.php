<?php 
session_start();
include ('backend/function.php');
    $status = 'unpaid';
    $userid = $_SESSION['userid'];
    $totalOrder = $_SESSION['total'];
    $no_order = $_SESSION['no_order'];
    $types = $_SESSION['types'];
    $pre_value = $_SESSION['pre_value'];
    $mobile_no = $_SESSION['mobile_no'];
    $pname = $_SESSION['pname'];
    $pprice = $_SESSION['pprice'];
    date_default_timezone_set("Asia/Jakarta");
    $timestamp = strtotime(date("Y-m-d H:i:s"));
    $shipping ='';
    $paid_at ='';
    if (isset($_POST['pay-now'])){
        $query = "INSERT INTO transactions (userid, no_order, total, pre_value, mobile_no, pname, pprice, types, status, shipping_code, time_stamp, paid_at) 
                VALUE ('$userid','$no_order','$totalOrder','$pre_value','$mobile_no','$pname','$pprice','$types', '$status','$shipping','$timestamp','$paid_at')";
        $result= mysqli_query($db, $query);
        $_SESSION['no_order']=$no_order;
        $_SESSION['status']=$status;
        header("Location: pay-order.php");
    }

?>