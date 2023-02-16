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
    protected $allowedFields    = ['senha', 'cpfResponsavel', 'qtdReceitaResponsavel', 'idsAdicional', 'saida', 'nomeResponsavel', 'telResponsavel'];


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

    public function pdfDetails($date){
        $data = $this->like('entrada', $date)->findAll();
        $output = '<table width="100%" style="min-width:100vw;" border="1"  cellpadding="6">';
        $output .= '    
            <tr style="background:lightgray;"> 
                <th>Senha</th>
                <th>CPF</th>
                <th>Nome</th>
                <th>Qtd. Receitas</th>
                <th>Data Entrada</th>
                <th>Data Retirada</th> 
            </tr>
        ';
        //var_dump($data); die;
        foreach($data as $row){
             $output .= '
                <tr>
                    <td>'. $row->senha .'</td>
                    <td>'. $row->cpfResponsavel .'</td>
                    <td>'. $row->nomeResponsavel .'.</td>
                    <td>'. $row->qtdReceitaResponsavel .'</td>
                    <td>'. $row->entrada .'</td>
                    <td>'. $row->saida .'</td>   
                </tr>
            '; 
        }

        $output .= '</table>';
        //var_dump($output); die;
        return $output;
    }

}
