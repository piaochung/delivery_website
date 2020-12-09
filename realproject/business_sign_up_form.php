<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" href="css/header.css">
<link rel="stylesheet" href="css/member.css">
<link rel="stylesheet" href="css/footer.css">

<script>
   function check_input()
   {
        if(!document.member_form.business_number.value) {
            alert("사업자 번호를 입력하세요!");
            document.member_form.business_number.focus();
            return;
        }

        if(document.member_form.business_number.value.length < 10){
            alert("사업자 번호가 짧아요.");
            return;
        }

        if (!document.member_form.pass.value) {
            alert("비밀번호를 입력하세요!");    
            document.member_form.pass.focus();
            return;
        }

        if (!document.member_form.pass_confirm.value) {
            alert("비밀번호확인을 입력하세요!");    
            document.member_form.pass_confirm.focus();
            return;
        }

        if (!document.member_form.name.value) {
            alert("이름을 입력하세요!");    
            document.member_form.name.focus();
            return;
        }

        if (!document.member_form.email1.value) {
            alert("이메일 주소를 입력하세요!");    
            document.member_form.email1.focus();
            return;
        }

        if (!document.member_form.email2.value) {
            alert("이메일 주소를 입력하세요!");    
            document.member_form.email2.focus();
            return;
        }

        if (document.member_form.pass.value != 
                document.member_form.pass_confirm.value) {
            alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요!");
            document.member_form.pass.focus();
            document.member_form.pass.select();
            return;
        }

        /*
        if(id != document.member_form.business_number.value){
            alert("아아디가 이상합니다");
        }
        */

        document.member_form.submit();

   }

   function reset_form() {
      document.member_form.business_number.value = "";
      document.member_form.pass.value = "";
      document.member_form.pass_confirm.value = "";
      document.member_form.name.value = "";
      document.member_form.email1.value = "";
      document.member_form.email2.value = "";
      document.member_form.business_number.focus();
      return;
   }

   function duplicate_check(){
        alert("아이디 중복체크를 해주세요");
   }

   function check_id() {
     window.open("business_sign_up_check_business_number.php?business_number=" + document.member_form.business_number.value,
         "IDcheck",
          "left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes");
   }
</script>
</head>
<body>
	<header>
        <?php include "header.php";?>
    </header>
	<section>
        <div id="main_content">
      		<div id="join_box">
          	<form  name="member_form" method="post" action="business_sign_up_insert.php">
			       	<div class="clear"></div>
                       <div class="form">
				        <div class="col1">사업자 번호</div>
				        <div class="col2">
							<input type="text" name="business_number" maxlength="10">
				        </div> 
                        <div class="col3">
				        	<a href="#"><img src="./img/signup/confirm_id_button.png" 
				        		onclick="check_id()"></a>
				        </div>                     
			       	</div>
			       	<div class="form">
				        <div class="col1">비밀번호</div>
				        <div class="col2">
							<input type="password" name="pass">
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
			       	<div class="form">
				        <div class="col1">비밀번호 확인</div>
				        <div class="col2">
							<input type="password" name="pass_confirm">
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
			       	<div class="form">
				        <div class="col1">이름</div>
				        <div class="col2">
							<input type="text" name="name">
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
			       	<div class="form email">
				        <div class="col1">이메일</div>
				        <div class="col2">
                            <input type="text" name="email1">@
                            <select name="email2">
                                <option value="">이메일 선택</option>
                                <option value="gmail.com">gmail.com</option>
                                <option value="naver.com">naver.com</option>
                                <option value="nate.com">nate.com</option>
                            </select>
				        </div>                 
			       	</div>
                       <div class="clear"></div>
			       	<div class="bottom_line"> </div>
			       	<div class="buttons">
                        <?php 
                            if(isset($_COOKIE["business_number"])){
                                $iname = $_COOKIE['business_number'];
                                echo "<h4>$iname</h4>";
                                echo "<button type='button' onclick='check_input()'>create account2</button>";
                            } else {
                                echo "<button type='button' onclick='duplicate_check()'>create account</button>";
                            }
                        ?>
                       <button type="button" onclick="reset_form()">reset</button>
	           		</div>
           	</form>
        	</div> <!-- join_box -->
        </div> <!-- main_content -->
	</section> 
	<footer>
    	<?php include "footer.php";?>
    </footer>
</body>
</html>

