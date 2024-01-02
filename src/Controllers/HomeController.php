<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Core\MongoClient;

use MongoDB\BSON\ObjectId;
use Exception;
use Parsedown;

class HomeController extends BaseController { 
    public function index(){
        $posts = MongoClient::getCollection('posts')->find()->toArray();

        $this->render('home.twig',['posts'=>$posts]);
    }

    public function post($_id){
  
        // Asegúrate de que $_id sea un ObjectId válido
        try {
            $mongoId = new ObjectId($_id);
        } catch (Exception $e) {
            echo "404 Not Found"; // ID no válido
            return;
        }
    
        $post = MongoClient::getCollection('posts')->findOne(["_id" => $mongoId]);
        
        if (!$post) {
            echo "404 Not Found"; // Post no encontrado
            return;
        }
    
        $Parsedown = new Parsedown();
        $markdown = $Parsedown->text($post['contenido']);
    
        $this->render('post.twig', ['markdown' => $markdown, 'post'=>$post]);
    }

    public function about(){
        throw new Exception('Esto es un error custom lanzado');
        $this->render('about.twig');
    }
}