<?php
    require_once 'DateBase.php';
    if (isset($_POST['sign'])){
        $login = htmlspecialchars($_POST['user_login']);
        $password = htmlspecialchars($_POST['user_password']);
        $user = DateBase::findUser($login, $password);
        if (!empty($user)){
            setcookie('user_login', $login, time() + 3600*24);
            setcookie('user_password', $password, time() + 3600*24);
            header('Location: products.php');
            die();
        }
        else{
            echo 'Логин или пароль введен неверно!';
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
    <title>Авторизация</title>
    <link rel="stylesheet" href="../css/sign.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>

<div class="main">
    <div class="container">
        <form action="" method="post">
            <p>
                <label for="user_login">Логин</label>
                <input type="text" name="user_login" required value="<?php if (isset($_COOKIE['user_login'])) echo $_COOKIE['user_login']; ?>">
            </p>
            <p>
                <label for="user_password">Пароль</label>
                <input type="password" name="user_password" required value="<?php if (isset($_COOKIE['user_password'])) echo $_COOKIE['user_password']; ?>">
            </p>
            <button type="submit" class="btn btn-primary" name="sign">Войти</button>
            <a href="register.php">Зарегистрироваться</a>
        </form>
    </div>
</div>

</body>
</html>