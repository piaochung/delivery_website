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
               window.alert('등록되지 않은 아이디입니다!')
               history.go(-1)
             </script>
           ");
     } else {
      echo("
            <script>
              window.alert('등록되지 않은 사업자 번호입니다!')
              history.go(-1)
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
                window.alert('비밀번호가 틀립니다!')
                history.go(-1)
              </script>
           ");
           exit;
        }
        else
        {
            session_start();
            $_SESSION["userid"] = $row["id"];
            $_SESSION["username"] = $row["name"];
            $_SESSION["userlevel"] = $row["level"];
            $_SESSION["userpoint"] = $row["point"];

            echo("
              <script>
                location.href = 'main.php';
              </script>
            ");
        }
     }        
?>
