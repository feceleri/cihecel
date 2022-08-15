<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LoginModel;

class Login extends BaseController
{

    public function index()
    {
        $db =  new LoginModel();

        $post = $this->request->getPost();
        if (!empty($post)) {
            $user = $post["user"];
            $password = $post["password"];

            $mensagem = [
                'mensagem' => 'Bem vindo',
                'tipo' => 'alert-success',
            ];
            if ($db->exists($user, $password)) {
                $this->session->set('user', $user);
                $mensagem['mensagem'] = 'Bem vindo '.$user.'!';
                $this->session->setFlashdata('mensagem', $mensagem);
                return redirect()->to(base_url('/public'));
            } else {
                $mensagem['mensagem'] = 'Não existe';
                $mensagem['tipo'] = 'alert-danger';                
            }
            $this->session->setFlashdata('mensagem', $mensagem);
        }

        echo view('formularios/formLoguin');
    }

    public function recuperarSenha()
    {
        echo view('formularios/formRecuperaSenha');
    }
}
