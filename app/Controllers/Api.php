<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Api extends ResourceController
{
    private $pacienteModel;
    private $listagemModel;

    public function __construct()
    {
        $this->pacienteModel = new \App\Models\Paciente();
        $this->listagemModel = new \App\Models\Listagem();
    }

    public function all()
    {
        $pacientes = $this->pacienteModel->select('nome, id, cpf, dataNascimento')->findAll();

        foreach ($pacientes as $paciente) {
            $result[] = [
                $paciente->id,
                "<a style='text-transform:uppercase;'href='" . base_url('atendimento/perfil/' . base64_encode($paciente->id)) . "'>" . $paciente->nome . "</a>",
                (!empty($paciente->cpf) ? $paciente->cpf : '<span class="badge bg-danger">Não Cadastrado!</span>'),
                date("d/m/Y", strtotime($paciente->dataNascimento)),
                ($_SESSION['usuario']['user']->tipo == '1') ? "<a title='Editar Paciente' class='pencil' href='" . base_url('atendimento/editar/' . base64_encode($paciente->id)) . "'><span><i class='fa fa-pencil' aria-hidden='true'></i> </span></a><button title='Deletar Paciente' class='eraser' data-bs-target='#deleteModal' data-bs-toggle='modal' onclick='preencherModalDelete(" . $paciente->id . ")' ><span><i class='fa fa-eraser' aria-hidden='true'></i> </span></button>" : (($_SESSION['usuario']['user']->tipo == '0') ? "<a title='Editar Paciente' class='pencil' href='" . base_url('atendimento/editar/' . base64_encode($paciente->id)) . "'><span><i class='fa fa-pencil' aria-hidden='true'></i>" : "")
            ];
        }

        $result = [
            'data' => $result
        ];


        return $this->response->setJSON($result);
    }

    public function incompletos()
    {
        $pacientes = $this->pacienteModel->select('nome, id, cpf, dataNascimento')->where('cpf = ""')->findAll();

        foreach ($pacientes as $paciente) {
            $result[] = [
                $paciente->id,
                "<a style='text-transform:uppercase;'href='" . base_url('atendimento/perfil/' . base64_encode($paciente->id)) . "'>" . $paciente->nome . "</a>",
                (!empty($paciente->cpf) ? $paciente->cpf : '<span class="badge bg-danger">Não Cadastrado!</span>'),
                date("d/m/Y", strtotime($paciente->dataNascimento)),
                ($_SESSION['usuario']['user']->tipo == '1') ? "<a title='Editar Paciente' class='pencil' href='" . base_url('atendimento/editar/' . base64_encode($paciente->id)) . "'><span><i class='fa fa-pencil' aria-hidden='true'></i> </span></a><button title='Deletar Paciente' class='eraser' data-bs-target='#deleteModal' data-bs-toggle='modal' onclick='preencherModalDelete(" . $paciente->id . ")' ><span><i class='fa fa-eraser' aria-hidden='true'></i> </span></button>" : (($_SESSION['usuario']['user']->tipo == '0') ? "<a title='Editar Paciente' class='pencil' href='" . base_url('atendimento/editar/' . base64_encode($paciente->id)) . "'><span><i class='fa fa-pencil' aria-hidden='true'></i>" : "")
            ];
        }

        $result = [
            'data' => $result
        ];


        return $this->response->setJSON($result);
    }

    public function panoramas($ano)
    {
        $panorama = $this->listagemModel->getPanoramaAnual($ano);
        return $this->response->setJSON($panorama);
    }

    public function anosListagem()
    {
        $anos = $this->listagemModel->select('YEAR(entrada) as ano')->distinct()->orderBy('entrada', 'DESC')->findAll();
        foreach ($anos as $item) {
            $result[] = [
                $item->ano
            ];
        }

        return $this->response->setJSON($result);
    }

    public function mesesListagem($ano)
    {
        $meses = $this->listagemModel
            ->select('MONTH(listagem.entrada) AS mes, 
              COUNT(*) AS total_entrada, 
              SUM(CASE WHEN listagem.saida IS NOT NULL THEN 1 ELSE 0 END) AS total_saida,
              SUM(CASE WHEN listagem.saida IS NULL THEN 1 ELSE 0 END) AS total_s_saida')
            ->where('YEAR(listagem.entrada)', $ano)
            ->groupBy('MONTH(listagem.entrada)')
            ->findAll();

        foreach ($meses as $mes) {
            switch ($mes->mes) {
                case 1:
                    $nome_mes = 'Janeiro';
                    break;
                case 2:
                    $nome_mes = 'Fevereiro';
                    break;
                case 3:
                    $nome_mes = 'Março';
                    break;
                case 4:
                    $nome_mes = 'Abril';
                    break;
                case 5:
                    $nome_mes = 'Maio';
                    break;
                case 6:
                    $nome_mes = 'Junho';
                    break;
                case 7:
                    $nome_mes = 'Julho';
                    break;
                case 8:
                    $nome_mes = 'Agosto';
                    break;
                case 9:
                    $nome_mes = 'Setembro';
                    break;
                case 10:
                    $nome_mes = 'Outubro';
                    break;
                case 11:
                    $nome_mes = 'Novembro';
                    break;
                case 12:
                    $nome_mes = 'Dezembro';
                    break;
                default:
                    $nome_mes = 'Mês Inválido';
            }

            $result[] = [
                $nome_mes,
                $this->pacienteModel->select('COUNT(*) as total')->where('MONTH(created_at)', $mes->mes)->where('YEAR(created_at)', $ano)->first()->total > 0 ?
                    "<a title='Pacientes cadastrados nesse mês' target='_blank' class='fw-bold text-reset' href='" . base_url('atendimento/detalhesmensal/' . $mes->mes . '/' . $ano . '/cadastros') . "'>" . $this->pacienteModel->select('COUNT(*) as total')->where('MONTH(created_at)', $mes->mes)->where('YEAR(created_at)', $ano)->first()->total . "</a>" :
                    $this->pacienteModel->select('COUNT(*) as total')->where('MONTH(created_at)', $mes->mes)->where('YEAR(created_at)', $ano)->first()->total,
                $mes->total_entrada,

                "<a title='Atendimentos concluídos nesse mês' target='_blank' class='fw-bold text-reset' href='" . base_url('atendimento/detalhesmensal/' . $mes->mes . '/' . $ano . '/concluidos') . "'>" . $this->listagemModel->select('COUNT(*) as total_saida')->where('MONTH(saida)', $mes->mes)->where('YEAR(saida)', $ano)->first()->total_saida . "</a>",

                $mes->total_s_saida > 0 ?
                    "<a title='Atendimentos em aberto desse mês' target='_blank' class='fw-bold text-reset' href='" . base_url('atendimento/detalhesmensal/' . $mes->mes . '/' . $ano . '/abertos') . "'>" . $mes->total_s_saida . "</a>" :
                    $mes->total_s_saida,
            ];
        }

        $result = [
            'data' => $result
        ];


        return $this->response->setJSON($result);
    }

    public function detalhesMes($mes, $ano)
    {
        $datas = $this->listagemModel->select('listagem.idPaciente, listagem.entrada, paciente.nome')
            ->join('paciente', 'listagem.idPaciente = paciente.id')
            ->where('MONTH(listagem.entrada)', $mes)->where('YEAR(listagem.entrada)', $ano)->orderBy('listagem.entrada')->findAll();

        foreach ($datas as $dia) {
            $result[] = [
                date("d/m/Y", strtotime($dia->entrada)),
                "<a target='_blank' style='text-transform:uppercase;' href='" . base_url('atendimento/perfil/' . base64_encode($dia->idPaciente)) . "'>" . $dia->nome . "</a>",
            ];
        }

        $result = [
            'data' => $result
        ];


        return $this->response->setJSON($result);
    }

    public function concluidosMes($mes, $ano)
    {
        $datas = $this->listagemModel->select('listagem.idPaciente, listagem.saida, paciente.nome')
            ->join('paciente', 'listagem.idPaciente = paciente.id')
            ->where('MONTH(listagem.saida)', $mes)->where('YEAR(listagem.saida)', $ano)->where('listagem.saida IS NOT NULL')->orderBy('listagem.saida')->findAll();

        foreach ($datas as $dia) {
            $result[] = [
                date("d/m/Y", strtotime($dia->saida)),
                "<a target='_blank' style='text-transform:uppercase;' href='" . base_url('atendimento/perfil/' . base64_encode($dia->idPaciente)) . "'>" . $dia->nome . "</a>",
            ];
        }

        $result = [
            'data' => $result
        ];


        return $this->response->setJSON($result);
    }

    public function emAbertoMes($mes, $ano)
    {
        $datas = $this->listagemModel->select('listagem.idPaciente, listagem.entrada, paciente.nome')
            ->join('paciente', 'listagem.idPaciente = paciente.id')
            ->where('MONTH(listagem.entrada)', $mes)->where('YEAR(listagem.entrada)', $ano)->where('listagem.saida IS NULL')->orderBy('listagem.entrada')->findAll();

        foreach ($datas as $dia) {
            $result[] = [
                date("d/m/Y", strtotime($dia->entrada)),
                "<a target='_blank' style='text-transform:uppercase;' href='" . base_url('atendimento/perfil/' . base64_encode($dia->idPaciente)) . "'>" . $dia->nome . "</a>",
            ];
        }

        $result = [
            'data' => $result
        ];


        return $this->response->setJSON($result);
    }

    public function cadastrosMes($mes, $ano)
    {
        $datas = $this->pacienteModel->select('paciente.id, paciente.created_at, paciente.nome, MAX(listagem.saida) AS ultima_saida')
            ->join('listagem', 'paciente.id = listagem.idPaciente', 'left')
            ->where('MONTH(paciente.created_at)', $mes)
            ->where('YEAR(paciente.created_at)', $ano)
            ->groupBy('paciente.id, paciente.created_at, paciente.nome')
            ->orderBy('paciente.created_at')
            ->findAll();

        foreach ($datas as $dia) {
            $saida = $dia->ultima_saida ? date("d/m/Y", strtotime($dia->ultima_saida)) : 'Não há registros';

            $result[] = [
                date("d/m/Y", strtotime($dia->created_at)),
                "<a target='_blank' style='text-transform:uppercase;' href='" . base_url('atendimento/perfil/' . base64_encode($dia->id)) . "'>" . $dia->nome . "</a>",
                $saida,

            ];
        }

        $result = [
            'data' => $result
        ];

        return $this->response->setJSON($result);
    }
}
