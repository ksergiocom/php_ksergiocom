<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Core\MongoClient;
use App\Models\Post;

class HomeController extends BaseController { 
    public function index(){

        $posts = MongoClient::getCollection('posts')->find()->toArray();

        $this->render('home.twig',['posts'=>$posts]);
    }

    public function post($_id){
        $post = Post::findById($_id);
        if(!$post) throw new \Exception("No existe este post");
    
        $Parsedown = new \Parsedown();
        $markdown = $Parsedown->text($post['contenido']);
    
        $this->render('post.twig', ['markdown' => $markdown, 'post'=>$post]);
    }

    public function about(){
        throw new \Exception('Esto es un error custom lanzado');
        $this->render('about.twig');
    }
}