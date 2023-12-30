<?php

namespace App\Controllers;

use App\Core\BaseController;

class HomeController extends BaseController {
    public function index(){
        $this->render('home.twig');
    }

    public function about(){
        $this->render('about.twig');
    }
}