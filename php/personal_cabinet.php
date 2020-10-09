<?php
    require_once 'DateBase.php';
    if (isset($_POST['exit'])){
        unset($_COOKIE['user_login']);
        unset($_COOKIE['user_password']);
        header('Location: sign.php');
        die();
    }
    if (empty($_COOKIE['user_login']) or empty($_COOKIE['user_password'])) {
        header('Location: sign.php');
    }
    $user = DateBase::findUser($_COOKIE['user_login'], $_COOKIE['user_password']);
    $customs = DateBase::getCustoms((int)$user['id']);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/personal_cabinet.css">
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
        <p id="current_balance">Текущий баланс: <?= $user['balance']; ?></p>
        <h1>Фильтрация</h1>
        <div class="filters">
            <select name="custom_status" id="custom_status">
                <option value="0">Оформлено</option>
                <option value="1">В ожидании</option>
            </select>
            <select name="custom_total" id="custom_total">
                <option value="1"><1000 рублей</option>
                <option value="2">2000-5000 рублей</option>
                <option value="3">>10000 рублей</option>
            </select>
            <select name="custom_date" id="custom_date">
                <option value="1">Текущий год</option>
                <option value="2">Старые года</option>
            </select>
        </div>
        <br>
        <div class="search">
            <label for="search">Поиск</label>
            <input type="text" name="search" id="search">
        </div>
        <h1>Список заказов</h1>
        <div class="customs">
            <table border="1">
                <tr>
                    <th>Название товара</th>
                    <th>Описание товара</th>
                    <th>Адрес</th>
                    <th>Дата оформления</th>
                    <th>Статус</th>
                    <th>Сумма заказа</th>
                </tr>
                <?php foreach ($customs as $custom): ?>
                    <div class="custom">
                        <?php $product = DateBase::findProduct((int)$custom['id_product']); ?>
                        <tr>
                            <td><?= $product['title']; ?></td>
                            <td><?= $product['description']; ?></td>
                            <td><?= $custom['address']; ?></td>
                            <td><?= $custom['date_purchase']; ?></td>
                            <td><?= $custom['status_purchase']; ?></td>
                            <td><?= $product['total']; ?></td>
                            <td><a href="custom.php?id_custom=<?= $custom['id']; ?>">Подробнее</a></td>
                        </tr>
                    </div>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../scripts/personal_cabinet.js"></script>
</body>
</html>