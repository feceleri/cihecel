<?php

namespace App\Controllers;

use App\Libraries\Teste;

class Home extends BaseController
{
    public function index()
    {
        $venda = new Teste();
        $venda->preco = "10";
        $venda->produto = "Carro";

        echo $venda->preco;
        echo "<br>";
        echo $venda->produto;
        

        // return view('welcome_message');
    }
}
