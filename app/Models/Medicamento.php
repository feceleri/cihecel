<?php

namespace App\Models;

use CodeIgniter\Model;

class Medicamento extends Model
{    
    protected $table            = 'estoque';
    protected $primaryKey       = 'idEstoque';
    protected $useAutoIncrement = false;
    // protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['idEstoque', 'idMedicamento', 'quantidade', 'nome', 'observacao'];



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

    public function getMed($idEstoque){
        $result = $this->find($idEstoque);
        return $result;
    }



}
