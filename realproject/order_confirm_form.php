<!--사장님에게 주문내역을 보내는 곳-->
<?php 
    session_start();
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";

    $id = $_GET["userid"];
    $order_number = $_GET["order_number"];
    $business_number = $_GET["business_number"];

    $con = mysqli_connect("localhost", "root", "", "project");
    $sql = "insert into business_order_temp(id, business_number, order_number) ";
    $sql .= "values('$userid', '$business_number', '$order_number')";
    mysqli_query($con, $sql);
    mysqli_close($con);

    echo "
    <script>
        location.href = 'main.php';
    </script>
    ";
?>
