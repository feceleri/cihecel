<?php
// require './vendor/autoload.php';

namespace App\Controllers;

use App\Models\Legados;
use App\Models\Paciente;
use App\Models\Cadastro;
use App\Models\Listagem;
use Dompdf\Adapter\CPDF;
use Dompdf\Dompdf;
use Dompdf\Exception;

class  Listagemcontroller extends BaseController
{

    public function listagem()
    {
        $listagem = new Listagem();
        $post = $this->request->getPost();

        if (!empty($post)) {
            $busca = $post['search'];
            $senha = strpos($busca, "senha:");
            $nome = strpos($busca, "nome:");
            $entrada = strpos($busca, "entrada:");

            if (!$senha) {
                $arrayBd = [
                    'date' => $listagem->orderBy('id', 'desc')->where('senha', $busca)->findAll(),
                    'pager' => $listagem->pager
                ];
            }
            if (is_int($senha)) {
                $busca = str_replace("senha:", "", $busca);
                $arrayBd = [
                    'date' => $listagem->orderBy('id', 'desc')->where('senha', $busca)->findAll(),
                    'pager' => $listagem->pager
                ];
            }
            if (is_int($entrada)) {
                $busca = str_replace("entrada:", "", $busca);
                $busca = new \DateTime($busca);
                $busca = $busca->format('Y-d-m');
                $arrayBd = [
                    'date' => $listagem->orderBy('id', 'desc')->like('entrada', $busca)->findAll(),
                    'pager' => $listagem->pager
                ];
            }
            if (is_int($nome)) {
                $busca = str_replace("nome:", "", $busca);
                $arrayBd = [
                    'date' => $listagem->orderBy('id', 'desc')->like('nomeResponsavel', $busca)->findAll(),
                    'pager' => $listagem->pager
                ];
            }
        } else {
            $arrayBd = [
                'date' => $listagem->orderBy('id', 'desc')->paginate(10),
                'pager' => $listagem->pager
            ];
        }
        echo view('layout/listagem', $arrayBd);
    }

    public function listagemSubmit($id)
    {
        $post = $this->request->getPost();
        if (!empty($post)) {
            $listagem = new Listagem();
            if ($listagem->modelListagemInsert($post)) {
                $mensagem['mensagem'] = 'Listagem registrada com successo!';
                $mensagem['tipo'] = 'alert-success';
                $this->session->setFlashdata('mensagem', $mensagem);
                return redirect()->to(isset($id) ? base_url('atendimento/perfil/' . base64_encode($id)) : base_url('listagemcontroller/listagem'));
            } else {
                $mensagem['mensagem'] = 'Houve um erro no cadastramento, tente novamente!';
                $mensagem['tipo'] = 'alert-danger';
                $this->session->setFlashdata('mensagem', $mensagem);
                return redirect()->to(isset($id) ? base_url('atendimento/perfil/' . base64_encode($id)) : base_url('listagemcontroller/listagem'));
            }
        } else {
            $pessoa = new Paciente();
            $paciente = $pessoa->getUser(base64_decode($id));
            $userData = [
                'paciente' => $paciente,
                'id'       => $id,
            ];
            echo view('layout/cadastroListagem', $userData);
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
            return redirect()->back();
        } else {
            $mensagem['tipo'] = 'alert-danger';
            $mensagem['mensagem'] = 'Não foi possível registrar, tente novamente!';
            session()->setFlashdata('mensagem', $mensagem);
            return redirect()->back();
        }
    }

    public function saidaListagemManual()
    {
        if ($this->request->getPost()) {
            $bd = new listagem;
            $post = $this->request->getPost();
            if ($post['saida'] > date("Y-m-d")) {
                $mensagem['tipo'] = 'alert-danger';
                $mensagem['mensagem'] = 'A saída não pode ser maior que a data de hoje!';
                session()->setFlashdata('mensagem', $mensagem);
                return redirect()->back();
            }
            $entrada =$bd->getListagem($post['id'])->entrada;
            $entrada = date('Y-m-d', strtotime($entrada));
            if ($post['saida'] < $entrada ){ 
                $mensagem['tipo'] = 'alert-danger';
                $mensagem['mensagem'] = 'A saída não pode ser menor que a entrada!';
                session()->setFlashdata('mensagem', $mensagem);
                return redirect()->back();
            }
            $date = [
                'saida' => $post['saida'],
            ];
            if ($bd->update($post['id'], $date)) {
                $mensagem['tipo'] = 'alert-success';
                $mensagem['mensagem'] = 'Saída registrada com successo!';
                session()->setFlashdata('mensagem', $mensagem);
                return redirect()->back();
            } else {
                $mensagem['tipo'] = 'alert-danger';
                $mensagem['mensagem'] = 'Não foi possível regitrar, tente novamente!';
                session()->setFlashdata('mensagem', $mensagem);
                return redirect()->back();
            }
        }
    }

}
