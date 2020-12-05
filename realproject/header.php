<?php 
    session_start();
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";

    if (isset($_SESSION["business_number"])) $businessnum = $_SESSION["business_number"];
    else $businessnum = "";
    
    echo "<h1>$businessnum</h1>";
    echo "<h1>$userid</h1>";

    if (isset($_SESSION["username"])) $username = $_SESSION["username"];
    else $username = "";
?>

<div class="header">
    <a href="#" class="header_logo">¤ Righteous</a>
    <nav>
        <ul class="header_menu">
            <?php
                if(!$userid && !$businessnum){
            ?>
            <li><a href="sign_up_check_form.php">회원 가입</a></li>
            <?php
                } else {
            ?>
                 <?php
                if(!$userid){ // 사장님
                ?>
                <li><a href="order_confirm_lately_form.php">최근 배달 내역 확인</a></li>
                <li><a href="order_complete_form.php">배달 내역</a></li>
                <?php
                    } else {
                ?>
                <li><a href="order_history_form.php">주문 보류 내역</a></li>
                <li><a href="order_complete_form.php">주문 완료 내역</a></li>
                <?php 
                    }
                ?>
                <li><a href="logout.php">로그아웃</a></li>
                <?php
                    if(!$userid){ // 사장님
                ?>
                <li><a href="restaurant_register_form.php">가게 등록</a></li>
                <?php
                    } else {
                ?>
                <li><a href="#portfolio">주문하기</a></li>    
                <?php 
                    }
                ?>
                <?php 
                    }
                ?>
                <li><a href="https://github.com/piaochung">github</a></li>
                <li><a href="https://hangjastar.tistory.com/">blog</a></li>
            <!--위에는 테스트입니다.-->
        </ul>
    </nav>
</div>