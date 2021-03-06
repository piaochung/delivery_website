<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" href="css/header.css">
<link rel="stylesheet" href="css/login.css">
<link rel="stylesheet" href="css/footer.css">
<script>
    function check_input()
    {
        if (!document.login_form.id.value)
        {
            alert("아이디를 입력하세요");    
            document.login_form.id.focus();
            return;
        }

        if (!document.login_form.pass.value)
        {
            alert("비밀번호를 입력하세요");    
            document.login_form.pass.focus();
            return;
        }
        document.login_form.submit();
    }
</script>
</head>
<body> 
    <?php 
        $login = $_POST["login_info"];
    ?>

	<header>
    	<?php include "header.php";?>
    </header>
	<section>
        <div id="main_content">
      		<div id="login_box">
	    		<div id="login_title">
		    		<span>로그인</span>
	    		</div>
	    		<div id="login_form">
          		<form  name="login_form" method="post" action="sign_in.php">
                    <ul>
                    <?php 
                        if($login == "customer"){
                            echo "<li><input type='text' name='id' placeholder='아이디' ></li>";
                            echo "<input type='hidden' name='login_info' value='customer'>";
                        }
                        else if($login == "business"){
                            echo "<li><input type='text' name='id' placeholder='사업자 번호' ></li>";
                            echo "<input type='hidden' name='login_info' value='business'>";
                        }
                    ?>		       	
                        <li><input type="password" id="pass" name="pass" placeholder="비밀번호" ></li> <!-- pass -->
                  	</ul>
                  	<div id="login_btn">
                        <button type="button" onclick="check_input()">Login</button>
                  	</div>		    	
           		</form>
        		</div> <!-- login_form -->
    		</div> <!-- login_box -->
        </div> <!-- main_content -->
	</section> 
	<footer>
    	<?php include "footer.php";?>
    </footer>
</body>
</html>

