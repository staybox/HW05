<?php
// Модуль для подключения к базе
// На выходе:  $dbh
// Файл с параметрами подключения
$config = require_once ('config.php');

try {
    // Подключаемся к базе через PDO, обрабатываем ошибки и затем передаем параметры в объект PDO
    $dsn = "mysql:host=" . $config["db"]['host'] . ";" . "dbname=" . $config["db"]['dbname'] . ";" . "charset=" . $config["db"]['charset'];
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ];
    // Подключаемся к базе
    $dbh = new PDO($dsn, $config['db']['user'], $config['db']['password'], $opt);
    // Всё нормально - отдаём $dbh
    //return $dbh;
} catch (PDOException $e) {
    return false;
}


$login = $_POST['login'];
// Ищем пользователя по email
try {
    $sth = $dbh->prepare('SELECT user_id FROM users WHERE login = :login');
    $sth->execute(array('login' => $login));
    $userId = $sth->fetchColumn();
} catch (PDOException $e) {
    return null;
}
if ($userId === false) {
    // Нет такого пользователя. Создаём.
    $LOGIN = "login4567";
    $PASSWORD = "12121";
    $NAME = "lalal";
    $AGE = "111";
    $DESCRIPTION = "sdsds";
    $PHOTO = "asasasddd";
    try {
        $sth = $dbh->prepare("INSERT INTO users(`LOGIN`, `PASSWORD`, `NAME`, `AGE`, `DESCRIPTION`, `PHOTO`) VALUES (:login,:password,:name,:age,:desc,:link_photo)");
        $sth->execute(array(
            ':login' => $LOGIN,
            ':password' => $PASSWORD,
            ':name' => $NAME,
            ':age' => $AGE,
            ':desc' => $DESCRIPTION,
            ':link_photo' => $PHOTO
        ));
        $userId = $dbh->lastInsertId();
    } catch (PDOException $e) {
        return null;
    }
}
return $userId;