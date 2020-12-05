<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        session_start();
        if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
        else $userid = "";

        if (isset($_SESSION["business_number"])) $businessnum = $_SESSION["business_number"];
        else $businessnum = "";
        
        $con = mysqli_connect("localhost", "root", "", "project");

        if(!$userid){
            //사장님이 눌렀을 경우
            echo "<h1>사장님이 눌렀어용</h1>";
            $sql = "select * from business_order_temp where business_number='$businessnum' order by order_number desc";
            $result = mysqli_query($con, $sql);
            $total_record_order = mysqli_num_rows($result);

            for($i=1; $i <= $total_record_order; $i++){
                $sql = "select * from orders where order_number='$i' and business_number='$businessnum' order by regist_day desc";
                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_array($result);
                $regist_day = $row["regist_day"];
                $id = $row["id"];
                $total_record_menu = mysqli_num_rows($result);
                
                echo "<h5>주문일시: $regist_day</h5><h5>주문한 사람: $id</h5>";

                for($j=0; $j < $total_record_menu; $j++) {
                    mysqli_data_seek($result, $j);
                    $row = mysqli_fetch_array($result);
                    $menu_name = $row["menu_name"];
                    $menu_price = $row["menu_price"];
                    echo "<b>$menu_name</b><b>$menu_price 원</b><br/>";
                }
                echo "<hr/>";
            }
        }
        else {
            //고객님이 눌렀을 경우
            echo "<h1>고객님이 눌렀어용</h1>";
            //임시로 코드 수정
            $sql = "select * from customer_order_temp where id='$userid' order by order_number desc";
            $result = mysqli_query($con, $sql);
            $total_record_order = mysqli_num_rows($result);

            for($i=1; $i <= $total_record_order; $i++){
                $sql = "select * from orders where order_number='$i' and id='$userid' order by regist_day desc";
                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_array($result);
                $regist_day = $row["regist_day"];
                $business_number = $row["business_number"];
                $total_record_menu = mysqli_num_rows($result);
                
                echo "<h5>주문일시: $regist_day</h5><h5>주문한 가게: $business_number</h5>";

                for($j=0; $j < $total_record_menu; $j++) {
                    mysqli_data_seek($result, $j);
                    $row = mysqli_fetch_array($result);
                    $menu_name = $row["menu_name"];
                    $menu_price = $row["menu_price"];
                    echo "<b>$menu_name</b><b>$menu_price 원</b><br/>";
                }
                echo "<hr/>";
            }
        }
    ?>
</body>
</html>