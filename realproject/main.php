<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¤ Righteous</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/modal.css">
</head>
<body>
     <!--Header-->
     <header>
    	<?php include "header.php";?>
    </header>

    <?php 
        if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
        else $userid = "";
    
        if (isset($_SESSION["business_number"])) $businessnum = $_SESSION["business_number"];
        else $businessnum = "";

        if(!$userid && !$businessnum){
            echo "
                <script>
                    alert('회원가입 후 이용 부탁드립니다.');
                    location.href = 'index.php';
                </script>
            ";
    }
    ?>
 
    <div class="wrap">
        <!--About-->
        <section id="about">
            <div class="about_wrap">
                <div class="about_slide">
                    <div class="about_slides fade">
                        <img src="img/main/slide1.jpg" style="width:100%;">
                        <span class="mask one"></span>
                        <span class="mask two"></span>
                        <span class="mask three"></span>
                        <span class="mask four"></span>
                    </div>
                    <div class="about_slides fade">
                        <img src="img/main/slide2.jpg" style="width:100%;">
                        <span class="mask one"></span>
                        <span class="mask two"></span>
                        <span class="mask three"></span>
                        <span class="mask four"></span>
                    </div>
                    <div class="about_slides fade">
                        <img src="img/main/slide3.jpg" style="width:100%;">
                        <span class="mask one"></span>
                        <span class="mask two"></span>
                        <span class="mask three"></span>
                        <span class="mask four"></span>
                    </div>
                </div>
            </div>
        </section>

        <!--Portfolio-->
        <section id="portfolio">
            <div class="portfolio_wrap">
                <div class="portfolio_box">
                <h3>메뉴 소개</h3>
                </div>
                <div class="columns">
                    <?php 
                        $con = mysqli_connect("localhost", "root", "", "project");
                        $sql = "select * from restaurant order by order_number desc";

                        $result = mysqli_query($con, $sql);
                        $total_record = mysqli_num_rows($result); // 전체 글 수
                        
                        for($i=0; $i < $total_record; $i++){
                            mysqli_data_seek($result, $i);
                            // 가져올 레코드로 위치(포인터) 이동
                            $row = mysqli_fetch_array($result);
                        
                            $motto = $row["motto"];
                            $business_number = $row["business_number"];
                            $order_number = $row["order_number"];
                            $file_copied = $row["file_copied"];

                            if ($row["file_name"])
                                $file_image = "<img src='./data/$business_number/$file_copied'>";
                            else
                                $file_image = " ";

                            ?>
                            <figure>
                                <form action="order.php" method="post" name="order_form">
                                    <?=$file_image?>
                                    <input name="business" type="hidden" value="<?=$business_number?>">
                                    <figcaption><?=$motto?></figcaption>
                                    <div class="middle">
                                        <button type="submit">주문하기</button>
                                    </div>
                                </form>
                            </figure>
                        <?php
                        }
                    ?>
                </div>
            </div>
        </section>

        <!--Footer-->
        <footer>
            <?php include "footer.php";?>
            <div class="box">
                <h2>무엇을 하는지에 따라 어떤 사람인지 결정된다.<br>
                    What we dwell on is who we become</h2>
            </div>
        </footer>
        
    </div>
    <script src='main.js'></script>
</body>

</html>