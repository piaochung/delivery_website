<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
h3 {
   padding-left: 5px;
   border-left: solid 5px #edbf07;
}
#close {
   margin:20px 0 0 80px;
   cursor:pointer;
}
</style>
</head>
<body>
<h3>사업자 번호 중복체크</h3>
<p>
<?php
   $business = $_GET["business_number"];

   if(!$business) 
   {
      echo("<li>사업자 번호를 입력해 주세요!</li>");
   }
   else
   {
      $con = mysqli_connect("localhost", "root", "", "project");

 
      $sql = "select * from business_members where business_number='$business'";
      $result = mysqli_query($con, $sql);

      $num_record = mysqli_num_rows($result);

      if ($num_record)
      {
         echo "<li>".$business." 사업자 번호가 중복됩니다.</li>";
         echo "<li>사업자 번호를 확인하여 사용해 주세요!</li>";
 
      }
      else
      {
         echo "<li>".$business." 사업자 번호가 사용 가능합니다.</li>";
      }
    
      mysqli_close($con);
   }
?>
</p>
<div id="close">
   <img src="./img/close.png" onclick="javascript:self.close()">
</div>
</body>
</html>

