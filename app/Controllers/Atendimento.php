<?php
// require './vendor/autoload.php';

namespace App\Controllers;

use App\Models\Legados;
use App\Models\Paciente;
use App\Models\Cadastro;
use App\Models\Medicamento;
use App\Models\Listagem;
use Dompdf\Adapter\CPDF;
use Dompdf\Dompdf;
use Dompdf\Exception;

class  Atendimento extends BaseController
{

    public function index()
    {
        $paciente =  new Paciente();
        $searchInput = $this->request->getGet('search');

        if ($searchInput) {
            $data = [
                'resultado'      => $paciente->like('cpf', $searchInput)->where('cpf != ""')
                    ->orLike('id', $searchInput)->where('cpf != ""')
                    ->orLike('nome', $searchInput)->where('cpf != ""')
                    ->orLike('created_at', $searchInput = implode('-', array_reverse(explode('/', $searchInput))))->where('cpf != ""')
                    ->orLike('dataNascimento', $searchInput = implode('-', array_reverse(explode('/', $searchInput))))->where('cpf != ""')
                    ->orderBy('id')->paginate(10),
                'pager'         => $paciente->pager,
            ];
            return view('layout/paciente', $data);
        }
        $data = [
            'resultado'  => $paciente->where('cpf != ""')->orderBy('id')->paginate(10),
            'pager'     => $paciente->pager,

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
                if ($this->validaCPF($dadosBD["cpf"])) {
                    $paciente->save($dadosBD);
                    $mensagem["mensagem"] =  'Alterado com sucesso!';
                    $this->session->setFlashdata('mensagem', $mensagem);
                    return redirect()->to(base_url('/'));
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
                return redirect()->to(base_url('/'));
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
        $listagens = $listagemModel->select('listagem.id, listagem.senha, listagem.entrada, listagem.saida')->join('paciente', 'paciente.cpf = listagem.cpfResponsavel', 'listagem.idsAdicional->>"id"=' . $id)->where('paciente.id = ' . $id)->findAll();
        $legadosModel = new Legados();
        $legados = $legadosModel->select('atendimento.id, atendimento.senha, atendimento.entrada, atendimento.saida, atendimento.obs')
            ->join('paciente', 'paciente.id = atendimento.idPaciente')
            ->where('paciente.id', $id)->findAll();
        $listagensAdicional = $listagemModel->select('listagem.id, listagem.senha, listagem.entrada, listagem.saida')->join('paciente', 'paciente.cpf = listagem.cpfResponsavel', 'listagem.idsAdicional->>"id"=' . $id)->where("JSON_CONTAINS(idsAdicional, '{\"id\": $id }')")->findAll();
        $data = [
            'resultado' => $resultado,
            'listagens' => $listagens,
            'listagensAdicionais' => $listagensAdicional,
            'legados' => $legados,
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

    public function getCpf()
    {
        if ($this->request->isAJAX()) {
            $cpf = $this->request->getPost('cpf');
            $people =  new Paciente();
            if (strlen($cpf) == 14) {
                $result = $people->where('cpf', $cpf)->find();
            } else {
                $result = $people->where('id', $cpf)->find();
            }
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
        $bdLegados = new Legados();
        $bdLegados->find($id);
        $bdPaciente = new paciente();
        $bdListagem->find($id);
        $people = $bdListagem->select('paciente.cpf,paciente.nome,paciente.telefone1,paciente.telefone2,qtdReceitaResponsavel,idsAdicional,listagem.id,listagem.senha,listagem.entrada,listagem.saida')->join('paciente', 'paciente.cpf = listagem.cpfResponsavel')->findAll();
        $legados = $bdLegados->select('paciente.cpf, paciente.nome, paciente.telefone1, paciente.telefone2, atendimento.obs, atendimento.id, atendimento.senha, atendimento.entrada, atendimento.saida')
            ->join('paciente', 'paciente.id = atendimento.idPaciente')
            ->findAll();
        if (!empty($legados)) {
            foreach ($legados as $value) {
                if ($value->id == $id) {
                    $legado = $value;
                }
            }
        }
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
                        'legado'      => $legado,
                    ];
                    echo view('layout/senha', $date);
                }
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
                $bd = new paciente;
                $pacientes = $bd->where('created_at', $dataPesquisa)
                    ->findAll();
                $dados = [
                    'paciente' => $pacientes,
                ];
                return view('layout/novos', $dados);
            } else {
                $bd = new listagem;
                $listagem = $bd->like('entrada', $dataPesquisa['dataListagem'])
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

    public function incompletos()
    {
        $paciente =  new Paciente();
        $searchInput = $this->request->getGet('search');

        if ($searchInput) {
            $data = [
                'resultado'      => $paciente->like('id', $searchInput)->where('cpf = ""')
                    ->orLike('nome', $searchInput)->where('cpf = ""')
                    ->orLike('created_at', $searchInput = implode('-', array_reverse(explode('/', $searchInput))))->where('cpf = ""')
                    ->orLike('dataNascimento', $searchInput = implode('-', array_reverse(explode('/', $searchInput))))->where('cpf = ""')
                    ->orderBy('id')->paginate(10),
                'pager'         => $paciente->pager,
                'incompletos'   => true,

            ];
            return view('layout/incompletos', $data);
        }
        $data = [
            'resultado'  => $paciente->where('cpf = ""')->orderBy('id')->paginate(10),
            'pager'     => $paciente->pager,
            'incompletos' => true,

        ];
        echo view('layout/incompletos', $data);
    }

    public function listagemPDF()
    {

        if ($this->request->getPost()) {

            $inicioListagem = $this->request->getPost();

            if (isset($inicioListagem['dataLista'])) {
                $bd = new listagem;
                function Reversedates($oldData)
                {
                    $orgDate = $oldData;
                    //var_dump($orgDate);die;
                    $date = str_replace('/', '-', $orgDate);
                    $newDate = date("Y-m-d", strtotime($date));
                    return $newDate;
                }
                $date = ReverseDates($inicioListagem['dataLista']);
                $until = date($inicioListagem['dataLista'], strtotime('+7 days'));
                //var_dump($until);die;
                $where = `entrada ={$date} AND entrada={$until}`;
                $listagem = $bd->where($where);
                //var_dump($listagem);die;

                $dados = [
                    'listagem' => $listagem,
                ];

                $segment =  $this->request->uri->getSegment(2);
                $dompdf = new Dompdf();

                if ($segment) {
                    $id = $segment;
                    $listagem = new Listagem();
                    $now = strtotime($inicioListagem['dataLista']);
                    $until = strtotime('+7 days', $now);
                    $now = new \DateTime($inicioListagem['dataLista']);
                    //var_dump($date);die;
                    $html_content = '<h3 align="center">Listagem Semanal: ' . $now->format('d/m/Y') . ' até '
                        . date('d/m/Y', $until) . '</h3>';
                    $html_content .= $listagem->pdfDetails($date);
                    $dompdf->loadHtml($html_content);
                    $dompdf->render();
                    $dompdf->stream("Listagem" . ".pdf", array("Attachment" => 0));
                }
            }
        }
    }

    public function legados()
    {
        $legado =  new Legados();
        $post = $this->request->getPost();

        if (!empty($post)) {
            $busca = $post['search'];
            $id = strpos($busca, "id:");
            $senha = strpos($busca, "senha:");

            if (!$id) {
                $data = [
                    'resultado' => $legado->orderBy('id')->like('id', $busca)->findAll(),
                    'pager' => $legado->pager
                ];
            }
            if (is_int($id)) {
                $busca = str_replace("id:", "", $busca);
                $data = [
                    'resultado' => $legado->orderBy('id')->where('id', $busca)->findAll(),
                    'pager' => $legado->pager
                ];
            }
            if (is_int($senha)) {
                $busca = str_replace("senha:", "", $busca);
                $data = [
                    'resultado' => $legado->orderBy('id')->like('senha', $busca)->findAll(),
                    'pager' => $legado->pager
                ];
            }
        } else {
            $data = [
                'resultado' => $legado->orderBy('id')->paginate(10),
                //x
                'pager' => $legado->pager
            ];
        }
        echo view('layout/legados', $data);
    }
    public function editarLegados($id)
    {
        $id = base64_decode($id);
        $atendimentos =  new Legados();
        $resultado = $atendimentos->getService($id);
        $data = [
            'resultado' => $resultado,
            'editar' => true
        ];
        return view('layout/legado', $data);
    }

    public function salvarLegado()
    {
        $legado =  new Legados();

        $post = $this->request->getPost();

        if (!empty($post)) {

            $mensagem = [
                'mensagem' => 'Cadastrado com sucesso!',
                'tipo' => 'alert-success',
            ];

            $dadosBD = [
                "senha" => $post["senha"],
                "idPaciente" => $post["idPaciente"],
                "entrada" => $post["dtEntrada"],
                "obs"     => $post["obs"]
            ];

            if (isset($post["id"])) {
                $dadosBD["id"] = $post["id"];

                $legado->save($dadosBD);
                $mensagem["mensagem"] =  'Alterado com sucesso!';
                $this->session->setFlashdata('mensagem', $mensagem);
                return redirect()->to(base_url('/atendimento/legados'));
            }
        }

        echo view('layout/legado');
    }

    public function obsLegado()
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
                return redirect()->to(base_url('atendimento/legados/' . base64_encode($id)));
            } else {
                $mensagem['tipo'] = 'alert-danger';
                $mensagem['mensagem'] = 'Não foi possível regitrar, tente novamente!';
                session()->setFlashdata('mensagem', $mensagem);
                return redirect()->to(base_url('atendimento/legados/' . base64_encode($id)));
            }
        }
    }

    public function deletarLegado()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $legado =  new Legados();
            return $this->response->setJSON($legado->deleteService($id));
        }
    }
}
