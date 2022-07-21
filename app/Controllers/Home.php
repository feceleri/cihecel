<?php

namespace App\Controllers;

use App\Libraries\Teste;

class Home extends BaseController
{
    public function index()
    {
        return view('layout/home');
    }

    public function cadastro(){
        return view('layout/cadastro');
    }

}
