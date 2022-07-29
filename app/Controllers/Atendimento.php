<?php

namespace App\Controllers;

use App\Libraries\Teste;
use App\Models\Cadastro;

class  Atendimento extends BaseController
{
    public function __construct()
    {
        //$this->CoreModel = new CoreModel();
    }

    // public function __construct(){

    //         $this->load->library('session');
    //         $this->load->model('CoreModel');          
    //         $this->load->helper('url');
    //         $this->load->library('Funcoes');            
    //         $this->load->library('form_validation');  
    //         $this->load->helper('array_helper');
    //         $this->load->database('cihecel');              
    // }


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
        $cadastros =  new Cadastro();
        $resultado = $cadastros->pegarTudo();
        $data = [
            'resultado' => $resultado
        ];
        return view('layout/novoAtendimento1', $data);
    }

    public function perfil(int $id = null)
    {
        $cadastros = new  Cadastro();
        $uri = current_url(true);
        // $data = $uri->getSegment(3);

        $data = $uri->getQuery();
        var_dump($uri);exit;
        // $resultado = $cadastros->teste("Luiz");
        return view('layout/perfil');
    }

    public function listarPerfil()
    {
        $cadastros =  new Cadastro();
        $resultado = $cadastros->pegarTudo();
        $data = [
            'resultado' => $resultado
        ];
        return view('layout/listarPerfil', $data);
    }
}
