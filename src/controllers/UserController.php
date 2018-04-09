<?php


class UserController extends MainController
{
    public function index()
    {
        $currentPage = $_SERVER['REQUEST_URI'];
        if (!empty($_SESSION['user'])) {
            header("Location: /filelist.php");
        }

        $this->view->render('home', [], $currentPage);
    }

    public function checkAuth()
    {
        $model = new User();
        $data = ['login' => trim(strtoupper($_POST['login'])), 'password' => md5($_POST['password']),];
        // переделать
        $user = $model->auth($data);
        //var_dump($user);
        if ($user === null) {
            header("Location: /");
            return 0;
        } elseif ($user !== null) {
            $_SESSION['user'] = $data['login'];
            header("Location: /list.php");
            return 0;
        }
    }

    public function reg()
    {
        $currentPage = $_SERVER['REQUEST_URI'];
        if (!empty($_SESSION['user'])) {
            header("Location: /filelist.php");
        }
        $this->view->render('reg', [], $currentPage);
    }


    public function list()
    {
        $currentPage = $_SERVER['REQUEST_URI'];
        // Обработка из базы данных в массив
        $userModel = new User();
        $users = $userModel->getAllUsers();
        // Рендер страницы и передача туда массива из базы данных
        $this->view->render('list', ['users' => $users], $currentPage);
    }

    public function filelist()
    {
        $currentPage = $_SERVER['REQUEST_URI'];
        $modelShowFiles = new User();
        $modelfiles = $modelShowFiles->getFiles();

        $this->view->render('filelist', ['modelfiles' => $modelfiles], $currentPage);
    }

    public function removeImage()
    {
        $userModel = new User();
        $remove_pic = $userModel->removePic();
        if($remove_pic == true)
        {
            header("Location: /filelist.php");
        }else{
            echo "Фотка не была удалена";
        }
    }

    public function removeUser()
    {
        $userModel = new User();
        $remove = $userModel->removeUser();
        if ($remove == true) {
            header("Location: /list.php");
        } else {
            echo "Пользователь не был удален";
        }
    }


    public function registration()
    {
        // Проверки на пустые поля
        if (empty($_POST['login']) || empty($_POST['password'])) {
            echo "Ошибка, не указан логин или пароль";
            return 0;
        }
        if ($_POST['password'] != $_POST['confirm_password']) {
            echo "Пароли не совпадают";
            return 0;
        }

        if (empty($_POST['name']) || empty($_POST['desc']) || empty($_POST['age'])) {
            echo "Не указано имя, возраст или описание";
            return 0;
        }


        $login = trim(strtoupper($_POST['login']));
        $model = new User();
        $user = $model->getUserByLogin($login);

        if ($user !== null) {
            echo "Пользователь с логином " . $login . " существует";
            return 0;
        }

        $data = ['login' => $login, 'password' => md5($_POST['password']), 'name' => $_POST['name'], 'age' => $_POST['age'], 'desc' => $_POST['desc'], 'photo' => null, 'photo_name' => null];

        if (file_exists($_FILES['userfile']['tmp_name'])) {
            $uploaddir = realpath(__DIR__ . "/../../upload");
            $uploadfile = $uploaddir . DIRECTORY_SEPARATOR . md5($_POST['login']);
            $status = move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
            if ($status) {
                $replace = "http://" . $_SERVER['SERVER_NAME'] . ":81/upload/" . md5($_POST['login']);
                $data['photo'] = $replace;
                $data['photo_name'] = md5($_POST['login']);

                //$data['photo'] = $uploadfile;
            }
        }

        $model->add($data);
        $user = $model->getUserByLogin($login);
        if ($user === null) {
            echo "Не удалось записать в БД";
            return 0;
        }

        $_SESSION['user'] = $login;
        header("Location: /filelist.php");
    }
}
