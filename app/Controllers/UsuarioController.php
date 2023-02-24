<?php

namespace App\Controllers;

use App\Http\Controller;
use App\Models\Usuario;

class UsuarioController extends Controller
{   
    public function __construct()
    {
        parent::__construct();
        if (empty($_SESSION['id'])) {
            header('Location:'.BASE_URL.'/login');die();
        }
    }
    
    public function index()
    {   
        $data = [];
        $data['msg'] = $this->flashMensagem();
        $data['old'] = $this->getDadosPost();
        $this->render('usuario',$data);
    }

    public function create()
    {   
        $this->validarDados([
            'nome'=>'required',
            'email'=>'required',
            'login'=>'required',
            'senha'=>'required',
            'telefone'=>''
        ]);
        
        if (!$this->validarTemError()) {
            $usuario = new Usuario();
            $usuario->adicionarUsuario($_POST);
        }
        
        $this->redirect('usuario');
    }
}