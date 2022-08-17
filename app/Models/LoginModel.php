<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'login';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['password'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
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

    public function exists($user, $password)
    {
        if ($this->where('user', $user)
            ->where('password', $password)
            ->find()
        ) {
            $query = $this->query("SELECT * FROM login where user='".$user."'  ");
            $row = $query->getRow();
            $result = [
                'true'=>true,
                'user'=> $row,
            ];
        } else {
            $result = false;
        }

        return  $result;
    }

    public function getAll()
    {
        $result = $this->findAll();
        return $result;
    }

    public function getUser($id)
    {
        $result = $this->find($id);
        return $result;
    }
}
