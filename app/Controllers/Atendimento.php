<?php

namespace App\Controllers;

use App\Models\Paciente;
use App\Models\Cadastro;
use App\Models\Medicamento;
use App\Models\Listagem;

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

    public function salvar()
    {
        $paciente =  new Paciente();

        $post = $this->request->getPost();
        if (!empty($post)) {

            $mensagem = [
                'mensagem' => 'Cadastrado com sucesso!',
                'tipo' => 'alert-success',
            ];

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

            if (isset($post["id"])) {
                $dadosBD["id"] = $post["id"];
                $mensagem["mensagem"] =  'Alterado com sucesso!';
            }

            if ($paciente->save($dadosBD)) {
                $this->session->setFlashdata('mensagem', $mensagem);
            } else {
                $mensagem['mensagem'] = 'Não foi possível cadastrar o paciente!';
                $mensagem['tipo'] = 'alert-danger';
                $this->session->setFlashdata('mensagem', $mensagem);
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

    public function editar(int $id)
    {
        $cadastros =  new Paciente();
        $resultado = $cadastros->getUser($id);
        $data = [
            'resultado' => $resultado,
            'editar' => true
        ];
        echo view('layout/cadastro', $data);
    }

    public function deletar()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');


            $paciente =  new Paciente();
            // return 'Chegou até aqui '.$id;
            // return $paciente->deleteUser($id);
            return $this->response->setJSON($paciente->deleteUser($id));
            exit;
        }
    }


    public function listagem()
    {
        $listagem =  new Listagem();
        $bdDate = $listagem->select('listagem.id,paciente.id as "idPaciente", paciente.cpf,paciente.nome, listagem.senha, listagem.entrada, listagem.saida')->join('paciente', 'paciente.cpf = listagem.cpfResponsavel')->findAll();
        // $bdDate=$listagem->findAll();
        $arrayBd = [
            'date' => $bdDate,
        ];

        // var_dump($bdDate);exit;
        echo view('layout/listagem', $arrayBd);
    }

    public function salvarListagem()
    {
        $post = $this->request->getPost();
        if (!empty($post)) {
            $listagem =  new Listagem();

            $dadosBD = [
                "cpfResponsavel" => $post["cpfResp"],
                "senha" => $post["senha"],
                "qtdReceitaResponsavel" => $post["receitasResponsavel"],
                "idsAdicional" => $post["idsAdicional"],
            ];

            if ($listagem->save($dadosBD)) {
                $mensagem['mensagem'] = 'Listagem registrada com successo!';
                $mensagem['tipo'] = 'alert-success';
                $this->session->setFlashdata('mensagem', $mensagem);
                return redirect()->to(base_url('public/atendimento/listagem'));
            } else {
                $mensagem['mensagem'] = 'Houve um erro no cadastramento, tente novamente!';
                $mensagem['tipo'] = 'alert-danger';
                return redirect()->to(base_url('public/atendimento/listagem'));
            }
        }


        $pessoas =  new Paciente();
        $resultado = $pessoas->getAll();
        $date = [
            'pessoa' => $resultado,
        ];
        echo view('layout/cadastroListagem', $date);
    }

    public function autoComplete()
    {
        if ($this->request->isAJAX()) {
            $people =  new Paciente();
            $cpf = $this->request->getPost('valor');
            $result = $people->like('cpf', $cpf)->find();

            return $this->response->setJSON($result);
        }
    }

    public function getCpf()
    {
        if ($this->request->isAJAX()) {
            $cpf = $this->request->getPost('cpf');
            $people =  new Paciente();
            $result = $people->where('cpf', $cpf)->find();
            if (!isset($result)) {
                return $this->response->setJSON(false);
            } else {
                return $this->response->setJSON($result);
            }
        }
    }

    public function senha($id)
    {
        $bdListagem = new listagem();
        $bdPaciente = new paciente();
        $bdListagem->find($id);
        $people = $bdListagem->select('paciente.cpf,paciente.nome,paciente.telefone1,paciente.telefone2,qtdReceitaResponsavel,idsAdicional,listagem.id,listagem.senha,listagem.entrada,listagem.saida')->join('paciente', 'paciente.cpf = listagem.cpfResponsavel')->findAll();
        foreach ($people as $value) {
            if ($value->id == $id) {
                $responsavel = $value;
                if (($responsavel->idsAdicional != '0')) {
                    $idsAdicional = json_decode($responsavel->idsAdicional);
                    $adicionais = [];
                    foreach ($idsAdicional as $idAdicional) {
                        $item = $bdPaciente->find($idAdicional->id);
                        $item->qtd = $idAdicional->qtd;                        
                        array_push($adicionais, $item);
                    }
                    $date=[
                        'responsavel' => $responsavel,
                        'adicionais' => $adicionais,
                    ];
                    echo view('layout/senha', $date);
                }else{
                    $date=[
                        'responsavel' => $responsavel,
                    ];
                    echo view('layout/senha', $date);
                }
            }
        }
    }

    public function saidaListagem($id){
        $bd = new listagem;
        $data = [
            'saida' => date("Y/m/d")
        ];
        $bd->update($id,$data);
        return redirect()->to(base_url('public/atendimento/listagem'));

    }
}
