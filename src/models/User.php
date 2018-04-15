<?php

class User
{
    protected $db;

    public function __construct()
    {
        $array=[
            "db" => [
                "host" => "localhost",
                "dbname" => "project",
                "user" => "root",
                "password" => "",
                "charset" => "utf8"
            ]
        ];

        $dsn = "mysql:host=" . $array["db"]['host'] . ";" . "dbname=" . $array["db"]['dbname'] . ";" . "charset=" . $array["db"]['charset'];
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ];
        // Подключаемся к базе
        $this->db = new PDO($dsn, $array['db']['user'], $array['db']['password'], $opt);
    }

    public function getUserByLogin($login)
    {

// Ищем пользователя по логину
        $sql = "SELECT user_id FROM users WHERE login = :login";
        $sth = $this->db->prepare($sql);
        $sth->execute(array('login' => $login));
        $userId = $sth->fetchColumn();
        if (!empty($userId)) {
            return $userId;
        }
        return null;
    }

    public function auth(array $data = [])
    {

    // Ищем пользователя по логину
        $sql = "SELECT login, password FROM users WHERE login = :login and password = :password";
        $sth = $this->db->prepare($sql);
        $sth->execute(array('login' => $data['login'], 'password' => $data['password']));
        $userId = $sth->fetchColumn();
        if (!empty($userId)) {
            return true;
        } else {
            return null;
        }
    }


    public function add($data)
    {
        $sth = $this->db->prepare("INSERT INTO users(`LOGIN`, `PASSWORD`, `NAME`, `AGE`, `DESCRIPTION`, `PHOTO`, `PHOTO_NAME`) VALUES (:login,:password,:name,:age,:desc, :link_photo, :photo_name)");
        $sth->execute(array(':login' => $data['login'], ':password' => $data['password'], ':name' => $data['name'], ':age' => $data['age'], ':desc' => $data['desc'], ':link_photo' => $data['photo'], ':photo_name' => $data['photo_name']));
    }

    public function getAllUsers()
    {
        $sql = "SELECT user_id,login,name,age,description,photo FROM users";
        $sth = $this->db->prepare($sql);
        $sth->execute();
        $userId = $sth->fetchAll();
        return $userId;
    }

    public function removeUser()
    {
        $sql = "DELETE FROM users WHERE USER_ID = :user_id";
        $sth = $this->db->prepare($sql);
        $sth->execute(array('user_id' => $_GET['remove_user_id']));

        $sqlCheck = "SELECT user_id FROM users WHERE user_id = :user_id";
        $sth2 = $this->db->prepare($sqlCheck);
        $sth2->execute(array('user_id' => $_GET['remove_user_id']));
        $userId = $sth2->fetchAll();
        if (empty($userId)) {
            return true;
        } else {
            return false;
        }
    }

    public function getFiles()
    {
        $sql = "SELECT user_id,photo,photo_name FROM users";
        $sth = $this->db->prepare($sql);
        $sth->execute();
        $filesId = $sth->fetchAll();
        return $filesId;
    }

    public function removePic($userId)
    {
        $sql = "UPDATE `users` SET `PHOTO`= :photo,`PHOTO_NAME`= :photo_name WHERE USER_ID = :user_id";
        $sth = $this->db->prepare($sql);
        $sth->execute(array('user_id' => $_GET['remove_userpic'], 'photo' => null, 'photo_name' => null));
    }

    public function addUserFromAdmin($data)
    {
        $sth = $this->db->prepare("INSERT INTO users(`LOGIN`, `EMAIL`, `PASSWORD`, `NAME`, `AGE`, `DESCRIPTION`, `PHOTO`, `PHOTO_NAME`) VALUES (:login,:email,:password,:name,:age,:desc, :link_photo, :photo_name)");
        $sth->execute(array(':login' => $data['login'], ':email' => $data['email'], ':password' => $data['password'], ':name' => $data['name'], ':age' => $data['age'], ':desc' => $data['desc'], ':link_photo' => $data['photo'], ':photo_name' => $data['photo_name']));
    }

    public function getUserById($userId)
    {
        $sql = "SELECT * FROM users WHERE user_id = :user_id";
        $sth = $this->db->prepare($sql);
        $sth->execute(['user_id' => $userId]);
        $user = $sth->fetch();

        return $user;
    }

    public function UpdateUser($data)
    {
        //var_dump($data);
        //exit(); //`PHOTO`= :photo,`PHOTO_NAME`= :photo_name
        $sql = "UPDATE `users` SET `LOGIN`= :login,`EMAIL`= :email,`PASSWORD`= :password,`NAME`= :name,`AGE`= :age, `DESCRIPTION`= :description WHERE USER_ID = :user_id";
        $sth = $this->db->prepare($sql);
        $sth->execute([':user_id' => $data['user_id'], ':login' => $data['login'], ':email' => $data['Email_Parse'], ':name' => $data['name'], ':age' => $data['age'], ':password' => $data['password'], ':description' => $data['desc']]);
        return $sth;
    }

    /*
    protected $users = [
        'user1', 'user2', 'user3'
    ];
    public function all()
    {
        return $this->users;
    }
    public function first()
    {
        return $this->users[0];
    }
    public function get($id)
    {
        return $this->users[$id];
    }*/

   /* public function getNewsItembyId()
    {
        //echo "hi";
    }
*//*
    public function getUserList()
    {
/*         if (!empty($user)): ?>  <p>Добрый день <?=$user?>!<br><a href="logout.php">Выйти</a></p>
            <?php else : ?>
            <a href="login.php">Войти</a>
                <?php endif;*/
        //return "Результат работы модели";
        //echo "hi";
    /*}*/
}
