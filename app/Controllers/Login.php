<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController
{

    public function index()
    {
        
        echo view('formularios/formLoguin');
    }

    public function recuperarSenha()
    {
        echo view('formularios/formRecuperaSenha');
    }

}
