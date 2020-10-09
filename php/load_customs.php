<?php
    require_once 'DateBase.php';
    $results = DateBase::FilterCustomsForStatus((int)$_POST['status']);
    $user = DateBase::findUser($_COOKIE['user_login'], $_COOKIE['user_password']);
    $customers = DateBase::getCustoms((int)$user['id']);
?>

<table border="1">
    <tr>
        <th>Название товара</th>
        <th>Описание товара</th>
        <th>Адрес</th>
        <th>Дата оформления</th>
        <th>Статус</th>
        <th>Сумма заказа</th>
    </tr>
    <?php foreach ($customers as $customer): ?>
        <div class="custom">
            <?php $product = DateBase::findProduct((int)$customer['id_product']); ?>
            <tr>
                <td><?= $product['title']; ?></td>
                <td><?= $product['description']; ?></td>
                <td><?= $customer['address']; ?></td>
                <td><?= $customer['date_purchase']; ?></td>
                <td><?= $customer['status_purchase']; ?></td>
                <td><?= $product['total']; ?></td>
                <td><a href="custom.php?id_custom=<?= $customer['id']; ?>">Подробнее</a></td>
            </tr>
        </div>
    <?php endforeach; ?>
</table>