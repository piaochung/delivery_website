<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="sign_in_form.php" >
        <div id="login_check">
            <input type="radio" name="login_info" value="customer" checked="checked">고객님
            <input type="radio" name="login_info" value="business">사장님
            <hr>
            <input type="submit" value="출력하기">
        </div>
    </form>
</body>
</html>