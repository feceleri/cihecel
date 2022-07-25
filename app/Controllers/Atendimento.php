<?php

namespace App\Controllers;

use App\Libraries\Teste;

class  Atendimento extends BaseController
{
    public function index()
    {
        return view('layout/atendimento');
    }

    public function cadastro()
    {
        return view('layout/cadastro');
    }

    public function novoAtendimento()
    {
        return view('layout/novoAtendimento1');
    }
}
