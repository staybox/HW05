<?php

load('core/MainController.php');
class UserController extends MainController
{
    public function index()
    {
        //echo "PHP".PHP_EOL;

        //$userModel = new User();
        //$users = $userModel; //->getUserList();
        $this->view->render('home',[]);
        //var_dump("123");
        //$model = new User();
        //return $model->getUserList();
        /*
        //echo 'Список новостей';
        $newsList = [];
        $newsList = News::getNewsList();
        echo '<pre>';
        print_r($newsList);
        return true;*/
    }

    public function reg()
    {
        $this->view->render('reg',[]);
    }


    public function list()
    {
        $this->view->render('list',[]);
    }

    public function filelist()
    {
        $this->view->render('filelist',[]);
    }

/*
    public function actionView($category, $id)
    {
        if ($id){
            $newsItem = News::getNewsItembyId($id);
            echo '<pre>';
            print_r($newsItem);
        }

        //echo 'Просмотр одной новости';
        //echo '<br>'.$category;
        //echo '<br>'.$id;
        return true;
    }*/
}
