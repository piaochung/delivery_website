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

    if(!$businessnum){
      echo("
        <script>
          alert('사장님만 가게 등록을 이용해 주세요!');
          history.go(-1)
        </script>
      ");
    }
?>

<div id="id01" class="modal" style="display: block">
  <form class="modal-content animate" action="restaurant_insert.php" method="post" enctype="multipart/form-data">
    <div class="imgcontainer">
      <h3>사장님 가게 등록</h3>
      <hr />
    </div>

    <div class="container">
      <b>브랜드 이미지 설정</b>
      <br />
      <input type="file" name="upfile">
      <br />
      <div class="padding_bottom"></div>
      <b>사장님의 다짐</b>
      <hr />
      <input class="tesxtares" type="text" name="motto" cols="100" rows="10"></input>
      <br />
      <?php echo "<input type='hidden' name='business_number' value='$businessnum'>" ?>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick=onCancelButtonClick()>취소하기</button>
      <button type="submit">등록하기</button>
    </div>
  </form>
</div>
</body>
</html>
