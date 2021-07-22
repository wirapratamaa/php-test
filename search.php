<?php 
session_start();
include ('backend/function.php');
global $db;
$userid = $_SESSION['userid'];
$keyword = $_GET['search'];
$noOrderData = 20;
$activePage = ( isset($_GET['page']) ) ? $_GET['page'] : 1;
$firstData = ($noOrderData * $activePage) - $noOrderData;
$query = mysqli_query($db, "SELECT * FROM transactions WHERE userid='$userid' AND no_order LIKE '%$keyword%' ORDER BY time_stamp DESC LIMIT $firstData,$noOrderData");
$data=mysqli_num_rows($query);
if ($data>0) {
    while($row = mysqli_fetch_assoc($query)){
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
    }paginationSearch();
}else{
    echo "No Order Found";
}


function paginationSearch(){
    global $db;
    $userid = $_SESSION['userid'];
    $keyword = $_GET['search'];
    $noOrderData = 20;
    $query = mysqli_query($db, "SELECT * FROM transactions WHERE userid='$userid' AND no_order LIKE '%$keyword%'");
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
?>

