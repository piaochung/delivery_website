<?php 
    session_start();
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";

    $con = mysqli_connect("localhost", "root", "", "project");
    
    $sql = "select * from orders where id='$userid' order by regist_day desc";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $order_number = $row["order_number"];
    $business = $row["business_number"];

    $sql = "insert into customer_order_temp(business_number, id, order_number) ";
    $sql .= "values('$business', '$userid', '$order_number')";  
    mysqli_query($con, $sql);

    $sql = "select * from orders where business_number='$business' order by regist_day desc";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $order_number = $row["business_order_number"];

    mysqli_close($con);

    echo "
    <script>
      location.href = 'order_confirm_form.php?id=$userid&order_number=$order_number&business_number=$business';
    </script>
    ";
?>