<?php 
       $id = $_POST["id"];
       $order_number = $_POST["order_number"];
       $business_number = $_POST["business_number"];

       $con = mysqli_connect("localhost", "root", "", "project");
       $sql = "insert into business_order(id, business_number, order_number) ";
       $sql .= "values('$id', '$business_number', '$order_number')";
       mysqli_query($con, $sql);

       $sql = "insert into customer_order(business_number, id, order_number) ";
       $sql .= "values('$business_number', '$id', '$order_number')";
       mysqli_query($con, $sql);

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