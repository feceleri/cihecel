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
    protected $allowedFields    = ['nome', 'cpf', 'rg', 'dataNascimento', 'sexo', 'nomeMãe', 'telefone1', 'telefone2'];

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

    public function pegarTudo()
    {
    //    $result = $this->where('id', 1)->findAll();
    $result = $this->findAll();
       return $result;
    }

    public function teste($id = null){
        var_dump($id);exit;

        $result = $this->find($id);
    }
}
