<?php
    require_once 'DateBase.php';
    $status = (int)$_POST['custom_status'];
    $customs = DateBase::filterStatus($status);
?>

<table border="1">
    <tr>
        <th>№</th>
        <th>Адрес</th>
        <th>Комментарий</th>
        <th>Дата оформления</th>
        <th>Статус</th>
        <th>Сумма заказа</th>
    </tr>
    <?php foreach ($customs as $custom): ?>
        <div class="custom">
            <?php $product = DateBase::findProduct((int)$custom['id_product']); ?>
            <tr>
                <td><?= $custom['id']; ?></td>
                <td><?= $custom['comment']; ?></td>
                <td><?= $custom['address']; ?></td>
                <td><?= $custom['date_purchase']; ?></td>
                <td><?= $custom['status_purchase']; ?></td>
                <td><?= $custom['sum_custom']; ?></td>
                <td><a href="custom.php?id_custom=<?= $custom['id']; ?>">Подробнее</a></td>
            </tr>
        </div>
    <?php endforeach; ?>
</table>
