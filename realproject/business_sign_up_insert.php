<?php
    $business = $_POST["business_number"];
    $pass = $_POST["pass"];
    $name = $_POST["name"];
    $email1  = $_POST["email1"];
    $email2  = $_POST["email2"];

    $email = $email1."@".$email2;
    $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

    $con = mysqli_connect("localhost", "root", "", "project");

	$sql = "insert into business_members(business_number, pass, name, email, regist_day) ";
	$sql .= "values('$business', '$pass', '$name', '$email', '$regist_day')";

	mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
    mysqli_close($con);     

    echo "
	      <script>
	          location.href = 'sign_in_form.php';
	      </script>
	  ";
?>

   
