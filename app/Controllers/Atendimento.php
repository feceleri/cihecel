<?php

namespace App\Controllers;

use App\Models\Paciente;
use App\Libraries\Teste;
use App\Models\Cadastro;
use App\Models\Medicamento;

class  Atendimento extends BaseController
{
    public function index()
    {
        $paciente =  new Paciente();
        $resultado = $paciente->getAll();
        $data = [
            'resultado' => $resultado     
        ];
        echo view('layout/paciente', $data);
    }

    public function cadastro()
    {
        $cadastros =  new Paciente();
        
        $post = $this->request->getPost();
        if (!empty($post)) {

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
        
            if($cadastros->save($dadosBD)){                
                $this->session->setFlashdata('mensagem', true);
            }
            else{
                $this->session->setFlashdata('mensagem', false);
            }
            return redirect()->to(base_url('/public'));
        }

        echo view('layout/cadastro');
    }

    public function novoAtendimento()
    {
        $cadastros =  new Paciente();
        $resultado = $cadastros->getAll();
        $data = [
            'resultado' => $resultado
        ];
        echo view('layout/novoAtendimento1', $data);
    }

    public function perfil(int $id)
    {
        $cadastros = new  Paciente();

        $resultado = $cadastros->getUser($id);
        $data = [
            'resultado' => $resultado
        ];
        echo view('layout/perfil', $data);
    }

    public function editar()
    {
        $cadastros =  new Paciente();

        $post = $this->request->getPost();
        if (!empty($post)) {

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
        }
    }

    public function deletar()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $paciente =  new Paciente();            
            return $this->response->setJSON($paciente->deleteUser($id));
            exit;
        }
    }

    public function pesquisaCPF()
    {
      
        // $cpf = $this->request->getPost($cpf);
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
        return view('layout/estoque', $data);
    }

    public function estoque(int $id)
    {
        $remedios =  new Medicamento();
        $resultado = $remedios->getAll();
        $data = [
            'resultado' => $resultado
        ];
    
        return view('layout/listarEstoque',$data);
    }

    public function novoMedicamento()
    {
        $medicamentos =  new Medicamento();

        $post = $this->request->getPost();
        if(!empty($post)){
            $dadosBD = [
                    "id" => $post["id"],
                    "idMedicamento" => $post["idMed"],
                    "idControle" => $post["idCont"],
                    "quantidade" => $post["quantid"],
                    "nomeMed" => $post["medicamento"],
                    "observacao"     => $post["obs"],
                    "dosagem" => $post["dosagem"],
                    "tarja" => $post["tarja"]
                ];
            $medicamentos->save($dadosBD);
            
            return view('layout/novoMed');
        }
        
        echo view('layout/novoMed');      
    }

    public function listagem(){
        $remedios =  new Medicamento();
        $resultado = $remedios->getAll();
        $data = [
            'resultado' => $resultado
        ];
    
        return view('layout/listagem');
    }
    
}
