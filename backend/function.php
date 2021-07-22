<?php

$db = mysqli_connect('localhost','root','','php_test');

function register($data){
    global $db;

    $name = $data['name'];
    $email = $data['email'];
    $password = $data['password'];

    $query = mysqli_query($db,"SELECT * FROM user WHERE email='$email'");
    // email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Email is invalid')</script>";
    }else {
        if (mysqli_num_rows($query) > 0) {
            echo "<script>alert('This email already exist!!.')</script>";
        }elseif (strlen($password)>=6) {
            // Password validation
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO user (name, email, password) VALUE ('$name','$email','$password')";
            $result = mysqli_query($db, $sql);
            if (!$result) {
                        echo "<script>alert('Something wrong!!.')</script>";
                    }else{
                        header("Location: login.php");
                    }
        }else {
            echo "<script>alert('Password at least 6 Character!!.')</script>";
        }
    }
    
}

function login(){
    global $db;
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM user WHERE email='$email'";
        $result = mysqli_query($db, $sql);

        // check email on database
        if (mysqli_num_rows($result) > 0) {   
            $row = mysqli_fetch_assoc($result);
            $_SESSION['email'] = $row['email'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['userid'] = $row['userid'];
            
            // check password
            if (password_verify($password, $row['password'])) {
                $_SESSION['login']=true;
                
                header("Location: ../index.php");
            }else{
                echo "<script>alert('Password incorect')</script>";
            }
        }else {
            echo "<script>alert('Email not found, please register')</script>";
        }
    }
}

function countOrder(){
    // count unpaid order
    global $db;
    $userid = $_SESSION['userid'];
    $counter=array();
    $status = 'unpaid';
    $count=0;
    $sql = mysqli_query($db,"SELECT * FROM transactions WHERE userid='$userid'AND status='$status'");
    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $counter []= $row;
            $count = count($counter);
        }
        return $count;  
    }else{
        return $count;
    }
    
}

function menu(){
    // Header on every page, except login and register

    if ($_SESSION['name'] == null) {
        echo '<div class="col"><p>Hello, ' . $_SESSION['email'] .'</p>';
    }else{
        echo '<div class="col"><p>Hello, ' . $_SESSION['name'] .'</p>';
    }
     echo '<a href="order-history.php" style="color:red">'. countOrder() .'</a><span> unpaid order</span>
     </div>
     <div class="col">
        <a href="index.php">Prepaid Balance</a>
    </div>
    <div class="col">
        <p>|</p>
    </div>
    <div class="col">
        <a href="product.php">Product Page</a>
    </div>';
}


function prepaidOrder(){
    global $db;
    if (isset($_POST['prepaid-order'])) {
        $userid = $_SESSION['userid'];
        $mobile_no = $_POST['mobile_no'];
        $pre_value = $_POST['pre_value'];
        $types='1';
        // validation for mobile number(prefix 081 and length between 7 and 12)
        if ($mobile_no[0]=='0' && $mobile_no[1]=='8' && $mobile_no[2]=='1' && strlen($mobile_no)>=7 && strlen($mobile_no)<=12) {
            $sqlOrder = "INSERT INTO prepaid (userid, mobile_no, pre_value, types) VALUE ('$userid','$mobile_no','$pre_value','$types')";
            $result = mysqli_query($db, $sqlOrder);
            if (!$result) {
                echo "<script>alert('Something wrong!!.')</script>";
            }else{
                $_SESSION['mobile_no'] = $mobile_no;
                $_SESSION['pre_value'] = $pre_value;
                $_SESSION['types'] = $types;
                header("Location: create-order.php");
            }
        }echo "<script>alert('Mobile number start with 081')</script>";

    }
}

function productOrder(){
    global $db;
    if (isset($_POST['product-order'])) {
        $userid = $_SESSION['userid'];
        $pname = $_POST['pname'];
        $pshipping = $_POST['pshipping'];
        $pprice = $_POST['pprice'];
        $types='2';

        // validation for price value ( digit only and not 0 )
        if (!is_numeric($pprice) || $pprice[0]=='0') {
            echo "<script>alert('Please input a valid price')</script>";
        }else{
            $sqlOrder = "INSERT INTO product (userid, pname, pshipping, pprice, types) VALUE ('$userid','$pname','$pshipping','$pprice','$types')";
            $result = mysqli_query($db, $sqlOrder);
            if (!$result) {
                echo "<script>alert('Something wrong!!.')</script>";
            }else{
                $_SESSION['pname'] = $pname;
                $_SESSION['pshipping'] = $pshipping;
                $_SESSION['pprice'] = $pprice;
                $_SESSION['types'] = $types;
                header("Location: create-order.php");
            }
        }
        
    }
}

function handleOrder(){

    $order = mt_rand(1000000000,9999999999);
    $no_order = "$order";
    $_SESSION['no_order'] = $no_order;

    if (!empty($_SESSION['mobile_no']) && !empty($_SESSION['pre_value'])) {
        // display display create order for product
        $mobile_no = $_SESSION['mobile_no'];
        $pre_value = $_SESSION['pre_value'];
        $tax = ($pre_value*5)/100;
        $totalOrder = ($pre_value + $tax);
        $_SESSION['total'] = $totalOrder;

        echo '<div class="order">
        <div class="detail"><p>Order no.</p></div>
        <div class="detail"><p>'.$_SESSION['no_order'].'</p></div>
        </div>
        <div class="order">
        <div class="detail"><p>Total</p></div>
        <div class="detail"><p>Rp. '.number_format($totalOrder).'</p></div>
        </div>
        <div class="order">
        <p>Your mobile phone number '. $mobile_no.' will receive Rp '. number_format($pre_value) .'
        </p>
        </div>
        
        ';
    }else {
        // display create order for product
        $pname = $_SESSION['pname'];
        $pshipping = $_SESSION['pshipping'];
        $pprice = $_SESSION['pprice'];
        $tax = 10000;
        $totalOrder = ($pprice + $tax);
        $_SESSION['total'] = $totalOrder;

        echo '<div class="order">
        <div class="detail"><p>Order no.</p></div>
        <div class="detail"><p>'.$_SESSION['no_order'].'</p></div>
        </div>
        <div class="order">
        <div class="detail"><p>Total</p></div>
        <div class="detail"><p>Rp. '.number_format($totalOrder).'</p></div>
        </div>
        <div class="details">
            <p>'.$pname.' that costs '. number_format($pprice) .' will be shipped to : </p>
            <p>'.$pshipping.'</p>
            <p>only after you pay</p>
        </div>';
    }

}

function paginationOrder(){
    global $db;
    $userid = $_SESSION['userid'];
    $noOrderData = 20;
    $query = mysqli_query($db, "SELECT * FROM transactions WHERE userid='$userid'");
    $data = mysqli_num_rows($query);
    $pageTotal = ceil($data/$noOrderData);
    $activePage = ( isset($_GET['page']) ) ? $_GET['page'] : 1;
    $nextPage = $activePage + 1;
    $prevPage = $activePage - 1;

    if ($data >0) {
        echo'<div class="pagination">';
        if ($activePage > 1) {
            echo '<a href="?page='.$prevPage.'">Prev</a>';
        }
    
        for ($i=1; $i <= $pageTotal ; $i++) { 
            if ($i==$activePage) {
                echo '<a href="?page='.$i.'" style="font-weight:bold">'.$i.'</a>'
                ;
            }else{
                echo '<a href="?page='.$i.'">'.$i.'</a>';
            }
        }
    
        if ($activePage < $pageTotal) {
            echo '<a href="?page='.$nextPage.'">Next</a>';
        }
        echo '</div>';
    }
}

function orderHistory(){
    // display order history
    global $db;
    $userid = $_SESSION['userid'];
    $noOrderData = 20;
    $activePage = ( isset($_GET['page']) ) ? $_GET['page'] : 1;
    $firstData = ($noOrderData * $activePage) - $noOrderData;

    // list order by user id and sort descending  
    $result= mysqli_query($db, "SELECT * FROM transactions WHERE userid='$userid' ORDER BY time_stamp DESC LIMIT $firstData,$noOrderData");
    if (mysqli_num_rows($result)>0) {
        cancelOrder();
        // fetch all order (topup balance and product)
        while($row = mysqli_fetch_assoc($result)){
            if ($row['types']=="1" && $row['status']=='unpaid') {
                echo '<div class="order-history1" id="order-history1">
                            <div class="col">
                                <h5>'.$row['no_order'].'<span>Rp. '.number_format($row['total']).'</span></h5>
                                <p>Rp '.number_format($row['pre_value']).' for '.$row['mobile_no'].'</p>
                            </div>
                            <div class="col2">
                                <a class="button" href="pay-order.php?no_order='.$row['no_order'].'">Pay now</a>
                            </div>
                        </div>
                            ';
            }else if ($row['types']=="1" && $row['status']=='paid') {
                echo '<div class="order-history1" id="order-history1">
                            <div class="col">
                                <h5>'.$row['no_order'].'<span>Rp. '.number_format($row['total']).'</span></h5>
                                <p>Rp '.number_format($row['pre_value']).' for '.$row['mobile_no'].'</p>
                            </div>
                            <div class="col2">
                                <p style="color:green; font-weight:bold">Success</p>
                            </div>
                        </div>
                            ';
            }elseif ($row['types']=="1" && $row['status']=='cancel') {
                echo '<div class="order-history1" id="order-history1">
                            <div class="col">
                                <h5>'.$row['no_order'].'<span>Rp. '.number_format($row['total']).'</span></h5>
                                <p>Rp '.number_format($row['pre_value']).' for '.$row['mobile_no'].'</p>
                            </div>
                            <div class="col2">
                                <p style="color:red; font-weight:bold">Canceled</p>
                            </div>
                        </div>
                            ';
            }elseif ($row['types']=="1" && $row['status']=='failed') {
                echo '<div class="order-history1" id="order-history1">
                            <div class="col">
                                <h5>'.$row['no_order'].'<span>Rp. '.number_format($row['total']).'</span></h5>
                                <p>Rp '.number_format($row['pre_value']).' for '.$row['mobile_no'].'</p>
                            </div>
                            <div class="col2">
                                <p style="color:orange; font-weight:bold">Failed</p>
                            </div>
                        </div>
                            ';
            }elseif ($row['types']=="2" && $row['status']=='unpaid') {
                echo '<div class="order-history1" id="order-history1">
                        <div class="col">
                            <h5>'.$row['no_order'].'<span>Rp. '.number_format($row['total']).'</span></h5>
                            <p>'.$row['pname'].' that costs '.number_format($row['pprice']).'</p>
                        </div>
                        <div class="col2">
                            <a class="button" href="pay-order.php?no_order='.$row['no_order'].'">Pay now</a>
                        </div>
                    </div>
                    ';
            }elseif ($row['types']=="2" && $row['status']=='paid') {
                echo '<div class="order-history1" id="order-history1">
                        <div class="col">
                            <h5>'.$row['no_order'].'<span>Rp. '.number_format($row['total']).'</span></h5>
                            <p>'.$row['pname'].' that costs '.number_format($row['pprice']).'</p>
                        </div>
                        <div class="col2">
                            <p style="font-weight:bold">'.$row['shipping_code'].'</p>
                        </div>
                    </div>
                    ';
            }elseif ($row['types']=="2" && $row['status']=='cancel') {
                echo '<div class="order-history1" id="order-history1">
                        <div class="col">
                            <h5>'.$row['no_order'].'<span>Rp. '.number_format($row['total']).'</span></h5>
                            <p>'.$row['pname'].' that costs '.number_format($row['pprice']).'</p>
                        </div>
                        <div class="col2">
                            <p style="color:red; font-weight:bold">Canceled</p>
                        </div>
                    </div>
                    ';
            }
        } paginationOrder();
    }else{
        echo "No Order History";
    }
}

function cancelOrder(){
    // function auto cancel order if not paid after 5 minutes create order
    global $db;
    $userid = $_SESSION['userid'];
    date_default_timezone_set("Asia/Jakarta");
    $now = time();
    $timenow = "$now";
    $status='cancel';
    $query = mysqli_query($db, "SELECT * FROM transactions WHERE status='unpaid'");
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $time = $timenow-$row['time_stamp'];
        foreach ($row as $row['time_stamp']) {
            if ($time>300) {
                $sql = mysqli_query($db, "UPDATE transactions SET status='$status' WHERE status='unpaid'");
            }
        }
    }
}


?>