<?php 
    session_start();
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];

    $order_number = 0;
    $business = $_POST["business"];
    $total_number = $_POST["total_record"];
    $regist_day = date("Y-m-d (H:i)");

    $con = mysqli_connect("localhost", "root", "", "project");
    
    $sql = "select order_number from orders where business_number='$business' order by order_number desc";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_row($result);

    $order_number = $row[0] + 1;
    
    for($i=0; $i < $total_number; $i++){
        $menu_name = $_POST["menu_name_$i"];
        $menu_price = $_POST["menu_price_$i"];
        $menu_count = $_POST["menu_count_$i"];
        $menu_total_price = $menu_price * $menu_count;
        $sql = "insert into orders(order_number, id, business_number, menu_name, menu_count, menu_price, regist_day) ";
        $sql .= "values('$order_number', '$userid', '$business', '$menu_name', '$menu_count', '$menu_total_price', '$regist_day')";
        mysqli_query($con, $sql);
        $sql = "";
        sleep(2);
    }
    mysqli_close($con);

    echo "
    <script>
        location.href = 'order_confirm_form.php';
    </script>
";
?>