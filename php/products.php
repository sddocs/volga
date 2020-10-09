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
    $products = DateBase::getProducts();
    $user = DateBase::findUser($_COOKIE['user_login'], $_COOKIE['user_password']);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Список товаров</title>
    <link rel="stylesheet" href="../css/products.css">
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
        <div class="person_cabinet">
            <h1>Список товаров</h1>
            <div class="products">
                <?php foreach ($products as $product): ?>
                    <div class="product card" id="product_id_<?= $product['id']; ?>">
                        <div class="card-body">
                            <h3 class="card-text">Название: <?= $product['title']; ?></h3>
                            <p class="card-text">Описание: <?= $product['description']; ?></p>
                            <p class="card-text">Цена: <?= $product['total'] ?></p>
                            <a href="create_custom.php?id_product=<?= $product['id']; ?>" class="card-text">Оформить заказ по товару</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
