<?php

namespace App\Models;

use CodeIgniter\Model;

class Listagem extends Model
{    
    protected $table            = 'listagem';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['senha', 'cpfResponsavel', 'qtdReceitaResponsavel', 'idsAdicional', 'saida'];


    protected $useTimestamps = true;
    protected $createdField  = 'entrada';
    protected $updatedField  = 'ultimaListagem';
    protected $deletedField  = 'deletado';


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


    public function getMed($id){
        $result = $this->find($id);
        return $result;
    }


    public function pdf($id){
        $data = $this->db->get('listagem');
        $output = '<table width="100%">';
        foreach($data->result() as $row)
        {
            $output .= '
            <tr>
                <td width="75%">'.$row->senha.'</td>
                <td width="75%">'.$row->cpfResponsavel.'</td>
                <td width="75%">'.$row->entrada.'</td>
                <td width="75%">'.$row->saida.'</td>
            </tr>
            ';
        }
        // $output .= '
        //     <tr>
        //     <td colspan="2" align="center"><a href="'.base_url().'htmltopdf" class="btn btn-primary">Back</a></td>
        //     </tr>
        // ';
        $output .= '</table>';
        return $output;

    }
}
