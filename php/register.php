<?php
    require_once 'DateBase.php';
    if (isset($_POST['register'])){
        $login = trim(htmlspecialchars($_POST['user_login']));
        $password = $_POST['user_password'];
        $confirm_password = $_POST['user_confirm_password'];
        if ($password === $confirm_password){
            $password = $_POST['user_password'];
            DateBase::registerUser($login, $password, 2000);
            setcookie('user_login', $login, time() + 3600*24);
            setcookie('user_password', $password, time() + 3600*24);
            header('Location: products.php');
            die();
        }
        else{
            echo "Пароли не совпадают";
            die();
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация</title>
    <link rel="stylesheet" href="../css/register.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>

<div class="main">
    <div class="container">
        <div class="register">
            <form action="" method="post">
                <p>
                    <label for="user_login">Логин</label>
                    <input type="text" name="user_login" id="user_login" placeholder="Введите имя пользователя">
                </p>
                <p>
                    <label for="user_password">Пароль</label>
                    <input type="password" name="user_password" id="user_password" placeholder="Введите пароль пользователя">
                </p>
                <p>
                    <label for="user_password_confirm">Повторите пароль</label>
                    <input type="password" name="user_confirm_password" id="user_confirm_password" placeholder="Повторите пароль пользователя">
                </p>
                <button type="submit" class="btn btn-primary" name="register">Зарегистрироваться</button>
                <a href="sign.php">Войти</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>