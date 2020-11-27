<?php 
    session_start();
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";

    if (isset($_SESSION["business_number"])) $businessnum = $_SESSION["business_number"];
    else $businessnum = "";
    
    if (isset($_SESSION["username"])) $username = $_SESSION["username"];
    else $username = "";
?>

<div class="header">
    <a href="#" class="header_logo">¤ Righteous</a>
    <nav>
        <ul class="header_menu">
            <li><a href="#about">about</a></li>
            <li><a href="logout.php">logout</a></li>
            <?php
                if(!$userid){ // 사장님
            ?>
            <li><a href="restaurant.php">가게 가기</a></li>
            <?php
                } else {
            ?>
            <li><a href="#portfolio">주문하러 가기</a></li>    
            <?php 
                }
            ?>
            <li><a href="https://github.com/piaochung">github</a></li>
            <li><a href="https://hangjastar.tistory.com/">blog</a></li>
        </ul>
    </nav>
</div>