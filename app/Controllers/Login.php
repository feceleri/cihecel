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
                $query=$db->exists($user, $password);
                $this->session->set('usuario',$query);
                $this->session->set('logado',true);
                $this->session->set('user', $user);
                $mensagem['mensagem'] = 'Bem vindo '.$_SESSION['usuario']['user']->nome.'!';
                $this->session->setFlashdata('mensagem', $mensagem);
                return redirect()->to(base_url('/public'));
            } else {
                $mensagem['mensagem'] = 'User ou Password incorretos!';
                $mensagem['tipo'] = 'alert-danger';                
            }
            $this->session->setFlashdata('mensagem', $mensagem);
        }

        echo view('formularios/formLoguin');
    }

    public function recuperarSenha()
    {

        $post = $this->request->getPost();
        if (!empty($post)) {
            // var_dump($post);
        }

        echo view('formularios/formRecuperaSenha');
    }

    public function logout(){
         session()->destroy();

         return redirect()->to(base_url('public/login'));
    }

    public function settings(){
      
        echo view('layout/settings');
    }

    public function editar(){

        echo view('layout/editUser');
    }

    public function resetPassword(){
        $db =  new LoginModel();
        $_SESSION['usuario']['user']->user;
        $post = $this->request->getPost();
        if (!empty($post)) {
            $mensagem=$db->resetPassword($_SESSION['usuario']['user']->user,$post['oldPassword'],$post['newPassword'],$post['confirmPassword']);
            $this->session->setFlashdata('mensagem', $mensagem);
            return redirect()->to(base_url('public/login/editar'));
        }
    }
}
