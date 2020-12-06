<?php 
    session_start();
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";

    $order_number = 0;
    $business = $_POST["business"];
    $total_number = $_POST["total_record"];
    $regist_day = date("Y-m-d (H:i:s) ");

    $con = mysqli_connect("localhost", "root", "", "project");
    
    $sql = "select order_number from orders where id='$userid' order by order_number desc";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_row($result);

    $order_number = $row[0];

    $sql = "select business_order_number from orders order by num desc";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_row($result);

    $business_order_number = $row[0];

    $order_number++;
    $business_order_number++;
    
    for($i=0; $i < $total_number; $i++){
        $menu_name = $_POST["menu_name_$i"];
        $menu_price = $_POST["menu_price_$i"];
        $menu_count = $_POST["menu_count_$i"];
        $menu_total_price = $menu_price * $menu_count;
        $sql = "insert into orders(order_number, id, business_number, business_order_number, menu_name, menu_count, menu_price, regist_day) ";
        $sql .= "values('$order_number', '$userid', '$business', '$business_order_number', '$menu_name', '$menu_count', '$menu_total_price', '$regist_day')";
        mysqli_query($con, $sql);
        $sql = "";
        sleep(1);
    }
    mysqli_close($con);

    echo "
    <script>
        location.href = 'order_history_insert.php';
    </script>
";
?>