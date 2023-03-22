<?php

namespace App\Models;

use CodeIgniter\Model;

class Legados extends Model
{
    protected $table            = 'atendimento';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['senha', 'entrada', 'saida', 'deletado', 'obs', 'idPaciente'];

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getAll()
    {
        $result = $this->findAll();
        return $result;
    }

    public function getUserId($id){
        $result = $this->select('atendimento.idPaciente')
        ->where('atendimento.idPaciente', $id)->find();
        return $result[0]->idPaciente;
    }

    public function getService($id)
    {
        $result = $this->find($id);
        return $result;
    }

    public function deleteService($id)
    {
        if ($this->find($id)) {
            $this->delete($id);
            return true;
            // return 'ACHOU!';
        } else {
            return false;
            // return 'FKIHJDES';
        }
    }

    public function modelSaidaListagem($id)
    {
        $id = base64_decode($id);
        $data = [
            'saida' => date("Y/m/d")
        ];
        return $this->update($id, $data) ? true : false;
    }

    public function modelSaidaLegadoManual($post)
    {
        $id = $post['id'];
        $data = [
            'saida' => $post['saida'],
        ];
        return $this->update($id, $data) ? true : false;
    }

    public function modelLegadosUpdate($post, $id)
    {
        if (!empty($post)) {
            $idListagem = base64_decode($id);
            $dadosBD = [
                "senha" => $post["senha"],
                "entrada" => $post["dtEntrada"],
            ];

            return $this->table('listagem')->update($idListagem,$dadosBD) ? true : false;
        }
    }
}
