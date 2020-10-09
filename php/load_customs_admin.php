<?php
    require_once 'DateBase.php';
    if (isset($_POST['edit']) && $_POST['edit'] == 'remove'){
        DateBase::removeCustom((int)$_POST['remove_custom']);
    }
    if (isset($_POST['confirm_custom']) && $_POST['edit'] == 'confirm'){
        DateBase::confirmCustom((int)$_POST['confirm_custom']);
    }
    $customs = DateBase::getAllCustoms();
?>

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
                    <td><button type="submit" id="remove_custom-<?= $custom['id']; ?>" name="remove_custom" value="<?= $custom['id']; ?>">Удалить заказ</button></td>
                    <?php if ($custom['status_purchase'] == 0): ?>
                        <td><button type="submit" id="confirm_custom-<?= $custom['id']; ?>" name="confirm_custom" value="<?= $custom['id']; ?>">Подтвердить заказ</button></td>
                    <?php endif; ?>
                </tr>
            </form>
        </div>
    <?php endforeach; ?>
</table>
