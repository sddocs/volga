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
    $product = DateBase::findProduct((int)$_GET['id_product']);
    $user = DateBase::findUser($_COOKIE['user_login'], $_COOKIE['user_password']);
    if (isset($_POST['create_custom'])){
        $comment = trim(htmlspecialchars($_POST['custom_comment']));
        $address = trim(htmlspecialchars($_POST['custom_address']));
        DateBase::createCustom($user['id'], $product['id'], 0, $address, $product['total'], $comment );
        $new_balance = (float)($user['balance'] - $product['total']);
        DateBase::editUserBalance($user['id'], $new_balance);
        header('Location: products.php');
        die();
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Оформление заказа</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/create_custom.css">
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
        <div class="custom-information">
            <a href="products.php">Вернуться к списку товаров</a>
            <h1>Информация по товару</h1>
            <div class="product_information">
                <p>Название: <?= $product['title']; ?></p>
                <p>Описание: <?= $product['description']; ?></>
                <p>Цена: <?= $product['total'] ?></p>
            </div>
        </div>

        <h1>Форма оформления заказа</h1>
        <div class="create_custom">
            <form action="create_custom.php?id_product=<?= $_GET['id_product']; ?>" method="post" id="form-create-custom">
                <p>
                    <label for="custom_address">Адрес доставки</label><br>
                    <textarea name="custom_address" id="custom_address" cols="30" rows="10" required></textarea>
                </p>
                <p>
                    <label for="custom_comment">Комментарий к заказу</label><br>
                    <textarea name="custom_comment" id="custom_comment" cols="30" rows="10" required></textarea>
                </p>
                <?php if ($user['balance'] < $product['total']): ?>
                    <button type="submit" class="btn btn-warning" name="create_custom" disabled>Недостаточно средств</button>
                <?php else: ?>
                    <button type="submit" class="btn btn-primary" name="create_custom">Оформить заказ</button>
                <?php endif; ?>
            </form>
        </div>

    </div>
</div>

</body>
</html>