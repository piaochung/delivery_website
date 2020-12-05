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

    $business_number = $_POST["business_number"];
    $business_order_number = $_POST["business_order_number"];
?>
<form action="comment_insert.php" method="post">
    <?php 
        echo "<h4><span>아이디: $userid</span></h4>";
    ?>
    <hr/>
    <h5>리뷰를 써주세요!</h5>
    <input type="text" name="comment_text"></input>
    <?php 
        echo "<input type='hidden' name='business_number' value='$business_number'></input>";
        echo "<input type='hidden' name='business_order_number' value='$business_order_number'></input>";
        echo "<button type='submit'>리뷰 남기기</button>";
    ?>
</form>

</body>
</html>