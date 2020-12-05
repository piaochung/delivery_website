<?php 
    $con = mysqli_connect("localhost", "root", "", "project");
    $order_number = $_POST["order_number"];
    $business_number = $_POST["business_number"];

    $sql = "delete from business_order_temp where order_number='$order_number' and business_number='$business_number';";
    mysqli_query($con, $sql);

    $sql = "delete from customer_order_temp where order_number='$order_number' and business_number='$business_number';";
    mysqli_query($con, $sql);

    mysqli_close($con);

    echo "
    <script>
        location.href = 'main.php';
    </script>
    ";
?>