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
                                $file_image = "<img src='./data/$file_copied'>";
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
                    <figure>
                            <img src="img/main/1.jpg">
                            <figcaption>먹고자 하면 먹을 것이오 못 먹고자 하면 못 먹을 것이다.</figcaption>
                            <div class="middle">
                                <div class="text" onclick="document.getElementById('id01').style.display='block'">주문하기</div>
                            </div>
                    </figure>
                    <figure>
                        <a href="restaurant.php">
                            <img src="img/main/2.png">
                            <figcaption>인생은 고기서 고기다.</figcaption>
                            <div class="middle">
                                <div class="text">주문하기</div>
                            </div>
                        </a>
                    </figure>
                    <figure>
                        <a href="restaurant.php">
                            <img src="img/main/3.jpg">
                            <figcaption>오늘은 먹고 다이어트는 내일부터</figcaption>
                            <div class="middle">
                                <div class="text">주문하기</div>
                            </div>
                        </a>
                    </figure>
                    <figure>
                        <a href="restaurant.php">
                            <img src="img/main/4.jpg">
                            <figcaption>먹겠다는 의지가 있다면 위장은 더 커질 수 있다.</figcaption>
                            <div class="middle">
                                <div class="text">주문하기</div>
                            </div>
                        </a>
                    </figure>
                    <figure>
                        <a href="restaurant.php">
                            <img src="img/main/5.jpg">
                            <figcaption>좋은 음식은 공복인 아침에 먹어야 한다.</figcaption>
                            <div class="middle">
                                <div class="text">주문하기</div>
                            </div>
                        </a>
                    </figure>
                    <figure>
                        <a href="restaurant.php">
                            <img src="img/main/6.png">
                            <figcaption>맛있는 음식 앞에 배부름이란 없다.</figcaption>
                            <div class="middle">
                                <div class="text">주문하기</div>
                            </div>
                        </a>
                    </figure>
                    <figure>
                        <a href="restaurant.php">
                            <img src="img/main//7.png">
                            <figcaption>어떻게 먹을 지 고민할 시간에 한 개라도 더 먹어라.</figcaption>
                            <div class="middle">
                                <div class="text">주문하기</div>
                            </div>
                        </a>
                    </figure>
                    <figure>
                        <a href="restaurant.php">
                            <img src="img/main/8.png">
                            <figcaption>내게 커피를 주시오, 아니면 죽음을 주시오.</figcaption>
                            <div class="middle">
                                <div class="text">주문하기</div>
                            </div>
                        </a>
                    </figure>
                    <figure>
                        <a href="restaurant.php">
                            <img src="img/main/9.jfif">
                            <figcaption>Q. 가장 좋아하는 햄버거 브랜드는? A. 가까운 거.</figcaption>
                            <div class="middle">
                                <div class="text">주문하기</div>
                            </div>
                        </a>
                    </figure>
                    <figure>
                        <a href="restaurant.php">
                            <img src="img/main/10.jpg">
                            <figcaption>텀블러 하나 가져가</figcaption>
                            <div class="middle">
                                <div class="text">주문하기</div>
                            </div>
                        </a>
                    </figure>
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