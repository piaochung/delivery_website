<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/menu.css">
    <script>
      function onCancelButtonClick(){
        history.go(-1);
      }
    </script>
</head>
<body>

<?php 
  session_start();
  if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
  else $userid = "";

  if(!$userid) {
    echo("
						<script>
						alert('고객 회원만 주문할 수 있습니다.');
						history.go(-1)
						</script>
				");
  }

  $business = $_POST["business"];

  $con = mysqli_connect("localhost", "root", "", "project");
  //음식점 데이터 추출(배너 이미지, 최소 주문 금액, 배달팁 정보 가져오기)
  $sql = "select * from restaurant where business_number='$business'";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($result);
  
  $minimum_order_amount = $row["minimum_order_amount"];
  $delivery_tips = $row["delivery_tips"];
  $file_copied = $row["file_copied"];
  $file_copied = './data/'.$business.'/'.$file_copied;
  
  //메뉴 데이터 추출(이미지, 이름, 가격)
  $sql = "select * from restaurant_menu where business_number='$business' order by num desc";
  $result = mysqli_query($con, $sql);
  $total_record = mysqli_num_rows($result);
?>

<div id="id01" class="modal">
  <form class="modal-content animate" action="order_insert.php" method="post">
    <div class="imgcontainer">
      <?php
        echo "<img src='$file_copied' class='avatar'>";
      ?>
    </div>

    <div class="container">
      <b>배달 주문</b>
      <hr />
      <p name="minimum_order_amount">최소주문금액 <?=$minimum_order_amount?>원</p>
      <p>배달시간 22~33분 소요</p>
      <p name="delivery_tips">배달팁 <?=$delivery_tips?>원</p>
      <b>주문하기</b>
      <hr />
      <div class="menu_form">
    <?php 
     for($i=0; $i < $total_record; $i++){
        echo "<div class='menu_content'>";
        mysqli_data_seek($result, $i);
        $row = mysqli_fetch_array($result);
    
        $file_copied = $row["file_copied"];
        $menu_name = $row["menu_name"];
        $menu_price = $row["menu_price"];

        if ($row["file_name"])
            $file_image = "<img class='menu_image' src='./data/$business/menu/$file_copied'>";
        else
            $file_image = " ";


        echo $file_image;
        echo "<b>$menu_name</b><b>$menu_price 원 <input class='menu_number' name='menu_count_$i' type='number' /></b>";
        echo "</div>";
        echo "<input type='hidden' name='menu_name_$i' value='$menu_name'/>";
        echo "<input type='hidden' name='menu_price_$i' value='$menu_price'/>";
      }
      echo "<input type='hidden' name='total_record' value='$total_record'/>";
      echo "<input type='hidden' name='business' value='$business'/>";
      echo "<input type='hidden' name='business' value='$business'/>";
    ?>
    </div>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick= onCancelButtonClick() >취소하기</button>
      <button type="submit">주문하기</button>
    </div>
    <?php 
      //리뷰 정보 알려주는 곳
      
      $sql = "select * from comment where business_number='$business' order by regist_day desc";
      $result = mysqli_query($con, $sql);
      $total_record = mysqli_num_rows($result);
      $review_number = 0;
      
      if(isset($_GET["review_number"])) {
        $review_number = $_GET["review_number"];
        $review_number += 5;

        if($review_number >= $total_record){
          $total_record = $review_number;
        }
      }

      for($i=0; $i < $total_record; $i++){
        mysqli_data_seek($result, $i);
        $row = mysqli_fetch_array($result);
        $review = $row["review"];
        $id = $row["id"];
        $regist_day = $row["regist_day"];

        echo "<b>$id 님의 리뷰입니다.</b><span>리뷰 날짜: $regist_day</span><br/>";
        echo "<b>$review</b><hr />";
      }

      if($review_number < $total_record) {
        echo "<li> <a href='order.php?review_number=$review_number'> 리뷰 더 보기</a> </li>";
      }
      mysqli_close($con);
    ?>
  </form>
</div>
</body>
</html>