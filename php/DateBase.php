<?php

class DateBase
{

    private static $db = null;

    public static function getConnect(){
        if (self::$db === null){
            self::$db = new PDO('mysql:host=localhost;dbname=purchases;charset=utf8', 'root', '');
        }
        return self::$db;
    }

    public static function getProducts(){
        $query = self::getConnect()->prepare("SELECT * FROM `products`");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function registerUser($login, $password, $balance){
        $query = self::getConnect()->prepare("INSERT INTO `users` SET `login` = ?, `password` = ?, `balance` = ? ");
        $query->execute(array("{$login}", "{$password}", $balance));
    }

    public static function findUser($login, $password){
        $query = self::getConnect()->prepare("SELECT * FROM `users` WHERE `login` = ? and `password` = ? ");
        $query->execute(array("{$login}", "{$password}"));
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public static function getCustoms($id){
        $query = self::getConnect()->prepare("SELECT * FROM `customs` WHERE  `id_user` = ? ");
        $query->execute(array($id));
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findProduct($id){
        $query = self::getConnect()->prepare("SELECT * FROM `products` WHERE  `id` = ? ");
        $query->execute(array($id));
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public static function FilterCustomsForStatus($status){
        if ($status === 0){
            $status = "ASC";
        }
        else{
            $status = "DESC";
        }
        $query = self::getConnect()->prepare("SELECT * FROM `customs` ORDER BY `status_purchase` = ? ");
        $query->execute(array($status));
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getCustomForId($id){
        $query = self::getConnect()->prepare("SELECT * FROM `customs` WHERE `id` = ? ");
        $query->execute(array($id));
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public static function createCustom($id_user, $id_product, $status, $address, $sum, $comment){
        $date = date("Y-m-d H:i:s");
        $query = self::getConnect()->prepare("INSERT INTO `customs` SET `id_user` = ?, `id_product` = ?, `date_purchase` = ?, `status_purchase` = ?, `address` = ?, `sum_custom` = ?, `comment` = ? ");
        $query->execute(array($id_user, $id_product, "{$date}", $status, "{$address}", $sum, "{$comment}"));
    }

    public static function editUserBalance($id, $new_balance){
        $query = self::getConnect()->prepare("UPDATE `users` SET `balance` = ? WHERE `id` = ?");
        $query->execute(array($new_balance, $id));
    }

    public static function getAllCustoms(){
        $query = self::getConnect()->prepare("SELECT * FROM `customs`");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function removeCustom($id){
        $query = self::getConnect()->prepare("DELETE FROM `customs` WHERE `id` = ? ");
        $query->execute(array($id));
    }

    public static function confirmCustom($id){
        $query = self::getConnect()->prepare("UPDATE `customs` SET `status_purchase` = ? WHERE `id` = ?");
        $query->execute(array(1, $id));
    }

}