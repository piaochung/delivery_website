<?php
  session_start();
  unset($_SESSION["userid"]);
  unset($_SESSION["username"]);
  unset($_SESSION["business_number"]);
  
  echo("
       <script>
          location.href = 'index.php';
         </script>
       ");
?>
