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
    protected $allowedFields    = ['senha','entrada', 'cpfResponsavel', 'qtdReceitaResponsavel', 'idsAdicional', 'saida', 'nomeResponsavel', 'telResponsavel'];


    protected $useTimestamps = true;
    protected $createdField  = '';
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

    public function modelListagemInsert($post)
    {
        if (!empty($post)) {
            $db = db_connect();
            $nomeTel = $db->query("SELECT nome, telefone1 FROM paciente WHERE cpf = '" . $post["cpfResp"] . "'")->getResult();
            $dadosBD = [
                "cpfResponsavel" => $post["cpfResp"],
                "senha" => $post["senha"],
                "idsAdicional" => $post["idsAdicional"],
                "idAdicionalTeste" => $post["idsAdicional"],
                "nomeResponsavel" => $nomeTel[0]->nome,
                "telResponsavel" => $nomeTel[0]->telefone1,
                "entrada" => $post["dtEntrada"],
            ];

            return $this->save($dadosBD) ? true : false;
        }
    }

    public function modelListagemUpdate($post, $id)
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

    public function deleteListagem($id)
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

    public function getListagem($id)
    {
        $result = $this->find($id);
        return $result;
    }

    public function pdfDetails($date)
    {
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
        foreach ($data as $row) {
            $output .= '
                <tr>
                    <td>' . $row->senha . '</td>
                    <td nowrap>' . $row->cpfResponsavel . '</td>
                    <td nowrap>' . $row->nomeResponsavel . '.</td>
                    <td>' . $row->qtdReceitaResponsavel . '</td>
                    <td>' . date('d/m/Y',  strtotime($row->entrada)) . '</td>
                    <td>' . (isset($row->saida) ? date('d/m/Y',  strtotime($row->saida)) : 'Não retirado') . '</td>   
                </tr>
            ';
        }

        $output .= '</table>';
        //var_dump($output); die;
        return $output;
    }
}
