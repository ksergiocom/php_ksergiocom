<?php

namespace App\Controllers;

use App\Core\BaseController;

class AdminController extends BaseController {
    public function login(){
        $this->render('admin/login.twig');
    }
}