<?php
// require './vendor/autoload.php';

namespace App\Controllers;

use App\Models\Legados;
use App\Models\Paciente;
use App\Models\Cadastro;
use App\Models\Listagem;
use Dompdf\Adapter\CPDF;
use Dompdf\Dompdf;
use Dompdf\Exception;

class  Legadoscontroller extends BaseController
{
    public function saidaListagem($id)
    {
        $legados = new Legados();
        if ($legados->modelSaidaListagem($id)) {
            $mensagem['tipo'] = 'alert-success';
            $mensagem['mensagem'] = 'Saída registrada com successo!';
            session()->setFlashdata('mensagem', $mensagem);
            return redirect()->back();
        } else {
            $mensagem['tipo'] = 'alert-danger';
            $mensagem['mensagem'] = 'Não foi possível registrar, tente novamente!';
            session()->setFlashdata('mensagem', $mensagem);
            return redirect()->back();
        }
    }
    public function saidaListagemManual()
    {
        $legados = new Legados();
        if ($this->request->getPost()) {
            $post = $this->request->getPost();
            if ($post['saida'] > date("Y-m-d")) {
                $mensagem['tipo'] = 'alert-danger';
                $mensagem['mensagem'] = 'A data foi inserida incorretamente!';
                session()->setFlashdata('mensagem', $mensagem);
                return redirect()->back();
            }
            if ($legados->modelSaidaLegadoManual($post)) {
                $mensagem['tipo'] = 'alert-success';
                $mensagem['mensagem'] = 'Saída registrada com successo!';
                session()->setFlashdata('mensagem', $mensagem);
                return redirect()->back();
            } else {
                $mensagem['tipo'] = 'alert-danger';
                $mensagem['mensagem'] = 'Não foi possível regitrar, tente novamente!';
                session()->setFlashdata('mensagem', $mensagem);
                return redirect()->back();
            }
        }
    }
}
