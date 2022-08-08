<?php

namespace App\Controllers;

use App\Libraries\Teste;
use App\Models\Cadastro;
use App\Models\Medicamento;

class  Atendimento extends BaseController
{
    public function __construct()
    {
        //$this->CoreModel = new CoreModel();
    }


    public function index()
    {
        return view('layout/atendimento');
    }

    public function cadastro()
    {
        $cadastros =  new Cadastro();

        $post = $this->request->getPost();
        if(!empty($post)){

        $dadosBD = [
                    "nome" => $post["nomeCompleto"],
                    "cpf" => $post["cpf"],
                    "rg" => $post["rg"],
                    "dataNascimento" => $post["dtNasc"],
                    "sexo" => $post["sexo"],
                    "nomeMae"     => $post["nomeDaMae"],
                    "telefone1" => $post["tel1"],
                    "telefone2" => $post["tel2"],
                    "cep" => $post["cep"],
                    "logradouro" => $post["logradouro"],
                    "numeroCasa" => $post["numero"],
                    "complementoCasa" => $post["complemento"],
                    "cidade" => $post["localidade"],
                    "bairro" => $post["bairro"]
                ];


            $resultado = $cadastros->save($dadosBD);

        }
        
        return view('layout/cadastro');      
    }

    public function novoAtendimento()
    {
        $cadastros =  new Cadastro();
        $resultado = $cadastros->getAll();
        $data = [
            'resultado' => $resultado
        ];
        return view('layout/novoAtendimento1', $data);
    }

    public function perfil(int $id)
    {
        $cadastros = new  Cadastro();
        $resultado = $cadastros->getUser($id);
        $data = [
            'resultado' => $resultado
        ];
        return view('layout/perfil',$data);
    }

    public function listarPerfil()
    {
        $cadastros =  new Cadastro();
        $resultado = $cadastros->getAll();
        $data = [
            'resultado' => $resultado
        ];
        return view('layout/listarPerfil', $data);
    }

    public function pesquisaCPF()
    {
        $cadastros = new  Cadastro();
        // $cpf = $this->request->getPost();
        // var_dump($cpf);exit;
        // $resultado = $cadastros->getCPF($id);
        // $cpf = $this->request->getPost($cpf);

        
        //  $data = [
        //      'resultado' => $resultado
        //  ];
        return view('layout/pesquisaCPF');
    }
    
    public function consultaEstoque()
    {
        $remedios =  new Medicamento();
        $resultado = $remedios->getAll();
        $data = [
             'resultado' => $resultado
        ];
        $userModel = model(Medicamentos::class);
        $userModel = model('App\Models\Medicamentos');
        $TestModel = new Cadastro();
    
        // $this->data['Medicamentos']   = $TestModel->test();


        return view('layout/estoque', $data);
    }


    
}
