<?php

namespace App\Models;

use CodeIgniter\Model;

class Paciente extends Model
{
    protected $table            = 'paciente';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nome', 'cpf', 'rg', 'dataNascimento', 'sexo', 'telefone1', 'telefone2', 'nomeMae', 'cep', 'logradouro', 'numeroCasa', 'complementoCasa', 'cidade', 'bairro', 'obs'];


    // Dates
    protected $useTimestamps = true;
    //   protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

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
        $result = $this->orderBy('id')->findAll();
        return $result;
    }

    public function ajaxIndex(){
        $result = $this->select('nome, id, cpf, dataNascimento')->orderBy('id')->findAll();
        return $result;
    }

    public function getUser($id)
    {
        $result = $this->find($id);
        return $result;
    }

    public function getUserIdByCpf($cpf){
        $result = $this->select('paciente.id')
        ->join('listagem', 'paciente.cpf = listagem.cpfResponsavel')
        ->where('paciente.cpf', $cpf)->find();
        return $result[0]->id;
    }

    public function deleteUser($id)
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

    public function findCpf($cpf)
    {
        $people = $this->where('cpf', $cpf)
            ->find();
        return $people[0]->nome;
        // var_dump($teste[0]->nome);exit;
    }

    public function confereCpf($cpf)
    {
        $arrayCPF = $this->findColumn('cpf');
        $valido = false;
        foreach ($arrayCPF as $cpfs) {                       
            if ($cpfs == $cpf['cpf']) {                
                $valido = true;
            } 
        }
        return $valido;
    }
    
}
