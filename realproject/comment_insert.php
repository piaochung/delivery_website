<?php
    session_start();
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";

    $regist_day = date("Y-m-d (H:i:s) ");
    $business_number = $_POST["business_number"];
    $business_order_number = $_POST["business_order_number"];
    $review = $_POST["comment_text"];

    $con = mysqli_connect("localhost", "root", "", "project");

    $sql = "select comment_index from comment where business_number='$business_number' order by comment_index desc";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_row($result);

    $comment_index = $row[0];
    $comment_index++;

    $sql = "insert into comment(comment_index, business_number, business_order_number, id, review, regist_day) ";
    $sql .= "values('$comment_index', '$business_number', '$business_order_number', '$userid', '$review', '$regist_day')";
    mysqli_query($con, $sql);

    mysqli_close($con);//DB 연결 끊기

    echo "
    <script>
        location.href = 'main.php';
    </script>
";
?>