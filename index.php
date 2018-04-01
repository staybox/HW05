<?php

// Включаем вывод ошибок
ini_set('display_errors',1);
error_reporting(E_ALL);
/*
// Подключение файлов
define('ROOT', dirname(__FILE__));
require_once (ROOT.'/components/router.php');

$router = new Router();
$router->run();
*/

// начинаем работать с сессией
session_start();

// Функция загрузки необходимых файлов
function load ($name){
    $appDir = realpath(__DIR__ . '/src');
    require_once($appDir .DIRECTORY_SEPARATOR . $name);
}

function user()
{
    $user = null;

    if (!empty($_SESSION["user"])) {
        $user = $_SESSION["user"];
    }

    return $user;
}

// Стартовая страница
if ($_SERVER['REQUEST_URI'] == "/") {
    user();
    load('models/User.php');
    load('controllers/UserController.php');
    load('core/view.php');
    $controllers = new UserController();
    $controllers->index();
    return 0;
}

// Страница регистрации
if ($_SERVER['REQUEST_URI'] == "/reg.php") {
    user();
    load('models/User.php');
    load('controllers/UserController.php');
    load('core/view.php');
    $controllers = new UserController();
    $controllers->reg();
    return 0;
}

// Страница списка пользователей
if ($_SERVER['REQUEST_URI'] == "/list.php") {
    user();
    load('models/User.php');
    load('controllers/UserController.php');
    load('core/view.php');
    $controllers = new UserController();
    $controllers->list();
    return 0;
}

// Страница filelist
if ($_SERVER['REQUEST_URI'] == "/filelist.php") {
    user();
    load('models/User.php');
    load('controllers/UserController.php');
    load('core/view.php');
    $controllers = new UserController();
    $controllers->filelist();
    return 0;
}


// стартовая страница
/*
if ($_SERVER['REQUEST_URI'] == "/") {
    require_once($appDir .DIRECTORY_SEPARATOR . 'template.php');
    return 0;
}
*//*
// добавляем в базу
if (!empty($_POST) && $_SERVER['REQUEST_URI'] == "/order/add") {
    include_once($appDir .DIRECTORY_SEPARATOR . 'order.php');
    return 0;
}

// просмотр пользователей (административная панель)
if ($_SERVER['REQUEST_URI'] == "/admin/users") {
    include_once($appDir .DIRECTORY_SEPARATOR . 'admin.php');
    return 0;
}

// просмотр заказов (административная панель)
if ($_SERVER['REQUEST_URI'] == "/admin/orders") {
    // тут код вывода
    return 0;
}

// обработка ошибок
if (strpos($_SERVER['REQUEST_URI'], 'errcode') > 0) {
    require_once($appDir . '/error.php');
    return;
}

// такой страницы нет
header("HTTP/1.0 404 Not Found");
//!empty($_POST) &&*/