<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/modal.css">
<script>
  function onCancelButtonClick(){
    history.go(-1);
  }
</script>
</head>
<body>
<?php 
    session_start();

    if (isset($_SESSION["business_number"])) $businessnum = $_SESSION["business_number"];
    else $businessnum = "";

    $con = mysqli_connect("localhost", "root", "", "project");
    //음식점 데이터 추출(배너 이미지, 최소 주문 금액, 배달팁 정보 가져오기)
    $sql = "select * from restaurant where business_number='$businessnum'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    if(!$businessnum || $row){
      echo("
        <script>
          alert('사장님 가게는 하나만 등록할 수 있습니다.');
          history.go(-1)
        </script>
      ");
    }
    mysqli_close($con);//DB 연결 끊기
?>

<div class="modal" style="display: block">
  <form class="modal_content animate" action="restaurant_insert.php" method="post" name="regist_form" enctype="multipart/form-data">
    <div class="imgcontainer">
      <h1>사장님 가게 등록</h1>
      <hr />
    </div>

    <div class="container">
      <b>브랜드 이미지 설정</b>
      <br />
      <input type="file" name="upfile" />
      <br />
      <div class="padding_bottom"></div>
      <b>사장님의 다짐</b>
      <hr />
      <input class="tesxtares" type="text" name="motto"/>
      <br />
      <b>최소 주문 금액</b>
      <hr />
      <input type="number" name="minimum_order_amount"/>
      <br />
      <b>배달 팁</b>
      <hr />
      <input type="number" name="delivery_tips"/>
      <br />
      <!--메뉴 추가 부분-->
      <div id="addedKeyword"></div>
      <img src="./img/signup/add_button.png" class="add_button" onclick= "addMenuForm()"/>
      <?php echo "<input type='hidden' name='business_number' value='$businessnum'>" ?>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick=onCancelButtonClick()>취소하기</button>
      <button type="button" onclick=check_input()>등록하기</button>
    </div>
  </form>
</div>
<script src='restaurant_register.js'></script>
</body>
</html>
