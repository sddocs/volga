<?php
    require_once 'DateBase.php';
    if (isset($_POST['exit'])){
        unset($_COOKIE['user_login']);
        unset($_COOKIE['user_password']);
        header('Location: sign.php');
        die();
    }
    if (empty($_COOKIE['user_login']) or empty($_COOKIE['user_password'])){
        header('Location: sign.php');
    }
    if (isset($_POST['remove_custom'])){
        DateBase::removeCustom((int)$_POST['remove_custom']);
        header("Location: {$_SERVER['PHP_SELF']}");
        die();
    }
    if (isset($_POST['confirm_custom'])){
        DateBase::confirmCustom((int)$_POST['confirm_custom']);
        header("Location: {$_SERVER['PHP_SELF']}");
        die();
    }
    $customs = DateBase::getAllCustoms();
    $user = DateBase::findUser($_COOKIE['user_login'], $_COOKIE['user_password']);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Администрирование</title>
    <link rel="stylesheet" href="../css/administration.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>

<header>
    <div class="container">
        <div class="menu">
            <a href="personal_cabinet.php">Личный кабинет</a>
            <?php if ($user['status'] == 1): ?>
                <a href="administration.php">Администрирование</a>
            <?php endif; ?>
            <form action="" method="post">
                <button type="submit" class="btn btn-primary" name="exit">Выйти</button>
            </form>
        </div>
    </div>
</header>

<div class="main">
    <div class="container">
        <a href="products.php">Вернуться к списку товаров</a>
        <h1>Список заказов пользователей</h1>
        <div class="customs">
            <table border="1">
                <tr>
                    <th>Пользователь</th>
                    <th>Название товара</th>
                    <th>Описание товара</th>
                    <th>Адрес</th>
                    <th>Дата оформления</th>
                    <th>Статус</th>
                    <th>Сумма заказа</th>
                </tr>
                <?php foreach ($customs as $custom): ?>
                    <div class="custom">
                        <form action="" method="post" id="control_custom">
                            <?php $product = DateBase::findProduct((int)$custom['id_product']); ?>
                            <?php $user = DateBase::findUser($_COOKIE['user_login'], $_COOKIE['user_password']); ?>
                            <tr>
                                <td><?= $user['login']; ?></td>
                                <td><?= $product['title']; ?></td>
                                <td><?= $product['description']; ?></td>
                                <td><?= $custom['address']; ?></td>
                                <td><?= $custom['date_purchase']; ?></td>
                                <td><?= $custom['status_purchase']; ?></td>
                                <td><?= $product['total']; ?></td>
                                <td><button type="submit" class="btn btn-danger" id="remove_custom-<?= $custom['id']; ?>" name="remove_custom" value="<?= $custom['id']; ?>">Удалить заказ</button></td>
                                <?php if ($custom['status_purchase'] == 0): ?>
                                    <td><button type="submit" class="btn btn-primary" id="confirm_custom-<?= $custom['id']; ?>" name="confirm_custom" value="<?= $custom['id']; ?>">Подтвердить заказ</button></td>
                                <?php endif; ?>
                            </tr>
                        </form>
                    </div>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../scripts/administration.js"></script>
</body>
</html>