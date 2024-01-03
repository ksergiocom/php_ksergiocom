<?php

namespace App\Controllers;

use App\Core\BaseController;

use App\Models\User;
use App\Models\Post;

class AdminController extends BaseController {
    public function login(){
        $this->render('admin/login.twig');
    }

    public function loginPOST(){
        if(!filter_var($_POST['user'],FILTER_VALIDATE_EMAIL)){
            echo "Correo invalido!";
        }

        $user = filter_var($_POST['user'],FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'],FILTER_SANITIZE_SPECIAL_CHARS);

        $user = User::findOne([
            "user"=>$user,
        ]);

        if(!$user){
            throw new \Exception("No existe el usuario"); 
        }

        if(!password_verify($password, $user['password'])){
            throw new \Exception("El password es incorrecto"); 
        }

        session_start();

        $_SESSION['user'] = $user['user'];
        $_SESSION['isAdmin'] = $user['isAdmin'??false];

        header("Location: /", true, 302);
        exit;

    }

    public function register(){
        $this->render('admin/register.twig');
    }

    public function registerPOST(){
        if(!filter_var($_POST['user'],FILTER_VALIDATE_EMAIL)){
            echo "Correo invalido!";
        }

        $user = filter_var($_POST['user'],FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'],FILTER_SANITIZE_SPECIAL_CHARS);

        User::insertOne([
            "user"=>$user,
            "password"=>$password]
        );
        
        header("Location: /",true,302);
        exit;
    }

    public function postsCreate() {
        $this->render('admin/posts/create.twig');
    }

    public function postsCreatePOST() {
        foreach ($_POST as $key => $value) {
            $_POST[$key] = strip_tags($value);
        }
        
        POST::insertOne($_POST);

        return header('Location: /',true, 302);
        exit;
    }
}