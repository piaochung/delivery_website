<?php 
    $login = $_POST["sign_up_info"];

    if($login == "customer"){
        echo "
        <script>
          location.href = 'customer_sign_up_form.php';
        </script>
        ";
    } else if($login == "business"){
        echo "
        <script>
          location.href = 'business_sign_up_form.php';
        </script>
        ";
    }

?>