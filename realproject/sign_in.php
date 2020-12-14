<?php
    $id   = $_POST["id"];
    $pass = $_POST["pass"];
    $login = $_POST["login_info"];

   $con = mysqli_connect("localhost", "root", "", "project");
   
   if($login == "customer"){
    $sql = "select * from customer_members where id='$id'";
   } else if($login == "business"){
    $sql = "select * from business_members where business_number='$id'";
   }

   $result = mysqli_query($con, $sql);

   $num_match = mysqli_num_rows($result);

   if(!$num_match) 
   {
     if($login == "customer"){
       echo("
             <script>
               window.alert('등록되지 않은 아이디입니다!');
               location.href = 'index.php';
             </script>
           ");
     } else {
      echo("
            <script>
              window.alert('등록되지 않은 사업자 번호입니다!');
              location.href = 'index.php';
            </script>
          ");
     }
    }
    else
    {
        $row = mysqli_fetch_array($result);
        $db_pass = $row["pass"];

        mysqli_close($con);

        if($pass != $db_pass)
        {
           echo("
              <script>
                window.alert('비밀번호가 틀립니다!');
                location.href = 'index.php';
              </script>
           ");
           exit;
        }
        else
        {
            session_start();

            if($login == "customer"){
              $_SESSION["userid"] = $row["id"];
              $_SESSION["username"] = $row["name"];
             } 
             else if($login == "business"){
              $_SESSION["business_number"] = $row["business_number"];
             }
           
            echo("
              <script>
                location.href = 'main.php';
              </script>
            ");
        }
     }        
?>
