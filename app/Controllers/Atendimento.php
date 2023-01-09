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
        $post = $this->request->getPost();

        if (!empty($post)) {
            $busca = $post['search'];
            $nc = strpos($busca, "nc:"); 
            $cpf = strpos($busca, "cpf:");           
           
            if (!$nc){                       
                $data = [
                    'resultado' => $paciente->orderBy('nome')->like('nome', $busca)->findAll(),
                    'pager' => $paciente->pager
                ];               
            }
            if(is_int($nc))
            {                
                $busca=str_replace("nc:","",$busca);
                $data = [
                    'resultado' => $paciente->orderBy('nome')->where('id', $busca)->findAll(),
                    'pager' => $paciente->pager
                ];
            }
            if(is_int($cpf)){
                $busca=str_replace("cpf:","",$busca);
                $data = [
                    'resultado' => $paciente->orderBy('nome')->like('cpf', $busca)->findAll(),
                    'pager' => $paciente->pager
                ];  
            }
            

                
        } else {
            $data = [
                'resultado' => $paciente->orderBy('id')->paginate(10),
                'pager' => $paciente->pager
            ];
        }
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
                if ($this->validaCPF($dadosBD["cpf"])) {
                    $paciente->save($dadosBD);
                    $mensagem["mensagem"] =  'Alterado com sucesso!';
                    $this->session->setFlashdata('mensagem', $mensagem);
                    return redirect()->to(base_url('/public'));
                } else {
                    $mensagem["mensagem"] =  'CPF Inválido';
                    $mensagem['tipo'] = 'alert-danger';
                    // $dadosBD["cpf"] = "123";
                    // die;
                }
            }

            if ($this->validaCPF($dadosBD["cpf"])) {
                $paciente->save($dadosBD);
                $this->session->setFlashdata('mensagem', $mensagem);
                return redirect()->to(base_url('/public'));
            } else {
                $mensagem['mensagem'] = 'Não foi possível cadastrar o paciente! CPF Duplicado! ';
                $mensagem['tipo'] = 'alert-danger';
                $this->session->setFlashdata('mensagem', $mensagem);
            }
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

    public function perfil($id)
    {
        $id = base64_decode($id);
        $cadastros = new  Paciente();
        $resultado = $cadastros->getUser($id);

        $listagemModel =  new Listagem();
        $listagens = $listagemModel->select('listagem.id, listagem.senha, listagem.entrada, listagem.saida')->join('paciente', 'paciente.cpf = listagem.cpfResponsavel')->where('paciente.id = ' . $id)->findAll();
        $data = [
            'resultado' => $resultado,
            'listagens' => $listagens,
        ];
        return view('layout/perfil', $data);
    }

    public function editar($id)
    {
        $id = base64_decode($id);
        $cadastros =  new Paciente();
        $resultado = $cadastros->getUser($id);
        $data = [
            'resultado' => $resultado,
            'editar' => true
        ];
        return view('layout/cadastro', $data);
    }

    public function deletar()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $paciente =  new Paciente();
            return $this->response->setJSON($paciente->deleteUser($id));
        }
    }

    public function listagem()
    {
        $listagem =  new Listagem();
        $bdDate = $listagem->select('listagem.id,paciente.id as "idPaciente", paciente.cpf,paciente.nome, listagem.senha, listagem.entrada, listagem.saida,paciente.telefone1')->join('paciente', 'paciente.cpf = listagem.cpfResponsavel')->findAll();
        $arrayBd = [
            'date' => $bdDate,
        ];
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
                return redirect()->to(base_url('atendimento/listagem'));
            } else {
                $mensagem['mensagem'] = 'Houve um erro no cadastramento, tente novamente!';
                $mensagem['tipo'] = 'alert-danger';
                $this->session->setFlashdata('mensagem', $mensagem);
                return redirect()->to(base_url('atendimento/listagem'));
            }
        }

        $pessoas =  new Paciente();
        $resultado = $pessoas->getAll();
        $date = [
            'pessoa' => $resultado,
        ];
        echo view('layout/cadastroListagem', $date);
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
        $id = base64_decode($id);
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
                    $date = [
                        'responsavel' => $responsavel,
                        'adicionais' => $adicionais,
                    ];
                    echo view('layout/senha', $date);
                } else {
                    $date = [
                        'responsavel' => $responsavel,
                    ];
                    echo view('layout/senha', $date);
                }
            }
        }
    }

    public function saidaListagem($id)
    {
        $id = base64_decode($id);
        $bd = new listagem;
        $data = [
            'saida' => date("Y/m/d")
        ];
        if ($bd->update($id, $data)) {
            $mensagem['tipo'] = 'alert-success';
            $mensagem['mensagem'] = 'Saída registrada com successo!';
            session()->setFlashdata('mensagem', $mensagem);
            return redirect()->to(base_url('atendimento/listagem'));
        } else {
            $mensagem['tipo'] = 'alert-danger';
            $mensagem['mensagem'] = 'Não foi possível regitrar, tente novamente!';
            session()->setFlashdata('mensagem', $mensagem);
        }
    }

    public function saidaListagemManual()
    {
        if ($this->request->getPost()) {
            $bd = new listagem;
            $post = $this->request->getPost();
            if ($post['saida'] > date("Y-m-d")) {
                $mensagem['tipo'] = 'alert-danger';
                $mensagem['mensagem'] = 'A data foi inserida incorretamente!';
                session()->setFlashdata('mensagem', $mensagem);
                return redirect()->to(base_url('atendimento/listagem'));
            }
            $id = $post['id'];
            $date = [
                'saida' => $post['saida'],
            ];
            if ($bd->update($id, $date)) {
                $mensagem['tipo'] = 'alert-success';
                $mensagem['mensagem'] = 'Saída registrada com successo!';
                session()->setFlashdata('mensagem', $mensagem);
                return redirect()->to(base_url('atendimento/listagem'));
            } else {
                $mensagem['tipo'] = 'alert-danger';
                $mensagem['mensagem'] = 'Não foi possível regitrar, tente novamente!';
                session()->setFlashdata('mensagem', $mensagem);
                return redirect()->to(base_url('atendimento/listagem'));
            }
        }
    }

    public function obs()
    {
        if ($this->request->getPost()) {
            $post = $this->request->getPost();
            $date = [
                'obs' => $post['obs'],
            ];
            $id = base64_decode($post['id']);
            $bd = new paciente;
            if ($bd->update($id, $date)) {
                $mensagem['tipo'] = 'alert-success';
                $mensagem['mensagem'] = 'Observação registrada com successo!';
                session()->setFlashdata('mensagem', $mensagem);
                return redirect()->to(base_url('atendimento/perfil/' . base64_encode($id)));
            } else {
                $mensagem['tipo'] = 'alert-danger';
                $mensagem['mensagem'] = 'Não foi possível regitrar, tente novamente!';
                session()->setFlashdata('mensagem', $mensagem);
                return redirect()->to(base_url('atendimento/perfil/' . base64_encode($id)));
            }
        }
    }

    public function novos()
    {

        if ($this->request->getPost()) {
            $dataPesquisa = $this->request->getPost();

            if (isset($dataPesquisa['dataPaciente'])) {
                echo 'true';
                $bd = new paciente;
                function Reversedates($oldData)
                {
                    $orgDate = $oldData;
                    $date = str_replace('/', '-', $orgDate);
                    $newDate = date("Y-m-d", strtotime($date));
                    return $newDate;
                }
                $date = Reversedates($dataPesquisa['dataPaciente']);
                $pacientes = $bd->where('created_at', $date)
                    ->findAll();
                $dados = [
                    'paciente' => $pacientes,
                ];
                return view('layout/novos', $dados);
            } else {
                $bd = new listagem;
                function Reversedates($oldData)
                {
                    $orgDate = $oldData;
                    $date = str_replace('/', '-', $orgDate);
                    $newDate = date("Y-m-d", strtotime($date));
                    return $newDate;
                }
                $date = ReverseDates($dataPesquisa['dataListagem']);
                $listagem = $bd->where('entrada', $date)
                    ->findAll();
                $dados = [
                    'listagem' => $listagem,
                ];
                return view('layout/novosListagem', $dados);
            }
        }

        echo view('layout/novos');
    }

    public function novosListagem()
    {
        return view('layout/novosListagem');
    }

    function validaCPF($cpf)
    {

        if ($cpf == "123") {
            return false;
        }
        // Extrai somente os números
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    //Função verifica se o CPF já está cadastrado no sistema.
    public function verficaCpf()
    {
        if ($this->request->getPost()) {
            $paciente =  new Paciente();
            $cpf = $this->request->getPost();
            $respostaModel = $paciente->confereCpf($cpf);
            if ($respostaModel) {
                return json_encode(array(
                    'status' => 200,
                    'message' => "Error"
                ));
            } else {
                return json_encode(array(
                    'status' => 200,
                    'message' => "Success"
                ));
            };
        }
    }
}
