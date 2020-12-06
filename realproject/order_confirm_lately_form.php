<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<script>

  function CancleButtonClick() {
    location.href = "order_delete.php";
  }

</script>
<body>
<?php 
  //사장님이 눌렀을 경우
  session_start();

  if (isset($_SESSION["business_number"])) $businessnum = $_SESSION["business_number"];
  else $businessnum = "";
  
  if($businessnum){
    echo "<h1>사장님이 눌렀어용</h1>";

    $con = mysqli_connect("localhost", "root", "", "project");
    $sql = "select count(*) from business_order_temp where business_number='$businessnum'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_row($result);
    
    if($row){
      $total_record_order = $row[0];
      $tempnumber = $total_record_order * 3;

      for($i=0; $i < $total_record_order; $i++){
        $sql = "select * from business_order_temp where business_number='$businessnum' and order_number < $tempnumber order by num desc LIMIT 1";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        $tempnumber = $row["order_number"];

        $num = $i + 1;
        $sql = "select * from business_order_temp where business_number='$businessnum' order by num desc";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        
        if($row){
          $sql = "select * from orders where business_order_number='$tempnumber' and business_number='$businessnum' order by regist_day desc";
          $result = mysqli_query($con, $sql);
          $row = mysqli_fetch_array($result);
          $regist_day = $row["regist_day"];
          $id = $row["id"];
          $total_record_menu = mysqli_num_rows($result);
          ?>
          <form action="order_confirm_insert.php" name="order_form" method="post">
        <?php
          echo "<h5>주문일시: $regist_day </h5><h5> 주문한 사람: $id </h5>";
    
          for($j=0; $j < $total_record_menu; $j++) {
              $sql = "select * from orders where business_order_number='$tempnumber' and business_number='$businessnum' order by regist_day desc";
              //$sql = "select * from business_order_temp where business_number='$businessnum' and (order_number between 0 and 5)  order by num desc LIMIT 1";
              $result = mysqli_query($con, $sql);
              mysqli_data_seek($result, $j);
              $row = mysqli_fetch_array($result);
              $menu_name = $row["menu_name"];
              $menu_price = $row["menu_price"];
              $menu_count = $row["menu_count"];
              echo "<b> $menu_name </b><b> $menu_count 개 </b><b> $menu_price 원</b><br/>";
          }
          echo "<input type='hidden' name='order_number' value='$tempnumber'/>";
          echo "<input type='hidden' name='business_number' value='$businessnum'/>";
          echo "<input type='hidden' name='id' value='$id'/>";
          echo "<button type='submit'>주문확인</button>";
          echo "<button type='button' onclick='CancleButtonClick()'>주문취소</button>";
          echo "<hr/>";
          ?>
          </form>
          <?php
      }   
    } 
  }
}
?> 
</body>
</html>