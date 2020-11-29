<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/modal.css">
</head>
<body>
<?php 
  $business = $_POST["business"];
?>

<div id="id01" class="modal">
  <form class="modal-content animate" action="액션 설정" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="img_avatar2.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <b>배달 주문</b>
      <hr />
      <p>최소주문금액 19,500원</p>
      <p>결제 방법 바로결제, 만나서결제</p>
      <p>배달시간 22~33분 소요</p>
      <p>배달팁 2,000원</p>
      <label for="psw"><b>주문하기</b></label>
      <br />
      <textarea name="ordertext" id="ordertextarea" cols="100" rows="10"></textarea>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="">취소하기</button>
      <button type="submit">주문하기</button>
    </div>
  </form>
</div>
</body>
</html>