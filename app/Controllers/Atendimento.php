<?php

namespace App\Controllers;

use App\Models\Paciente;

class  Atendimento extends BaseController
{
    public function __construct()
    {
        //$this->CoreModel = new CoreModel();
    }


    public function index()
    {
          $cadastros =  new Paciente();
        $resultado = $cadastros->getAll();
        $data = [
            'resultado' => $resultado
        ];
        return view('layout/paciente',$data);
    }

    public function cadastro()
    {
        $cadastros =  new Paciente();

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
            $cadastros->save($dadosBD);            
            return redirect()->to(base_url('/public'));
            
    
    }
        
        return view('layout/cadastro');      
    }

    public function novoAtendimento()
    {
        $cadastros =  new Paciente();
        $resultado = $cadastros->getAll();
        $data = [
            'resultado' => $resultado
        ];
        return view('layout/novoAtendimento1', $data);
    }

    public function perfil(int $id)
    {
        $cadastros = new  Paciente();
        
        $resultado = $cadastros->getUser($id);
        $data = [
            'resultado' => $resultado
        ];
        return view('layout/perfil',$data);
    }

    public function listarPerfil()
    {
        $cadastros =  new Paciente();
        $resultado = $cadastros->getAll();
        $data = [
            'resultado' => $resultado
        ];
        return view('layout/listarPerfil', $data);
    }

    public function editar(){
        $cadastros =  new Paciente();

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
            $cadastros->save($dadosBD);
            
    }}

    public function deletar($id){
        $paciente =  new Paciente();
        $paciente->deleteUser($id);
        
        return redirect()->to(base_url('/public'));
    }
}

