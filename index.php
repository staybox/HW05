<?php

// Включаем вывод ошибок
ini_set('display_errors', 1);
error_reporting(E_ALL);

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
// Админка
if ($_SERVER['REQUEST_URI'] == "/admin.php") {
    user();
    load('core/MainController.php');
    load('models/User.php');
    load('controllers/UserController.php');
    load('core/view.php');
    $controllers = new UserController();
    $controllers->admin();
    return 0;
}

// Форма админки ввод
if ($_SERVER['REQUEST_URI'] == "/admin/add") {
    user();
    load('core/MainController.php');
    load('models/User.php');
    load('controllers/UserController.php');
    load('core/view.php');
    $controllers = new UserController();
    $controllers->adminForm();
    return 0;
}

// Отображение формы редактирования пользователя
if (!empty($_GET['edit_user_id'])) {
    user();
    load('core/MainController.php');
    load('models/User.php');
    load('controllers/UserController.php');
    load('core/view.php');
    $controllers = new UserController();

    if (!empty($_FILES)) {
       // $controllers->update($_POST);
    }

    if (!empty($_POST)) {
        $controllers->update($_POST);
        return 0;
    }
    $controllers->edit($_GET['edit_user_id']);
    return 0;
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

// такой страницы нет
//header("HTTP/1.0 404 Not Found");

