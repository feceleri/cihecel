<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Api extends ResourceController
{
    private $pacienteModel;

    public function __construct()
    {
        $this->pacienteModel = new \App\Models\Paciente();
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
}
