<?php
    require_once 'DateBase.php';
    if (isset($_POST['exit'])){
        unset($_COOKIE['user_login']);
        unset($_COOKIE['user_password']);
        header('Location: sign.php');
        die();
    }
    $custom = DateBase::getCustomForId((int)$_GET['id_custom']);
    if (empty($_COOKIE['user_login']) or empty($_COOKIE['user_password'])){
        header('Location: sign.php');
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Страница заказа</title>
</head>
<body>

<div class="main">
    <div class="container">
        <div class="custom">
            <a href="personal_cabinet.php">Вернуться к списку заказов</a>
            <h1>Информация по заказу</h1>
            <div class="custom_information">
                <h1>Номер заказа: <?= $custom['id']; ?></h1>
                <p>Комментарий: <br><br> <i><?= $custom['comment'] ?></i></p>
                <p>Дата оформления: <?= date('Y-m-d H:i', strtotime($custom['date_purchase'])); ?></p>
                <p>Статус: <?php if ($custom['status_purchase'] === 0) {echo "Оформленно"; } else {echo "В ожидании";} ?></p>
                <p>Сумма заказа: <?= $custom['sum_custom']; ?></p>
            </div>
        </div>
    </div>
</div>

</body>
</html>