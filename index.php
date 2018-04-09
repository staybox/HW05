<?php

// Включаем вывод ошибок
ini_set('display_errors', 1);
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
function load($name)
{
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

if (!empty($_GET['logout'])) {
    $_SESSION["user"] = null;
    header("Location: /");
}

// Стартовая страница
if ($_SERVER['REQUEST_URI'] == "/") {
    user();
    load('core/MainController.php');
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
    load('core/MainController.php');
    load('models/User.php');
    load('controllers/UserController.php');
    load('core/view.php');
    $controllers = new UserController();
    $controllers->reg();
    return 0;
}

// Страница списка пользователей
if ($_SERVER['REQUEST_URI'] == "/list.php") {
    $user = user();
    if (empty($user)) {
        header("Location: /");
    }
    load('core/MainController.php');
    load('models/User.php');
    load('controllers/UserController.php');
    load('core/view.php');
    $controllers = new UserController();
    $controllers->list();
    return 0;
}

// Страница filelist
if ($_SERVER['REQUEST_URI'] == "/filelist.php") {
    $user = user();
    if (empty($user)) {
        header("Location: /");
    }
    load('core/MainController.php');
    load('models/User.php');
    load('controllers/UserController.php');
    load('core/view.php');
    $controllers = new UserController();
    $controllers->filelist();
    return 0;
}

// Удаление картинки пользователя
if (!empty($_GET['remove_userpic'])) {
    user();
    load('core/MainController.php');
    load('models/User.php');
    load('controllers/UserController.php');
    load('core/view.php');
    $controllers = new UserController();
    $controllers->removeImage();
    return 0;
}

// Регистрация
if ($_SERVER['REQUEST_URI'] == "/registration/add") {
    //var_dump($_POST);
    $user = user();
    load('core/MainController.php');
    load('models/User.php');
    load('controllers/UserController.php');
    load('core/view.php');
    $controllers = new UserController();
    $controllers->registration();
    return 0;
}

// Авторизация
if ($_SERVER['REQUEST_URI'] == "/enter") {
    //var_dump($_POST);
    $user = user();
    load('core/MainController.php');
    load('models/User.php');
    load('controllers/UserController.php');
    load('core/view.php');
    $controllers = new UserController();
    $controllers->checkAuth();
    return 0;
}

// Удаление пользователя
if (!empty($_GET['remove_user_id'])) {
    //var_dump("Удалить пользователя");
    user();
    load('core/MainController.php');
    load('models/User.php');
    load('controllers/UserController.php');
    load('core/view.php');
    $controllers = new UserController();
    $controllers->removeUser();
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
