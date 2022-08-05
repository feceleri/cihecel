<?php

namespace App\Models;

use CodeIgniter\Model;

class Cadastro extends Model
{    
    protected $table            = 'cadastro';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
<<<<<<< HEAD
    protected $allowedFields    = ['nome', 'cpf', 'rg', 'dataNascimento', 'sexo', 'telefone1', 'telefone2','nomeMae','cep','logradouro','numeroCasa','complementoCasa','cidade','bairro'];
=======
    protected $allowedFields    = ['nome', 'cpf', 'rg', 'dataNascimento', 'sexo', 'nomeMae', 'telefone1', 'telefone2'];


>>>>>>> 9cdb06ad6e45a92cc7135f3a41078136ee707f7b

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

    public function getUser($id){
        $result = $this->find($id);
        return $result;
    }

    public function getUsuario($cpf){
        $result = $this->find($cpf);
        return $result;
    }


}
